<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorieSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,         // Doit être exécuté en premier car d'autres modèles dépendent de User
            CategorieSeeder::class,    // Peut être exécuté juste après User car Domaine en dépend
            DomaineSeeder::class,      // Dépend de User et Categorie
            GuideSeeder::class,        // Dépend de Domaine et User
            EvenementSeeder::class,    // Dépend de Domaine
            TemoignageSeeder::class,   // Dépend de Guide
        ]);
    }
}
