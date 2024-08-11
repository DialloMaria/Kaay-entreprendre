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
            'titre' => $this->faker->sentence,
            'contenu' => $this->faker->paragraph,
            'datepublication' => $this->faker->date(),
            'media' => $this->faker->word . '.jpg',
            'etape' => $this->faker->numberBetween(1, 10),
            'auteur' => $this->faker->name,
            'domaine_id' => Domaine::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'created_by' => User::inRandomOrder()->first()->id,
            'modified_by' => User::inRandomOrder()->first()->id,

        ];
    }
}
