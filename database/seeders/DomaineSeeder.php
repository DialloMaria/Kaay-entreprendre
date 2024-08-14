<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Domaine;
use App\Models\Categorie;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DomaineSeeder extends Seeder
{
    public function run()
    {

        $categorieEntrepreneurId = Categorie::where('nom', 'Devenir Entrepreneur')->first()->id;
        $categorieEntrepriseId = Categorie::where('nom', 'Créer Entreprise')->first()->id;

        Domaine::create([
            'nom' => 'Informatiques',
            'created_by' => 1,
            'modified_by' => 1,
            'categorie_id' => $categorieEntrepreneurId
        ]);

        Domaine::create([
            'nom' => 'Agriculture',
            'created_by' => 1,
            'modified_by' => 1,
            'categorie_id' => $categorieEntrepriseId
        ]);

        Domaine::create([
            'nom' => 'Santé',
            'created_by' => 1,
            'modified_by' => 1,
            'categorie_id' => $categorieEntrepriseId
        ]);
    }
}
