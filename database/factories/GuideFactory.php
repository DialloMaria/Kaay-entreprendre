<?php

namespace Database\Factories;

use App\Models\Guide;
use App\Models\Domain;
use App\Models\Domaine;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuideFactory extends Factory
{
    protected $model = Guide::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->sentence,
            'contenu' => $this->faker->paragraph,
            'datepublication' => $this->faker->date,
            'media' => $this->faker->word . '.jpg',
            'auteur' => $this->faker->name,
            'domaine_id' => Domaine::factory(),
        ];
    }
}
