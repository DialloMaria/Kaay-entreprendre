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
        $data = $request->validated();
        $forum = Forum::create($data);
        return $this->customJsonResponse("Forum created successfully", $forum);
     }


    /**
     * Display the specified resource.
     */
    public function show(Forum $forum)
    {

        $forum->load('domaine', 'creator');

        // Retourne une réponse JSON personnalisée
        return $this->customJsonResponse("Forum", $forum);
        // Retourne une réponse JSON personnalisée

    }
    // voire un forum et les messages dans cette forum
    public function showMessages(Forum $forum){
        // $forum->load('messages');
        // return $forum;
        $messages = $forum->messages()->with(['creator', 'modifier'])->get();
        return $this->customJsonResponse("Messages retrieved successfully", $messages);
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
        // Validation des données de la requête


        if (Auth::id() !== $forum->created_by) {
            return response()->json(['message' => 'Vous n\'êtes pas autorisé à modifier cette forum'], 403);
        }

        // Mettre à jour la ressource avec les données validées
        $forum->fill($request->validated());

        // Mettre à jour l'utilisateur qui modifie la forum
        $forum->modified_by = Auth::id();

        // Sauvegarder les modifications dans la base de données
        $forum->save();

        // Retourner une réponse JSON avec la ressource mise à jour
        return $this->customJsonResponse("Forum mise à jour avec succès", $forum);


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
