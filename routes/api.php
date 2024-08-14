<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\TemoignageController;
use App\Http\Controllers\SousDomaineController;

// Routes accessibles sans authentification
// ----------------------------------------

// Route pour récupérer les informations de l'utilisateur authentifié
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentification
// ----------------
// Route pour la connexion
Route::post('/login', [AuthController::class, 'login']);

// Route pour l'inscription
Route::post('/register', [AuthController::class, 'register']);

// Route pour l'inscription d'un administrateur
Route::post('/register/admin', [AuthController::class, 'registerAdmin']);

// Routes protégées par authentification
// -------------------------------------
Route::middleware('auth:api')->group(function () {

    // Authentification
    // ----------------
    // Route pour la déconnexion
    Route::post('/logout', [AuthController::class, 'logout']);

    // Gestion des catégories
    // ----------------------
    // Récupérer toutes les catégories
    Route::get('categories', [CategorieController::class, 'index']);

    // Groupement des routes nécessitant un rôle spécifique (ici 'admin et super_admin')
    Route::middleware('role:admin|super_admin')->group(function () {
        // Créer une nouvelle catégorie
        Route::post('categories', [CategorieController::class, 'store']);
        // Mettre à jour une catégorie existante
        Route::post('categories/{categorie}', [CategorieController::class, 'update']);
        // Supprimer une catégorie
        Route::delete('categories/{categorie}', [CategorieController::class, 'destroy']);
    });
    // Gestion des guides
    // ------------------
     // Routes pour les actions nécessitant la permission 'view_guides'
    Route::apiResource('guides', GuideController::class);

    Route::middleware('role:admin|super_admin')->group(function () {
        Route::apiResource('guides', GuideController::class)
            ->only(['store', 'update', 'destroy']);
    });



    // Gestion des ressources
    // ----------------------
    // Récupérer les ressources supprimées (dans la corbeille)
    Route::middleware('role:super_admin')->group(function () {

        Route::get('/ressources/corbeille', [RessourceController::class, 'trashed']);

        // Restaurer une ressource supprimée
        Route::post('/ressources/{id}/restore', [RessourceController::class, 'restore']);

        // Supprimer définitivement une ressource
        Route::delete('/ressources/{id}/forceDelete', [RessourceController::class, 'forceDelete']);
    });

    // Utilisation des routes de l'API Resource pour le CRUD des ressources
    Route::apiResource('/ressources', RessourceController::class);
    Route::apiResource('/ressources', RessourceController::class)->middleware('role:admin|super_admin')->only(['store', 'update', 'destroy']);

    // Gestion des domaines
    // --------------------
    // Route pour inscrire un utilisateur à un domaine spécifique

    Route::post('/domaines/{domaine}/inscrire', [DomaineController::class, 'inscrire']);

    // Gestion des événements
    // ----------------------
    // Route pour l'inscription d'un utilisateur à un événement spécifique
    Route::post('/events/{eventId}/register', [UserEventController::class, 'store']);

    // Gestion des rôles
    // -----------------
    // Route pour assigner un rôle à un utilisateur
    Route::middleware('role:super_admin')->group(function () {

        Route::post('/roles/assign/{user}', [RoleController::class, 'assignRole']);

        // Route pour retirer un rôle à un utilisateur
        Route::delete('/roles/remove/{user}', [RoleController::class, 'removeRole']);

        // Route pour récupérer les rôles d'un utilisateur
        Route::get('/roles/{user}', [RoleController::class, 'getUserRoles']);

        // Route pour récupérer tous les rôles
        Route::get('/roles', [RoleController::class, 'getAllRoles']);

        // Route pour récupérer les utilisateurs ayant un rôle spécifique
        Route::get('/domaines/{role}', [RoleController::class, 'getUsersByRole']);

        // Route pour assigner des permissions à un rôle
        Route::post('/roles/{role}/permissions', [RoleController::class, 'assignPermissionsToRole']);

        // Route pour récupérer les permissions d'un rôle
        Route::get('/roles/{role}/permissions', [RoleController::class, 'getRolePermissions']);
    });

    // Gestion des événements
    // ----------------------
    // Utilisation des routes de l'API Resource pour le CRUD des événements
    Route::apiResource('evenements', EvenementController::class);
    Route::apiResource('evenements', EvenementController::class)->middleware('role:admin|super_admin')->only(['store', 'update', 'destroy']);

    // Gestion des témoignages
    // -----------------------
    // Utilisation des routes de l'API Resource pour le CRUD des témoignages
    Route::apiResource('temoignages', TemoignageController::class);

    // Gestion des forums
    // ------------------
    // Routes pour le CRUD des forums et récupération des commentaires
    Route::get('forums', [ForumController::class, 'index']);
    Route::get('forums/{forum}', [ForumController::class, 'show']);
    Route::middleware('role:super_admin|admin')->group(function () {

        Route::post('forums', [ForumController::class, 'store']);
        Route::put('forums/{forum}', [ForumController::class, 'update']);
        Route::delete('forums/{forum}', [ForumController::class, 'destroy']);
        Route::get('forums/{forum}/commentaire', [ForumController::class, 'showMessages']);
    });

    // Gestion des messages
    // --------------------
    // Routes pour le CRUD des messages
    Route::get('messages', [MessageController::class, 'index']);
    Route::post('messages', [MessageController::class, 'store']);
    Route::put('messages/{message}', [MessageController::class, 'update']);
    Route::delete('messages/{message}', [MessageController::class, 'destroy']);

    // Gestion des commentaires
    // ------------------------
    // Routes pour le CRUD des commentaires
    Route::get('commentaires', [CommentaireController::class, 'index']);
    Route::post('commentaires', [CommentaireController::class, 'store']);
    Route::put('commentaires/{commentaire}', [CommentaireController::class, 'update']);
    Route::delete('commentaires/{commentaire}', [CommentaireController::class, 'destroy']);

    // Gestion des domaines
    // --------------------
    // Routes pour le CRUD des domaines
    Route::get('domaines', [DomaineController::class, 'index']);

    Route::middleware('role:super_admin')->group(function () {

        Route::post('domaines', [DomaineController::class, 'store']);
        Route::put('domaines/{domaine}', [DomaineController::class, 'update']);
        Route::delete('domaines/{domaine}', [DomaineController::class, 'destroy']);
    });

    // Gestion des sous-domaines
    // -------------------------
    // Routes pour le CRUD des sous-domaines
    Route::get('sousdomaine', [SousDomaineController::class, 'index']);

    Route::middleware('role:super_admin')->group(function () {

        Route::post('sousdomaine', [SousDomaineController::class,'store']);
        Route::put('sousdomaine/{sousdomaine}', [SousDomaineController::class, 'update']);
        Route::delete('sousdomaine/{sousdomaine}', [SousDomaineController::class, 'destroy']);
    });

    // Gestion des profils
    // -------------------
    // Route pour mettre à jour un profil utilisateur
    Route::patch('profiles/{id}', [ProfileController::class, 'update']);

});
