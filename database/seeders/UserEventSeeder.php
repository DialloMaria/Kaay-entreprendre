<?php

namespace Database\Seeders;

use App\Models\UserEvent;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserEvent::create([
            'user_id' => 1, // Assurez-vous que cet utilisateur existe
            'evenement_id' => 1 // Assurez-vous que cet événement existe
        ]);
    }
}
