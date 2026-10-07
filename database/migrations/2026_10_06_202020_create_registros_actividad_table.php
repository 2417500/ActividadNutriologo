
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registros_actividad', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('accion', 100);
            $table->string('entidad', 100);
            $table->unsignedBigInteger('entidad_id')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamp('creado_at')->useCurrent();

            $table->index(['entidad', 'entidad_id']);
            $table->index('creado_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registros_actividad');
    }
};