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
            'type_contrainte_id' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8]),
            'type_description' => fake()->randomElement(['Type 1', 'Type 2', 'Type3']),
            'stricte' => fake()->randomElement([0, 1]),
            'session'=> fake()->randomElement([1, 2, 3, 4, 5]),
            'created_at' => now(),
            'updated_at' =>now()
        ];
    }
}
