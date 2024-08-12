<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Commentaire;

class CommentaireSeeder extends Seeder
{
    public function run()
    {
        Commentaire::create([
            'contenu' => 'Très bon guide, merci !',
            'guide_id' => 1, // Assurez-vous que ce guide existe
            'created_by' => 1, // Assurez-vous que cet utilisateur existe
            'modified_by' => 1,
        ]);
    }
}

