<?php

namespace Database\Seeders;

use App\Models\Guide;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guide::create([
            'titre' => 'Guide de Débutant en Laravel',
            'contenu' => 'Voici un guide pour démarrer avec Laravel...',
            'datepublication' => now(),
            'media' => 'guide1.pdf',
            'etape' => 1,
            'auteur' => 'Souleymane Ndiaye',
            'domaine_id' => 1, // Assurez-vous que ce domaine existe
            'user_id' => 1, // Assurez-vous que cet utilisateur existe
            'created_by' => 1,
            'modified_by' => 1,
        ]);
    }
}
