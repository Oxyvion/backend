<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /** Genera un nombre único para poblar categorías de ejemplo en desarrollo. */
    public function definition(): array
    {
        // Faker genera nombres distintos para pruebas y datos de desarrollo.
        return [
            'name' => fake()->unique()->words(2, true),
        ];
    }
}
