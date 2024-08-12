<?php

namespace App\Http\Controllers;

use App\Models\Commantaire;
use Illuminate\Http\Response;
use App\Http\Requests\StoreCommantaireRequest;
use App\Http\Requests\UpdateCommantaireRequest;

class CommantaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commantaire = Commantaire::all();
        return $commantaire;
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
    public function store(StoreCommantaireRequest $request)
    {
        return commantaire::create($request->all());

    }

    /**
     * Display the specified resource.
     */
    public function show(Commantaire $commantaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commantaire $commantaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommantaireRequest $request, Commantaire $commantaire)
    {
        $commantaire->update($request->all());
        return $commantaire;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commantaire $commantaire)
    {
        $commantaire->delete();
        return $this->customJsonResponse("commentaire supprimé avec succès", null, Response::HTTP_OK);

    }
}
