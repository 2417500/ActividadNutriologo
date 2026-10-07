
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
           ESTRUCTURA PRINCIPAL
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
           IDENTIDAD DEL NUTRIÓLOGO
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
           ICONOS SVG DE NAVEGACIÓN
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

            opacity: 0.85;
        }


        .nav-icon svg {

            width: 14px;
            height: 14px;
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
           TOPBAR
        ========================================================== */

        .topbar {

            height: var(--topbar-height);

            padding: 0 30px;

            background: rgba(255, 255, 255, 0.97);

            border-bottom: 1px solid var(--borde);

            display: flex;
            align-items: center;
            justify-content: space-between;

            position: sticky;

            top: 0;

            z-index: 900;
        }


        .topbar-left {

            display: flex;
            align-items: center;
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

            width: 40px;
            height: 40px;

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

            padding: 40px 34px 50px;
        }


        /* =========================================================
           ENCABEZADO DE PÁGINA
        ========================================================== */

        .page-header {

            margin-bottom: 25px;
        }


        .page-title {

            color: var(--texto);

            font-family: 'Lora', serif;

            font-size: 27px;
            font-weight: 600;

            line-height: 1.3;

            letter-spacing: -0.3px;
        }


        .page-description {

            max-width: 750px;

            margin-top: 6px;

            color: var(--texto-secundario);

            font-size: 12px;
        }


        /* =========================================================
           CARDS
        ========================================================== */

        .card {

            background: var(--blanco);

            border: 1px solid var(--borde);

            border-radius: var(--radio);

            padding: 22px;

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

            margin-bottom: 18px;
        }


        .card-title {

            color: var(--texto);

            font-family: 'Lora', serif;

            font-size: 17px;
            font-weight: 600;
        }


        .card-description {

            color: var(--texto-secundario);

            font-size: 11px;

            margin-top: 3px;
        }


        /* =========================================================
           ESTADÍSTICAS
        ========================================================== */

        .stats {

            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 15px;

            margin-bottom: 20px;
        }


        .stat-card {

            background: var(--blanco);

            border: 1px solid var(--borde);

            border-radius: var(--radio);

            padding: 18px;

            box-shadow: var(--sombra);
        }


        .stat-label {

            color: var(--texto-secundario);

            font-size: 10px;
            font-weight: 600;
        }


        .stat-value {

            margin-top: 5px;

            color: var(--texto);

            font-family: 'Lora', serif;

            font-size: 23px;
            font-weight: 600;
        }


        .stat-extra {

            margin-top: 3px;

            color: var(--verde-principal);

            font-size: 9px;
            font-weight: 600;
        }


        /* =========================================================
           BOTONES
        ========================================================== */

        .boton {

            min-height: 38px;

            padding: 8px 15px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            border: 1px solid var(--verde-principal);

            border-radius: 9px;

            background: var(--verde-principal);

            color: var(--blanco);

            font-size: 11px;
            font-weight: 600;

            cursor: pointer;

            transition: 0.2s ease;
        }


        .boton:hover {

            background: #5E805F;

            border-color: #5E805F;
        }


        .boton svg {

            width: 14px;
            height: 14px;
        }


        .boton-secundario {

            min-height: 38px;

            padding: 8px 15px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            border: 1px solid var(--borde);

            border-radius: 9px;

            background: var(--blanco);

            color: var(--texto);

            font-size: 11px;
            font-weight: 600;

            cursor: pointer;

            transition: 0.2s ease;
        }


        .boton-secundario:hover {

            background: var(--verde-suave);

            color: var(--verde-principal);
        }


        .boton-peligro {

            min-height: 38px;

            padding: 8px 15px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            border: 1px solid #EACCCC;

            border-radius: 9px;

            background: var(--cancelado-fondo);

            color: var(--cancelado);

            font-size: 11px;
            font-weight: 600;

            cursor: pointer;
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

            gap: 18px;
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

            min-height: 40px;

            padding: 9px 12px;
        }


        .campo textarea {

            min-height: 105px;

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


        .campo small {

            color: var(--texto-secundario);

            font-size: 9px;
        }


        .form-acciones {

            grid-column: 1 / -1;

            display: flex;
            justify-content: flex-end;

            gap: 9px;

            padding-top: 5px;
        }


        /* =========================================================
           INFORMACIÓN
        ========================================================== */

        .informacion-grid {

            display: grid;

            grid-template-columns: repeat(2, 1fr);

            gap: 14px;
        }


        .informacion-item {

            padding: 15px;

            background: var(--fondo);

            border: 1px solid var(--borde);

            border-radius: 10px;
        }


        .informacion-label {

            display: block;

            margin-bottom: 4px;

            color: var(--texto-secundario);

            font-size: 9px;
            font-weight: 700;
        }


        .informacion-valor {

            color: var(--texto);

            font-size: 11px;
            font-weight: 600;
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

            padding: 50px 20px;

            text-align: center;

            background: var(--blanco);

            border: 1px dashed #CBD9CD;

            border-radius: var(--radio);
        }


        .vacio-titulo {

            color: var(--texto);

            font-family: 'Lora', serif;

            font-size: 16px;
            font-weight: 600;
        }


        .vacio-texto {

            margin-top: 5px;

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

        @media (max-width: 1100px) {

            .stats {

                grid-template-columns: repeat(2, 1fr);
            }
        }


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


            .panel-icon {

                width: 38px;
                height: 38px;
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

                padding: 0 22px;
            }


            .content {

                padding: 32px 22px 40px;
            }
        }


        @media (max-width: 650px) {

            .topbar {

                padding: 0 15px;
            }


            .topbar-user-info {

                display: none;
            }


            .content {

                padding: 25px 15px 35px;
            }


            .page-title {

                font-size: 23px;
            }


            .stats {

                grid-template-columns: 1fr;
            }


            .form-grid,
            .informacion-grid {

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

                padding: 17px;
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
                href="{{ route('nutriologo.dashboard') }}"
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
             PANEL DEL NUTRIÓLOGO
        ====================================================== --}}

        <div class="panel-identidad">


            <div class="panel-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                >

                    <path
                        d="M12 3V21"
                        stroke="currentColor"
                        stroke-width="1.7"
                        stroke-linecap="round"
                    />

                    <path
                        d="M8 6C8 4.9 8.9 4 10 4H14C15.1 4 16 4.9 16 6V9C16 10.1 15.1 11 14 11H10C8.9 11 8 10.1 8 9V6Z"
                        stroke="currentColor"
                        stroke-width="1.7"
                    />

                    <path
                        d="M5 14C5 12.9 5.9 12 7 12H9C10.1 12 11 12.9 11 14V18C11 19.1 10.1 20 9 20H7C5.9 20 5 19.1 5 18V14Z"
                        stroke="currentColor"
                        stroke-width="1.7"
                    />

                    <path
                        d="M13 14C13 12.9 13.9 12 15 12H17C18.1 12 19 12.9 19 14V18C19 19.1 18.1 20 17 20H15C13.9 20 13 19.1 13 18V14Z"
                        stroke="currentColor"
                        stroke-width="1.7"
                    />

                </svg>

            </div>


            <div class="panel-identidad-texto">

                <span class="panel-label">
                    Panel del nutriólogo
                </span>


                <span class="panel-description">
                    Gestión nutricional
                </span>

            </div>

        </div>


        {{-- =====================================================
             NAVEGACIÓN
        ====================================================== --}}

        <nav class="sidebar-nav">


            {{-- =================================================
                 PRINCIPAL
            ================================================== --}}

            <div class="nav-section">

                <div class="nav-section-title">
                    Principal
                </div>


                <a
                    href="{{ route('nutriologo.dashboard') }}"
                    class="nav-link {{ request()->routeIs('nutriologo.dashboard') ? 'active' : '' }}"
                >

                    <span class="nav-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                            <path
                                d="M4 13H10V20H4V13Z"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M14 4H20V11H14V4Z"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M14 14H20V20H14V14Z"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M4 4H10V9H4V4Z"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linejoin="round"
                            />

                        </svg>

                    </span>


                    <span>
                        Inicio
                    </span>

                </a>

            </div>


            {{-- =================================================
                 GESTIÓN
            ================================================== --}}

            <div class="nav-section">

                <div class="nav-section-title">
                    Gestión
                </div>


                <a
                    href="{{ route('nutriologo.pacientes.index') }}"
                    class="nav-link {{ request()->routeIs('nutriologo.pacientes.*') ? 'active' : '' }}"
                >

                    <span class="nav-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                            <circle
                                cx="9"
                                cy="8"
                                r="3"
                                stroke="currentColor"
                                stroke-width="1.6"
                            />

                            <path
                                d="M3.5 20C3.9 16.5 5.7 14.5 9 14.5C12.3 14.5 14.1 16.5 14.5 20"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                            />

                            <path
                                d="M16 5C18.2 5.1 19.8 6.4 20 8.5C20.1 10.2 19 11.5 17.5 12"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                            />

                            <path
                                d="M16.5 15C19 15.4 20.2 17 20.5 19.5"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                            />

                        </svg>

                    </span>


                    <span>
                        Pacientes
                    </span>

                </a>


                <a
                    href="{{ route('nutriologo.citas.index') }}"
                    class="nav-link {{ request()->routeIs('nutriologo.citas.*') ? 'active' : '' }}"
                >

                    <span class="nav-icon">

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
                                stroke-width="1.6"
                            />

                            <path
                                d="M8 3V7"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                            />

                            <path
                                d="M16 3V7"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                            />

                            <path
                                d="M4 10H20"
                                stroke="currentColor"
                                stroke-width="1.6"
                            />

                            <path
                                d="M8 14H8.01"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                            />

                            <path
                                d="M12 14H12.01"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                            />

                            <path
                                d="M16 14H16.01"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                            />

                        </svg>

                    </span>


                    <span>
                        Citas
                    </span>

                </a>

            </div>


            {{-- =================================================
                 NUTRICIÓN
            ================================================== --}}

            <div class="nav-section">

                <div class="nav-section-title">
                    Nutrición
                </div>


                <a
                    href="{{ route('nutriologo.planes.index') }}"
                    class="nav-link {{ request()->routeIs('nutriologo.planes.*') ? 'active' : '' }}"
                >

                    <span class="nav-icon">

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                            <path
                                d="M7 3H17C18.1 3 19 3.9 19 5V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V5C5 3.9 5.9 3 7 3Z"
                                stroke="currentColor"
                                stroke-width="1.6"
                            />

                            <path
                                d="M8.5 8H15.5"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                            />

                            <path
                                d="M8.5 12H15.5"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                            />

                            <path
                                d="M8.5 16H13"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                            />

                        </svg>

                    </span>


                    <span>
                        Planes alimenticios
                    </span>

                </a>

            </div>


            {{-- =================================================
                 CUENTA
            ================================================== --}}

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

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                            <path
                                d="M10 5H6C4.9 5 4 5.9 4 7V17C4 18.1 4.9 19 6 19H10"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                            />

                            <path
                                d="M14 8L18 12L14 16"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M18 12H9"
                                stroke="currentColor"
                                stroke-width="1.6"
                                stroke-linecap="round"
                            />

                        </svg>

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

                    {{ strtoupper(substr(auth()->user()->name ?? 'N', 0, 2)) }}

                </div>


                <div class="user-info">

                    <div class="user-name">

                        {{ auth()->user()->name ?? 'Nutriólogo' }}

                    </div>


                    <div class="user-role">

                        Nutriólogo

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
             TOPBAR
        ====================================================== --}}

        <header class="topbar">


            <div class="topbar-left">

                <div class="topbar-date">

                    {{ now()->locale('es')->translatedFormat('l, d \d\e F \d\e Y') }}

                </div>

            </div>


            <div class="topbar-user">


                <div class="topbar-user-info">

                    <div class="topbar-user-name">

                        {{ auth()->user()->name ?? 'Nutriólogo' }}

                    </div>


                    <div class="topbar-user-role">

                        Nutriólogo

                    </div>

                </div>


                <div class="topbar-avatar">

                    {{ strtoupper(substr(auth()->user()->name ?? 'N', 0, 2)) }}

                </div>


            </div>


        </header>


        {{-- =====================================================
             CONTENIDO DE LA PÁGINA
        ====================================================== --}}

        <div class="content">


            {{-- ENCABEZADO DE LA PÁGINA --}}

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


            {{-- CONTENIDO DE LAS VISTAS --}}

            @yield('content')


        </div>


    </main>


</div>


@stack('scripts')


</body>

</html>