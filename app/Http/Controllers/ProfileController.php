<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request, string $id)
    {
     
            $user = User::find(Auth::id());
      /*
              if (!$user) {
                  return response()->json(['message' => 'Utilisateur non trouvé'], 404);
              } */
        // Validation des données reçues
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'specialisation' => ['nullable', 'string', 'max:255'],
            'biographie' => ['nullable', 'string', 'max:1000'],
        ]);
    
        // Recherche de l'utilisateur par son ID
        $user = User::findOrFail($id);
    
        // Mise à jour des informations de l'utilisateur
        $user->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'specialisation' => $request->specialisation,
            'biographie' => $request->biographie,
        ]);
    
        // Retourne une réponse personnalisée
        return $this->customJsonResponse("Utilisateur mis à jour avec succès", $user);
    }
    
}
