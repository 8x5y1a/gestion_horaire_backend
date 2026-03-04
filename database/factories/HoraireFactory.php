<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\horaire>
 */
class HoraireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "Lundi" => "0000000000",
            "Mardi" => "0000000000",
            "Mercredi" => "0000000000",
            "Jeudi" => "0000000000",
            "Vendredi" => "0000000000",
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
