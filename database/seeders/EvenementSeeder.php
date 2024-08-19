<?php

namespace Database\Seeders;

use App\Models\Evenement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class EvenementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Evenement::create([
            'titre' => 'Conférence Laravel',
            'description' => 'Un événement dédié à Laravel.',
            'online' => true,
            'date_debut' => "2024-06-09 00:00:00",
            'image' => null, // Assurez-vous que l'image existe
            'lieu' => 'Dakar',
            'created_by' => 1, // Assurez-vous que cet utilisateur existe
            'modified_by' => 1,
            'domaine_id' => 1 // Assurez-vous que ce domaine existe
        ]);
        //
        // Ecrivez votre code ici pour générer plus d'événements
        Evenement::create([
            'titre' => 'Conférence Angular',
            'description' => 'Un événement dédié à Laravel.',
            'online' => false,
            'date_debut' => "2024-12-09 00:00:00",
            'image' => null, // Assurez-vous que l'image existe
            'lieu' => 'Dakar',
            'created_by' => 1, // Assurez-vous que cet utilisateur existe
            'modified_by' => 1,
            'domaine_id' => 1 // Assurez-vous que ce domaine existe
        ]);




    }
}
