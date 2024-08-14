<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categorie::create([
            'nom' => 'Devenir Entrepreneur',
        ]);

        Categorie::create([
            'nom' => 'Créer Entreprise',
        ]);
    }
}
