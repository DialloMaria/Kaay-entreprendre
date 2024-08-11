<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

       /* User::create([
            'nom' => 'Ndiaye',
            'prenom' => 'Souleymane',
            'adresse' => 'Dakar, Senegal',
            'telephone' => '77 123 45 67',
            'specialisation' => 'Développeur Web',
            'biographie' => 'Développeur passionné par les nouvelles technologies.',
            'email' => 'souleymane9700@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Changez le mot de passe selon vos besoins
            'remember_token' => Str::random(10),
        ]); */
        //
        User::factory(10)->create();
    }
}
