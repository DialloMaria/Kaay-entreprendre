<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDomaineRequest;
use App\Http\Requests\UpdateDomaineRequest;

class DomaineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domaine $domaine)
    {
        //
    }


    public function inscrire(Request $request, $domaineId)
    {
        $user = Auth::user();
        $domaine = Domaine::findOrFail($domaineId);

        // Vérifiez si l'utilisateur est déjà inscrit à ce domaine
        if ($user->domaines->contains($domaineId)) {
            return response()->json(['message' => 'Vous êtes déjà inscrit à ce domaine.'], 400);
        }

        // Inscription de l'utilisateur au domaine
        $user->domaines()->attach($domaineId);

        return response()->json(['message' => 'Inscription réussie.'], 200);
    }

   
}
