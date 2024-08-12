<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Guide;
use App\Models\User;
use App\Models\Domaine;

class GuideSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Ensure there are users and domaines to reference
        $userId = User::first()->id;
        $domaineId = Domaine::first()->id;

        // Insert sample guides
        Guide::create([
            'titre' => 'Guide Example 1',
            'contenu' => 'This is the content of the first guide.',
            'datepublication' => now()->toDateString(),
            'media' => 'media1.jpg',
            'auteur' => 'Author 1',
            'domaine_id' => $domaineId,
            'user_id' => $userId,
        ]);

        Guide::create([
            'titre' => 'Guide Example 2',
            'contenu' => 'This is the content of the second guide.',
            'datepublication' => now()->toDateString(),
            'media' => 'media2.jpg',
            'auteur' => 'Author 2',
            'domaine_id' => $domaineId,
            'user_id' => $userId,
        ]);
    }
}
