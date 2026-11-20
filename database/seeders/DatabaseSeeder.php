<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /** Punto de entrada para ejecutar los seeders iniciales de la aplicación. */
    public function run(): void
    {
        // El seeder principal delega los datos iniciales de la biblioteca.
        $this->call(ExerciseSeeder::class);
    }
}
