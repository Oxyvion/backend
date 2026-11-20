<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /** Agrega categorías y el rol único del proyecto; adapta ejercicios anteriores. */
    public function up(): void
    {
        // Separa las categorías en una tabla propia para poder administrarlas con CRUD.
        Schema::create('categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Este proyecto usa un solo rol inicial para todas las cuentas.
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('estudiante');
        });

        // Agrega la relación nueva antes de quitar el texto de categoría antiguo.
        Schema::table('exercises', function (Blueprint $table): void {
            $table->foreignId('category_id')->nullable()->constrained()->restrictOnDelete();
        });

        // Conserva los ejercicios existentes, creando una categoría por cada nombre.
        $categoryNames = DB::table('exercises')->distinct()->pluck('category');

        foreach ($categoryNames as $categoryName) {
            $categoryId = DB::table('categories')->insertGetId([
                'name' => $categoryName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('exercises')
                ->where('category', $categoryName)
                ->update(['category_id' => $categoryId]);
        }

        // La FK sustituye al campo de texto duplicado en cada ejercicio.
        Schema::table('exercises', function (Blueprint $table): void {
            $table->dropColumn('category');
        });
    }

    /** Revierte el cambio de esquema relacionado con categorías y rol. */
    public function down(): void
    {
        // Al revertir, reconstruye el campo anterior usando el nombre relacionado.
        Schema::table('exercises', function (Blueprint $table): void {
            $table->string('category')->nullable();
        });

        $exercises = DB::table('exercises')
            ->join('categories', 'categories.id', '=', 'exercises.category_id')
            ->select('exercises.id', 'categories.name')
            ->get();

        foreach ($exercises as $exercise) {
            DB::table('exercises')->where('id', $exercise->id)->update(['category' => $exercise->name]);
        }

        Schema::table('exercises', function (Blueprint $table): void {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });

        Schema::dropIfExists('categories');

        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn('role');
        });
    }
};
