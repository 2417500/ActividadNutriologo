@extends('layouts.nutriologo')

@section('title', 'Nueva Evaluación Nutricional - ConsultorioNutri')

@section('page-title', 'Nueva Evaluación Nutricional')

@section('page-description', 'Registra las mediciones antropométricas y recomendaciones clínicas del paciente.')

@section('content')

{{-- DATOS GENERALES DE LA CITA --}}
<div class="card" style="margin-bottom: 20px;">
    <div class="card-header">
        <div>
            <h2 class="card-title">Información de la Cita</h2>
            <p class="card-description">Datos de origen de la consulta</p>
        </div>
    </div>

    <div class="informacion-grid">
        <div class="informacion-item">
            <span class="informacion-label">Paciente</span>
            <span class="informacion-valor">{{ $cita->paciente->user->name }}</span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Fecha de la Cita</span>
            <span class="informacion-valor">{{ $cita->fecha?->format('d/m/Y') ?? 'Sin fecha' }}</span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Hora</span>
            <span class="informacion-valor">{{ $cita->hora ?? 'Sin hora' }}</span>
        </div>

        <div class="informacion-item">
            <span class="informacion-label">Estado de la Consulta</span>
            <span class="informacion-valor">
                <span class="estado estado-{{ $cita->estado }}">
                    {{ ucfirst($cita->estado) }}
                </span>
            </span>
        </div>
    </div>
</div>

{{-- FORMULARIO DE EVALUACIÓN --}}
<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Mediciones y Diagnóstico</h2>
            <p class="card-description">Captura el progreso físico y las indicaciones para el paciente</p>
        </div>
    </div>

    <form action="{{ route('nutriologo.evaluaciones.store', $cita) }}" method="POST" class="form-grid">
        @csrf

        {{-- PESO --}}
        <div class="campo">
            <label for="peso_kg">Peso (kg)</label>
            <input
                type="number"
                id="peso_kg"
                name="peso_kg"
                min="0.1"
                max="500"
                step="0.01"
                value="{{ old('peso_kg') }}"
                placeholder="Ejemplo: 70.50"
                required
            >
            <small>Peso actual del paciente expresado en kilogramos.</small>
        </div>

        {{-- ESTATURA --}}
        <div class="campo">
            <label for="estatura_cm">Estatura (cm)</label>
            <input
                type="number"
                id="estatura_cm"
                name="estatura_cm"
                min="1"
                max="300"
                step="0.01"
                value="{{ old('estatura_cm') }}"
                placeholder="Ejemplo: 170"
                required
            >
            <small>Estatura medida en centímetros.</small>
        </div>

        {{-- CINTURA --}}
        <div class="campo">
            <label for="cintura_cm">Cintura (cm)</label>
            <input
                type="number"
                id="cintura_cm"
                name="cintura_cm"
                min="0.1"
                max="500"
                step="0.01"
                value="{{ old('cintura_cm') }}"
                placeholder="Ejemplo: 80.00"
            >
        </div>

        {{-- CADERA --}}
        <div class="campo">
            <label for="cadera_cm">Cadera (cm)</label>
            <input
                type="number"
                id="cadera_cm"
                name="cadera_cm"
                min="0.1"
                max="500"
                step="0.01"
                value="{{ old('cadera_cm') }}"
                placeholder="Ejemplo: 95.00"
            >
        </div>

        {{-- FECHA DE EVALUACIÓN --}}
        <div class="campo campo-completo">
            <label for="fecha_evaluacion">Fecha de evaluación</label>
            <input
                type="date"
                id="fecha_evaluacion"
                name="fecha_evaluacion"
                value="{{ old('fecha_evaluacion', now()->format('Y-m-d')) }}"
                max="{{ now()->format('Y-m-d') }}"
                required
            >
        </div>

        {{-- OBSERVACIONES --}}
        <div class="campo campo-completo">
            <label for="observaciones">Observaciones clínicas</label>
            <textarea
                id="observaciones"
                name="observaciones"
                placeholder="Anota hallazgos importantes, historial reciente o comentarios del paciente..."
            >{{ old('observaciones') }}</textarea>
        </div>

        {{-- OBJETIVOS --}}
        <div class="campo campo-completo">
            <label for="objetivos">Objetivos nutricionales</label>
            <textarea
                id="objetivos"
                name="objetivos"
                placeholder="Mencionen las metas a cumplir para la siguiente cita..."
            >{{ old('objetivos') }}</textarea>
        </div>

        {{-- RECOMENDACIONES --}}
        <div class="campo campo-completo">
            <label for="recomendaciones">Recomendaciones generales</label>
            <textarea
                id="recomendaciones"
                name="recomendaciones"
                placeholder="Indicaciones sobre hidratación, suplementación, ejercicio o hábitos..."
            >{{ old('recomendaciones') }}</textarea>
        </div>

        {{-- ACCIONES --}}
        <div class="form-acciones">
            <a
                href="{{ route('nutriologo.pacientes.show', ['paciente' => $cita->paciente_id]) }}"
                class="boton-secundario"
            >
                Cancelar
            </a>

            <button type="submit" class="boton">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Guardar Evaluación
            </button>
        </div>

    </form>
</div>

@endsection