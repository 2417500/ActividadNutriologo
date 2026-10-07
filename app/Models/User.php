<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'activo',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'activo' => 'boolean',
        ];
    }

    public function paciente(): HasOne
    {
        return $this->hasOne(Paciente::class);
    }

    public function evaluaciones(): HasMany
    {
        return $this->hasMany(
            EvaluacionNutricional::class,
            'nutriologo_id'
        );
    }

    public function planesAlimenticios(): HasMany
    {
        return $this->hasMany(
            PlanAlimenticio::class,
            'nutriologo_id'
        );
    }

    public function registrosActividad(): HasMany
    {
        return $this->hasMany(RegistroActividad::class);
    }

    public function esNutriologo(): bool
    {
        return $this->role === 'nutriologo';
    }

    public function esPaciente(): bool
    {
        return $this->role === 'paciente';
    }
}