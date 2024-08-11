<?php

namespace App\Http\Controllers;

use App\Models\Ressource;
use App\Http\Requests\StoreRessourceRequest;
use App\Http\Requests\UpdateRessourceRequest;
use Illuminate\Support\Facades\Auth;


class RessourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
    // Get all resources
    $resources = Ressource::with('guide', 'creator', 'modifier')->get();
    return $this->customJsonResponse("Ressouces", $resources);


    }


    /**
     * Store a newly created resource in storage.
     */
   /**
 * Store a newly created resource in storage.
 */
public function store(StoreRessourceRequest $request)
{
    // Création d'une nouvelle ressource
    $resource = new Ressource();
    $resource->fill($request->validated()); // Utilise les données validées
    $resource->created_by = Auth::id(); // Associe l'utilisateur actuellement connecté

    // Enregistre la ressource dans la base de données
    $resource->save();

    // Retourne une réponse JSON personnalisée
    return $this->customJsonResponse("Ressource créée avec succès", $resource);
}


    /**
     * Display the specified resource.
     */
    public function show(Ressource $ressource)
    {
        // white guide creator
        $ressource->load('guide', 'creator','modifier');

        // Retourne une réponse JSON personnalisée
        return $this->customJsonResponse("Ressource", $ressource);
        // Retourne une réponse JSON personnalisée


    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRessourceRequest $request, Ressource $ressource)
    {
        // Vérifier si l'utilisateur connecté est celui qui a créé la ressource ou s'il est super admin
    // if (Auth::id() !== $ressource->created_by && !Auth::user()->hasRole('super_admin')) {
        if (Auth::id() !== $ressource->created_by) {
        return response()->json(['message' => 'Vous n\'êtes pas autorisé à modifier cette ressource'], 403);
    }

    // Mettre à jour la ressource avec les données validées
    $ressource->fill($request->validated());

    // Mettre à jour l'utilisateur qui modifie la ressource
    $ressource->modified_by = Auth::id();

    // Sauvegarder les modifications dans la base de données
    $ressource->save();

    // Retourner une réponse JSON avec la ressource mise à jour
    return $this->customJsonResponse("Ressource mise à jour avec succès", $ressource);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ressource $ressource)
    {
        //
    }
}
