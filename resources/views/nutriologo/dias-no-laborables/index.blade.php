@extends('layouts.nutriologo')

@section('title', 'Días no laborables - ConsultorioNutri')

@section('page-title', 'Días No Laborables')

@section('page-description', 'Registra las fechas de cierre o vacaciones para bloquear la solicitud de citas en esos días.')

@section('content')

{{-- ESTILOS ESPECÍFICOS PARA ESTA VISTA --}}
@push('styles')
<style>
    .volver-container {
        margin-top: 22px;
    }
</style>
@endpush

{{-- FORMULARIO DE REGISTRO --}}
<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Registrar día de cierre</h2>
            <p class="card-description">Las fechas registradas no estarán disponibles para solicitar citas.</p>
        </div>
    </div>

    <form
        action="{{ route('nutriologo.dias-no-laborables.store') }}"
        method="POST"
        class="form-grid"
    >
        @csrf

        <div class="campo">
            <label for="fecha">Fecha de cierre</label>
            <input
                type="date"
                id="fecha"
                name="fecha"
                min="{{ now()->format('Y-m-d') }}"
                value="{{ old('fecha') }}"
                required
            >
        </div>

        <div class="campo">
            <label for="motivo">Motivo del cierre</label>
            <input
                type="text"
                id="motivo"
                name="motivo"
                maxlength="150"
                value="{{ old('motivo') }}"
                placeholder="Ej. Vacaciones, día festivo o capacitación"
                required
            >
        </div>

        <div class="form-acciones">
            <button type="submit" class="boton">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                    <path d="M12 5V19M5 12H19" stroke-linecap="round"/>
                </svg>
                Registrar día no laborable
            </button>
        </div>
    </form>
</div>

{{-- LISTADO DE DÍAS REGISTRADOS --}}
<div class="card" style="margin-top: 22px;">
    <div class="card-header">
        <div>
            <h2 class="card-title">Días no laborables registrados</h2>
            <p class="card-description">Fechas de suspensión de actividades programadas</p>
        </div>
    </div>

    <div class="tabla-contenedor">
        <table class="tabla">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Motivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($dias as $dia)
                    <tr>
                        <td>
                            <strong>{{ $dia->fecha->format('d/m/Y') }}</strong>
                        </td>

                        <td>
                            {{ $dia->motivo }}
                        </td>

                        <td>
                            <form
                                action="{{ route('nutriologo.dias-no-laborables.destroy', $dia) }}"
                                method="POST"
                                onsubmit="return confirm('¿Deseas eliminar este día no laborable?');"
                                style="margin: 0;"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="boton-peligro"
                                >
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            <div class="vacio">
                                <div class="vacio-titulo">Sin días registrados</div>
                                <div class="vacio-texto">Todavía no hay días no laborables registrados en la agenda.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINACIÓN --}}
    @if ($dias->hasPages())
        <div style="margin-top: 18px;">
            {{ $dias->links() }}
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
        Volver al panel del nutriólogo
    </a>
</div>

@endsection