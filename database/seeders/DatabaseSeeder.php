<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorieSeeder::class,
            DomaineSeeder::class,
            GuideSeeder::class,
            TemoignageSeeder::class,
            ForumSeeder::class,
            MessageSeeder::class,
            EvenementSeeder::class,
            CommantaireSeeder::class,
            RessourceSeeder::class,
            UserEventSeeder::class,
        ]);
    }
}
