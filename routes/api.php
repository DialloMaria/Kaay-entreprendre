<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\UserEventController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\TemoignageController;
use App\Http\Controllers\ForumController;

// Routes accessibles sans authentification
// =========================================

// Route pour récupérer les informations de l'utilisateur authentifié
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentification
// ----------------
// Connexion
Route::post('/login', [AuthController::class, 'login']);

// Inscription
Route::post('/register', [AuthController::class, 'register']);
Route::post('/register/admin', [AuthController::class, 'registerAdmin']);

// Routes protégées par authentification
// ======================================

Route::middleware('auth:api')->group(function () {

    // Authentification
    // ----------------
    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout']);

    // Gestion des catégories
    // ----------------------
    // Récupérer toutes les catégories
    Route::get('categorie', [CategorieController::class, 'index']);
    // Créer une nouvelle catégorie
    Route::post('categorie', [CategorieController::class, 'store']);
    // Mettre à jour une catégorie existante
    Route::post('categorie/{categorie}', [CategorieController::class, 'update']);
    // Supprimer une catégorie
    Route::delete('categorie/{categorie}', [CategorieController::class, 'destroy']);

    // Gestion des guides
    // ------------------
    // Utilisation des routes de l'API Resource pour le CRUD des guides
    Route::apiResource('guides', GuideController::class);

    // Gestion des commentaires
    // ------------------------
    // Utilisation des routes de l'API Resource pour le CRUD des commentaires
    Route::apiResource('commentaires', CommentaireController::class);

    // Gestion des ressources
    // ----------------------
    // Récupérer les ressources supprimées (dans la corbeille)
    Route::get('/ressources/corbeille', [RessourceController::class, 'trashed']);
    // Restaurer une ressource supprimée
    Route::post('/ressources/{id}/restore', [RessourceController::class, 'restore']);
    // Supprimer définitivement une ressource
    Route::delete('/ressources/{id}/forceDelete', [RessourceController::class, 'forceDelete']);
    // Utilisation des routes de l'API Resource pour le CRUD des ressources
    Route::apiResource('/ressources', RessourceController::class);

    // Gestion des domaines
    // --------------------
    // Inscrire un utilisateur à un domaine
    Route::post('/domaines/{domaine}/inscrire', [DomaineController::class, 'inscrire']);

    // Gestion des événements
    // ----------------------
    // Inscription à un événement
    Route::post('/events/{eventId}/register', [UserEventController::class, 'store']);

    // Gestion des rôles
    // -----------------
    // Assigner un rôle à un utilisateur
    Route::post('/roles/assign/{user}', [RoleController::class, 'assignRole']);
    // Retirer un rôle à un utilisateur
    Route::delete('/roles/remove/{user}', [RoleController::class, 'removeRole']);
    // Récupérer les rôles d'un utilisateur
    Route::get('/roles/{user}', [RoleController::class, 'getUserRoles']);
    // Récupérer tous les rôles
    Route::get('/roles', [RoleController::class, 'getAllRoles']);
    // Récupérer les utilisateurs ayant un rôle spécifique
    Route::get('/domaines/{role}', [RoleController::class, 'getUsersByRole']);

    // Gestion des événements
    // ----------------------
    // Utilisation des routes de l'API Resource pour le CRUD des événements
    Route::apiResource('evenements', EvenementController::class);

    // Gestion des témoignages
    // -----------------------
    // Utilisation des routes de l'API Resource pour le CRUD des témoignages
    Route::apiResource('temoignages', TemoignageController::class);


    // Route des forums
    Route::get('forum',[ForumController::class, 'index']);
    Route::post('forum', [ForumController::class, 'store']);
    Route::delete('forum/{forum}', [ForumController::class, 'destroy']);

    // Routes des commentaire
    Route::get('commentaire', [CommentaireController::class, 'index']);
    Route::post('commentaire', [CommentaireController::class, 'store']);
    Route::post('commentaire/{commentaire}', [CommentaireController::class, 'update']);
    Route::delete('commentaire/{commentaire}', [CommentaireController::class, 'destroy']);
});
