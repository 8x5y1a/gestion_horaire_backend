<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cours>
 * @author Mathieu Lahaie-Richer
 */
class CoursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->randomElement(['Projet synthèse','Ordinateur PME','Logique de programmation','Programmation orientée objet']),
            'code' => fake()->regexify('^[A-Z0-9]{3}\-[A-Z0-9]{3}\-[A-Z]{2}$'),
            'ponderation' => fake()->regexify('[1-9]{1}\-[1-9]{1}\-[1-9]{1}$'),
            'bloc' => fake()->regexify('^[1-9]{1}(\-[1-9])?(\-[1-9])?(\-[1-9])?$'),
            'local_technique' => fake()->boolean(),
            'cours_charge' => fake()->boolean(),
            'session' => fake()->regexify('^[1-6]$'),
            'created_at' => now(),
            'updated_at' =>now()
        ];
    }
}
