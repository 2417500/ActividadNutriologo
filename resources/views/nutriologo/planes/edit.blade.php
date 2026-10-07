@extends('layouts.nutriologo')

@section('title', 'Editar Plan Alimenticio - ConsultorioNutri')

@section('page-title', 'Editar Plan Alimenticio')

@section('page-description', 'Modifica la estructura, fechas o estado del plan asignado.')

@section('content')

{{-- TARJETA CON DATOS DEL PACIENTE --}}
<div class="card" style="margin-bottom: 20px;">
    <div class="card-header">
        <div>
            <h2 class="card-title">Paciente Asignado</h2>
            <p class="card-description">El destinatario de este plan no se puede cambiar</p>
        </div>
    </div>

    <div class="informacion-grid">
        <div class="informacion-item">
            <span class="informacion-label">Nombre del Paciente</span>
            <span class="informacion-valor">
                @if($plan->paciente && $plan->paciente->user)
                    {{ $plan->paciente->user->name }}
                @else
                    Paciente no disponible
                @endif
            </span>
        </div>
    </div>
</div>

{{-- FORMULARIO DE EDICIÓN --}}
<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Modificar Plan</h2>
            <p class="card-description">Actualiza el contenido o vigencia de este plan</p>
        </div>
    </div>

    <form method="POST" action="{{ route('nutriologo.planes.update', $plan) }}" class="form-grid">
        @csrf
        @method('PUT')

        {{-- TÍTULO --}}
        <div class="campo campo-completo">
            <label for="titulo">Título del plan</label>
            <input 
                type="text" 
                id="titulo" 
                name="titulo" 
                value="{{ old('titulo', $plan->titulo) }}" 
                required
            >
            @error('titulo')
                <small style="color: var(--cancelado);">{{ $message }}</small>
            @enderror
        </div>

        {{-- CONTENIDO --}}
        <div class="campo campo-completo">
            <label for="contenido">Contenido del plan</label>
            <textarea 
                id="contenido" 
                name="contenido" 
                rows="10" 
                required
            >{{ old('contenido', $plan->contenido) }}</textarea>
            @error('contenido')
                <small style="color: var(--cancelado);">{{ $message }}</small>
            @enderror
        </div>

        {{-- FECHAS --}}
        <div class="campo">
            <label for="fecha_inicio">Fecha de inicio</label>
            <input 
                type="date" 
                id="fecha_inicio" 
                name="fecha_inicio" 
                value="{{ old('fecha_inicio', optional($plan->fecha_inicio)->format('Y-m-d')) }}"
            >
            @error('fecha_inicio')
                <small style="color: var(--cancelado);">{{ $message }}</small>
            @enderror
        </div>

        <div class="campo">
            <label for="fecha_fin">Fecha de fin</label>
            <input 
                type="date" 
                id="fecha_fin" 
                name="fecha_fin" 
                value="{{ old('fecha_fin', optional($plan->fecha_fin)->format('Y-m-d')) }}"
            >
            @error('fecha_fin')
                <small style="color: var(--cancelado);">{{ $message }}</small>
            @enderror
        </div>

        {{-- ESTADO --}}
        <div class="campo campo-completo">
            <label for="estado">Estado del plan</label>
            <select id="estado" name="estado" required>
                <option value="activo" {{ old('estado', $plan->estado) === 'activo' ? 'selected' : '' }}>
                    Activo
                </option>
                <option value="finalizado" {{ old('estado', $plan->estado) === 'finalizado' ? 'selected' : '' }}>
                    Finalizado
                </option>
            </select>
            @error('estado')
                <small style="color: var(--cancelado);">{{ $message }}</small>
            @enderror
        </div>

        {{-- OBSERVACIONES --}}
        <div class="campo campo-completo">
            <label for="observaciones">Observaciones</label>
            <textarea 
                id="observaciones" 
                name="observaciones" 
                rows="4"
            >{{ old('observaciones', $plan->observaciones) }}</textarea>
            @error('observaciones')
                <small style="color: var(--cancelado);">{{ $message }}</small>
            @enderror
        </div>

        {{-- ACCIONES --}}
        <div class="form-acciones">
            <a href="{{ route('nutriologo.planes.index') }}" class="boton-secundario">
                Cancelar
            </a>

            <button type="submit" class="boton">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Guardar Cambios
            </button>
        </div>
    </form>
</div>

@endsection