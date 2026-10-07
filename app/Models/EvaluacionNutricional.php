<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Cita;
use App\Models\User;
use App\Models\PlanAlimenticio;

class EvaluacionNutricional extends Model
{
    protected $table = 'evaluaciones_nutricionales';

    protected $fillable = [
        'cita_id',
        'nutriologo_id',
        'peso_kg',
        'estatura_cm',
        'imc',
        'cintura_cm',
        'cadera_cm',
        'observaciones',
        'objetivos',
        'recomendaciones',
        'fecha_evaluacion',
    ];

    protected function casts(): array
    {
        return [
            'peso_kg' => 'decimal:2',
            'estatura_cm' => 'decimal:2',
            'imc' => 'decimal:2',
            'cintura_cm' => 'decimal:2',
            'cadera_cm' => 'decimal:2',
            'fecha_evaluacion' => 'date',
        ];
    }

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }

    public function nutriologo(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'nutriologo_id'
        );
    }

    public function planesAlimenticios(): HasMany
    {
        return $this->hasMany(
            PlanAlimenticio::class,
            'evaluacion_id'
        );
    }
}