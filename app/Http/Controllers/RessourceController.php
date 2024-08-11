<?php

namespace App\Http\Controllers;

use App\Models\Ressource;
use App\Http\Requests\StoreRessourceRequest;
use App\Http\Requests\UpdateRessourceRequest;
use Illuminate\Support\Facades\Auth;


class RessourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
    // Get all resources
    $resources = Ressource::with('guide', 'creator', 'modifier')->get();
    return $this->customJsonResponse("Ressouces", $resources);


    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRessourceRequest $request)
    {
        // Validate the request

        $resource = new Ressource();
        $resource->fill($request->all());
        $resource->created_by = Auth::id();

        $resource->save();
        return $this->customJsonResponse("Ressource créée avec succès", $resource);

    }

    /**
     * Display the specified resource.
     */
    public function show(Ressource $ressource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ressource $ressource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRessourceRequest $request, Ressource $ressource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ressource $ressource)
    {
        //
    }
}
