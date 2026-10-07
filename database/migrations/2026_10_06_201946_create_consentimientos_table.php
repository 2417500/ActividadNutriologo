
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consentimientos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paciente_id')
                ->constrained('pacientes')
                ->restrictOnDelete();

            $table->string('tipo', 50);
            $table->string('version_documento', 30);
            $table->boolean('aceptado');
            $table->timestamp('aceptado_at')->nullable();

            $table->timestamps();

            $table->index(['paciente_id', 'tipo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consentimientos');
    }
};