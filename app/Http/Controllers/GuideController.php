<?php
namespace App\Http\Controllers;

use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::all();
        return response()->json($guides);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'required|string',
            'datepublication' => 'required|date',
            'etape' => 'required|integer',
            'media' => 'required|string',
            'auteur' => 'required|string',
            'domaine_id' => 'required|exists:domaines,id',
            'created_by' => 'required|exists:users,id',
            'modified_by' => 'nullable|exists:users,id',
        ]);

        try {
            $guide = Guide::create($request->all());
            return $this->customJsonResponse("Guide créée avec succès", $guide);
        } catch (QueryException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Guide $guide)
    {
        return response()->json($guide);
    }

    public function update(Request $request, $id)
{
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
