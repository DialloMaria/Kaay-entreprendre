<?php

namespace Database\Factories;

use App\Models\Guide;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Temoignage>
 */
class TemoignageFactory extends Factory
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
            'description' => $this->faker->paragraph(),
            'guide_id' => Guide::factory(), // Asso
        ];
    }
}
