<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\PracticeResult;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PracticeResult>
 */
class PracticeResultFactory extends Factory
{
    /** Crea métricas de ejemplo relacionadas con una cuenta y un ejercicio. */
    public function definition(): array
    {
        // Genera datos relacionados y métricas ficticias para escenarios de prueba.
        return [
            'user_id' => User::factory(),
            'exercise_id' => Exercise::factory(),
            'elapsed_seconds' => fake()->numberBetween(20, 180),
            'ppm' => fake()->numberBetween(15, 90),
            'accuracy' => fake()->randomFloat(2, 70, 100),
            'errors' => fake()->numberBetween(0, 12),
            'characters_typed' => fake()->numberBetween(100, 500),
        ];
    }
}
