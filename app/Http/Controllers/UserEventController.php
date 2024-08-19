<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domaine;
use App\Models\Evenement;
use App\Models\UserEvent;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InscriptionEvenement;
use App\Http\Requests\StoreUserEventRequest;
use App\Http\Requests\UpdateUserEventRequest;

class UserEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // list all users where roles is entrepreneur
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'entrepreneur');
        })->get();

        // list all events where user_id is one of the above users
        $events = Evenement::whereIn('user_id', $users->pluck('id'))
                            ->with('domaine')
                            ->get();

        return $this->customJsonResponse("Événements inscrits des entrepreneurs", $events);
    }
        // list all users where roles is entrepreneur

        public function entrepreneur()
        {
            // list all users where roles is entrepreneur
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', 'entrepreneur');
            })->get();
            return $this->customJsonResponse("Liste des entrepreneurs", $users);
        }

        // administrative








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
    public function store(StoreUserEventRequest $request, $eventId)
    {
        $userId = Auth::id();

        // Vérifier si l'utilisateur est déjà inscrit
        $existingRegistration = UserEvent::where('user_id', $userId)
                                         ->where('evenement_id', $eventId)
                                         ->first();

        if ($existingRegistration) {
            return response()->json([
                'message' => 'Vous êtes déjà inscrit à cet événement.'
            ], 400);
        }

        // Vérifier si l'événement existe
        $event = Evenement::find($eventId);
        if (!$event) {
            return response()->json([
                'message' => 'Événement non trouvé.'
            ], 404);
        }

        // Récupérer le domaine lié à l'événement
        $domaine = Domaine::find($event->domaine_id);

        // Enregistrer l'inscription
        $userEvent = UserEvent::create([
            'user_id' => $userId,
            'evenement_id' => $eventId,
        ]);

        // Envoyer une notification à l'utilisateur
        $user = Auth::user();
        $user->notify(new InscriptionEvenement($event, $domaine));

        return response()->json([
            'message' => 'Inscription réussie.',
            'data' => $userEvent
        ], 201);
    }


    // Désinscription d'un événement



    /**
     * Display the specified resource.
     */
    public function show(UserEvent $userEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserEvent $userEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserEventRequest $request, UserEvent $userEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserEvent $userEvent)
    {
        //
    }
}
