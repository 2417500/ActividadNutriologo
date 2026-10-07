
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluaciones_nutricionales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cita_id')
                ->unique()
                ->constrained('citas')
                ->restrictOnDelete();

            $table->foreignId('nutriologo_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->decimal('peso_kg', 6, 2)->nullable();
            $table->decimal('estatura_cm', 5, 2)->nullable();
            $table->decimal('imc', 5, 2)->nullable();

            $table->decimal('cintura_cm', 5, 2)->nullable();
            $table->decimal('cadera_cm', 5, 2)->nullable();

            $table->text('observaciones')->nullable();
            $table->text('objetivos')->nullable();
            $table->text('recomendaciones')->nullable();

            $table->date('fecha_evaluacion');
            $table->timestamps();

            $table->index('fecha_evaluacion');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluaciones_nutricionales');
    }
};