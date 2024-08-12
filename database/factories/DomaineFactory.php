<?php


namespace Database\Factories;

use App\Models\Domaine;
use App\Models\User;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

class DomaineFactory extends Factory
{
    protected $model = Domaine::class;

    public function definition()
    {
        return [
            //
            'nom' => $this->faker->word(),
            'user_id' => User::factory(),
            'categorie_id' => Categorie::factory(),
        ];
    }
}
