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
        //
        Temoignage::factory(10)->create();
    }
}
