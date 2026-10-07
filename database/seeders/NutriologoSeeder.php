<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class NutriologoSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Dr. Juan Pérez',
            'email' => 'nutriologo@consultorionutri.com',
            'password' => Hash::make('12345678'),
            'role' => 'nutriologo',
            'activo' => true,
        ]);
    }
}