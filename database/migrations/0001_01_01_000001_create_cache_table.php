<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Crea tablas que Laravel usa para cachear datos y bloqueos temporales. */
    public function up(): void
    {
        // Laravel guarda valores temporales y bloqueos en estas tablas si la caché usa MySQL.
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->bigInteger('expiration')->index();
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->bigInteger('expiration')->index();
        });
    }

    /** Elimina las tablas de caché al revertir esta migración. */
    public function down(): void
    {
        // Revierte las dos tablas de caché creadas arriba.
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
