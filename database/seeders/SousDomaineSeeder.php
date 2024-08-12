<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SousDomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SousDomaine::create([
        'nom' => 'Sous-domaine 1 pour ' . $domaine->nom,
        'domaine_id' => $domaine->id,
        'created_by' => User::inRandomOrder()->first()->id,
        'modified_by' => User::inRandomOrder()->first()->id,
    ]);

    SousDomaine::create([
        'nom' => 'Sous-domaine 2 pour ' . $domaine->nom,
        'domaine_id' => $domaine->id,
        'created_by' => User::inRandomOrder()->first()->id,
        'modified_by' => User::inRandomOrder()->first()->id,
    ]);
    }
}
