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
            'lieu' => 'Dakar',
            'created_by' => 1, // Assurez-vous que cet utilisateur existe
            'modified_by' => 1,
            'domaine_id' => 1 // Assurez-vous que ce domaine existe
        ]);
        //
        Evenement::factory(10)->create();
    }
}
