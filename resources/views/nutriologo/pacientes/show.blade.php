@extends('layouts.nutriologo')

@section('title', 'Paciente - ConsultorioNutri')

@section('page-title', 'Expediente del Paciente')

@section('page-description', 'Información general, historial de citas, evaluaciones y planes del paciente.')

@section('content')

@push('styles')
<style>
    .seccion-card {
        margin-bottom: 22px;
    }

    .evaluacion-card {
        border: 1px solid var(--borde-suave);
        border-radius: 10px;
        padding: 18px;
        margin-top: 15px;
        background: var(--fondo);
    }

    .evaluacion-card h3 {
        margin-top: 0;
        font-family: 'Lora', serif;
        color: var(--texto);
        font-size: 16px;
    }

    .datos-evaluacion-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 15px;
        margin: 15px 0;
    }

    .item-evaluacion {
        background: var(--blanco);
        border: 1px solid var(--borde);
        border-radius: 8px;
        padding: 12px;
    }

    .item-evaluacion strong {
        display: block;
        color: var(--verde-principal);
        font-size: 11px;
        margin-bottom: 4px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .item-evaluacion span {
        font-weight: 600;
        font-size: 13px;
    }

    .cita-item {
        border-bottom: 1px solid var(--borde-suave);
        padding: 14px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .cita-item:last-child {
        border-bottom: none;
    }

    .acciones-paciente {
        margin-top: 22px;
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    @media (max-width: 700px) {
        .datos-evaluacion-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endpush

{{-- INFORMACIÓN PERSONAL --}}
<div class="card seccion-card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Información del Paciente</h2>
            <p class="card-description">Datos generales de registro</p>
        </div>
    </div>

    <div class="informacion-grid">
        <div class="informacion-item">
            <span class="informacion-label">ID de Registro</span>
            <span class="informacion-valor">#{{ $paciente->id }}</span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Nombre Completo</span>
            <span class="informacion-valor">{{ $paciente->user->name }}</span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Correo Electrónico</span>
            <span class="informacion-valor">{{ $paciente->user->email }}</span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Teléfono</span>
            <span class="informacion-valor">{{ $paciente->telefono ?? 'Sin teléfono' }}</span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Estado</span>
            <span class="informacion-valor">
                <span class="estado {{ $paciente->user->activo ? 'estado-activa' : 'estado-inactiva' }}">
                    {{ $paciente->user->activo ? 'Activo' : 'Inactivo' }}
                </span>
            </span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Fecha de Registro</span>
            <span class="informacion-valor">{{ $paciente->created_at->format('d/m/Y') }}</span>
        </div>
    </div>
</div>

{{-- EXPEDIENTE CLÍNICO --}}
<div class="card seccion-card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Expediente Clínico</h2>
        </div>
    </div>

    @if($paciente->expediente)
        <p style="margin-bottom: 12px; font-size: 12px; color: var(--texto-secundario);">
            El paciente cuenta con un expediente clínico registrado.
        </p>
        <span class="estado estado-completada">Expediente registrado</span>
    @else
        <div class="vacio" style="padding: 20px;">
            <div class="vacio-texto">El paciente todavía no tiene un expediente clínico registrado.</div>
        </div>
    @endif
</div>

{{-- CITAS REGISTRADAS --}}
<div class="card seccion-card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Historial de Citas</h2>
            <p class="card-description">Total de {{ $paciente->citas->count() }} cita(s) registrada(s)</p>
        </div>
    </div>

    @if($paciente->citas->count() > 0)
        @foreach($paciente->citas as $cita)
            <div class="cita-item">
                <div>
                    <strong>Fecha:</strong> {{ $cita->fecha?->format('d/m/Y') ?? 'Sin fecha' }} |
                    <strong>Hora:</strong> {{ $cita->hora ?? 'Sin hora' }} |
                    <strong>Estado:</strong>
                    <span class="estado estado-{{ $cita->estado }}">
                        {{ ucfirst($cita->estado) }}
                    </span>
                </div>

                <div>
                    @if($cita->evaluacion)
                        <span class="estado estado-completada">Evaluación registrada</span>
                    @else
                        <span class="estado estado-pendiente">Sin evaluación</span>
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="vacio" style="padding: 20px;">
            <div class="vacio-texto">No hay citas registradas para este paciente.</div>
        </div>
    @endif
</div>

{{-- EVALUACIONES NUTRICIONALES --}}
<div class="card seccion-card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Evaluaciones Nutricionales</h2>
        </div>
    </div>

    @php
        $evaluaciones = $paciente->citas->filter(function ($cita) {
            return $cita->evaluacion !== null;
        });
    @endphp

    @if($evaluaciones->count() > 0)
        @foreach($evaluaciones as $cita)
            @php $evaluacion = $cita->evaluacion; @endphp
            <div class="evaluacion-card">
                <h3>Evaluación del {{ $evaluacion->fecha_evaluacion?->format('d/m/Y') ?? 'Sin fecha' }}</h3>

                <div class="datos-evaluacion-grid">
                    <div class="item-evaluacion">
                        <strong>Peso</strong>
                        <span>{{ $evaluacion->peso_kg }} kg</span>
                    </div>

                    <div class="item-evaluacion">
                        <strong>Estatura</strong>
                        <span>{{ $evaluacion->estatura_cm }} cm</span>
                    </div>

                    <div class="item-evaluacion">
                        <strong>IMC</strong>
                        <span>{{ $evaluacion->imc }}</span>
                    </div>

                    <div class="item-evaluacion">
                        <strong>Cintura</strong>
                        <span>{{ $evaluacion->cintura_cm ?? 'Sin registrar' }} @if($evaluacion->cintura_cm) cm @endif</span>
                    </div>
                </div>

                <a href="{{ route('nutriologo.evaluaciones.show', $evaluacion) }}" class="boton-secundario">
                    Ver evaluación completa
                </a>
            </div>
        @endforeach
    @else
        <div class="vacio" style="padding: 20px;">
            <div class="vacio-texto">El paciente todavía no tiene evaluaciones nutricionales registradas.</div>
        </div>
    @endif
</div>

{{-- PLANES ALIMENTICIOS --}}
<div class="card seccion-card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Planes Alimenticios</h2>
        </div>
    </div>

    @if($paciente->planesAlimenticios->count() > 0)
        <p style="font-size: 12px; color: var(--texto-secundario);">
            El paciente tiene <strong>{{ $paciente->planesAlimenticios->count() }}</strong> plan(es) alimenticio(s) activo(s).
        </p>
    @else
        <div class="vacio" style="padding: 20px;">
            <div class="vacio-texto">No hay planes alimenticios registrados.</div>
        </div>
    @endif
</div>

{{-- BOTONES DE ACCIÓN --}}
<div class="acciones-paciente">
    <a href="{{ route('nutriologo.pacientes.edit', $paciente) }}" class="boton">
        Editar paciente
    </a>

    <a href="{{ route('nutriologo.pacientes.index') }}" class="boton-secundario">
        Regresar a pacientes
    </a>
</div>

@endsection