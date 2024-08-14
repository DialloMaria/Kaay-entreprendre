<?php
namespace App\Http\Controllers;

use App\Models\Guide;
use App\Models\Domaine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreGuideRequest;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::with('sousDomaine', 'creator')->get();
        return response()->json($guides);
    }


    public function store(StoreGuideRequest $request)
{
    // Récupération de l'utilisateur authentifié
    $user = Auth::user();

    // Récupération du domaine spécifié
    $domaine = Domaine::find($request->domaine_id);

    if (!$domaine) {
        return response()->json(['error' => 'Domaine non trouvé'], 404);
    }

    // Vérification que l'utilisateur est un super administrateur ou a la spécialisation requise
    if (!$user->hasRole('super_admin') && $user->specialisation !== $domaine->nom) {
        return response()->json(['error' => 'Vous n\'êtes pas autorisé à créer un guide dans ce domaine'], 403);
    }

    try {
        // Création du guide
        $guide = new Guide();
        $guide->fill($request->validated()); // Remplit les attributs du guide avec les données validées
        $guide->created_by = $user->id; // Associe l'utilisateur actuellement connecté comme créateur

        // Enregistrement du guide dans la base de données
        $guide->save();

        // Réponse de succès avec les détails du guide créé
        return response()->json(['message' => 'Guide créée avec succès', 'guide' => $guide], 201);

    } catch (QueryException $e) {
        // Gestion des erreurs liées à la base de données
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



    public function show(Guide $guide)
    {
        $guide->with('domaine', 'creator')->get();

        return response()->json($guide);
    }

    public function update(Request $request, $id)
{
     // Récupération de l'utilisateur authentifié
     $user = Auth::user();

     // Récupération du domaine spécifié
     $domaine = Domaine::find($request->domaine_id);

     // Vérification si le domaine existe
     if (!$domaine) {
         return response()->json(['error' => 'Domaine non trouvé'], 404);
     }

     // Vérification des permissions : super administrateur ou spécialisation requise
     if (!$user->hasRole('super_admin') && $user->specialisation !== $domaine->nom) {
         return response()->json(['error' => 'Vous n\'êtes pas autorisé à créer un guide dans ce domaine'], 403);
     }

    $request->validate([
        'titre' => 'required|string|max:255',
        'contenu' => 'required|string',
        'datepublication' => 'required|date',
        'media' => 'required|string',
        'auteur' => 'required|string',
        'domaine_id' => 'required|exists:domaines,id',
    ]);

    $guide = Guide::findOrFail($id);
    $guide->update($request->all());

    return $this->customJsonResponse("Guide mise à jour avec succès", $guide);
}


    public function destroy(Guide $guide)
    {
         // Récupération de l'utilisateur authentifié

    if (Auth::id() !== $guide->created_by && !Auth::user()->hasRole('super_admin')) {
        return response()->json(['message' => 'Vous n\'êtes pas autorisé à modifier cette ressource'], 403);
    }


        try {


            if (!$guide) {
                return response()->json(['message' => 'Guide non trouvé'], 404);
            }

            $guide->delete();
            return $this->customJsonResponse('Guide supprimé avec succès', $guide);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la suppression de l\'Guide',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
