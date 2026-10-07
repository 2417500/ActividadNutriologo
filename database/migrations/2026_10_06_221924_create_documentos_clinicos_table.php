<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos_clinicos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cita_id')
                ->constrained('citas')
                ->cascadeOnDelete();

            $table->string('nombre_original', 255);

            $table->string('ruta_privada', 500);

            $table->string('tipo_mime', 100);

            $table->unsignedBigInteger('tamano');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos_clinicos');
    }
};