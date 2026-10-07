<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpedienteClinico extends Model
{
    protected $table = 'expedientes_clinicos';

    protected $fillable = [
        'paciente_id',
        'fecha_nacimiento',
        'antecedentes_medicos',
        'antecedentes_familiares',
        'alergias',
        'medicamentos',
        'intolerancias',
        'habitos_alimenticios',
        'preferencias_alimenticias',
        'actividad_fisica',
        'horas_sueno',
        'objetivos_nutricionales',
        'completado_at',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'completado_at' => 'datetime',
        ];
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }
}