<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Message::create([
            'nom' => 'Premier message',
            'forum_id' => 1, // Assurez-vous que ce forum existe
            'created_by' => 1, // Assurez-vous que cet utilisateur existe
            'modified_by' => 1,
        ]);

    }
}
