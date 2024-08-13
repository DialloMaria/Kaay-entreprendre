<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $message = Message::all();
        // return $message;
        $message = Message::with(['creator', 'modifier', 'forum'])->get();
        return $this->customJsonResponse("message retrieved successfully", $message);
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
    public function store(StoreMessageRequest $request)
    {

        return Message::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        $data = $request->validated();

        // Création d'une nouvelle instance de Forum
        $message = new message();
        $message->fill($data);
        $message->created_by = Auth::id();
        $message->save();

        return $this->customJsonResponse("message created successfully", $message);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {

        // if (Auth::id() !== $message->created_by) {
        //     return response()->json(['message' => 'Vous n\'êtes pas autorisé à modifier cette message'], 403);
        // }

        // Mettre à jour la message avec les données validées
        $message->fill($request->validated());

        // Mettre à jour l'utilisateur qui modifie la message
        $message->modified_by = Auth::id();

        // Sauvegarder les modifications dans la base de données
        $message->save();

        return $this->customJsonResponse("message mis à jour avec succès", $message);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return $this->customJsonResponse("message supprimé avec succès",$message);

    }
}
