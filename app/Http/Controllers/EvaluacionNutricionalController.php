<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\EvaluacionNutricional;
use App\Models\RegistroActividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class EvaluacionNutricionalController extends Controller
{
    public function crear(Cita $cita)
    {
        $cita->load('paciente.user', 'evaluacion');

        abort_if(
            in_array($cita->estado, ['cancelada', 'pendiente'], true),
            422,
            'La cita debe estar confirmada o completada para registrar una evaluación.'
        );

        return view('nutriologo.evaluaciones.create', compact('cita'));
    }

    public function guardar(Request $request, Cita $cita)
    {
        $datos = $request->validate([
            'peso_kg' => ['required', 'numeric', 'gt:0', 'max:500'],
            'estatura_cm' => ['required', 'numeric', 'gt:0', 'max:300'],
            'cintura_cm' => ['nullable', 'numeric', 'gt:0', 'max:500'],
            'cadera_cm' => ['nullable', 'numeric', 'gt:0', 'max:500'],
            'observaciones' => ['nullable', 'string', 'max:10000'],
            'objetivos' => ['nullable', 'string', 'max:5000'],
            'recomendaciones' => ['nullable', 'string', 'max:10000'],
            'fecha_evaluacion' => ['required', 'date', 'before_or_equal:today'],
        ]);

        abort_if(
            in_array($cita->estado, ['cancelada', 'pendiente'], true),
            422,
            'La cita debe estar confirmada o completada.'
        );

        $peso = (float) $datos['peso_kg'];
        $estaturaMetros = (float) $datos['estatura_cm'] / 100;

        $imc = round($peso / ($estaturaMetros * $estaturaMetros), 2);

        $evaluacion = DB::transaction(function () use (
            $cita,
            $datos,
            $imc
        ) {
            $citaBloqueada = Cita::whereKey($cita->id)
                ->lockForUpdate()
                ->firstOrFail();

            if (
                in_array(
                    $citaBloqueada->estado,
                    ['cancelada', 'pendiente'],
                    true
                )
            ) {
                throw ValidationException::withMessages([
                    'fecha_evaluacion' =>
                        'La cita debe estar confirmada o completada.',
                ]);
            }

            $evaluacion = EvaluacionNutricional::updateOrCreate(
                ['cita_id' => $citaBloqueada->id],
                array_merge($datos, [
                    'nutriologo_id' => auth()->id(),
                    'imc' => $imc,
                ])
            );

            RegistroActividad::create([
                'user_id' => auth()->id(),
                'accion' => 'guardar_evaluacion',
                'entidad' => 'evaluaciones_nutricionales',
                'entidad_id' => $evaluacion->id,
                'descripcion' => 'Se registró o actualizó una evaluación nutricional.',
                'creado_at' => now(),
            ]);

            return $evaluacion;
        });

        return redirect()
            ->route('nutriologo.pacientes.show', [
                'paciente' => $cita->paciente_id,
            ])
            ->with('mensaje', 'La evaluación nutricional fue guardada.');
    }

    public function mostrar(EvaluacionNutricional $evaluacion)
    {
        $evaluacion->load('cita.paciente.user', 'planesAlimenticios');

        return view(
            'nutriologo.evaluaciones.show',
            compact('evaluacion')
        );
    }
}

