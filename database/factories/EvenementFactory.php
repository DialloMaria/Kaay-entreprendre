<?php

namespace Database\Factories;

use App\Models\Domaine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evenement>
 */
class EvenementFactory extends Factory
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
            'online' => $this->faker->boolean(),
            'lieu' => $this->faker->address(),
            'domaine_id' => Domaine::factory(),
        ];
    }
}
