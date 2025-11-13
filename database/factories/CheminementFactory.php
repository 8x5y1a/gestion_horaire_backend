<?php

namespace Database\Factories;

use App\Models\Cheminement;
use App\Models\Horaire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cheminement>
 * @author Mathieu Lahaie-Richer
 */
class CheminementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->randomElement(['Technique de l\'informatique']),
            'option' => fake()->randomElement(['Programmation et sécurité','Réseaux et cybersécurité']),
            'horaire_id' => Horaire::factory()->createOne()->id,
            'created_at' => now(),
            'updated_at' =>now()
        ];
    }
}
