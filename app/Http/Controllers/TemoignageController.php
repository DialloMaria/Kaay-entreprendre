<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTemoignageRequest;
use App\Http\Requests\UpdateTemoignageRequest;

class TemoignageController extends Controller
{ // List all témoignages
    public function index()
    {
        try {
            $temoignages = Temoignage::all();
            return response()->json(['data' => $temoignages], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la récupération des témoignages', 'error' => $e->getMessage()], 500);
        }
    }

    // Create a new témoignage
    public function store(StoreTemoignageRequest $request)
    {
        try {
          $user = User::find(Auth::id());

            if (!$user) {
                return response()->json(['message' => 'Utilisateur non trouvé'], 404);
            }

            $temoignage = new Temoignage();
            $temoignage->titre = $request->input('titre');
            $temoignage->description = $request->input('description');
            $temoignage->guide_id = $request->input('guide_id');
            $temoignage->created_by = $user->id; // Utiliser l'ID de l'utilisateur connecté
            $temoignage->save();

            return response()->json(['message' => 'Témoignage créé avec succès', 'data' => $temoignage], 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Erreur lors de la création du témoignage', 'error' => $e->getMessage()], 500);
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

    // Update a témoignage
    public function update(Request $request, $id)
    {
        try {
            $user = User::find(Auth::id());

            if (!$user) {
                return response()->json(['message' => 'Utilisateur non trouvé'], 404);
            }

            $temoignage = Temoignage::findOrFail($id);
            if ($temoignage->created_by !== $user->id) {
                return response()->json(['message' => 'Non autorisé'], 403);
            }

            $temoignage->titre = $request->input('titre');
            $temoignage->description = $request->input('description');
            $temoignage->guide_id = $request->input('guide_id');
            $temoignage->modified_by = 41; // Utiliser l'ID de l'utilisateur connecté pour la modification
            $temoignage->update();

            return response()->json(['message' => 'Témoignage mis à jour avec succès', 'data' => $temoignage], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la mise à jour du témoignage', 'error' => $e->getMessage()], 500);
        }
    }

    // Delete a témoignage
    public function destroy($id)
    {
        try {
            $user = User::find(Auth::id());

            if (!$user) {
                return response()->json(['message' => 'Utilisateur non trouvé'], 404);
            }

            $temoignage = Temoignage::findOrFail($id);
            if ($temoignage->created_by !== $user->id) {
                return response()->json(['message' => 'Non autorisé'], 403);
            }
           // $temoignage = Temoignage::findOrFail($id);
            $temoignage->delete();

            return response()->json(['message' => 'Témoignage supprimé avec succès'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la suppression du témoignage', 'error' => $e->getMessage()], 500);
        }
    }
}
