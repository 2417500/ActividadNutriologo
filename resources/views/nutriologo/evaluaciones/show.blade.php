@extends('layouts.nutriologo')

@section('title', 'Detalle de Evaluación Nutricional - ConsultorioNutri')

@section('page-title', 'Evaluación Nutricional')

@section('page-description', 'Ficha clínica con el registro de medidas antropométricas y notas nutricionales.')

@section('content')

@push('styles')
<style>
    /* TARJETA DESTACADA PARA EL IMC */
    .card-imc {
        background: var(--verde-suave);
        border: 1px solid #CFE3CF;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        margin-bottom: 18px;
    }

    .card-imc-valor {
        font-family: 'Lora', serif;
        font-size: 32px;
        font-weight: 700;
        color: var(--verde-principal);
        margin-top: 6px;
    }

    .volver-container {
        margin-top: 22px;
    }
</style>
@endpush

{{-- INFORMACIÓN DEL PACIENTE Y CONSULTA --}}
<div class="card" style="margin-bottom: 20px;">
    <div class="card-header">
        <div>
            <h2 class="card-title">Información del Paciente</h2>
            <p class="card-description">Datos de la sesión de evaluación</p>
        </div>
    </div>

    <div class="informacion-grid">
        <div class="informacion-item">
            <span class="informacion-label">Paciente</span>
            <span class="informacion-valor">{{ $evaluacion->cita->paciente->user->name }}</span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Fecha de Evaluación</span>
            <span class="informacion-valor">{{ $evaluacion->fecha_evaluacion?->format('d/m/Y') ?? 'Sin registrar' }}</span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Nutriólogo a Cargo</span>
            <span class="informacion-valor">{{ $evaluacion->nutriologo->name ?? 'Sin registrar' }}</span>
        </div>
    </div>
</div>

{{-- DATOS ANTROPOMÉTRICOS --}}
<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Mediciones Antropométricas</h2>
            <p class="card-description">Valores físicos registrados en la cita</p>
        </div>
    </div>

    {{-- TARJETA RESALTADA IMC --}}
    <div class="card-imc">
        <span class="informacion-label" style="text-transform: uppercase; letter-spacing: 0.5px;">Índice de Masa Corporal (IMC)</span>
        <div class="card-imc-valor">
            {{ $evaluacion->imc ?? 'Sin registrar' }}
        </div>
    </div>

    <div class="informacion-grid">
        <div class="informacion-item">
            <span class="informacion-label">Peso</span>
            <span class="informacion-valor">
                {{ $evaluacion->peso_kg ?? 'Sin registrar' }} @if($evaluacion->peso_kg) kg @endif
            </span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Estatura</span>
            <span class="informacion-valor">
                {{ $evaluacion->estatura_cm ?? 'Sin registrar' }} @if($evaluacion->estatura_cm) cm @endif
            </span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Cintura</span>
            <span class="informacion-valor">
                {{ $evaluacion->cintura_cm ?? 'Sin registrar' }} @if($evaluacion->cintura_cm) cm @endif
            </span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Cadera</span>
            <span class="informacion-valor">
                {{ $evaluacion->cadera_cm ?? 'Sin registrar' }} @if($evaluacion->cadera_cm) cm @endif
            </span>
        </div>
    </div>
</div>

{{-- NOTAS CLÍNICAS Y PLANES --}}
<div class="card" style="margin-top: 20px;">
    <div class="card-header">
        <div>
            <h2 class="card-title">Diagnóstico y Recomendaciones</h2>
            <p class="card-description">Anotaciones clínicas registradas durante la evaluación</p>
        </div>
    </div>

    <div class="informacion-grid" style="grid-template-columns: 1fr;">
        <div class="informacion-item">
            <span class="informacion-label">Observaciones</span>
            <div class="informacion-valor" style="font-weight: normal; margin-top: 4px; white-space: pre-wrap;">{{ $evaluacion->observaciones ?: 'Sin registrar' }}</div>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Objetivos Nutricionales</span>
            <div class="informacion-valor" style="font-weight: normal; margin-top: 4px; white-space: pre-wrap;">{{ $evaluacion->objetivos ?: 'Sin registrar' }}</div>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Recomendaciones</span>
            <div class="informacion-valor" style="font-weight: normal; margin-top: 4px; white-space: pre-wrap;">{{ $evaluacion->recomendaciones ?: 'Sin registrar' }}</div>
        </div>
    </div>
</div>

{{-- BOTÓN REGRESAR --}}
<div class="volver-container">
    <a
        href="{{ route('nutriologo.pacientes.show', ['paciente' => $evaluacion->cita->paciente_id]) }}"
        class="boton-secundario"
    >
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
            <line x1="19" y1="12" x2="5" y2="12"/>
            <polyline points="12 19 5 12 12 5"/>
        </svg>
        Regresar al expediente del paciente
    </a>
</div>

@endsection