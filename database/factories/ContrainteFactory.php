<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contrainte>
 */
class ContrainteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->randomElement(['Contrainte importante', 'Contrainte très importante', 'Contrainte moins importante']),
            'description' => fake()->randomElement(['Il s\'agît d\'une contrainte.', 'Ceci est une contrainte.', 'Cela représente une contrainte.']),
            'type' => fake()->randomElement(['conciliation', 'reunion', 'generaux', 'universelle', 'preference', 'lies', 'disponibilite']),
            'stricte' => fake()->randomElement([0, 1]),
            'session'=> fake()->randomElement([1, 2, 3, 4, 5]),
            'created_at' => now(),
            'updated_at' =>now()
        ];
    }
}
