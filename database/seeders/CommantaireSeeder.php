<?php

namespace Database\Seeders;

use App\Models\Commantaire;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommantaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Commantaire::create([
            'contenu' => 'Très bon guide, merci !',
            'guide_id' => 2, // Assurez-vous que ce guide existe
            'created_by' => 2, // Assurez-vous que cet utilisateur existe
            'modified_by' => 2,
        ]);
    }
}
