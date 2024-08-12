<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;


class RoleController extends Controller
{
      /**
     * Assigner un rôle à un utilisateur.
     */
    public function assignRole(Request $request, User $user): JsonResponse
{
    // Valider les données du requête
    $request->validate([
        'role' => 'required|exists:roles,name',
    ]);

    // Trouver le rôle
    $role = Role::where('name', $request->input('role'))->first();

    // Vérifier si l'utilisateur a déjà ce rôle
    if ($user->hasRole($role)) {
        return response()->json([
            'success' => false,
            'message' => "L'utilisateur a déjà ce rôle.",
        ], 400);
    }

    // Assigner le rôle à l'utilisateur
    $user->assignRole($role);

    return response()->json([
        'success' => true,
        'message' => 'Rôle assigné avec succès.',
    ], 200);
}

 /**
     * Retirer un rôle à un utilisateur.
     */
    public function removeRole(Request $request, User $user): JsonResponse
    {
        // Valider les données du requête
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        // Trouver le rôle
        $role = Role::where('name', $request->input('role'))->first();

        // Vérifier si l'utilisateur n'a pas ce rôle
        if (!$user->hasRole($role)) {
            return response()->json([
               'success' => false,
               'message' => "L'utilisateur ne possède pas ce rôle.",
            ], 400);
        }

        // Retirer le rôle de l'utilisateur
        $user->removeRole($role);

        return response()->json([
           'success' => true,
           'message' => 'Rôle retiré avec succès.',
        ], 200);
    }



    /**
     * Afficher les rôles d'un utilisateur.
     */
    public function getUserRoles(User $user): JsonResponse
    {
        $roles = $user->roles->pluck('name');
        //

        return response()->json([
            'success' => true,
            'roles' => $roles,
            'user' => $user
        ], 200);
    }

    /**
     * Obtenir la liste de tous les rôles.
     */
    public function getAllRoles(): JsonResponse
    {
        $roles = Role::all()->pluck('name');

        return response()->json([
            'success' => true,
            'roles' => $roles,
        ], 200);
    }
    // les utilisateur de meme roles
    public function getUsersByRole($roleName): JsonResponse
    {
        // Trouver le rôle par son nom
        $role = Role::where('name', $roleName)->first();

        // Vérifier si le rôle existe
        if (!$role) {
            return response()->json([
                'success' => false,
                'message' => "Ce rôle n'existe pas.",
            ], 404);
        }

        // Récupérer les utilisateurs associés à ce rôle
        $users = $role->users;

        // Retourner les utilisateurs avec une réponse JSON
        return response()->json([
            'success' => true,
            'users' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'nom' => $user->nom,
                    'prenom' => $user->prenom,
                    'email' => $user->email,
                    'telephone' => $user->telephone,
                    // Ajouter d'autres attributs selon vos besoins
                ];
            }),
        ], 200);
    }


}
