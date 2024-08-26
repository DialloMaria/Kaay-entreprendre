<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\SousDomaine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DomaineInscription;
use App\Http\Requests\StoreDomaineRequest;
use App\Http\Requests\UpdateDomaineRequest;

class DomaineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domaine = Domaine::with(['creator', 'modifier', 'categorie'])->get();
        return $this->customJsonResponse("domaine retrieved successfully", $domaine);
    }

    
    public function domainebycategorie($categorieId = null)
{
    if ($categorieId) {
        // Filtrer les domaines par catégorie spécifique
        $domaines = Domaine::where('categorie_id', $categorieId)
                           ->with(['creator', 'modifier'])
                           ->get();
    } else {
        // Récupérer tous les domaines avec leurs catégories
        $domaines = Domaine::with(['creator', 'modifier', 'categorie'])->get();
    }

    return $this->customJsonResponse("Domaines retrieved successfully", $domaines);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDomaineRequest $request)
    {
         // Validation des données de la requête
         $data = $request->validated();
         // Création d'une nouvelle instance de Domaine
         $domaine = new Domaine();
         $domaine->fill($data);
         $domaine->created_by = auth()->id();
         $domaine->save();

         return $this->customJsonResponse("Domaine cree successfully", $domaine);

    }

    /**
     * Display the specified resource.
     */
    public function show(Domaine $domaine)
    {
        //
        $domaine->load('categorie');

        // Retourne une réponse JSON personnalisée
        return $this->customJsonResponse("Domaine", $domaine);
        // Retourne une réponse JSON personnalisée
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Domaine $domaine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDomaineRequest $request, Domaine $domaine)
    {


                 if (Auth::id() !== $domaine->created_by) {
                    return response()->json(['message' => 'Vous n\'êtes pas autorisé à modifier cette domaine'], 403);
                }

                // Mettre à jour la domaine avec les données validées
                $domaine->fill($request->validated());

                // Mettre à jour l'utilisateur qui modifie la domaine
                $domaine->modified_by = Auth::id();

                // Sauvegarder les modifications dans la base de données
                $domaine->save();
                return $this->customJsonResponse("Domaine mis à jour avec succès", $domaine);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domaine $domaine)
    {
        $domaine->delete();
        return $this->customJsonResponse("forum supprimé avec succès",  $domaine);

    }


    public function inscrire(Request $request, $domaineId)
    {
        $user = Auth::user();
        $domaine = SousDomaine::findOrFail($domaineId);

        // Vérifiez si l'utilisateur est déjà inscrit à ce domaine
        if ($user->domaines->contains($domaineId)) {
            return response()->json(['message' => 'Vous êtes déjà inscrit à ce domaine.'], 400);
        }

        // Inscription de l'utilisateur au domaine
        $user->domaines()->attach($domaineId);
// Inscription de l'utilisateur au domaine

// Envoi de la notification
$user->notify(new DomaineInscription($domaine));
        return response()->json(['message' => 'Inscription réussie.'], 200);
    }


   
}