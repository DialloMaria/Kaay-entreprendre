<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Domaine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guide>
 */
class GuideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'titre' => $this->faker->sentence(),
            'contenu' => $this->faker->text(), // Générer un texte plus long si nécessaire
            'datepublication' => $this->faker->date(),
            'media' => $this->faker->imageUrl(),
            'auteur' => $this->faker->name(),
            'domaine_id' => \App\Models\Domaine::factory(),
            'user_id' => \App\Models\User::factory(),     // Crée ou associe un User

        ];
    }
}
