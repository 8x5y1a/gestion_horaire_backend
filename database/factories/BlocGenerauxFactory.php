<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlocGeneraux>
 */
class BlocGenerauxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jour_id' => fake()->numberBetween(1, 5),
            'heures' => fake()->randomElement(['0000000000', '00001110000', '0111000000', '0000000111']),
            'dure' => fake()->numberBetween(1, 5),
            'bloc_libre_id' => fake()->numberBetween(1, 3),
            'created_at' => now(),
            'updated_at' =>now()
        ];
    }
}
