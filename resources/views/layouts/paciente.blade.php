<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'ConsultorioNutri')
    </title>


    {{-- =========================================================
         FUENTES
    ========================================================== --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:wght@500;600;700&display=swap"
        rel="stylesheet"
    >


    <style>

        /* =========================================================
           VARIABLES
        ========================================================== */

        :root {

            --verde-principal: #6B8F6B;
            --verde-claro: #DFF0D8;
            --verde-suave: #EAF5E7;

            --fondo: #F7FAF7;
            --blanco: #FFFFFF;

            --texto: #39443A;
            --texto-secundario: #718074;

            --borde: #DEE7DF;
            --borde-suave: #E9EFEA;

            --exito: #4F7D59;
            --exito-fondo: #E6F3E8;

            --pendiente: #A37A31;
            --pendiente-fondo: #F8F1DE;

            --cancelado: #A85C5C;
            --cancelado-fondo: #F8EAEA;

            --sidebar-width: 250px;
            --topbar-height: 76px;

            --radio: 13px;

            --sombra:
                0 2px 10px rgba(57, 68, 58, 0.045);
        }


        /* =========================================================
           RESET
        ========================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {

            min-height: 100vh;

            background: var(--fondo);

            color: var(--texto);

            font-family: 'Inter', sans-serif;

            font-size: 14px;

            line-height: 1.5;
        }


        a {
            color: inherit;
            text-decoration: none;
        }


        button,
        input,
        select,
        textarea {
            font-family: 'Inter', sans-serif;
        }


        /* =========================================================
           ESTRUCTURA
        ========================================================== */

        .app {
            min-height: 100vh;
        }


        .main {

            min-height: 100vh;

            margin-left: var(--sidebar-width);
        }


        /* =========================================================
           SIDEBAR
        ========================================================== */

        .sidebar {

            position: fixed;

            top: 0;
            left: 0;

            width: var(--sidebar-width);
            height: 100vh;

            background: var(--blanco);

            border-right: 1px solid var(--borde);

            display: flex;
            flex-direction: column;

            z-index: 1000;
        }


        /* =========================================================
           LOGO
        ========================================================== */

        .sidebar-header {

            height: var(--topbar-height);

            padding: 0 20px;

            display: flex;
            align-items: center;

            border-bottom: 1px solid var(--borde-suave);
        }


        .logo {

            display: flex;
            align-items: center;

            gap: 12px;

            width: 100%;
        }


        .logo-icon {

            width: 40px;
            height: 40px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--verde-claro);

            color: var(--verde-principal);

            border: 1px solid #CFE3CF;

            border-radius: 11px;

            font-size: 14px;
            font-weight: 700;
        }


        .logo-title {

            color: var(--texto);

            font-family: 'Lora', serif;

            font-size: 17px;
            font-weight: 700;

            line-height: 1.2;

            white-space: nowrap;
        }


        /* =========================================================
           PANEL DEL PACIENTE
        ========================================================== */

        .panel-identidad {

            margin: 22px 16px 18px;

            min-height: 70px;

            padding: 13px;

            display: flex;
            align-items: center;

            gap: 11px;

            background: #F7FAF7;

            border: 1px solid var(--borde);

            border-radius: 12px;
        }


        .panel-icon {

            width: 40px;
            height: 40px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--verde-claro);

            color: var(--verde-principal);

            border-radius: 10px;
        }


        .panel-icon svg {

            width: 21px;
            height: 21px;
        }


        .panel-identidad-texto {

            min-width: 0;

            display: flex;
            flex-direction: column;

            justify-content: center;
        }


        .panel-label {

            color: var(--texto);

            font-size: 12px;
            font-weight: 700;

            line-height: 1.3;
        }


        .panel-description {

            color: var(--texto-secundario);

            font-size: 10px;

            line-height: 1.3;

            margin-top: 3px;
        }


        /* =========================================================
           NAVEGACIÓN
        ========================================================== */

        .sidebar-nav {

            flex: 1;

            padding: 0 15px 20px;

            overflow-y: auto;
        }


        .nav-section {

            margin-bottom: 25px;
        }


        .nav-section-title {

            padding: 0 10px;

            margin-bottom: 8px;

            color: #929D94;

            font-size: 10px;
            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: 1px;
        }


        .nav-link {

            position: relative;

            width: 100%;

            min-height: 42px;

            display: flex;
            align-items: center;

            gap: 11px;

            padding: 8px 10px;

            margin-bottom: 4px;

            border-radius: 10px;

            color: var(--texto-secundario);

            font-size: 12px;
            font-weight: 500;

            transition:
                background 0.2s ease,
                color 0.2s ease;
        }


        .nav-link:hover {

            background: var(--verde-suave);

            color: var(--verde-principal);
        }


        .nav-link.active {

            background: var(--verde-claro);

            color: var(--verde-principal);

            font-weight: 700;
        }


        .nav-link.active::before {

            content: "";

            position: absolute;

            left: 0;
            top: 9px;
            bottom: 9px;

            width: 3px;

            background: var(--verde-principal);

            border-radius: 0 3px 3px 0;
        }


        /* =========================================================
           ICONOS DE NAVEGACIÓN
        ========================================================== */

        .nav-icon {

            width: 25px;
            height: 25px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            color: currentColor;

            border: 1px solid currentColor;

            border-radius: 7px;

            font-size: 10px;
            font-weight: 600;

            opacity: 0.85;
        }


        /* =========================================================
           USUARIO DEL SIDEBAR
        ========================================================== */

        .sidebar-footer {

            padding: 14px 15px;

            border-top: 1px solid var(--borde-suave);
        }


        .user-mini {

            min-height: 48px;

            display: flex;
            align-items: center;

            gap: 10px;

            padding: 5px 7px;
        }


        .user-avatar {

            width: 36px;
            height: 36px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--verde-claro);

            color: var(--verde-principal);

            border-radius: 50%;

            font-size: 10px;
            font-weight: 700;
        }


        .user-info {
            min-width: 0;
        }


        .user-name {

            color: var(--texto);

            font-size: 11px;
            font-weight: 600;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .user-role {

            color: var(--texto-secundario);

            font-size: 9px;

            margin-top: 2px;
        }


        /* =========================================================
           TOPBAR (CORREGIDO Y SIN TRASLAPE)
        ========================================================== */

        .topbar {

            min-height: var(--topbar-height);

            padding: 12px 30px;

            background: rgba(255, 255, 255, 0.97);

            border-bottom: 1px solid var(--borde);

            display: flex;
            align-items: center;
            justify-content: space-between;

            position: relative;

            z-index: 900;
        }


        .topbar-left {

            display: flex;
            flex-direction: column;

            justify-content: center;
        }


        .topbar-date {

            color: var(--texto-secundario);

            font-size: 11px;
            font-weight: 500;
        }


        .topbar-user {

            display: flex;
            align-items: center;

            gap: 11px;
        }


        .topbar-user-info {

            text-align: right;
        }


        .topbar-user-name {

            color: var(--texto);

            font-size: 11px;
            font-weight: 600;

            line-height: 1.3;
        }


        .topbar-user-role {

            color: var(--texto-secundario);

            font-size: 9px;

            margin-top: 2px;
        }


        .topbar-avatar {

            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: var(--verde-claro);

            color: var(--verde-principal);

            border-radius: 50%;

            font-size: 11px;
            font-weight: 700;
        }


        /* =========================================================
           CONTENIDO
        ========================================================== */

        .content {

            width: 100%;

            max-width: 1480px;

            margin: 0 auto;

            padding: 30px 34px 50px;
        }


        /* =========================================================
           ENCABEZADO DE PÁGINA
        ========================================================== */

        .page-header {

            margin-bottom: 22px;
        }


        .page-title {

            color: var(--texto);

            font-family: 'Lora', serif;

            font-size: 24px;
            font-weight: 600;

            line-height: 1.3;

            letter-spacing: -0.3px;
        }


        .page-description {

            max-width: 750px;

            margin-top: 4px;

            color: var(--texto-secundario);

            font-size: 12px;
        }


        /* =========================================================
           CARDS Y COMPONENTES GLOBALES
        ========================================================== */

        .card {

            background: var(--blanco);

            border: 1px solid var(--borde);

            border-radius: var(--radio);

            padding: 20px;

            box-shadow: var(--sombra);
        }


        .card + .card {

            margin-top: 18px;
        }


        .card-header {

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 16px;
        }


        .card-title {

            color: var(--texto);

            font-family: 'Lora', serif;

            font-size: 16px;
            font-weight: 600;
        }


        .card-description {

            color: var(--texto-secundario);

            font-size: 11px;

            margin-top: 3px;
        }


        /* =========================================================
           BOTONES COMPACTOS DE ESTÁNDAR GLOBAL
        ========================================================== */

        .boton {

            min-height: 38px;
            height: 38px;

            padding: 0 16px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            border: 1px solid var(--verde-principal);

            border-radius: 9px;

            background: var(--verde-principal);

            color: var(--blanco);

            font-size: 11px;
            font-weight: 600;

            cursor: pointer;

            transition: 0.2s ease;

            box-sizing: border-box;
        }


        .boton:hover {

            background: #5E805F;

            border-color: #5E805F;
        }


        .boton svg {

            width: 14px;
            height: 14px;

            flex-shrink: 0;
        }


        .boton-secundario {

            min-height: 38px;
            height: 38px;

            padding: 0 16px;

            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;

            border: 1px solid var(--borde);

            border-radius: 9px;

            background: var(--blanco);

            color: var(--texto);

            font-size: 11px;
            font-weight: 600;

            cursor: pointer;

            transition: 0.2s ease;

            box-sizing: border-box;
        }


        .boton-secundario:hover {

            background: var(--verde-suave);

            color: var(--verde-principal);
        }


        .boton-secundario svg {

            width: 14px;
            height: 14px;

            flex-shrink: 0;
        }


        /* =========================================================
           TABLAS
        ========================================================== */

        .tabla-contenedor {

            width: 100%;

            overflow-x: auto;

            border: 1px solid var(--borde);

            border-radius: 11px;
        }


        .tabla {

            width: 100%;

            min-width: 650px;

            border-collapse: collapse;
        }


        .tabla th {

            padding: 12px 14px;

            background: #FAFCFA;

            border-bottom: 1px solid var(--borde);

            color: var(--texto-secundario);

            font-size: 9px;
            font-weight: 700;

            text-align: left;

            text-transform: uppercase;

            letter-spacing: 0.4px;
        }


        .tabla td {

            padding: 13px 14px;

            border-bottom: 1px solid var(--borde-suave);

            color: var(--texto);

            font-size: 11px;
        }


        .tabla tbody tr:last-child td {

            border-bottom: none;
        }


        .tabla tbody tr:hover {

            background: #FBFDFB;
        }


        /* =========================================================
           ESTADOS
        ========================================================== */

        .estado {

            min-height: 24px;

            padding: 3px 9px;

            display: inline-flex;
            align-items: center;

            border-radius: 20px;

            font-size: 9px;
            font-weight: 700;

            white-space: nowrap;
        }


        .estado-confirmada,
        .estado-confirmado,
        .estado-completada,
        .estado-completado,
        .estado-activa,
        .estado-activo {

            background: var(--exito-fondo);

            color: var(--exito);
        }


        .estado-pendiente {

            background: var(--pendiente-fondo);

            color: var(--pendiente);
        }


        .estado-cancelada,
        .estado-cancelado,
        .estado-inactiva,
        .estado-inactivo {

            background: var(--cancelado-fondo);

            color: var(--cancelado);
        }


        /* =========================================================
           FORMULARIOS
        ========================================================== */

        .form-grid {

            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 16px;
        }


        .campo {

            display: flex;
            flex-direction: column;

            gap: 6px;
        }


        .campo-completo {

            grid-column: 1 / -1;
        }


        .campo label {

            color: var(--texto);

            font-size: 10px;
            font-weight: 700;
        }


        .campo input,
        .campo select,
        .campo textarea {

            width: 100%;

            border: 1px solid var(--borde);

            border-radius: 9px;

            background: var(--blanco);

            color: var(--texto);

            font-size: 11px;

            outline: none;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }


        .campo input,
        .campo select {

            min-height: 38px;

            padding: 8px 12px;
        }


        .campo textarea {

            min-height: 95px;

            padding: 10px 12px;

            resize: vertical;
        }


        .campo input:focus,
        .campo select:focus,
        .campo textarea:focus {

            border-color: var(--verde-principal);

            box-shadow:
                0 0 0 3px rgba(107, 143, 107, 0.10);
        }


        .campo input::placeholder,
        .campo textarea::placeholder {

            color: #A2ADA4;
        }


        .form-acciones {

            grid-column: 1 / -1;

            display: flex;
            justify-content: flex-end;

            gap: 9px;

            padding-top: 5px;
        }


        /* =========================================================
           ALERTAS
        ========================================================== */

        .alerta {

            padding: 12px 15px;

            margin-bottom: 18px;

            border-radius: 10px;

            font-size: 11px;
            font-weight: 500;
        }


        .alerta-exito {

            background: var(--exito-fondo);

            color: var(--exito);

            border: 1px solid #CBE5CE;
        }


        .alerta-error {

            background: var(--cancelado-fondo);

            color: var(--cancelado);

            border: 1px solid #EACCCC;
        }


        /* =========================================================
           ESTADO VACÍO
        ========================================================== */

        .vacio {

            padding: 40px 20px;

            text-align: center;

            background: var(--blanco);

            border: 1px dashed #CBD9CD;

            border-radius: var(--radio);
        }


        .vacio-titulo {

            color: var(--texto);

            font-family: 'Lora', serif;

            font-size: 15px;
            font-weight: 600;
        }


        .vacio-texto {

            margin-top: 4px;

            color: var(--texto-secundario);

            font-size: 11px;
        }


        /* =========================================================
           SCROLLBAR
        ========================================================== */

        ::-webkit-scrollbar {

            width: 7px;
            height: 7px;
        }


        ::-webkit-scrollbar-track {

            background: var(--fondo);
        }


        ::-webkit-scrollbar-thumb {

            background: #C7D3C8;

            border-radius: 10px;
        }


        ::-webkit-scrollbar-thumb:hover {

            background: #AEBCAE;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 850px) {

            :root {

                --sidebar-width: 70px;
            }


            .sidebar-header {

                padding: 0;

                justify-content: center;
            }


            .logo {

                justify-content: center;
            }


            .logo-title {

                display: none;
            }


            .panel-identidad {

                margin: 18px 8px;

                padding: 8px 0;

                min-height: auto;

                justify-content: center;

                background: transparent;

                border-color: transparent;
            }


            .panel-identidad-texto {

                display: none;
            }


            .sidebar-nav {

                padding: 0 8px 18px;
            }


            .nav-section-title {

                display: none;
            }


            .nav-link {

                justify-content: center;

                padding: 9px;
            }


            .nav-link.active::before {

                display: none;
            }


            .user-mini {

                justify-content: center;
            }


            .user-info {

                display: none;
            }


            .main {

                margin-left: var(--sidebar-width);
            }


            .topbar {

                padding: 12px 22px;
            }


            .content {

                padding: 25px 22px 40px;
            }
        }


        @media (max-width: 650px) {

            .topbar {

                padding: 12px 15px;
            }


            .topbar-user-info {

                display: none;
            }


            .content {

                padding: 20px 15px 35px;
            }


            .page-title {

                font-size: 21px;
            }


            .form-grid {

                grid-template-columns: 1fr;
            }


            .campo-completo,
            .form-acciones {

                grid-column: auto;
            }


            .form-acciones {

                flex-direction: column;
            }


            .form-acciones .boton,
            .form-acciones .boton-secundario {

                width: 100%;
            }


            .card {

                padding: 16px;
            }
        }

    </style>


    @stack('styles')

</head>


<body>


<div class="app">


    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}

    <aside class="sidebar">


        {{-- =====================================================
             LOGO
        ====================================================== --}}

        <div class="sidebar-header">

            <a
                href="{{ route('paciente.dashboard') }}"
                class="logo"
            >

                <div class="logo-icon">
                    CN
                </div>


                <div class="logo-title">
                    ConsultorioNutri
                </div>

            </a>

        </div>


        {{-- =====================================================
             PANEL DEL PACIENTE
        ====================================================== --}}

        <div class="panel-identidad">


            <div class="panel-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                >

                    <circle
                        cx="12"
                        cy="8"
                        r="3.2"
                        stroke="currentColor"
                        stroke-width="1.7"
                    />

                    <path
                        d="M5.5 20C5.9 16.5 8.1 14.5 12 14.5C15.9 14.5 18.1 16.5 18.5 20"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                    />

                </svg>

            </div>


            <div class="panel-identidad-texto">

                <span class="panel-label">
                    Panel del paciente
                </span>


                <span class="panel-description">
                    Mi atención nutricional
                </span>

            </div>

        </div>


        {{-- =====================================================
             NAVEGACIÓN
        ====================================================== --}}

        <nav class="sidebar-nav">


            {{-- PRINCIPAL --}}

            <div class="nav-section">

                <div class="nav-section-title">
                    Principal
                </div>


                <a
                    href="{{ route('paciente.dashboard') }}"
                    class="nav-link {{ request()->routeIs('paciente.dashboard') ? 'active' : '' }}"
                >

                    <span class="nav-icon">
                        I
                    </span>


                    <span>
                        Inicio
                    </span>

                </a>

            </div>


            {{-- MI ATENCIÓN --}}

            <div class="nav-section">

                <div class="nav-section-title">
                    Mi atención
                </div>


                <a
                    href="{{ route('paciente.citas.index') }}"
                    class="nav-link {{ request()->routeIs('paciente.citas.*') ? 'active' : '' }}"
                >

                    <span class="nav-icon">
                        C
                    </span>


                    <span>
                        Mis citas
                    </span>

                </a>


                <a
                    href="{{ route('paciente.expediente.show') }}"
                    class="nav-link {{ request()->routeIs('paciente.expediente.*') ? 'active' : '' }}"
                >

                    <span class="nav-icon">
                        E
                    </span>


                    <span>
                        Mi expediente
                    </span>

                </a>

            </div>


            {{-- CUENTA --}}

            <div class="nav-section">

                <div class="nav-section-title">
                    Cuenta
                </div>


                <a
                    href="{{ route('logout') }}"
                    class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                >

                    <span class="nav-icon">
                        S
                    </span>


                    <span>
                        Cerrar sesión
                    </span>

                </a>


                <form
                    id="logout-form"
                    action="{{ route('logout') }}"
                    method="POST"
                    style="display: none;"
                >

                    @csrf

                </form>

            </div>


        </nav>


        {{-- =====================================================
             USUARIO
        ====================================================== --}}

        <div class="sidebar-footer">

            <div class="user-mini">


                <div class="user-avatar">

                    {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 2)) }}

                </div>


                <div class="user-info">

                    <div class="user-name">

                        {{ auth()->user()->name ?? 'Paciente' }}

                    </div>


                    <div class="user-role">
                        Paciente
                    </div>

                </div>


            </div>

        </div>


    </aside>


    {{-- =========================================================
         CONTENIDO PRINCIPAL
    ========================================================== --}}

    <main class="main">


        {{-- =====================================================
             TOPBAR (CORREGIDO)
        ====================================================== --}}

        <header class="topbar">


            <div class="topbar-left">

                <div class="topbar-date">

                    {{ now()->locale('es')->translatedFormat('l, d \d\e F \d\e Y') }}

                </div>

            </div>


            {{-- Usuario --}}

            <div class="topbar-user">


                <div class="topbar-user-info">

                    <div class="topbar-user-name">

                        {{ auth()->user()->name ?? 'Paciente' }}

                    </div>


                    <div class="topbar-user-role">

                        Paciente

                    </div>

                </div>


                <div class="topbar-avatar">

                    {{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 2)) }}

                </div>


            </div>


        </header>


        {{-- =====================================================
             CONTENIDO DE LA PÁGINA
        ====================================================== --}}

        <div class="content">


            {{-- ENCABEZADO DE PÁGINA --}}

            @hasSection('page-title')

                <div class="page-header">

                    <h1 class="page-title">

                        @yield('page-title')

                    </h1>


                    @hasSection('page-description')

                        <p class="page-description">

                            @yield('page-description')

                        </p>

                    @endif

                </div>

            @endif


            {{-- MENSAJE DE ÉXITO --}}

            @if(session('mensaje'))

                <div class="alerta alerta-exito">

                    {{ session('mensaje') }}

                </div>

            @endif


            {{-- MENSAJE DE ERROR --}}

            @if(session('error'))

                <div class="alerta alerta-error">

                    {{ session('error') }}

                </div>

            @endif


            {{-- ERRORES DE VALIDACIÓN --}}

            @if($errors->any())

                <div class="alerta alerta-error">

                    <strong>
                        Revisa la información ingresada.
                    </strong>


                    <ul style="margin: 7px 0 0 18px;">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- CONTENIDO DE CADA VISTA --}}

            @yield('content')


        </div>


    </main>


</div>


@stack('scripts')


</body>

</html>