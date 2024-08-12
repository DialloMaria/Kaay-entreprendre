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

        return $this->customJsonResponse("message created successfully", $message, Response::HTTP_CREATED);

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
        $data = $request->validated();

        // Création d'une nouvelle instance de Forum
        $message = new message();
        $message->fill($data);
        $message->modified_by = Auth::id();
        $message->save();

        return $this->customJsonResponse("message created successfully", $message, Response::HTTP_CREATED);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();
        return $this->customJsonResponse("forum supprimé avec succès", null, Response::HTTP_OK);

    }
}
