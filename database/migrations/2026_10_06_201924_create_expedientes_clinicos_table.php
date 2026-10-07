
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expedientes_clinicos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paciente_id')
                ->unique()
                ->constrained('pacientes')
                ->restrictOnDelete();

            $table->date('fecha_nacimiento')->nullable();
            $table->text('antecedentes_medicos')->nullable();
            $table->text('antecedentes_familiares')->nullable();
            $table->text('alergias')->nullable();
            $table->text('medicamentos')->nullable();
            $table->text('intolerancias')->nullable();
            $table->text('habitos_alimenticios')->nullable();
            $table->text('preferencias_alimenticias')->nullable();
            $table->text('actividad_fisica')->nullable();
            $table->text('horas_sueno')->nullable();
            $table->text('objetivos_nutricionales')->nullable();

            $table->timestamp('completado_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expedientes_clinicos');
    }
};