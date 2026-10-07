@extends('layouts.paciente')

@section('title', 'Mis Planes Alimenticios - ConsultorioNutri')

@section('page-title', 'Mis Planes Alimenticios')

@section('page-description', 'Consulta y da seguimiento a las guías nutricionales asignadas por tu especialista.')

@section('content')

@push('styles')
<style>
    .header-acciones {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
    }

    .planes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 18px;
    }

    .plan-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .plan-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(57, 68, 58, 0.08);
    }

    .plan-header-info {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
    }

    .plan-icon-title {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .plan-icono {
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

    .plan-icono svg {
        width: 16px;
        height: 16px;
    }

    .plan-detalles {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
        margin: 14px 0;
        padding: 12px;
        background: var(--fondo);
        border: 1px solid var(--borde-suave);
        border-radius: 8px;
    }

    .plan-detalle-item {
        display: flex;
        flex-direction: column;
    }

    .plan-detalle-label {
        font-size: 10px;
        font-weight: 700;
        color: var(--texto-secundario);
        text-transform: uppercase;
    }

    .plan-detalle-valor {
        font-size: 11px;
        font-weight: 600;
        color: var(--texto);
        margin-top: 2px;
    }

    .plan-observaciones {
        font-size: 11px;
        color: var(--texto-secundario);
        line-height: 1.5;
        margin-bottom: 14px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .plan-footer {
        padding-top: 12px;
        border-top: 1px solid var(--borde-suave);
        display: flex;
        justify-content: flex-end;
    }
</style>
@endpush

<div class="header-acciones">
    <a href="{{ route('paciente.dashboard') }}" class="boton-secundario">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
            <path d="M19 12H5"/>
            <path d="m12 19-7-7 7-7"/>
        </svg>
        Regresar al panel
    </a>
</div>

@if($planes->count())
    <div class="planes-grid">
        @foreach($planes as $plan)
            <div class="card plan-card">
                <div>
                    <div class="plan-header-info">
                        <div class="plan-icon-title">
                            <div class="plan-icono">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                </svg>
                            </div>
                            <h3 class="card-title" style="font-size: 15px;">{{ $plan->titulo }}</h3>
                        </div>

                        <span class="estado estado-{{ $plan->estado === 'activo' ? 'activa' : 'inactiva' }}">
                            {{ ucfirst($plan->estado) }}
                        </span>
                    </div>

                    <div class="plan-detalles">
                        <div class="plan-detalle-item">
                            <span class="plan-detalle-label">Fecha de Inicio</span>
                            <span class="plan-detalle-valor">
                                {{ $plan->fecha_inicio ? $plan->fecha_inicio->format('d/m/Y') : 'Sin definir' }}
                            </span>
                        </div>

                        <div class="plan-detalle-item">
                            <span class="plan-detalle-label">Fecha de Fin</span>
                            <span class="plan-detalle-valor">
                                {{ $plan->fecha_fin ? $plan->fecha_fin->format('d/m/Y') : 'Sin definir' }}
                            </span>
                        </div>
                    </div>

                    @if($plan->observaciones)
                        <div class="plan-observaciones">
                            <strong>Observaciones:</strong> {{ $plan->observaciones }}
                        </div>
                    @endif
                </div>

                <div class="plan-footer">
                    <a href="{{ route('paciente.planes.show', $plan) }}" class="boton" style="width: 100%;">
                        Ver plan completo
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="card">
        <div class="vacio">
            <div class="vacio-titulo">Sin planes asignados</div>
            <div class="vacio-texto">
                Actualmente no tienes ningún plan alimenticio registrado por tu especialista.
            </div>
        </div>
    </div>
@endif

@endsection