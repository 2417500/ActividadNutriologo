<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Paciente extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'user_id',
        'telefono',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    public function expediente(): HasOne
    {
        return $this->hasOne(ExpedienteClinico::class);
    }

    public function consentimientos(): HasMany
    {
        return $this->hasMany(Consentimiento::class);
    }

    public function planesAlimenticios(): HasMany
    {
        return $this->hasMany(PlanAlimenticio::class);
    }

}