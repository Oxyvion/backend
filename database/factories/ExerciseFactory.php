<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Exercise>
 */
class ExerciseFactory extends Factory
{
    /** Genera un ejercicio relacionado con una categoría ficticia. */
    public function definition(): array
    {
        // La fábrica crea un ejercicio relacionado con una categoría ficticia.
        return [
            'title' => fake()->sentence(3),
            'category_id' => Category::factory(),
            'difficulty' => 'Básico',
            'content' => fake()->paragraph(),
        ];
    }
}
