<?php

namespace Database\Seeders;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        $usuario = User::create([
            'name' => 'Ana López',
            'email' => 'paciente@consultorionutri.com',
            'password' => Hash::make('12345678'),
            'role' => 'paciente',
            'activo' => true,
        ]);

        Paciente::create([
            'user_id' => $usuario->id,
            'telefono' => '5512345678',
        ]);
    }
}