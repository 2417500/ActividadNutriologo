@extends('layouts.nutriologo')

@section('title', 'Nuevo Paciente - ConsultorioNutri')

@section('page-title', 'Registrar Nuevo Paciente')

@section('page-description', 'Ingresa los datos necesarios para crear la cuenta de acceso del paciente.')

@section('content')

<div class="card">
    <div class="card-header">
        <div>
            <h2 class="card-title">Información del Paciente</h2>
            <p class="card-description">Completa los campos obligatorios (*)</p>
        </div>
    </div>

    <form action="{{ route('nutriologo.pacientes.store') }}" method="POST" class="form-grid">
        @csrf

        {{-- NOMBRE --}}
        <div class="campo">
            <label for="name">
                Nombre completo <span style="color: var(--cancelado);">*</span>
            </label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Ej. Ana López"
                required
            >
        </div>

        {{-- CORREO --}}
        <div class="campo">
            <label for="email">
                Correo electrónico <span style="color: var(--cancelado);">*</span>
            </label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Ej. ana@correo.com"
                required
            >
        </div>

        {{-- CONTRASEÑA --}}
        <div class="campo">
            <label for="password">
                Contraseña <span style="color: var(--cancelado);">*</span>
            </label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Ingresa una contraseña"
                required
            >
            <small>La contraseña será utilizada por el paciente para ingresar a su panel.</small>
        </div>

        {{-- TELÉFONO --}}
        <div class="campo">
            <label for="telefono">Teléfono</label>
            <input
                type="text"
                id="telefono"
                name="telefono"
                value="{{ old('telefono') }}"
                placeholder="Ej. 55 1234 5678"
            >
            <small>Campo opcional.</small>
        </div>

        {{-- ACCIONES --}}
        <div class="form-acciones">
            <a href="{{ route('nutriologo.pacientes.index') }}" class="boton-secundario">
                Cancelar
            </a>

            <button type="submit" class="boton">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width: 14px; height: 14px;">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                    <polyline points="17 21 17 13 7 13 7 21"/>
                    <polyline points="7 3 7 8 15 8"/>
                </svg>
                Guardar paciente
            </button>
        </div>
    </form>
</div>

@endsection