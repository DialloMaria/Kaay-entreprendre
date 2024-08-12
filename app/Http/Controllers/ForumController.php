<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreForumRequest;
use App\Http\Requests\UpdateForumRequest;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $forum = Forum::all();
        // return $forum;
        $forums = Forum::with(['creator', 'modifier', 'domaine'])->get();
        return $this->customJsonResponse("Forums retrieved successfully", $forums);
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
    public function store(StoreForumRequest $request)
    {

        // $forum = Forum::create($request->all());
        // return $this->customJsonResponse("forum supprimé avec succès", $forum);

         // Validation des données de la requête
         $data = $request->validated();

         // Création d'une nouvelle instance de Forum
         $forum = new Forum();
         $forum->fill($data);
         $forum->created_by = Auth::id();
         $forum->save();

         return $this->customJsonResponse("Forum created successfully", $forum, Response::HTTP_CREATED);


    }

    /**
     * Display the specified resource.
     */
    public function show(Forum $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $forum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForumRequest $request, Forum $forum)
    {
        $forum->update($request->validated());
        return response()->json($forum, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum)
    {
        $forum->delete();
        return $this->customJsonResponse("forum supprimé avec succès", null, Response::HTTP_OK);

    }
}
