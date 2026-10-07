<?php

namespace App\Http\Controllers;

use App\Models\ExpedienteClinico;
use App\Models\RegistroActividad;
use Illuminate\Http\Request;

class ExpedienteClinicoController extends Controller
{
    public function mostrar()
    {
        $paciente = auth()->user()->paciente;

        abort_unless($paciente, 403);

        $expediente = $paciente->expediente;

        return view('paciente.expediente.show', compact(
            'paciente',
            'expediente'
        ));
    }

    public function guardar(Request $request)
    {
        $datos = $request->validate([
            'fecha_nacimiento' => [
                'nullable',
                'date',
                'before:today',
            ],
            'antecedentes_medicos' => ['nullable', 'string', 'max:10000'],
            'antecedentes_familiares' => ['nullable', 'string', 'max:10000'],
            'alergias' => ['nullable', 'string', 'max:5000'],
            'medicamentos' => ['nullable', 'string', 'max:5000'],
            'intolerancias' => ['nullable', 'string', 'max:5000'],
            'habitos_alimenticios' => ['nullable', 'string', 'max:10000'],
            'preferencias_alimenticias' => ['nullable', 'string', 'max:5000'],
            'actividad_fisica' => ['nullable', 'string', 'max:5000'],
            'horas_sueno' => ['nullable', 'numeric', 'min:0', 'max:24'],
            'objetivos_nutricionales' => ['nullable', 'string', 'max:5000'],
        ]);


        $paciente = auth()->user()->paciente;

        abort_unless($paciente, 403);

        $expediente = ExpedienteClinico::updateOrCreate(
            ['paciente_id' => $paciente->id],
            array_merge($datos, [
                'completado_at' => now(),
            ])
        );

        
        RegistroActividad::create([
            'user_id' => auth()->id(),
            'accion' => 'actualizar_expediente',
            'entidad' => 'expedientes_clinicos',
            'entidad_id' => $expediente->id,
            'descripcion' => 'El paciente actualizó su expediente clínico.',
            'creado_at' => now(),
        ]);

        return redirect()
            ->route('paciente.expediente.show')
            ->with('mensaje', 'Tu expediente clínico fue guardado correctamente.');
    }
}

