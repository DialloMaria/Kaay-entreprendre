<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Domaine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Forum>
 */
class ForumFactory extends Factory
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
            'description' => $this->faker->paragraph,
            'nombre_de_message' => $this->faker->numberBetween(0, 100),
            'nombre_de_vue' => $this->faker->numberBetween(0, 1000),
            'dateCreation' => $this->faker->date,
            'domaine_id' => Domaine::factory(), // Assurez-vous que le domaine existe ou est créé dans une autre factory
            'created_by' => User::factory(), // Assurez-vous que l'utilisateur existe ou est créé dans une autre factory
            'modified_by' => User::factory(), // Assurez-vous que l'utilisateur existe ou est créé dans une autre factory
        ];
    }
}
