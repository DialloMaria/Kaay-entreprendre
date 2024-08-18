<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{
    // regiter

    public function register(Request $request)
    {
        // Validation des données
        $validator = validator($request->all(), [
            'nom' => ['required','string','max:255'],
            'prenom' => ['required','string','max:255'],
            'adresse' => ['required','string','max:255'],
            'telephone' => ['required','string','max:255','unique:users'],
            'specialisation' => ['nullable','string','max:255'],
            'biographie' => ['nullable','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'password' => ['required','string','min:8'],
        ]);

        // Vérification si la validation a échoué
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Création de l'utilisateur
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'specialisation' => $request->specialisation,
            'biographie' => $request->biographie,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assignation du rôle "entrepreneur"
        $user->assignRole('entrepreneur');

        // Obtenez les rôles de l'utilisateur
        $roles = $user->getRoleNames(); // Vous pouvez également utiliser `user->roles` si vous avez une relation définie

        // Réponse JSON personnalisée
        return response()->json([
            'success' => true,
            'message' => "Utilisateur créé avec succès",
            'user' => [
                'id' => $user->id,
                'nom' => $user->nom,
                'prenom' => $user->prenom,
                'adresse' => $user->adresse,
                'telephone' => $user->telephone,
                'specialisation' => $user->specialisation,
                'biographie' => $user->biographie,
                'email' => $user->email,
                'roles' => $roles, // Inclure les rôles dans la réponse
            ]
        ], 201);
    }


    // admin register
    public function registerAdmin(Request $request){

    // Validation des données

    $validator = validator($request->all(), [
        'nom' => ['required','string','max:255'],
        'prenom' => ['required','string','max:255'],
        'adresse' => ['required','string','max:255'],
        'telephone' => ['required','string','max:255','unique:users'],
        'specialisation' => ['nullable','string','max:255'],
        'biographie' => ['nullable','string','max:255'],
        'email' => ['required','string','email','max:255','unique:users'],
        'password' => ['required','string','min:8'],
    ]);

    // Vérification si la validation a échoué
    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422);
    }

    // Création de l'utilisateur
    $user = User::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'adresse' => $request->adresse,
        'telephone' => $request->telephone,
        'specialisation' => $request->specialisation,
        'biographie' => $request->biographie,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Assignation du rôle "entrepreneur"
    $user->assignRole('admin');


        return $this->customJsonResponse("Utilisateur admin créé avec succès", $user);
    }



    public function login(Request $request)
    {
        // Validation des données
        $validator = validator($request->all(), [
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $credentials = $request->only(['email', 'password']);

        // Tentative de connexion avec les informations d'identification
        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Identifiants de connexion invalides',
            ], 401);
        }
        // Obtenez les rôles de l'utilisateur
        $user = auth()->guard('api')->user();
        $roles = $user->getRoleNames(); // Vous pouvez également utiliser `user->roles` si vous avez une relation définie

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'roles' => $roles, // Inclure les rôles dans la réponse
            'user' => auth()->guard('api')->user(),
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60, // Expiration du token en secondes
        ]);
    }
    // logout
      public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Déconnexion réussie.'], 200);
    }

}
