<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SousDomaine;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SousDomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    SousDomaine::create([
        'nom' => 'Sous-domaine 1 pour ',
        'domaine_id' => 1,
        'created_by' => User::inRandomOrder()->first()->id,
        'modified_by' => User::inRandomOrder()->first()->id,
    ]);

    SousDomaine::create([
        'nom' => 'Sous-domaine 2 pour ',
        'domaine_id' => 1,
        'created_by' => User::inRandomOrder()->first()->id,
        'modified_by' => User::inRandomOrder()->first()->id,
    ]);
    }
}
