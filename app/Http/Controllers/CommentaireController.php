<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCommentaireRequest;
use App\Http\Requests\UpdateCommentaireRequest;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commentaire = Commentaire::with('guide', 'creator')->get();
        return $this->customJsonResponse("Ressouces", $commentaire);


    }



    /**
     * Show the form for creating a new resource.
     */



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentaireRequest $request)
    {
        return commentaire::create($request->all());

    }

    /**
     * Display the specified resource.
     */
    public function show(Commentaire $commentaire)
    {
        $commentaire->load('guide', 'creator');

        // Retourne une réponse JSON personnalisée
        return $this->customJsonResponse("Commentaire", $commentaire);
    }



    /**
     * Update the specified resource in storage.
     */

     public function update(UpdateCommentaireRequest $request, Commentaire $commentaire)
     {
        if (Auth::id() !== $commentaire->created_by) {
            return response()->json(['message' => 'Vous n\'êtes pas autorisé à modifier cette commentaire'], 403);
        }

        // Mettre à jour la commentaire avec les données validées
        $commentaire->fill($request->validated());

        // Mettre à jour l'utilisateur qui modifie la commentaire
        $commentaire->modified_by = Auth::id();

        // Sauvegarder les modifications dans la base de données
        $commentaire->save();
        return $this->customJsonResponse("Commentaire mis à jour avec succès", $commentaire);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commentaire $commentaire)
    {
        $commentaire->delete();
        return $this->customJsonResponse("commentaire supprimé avec succès",$commentaire);

    }
}
