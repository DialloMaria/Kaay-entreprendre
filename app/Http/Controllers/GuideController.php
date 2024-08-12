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
            'media' => 'required|string',
            'auteur' => 'required|string',
            'domaine_id' => 'required|exists:domaines,id',
        ]);

        try {
            $guide = Guide::create($request->all());
            return response()->json($guide, 201);
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

    return response()->json($guide);
}


    public function destroy(Guide $guide)
    {
        $guide->delete();
        return response()->json(null, 204);
    }
}
