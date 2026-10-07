<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ConsultorioNutri - Tu Salud Nutricional en Manos Expertas</title>

    {{-- FUENTES DEL SISTEMA --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        /* =========================================================
           VARIABLES UNIFICADAS
        ========================================================== */
        :root {
            --verde-principal: #6B8F6B;
            --verde-hover: #5E805F;
            --verde-claro: #DFF0D8;
            --verde-suave: #EAF5E7;

            --fondo: #F7FAF7;
            --blanco: #FFFFFF;

            --texto: #39443A;
            --texto-secundario: #718074;

            --borde: #DEE7DF;
            --borde-suave: #E9EFEA;

            --radio: 13px;
            --sombra: 0 4px 20px rgba(57, 68, 58, 0.06);
        }

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
            display: flex;
            flex-direction: column;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        /* =========================================================
           NAVBAR
        ========================================================== */
        .navbar {
            width: 100%;
            height: 76px;
            background: var(--blanco);
            padding: 0 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--borde);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 36px;
            height: 36px;
            background: var(--verde-claro);
            color: var(--verde-principal);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon svg {
            width: 20px;
            height: 20px;
        }

        .logo {
            font-family: 'Lora', serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--texto);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .login-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 38px;
            padding: 8px 18px;
            background: var(--blanco);
            color: var(--texto);
            border: 1px solid var(--borde);
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .login-button:hover {
            background: var(--verde-suave);
            color: var(--verde-principal);
            border-color: var(--verde-principal);
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 38px;
            padding: 8px 18px;
            background: var(--verde-principal);
            color: var(--blanco);
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
            transition: background 0.2s ease;
        }

        .cta-button:hover {
            background: var(--verde-hover);
        }

        .cta-button svg {
            width: 15px;
            height: 15px;
        }

        /* =========================================================
           HERO SECTION
        ========================================================== */
        .hero {
            flex: 1;
            min-height: calc(100vh - 76px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px 8%;
            gap: 50px;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .hero-text {
            max-width: 580px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            background: var(--verde-claro);
            color: var(--verde-principal);
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge svg {
            width: 14px;
            height: 14px;
        }

        .hero-text h1 {
            font-family: 'Lora', serif;
            font-size: 42px;
            line-height: 1.2;
            color: var(--texto);
            margin-bottom: 20px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .hero-text h1 span {
            color: var(--verde-principal);
        }

        .hero-text p {
            font-size: 15px;
            line-height: 1.6;
            color: var(--texto-secundario);
            margin-bottom: 32px;
        }

        .hero-buttons {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .main-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 44px;
            padding: 10px 24px;
            background: var(--verde-principal);
            color: var(--blanco);
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .main-button:hover {
            background: var(--verde-hover);
            transform: translateY(-1px);
        }

        .main-button svg {
            width: 16px;
            height: 16px;
        }

        .secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 44px;
            padding: 10px 20px;
            background: var(--blanco);
            color: var(--texto);
            border: 1px solid var(--borde);
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .secondary-button:hover {
            background: var(--verde-suave);
            color: var(--verde-principal);
            border-color: var(--verde-principal);
        }

        /* =========================================================
           CARD DE PROMOCIÓN / VALOR
        ========================================================== */
        .hero-card {
            width: 400px;
            background: var(--blanco);
            padding: 35px 28px;
            border-radius: var(--radio);
            border: 1px solid var(--borde);
            box-shadow: var(--sombra);
            text-align: center;
            position: relative;
        }

        .icon-main {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background: var(--verde-claro);
            color: var(--verde-principal);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-main svg {
            width: 32px;
            height: 32px;
        }

        .hero-card h2 {
            font-family: 'Lora', serif;
            font-size: 20px;
            color: var(--texto);
            margin-bottom: 12px;
            font-weight: 600;
        }

        .hero-card p {
            color: var(--texto-secundario);
            font-size: 12px;
            line-height: 1.6;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 25px;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            background: var(--fondo);
            border: 1px solid var(--borde-suave);
            border-radius: 10px;
        }

        .feature-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--blanco);
            border: 1px solid var(--borde);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--verde-principal);
            flex-shrink: 0;
        }

        .feature-icon svg {
            width: 16px;
            height: 16px;
        }

        .feature-text strong {
            display: block;
            font-size: 12px;
            color: var(--texto);
        }

        .feature-text small {
            color: var(--texto-secundario);
            font-size: 10px;
        }

        /* RESPONSIVE */
        @media (max-width: 850px) {
            .hero {
                flex-direction: column;
                text-align: center;
                padding-top: 40px;
            }

            .hero-text h1 {
                font-size: 32px;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-card {
                width: 100%;
                max-width: 400px;
            }

            .navbar {
                padding: 0 5%;
            }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="logo-container">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z"/>
                    <path d="M12 6a6 6 0 0 0-6 6c0 3.31 2.69 6 6 6s6-2.69 6-6a6 6 0 0 0-6-6zm0 10a4 4 0 1 1 4-4 4 4 0 0 1-4 4z"/>
                </svg>
            </div>
            <div class="logo">
                ConsultorioNutri
            </div>
        </div>

        <div class="nav-actions">
            <a href="{{ route('login') }}" class="login-button">
                Iniciar sesión
            </a>
            <a href="{{ route('login') }}" class="cta-button">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                Agendar cita
            </a>
        </div>
    </nav>

    <!-- HERO / PUBLICIDAD -->
    <main class="hero">

        <section class="hero-text">
            <div class="badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                Planes Nutricionales Personalizados
            </div>

            <h1>
                Transforma tu salud con un plan a tu <span>medida</span>
            </h1>

            <p>
                Alcanza tus metas físicas, mejora tu energía y aprende a alimentarte bien. 
                Recibe atención nutricional 100% personalizada con seguimiento continuo y evaluaciones detalladas.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('login') }}" class="main-button">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Agendar mi valoración
                </a>

                <a href="{{ route('login') }}" class="secondary-button">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Acceso Pacientes
                </a>
            </div>
        </section>

        <!-- TARJETA PUBLICITARIA DE BENEFICIOS -->
        <section class="hero-card">
            <div class="icon-main">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                </svg>
            </div>

            <h2>
                Tu Consulta Nutricional
            </h2>

            <p>
                Obtén un diagnóstico completo de tu composición corporal y un plan de alimentación adaptado a tu estilo de vida.
            </p>

            <div class="features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <strong>Citas Flexibles</strong>
                        <small>Elige el horario que mejor se adapte a ti</small>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <strong>Expediente Digital</strong>
                        <small>Revisa tus avances y menú en todo momento</small>
                    </div>
                </div>

                <div class="feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <strong>Resultados Garantizados</strong>
                        <small>Seguimiento continuo de tus metas</small>
                    </div>
                </div>
            </div>
        </section>

    </main>

</body>
</html>