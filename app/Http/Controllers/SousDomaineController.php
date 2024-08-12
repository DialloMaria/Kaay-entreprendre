<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSousDomaineRequest;
use App\Http\Requests\UpdateSousDomaineRequest;
use App\Models\SousDomaine;

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SousDomaine $sousDomaine)
    {
        //
    }
}
