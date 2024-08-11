<?php

namespace Database\Seeders;

use App\Models\Domaine;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Domaine::create([
        //     'nom' => 'Développement Web',
        //     'user_id' => 1, // Assurez-vous que cet utilisateur existe
        //     'created_by' => 1,
        //     'modified_by' => 1,
        //     'categorie_id' => 1 // Assurez-vous que cette catégorie existe
        // ]);
        Domaine::factory(10)->create();


    }
}
