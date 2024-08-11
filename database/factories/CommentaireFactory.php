<?php

namespace Database\Factories;

use App\Models\Commentaire;
use App\Models\Evenement;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentaireFactory extends Factory
{
    protected $model = Commentaire::class;

    public function definition()
    {
        return [
            'contenu' => $this->faker->text,
            'evenement_id' => Evenement::factory(),
        ];
    }
}
