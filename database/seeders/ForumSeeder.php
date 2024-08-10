<?php

namespace Database\Seeders;

use App\Models\Forum;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Forum::create([
            'titre' => 'Forum Laravel',
            'description' => 'Un forum pour discuter de Laravel.',
            'nombre_de_message' => 0,
            'nombre_de_vue' => 0,
            'dateCreation' => now(),
            'domaine_id' => 1 // Assurez-vous que ce domaine existe
        ]);

    }
}
