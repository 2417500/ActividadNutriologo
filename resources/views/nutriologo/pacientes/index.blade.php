@extends('layouts.nutriologo')

@section('title', 'Pacientes - ConsultorioNutri')

@section('page-title', 'Lista de Pacientes')

@section('page-description', 'Consulta, administra y revisa la información de tus pacientes registrados.')

@section('content')

@push('styles')
<style>
    .paciente-nombre-col {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .paciente-avatar-mini {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--verde-claro);
        color: var(--verde-principal);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .acciones-col {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }

    .volver-container {
        margin-top: 22px;
    }
</style>
@endpush

<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Pacientes Registrados</h2>
            <p class="card-description">Total de {{ $pacientes->count() }} pacientes</p>
        </div>

        <a href="{{ route('nutriologo.pacientes.create') }}" class="boton">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                <path d="M12 5V19M5 12H19" stroke-linecap="round"/>
            </svg>
            Nuevo paciente
        </a>
    </div>

    @if($pacientes->count() > 0)
        <div class="tabla-contenedor">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacientes as $paciente)
                        <tr>
                            <td>
                                <strong>#{{ $paciente->id }}</strong>
                            </td>

                            <td>
                                <div class="paciente-nombre-col">
                                    <div class="paciente-avatar-mini">
                                        {{ strtoupper(substr($paciente->user->name, 0, 1)) }}
                                    </div>
                                    <strong>{{ $paciente->user->name }}</strong>
                                </div>
                            </td>

                            <td>{{ $paciente->user->email }}</td>

                            <td>{{ $paciente->telefono ?? 'Sin teléfono' }}</td>

                            <td>
                                <div class="acciones-col">
                                    {{-- VER EXPEDIENTE --}}
                                    <a href="{{ route('nutriologo.pacientes.show', $paciente) }}" class="boton-secundario">
                                        Ver
                                    </a>

                                    {{-- EDITAR --}}
                                    <a href="{{ route('nutriologo.pacientes.edit', $paciente) }}" class="boton-secundario">
                                        Editar
                                    </a>

                                    {{-- PLANES --}}
                                    @if($paciente->planesAlimenticios()->where('estado', 'activo')->exists())
                                        <a href="{{ route('nutriologo.planes.index') }}" class="boton-secundario">
                                            Ver planes
                                        </a>
                                    @else
                                        <a href="{{ route('nutriologo.planes.create', ['paciente_id' => $paciente->id]) }}" class="boton">
                                            Crear plan
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="vacio">
            <div class="vacio-titulo">No hay pacientes registrados</div>
            <div class="vacio-texto">Puedes comenzar registrando un nuevo paciente mediante el botón superior.</div>
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
        Regresar al dashboard
    </a>
</div>

@endsection