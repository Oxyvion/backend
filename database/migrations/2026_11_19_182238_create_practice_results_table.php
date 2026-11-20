<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Crea el historial de resultados vinculado a usuario y ejercicio. */
    public function up(): void
    {
        // Guarda cada intento y enlaza el resultado con la persona y el ejercicio.
        Schema::create('practice_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('exercise_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('elapsed_seconds');
            $table->unsignedInteger('ppm');
            $table->decimal('accuracy', 5, 2);
            $table->unsignedInteger('errors');
            $table->unsignedInteger('characters_typed');
            $table->timestamps();
            $table->index(['user_id', 'created_at']);
        });
    }

    /** Elimina el historial si se revierte la migración. */
    public function down(): void
    {
        // La cascada está definida en las claves foráneas de la tabla.
        Schema::dropIfExists('practice_results');
    }
};
