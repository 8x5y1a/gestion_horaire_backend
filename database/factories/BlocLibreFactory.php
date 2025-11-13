<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlocLibre>
 */
class BlocLibreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nb_bloc' => fake()->randomElement([1, 2, 3]),
            'nb_heure' => fake()->randomElement([1, 2, 3, 4]),
            'contrainte_id' => fake()->randomElement([1, 2, 3]),
            'created_at' => now(),
            'updated_at' =>now()
        ];
    }
}
