<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cita extends Model
{
    protected $table = 'citas';

    protected $fillable = [
        'paciente_id',
        'fecha',
        'hora',
        'estado',
        'motivo',
        'motivo_cancelacion',
        'fecha_solicitada',
        'hora_solicitada',
        'respuesta_reprogramacion',
        'reprogramacion_respondida_at',
        'completada_at',
        'cancelada_at',
        'recordatorio_enviado_at',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
            'fecha_solicitada' => 'date',
            'reprogramacion_respondida_at' => 'datetime',
            'completada_at' => 'datetime',
            'cancelada_at' => 'datetime',
            'recordatorio_enviado_at' => 'datetime',
        ];
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function documentos(): HasMany
    {
        return $this->hasMany(DocumentoClinico::class);
    }

    public function evaluacion(): HasOne
    {
        return $this->hasOne(EvaluacionNutricional::class);
    }
}