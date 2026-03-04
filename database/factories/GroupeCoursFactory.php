<?php

namespace Database\Factories;

use App\Models\Campus;
use App\Models\Cours;
use App\Models\GroupeCours;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GroupeCours>
 */
class GroupeCoursFactory extends Factory
{
    protected $model = GroupeCours::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $campusIds = Campus::pluck('id')->toArray();
        $enseignantIds = User::pluck('id')->toArray();
        $coursIds = Cours::pluck('id')->toArray();

        if (empty($campusIds)) {
            throw new \Exception('Pas de campus valid. svp assurer vous que des campus soient disponible.');
        }
        if (empty($enseignantIds)) {
            throw new \Exception('Pas de user valid. svp assurer vous que du user est disponible.');
        }
        if (empty($coursIds)) {
            throw new \Exception('Pas de cours valid. svp assurer vous que des cours sont disponible.');
        }
        $coursId = $this->faker->randomElement($coursIds);
        $countForSelectedCours = GroupeCours::where('cours_id', $coursId)->count() + 1;


        return [
            'nbetud' => fake()->numberBetween(3,200),
            'couleur' => fake()->hexColor(),
            'campus_id' => $this->faker->randomElement($campusIds),
            'user_id' => $this->faker->randomElement($enseignantIds),
            'groupe' => $countForSelectedCours,
            'cours_id' => $coursId,
            'created_at' => now(),
            'updated_at' =>now()
        ];
    }
}
