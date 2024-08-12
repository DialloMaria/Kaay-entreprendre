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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('categorie', [CategorieController::class, 'index']);
Route::post('categorie', [CategorieController::class, 'store']);
Route::post('categorie/{categorie}', [CategorieController::class, 'update']);
Route::delete('categorie/{categorie}', [CategorieController::class, 'destroy']);




Route::apiResource('guides', GuideController::class);
Route::apiResource('commentaires', CommentaireController::class);
// login
Route::post('/login', [AuthController::class,'login']);

// register
Route::post('/register', [AuthController::class,'register']);
Route::post('/register/admin', [AuthController::class,'registerAdmin']);


// middleware
Route::middleware('auth:api')->group(function () {

    // Route::get('/logout', function () {
    //     Auth::logout();
    //     return response()->json(['message' => 'Logged out successfully']);
    // });

    // logout
    Route::post('/logout', [AuthController::class,'logout']);


    // ressources supprimées
    Route::get('/ressources/corbeille', [RessourceController::class,'trashed']); // ressources supprimées
    Route::post('/ressources/{id}/restore', [RessourceController::class, 'restore']);
    Route::delete('/ressources/{id}/forceDelete', [RessourceController::class, 'forceDelete']);

    Route::apiResource('/ressources', RessourceController::class);


    Route::post('/domaines/{domaine}/inscrire', [DomaineController::class, 'inscrire']);

    //
    Route::post('/events/{eventId}/register', [UserEventController::class, 'store'])->middleware('auth:api');

    Route::post('/roles/assign/{user}', [RoleController::class, 'assignRole']);
    Route::delete('/roles/remove/{user}', [RoleController::class, 'removeRole']);
    Route::get('/roles/{user}', [RoleController::class, 'getUserRoles']);
    Route::get('/roles', [RoleController::class, 'getAllRoles']);
    Route::get('/domaines/{role}', [RoleController::class, 'getUsersByRole']);

    Route::apiResource('evenements', EvenementController::class);
Route::apiResource('temoignages', TemoignageController::class);


});
// ressources



// La route pour les temoignages
// La route pour les evenements

