<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Guarda el texto escrito para poder revisar y editar resultados CRUD. */
    public function up(): void
    {
        // Conserva el texto escrito para que el usuario pueda revisar/editar su resultado.
        Schema::table('practice_results', function (Blueprint $table) {
            $table->text('typed_text')->nullable()->after('exercise_id');
        });
    }

    /** Quita typed_text si se revierte el cambio de base de datos. */
    public function down(): void
    {
        // Quita el campo agregado si se revierte esta migración.
        Schema::table('practice_results', function (Blueprint $table) {
            $table->dropColumn('typed_text');
        });
    }
};
