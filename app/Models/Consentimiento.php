<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consentimiento extends Model
{
    protected $table = 'consentimientos';

    protected $fillable = [
        'paciente_id',
        'tipo',
        'version_documento',
        'aceptado',
        'aceptado_at',
    ];

    protected function casts(): array
    {
        return [
            'aceptado' => 'boolean',
            'aceptado_at' => 'datetime',
        ];
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }
}