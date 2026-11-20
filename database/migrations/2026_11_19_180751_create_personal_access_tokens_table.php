<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Crea el almacenamiento de tokens personales que protege la API con Sanctum. */
    public function up(): void
    {
        // Sanctum almacena aquí hashes y permisos de los tokens Bearer de cada sesión.
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->text('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable()->index();
            $table->timestamps();
        });
    }

    /** Elimina la tabla de tokens al revertir la migración. */
    public function down(): void
    {
        // Revierte la tabla de tokens personales.
        Schema::dropIfExists('personal_access_tokens');
    }
};
