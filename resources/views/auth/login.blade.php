<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar sesión - ConsultorioNutri</title>

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
            --cancelado: #A85C5C;
            --cancelado-fondo: #F8EAEA;

            --radio: 13px;
            --sombra: 0 4px 20px rgba(57, 68, 58, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: var(--fondo);
            color: var(--texto);
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 410px;
            background: var(--blanco);
            padding: 35px 30px;
            border-radius: var(--radio);
            border: 1px solid var(--borde);
            box-shadow: var(--sombra);
        }

        .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 15px;
            background: var(--verde-claro);
            color: var(--verde-principal);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon svg {
            width: 36px;
            height: 36px;
        }

        .logo h1 {
            font-family: 'Lora', serif;
            color: var(--texto);
            font-size: 24px;
            font-weight: 700;
        }

        .logo p {
            margin-top: 4px;
            color: var(--texto-secundario);
            font-size: 12px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: var(--texto);
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .form-group input {
            width: 100%;
            min-height: 40px;
            padding: 9px 12px;
            border: 1px solid var(--borde);
            border-radius: 9px;
            background: var(--blanco);
            color: var(--texto);
            font-size: 11px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-group input:focus {
            border-color: var(--verde-principal);
            box-shadow: 0 0 0 3px rgba(107, 143, 107, 0.10);
        }

        .form-group input::placeholder {
            color: #A2ADA4;
        }

        .login-button {
            width: 100%;
            min-height: 42px;
            border: 1px solid var(--verde-principal);
            padding: 9px 15px;
            background: var(--verde-principal);
            color: var(--blanco);
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s ease;
            margin-top: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .login-button:hover {
            background: var(--verde-hover);
        }

        .login-button svg {
            width: 15px;
            height: 15px;
        }

        .back {
            text-align: center;
            margin-top: 20px;
        }

        .back a {
            color: var(--texto-secundario);
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s ease;
        }

        .back a:hover {
            color: var(--verde-principal);
        }

        .back a svg {
            width: 14px;
            height: 14px;
        }

        .error {
            background: var(--cancelado-fondo);
            color: var(--cancelado);
            border: 1px solid #EACCCC;
            padding: 10px 14px;
            border-radius: 9px;
            margin-bottom: 18px;
            font-size: 11px;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <div class="logo">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
            </div>

            <h1>ConsultorioNutri</h1>

            <p>Inicia sesión para acceder a tu panel</p>
        </div>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.procesar') }}">
            @csrf

            <div class="form-group">
                <label for="email">
                    Correo electrónico
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="ejemplo@correo.com"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">
                    Contraseña
                </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Ingresa tu contraseña"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                Iniciar sesión
            </button>
        </form>

        <div class="back">
            <a href="{{ route('inicio') }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Regresar al inicio
            </a>
        </div>

    </div>

</body>
</html>