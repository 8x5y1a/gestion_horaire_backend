<?php

namespace Database\Factories;

use App\Models\GroupeCours;
use App\Models\Local;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlocCours>
 */
class BlocCoursFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $groupeCoursIds = GroupeCours::pluck('id')->toArray();
        $localIds = Local::pluck('id')->toArray();

        if (empty($groupeCoursIds)) {
            throw new \Exception('Pas de groupe cours valid. svp assurer vous que des groupe cours soient disponible.');
        }
        if (empty($localIds)) {
            throw new \Exception('Pas de local valid. svp assurer vous qu\'un local est disponible.');

        }
        return [
            'jour' => fake()->randomElement(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi']),
            'heures' => fake()->randomElement(['1110001110', '00001110011', '0111111100', '0000000111']),
            'dure' => fake()->numberBetween(1, 20),
            'groupe_cours_id' => $this->faker->randomElement($groupeCoursIds),
            'local_id' => $this->faker->randomElement($localIds)
        ];


    }
}
