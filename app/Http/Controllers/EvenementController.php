<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Evenement;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreEvenementRequest;
use App\Http\Requests\UpdateEvenementRequest;

class EvenementController extends Controller
{
    public function index()
    {
        try {
            $evenements = Evenement::with('domaine')->get();
            return response()->json($evenements, 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des événements',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $evenement = Evenement::with('domaine')->find($id);

            if (!$evenement) {
                return response()->json(['message' => 'Événement non trouvé'], 404);
            }

            return response()->json($evenement, 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la récupération de l\'événement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEvenementRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreEvenementRequest $request)
    {

        $evenement = new Evenement();
        $evenement->fill($request->validated()); // Utilise les données validées
        $evenement->created_by = Auth::id(); // Associe l'utilisateur actuellement connecté
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $evenement->image = $image->store('evenements', 'public');
        }
        // Enregistre la ressource dans la base de données
        $evenement->save();
        return $this->customJsonResponse("Evenement créée avec succès", $evenement);


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEvenementRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateEvenementRequest $request, $id)
{
    try {

        $validated = $request->validated();
        $evenement = Evenement::find($id);

        if (!$evenement) {
            return response()->json(['message' => 'Événement non trouvé'], 404);
        }
             // Vérifier si l'utilisateur connecté est celui qui a créé la ressource ou s'il est super admin
    // if (Auth::id() !== $ressource->created_by && !Auth::user()->hasRole('super_admin')) {
        if (Auth::id() !== $evenement->created_by) {
            return response()->json(['message' => 'Vous n\'êtes pas autorisé à modifier cette evenement'], 403);
        }
        $evenement->modified_by = Auth::id();
        // image


if ($request->hasFile('image')) {
                // Suppression de l'ancienne image s'il y en a une
                if ($evenement->image) {
                    Storage::disk('public')->delete($evenement->image);
                }

                // Stockage de la nouvelle image
                $image = $request->file('image');
                $evenement->image = $image->store('evenements', 'public');
            }


        $evenement->update($validated);
        return $this->customJsonResponse("Evénement mise à jour avec succès", $evenement);
    } catch (Exception $e) {
        return response()->json([
            'message' => 'Erreur lors de la mise à jour de l\'événement',
            'error' => $e->getMessage()
        ], 500);
    }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {

            $evenement = Evenement::find($id);

            if (!$evenement) {
                return response()->json(['message' => 'Événement non trouvé'], 404);
            }

            $evenement->delete();
            return $this->customJsonResponse('Événement supprimé avec succès', $evenement);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la suppression de l\'événement',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    
}
