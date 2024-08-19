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

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        // list all users where roles is entrepreneur



        // administrative

        public function admin()
        {
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();
            return $this->customJsonResponse("Liste des administrateurs", $users);
        }
    }




