<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Crea la tabla de cuentas que inicia sesión y conserva su perfil. */
    public function up(): void
    {
        // users guarda cuentas; las otras dos tablas soportan recuperar contraseña y sesión web.
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            // Laravel usa esta tabla al implementar restablecimiento de contraseña por correo.
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            // Esta aplicación usa tokens para la API; la tabla queda disponible para sesiones web.
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /** Revierte esta migración eliminando la tabla de usuarios. */
    public function down(): void
    {
        // Elimina en sentido inverso las tres tablas creadas por esta migración.
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
