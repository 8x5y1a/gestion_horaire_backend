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
            "lundi" => "0000000000",
            "mardi" => "0000000000",
            "mercredi" => "0000000000",
            "jeudi" => "0000000000",
            "vendredi" => "0000000000",
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
