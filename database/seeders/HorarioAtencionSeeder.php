<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioAtencionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 5) as $dia) {
            DB::table('horarios_atencion')->updateOrInsert(
                [
                    'dia_semana' => $dia,
                    'hora_inicio' => '09:00:00',
                    'hora_fin' => '18:00:00',
                ],
                [
                    'activo' => true,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }
}