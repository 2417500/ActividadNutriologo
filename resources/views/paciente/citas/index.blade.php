@extends('layouts.paciente')

@section('title', 'Mis Citas - ConsultorioNutri')

@section('page-title', 'Mis Citas')

@section('page-description', 'Consulta tus citas agendadas, revisa su estado o solicita una nueva atención.')

@section('content')

@push('styles')
<style>
    .header-acciones {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
        gap: 12px;
        flex-wrap: wrap;
    }

    .boton-cancelar {
        padding: 6px 12px;
        font-size: 10px;
        border-radius: 7px;
        background: var(--cancelado-fondo);
        color: var(--cancelado);
        border: 1px solid #EACCCC;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
    }

    .boton-cancelar:hover {
        background: #F2DCDC;
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

    <a href="{{ route('paciente.citas.create') }}" class="boton">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
            <path d="M12 5v14"/>
            <path d="M5 12h14"/>
        </svg>
        Solicitar nueva cita
    </a>
</div>

@if($citas->count() > 0)
    <div class="card">
        <div class="card-header">
            <div>
                <h2 class="card-title">Historial de Citas</h2>
                <p class="card-description">Total de {{ $citas->total() }} cita(s) registrada(s)</p>
            </div>
        </div>

        <div class="tabla-contenedor">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
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
                                {{ \Carbon\Carbon::parse($cita->hora)->format('H:i') }} hrs
                            </td>

                            <td>
                                {{ $cita->motivo }}
                            </td>

                            <td>
                                <span class="estado estado-{{ $cita->estado }}">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </td>

                            <td>
                                @if(in_array($cita->estado, ['pendiente', 'confirmada']))
                                    <form action="{{ route('paciente.citas.cancelar', $cita) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('PATCH')
                                        <button 
                                            type="submit" 
                                            class="boton-cancelar" 
                                            onclick="return confirm('¿Estás seguro de que deseas cancelar esta cita?')"
                                        >
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 12px; height: 12px;">
                                                <path d="M18 6 6 18"/>
                                                <path d="m6 6 12 12"/>
                                            </svg>
                                            Cancelar
                                        </button>
                                    </form>
                                @else
                                    <span style="color: var(--texto-secundario); font-size: 10px;">
                                        Sin acciones
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINACIÓN --}}
    <div style="margin-top: 20px;">
        {{ $citas->links() }}
    </div>
@else
    <div class="card">
        <div class="vacio">
            <div class="vacio-titulo">No tienes citas registradas</div>
            <div class="vacio-texto" style="margin-bottom: 20px;">
                Actualmente no cuentas con ninguna cita agendada en el sistema.
            </div>
            <a href="{{ route('paciente.citas.create') }}" class="boton">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                    <path d="M12 5v14"/>
                    <path d="M5 12h14"/>
                </svg>
                Solicitar mi primera cita
            </a>
        </div>
    </div>
@endif

@endsection