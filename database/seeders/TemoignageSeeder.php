<?php

namespace Database\Seeders;

use App\Models\Temoignage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TemoignageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Temoignage::create([
            'titre' => 'Un parcours inspirant',
            'description' => 'J\'ai suivi ce guide et il a changé ma vie.',
            'created_by' => 1, // Assurez-vous que cet utilisateur existe
            'modified_by' => 1,
            'guide_id' => 1 // Assurez-vous que ce guide existe
        ]);
    }
}
