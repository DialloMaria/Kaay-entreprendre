<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemoignageRequest;
use App\Http\Requests\UpdateTemoignageRequest;
use App\Models\Temoignage;

class TemoignageController extends Controller
{
     // Create a new témoignage
     public function store(StoreTemoignageRequest $request)
     {
         try {
             $temoignage = new Temoignage();
             $temoignage->titre = $request->input('titre');
             $temoignage->description = $request->input('description');
             $temoignage->guide_id = $request->input('guide_id');
             $temoignage->created_by = Auth::id(); // Utiliser l'ID de l'utilisateur connecté
             $temoignage->save();

             return response()->json(['message' => 'Témoignage créé avec succès', 'data' => $temoignage], 201);
         } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la création du témoignage', 'error' => $e->getMessage()], 500);
         }
     }

     // Update a témoignage
     public function update(UpdateTemoignageRequest $request, $id)
     {
         try {
             $temoignage = Temoignage::findOrFail($id);
             if ($temoignage->created_by !== Auth::id()) {
                 return response()->json(['message' => 'Non autorisé'], 403);
             }

             $temoignage->titre = $request->input('titre');
             $temoignage->description = $request->input('description');
             $temoignage->guide_id = $request->input('guide_id');
             $temoignage->modified_by = Auth::id(); // Utiliser l'ID de l'utilisateur connecté pour la modification
             $temoignage->save();

             return response()->json(['message' => 'Témoignage mis à jour avec succès', 'data' => $temoignage], 200);
         } catch (\Exception $e) {
             return response()->json(['message' => 'Erreur lors de la mise à jour du témoignage', 'error' => $e->getMessage()], 500);
         }
     }


// Read a single témoignage
public function show($id)
{
    try {
        $temoignage = Temoignage::findOrFail($id);
        return response()->json($temoignage);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Erreur lors de la récupération du témoignage', 'error' => $e->getMessage()], 500);
    }
}


// Delete a témoignage
public function destroy($id)
{
    try {
        $temoignage = Temoignage::findOrFail($id);
        if ($temoignage->created_by !== Auth::id()) {
            return response()->json(['message' => 'Non autorisé'], 403);
        }

        $temoignage->delete();

        return response()->json(['message' => 'Témoignage supprimé avec succès'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Erreur lors de la suppression du témoignage', 'error' => $e->getMessage()], 500);
    }

}
}
