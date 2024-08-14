<?php

namespace Database\Seeders;

use App\Models\Guide;
use App\Models\Ressource;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GuideSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

         // Guide 1

        Guide::create([
            'titre' => 'Créer et Lancer un Site Web Professionnel',
            'contenu' => 'Ce guide couvre les étapes nécessaires pour créer et lancer un site web professionnel, depuis la planification jusqu’au déploiement.',
            'datepublication' => now(),
            'etape' => 1,
            'media' => 'url_to_resource',
            'domaine_id' => 1, // Domaine : Développement Web
            'created_by' => 4,
            'modified_by' => null,
        ]);

        // Ajoutez des ressources spécifiques
        Ressource::create([
            'titre' => 'Introduction à HTML et CSS',
            'description' => 'Apprenez les bases du HTML et CSS pour créer des pages web.',
            'lien' => 'https://developer.mozilla.org/en-US/docs/Web/HTML',
            'type' => 'Article',
            'guide_id' => 1,
            'created_by' => 4,
            'modified_by' => null,
        ]);

        Ressource::create([
            'titre' => 'Guide complet sur JavaScript',
            'description' => 'Comprenez les bases de JavaScript et comment l’utiliser pour ajouter de l’interactivité à votre site.',
            'lien' => 'https://javascript.info/',
            'type' => 'Article',
            'guide_id' => 1,
            'created_by' => 4,
            'modified_by' => null,
        ]);


        // Guide 2
        // Ensure there are users and domaines to reference
        Guide::create([
            'titre' => 'Construire un Portfolio pour Développeur Web',
            'contenu' => 'Ce guide fournit des étapes détaillées pour créer un portfolio web efficace qui met en avant vos projets et compétences en développement web.',
            'datepublication' => now(),
            'etape' => 2,
            'media' => 'url_to_resource',
            'domaine_id' => 1, // Domaine : Développement Web
            'created_by' => 4,
            'modified_by' => null,
        ]);

        // Ajoutez des ressources spécifiques
        Ressource::create([
            'titre' => 'Créer un Portfolio avec HTML et CSS',
            'description' => 'Un tutoriel pour créer un portfolio professionnel en utilisant HTML et CSS.',
            'lien' => 'https://www.freecodecamp.org/news/how-to-build-a-personal-website-with-html-css/',
            'type' => 'Article',
            'guide_id' => 2,
            'created_by' => 4,
            'modified_by' => null,
        ]);

        Ressource::create([
            'titre' => 'Défis de Front-End pour votre Portfolio',
            'description' => 'Des projets pratiques pour enrichir votre portfolio avec des défis front-end.',
            'lien' => 'https://www.frontendmentor.io/challenges',
            'type' => 'Challenge',
            'guide_id' => 2,
            'created_by' => 4,
            'modified_by' => null,
        ]);


        // Guide 3

        Guide::create([
            'titre' => 'Monétiser Votre Compétence en Développement Web',
            'contenu' => 'Découvrez comment monétiser vos compétences en développement web grâce au freelancing, à la création de produits numériques et à la consultation.',
            'datepublication' => now(),
            'etape' => 3,
            'media' => 'url_to_resource',
            'domaine_id' => 1, // Domaine : Développement Web
            'created_by' => 4,
            'modified_by' => null,
        ]);

        // Ajoutez des ressources spécifiques
        Ressource::create([
            'titre' => 'Conseils pour Freelancers en Développement Web',
            'description' => 'Un guide pour réussir en tant que freelance dans le domaine du développement web.',
            'lien' => 'https://www.smashingmagazine.com/2017/03/freelancing-web-developer-tips/',
            'type' => 'Article',
            'guide_id' => 3,
            'created_by' => 4,
            'modified_by' => null,
        ]);

        Ressource::create([
            'titre' => 'Créer un Produit Numérique',
            'description' => 'Un cours en ligne pour apprendre à créer et monétiser un produit numérique.',
            'lien' => 'https://www.coursera.org/learn/building-a-digital-product',
            'type' => 'Cours',
            'guide_id' => 3,
            'created_by' => 4,
            'modified_by' => null,
        ]);




    }
}
