
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planes_alimenticios', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paciente_id')
                ->constrained('pacientes')
                ->restrictOnDelete();

            $table->foreignId('nutriologo_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('evaluacion_id')
                ->nullable()
                ->constrained('evaluaciones_nutricionales')
                ->nullOnDelete();

            $table->string('titulo', 150);
            $table->longText('contenido');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->string('estado', 20)->default('activo');
            $table->text('observaciones')->nullable();

            $table->timestamps();

            $table->index(['paciente_id', 'estado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planes_alimenticios');
    }
};