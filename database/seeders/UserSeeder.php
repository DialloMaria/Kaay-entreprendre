<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nom' => 'Doe',
            'prenom' => 'John',
            'adresse' => '123 Main St',
            'telephone' => '123-456-7890',
            'specialisation' => 'Developer',
            'biographie' => 'A passionate developer with experience in various technologies.',
            'email' => 'unique.alpha@example.com', 
            'password' => bcrypt('password'),
        ]);

        
    }
}
