<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentoClinico extends Model
{
    protected $table = 'documentos_clinicos';

    protected $fillable = [
        'cita_id',
        'nombre_original',
        'ruta_privada',
        'tipo_mime',
        'tamano',
    ];

    protected function casts(): array
    {
        return [
            'tamano' => 'integer',
        ];
    }

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }
}
