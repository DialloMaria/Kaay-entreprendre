<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Domaine;
use App\Models\SousDomaine;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SousDomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domaineInformatiqueId = Domaine::where('nom', 'Informatiques')->first()->id;
        $domaineAgricultureId = Domaine::where('nom', 'Agriculture')->first()->id;
        $domaineSanteId = Domaine::where('nom', 'Santé')->first()->id;

        // Informatiques

        SousDomaine::create([
            'nom' => 'Développement Web',
            'domaine_id' => $domaineInformatiqueId
        ]);

        SousDomaine::create([
            'nom' => 'Systèmes d\'information',
            'domaine_id' => $domaineInformatiqueId
        ]);


        SousDomaine::create([
            'nom' => 'Réseau et Informatique',
            'domaine_id' => $domaineInformatiqueId
        ]);

        // Agriculture
        SousDomaine::create([
            'nom' => 'Agriculture Durable',
            'domaine_id' => $domaineAgricultureId
        ]);

        SousDomaine::create([
            'nom' => 'Gestion des ressources',
            'domaine_id' => $domaineAgricultureId
        ]);
        SousDomaine::create([
            'nom' => 'Environnement',
            'domaine_id' => $domaineAgricultureId
        ]);

        // sante

        SousDomaine::create([
            'nom' => 'Santé',
            'domaine_id' => $domaineAgricultureId
        ]);


    }
}
