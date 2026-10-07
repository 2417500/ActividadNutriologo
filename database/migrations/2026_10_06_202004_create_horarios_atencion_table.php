
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('horarios_atencion', function (Blueprint $table) {
            $table->id();

            $table->unsignedTinyInteger('dia_semana');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->boolean('activo')->default(true);

            $table->timestamps();

            $table->unique(
                ['dia_semana', 'hora_inicio', 'hora_fin'],
                'horarios_dia_horas_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('horarios_atencion');
    }
};