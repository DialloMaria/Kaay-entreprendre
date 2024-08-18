<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Guide;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request, string $id)
    {

            $user = User::find(Auth::id());
      /*
              if (!$user) {
                  return response()->json(['message' => 'Utilisateur non trouvé'], 404);
              } */
        // Validation des données reçues
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'specialisation' => ['nullable', 'string', 'max:255'],
            'biographie' => ['nullable', 'string', 'max:1000'],
        ]);

        // Recherche de l'utilisateur par son ID
        $user = User::findOrFail($id);

        // Mise à jour des informations de l'utilisateur
        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'specialisation' => $request->specialisation,
            'biographie' => $request->biographie,
        ]);

        // Retourne une réponse personnalisée
        return $this->customJsonResponse("Utilisateur mis à jour avec succès", $user);
    }

    // Dans routes/api.php

// Dans le DashboardController
// // Entrepreneurs inscrits 1 000 , Guides 100, Admin 1 000
// public function dashboardSuperAdmin() {
//     $entrepreneursCount = User::where('role', 'entrepreneur')->count();
//     $adminsCount = User::roles()->where('role', 'admin')->count();
//     $guidesCount = Guide::where('role', 'guide')->count();

//     return response()->json([
//         'entrepreneurs' => $entrepreneursCount,
//         'admins' => $adminsCount,
//         'guides' => $guidesCount,
//     ]);
// }
public function dashboardSuperAdmin() {
    $entrepreneursCount = User::whereHas('roles', function($query) {
        $query->where('name', 'entrepreneur');
    })->count();
    $adminsCount = User::whereHas('roles', function($query) {
        $query->where('name', 'admin');
    })->count();
    $guidesCount = Guide::all()->count();
    // Method voir static dans chaque categories nombre admins , nombre guides, nombre domaine et entrepreneur inscrire sur cette categorie

    $categorieDomaine = Categorie::domaine()->count();
    $categorieGuide= Categorie::domaine()->guide()->count();
    $categorieEntrepreneur = Categorie::user()->whereHas('roles', function($query) {
        $query->where('name', 'entrepreneur')->domaine();
    })->count();;






    return response()->json([
        'entrepreneurs' => $entrepreneursCount,
        'admins' => $adminsCount,
        'guides' => $guidesCount,
        'categorie_domaine' => $categorieDomaine,
        'categorie_guide' => $categorieGuide,
        'categorie_entrepreneur' => $categorieEntrepreneur,
    ]);
}
    // Method voir static dans chaque categories nombre admins , nombre guides, nombre domaine et entrepreneur inscrire sur cette categorie
    public function detailCategoreie() {
            // Method voir static dans chaque categories assicie nombre admins , nombre guides, nombre domaine et entrepreneur inscrire sur cette categorie
            // association
            // return response()->json([
            //     'entrepreneurs' => $entrepreneursCount,
            //     'admins' => $adminsCount,
            //     'guides' => $guidesCount,
            //     'domaines' => $domainesCount,
            // ]);



    }










// public function dashboardSuperAdmin() {
//     $entrepreneursCount = Entrepreneur::count();
//     $adminsCount = Admin::count();
//     $eventsCount = Event::count();

//     return response()->json([
//         'entrepreneurs' => $entrepreneursCount,
//         'admins' => $adminsCount,
//         'events' => $eventsCount,
//     ]);
// }

}
