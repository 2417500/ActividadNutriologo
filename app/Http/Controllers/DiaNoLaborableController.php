<?php

namespace App\Http\Controllers;

use App\Models\DiaNoLaborable;
use App\Models\RegistroActividad;
use Illuminate\Http\Request;

class DiaNoLaborableController extends Controller
{
    public function index()
    {
        $dias = DiaNoLaborable::orderBy('fecha')
            ->paginate(15);

        return view('nutriologo.dias-no-laborables.index', compact('dias'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'fecha' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:today',
                'unique:dias_no_laborables,fecha',
            ],
            'motivo' => [
                'required',
                'string',
                'max:150',
            ],
        ], [
            'fecha.required' => 'Selecciona una fecha.',
            'fecha.after_or_equal' => 'No puedes registrar una fecha pasada.',
            'fecha.unique' => 'Esa fecha ya está registrada.',
            'motivo.required' => 'Escribe el motivo del cierre.',
            'motivo.max' => 'El motivo no debe superar los 150 caracteres.',
        ]);

        $dia = DiaNoLaborable::create($datos);

        RegistroActividad::create([
            'user_id' => auth()->id(),
            'accion' => 'registrar_dia_no_laborable',
            'entidad' => 'dias_no_laborables',
            'entidad_id' => $dia->id,
            'descripcion' => 'Se registró un día no laborable.',
            'creado_at' => now(),
        ]);

        return redirect()
            ->route('nutriologo.dias-no-laborables.index')
            ->with('mensaje', 'El día no laborable se registró correctamente.');
    }

    public function destroy(DiaNoLaborable $diaNoLaborable)
    {
        $id = $diaNoLaborable->id;

        $diaNoLaborable->delete();

        RegistroActividad::create([
            'user_id' => auth()->id(),
            'accion' => 'eliminar_dia_no_laborable',
            'entidad' => 'dias_no_laborables',
            'entidad_id' => $id,
            'descripcion' => 'Se eliminó un día no laborable.',
            'creado_at' => now(),
        ]);

        return redirect()
            ->route('nutriologo.dias-no-laborables.index')
            ->with('mensaje', 'El día no laborable se eliminó correctamente.');
    }
}

