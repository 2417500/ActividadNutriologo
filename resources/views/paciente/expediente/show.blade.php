@extends('layouts.paciente')

@section('title', 'Mi Expediente - ConsultorioNutri')

@section('page-title', 'Mi Expediente Clínico')

@section('page-description', 'Consulta y actualiza la información registrada en tu expediente clínico.')

@section('content')

{{-- =========================================================
     VISTA DE CONSULTA DEL EXPEDIENTE
========================================================= --}}
<div id="vista-expediente">

    {{-- ENCABEZADO DEL EXPEDIENTE --}}
    <section class="encabezado-expediente">
        <div class="encabezado-icono">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </div>

        <div class="encabezado-texto">
            <h2>Información de mi expediente</h2>
            <p>Aquí puedes consultar la información personal, médica y nutricional registrada en el consultorio.</p>
        </div>

        <div class="encabezado-estado">
            @if($expediente)
                <span class="estado estado-exito">
                    <span class="estado-punto"></span>
                    Expediente registrado
                </span>
            @else
                <span class="estado estado-pendiente">
                    <span class="estado-punto"></span>
                    Pendiente de completar
                </span>
            @endif
        </div>
    </section>

    @if($expediente)

        {{-- INFORMACIÓN PERSONAL --}}
        <section class="seccion-expediente">
            <div class="titulo-seccion">
                <div class="titulo-seccion-principal">
                    <div class="titulo-icono">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="7" r="4"/>
                            <path d="M5.5 21a6.5 6.5 0 0 1 13 0"/>
                        </svg>
                    </div>
                    <div>
                        <h2>Información personal</h2>
                        <p>Datos básicos registrados en tu expediente.</p>
                    </div>
                </div>
            </div>

            <div class="datos-grid">
                <article class="dato-card">
                    <div class="dato-icono">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2"/>
                            <line x1="16" y1="2" x2="16" y2="6"/>
                            <line x1="8" y1="2" x2="8" y2="6"/>
                            <line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                    </div>
                    <div class="dato-contenido">
                        <span class="dato-label">Fecha de nacimiento</span>
                        <span class="dato-valor">
                            {{ $expediente->fecha_nacimiento?->format('d/m/Y') ?? 'Sin registrar' }}
                        </span>
                    </div>
                </article>

                <article class="dato-card">
                    <div class="dato-icono">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="4"/>
                            <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2"/>
                        </svg>
                    </div>
                    <div class="dato-contenido">
                        <span class="dato-label">Horas de sueño</span>
                        <span class="dato-valor">
                            {{ $expediente->horas_sueno ?? 'Sin registrar' }} @if($expediente->horas_sueno) horas @endif
                        </span>
                    </div>
                </article>
            </div>
        </section>

        {{-- ANTECEDENTES Y SALUD --}}
        <section class="seccion-expediente">
            <div class="titulo-seccion">
                <div class="titulo-seccion-principal">
                    <div class="titulo-icono">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14 2 14 8 20 8"/>
                        </svg>
                    </div>
                    <div>
                        <h2>Antecedentes clínicos</h2>
                        <p>Historial médico, familiar y tratamientos.</p>
                    </div>
                </div>
            </div>

            <div class="texto-grid">
                <article class="texto-card">
                    <div class="texto-card-header">
                        <div class="texto-icono">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/></svg>
                        </div>
                        <h3>Antecedentes médicos</h3>
                    </div>
                    <p>{{ $expediente->antecedentes_medicos ?: 'Sin registrar' }}</p>
                </article>

                <article class="texto-card">
                    <div class="texto-card-header">
                        <div class="texto-icono">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/></svg>
                        </div>
                        <h3>Antecedentes familiares</h3>
                    </div>
                    <p>{{ $expediente->antecedentes_familiares ?: 'Sin registrar' }}</p>
                </article>

                <article class="texto-card">
                    <div class="texto-card-header">
                        <div class="texto-icono">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                        </div>
                        <h3>Alergias</h3>
                    </div>
                    <p>{{ $expediente->alergias ?: 'Sin registrar' }}</p>
                </article>

                <article class="texto-card">
                    <div class="texto-card-header">
                        <div class="texto-icono">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
                        </div>
                        <h3>Medicamentos</h3>
                    </div>
                    <p>{{ $expediente->medicamentos ?: 'Sin registrar' }}</p>
                </article>

                <article class="texto-card" style="grid-column: 1 / -1;">
                    <div class="texto-card-header">
                        <div class="texto-icono">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                        </div>
                        <h3>Intolerancias</h3>
                    </div>
                    <p>{{ $expediente->intolerancias ?: 'Sin registrar' }}</p>
                </article>
            </div>
        </section>

        {{-- HÁBITOS --}}
        <section class="seccion-expediente">
            <div class="titulo-seccion">
                <div class="titulo-seccion-principal">
                    <div class="titulo-icono">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3h18v18H3z"/></svg>
                    </div>
                    <div>
                        <h2>Hábitos y Alimentación</h2>
                        <p>Información de nutrición y rutina física diaria.</p>
                    </div>
                </div>
            </div>

            <div class="texto-grid">
                <article class="texto-card">
                    <div class="texto-card-header">
                        <div class="texto-icono"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20"/></svg></div>
                        <h3>Hábitos alimenticios</h3>
                    </div>
                    <p>{{ $expediente->habitos_alimenticios ?: 'Sin registrar' }}</p>
                </article>

                <article class="texto-card">
                    <div class="texto-card-header">
                        <div class="texto-icono"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg></div>
                        <h3>Preferencias alimenticias</h3>
                    </div>
                    <p>{{ $expediente->preferencias_alimenticias ?: 'Sin registrar' }}</p>
                </article>

                <article class="texto-card" style="grid-column: 1 / -1;">
                    <div class="texto-card-header">
                        <div class="texto-icono"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3v18"/></svg></div>
                        <h3>Actividad física</h3>
                    </div>
                    <p>{{ $expediente->actividad_fisica ?: 'Sin registrar' }}</p>
                </article>
            </div>
        </section>

        {{-- OBJETIVOS --}}
        <section class="seccion-expediente">
            <div class="titulo-seccion">
                <div class="titulo-seccion-principal">
                    <div class="titulo-icono">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/></svg>
                    </div>
                    <div>
                        <h2>Objetivos Nutricionales</h2>
                        <p>Metas que deseas alcanzar en tu tratamiento.</p>
                    </div>
                </div>
            </div>

            <article class="objetivo-card">
                <div class="objetivo-icono">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>
                </div>
                <div>
                    <span class="dato-label">Mis objetivos</span>
                    <p class="objetivo-texto">{{ $expediente->objetivos_nutricionales ?: 'Sin registrar' }}</p>
                </div>
            </article>
        </section>

        {{-- BOTONES DE ACCIÓN (COMPACTOS Y ALINEADOS) --}}
        <div class="acciones-expediente">
            <button type="button" class="boton boton-principal" onclick="mostrarFormulario()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"/></svg>
                Actualizar expediente
            </button>

            <a href="{{ route('paciente.dashboard') }}" class="boton-secundario">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Regresar
            </a>
        </div>

    @else

        {{-- EXPEDIENTE VACÍO --}}
        <section class="vacio-expediente">
            <div class="vacio-icono">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
            </div>
            <h2>Tu expediente está pendiente</h2>
            <p>Todavía no hay información registrada en tu expediente clínico. Completa los datos para que el consultorio pueda conocer mejor tus antecedentes y metas.</p>

            <button type="button" class="boton" onclick="mostrarFormulario()">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                Completar expediente
            </button>
        </section>

    @endif
</div>

{{-- =========================================================
     FORMULARIO DE EDICIÓN
========================================================= --}}
<div id="formulario-expediente" class="formulario-contenedor" style="display: none;">
    <section class="formulario-card card">
        <div class="formulario-header card-header">
            <div>
                <h2 class="card-title">Actualizar Expediente</h2>
                <p class="card-description">Completa o modifica la información de tu expediente clínico</p>
            </div>
        </div>

        <form action="{{ route('paciente.expediente.update') }}" method="POST" class="formulario">
            @csrf
            @method('PUT')

            {{-- INFORMACIÓN PERSONAL --}}
            <div class="formulario-seccion">
                <div class="formulario-seccion-titulo">
                    <span class="numero-seccion">1</span>
                    <div>
                        <h3>Información personal</h3>
                        <p>Datos básicos</p>
                    </div>
                </div>

                <div class="campos-grid">
                    <div class="campo">
                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $expediente?->fecha_nacimiento?->format('Y-m-d')) }}">
                        @error('fecha_nacimiento')<span class="error-campo">{{ $message }}</span>@enderror
                    </div>

                    <div class="campo">
                        <label for="horas_sueno">Horas de sueño</label>
                        <input type="number" id="horas_sueno" name="horas_sueno" min="0" max="24" step="0.5" value="{{ old('horas_sueno', $expediente?->horas_sueno) }}" placeholder="Ej. 8">
                        @error('horas_sueno')<span class="error-campo">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- ANTECEDENTES --}}
            <div class="formulario-seccion">
                <div class="formulario-seccion-titulo">
                    <span class="numero-seccion">2</span>
                    <div>
                        <h3>Antecedentes</h3>
                        <p>Información médica y familiar</p>
                    </div>
                </div>

                <div class="campo">
                    <label for="antecedentes_medicos">Antecedentes médicos</label>
                    <textarea id="antecedentes_medicos" name="antecedentes_medicos" rows="3" placeholder="Describe enfermedades, cirugías u otros antecedentes.">{{ old('antecedentes_medicos', $expediente?->antecedentes_medicos) }}</textarea>
                    @error('antecedentes_medicos')<span class="error-campo">{{ $message }}</span>@enderror
                </div>

                <div class="campo">
                    <label for="antecedentes_familiares">Antecedentes familiares</label>
                    <textarea id="antecedentes_familiares" name="antecedentes_familiares" rows="3" placeholder="Describe enfermedades importantes en tu familia.">{{ old('antecedentes_familiares', $expediente?->antecedentes_familiares) }}</textarea>
                    @error('antecedentes_familiares')<span class="error-campo">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- ALERGIAS Y MEDICAMENTOS --}}
            <div class="formulario-seccion">
                <div class="formulario-seccion-titulo">
                    <span class="numero-seccion">3</span>
                    <div>
                        <h3>Alergias y medicamentos</h3>
                        <p>Información de atención médica</p>
                    </div>
                </div>

                <div class="campos-grid">
                    <div class="campo">
                        <label for="alergias">Alergias</label>
                        <textarea id="alergias" name="alergias" rows="3" placeholder="Indica alergias alimenticias o médicas.">{{ old('alergias', $expediente?->alergias) }}</textarea>
                        @error('alergias')<span class="error-campo">{{ $message }}</span>@enderror
                    </div>

                    <div class="campo">
                        <label for="medicamentos">Medicamentos</label>
                        <textarea id="medicamentos" name="medicamentos" rows="3" placeholder="Indica medicamentos que consumes.">{{ old('medicamentos', $expediente?->medicamentos) }}</textarea>
                        @error('medicamentos')<span class="error-campo">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="campo">
                    <label for="intolerancias">Intolerancias</label>
                    <textarea id="intolerancias" name="intolerancias" rows="2" placeholder="Alimentos que te causen intolerancia.">{{ old('intolerancias', $expediente?->intolerancias) }}</textarea>
                    @error('intolerancias')<span class="error-campo">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- HÁBITOS --}}
            <div class="formulario-seccion">
                <div class="formulario-seccion-titulo">
                    <span class="numero-seccion">4</span>
                    <div>
                        <h3>Hábitos y alimentación</h3>
                        <p>Hábitos diarios y actividad física</p>
                    </div>
                </div>

                <div class="campo">
                    <label for="habitos_alimenticios">Hábitos alimenticios</label>
                    <textarea id="habitos_alimenticios" name="habitos_alimenticios" rows="3" placeholder="Horarios de comida, frecuencia...">{{ old('habitos_alimenticios', $expediente?->habitos_alimenticios) }}</textarea>
                    @error('habitos_alimenticios')<span class="error-campo">{{ $message }}</span>@enderror
                </div>

                <div class="campo">
                    <label for="preferencias_alimenticias">Preferencias alimenticias</label>
                    <textarea id="preferencias_alimenticias" name="preferencias_alimenticias" rows="3" placeholder="Alimentos de preferencia o que prefieres evitar.">{{ old('preferencias_alimenticias', $expediente?->preferencias_alimenticias) }}</textarea>
                    @error('preferencias_alimenticias')<span class="error-campo">{{ $message }}</span>@enderror
                </div>

                <div class="campo">
                    <label for="actividad_fisica">Actividad física</label>
                    <textarea id="actividad_fisica" name="actividad_fisica" rows="3" placeholder="Tipo y frecuencia de actividad física.">{{ old('actividad_fisica', $expediente?->actividad_fisica) }}</textarea>
                    @error('actividad_fisica')<span class="error-campo">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- OBJETIVOS --}}
            <div class="formulario-seccion">
                <div class="formulario-seccion-titulo">
                    <span class="numero-seccion">5</span>
                    <div>
                        <h3>Objetivos nutricionales</h3>
                        <p>Tus metas de salud</p>
                    </div>
                </div>

                <div class="campo">
                    <label for="objetivos_nutricionales">Objetivos nutricionales</label>
                    <textarea id="objetivos_nutricionales" name="objetivos_nutricionales" rows="4" placeholder="Bajar de peso, aumentar masa muscular, mejorar digestión...">{{ old('objetivos_nutricionales', $expediente?->objetivos_nutricionales) }}</textarea>
                    @error('objetivos_nutricionales')<span class="error-campo">{{ $message }}</span>@enderror
                </div>
            </div>

            {{-- ACCIONES DE FORMULARIO --}}
            <div class="formulario-acciones">
                <button type="submit" class="boton">
                    Guardar expediente
                </button>

                <button type="button" class="boton-secundario" onclick="ocultarFormulario()">
                    Cancelar
                </button>
            </div>
        </form>
    </section>
</div>

@endsection

@push('styles')
<style>
    /* =====================================================
       AJUSTES ESPECÍFICOS Y COMPACTOS PARA EL EXPEDIENTE
    ===================================================== */

    .encabezado-expediente {
        background: var(--blanco);
        border: 1px solid var(--borde);
        border-radius: var(--radio);
        padding: 18px 22px;
        margin-bottom: 22px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .encabezado-icono {
        width: 40px !important;
        height: 40px !important;
        border-radius: 10px;
        background: var(--verde-suave);
        color: var(--verde-principal);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .encabezado-icono svg {
        width: 20px !important;
        height: 20px !important;
    }

    .encabezado-texto { flex: 1; min-width: 0; }
    .encabezado-texto h2 { margin: 0 0 3px; font-size: 17px; color: var(--texto); font-family: 'Lora', serif; }
    .encabezado-texto p { margin: 0; color: var(--texto-secundario); font-size: 11px; }

    .seccion-expediente {
        background: var(--blanco);
        border: 1px solid var(--borde);
        border-radius: var(--radio);
        padding: 20px;
        margin-bottom: 18px;
    }

    .titulo-seccion-principal { display: flex; align-items: center; gap: 10px; margin-bottom: 16px; }
    
    .titulo-icono {
        width: 32px !important;
        height: 32px !important;
        border-radius: 8px;
        background: var(--verde-claro);
        color: var(--verde-principal);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .titulo-icono svg {
        width: 16px !important;
        height: 16px !important;
    }

    .datos-grid, .texto-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .dato-card {
        border: 1px solid var(--borde-suave);
        border-radius: 10px;
        padding: 12px 14px !important;
        background: var(--fondo);
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .dato-icono {
        width: 34px !important;
        height: 34px !important;
        border-radius: 8px;
        background: var(--verde-claro);
        color: var(--verde-principal);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .dato-icono svg {
        width: 18px !important;
        height: 18px !important;
        max-width: 18px !important;
        max-height: 18px !important;
    }

    .dato-label { display: block; color: var(--texto-secundario); font-size: 10px; font-weight: 700; text-transform: uppercase; margin-bottom: 2px; }
    .dato-valor { display: block; color: var(--texto); font-size: 12px; font-weight: 600; }

    .texto-card {
        border: 1px solid var(--borde-suave);
        border-radius: 10px;
        padding: 12px 14px !important;
        background: var(--fondo);
    }

    .texto-icono {
        width: 28px !important;
        height: 28px !important;
        border-radius: 7px;
        background: var(--verde-claro);
        color: var(--verde-principal);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .texto-icono svg {
        width: 15px !important;
        height: 15px !important;
    }

    .texto-card-header { display: flex; align-items: center; gap: 8px; margin-bottom: 6px; }
    .texto-card h3 { font-size: 12px; font-weight: 600; color: var(--texto); margin: 0; }
    .texto-card p { margin: 0; color: var(--texto-secundario); font-size: 11px; line-height: 1.5; white-space: pre-line; }

    .objetivo-card {
        border: 1px solid var(--borde);
        background: var(--verde-suave);
        border-radius: 10px;
        padding: 14px 16px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .objetivo-icono {
        width: 32px !important;
        height: 32px !important;
        border-radius: 8px;
        background: var(--verde-claro);
        color: var(--verde-principal);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .objetivo-icono svg { width: 16px !important; height: 16px !important; }
    .objetivo-texto { margin: 0; color: var(--texto); font-size: 11px; line-height: 1.5; white-space: pre-line; }

    /* =====================================================
       ESTILOS DE BOTONES COMPACTOS DE ACCIÓN
    ===================================================== */
    .acciones-expediente {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
    }

    .acciones-expediente .boton,
    .acciones-expediente .boton-principal,
    .acciones-expediente .boton-secundario {
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
        box-sizing: border-box !important;
    }

    .acciones-expediente .boton svg,
    .acciones-expediente .boton-principal svg,
    .acciones-expediente .boton-secundario svg {
        width: 14px !important;
        height: 14px !important;
        max-width: 14px !important;
        max-height: 14px !important;
        flex-shrink: 0 !important;
    }

    .vacio-expediente {
        background: var(--blanco);
        border: 1px dashed var(--borde);
        border-radius: var(--radio);
        padding: 40px 20px;
        text-align: center;
    }

    .vacio-icono {
        width: 48px !important;
        height: 48px !important;
        border-radius: 10px;
        background: var(--verde-claro);
        color: var(--verde-principal);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 14px;
    }

    .vacio-icono svg { width: 22px !important; height: 22px !important; }

    /* FORMULARIO */
    .formulario-seccion { padding-bottom: 18px; margin-bottom: 18px; border-bottom: 1px solid var(--borde-suave); }
    .formulario-seccion-titulo { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; }
    
    .numero-seccion {
        width: 26px; height: 26px; border-radius: 6px;
        background: var(--verde-claro); color: var(--verde-principal);
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 700;
    }

    .campos-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 14px; }
    .error-campo { color: var(--cancelado); font-size: 10px; margin-top: 4px; display: block; }
    .formulario-acciones { display: flex; gap: 10px; justify-content: flex-end; padding-top: 12px; }

    @media (max-width: 768px) {
        .datos-grid, .texto-grid, .campos-grid { grid-template-columns: 1fr; }
        .texto-card[style*="grid-column"] { grid-column: auto !important; }
    }
</style>
@endpush

@push('scripts')
<script>
    function mostrarFormulario() {
        document.getElementById('vista-expediente').style.display = 'none';
        document.getElementById('formulario-expediente').style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function ocultarFormulario() {
        document.getElementById('formulario-expediente').style.display = 'none';
        document.getElementById('vista-expediente').style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    document.addEventListener('DOMContentLoaded', function () {
        @if($errors->any())
            mostrarFormulario();
        @endif
    });
</script>
@endpush