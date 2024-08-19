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
        $domaineMicroEntrepriseId = Domaine::where('nom', 'Micro-Entreprise')->first()->id;
        $domaineMacroEntrepriseId = Domaine::where('nom', 'Macro-Entreprise')->first()->id;

        // Informatiques

        SousDomaine::create([
            'nom' => 'Développement Web',
            'description' => 'Développez des applications web et mobiles',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineInformatiqueId
        ]);

        SousDomaine::create([
            'nom' => 'Systèmes d\'information',
            'description' => ' Description Systèmes d\'information ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineInformatiqueId


        ]);

        SousDomaine::create([
            'nom' => 'Systèmes d\'information',
            'description' => ' Description Systèmes d\'information ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineInformatiqueId


        ]);
        // Sante


        SousDomaine::create([
            'nom' => 'Pharmacie',
            'description' => 'Description Pharmacie ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineSanteId
        ]);
        SousDomaine::create([
            'nom' => 'Médecine',
            'description' => 'Description Médecine ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineSanteId
        ]);
        SousDomaine::create([
            'nom' => 'Soins Intensifs',
            'description' => 'Description Soins Intensifs ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineSanteId
        ]);





        SousDomaine::create([
            'nom' => 'Réseau et Informatique',
            'description' => 'Description Réseau et Informatique ',
            'image' => 'https://picsum.photos/200/300',

            'domaine_id' => $domaineInformatiqueId
        ]);

        // Agriculture
        SousDomaine::create([
            'nom' => 'Agriculture Durable',
            'description' => 'Description Agriculture Durable ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineAgricultureId
        ]);

        SousDomaine::create([
            'nom' => 'Gestion des ressources',
            'description' => 'Description Gestion des ressources ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineAgricultureId
        ]);
        SousDomaine::create([
            'nom' => 'Environnement',
            'description' => 'Description Environnement ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineAgricultureId
        ]);

        // sante

        SousDomaine::create([
            'nom' => 'Santé',
            'description' => 'Description Santé ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineSanteId
        ]);

        // Micro-Entreprise
        SousDomaine::create([
            'nom' => 'Création d\'entreprise',
            'description' => 'Description Création d\'entreprise ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineMacroEntrepriseId
        ]);

        SousDomaine::create([
            'nom' => 'Gestion d\'entreprise',
            'description' => 'Description Gestion d\'entreprise ',
            'domaine_id' => $domaineMacroEntrepriseId
        ]);
        SousDomaine::create([
            'nom' => 'Financement d\'entreprise',
            'description' => 'Description Financement d\'entreprise ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineMacroEntrepriseId
        ]);

        // Macro-Entreprise
        SousDomaine::create([
            'nom' => 'Gestion de portefeuille',
            'description' => 'Description Gestion de portefeuille ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineMicroEntrepriseId
        ]);

        SousDomaine::create([
            'nom' => 'Gestion de la valeur ajoutée',
            'description' => 'Description Gestion de la valeur ajoutée ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineMicroEntrepriseId
        ]);
        SousDomaine::create([
            'nom' => 'Gestion de la valeur mobilière',
            'description' => 'Description Gestion de la valeur mobilière ',
            'image' => 'https://picsum.photos/200/300',
            'domaine_id' => $domaineMicroEntrepriseId
        ]);





    }
}
