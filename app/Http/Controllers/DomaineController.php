<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Response;
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

         return $this->customJsonResponse("Domaine cree successfully", $domaine, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Domaine $domaine)
    {
        //
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
                 // Validation des données de la requête
                 $data = $request->validated();
                 // Création d'une nouvelle instance de Domaine
                 $domaine = new Domaine();
                 $domaine->fill($data);
                 $domaine->modified_by = auth()->id();
                 $domaine->save();

                 return $this->customJsonResponse("Domaine cree successfully", $domaine, 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domaine $domaine)
    {
        $domaine->delete();
        return $this->customJsonResponse("forum supprimé avec succès", null, Response::HTTP_OK);

    }
}
