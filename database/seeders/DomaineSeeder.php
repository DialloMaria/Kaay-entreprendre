<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Domaine;
use App\Models\User;
use App\Models\Categorie;

class DomaineSeeder extends Seeder
{
    public function run()
    {
        
        User::factory()->count(5)->create();
        Categorie::factory()->count(5)->create();

       
        Domaine::factory()->count(5)->create();
    }
}
