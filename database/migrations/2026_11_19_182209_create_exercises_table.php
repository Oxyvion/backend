<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Crea la tabla con los textos que se muestran durante las prácticas. */
    public function up(): void
    {
        // Cada fila describe un texto disponible para una práctica de mecanografía.
        Schema::create('exercises', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('difficulty')->default('Básico');
            $table->text('content');
            $table->timestamps();
        });
    }

    /** Elimina la tabla de ejercicios al revertir la migración. */
    public function down(): void
    {
        // La reversión elimina la tabla creada por este archivo.
        Schema::dropIfExists('exercises');
    }
};
