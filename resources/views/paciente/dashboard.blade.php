@extends('layouts.paciente')

@section('title', 'Inicio - ConsultorioNutri')

@section('page-title', 'Bienvenido(a), ' . auth()->user()->name)

@section('page-description', 'Desde tu panel principal puedes gestionar tus citas, consultar tu expediente médico y revisar tus planes alimenticios.')

@section('content')

@push('styles')
<style>
    /* =====================================================
       AJUSTES COMPACTOS Y PROPORCIONADOS PARA EL DASHBOARD
    ===================================================== */

    /* 1. Tarjeta de Bienvenida más sobria y compacta */
    .bienvenida-card {
        background: linear-gradient(135deg, var(--verde-principal), #537353);
        color: var(--blanco);
        border: none;
        border-radius: var(--radio);
        padding: 16px 20px !important;
        margin-bottom: 20px;
    }

    .bienvenida-card .card-title {
        color: var(--blanco) !important;
        font-size: 17px !important;
        margin-bottom: 4px;
    }

    .bienvenida-card p {
        color: rgba(255, 255, 255, 0.92);
        font-size: 12px;
        line-height: 1.5;
        margin: 0;
    }

    /* 2. Grid de Módulos (4 columnas balanceadas) */
    .grid-modulos {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 16px;
    }

    .modulo-card {
        padding: 18px !important;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .modulo-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(57, 68, 58, 0.08);
    }

    /* Iconos compactos de 34px */
    .modulo-icono {
        width: 34px !important;
        height: 34px !important;
        border-radius: 8px;
        background: var(--verde-claro);
        color: var(--verde-principal);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 12px;
    }

    .modulo-icono svg {
        width: 18px !important;
        height: 18px !important;
    }

    .modulo-card .card-title {
        font-size: 15px !important;
        margin-bottom: 4px;
    }

    .modulo-card .card-description {
        font-size: 11px !important;
        line-height: 1.4;
        color: var(--texto-secundario);
    }

    /* Footer y botón compacto alineado con Citas/Expediente */
    .modulo-footer {
        margin-top: 16px;
        padding-top: 12px;
        border-top: 1px solid var(--borde-suave);
    }

    .modulo-footer .boton {
        min-height: 38px !important;
        height: 38px !important;
        padding: 0 14px !important;
        font-size: 11px !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }
</style>
@endpush

{{-- TARJETA DE BIENVENIDA COMPACTA --}}
<div class="card bienvenida-card">
    <h2 class="card-title">Portal de Atención Nutricional</h2>
    <p>
        Has iniciado sesión correctamente como <strong>paciente</strong>. Revisa tus próximas consultas agendadas, mantén actualizado tu historial médico o descarga los planes alimenticios que tu nutriólogo ha diseñado para ti.
    </p>
</div>

{{-- GRID DE ACCIONES RÁPIDAS --}}
<div class="grid-modulos">

    {{-- MIS CITAS --}}
    <div class="card modulo-card">
        <div>
            <div class="modulo-icono">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
            <h3 class="card-title">Mis Citas</h3>
            <p class="card-description">Consulta las citas que tienes programadas y revisa su estado.</p>
        </div>
        <div class="modulo-footer">
            <a href="{{ route('paciente.citas.index') }}" class="boton">
                Ver mis citas
            </a>
        </div>
    </div>

    {{-- SOLICITAR CITA --}}
    <div class="card modulo-card">
        <div>
            <div class="modulo-icono">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"/>
                    <line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
            </div>
            <h3 class="card-title">Solicitar Cita</h3>
            <p class="card-description">Selecciona una fecha y hora para solicitar una nueva consulta.</p>
        </div>
        <div class="modulo-footer">
            <a href="{{ route('paciente.citas.create') }}" class="boton">
                Solicitar cita
            </a>
        </div>
    </div>

    {{-- MI EXPEDIENTE --}}
    <div class="card modulo-card">
        <div>
            <div class="modulo-icono">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                </svg>
            </div>
            <h3 class="card-title">Mi Expediente</h3>
            <p class="card-description">Consulta y completa tu información clínica y antecedentes de salud.</p>
        </div>
        <div class="modulo-footer">
            <a href="{{ route('paciente.expediente.show') }}" class="boton">
                Ver expediente
            </a>
        </div>
    </div>

    {{-- MIS PLANES --}}
    <div class="card modulo-card">
        <div>
            <div class="modulo-icono">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                </svg>
            </div>
            <h3 class="card-title">Mis Planes</h3>
            <p class="card-description">Consulta los planes alimenticios y menús asignados por tu especialista.</p>
        </div>
        <div class="modulo-footer">
            <a href="{{ route('paciente.planes.index') }}" class="boton">
                Ver mis planes
            </a>
        </div>
    </div>

</div>

@endsection