<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // regiter
    public function register(Request $request){

        // nom, prenom, adresse, telephone, specialisation, telephone,email,biographie,password
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'specialisation' => ['nullable', 'string', 'max:255'],
            'biographie' => ['nullable', 'string', 'max:1000'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'specialisation' => $request->specialisation,
            'biographie' => $request->biographie,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return $this->customJsonResponse("Utilisateure", $user);

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

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->guard('api')->user(),
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60, // Expiration du token en secondes
        ]);
    }

}
