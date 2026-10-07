<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistroActividad extends Model
{
    protected $table = 'registros_actividad';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'accion',
        'entidad',
        'entidad_id',
        'descripcion',
        'creado_at',
    ];

    protected function casts(): array
    {
        return [
            'creado_at' => 'datetime',
        ];
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}