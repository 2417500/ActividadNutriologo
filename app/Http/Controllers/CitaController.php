<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\DiaNoLaborable;
use App\Models\HorarioAtencion;
use App\Models\RegistroActividad;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CitaController extends Controller
{
    /**
     * Mostrar las citas del paciente autenticado.
     */
    public function misCitas()
    {
        $paciente = auth()->user()->paciente;

        abort_unless($paciente, 403, 'No existe un perfil de paciente.');

        $citas = $paciente->citas()
            ->orderByDesc('fecha')
            ->orderByDesc('hora')
            ->paginate(10);

        return view('paciente.citas.index', compact('citas'));
    }

    /**
     * Mostrar el formulario para solicitar una cita.
     */
    public function crear()
    {
        $horarios = HorarioAtencion::where('activo', true)
            ->get(['dia_semana', 'hora_inicio', 'hora_fin']);

        $diasNoLaborables = DiaNoLaborable::whereDate(
            'fecha',
            '>=',
            today()
        )->pluck('fecha')
            ->map(fn ($fecha) => Carbon::parse($fecha)->format('Y-m-d'))
            ->values();

        $citasOcupadas = Cita::whereIn('estado', [
            'pendiente',
            'confirmada',
        ])
            ->whereDate('fecha', '>=', today())
            ->get(['fecha', 'hora'])
            ->map(fn ($cita) => [
                'fecha' => Carbon::parse($cita->fecha)->format('Y-m-d'),
                'hora' => substr((string) $cita->hora, 0, 5),
            ])
            ->values();

        return view('paciente.citas.create', [
            'horarios' => $horarios,
            'diasNoLaborables' => $diasNoLaborables,
            'citasOcupadas' => $citasOcupadas,
            'fechaMinima' => today()->format('Y-m-d'),
            'horaActual' => now()->format('H:i'),
        ]);
    }

    /**
     * Registrar una solicitud de cita.
     */
    public function guardar(Request $request)
    {
        $datos = $request->validate([
            'fecha' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
            'hora' => ['required', 'date_format:H:i'],
            'motivo' => ['required', 'string', 'max:2000'],
        ]);

        $paciente = auth()->user()->paciente;

        abort_unless($paciente, 403, 'No existe un perfil de paciente.');

        $cita = DB::transaction(function () use ($datos, $paciente) {
            /*
             * El bloqueo de la fila del nutriólogo serializa las reservas.
             * Así evitamos que dos solicitudes reserven el mismo horario
             * al mismo tiempo.
             */
            $nutriologo = User::where('role', 'nutriologo')
                ->lockForUpdate()
                ->first();

            if (!$nutriologo) {
                throw ValidationException::withMessages([
                    'fecha' => 'No hay un nutriólogo configurado.',
                ]);
            }

            $this->validarDisponibilidad(
                $datos['fecha'],
                $datos['hora']
            );

            $cita = Cita::create([
                'paciente_id' => $paciente->id,
                'fecha' => $datos['fecha'],
                'hora' => $datos['hora'],
                'estado' => 'pendiente',
                'motivo' => $datos['motivo'],
            ]);

            $this->registrarActividad(
                'solicitar_cita',
                $cita,
                'El paciente solicitó una cita.'
            );

            return $cita;
        }, 3);

        /*
         * El correo de confirmación de recepción se conectará
         * cuando implementemos los Mailables.
         */

        return redirect()
            ->route('paciente.citas.index')
            ->with('mensaje', 'Tu solicitud de cita fue registrada.');
    }

    /**
     * Mostrar las citas para el nutriólogo.
     */
    public function todas(Request $request)
    {
        $citas = Cita::with('paciente.user')
            ->when($request->filled('fecha'), function ($consulta) use ($request) {
                $consulta->whereDate('fecha', $request->input('fecha'));
            })
            ->when($request->filled('estado'), function ($consulta) use ($request) {
                $consulta->where('estado', $request->input('estado'));
            })
            ->orderByDesc('fecha')
            ->orderByDesc('hora')
            ->paginate(15)
            ->withQueryString();

        return view('nutriologo.citas.index', compact('citas'));
    }

    /**
     * Confirmar o completar una cita.
     */
    public function cambiarEstado(Request $request, Cita $cita)
    {
        $datos = $request->validate([
            'estado' => [
                'required',
                'in:confirmada,completada',
            ],
        ]);

        DB::transaction(function () use ($datos, $cita) {
            $nutriologo = User::where('role', 'nutriologo')
                ->lockForUpdate()
                ->first();

            if (!$nutriologo) {
                abort(500, 'No hay un nutriólogo configurado.');
            }

            $cita = Cita::whereKey($cita->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (!in_array($cita->estado, ['pendiente', 'confirmada'], true)) {
                throw ValidationException::withMessages([
                    'estado' => 'Esta cita ya no puede cambiar de estado.',
                ]);
            }

            if ($datos['estado'] === 'confirmada') {
                $this->validarDisponibilidad(
                    $cita->fecha->format('Y-m-d'),
                    substr((string) $cita->hora, 0, 5),
                    $cita->id
                );
            }

            $cita->estado = $datos['estado'];

            if ($datos['estado'] === 'completada') {
                $cita->completada_at = now();
            }

            $cita->save();

            $this->registrarActividad(
                'cambiar_estado_cita',
                $cita,
                'Se cambió el estado de la cita a ' . $cita->estado . '.'
            );
        }, 3);

        return back()->with('mensaje', 'El estado de la cita fue actualizado.');
    }

    /**
     * Cancelar una cita desde el panel del paciente.
     */
    public function cancelarPaciente(Cita $cita)
    {
        $paciente = auth()->user()->paciente;

        abort_unless(
            $paciente && $cita->paciente_id === $paciente->id,
            404
        );

        $this->cancelar($cita, 'Cancelación solicitada por el paciente.');

        return back()->with('mensaje', 'La cita fue cancelada.');
    }

    /**
     * Cancelar una cita desde el panel del nutriólogo.
     */
    public function cancelarNutriologo(Request $request, Cita $cita)
    {
        $datos = $request->validate([
            'motivo_cancelacion' => ['required', 'string', 'max:1000'],
        ]);

        $this->cancelar($cita, $datos['motivo_cancelacion']);

        return back()->with('mensaje', 'La cita fue cancelada.');
    }

    /**
     * Solicitar cambio de fecha y hora.
     *
     * La cita original permanece reservada hasta que
     * el nutriólogo apruebe la solicitud.
     */
    public function solicitarReprogramacion(Request $request, Cita $cita)
    {
        $datos = $request->validate([
            'fecha_solicitada' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
            ],
            'hora_solicitada' => ['required', 'date_format:H:i'],
        ]);

        $paciente = auth()->user()->paciente;

        abort_unless(
            $paciente && $cita->paciente_id === $paciente->id,
            404
        );

        DB::transaction(function () use ($datos, $cita) {
            $nutriologo = User::where('role', 'nutriologo')
                ->lockForUpdate()
                ->first();

            if (!$nutriologo) {
                abort(500, 'No hay un nutriólogo configurado.');
            }

            $cita = Cita::whereKey($cita->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (!in_array($cita->estado, ['pendiente', 'confirmada'], true)) {
                throw ValidationException::withMessages([
                    'fecha_solicitada' =>
                        'Esta cita no admite solicitudes de reprogramación.',
                ]);
            }

            $this->validarDisponibilidad(
                $datos['fecha_solicitada'],
                $datos['hora_solicitada'],
                $cita->id
            );

            $cita->update([
                'fecha_solicitada' => $datos['fecha_solicitada'],
                'hora_solicitada' => $datos['hora_solicitada'],
                'respuesta_reprogramacion' => null,
                'reprogramacion_respondida_at' => null,
            ]);

            $this->registrarActividad(
                'solicitar_reprogramacion',
                $cita,
                'El paciente solicitó cambiar la fecha de su cita.'
            );
        }, 3);

        return back()->with(
            'mensaje',
            'Tu solicitud de reprogramación fue enviada al nutriólogo.'
        );
    }

    /**
     * Aceptar o rechazar una solicitud de reprogramación.
     */
    public function responderReprogramacion(
        Request $request,
        Cita $cita
    ) {
        $datos = $request->validate([
            'respuesta' => ['required', 'in:aceptada,rechazada'],
            'comentario' => ['nullable', 'string', 'max:1000'],
        ]);

        DB::transaction(function () use ($datos, $cita) {
            $nutriologo = User::where('role', 'nutriologo')
                ->lockForUpdate()
                ->first();

            if (!$nutriologo) {
                abort(500, 'No hay un nutriólogo configurado.');
            }

            $cita = Cita::whereKey($cita->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (
                !$cita->fecha_solicitada ||
                !$cita->hora_solicitada ||
                !in_array($cita->estado, ['pendiente', 'confirmada'], true)
            ) {
                throw ValidationException::withMessages([
                    'respuesta' =>
                        'La cita no tiene una solicitud pendiente de reprogramación.',
                ]);
            }

            if ($datos['respuesta'] === 'aceptada') {
                $this->validarDisponibilidad(
                    $cita->fecha_solicitada->format('Y-m-d'),
                    substr((string) $cita->hora_solicitada, 0, 5),
                    $cita->id
                );

                $cita->fecha = $cita->fecha_solicitada;
                $cita->hora = $cita->hora_solicitada;
            }

            $cita->respuesta_reprogramacion =
                $datos['respuesta'] === 'aceptada'
                    ? 'aceptada'
                    : 'rechazada';

            if (!empty($datos['comentario'])) {
                $cita->respuesta_reprogramacion .= ': ' . $datos['comentario'];
            }

            $cita->reprogramacion_respondida_at = now();

            $cita->fecha_solicitada = null;
            $cita->hora_solicitada = null;

            $cita->save();

            $this->registrarActividad(
                'responder_reprogramacion',
                $cita,
                'Se respondió una solicitud de reprogramación.'
            );
        }, 3);

        return back()->with(
            'mensaje',
            'La solicitud de reprogramación fue procesada.'
        );
    }

    /**
     * Validar horario, día laborable y disponibilidad.
     */
    private function validarDisponibilidad(
        string $fecha,
        string $hora,
        ?int $citaExcluir = null
    ): void {
        $fechaCarbon = Carbon::createFromFormat('!Y-m-d', $fecha);
        $horaCarbon = Carbon::createFromFormat('!H:i', $hora);

        if ($fechaCarbon->isPast() && !$fechaCarbon->isToday()) {
            throw ValidationException::withMessages([
                'fecha' => 'No puedes reservar una fecha pasada.',
            ]);
        }

        if ($fechaCarbon->isToday()) {
            $inicio = Carbon::parse($fecha . ' ' . $hora);

            if ($inicio->lessThanOrEqualTo(now())) {
                throw ValidationException::withMessages([
                    'hora' => 'Selecciona una hora futura.',
                ]);
            }
        }

        // Las citas duran 30 minutos y comienzan en intervalos de media hora.
        if (!in_array((int) $horaCarbon->format('i'), [0, 30], true)) {
            throw ValidationException::withMessages([
                'hora' => 'Las citas deben comenzar en una hora en punto o a y media.',
            ]);
        }

        $diaSemana = $fechaCarbon->dayOfWeek;

        $horario = HorarioAtencion::where('dia_semana', $diaSemana)
            ->where('activo', true)
            ->where('hora_inicio', '<=', $hora . ':00')
            ->where('hora_fin', '>=', $horaCarbon->copy()
                ->addMinutes(30)
                ->format('H:i:s'))
            ->first();

        if (!$horario) {
            throw ValidationException::withMessages([
                'hora' => 'La hora seleccionada está fuera del horario de atención.',
            ]);
        }

        $diaNoLaborable = DiaNoLaborable::whereDate('fecha', $fecha)->exists();

        if ($diaNoLaborable) {
            throw ValidationException::withMessages([
                'fecha' => 'El consultorio no atiende en la fecha seleccionada.',
            ]);
        }

        $consulta = Cita::whereDate('fecha', $fecha)
            ->whereIn('estado', ['pendiente', 'confirmada']);

        if ($citaExcluir !== null) {
            $consulta->where('id', '!=', $citaExcluir);
        }

        $horaInicio = $horaCarbon->format('H:i:s');
        $horaFin = $horaCarbon->copy()->addMinutes(30)->format('H:i:s');

        /*
         * Comprueba intervalos superpuestos, no solamente horas idénticas.
         */
        $ocupada = $consulta->get()->contains(function ($cita) use (
            $horaInicio,
            $horaFin
        ) {
            $inicioExistente = substr((string) $cita->hora, 0, 8);

            $finExistente = Carbon::createFromFormat(
                'H:i:s',
                $inicioExistente
            )->addMinutes(30)->format('H:i:s');

            return $horaInicio < $finExistente
                && $horaFin > $inicioExistente;
        });

        if ($ocupada) {
            throw ValidationException::withMessages([
                'hora' => 'Ese horario ya está ocupado. Selecciona otro.',
            ]);
        }
    }

    /**
     * Cancelación compartida por paciente y nutriólogo.
     */
    private function cancelar(Cita $cita, string $motivo): void
    {
        DB::transaction(function () use ($cita, $motivo) {
            $nutriologo = User::where('role', 'nutriologo')
                ->lockForUpdate()
                ->first();

            if (!$nutriologo) {
                abort(500, 'No hay un nutriólogo configurado.');
            }

            $cita = Cita::whereKey($cita->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (!in_array($cita->estado, ['pendiente', 'confirmada'], true)) {
                throw ValidationException::withMessages([
                    'estado' => 'Esta cita ya no se puede cancelar.',
                ]);
            }

            $cita->update([
                'estado' => 'cancelada',
                'motivo_cancelacion' => $motivo,
                'cancelada_at' => now(),
                'fecha_solicitada' => null,
                'hora_solicitada' => null,
            ]);

            $this->registrarActividad(
                'cancelar_cita',
                $cita,
                'Se canceló una cita.'
            );
        }, 3);
    }

    /**
     * Guardar un registro de auditoría.
     */
    private function registrarActividad(
        string $accion,
        Cita $cita,
        string $descripcion
    ): void {
        RegistroActividad::create([
            'user_id' => auth()->id(),
            'accion' => $accion,
            'entidad' => 'citas',
            'entidad_id' => $cita->id,
            'descripcion' => $descripcion,
            'creado_at' => now(),
        ]);
    }
}
