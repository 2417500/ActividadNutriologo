<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\RegistroActividad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');

        $pacientes = Paciente::with('user')
            ->when($busqueda, function ($consulta) use ($busqueda) {
                $consulta->whereHas('user', function ($usuario) use ($busqueda) {
                    $usuario->where('name', 'like', "%{$busqueda}%")
                        ->orWhere('email', 'like', "%{$busqueda}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view(
            'nutriologo.pacientes.index',
            compact('pacientes', 'busqueda')
        );
    }

    public function create()
    {
        return view('nutriologo.pacientes.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:150',
                'regex:/^[\pL\pM\s]+$/u',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
            ],

            'telefono' => [
                'required',
                'string',
                'regex:/^[0-9]{10}$/',
            ],
        ], [
            'name.required' => 'El nombre del paciente es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'name.max' => 'El nombre no puede superar los 150 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'email.max' => 'El correo electrónico no puede superar los 255 caracteres.',
            'email.unique' => 'Ya existe un usuario registrado con este correo.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.max' => 'La contraseña es demasiado larga.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono debe contener exactamente 10 números.',
        ]);

        $paciente = DB::transaction(function () use ($datos) {
            $usuario = User::create([
                'name' => $datos['name'],
                'email' => $datos['email'],
                'password' => Hash::make($datos['password']),
                'role' => 'paciente',
                'activo' => true,
            ]);

            $paciente = Paciente::create([
                'user_id' => $usuario->id,
                'telefono' => $datos['telefono'],
            ]);

            RegistroActividad::create([
                'user_id' => auth()->id(),
                'accion' => 'crear_paciente',
                'entidad' => 'pacientes',
                'entidad_id' => $paciente->id,
                'descripcion' => 'Se creó una cuenta de paciente.',
                'creado_at' => now(),
            ]);

            return $paciente;
        });

        return redirect()
            ->route('nutriologo.pacientes.index')
            ->with(
                'mensaje',
                'El paciente fue registrado correctamente.'
            );
    }

    public function show(Paciente $paciente)
    {
        $paciente->load([
            'user',
            'expediente',
            'citas' => function ($consulta) {
                $consulta->with('evaluacion')
                    ->orderByDesc('fecha')
                    ->orderByDesc('hora');
            },
            'planesAlimenticios',
            'consentimientos',
        ]);

        return view(
            'nutriologo.pacientes.show',
            compact('paciente')
        );
    }

    public function edit(Paciente $paciente)
    {
        $paciente->load('user');

        return view(
            'nutriologo.pacientes.edit',
            compact('paciente')
        );
    }

    public function update(Request $request, Paciente $paciente)
    {
        $paciente->load('user');

        $datos = $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:150',
                'regex:/^[\pL\pM\s]+$/u',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($paciente->user_id),
            ],

            'telefono' => [
                'required',
                'string',
                'regex:/^[0-9]{10}$/',
            ],
        ], [
            'name.required' => 'El nombre del paciente es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 2 caracteres.',
            'name.max' => 'El nombre no puede superar los 150 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingresa un correo electrónico válido.',
            'email.max' => 'El correo electrónico no puede superar los 255 caracteres.',
            'email.unique' => 'Ya existe otro usuario registrado con este correo.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono debe contener exactamente 10 números.',
        ]);

        DB::transaction(function () use ($datos, $paciente) {
            $paciente->user->update([
                'name' => $datos['name'],
                'email' => $datos['email'],
            ]);

            $paciente->update([
                'telefono' => $datos['telefono'],
            ]);

            RegistroActividad::create([
                'user_id' => auth()->id(),
                'accion' => 'actualizar_paciente',
                'entidad' => 'pacientes',
                'entidad_id' => $paciente->id,
                'descripcion' => 'Se actualizaron los datos del paciente.',
                'creado_at' => now(),
            ]);
        });

        return redirect()
            ->route('nutriologo.pacientes.index')
            ->with(
                'mensaje',
                'Los datos del paciente se actualizaron correctamente.'
            );
    }

    public function cambiarEstado(Paciente $paciente)
    {
        $paciente->load('user');

        $nuevoEstado = !$paciente->user->activo;

        DB::transaction(function () use ($paciente, $nuevoEstado) {
            $paciente->user->update([
                'activo' => $nuevoEstado,
            ]);

            RegistroActividad::create([
                'user_id' => auth()->id(),
                'accion' => $nuevoEstado
                    ? 'activar_paciente'
                    : 'desactivar_paciente',
                'entidad' => 'pacientes',
                'entidad_id' => $paciente->id,
                'descripcion' => $nuevoEstado
                    ? 'Se activó la cuenta del paciente.'
                    : 'Se desactivó la cuenta del paciente.',
                'creado_at' => now(),
            ]);
        });

        return redirect()
            ->route('nutriologo.pacientes.index')
            ->with(
                'mensaje',
                $nuevoEstado
                    ? 'La cuenta del paciente fue activada.'
                    : 'La cuenta del paciente fue desactivada.'
            );
    }
}
