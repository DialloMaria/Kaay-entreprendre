<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Domaine;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DomaineSeeder extends Seeder
{
    public function run()
    {

        Domaine::create([
            'nom' => 'Développement Web',
            'user_id' => 1, // Assurez-vous que cet utilisateur existe
            'created_by' => 1,
            'modified_by' => 1,
            'categorie_id' => 1 // Assurez-vous que cette catégorie existe
        ]);


    }
}
