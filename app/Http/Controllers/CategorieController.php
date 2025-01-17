<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Categorie;
use App\Models\SousDomaine;
use Illuminate\Http\Response;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorie = Categorie::all();
        return $categorie;
    }

    /**
     *
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategorieRequest $request)
    {
        return Categorie::create($request->all());
    }

    /**b
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        // Load domaines with their respective sousDomaines
        $categorie->load('domaines.sousDomaines');

        // Return response with the nested structure
        return response()->json([
            'categorie' => $categorie,
            'domaines' => $categorie->domaines,
        ]);
    }

    public function getSousDomaines(Domaine $domaine)
    {
        // Load only the sousDomaines for the selected domaine
        $sousDomaines = $domaine->sousDomaines;

        // Return the subdomains as a JSON response
        return response()->json([
            'sousDomaines' => $sousDomaines,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorieRequest $request, Categorie $categorie)
    {

        $categorie->update($request->all());
        return $categorie;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        if (Auth::id() !== $guide->created_by && !Auth::user()->hasRole('super_admin')) {
            return response()->json(['message' => 'Vous n\'êtes pas autorisé à modifier cette ressource'], 403);
        }
        $categorie->delete();
        return $this->customJsonResponse("Étudiant supprimé avec succès", null, Response::HTTP_OK);

    }
}
