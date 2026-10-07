<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HorarioAtencion extends Model
{
    protected $table = 'horarios_atencion';

    protected $fillable = [
        'dia_semana',
        'hora_inicio',
        'hora_fin',
        'activo',
    ];

    protected function casts(): array
    {
        return [
            'dia_semana' => 'integer',
            'activo' => 'boolean',
        ];
    }
}