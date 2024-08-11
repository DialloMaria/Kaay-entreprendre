<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentaireSeeder extends Seeder
{
    public function run()
    {
        DB::table('commentaires')->insert([
            [
                'contenu' => 'Ceci est un commentaire de test pour l\'événement 1.',
                'evenement_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'contenu' => 'Un autre commentaire pour tester.',
                'evenement_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'contenu' => 'Commentaire additionnel pour l\'événement 2.',
                'evenement_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

