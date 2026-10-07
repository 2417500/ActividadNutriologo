<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $datos = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $usuario = User::where('email', $datos['email'])->first();

        if (
            !$usuario ||
            !Hash::check($datos['password'], $usuario->password) ||
            !$usuario->activo
        ) {
            throw ValidationException::withMessages([
                'email' => 'Las credenciales son incorrectas o la cuenta está desactivada.',
            ]);
        }

        Auth::login($usuario, $request->boolean('remember'));

        $request->session()->regenerate();

        if ($usuario->esNutriologo()) {
            return redirect()->route('nutriologo.dashboard');
        } elseif ($usuario->esPaciente()) {
            return redirect()->route('paciente.dashboard');
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->withErrors([
                'email' => 'El rol de esta cuenta no es válido.',
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('mensaje', 'Has cerrado sesión correctamente.');
    }
}
