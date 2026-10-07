<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paciente_id')
                ->constrained('pacientes')
                ->restrictOnDelete();

            $table->date('fecha');

            $table->time('hora');

            $table->string('estado', 30)
                ->default('pendiente');

            $table->text('motivo')->nullable();

            $table->text('motivo_cancelacion')->nullable();

            $table->date('fecha_solicitada')->nullable();

            $table->time('hora_solicitada')->nullable();

            $table->text('respuesta_reprogramacion')->nullable();

            $table->timestamp('reprogramacion_respondida_at')->nullable();

            $table->timestamp('completada_at')->nullable();

            $table->timestamp('cancelada_at')->nullable();

            $table->timestamps();

            $table->index(['paciente_id', 'fecha']);
            $table->index(['fecha', 'hora']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};