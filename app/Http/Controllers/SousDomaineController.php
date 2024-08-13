<?php

namespace App\Http\Controllers;

use App\Models\SousDomaine;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreSousDomaineRequest;
use App\Http\Requests\UpdateSousDomaineRequest;

class SousDomaineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sousDomaine = SousDomaine::with(['creator', 'modifier', 'domaine'])->get();
        return $this->customJsonResponse("sous$sousDomaine retrieved successfully", $sousDomaine);
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
    public function store(StoreSousDomaineRequest $request)
    {
 // Validation des données de la requête
 $data = $request->validated();

 // Création d'une nouvelle instance de SousDomaine
 $sousDomaine = new SousDomaine();
 $sousDomaine->fill($data);
 $sousDomaine->created_by = Auth::id();
 $sousDomaine->save();

 return $this->customJsonResponse("Sous-domaine créé avec succès", $sousDomaine, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(SousDomaine $sousDomaine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SousDomaine $sousDomaine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSousDomaineRequest $request, SousDomaine $sousDomaine)
    {
         // Validation des données de la requête
 $data = $request->validated();

 // Création d'une nouvelle instance de SousDomaine
 $sousDomaine = new SousDomaine();
 $sousDomaine->fill($data);
 $sousDomaine->modified_by = Auth::id();
 $sousDomaine->save();

 return $this->customJsonResponse("Sous-domaine créé avec succès", $sousDomaine, Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SousDomaine $sousDomaine)
    {
        $sousDomaine->delete();
        return $this->customJsonResponse("domaine$sousDomaine supprimé avec succès", null, Response::HTTP_OK);

    }
}
