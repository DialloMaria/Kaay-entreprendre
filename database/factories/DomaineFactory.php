<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Domaine>
 */
class DomaineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->word,
            'user_id' => User::factory(), // Assurez-vous que le domaine existe ou est créé dans une autre factory
            'categorie_id' => Categorie::factory(), // Assuming you have a CategorieFactory
            'created_by' => User::factory(), // Assuming you have a UserFactory
            'modified_by' => User::factory(), // Assuming you have a UserFactory
        ];
    }
}
