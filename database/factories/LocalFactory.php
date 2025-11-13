<?php

namespace Database\Factories;

use App\Models\Horaire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Local>
 */
class LocalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'no_local' => fake()->randomElement(['1.068','1.840','1.810','1.360','1.160','1.640','2.630']),
            'capacite' => fake()->randomNumber(),
            'local_technique' => false,
            'horaire_id' => Horaire::factory()->create()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
