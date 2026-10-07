@extends('layouts.nutriologo')

@section('title', 'Dashboard - ConsultorioNutri')

@section('page-title', 'Dashboard')

@section('page-description', 'Administración general del consultorio y seguimiento de tus pacientes.')

@section('content')

<style>
    /* =========================================================
       DASHBOARD NUTRIÓLOGO
    ========================================================== */

    .dashboard-bienvenida {
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: center;
        gap: 25px;
        padding: 26px 28px;
        margin-bottom: 28px;
        background: #ffffff;
        border: 1px solid var(--borde);
        border-radius: 13px;
        box-shadow: var(--sombra);
    }

    .dashboard-bienvenida-texto h2 {
        margin: 0;
        color: var(--texto);
        font-family: 'Lora', serif;
        font-size: 23px;
        font-weight: 600;
        line-height: 1.3;
    }

    .dashboard-bienvenida-texto p {
        max-width: 700px;
        margin: 7px 0 0;
        color: var(--texto-secundario);
        font-size: 12px;
        line-height: 1.6;
    }

    .dashboard-bienvenida-texto strong {
        color: var(--verde-principal);
        font-weight: 700;
    }

    .dashboard-bienvenida-icono {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--verde-claro);
        color: var(--verde-principal);
        border: 1px solid #CFE3CF;
        border-radius: 13px;
    }

    .dashboard-bienvenida-icono svg {
        width: 29px;
        height: 29px;
    }

    /* =========================================================
       TÍTULOS DE SECCIÓN
    ========================================================== */

    .dashboard-seccion-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 14px;
    }

    .dashboard-seccion-titulo {
        color: var(--texto);
        font-family: 'Lora', serif;
        font-size: 17px;
        font-weight: 600;
    }

    .dashboard-seccion-subtitulo {
        color: var(--texto-secundario);
        font-size: 10px;
        font-weight: 500;
    }

    /* =========================================================
       MÓDULOS PRINCIPALES
    ========================================================== */

    .dashboard-modulos {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }

    .dashboard-modulo {
        min-width: 0;
        display: flex;
        flex-direction: column;
        background: var(--blanco);
        border: 1px solid var(--borde);
        border-radius: 13px;
        padding: 19px;
        box-shadow: var(--sombra);
        transition:
            transform 0.2s ease,
            border-color 0.2s ease;
    }

    .dashboard-modulo:hover {
        transform: translateY(-2px);
        border-color: #C8DAC9;
    }

    .dashboard-modulo-icono {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        background: var(--verde-claro);
        color: var(--verde-principal);
        border-radius: 10px;
    }

    .dashboard-modulo-icono svg {
        width: 21px;
        height: 21px;
    }

    .dashboard-modulo h3 {
        margin: 0 0 6px;
        color: var(--texto);
        font-family: 'Lora', serif;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.3;
    }

    .dashboard-modulo p {
        min-height: 48px;
        margin: 0;
        color: var(--texto-secundario);
        font-size: 10px;
        line-height: 1.55;
    }

    .dashboard-modulo-footer {
        display: flex;
        align-items: center;
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid var(--borde-suave);
    }

    .dashboard-boton {
        min-height: 35px;
        padding: 7px 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        background: var(--verde-principal);
        color: #ffffff;
        border: 1px solid var(--verde-principal);
        border-radius: 8px;
        font-size: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .dashboard-boton:hover {
        background: #5E805F;
        border-color: #5E805F;
        color: #ffffff;
    }

    .dashboard-boton svg {
        width: 13px;
        height: 13px;
    }

    /* =========================================================
       ACCESOS RÁPIDOS
    ========================================================== */

    .dashboard-panel {
        background: var(--blanco);
        border: 1px solid var(--borde);
        border-radius: 13px;
        padding: 20px;
        box-shadow: var(--sombra);
    }

    .dashboard-accesos {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .dashboard-acceso {
        min-width: 0;
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 13px;
        background: #FCFDFC;
        border: 1px solid var(--borde);
        border-radius: 10px;
        text-decoration: none;
        transition:
            background 0.2s ease,
            border-color 0.2s ease;
    }

    .dashboard-acceso:hover {
        background: var(--verde-suave);
        border-color: #C8DAC9;
    }

    .dashboard-acceso-icono {
        width: 36px;
        height: 36px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--verde-claro);
        color: var(--verde-principal);
        border-radius: 8px;
    }

    .dashboard-acceso-icono svg {
        width: 18px;
        height: 18px;
    }

    .dashboard-acceso-texto {
        min-width: 0;
    }

    .dashboard-acceso-texto strong {
        display: block;
        margin-bottom: 2px;
        color: var(--texto);
        font-size: 10px;
        font-weight: 700;
    }

    .dashboard-acceso-texto span {
        display: block;
        color: var(--texto-secundario);
        font-size: 9px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================== */

    @media (max-width: 1150px) {
        .dashboard-modulos {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 800px) {
        .dashboard-bienvenida {
            grid-template-columns: 1fr;
        }

        .dashboard-bienvenida-icono {
            display: none;
        }

        .dashboard-accesos {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .dashboard-modulos {
            grid-template-columns: 1fr;
        }

        .dashboard-bienvenida {
            padding: 20px;
        }

        .dashboard-bienvenida-texto h2 {
            font-size: 20px;
        }

        .dashboard-seccion-header {
            align-items: flex-start;
            flex-direction: column;
            gap: 4px;
        }
    }
</style>

{{-- =========================================================
BIENVENIDA
========================================================== --}}

<section class="dashboard-bienvenida">


<div class="dashboard-bienvenida-texto">

    <h2>
        Bienvenido, {{ auth()->user()->name }}
    </h2>

    <p>
        Has iniciado sesión como
        <strong>nutriólogo</strong>.
        Desde este panel puedes administrar
        la información de tus pacientes, citas,
        expedientes y planes alimenticios.
    </p>

</div>

<div class="dashboard-bienvenida-icono">

    <svg
        viewBox="0 0 24 24"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <path
            d="M20 21V19C20 16.7909 18.2091 15 16 15H8C5.79086 15 4 16.7909 4 19V21"
            stroke="currentColor"
            stroke-width="1.7"
            stroke-linecap="round"
        />

        <circle
            cx="12"
            cy="7"
            r="4"
            stroke="currentColor"
            stroke-width="1.7"
        />
    </svg>

</div>


</section>

{{-- =========================================================
MÓDULOS PRINCIPALES
========================================================== --}}

<div class="dashboard-seccion-header">


<h2 class="dashboard-seccion-titulo">
    Módulos principales
</h2>

<span class="dashboard-seccion-subtitulo">
    Administración del consultorio
</span>


</div>

<section class="dashboard-modulos">


{{-- =====================================================
     PACIENTES
====================================================== --}}

<article class="dashboard-modulo">

    <div class="dashboard-modulo-icono">

        <svg
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >

            <circle
                cx="9"
                cy="7"
                r="4"
                stroke="currentColor"
                stroke-width="1.7"
            />

            <path
                d="M2.5 21C2.9 16.8 5.1 14.5 9 14.5C12.9 14.5 15.1 16.8 15.5 21"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
            />

            <path
                d="M16 4.5C18.5 4.7 20 6.2 20 8.5"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
            />

            <path
                d="M16.5 15C18.7 15.5 20 17.2 20.5 20"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
            />

        </svg>

    </div>

    <h3>
        Pacientes
    </h3>

    <p>
        Consulta y administra la información
        de los pacientes del consultorio.
    </p>

    <div class="dashboard-modulo-footer">

        <a
            href="{{ route('nutriologo.pacientes.index') }}"
            class="dashboard-boton"
        >
            Ver pacientes

            <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M5 12H19"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />

                <path
                    d="M13 6L19 12L13 18"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>

        </a>

    </div>

</article>


{{-- =====================================================
     CITAS
====================================================== --}}

<article class="dashboard-modulo">

    <div class="dashboard-modulo-icono">

        <svg
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >

            <rect
                x="4"
                y="5"
                width="16"
                height="15"
                rx="2"
                stroke="currentColor"
                stroke-width="1.7"
            />

            <path
                d="M8 3V7"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
            />

            <path
                d="M16 3V7"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
            />

            <path
                d="M4 10H20"
                stroke="currentColor"
                stroke-width="1.7"
            />

            <path
                d="M8 14H8.01M12 14H12.01M16 14H16.01M8 17H8.01M12 17H12.01"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
            />

        </svg>

    </div>

    <h3>
        Citas
    </h3>

    <p>
        Consulta las citas programadas y
        administra la agenda del consultorio.
    </p>

    <div class="dashboard-modulo-footer">

        <a
            href="{{ route('nutriologo.citas.index') }}"
            class="dashboard-boton"
        >
            Ver citas

            <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M5 12H19"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />

                <path
                    d="M13 6L19 12L13 18"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>

        </a>

    </div>

</article>


{{-- =====================================================
     PLANES ALIMENTICIOS
====================================================== --}}

<article class="dashboard-modulo">

    <div class="dashboard-modulo-icono">

        <svg
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >

            <path
                d="M7 3H15L19 7V20C19 20.5523 18.5523 21 18 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3Z"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linejoin="round"
            />

            <path
                d="M14 3V8H19"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linejoin="round"
            />

            <path
                d="M8.5 12H15.5"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
            />

            <path
                d="M8.5 16H15.5"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
            />

        </svg>

    </div>

    <h3>
        Planes alimenticios
    </h3>

    <p>
        Administra los planes alimenticios
        asignados a tus pacientes.
    </p>

    <div class="dashboard-modulo-footer">

        <a
            href="{{ route('nutriologo.planes.index') }}"
            class="dashboard-boton"
        >
            Ver planes

            <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M5 12H19"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />

                <path
                    d="M13 6L19 12L13 18"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>

        </a>

    </div>

</article>


{{-- =====================================================
     DÍAS NO LABORABLES
====================================================== --}}

<article class="dashboard-modulo">

    <div class="dashboard-modulo-icono">

        <svg
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >

            <rect
                x="4"
                y="5"
                width="16"
                height="15"
                rx="2"
                stroke="currentColor"
                stroke-width="1.7"
            />

            <path
                d="M8 3V7"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
            />

            <path
                d="M16 3V7"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
            />

            <path
                d="M4 10H20"
                stroke="currentColor"
                stroke-width="1.7"
            />

            <path
                d="M12 13.5V17"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
            />

            <path
                d="M10.25 15.25H13.75"
                stroke="currentColor"
                stroke-width="1.7"
                stroke-linecap="round"
            />

        </svg>

    </div>

    <h3>
        Días no laborables
    </h3>

    <p>
        Registra vacaciones, días festivos
        y fechas de cierre del consultorio.
    </p>

    <div class="dashboard-modulo-footer">

        <a
            href="{{ route('nutriologo.dias-no-laborables.index') }}"
            class="dashboard-boton"
        >
            Administrar

            <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M5 12H19"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                />

                <path
                    d="M13 6L19 12L13 18"
                    stroke="currentColor"
                    stroke-width="1.8"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>

        </a>

    </div>

</article>


</section>

{{-- =========================================================
ACCESOS RÁPIDOS
========================================================== --}}

<div class="dashboard-seccion-header">


<h2 class="dashboard-seccion-titulo">
    Accesos rápidos
</h2>

<span class="dashboard-seccion-subtitulo">
    Herramientas frecuentes
</span>


</div>

<section class="dashboard-panel">


<div class="dashboard-accesos">


    {{-- PACIENTES --}}

    <a
        href="{{ route('nutriologo.pacientes.index') }}"
        class="dashboard-acceso"
    >

        <div class="dashboard-acceso-icono">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >

                <circle
                    cx="12"
                    cy="8"
                    r="4"
                    stroke="currentColor"
                    stroke-width="1.7"
                />

                <path
                    d="M4 21C4.5 16.8 7.1 14.5 12 14.5C16.9 14.5 19.5 16.8 20 21"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                />

            </svg>

        </div>

        <div class="dashboard-acceso-texto">

            <strong>
                Gestionar pacientes
            </strong>

            <span>
                Consultar información
            </span>

        </div>

    </a>


    {{-- CITAS --}}

    <a
        href="{{ route('nutriologo.citas.index') }}"
        class="dashboard-acceso"
    >

        <div class="dashboard-acceso-icono">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >

                <rect
                    x="4"
                    y="5"
                    width="16"
                    height="15"
                    rx="2"
                    stroke="currentColor"
                    stroke-width="1.7"
                />

                <path
                    d="M8 3V7M16 3V7M4 10H20"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                />

            </svg>

        </div>

        <div class="dashboard-acceso-texto">

            <strong>
                Revisar citas
            </strong>

            <span>
                Consultar agenda
            </span>

        </div>

    </a>


    {{-- PLANES --}}

    <a
        href="{{ route('nutriologo.planes.index') }}"
        class="dashboard-acceso"
    >

        <div class="dashboard-acceso-icono">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >

                <path
                    d="M7 3H15L19 7V20C19 20.5523 18.5523 21 18 21H7C5.89543 21 5 20.1046 5 19V5C5 3.89543 5.89543 3 7 3Z"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linejoin="round"
                />

                <path
                    d="M14 3V8H19"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linejoin="round"
                />

                <path
                    d="M8.5 12H15.5M8.5 16H15.5"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                />

            </svg>

        </div>

        <div class="dashboard-acceso-texto">

            <strong>
                Planes alimenticios
            </strong>

            <span>
                Administrar planes
            </span>

        </div>

    </a>


    {{-- DÍAS NO LABORABLES --}}

    <a
        href="{{ route('nutriologo.dias-no-laborables.index') }}"
        class="dashboard-acceso"
    >

        <div class="dashboard-acceso-icono">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >

                <rect
                    x="4"
                    y="5"
                    width="16"
                    height="15"
                    rx="2"
                    stroke="currentColor"
                    stroke-width="1.7"
                />

                <path
                    d="M8 3V7M16 3V7M4 10H20"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                />

                <path
                    d="M12 13V17M10 15H14"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                />

            </svg>

        </div>

        <div class="dashboard-acceso-texto">

            <strong>
                Días no laborables
            </strong>

            <span>
                Administrar calendario
            </span>

        </div>

    </a>


    {{-- EXPEDIENTES --}}

    <a
        href="{{ route('nutriologo.pacientes.index') }}"
        class="dashboard-acceso"
    >

        <div class="dashboard-acceso-icono">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >

                <path
                    d="M6 3H15L19 7V20C19 20.5523 18.5523 21 18 21H6C5.44772 21 5 20.5523 5 20V4C5 3.44772 5.44772 3 6 3Z"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linejoin="round"
                />

                <path
                    d="M14 3V8H19"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linejoin="round"
                />

                <path
                    d="M8 12H16M8 16H14"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                />

            </svg>

        </div>

        <div class="dashboard-acceso-texto">

            <strong>
                Expedientes clínicos
            </strong>

            <span>
                Consultar desde pacientes
            </span>

        </div>

    </a>


    {{-- EVALUACIONES --}}

    <a
        href="{{ route('nutriologo.pacientes.index') }}"
        class="dashboard-acceso"
    >

        <div class="dashboard-acceso-icono">

            <svg
                viewBox="0 0 24 24"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >

                <path
                    d="M5 20V4"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                />

                <path
                    d="M5 5C8 3 10 7 13 5C16 3 18 5 20 4V14C18 15 16 13 13 15C10 17 8 13 5 15"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />

            </svg>

        </div>

        <div class="dashboard-acceso-texto">

            <strong>
                Evaluaciones
            </strong>

            <span>
                Seguimiento nutricional
            </span>

        </div>

    </a>


</div>


</section>

@endsection
