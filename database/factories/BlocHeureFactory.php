<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlocHeure>
 */
class BlocHeureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jour_id' => fake()->randomElement([1,2,3,4,5,8]),
            'heures' => fake()->randomElement(['11100011100', '00011100011', '01101111100', '00000000111']),
            'contrainte_id' => fake()->randomElement([1, 2, 3]),
            'created_at' => now(),
            'updated_at' =>now()
        ];
    }
}
