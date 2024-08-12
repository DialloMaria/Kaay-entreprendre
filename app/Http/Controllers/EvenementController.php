<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Evenement;
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
    try {/*
        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non authentifié'], 401);
        }
*/
        $validated = $request->validated();
        $evenement = Evenement::create($validated);
      
        return response()->json($evenement, 201);
    } catch (Exception $e) {
        return response()->json([
            'message' => 'Erreur lors de la création de l\'événement',
            'error' => $e->getMessage()
        ], 500);
    }
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

        $evenement->update($validated);
        return response()->json($evenement, 200);
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
            return response()->json(['message' => 'Événement supprimé avec succès'], 204);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Erreur lors de la suppression de l\'événement',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
