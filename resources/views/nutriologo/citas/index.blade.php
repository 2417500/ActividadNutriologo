@extends('layouts.nutriologo')

@section('title', 'Citas - ConsultorioNutri')

@section('page-title', 'Gestión de Citas')

@section('page-description', 'Consulta, confirma, completa o cancela las citas registradas en el consultorio.')

@section('content')

{{-- ESTILOS ESPECÍFICOS PARA LA VISTA DE CITAS --}}
@push('styles')
<style>
    /* FILTROS */
    .filtros-card {
        margin-bottom: 22px;
    }

    .filtros-form {
        display: flex;
        align-items: flex-end;
        gap: 16px;
        flex-wrap: wrap;
    }

    .filtros-form .campo {
        min-width: 190px;
    }

    /* PACIENTE EN TABLA */
    .paciente-col {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 170px;
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

    /* ACCIONES Y BOTONES EN TABLA */
    .acciones-col {
        display: flex;
        align-items: center;
        gap: 7px;
        flex-wrap: wrap;
        min-width: 250px;
    }

    .acciones-col form {
        margin: 0;
    }

    .hora-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
        color: var(--verde-principal);
    }

    .hora-badge svg {
        width: 14px;
        height: 14px;
    }

    .motivo-texto {
        max-width: 220px;
        color: var(--texto-secundario);
        font-size: 11px;
        line-height: 1.4;
    }

    .volver-container {
        margin-top: 22px;
    }

    @media (max-width: 650px) {
        .filtros-form {
            flex-direction: column;
            align-items: stretch;
        }

        .filtros-form .campo {
            width: 100%;
        }

        .filtros-form .boton,
        .filtros-form .boton-secundario {
            width: 100%;
        }
    }
</style>
@endpush

{{-- FILTROS DE BÚSQUEDA --}}
<div class="card filtros-card">
    <form action="{{ route('nutriologo.citas.index') }}" method="GET" class="filtros-form">

        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date" 
                id="fecha" 
                name="fecha" 
                value="{{ request('fecha') }}"
            >
        </div>

        <div class="campo">
            <label for="estado">Estado</label>
            <select id="estado" name="estado">
                <option value="">Todos los estados</option>
                <option value="pendiente" {{ request('estado') === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="confirmada" {{ request('estado') === 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                <option value="completada" {{ request('estado') === 'completada' ? 'selected' : '' }}>Completada</option>
                <option value="cancelada" {{ request('estado') === 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

        <button type="submit" class="boton">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            Filtrar
        </button>

        <a href="{{ route('nutriologo.citas.index') }}" class="boton-secundario">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M3 12a9 9 0 1 0 3-6.7"/>
                <polyline points="3 4 3 9 8 9"/>
            </svg>
            Limpiar
        </a>

    </form>
</div>

{{-- TABLA DE CITAS REGISTRADAS --}}
<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Citas Registradas</h2>
            <p class="card-description">Total de {{ $citas->total() }} citas encontradas</p>
        </div>
    </div>

    @if($citas->count() > 0)
        <div class="tabla-contenedor">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Paciente</th>
                        <th>Motivo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($citas as $cita)
                        <tr>
                            <td>
                                <strong>{{ $cita->fecha->format('d/m/Y') }}</strong>
                            </td>

                            <td>
                                <span class="hora-badge">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    {{ substr((string) $cita->hora, 0, 5) }}
                                </span>
                            </td>

                            <td>
                                @if($cita->paciente && $cita->paciente->user)
                                    <div class="paciente-col">
                                        <div class="paciente-avatar-mini">
                                            {{ strtoupper(substr($cita->paciente->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong>{{ $cita->paciente->user->name }}</strong>
                                        </div>
                                    </div>
                                @else
                                    <span style="color: var(--texto-secundario);">Paciente no disponible</span>
                                @endif
                            </td>

                            <td>
                                <div class="motivo-texto">
                                    {{ $cita->motivo }}
                                </div>
                            </td>

                            <td>
                                <span class="estado estado-{{ $cita->estado }}">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </td>

                            <td>
                                <div class="acciones-col">

                                    {{-- CONFIRMAR CITA --}}
                                    @if($cita->estado === 'pendiente')
                                        <form action="{{ route('nutriologo.citas.estado', $cita) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="estado" value="confirmada">
                                            <button type="submit" class="boton">
                                                Confirmar
                                            </button>
                                        </form>
                                    @endif

                                    {{-- COMPLETAR CITA --}}
                                    @if($cita->estado === 'confirmada')
                                        <form action="{{ route('nutriologo.citas.estado', $cita) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="estado" value="completada">
                                            <button type="submit" class="boton">
                                                Completar
                                            </button>
                                        </form>
                                    @endif

                                    {{-- CANCELAR CITA --}}
                                    @if(in_array($cita->estado, ['pendiente', 'confirmada']))
                                        <form action="{{ route('nutriologo.citas.cancelar', $cita) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="motivo_cancelacion" value="Cancelada por el nutriólogo.">
                                            <button type="submit" class="boton-peligro" onclick="return confirm('¿Seguro que deseas cancelar esta cita?')">
                                                Cancelar
                                            </button>
                                        </form>
                                    @endif

                                    {{-- CREAR EVALUACIÓN --}}
                                    @if($cita->estado === 'completada')
                                        <a href="{{ route('nutriologo.evaluaciones.create', $cita) }}" class="boton-secundario">
                                            Crear evaluación
                                        </a>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- PAGINACIÓN DE LARAVEL --}}
        <div style="margin-top: 18px;">
            {{ $citas->links() }}
        </div>
    @else
        <div class="vacio">
            <div class="vacio-titulo">No hay citas registradas</div>
            <div class="vacio-texto">No se encontraron citas con los filtros seleccionados.</div>
        </div>
    @endif
</div>

{{-- BOTÓN REGRESAR --}}
<div class="volver-container">
    <a href="{{ route('nutriologo.dashboard') }}" class="boton-secundario">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px; height:14px;">
            <line x1="19" y1="12" x2="5" y2="12"/>
            <polyline points="12 19 5 12 12 5"/>
        </svg>
        Regresar al Dashboard
    </a>
</div>

@endsection