<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Forum;
use App\Models\Guide;
use App\Models\Domaine;
use App\Models\Message;
use App\Models\Categorie;
use App\Models\Evenement;
use App\Models\Ressource;
use App\Models\UserEvent;
use App\Models\Temoignage;
use App\Models\Commentaire;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    public function run(): void
    {

          // Désactiver la vérification des clés étrangères pour éviter les erreurs
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Truncate des tables
    User::truncate();
    Categorie::truncate();
    Domaine::truncate();
    Guide::truncate();
    Temoignage::truncate();
    Forum::truncate();
    Message::truncate();
    Evenement::truncate();
    Commentaire::truncate();
    Ressource::truncate();
    UserEvent::truncate();
    Role::truncate();
    Permission::truncate();

    // Réactiver la vérification des clés étrangères
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            CategorieSeeder::class,
            DomaineSeeder::class,
            GuideSeeder::class,
            TemoignageSeeder::class,
            CommentaireSeeder::class,
            ForumSeeder::class,
            MessageSeeder::class,
            EvenementSeeder::class,
            CommentaireSeeder::class,
            RessourceSeeder::class,
            UserEventSeeder::class,

        ]);
    }
}
