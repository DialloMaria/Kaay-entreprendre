<?php


namespace Database\Seeders;



use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        Role::firstOrCreate(['name' => 'super_admin']);
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'entrepreneur']);

        // Créez des utilisateurs



        $user1=  User::create([
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
        ]);
        $user1->assignRole('super_admin');

        $user1a=  User::create([
            'nom' => 'Talla',
            'prenom' => 'Coach Saliou',
            'adresse' => 'Dakar, Senegal',
            'telephone' => '77 123 45 12',
            'specialisation' => 'Développeur seniors',
            'biographie' => 'Développeur passionné par les nouvelles technologies.',
            'email' => 'cheikhserignesalioutalla@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Changez le mot de passe selon vos besoins
            'remember_token' => Str::random(10),
        ]);
        $user1a->assignRole('super_admin');


        $user2 = User::create([
            'nom' => 'Ndiaye',
            'prenom' => 'Alpha',
            'adresse' => 'Dakar, Senegal',
            'telephone' => '77 123 45 67',
            'specialisation' => 'Agriculture',
            'biographie' => 'Développeur passionné par les nouvelles technologies.',
            'email' => 'barroama23@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Changez le mot de passe selon vos besoins
            'remember_token' => Str::random(10),
        ]);
        $user2->assignRole('admin');

        $user2a = User::create([
            'nom' => 'Ndiaye',
            'prenom' => 'Alpha',
            'adresse' => 'Dakar, Senegal',
            'telephone' => '77 123 45 67',
            'specialisation' => 'Informatiques',
            'biographie' => 'Développeur passionné par les nouvelles technologies.',
            'email' => 'alphandiaye383@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Changez le mot de passe selon vos besoins
            'remember_token' => Str::random(10),
        ]);
        $user2a->assignRole('admin');

        $user3 = User::create([
            'nom' => 'Diallo',
            'prenom' => 'Mariama',
            'adresse' => 'Dakar, Senegal',
            'telephone' => '77 123 45 67',
            'specialisation' => 'Développeur Web',
            'biographie' => 'Développeur passionné par les nouvelles technologies.',
            'email' => 'mdiallomariam0715@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Changez le mot de passe selon vos besoins
            'remember_token' => Str::random(10),
        ]);
        $user3->assignRole('entrepreneur');

        $user3a = User::create([
            'nom' => 'Ndiaye',
            'prenom' => 'Julinho',
            'adresse' => 'Dakar, Senegal',
            'telephone' => '77 123 45 67',
            'specialisation' => 'Développeur Web',
            'biographie' => 'Développeur passionné par les nouvelles technologies.',
            'email' => 'julinhondiaye097@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Changez le mot de passe selon vos besoins
            'remember_token' => Str::random(10),
        ]);
        $user3a->assignRole('entrepreneur');


        $user4 = User::create([
            'nom' => 'Barro',
            'prenom' => 'Amadou',
            'adresse' => 'Dakar, Senegal',
            'telephone' => '77 122 45 67',
            'specialisation' => 'Développeur Web',
            'biographie' => 'Développeur passionné par les nouvelles technologies.',
            'email' => 'barro@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Changez le mot de passe selon vos besoins
            'remember_token' => Str::random(10),
        ]);




    }
}
