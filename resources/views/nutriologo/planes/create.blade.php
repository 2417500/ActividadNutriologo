@extends('layouts.nutriologo')

@section('title', 'Crear Plan Alimenticio - ConsultorioNutri')

@section('page-title', 'Crear Plan Alimenticio')

@section('page-description', 'Selecciona un paciente y diseña un plan de alimentación personalizado.')

@section('content')

<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Detalles del Plan Alimenticio</h2>
            <p class="card-description">Completa la información necesaria para el paciente</p>
        </div>
    </div>

    <form action="{{ route('nutriologo.planes.store') }}" method="POST" class="form-grid">
        @csrf

        {{-- SELECCIÓN DE PACIENTE --}}
        <div class="campo campo-completo">
            <label for="paciente_id">Paciente</label>
            <select id="paciente_id" name="paciente_id" required>
                <option value="">-- Selecciona un paciente --</option>
                @foreach($pacientes as $paciente)
                    <option 
                        value="{{ $paciente->id }}" 
                        {{ (old('paciente_id', request('paciente_id')) == $paciente->id) ? 'selected' : '' }}
                    >
                        {{ $paciente->user->name }} - {{ $paciente->user->email }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- TÍTULO --}}
        <div class="campo campo-completo">
            <label for="titulo">Título del plan</label>
            <input 
                type="text" 
                id="titulo" 
                name="titulo" 
                value="{{ old('titulo') }}" 
                placeholder="Ejemplo: Plan alimenticio inicial - Deficit calórico" 
                required
            >
        </div>

        {{-- CONTENIDO --}}
        <div class="campo campo-completo">
            <label for="contenido">Contenido del plan</label>
            <textarea 
                id="contenido" 
                name="contenido" 
                rows="10" 
                placeholder="Escribe aquí las pautas alimenticias, distribución de comidas y platillos..." 
                required
            >{{ old('contenido') }}</textarea>
        </div>

        {{-- FECHAS --}}
        <div class="campo">
            <label for="fecha_inicio">Fecha de inicio</label>
            <input 
                type="date" 
                id="fecha_inicio" 
                name="fecha_inicio" 
                value="{{ old('fecha_inicio') }}"
            >
        </div>

        <div class="campo">
            <label for="fecha_fin">Fecha de finalización</label>
            <input 
                type="date" 
                id="fecha_fin" 
                name="fecha_fin" 
                value="{{ old('fecha_fin') }}"
            >
        </div>

        {{-- OBSERVACIONES --}}
        <div class="campo campo-completo">
            <label for="observaciones">Observaciones adicionales</label>
            <textarea 
                id="observaciones" 
                name="observaciones" 
                rows="4" 
                placeholder="Agrega recomendaciones sobre hidratación, suplementos u observaciones clave..."
            >{{ old('observaciones') }}</textarea>
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
                Guardar Plan
            </button>
        </div>
    </form>
</div>

@endsection