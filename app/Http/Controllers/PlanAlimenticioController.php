<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\PlanAlimenticio;
use App\Models\RegistroActividad;
use Illuminate\Http\Request;


class PlanAlimenticioController extends Controller
{
    public function index()
    {
        $planes = PlanAlimenticio::with('paciente.user')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('nutriologo.planes.index', compact('planes'));
    }

    public function crear()
    {
        $pacientes = Paciente::with('user')
            ->whereHas('user', function ($consulta) {
                $consulta->where('activo', true);
            })
            ->orderBy('id')
            ->get();

        return view('nutriologo.planes.create', compact('pacientes'));
    }

    public function guardar(Request $request)
    {
        $datos = $request->validate([
            'paciente_id' => ['required', 'exists:pacientes,id'],

            'titulo' => ['required', 'string', 'max:150'],

            'contenido' => ['required', 'string', 'max:30000'],

            'fecha_inicio' => ['nullable', 'date'],

            'fecha_fin' => [
                'nullable',
                'date',
                'after_or_equal:fecha_inicio',
            ],

            'observaciones' => ['nullable', 'string', 'max:10000'],
        ]);

        $paciente = Paciente::with('user')
            ->findOrFail($datos['paciente_id']);

        abort_unless(
            $paciente->user && $paciente->user->activo,
            422,
            'El paciente seleccionado no está activo.'
        );
        
        $datos['nutriologo_id'] = auth()->id();
        $datos['estado'] = 'activo';

        $plan = PlanAlimenticio::create($datos);

        RegistroActividad::create([
            'user_id' => auth()->id(),
            'accion' => 'crear_plan_alimenticio',
            'entidad' => 'planes_alimenticios',
            'entidad_id' => $plan->id,
            'descripcion' => 'Se creó un plan alimenticio.',
            'creado_at' => now(),
        ]);

        return redirect()
            ->route('nutriologo.planes.index')
            ->with('mensaje', 'El plan alimenticio fue creado correctamente.');
    }

    public function editar(PlanAlimenticio $plan)
    {
        $plan->load('paciente.user');

        return view('nutriologo.planes.edit', compact('plan'));
    }

    public function actualizar(Request $request, PlanAlimenticio $plan)
    {
        $datos = $request->validate([
            'titulo' => ['required', 'string', 'max:150'],
            'contenido' => ['required', 'string', 'max:30000'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => [
                'nullable',
                'date',
                'after_or_equal:fecha_inicio',
            ],
            'observaciones' => ['nullable', 'string', 'max:10000'],
            'estado' => ['required', 'in:activo,finalizado'],
        ]);

        $plan->update($datos);

        RegistroActividad::create([
            'user_id' => auth()->id(),
            'accion' => 'actualizar_plan_alimenticio',
            'entidad' => 'planes_alimenticios',
            'entidad_id' => $plan->id,
            'descripcion' => 'Se actualizó un plan alimenticio.',
            'creado_at' => now(),
        ]);

        return redirect()
            ->route('nutriologo.planes.index')
            ->with('mensaje', 'El plan alimenticio fue actualizado.');
    }

    public function misPlanes()
    {
        $paciente = auth()->user()->paciente;

        abort_unless($paciente, 403);

        $planes = $paciente->planesAlimenticios()
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('paciente.planes.index', compact('planes'));
    }

    public function verMiPlan(PlanAlimenticio $plan)
    {
        $paciente = auth()->user()->paciente;

        abort_unless(
            $paciente && $plan->paciente_id === $paciente->id,
            404
        );

        return view('paciente.planes.show', compact('plan'));
    }
}

