@extends('layouts.paciente')

@section('title', $plan->titulo . ' - ConsultorioNutri')

@section('page-title', 'Detalle del Plan Alimenticio')

@section('page-description', 'Revisa minuciosamente la estructura, comidas y recomendaciones asignadas.')

@section('content')

@push('styles')
<style>
    .encabezado-plan {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }

    .plan-meta-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 12px;
        margin-top: 18px;
        padding-top: 16px;
        border-top: 1px solid var(--borde-suave);
    }

    .plan-meta-item {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .plan-meta-icono {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        background: var(--verde-claro);
        color: var(--verde-principal);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .plan-meta-icono svg {
        width: 16px;
        height: 16px;
    }

    .plan-meta-texto {
        display: flex;
        flex-direction: column;
    }

    .plan-meta-label {
        font-size: 10px;
        font-weight: 700;
        color: var(--texto-secundario);
        text-transform: uppercase;
    }

    .plan-meta-valor {
        font-size: 12px;
        font-weight: 600;
        color: var(--texto);
    }

    .contenido-texto {
        white-space: pre-line;
        line-height: 1.7;
        font-size: 12px;
        color: var(--texto);
    }

    .acciones-plan {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 22px;
    }

    .acciones-plan .boton,
    .acciones-plan .boton-secundario {
        min-height: 38px !important;
        height: 38px !important;
        padding: 0 16px !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        border-radius: 9px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
    }

    .acciones-plan svg {
        width: 14px !important;
        height: 14px !important;
    }
</style>
@endpush

{{-- TARJETA PRINCIPAL DE INFORMACIÓN --}}
<div class="card">
    <div class="encabezado-plan">
        <div>
            <h2 class="card-title" style="font-size: 20px;">{{ $plan->titulo }}</h2>
            <p class="card-description">Asignado a tu expediente clínico</p>
        </div>

        <span class="estado estado-{{ $plan->estado === 'activo' ? 'activa' : 'inactiva' }}">
            {{ ucfirst($plan->estado) }}
        </span>
    </div>

    <div class="plan-meta-grid">
        <div class="plan-meta-item">
            <div class="plan-meta-icono">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="7" r="4"/>
                    <path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                </svg>
            </div>
            <div class="plan-meta-texto">
                <span class="plan-meta-label">Nutriólogo</span>
                <span class="plan-meta-valor">
                    {{ $plan->nutriologo ? $plan->nutriologo->name : 'No disponible' }}
                </span>
            </div>
        </div>

        <div class="plan-meta-item">
            <div class="plan-meta-icono">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
            <div class="plan-meta-texto">
                <span class="plan-meta-label">Fecha de Inicio</span>
                <span class="plan-meta-valor">
                    {{ $plan->fecha_inicio ? $plan->fecha_inicio->format('d/m/Y') : 'Sin definir' }}
                </span>
            </div>
        </div>

        <div class="plan-meta-item">
            <div class="plan-meta-icono">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
            <div class="plan-meta-texto">
                <span class="plan-meta-label">Fecha de Fin</span>
                <span class="plan-meta-valor">
                    {{ $plan->fecha_fin ? $plan->fecha_fin->format('d/m/Y') : 'Sin definir' }}
                </span>
            </div>
        </div>
    </div>
</div>

{{-- CONTENIDO DEL PLAN --}}
<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">Estructura del Plan Alimenticio</h3>
            <p class="card-description">Guía de alimentos, horarios y porciones recomendadas</p>
        </div>
    </div>

    <div class="contenido-texto">
        {{ $plan->contenido }}
    </div>
</div>

{{-- OBSERVACIONES ADICIONALES --}}
@if($plan->observaciones)
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="card-title">Observaciones y Recomendaciones</h3>
                <p class="card-description">Pautas adicionales provistas por tu nutriólogo</p>
            </div>
        </div>

        <div class="contenido-texto">
            {{ $plan->observaciones }}
        </div>
    </div>
@endif

{{-- BOTONES DE NAVEGACIÓN --}}
<div class="acciones-plan">
    <a href="{{ route('paciente.planes.index') }}" class="boton-secundario">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M19 12H5"/>
            <path d="m12 19-7-7 7-7"/>
        </svg>
        Volver a mis planes
    </a>

    <a href="{{ route('paciente.dashboard') }}" class="boton">
        Ir al dashboard
    </a>
</div>

@endsection