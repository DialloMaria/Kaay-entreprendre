<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;



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

    public function assignPermissionsToRole(Request $request, Role $role): JsonResponse
    {
        // Valider les données de la requête
        $request->validate([
            'permissions' => 'required|array',
            'permissions.*' => 'required|exists:permissions,name',
        ]);

        // Récupérer les permissions depuis la base de données
        $permissions = Permission::whereIn('name', $request->input('permissions'))->get();

        // Assigner les permissions au rôle
        $role->syncPermissions($permissions);

        return response()->json([
            'success' => true,
            'message' => 'Permissions assignées avec succès.',
            'role' => $role->name,
            'permissions' => $role->permissions->pluck('name'),
        ], 200);
    }

    public function getRolePermissions(Role $role): JsonResponse
    {
        // Récupérer les permissions du rôle
        $permissions = $role->permissions->pluck('name');

        return response()->json([
            'success' => true,
            'role' => $role->name,
            'permissions' => $permissions,
        ], 200);
    }


}
