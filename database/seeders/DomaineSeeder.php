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
        //
        Domaine::factory(10)->create();
    }
}
