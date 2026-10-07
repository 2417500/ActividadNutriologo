@extends('layouts.nutriologo')

@section('title', 'Planes Alimenticios - ConsultorioNutri')

@section('page-title', 'Planes Alimenticios')

@section('page-description', 'Administra los planes de alimentación asignados a los pacientes.')

@section('content')

@push('styles')
<style>
    .volver-container {
        margin-top: 22px;
    }
</style>
@endpush

<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Planes Registrados</h2>
            <p class="card-description">Total de {{ $planes->total() }} planes registrados</p>
        </div>

        <a href="{{ route('nutriologo.planes.create') }}" class="boton">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                <path d="M12 5V19M5 12H19" stroke-linecap="round"/>
            </svg>
            Crear plan alimenticio
        </a>
    </div>

    @if($planes->count() > 0)
        <div class="tabla-contenedor">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Paciente</th>
                        <th>Plan</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($planes as $plan)
                        <tr>
                            <td>
                                <strong>{{ $plan->paciente->user->name ?? 'Paciente no disponible' }}</strong>
                            </td>

                            <td>{{ $plan->titulo }}</td>

                            <td>
                                {{ $plan->fecha_inicio ? \Illuminate\Support\Carbon::parse($plan->fecha_inicio)->format('d/m/Y') : 'Sin definir' }}
                            </td>

                            <td>
                                {{ $plan->fecha_fin ? \Illuminate\Support\Carbon::parse($plan->fecha_fin)->format('d/m/Y') : 'Sin definir' }}
                            </td>

                            <td>
                                <span class="estado estado-{{ $plan->estado === 'activo' ? 'activa' : 'inactiva' }}">
                                    {{ ucfirst($plan->estado) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('nutriologo.planes.edit', $plan) }}" class="boton-secundario">
                                    Editar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN --}}
        <div style="margin-top: 18px;">
            {{ $planes->links() }}
        </div>
    @else
        <div class="vacio">
            <div class="vacio-titulo">Sin planes asignados</div>
            <div class="vacio-texto">Aún no hay planes alimenticios registrados en el sistema.</div>
        </div>
    @endif
</div>

{{-- BOTÓN REGRESAR --}}
<div class="volver-container">
    <a href="{{ route('nutriologo.dashboard') }}" class="boton-secundario">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
            <line x1="19" y1="12" x2="5" y2="12"/>
            <polyline points="12 19 5 12 12 5"/>
        </svg>
        Regresar al panel
    </a>
</div>

@endsection