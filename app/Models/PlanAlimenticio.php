<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlanAlimenticio extends Model
{
    protected $table = 'planes_alimenticios';

    protected $fillable = [
        'paciente_id',
        'nutriologo_id',
        'evaluacion_id',
        'titulo',
        'contenido',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
        ];
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function nutriologo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'nutriologo_id');
    }

    public function evaluacion(): BelongsTo
    {
        return $this->belongsTo(
            EvaluacionNutricional::class,
            'evaluacion_id'
        );
    }
}