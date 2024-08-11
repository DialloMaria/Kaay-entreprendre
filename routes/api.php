<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\UserEventController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// login
Route::post('/login', [AuthController::class,'login']);

// register
Route::post('/register', [AuthController::class,'register']);


// middleware
Route::middleware('auth:api')->group(function () {

    Route::get('/logout', function () {
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully']);
    });

    // ressources supprimées
    Route::get('/ressources/corbeille', [RessourceController::class,'trashed']); // ressources supprimées
    Route::post('/ressources/{id}/restore', [RessourceController::class, 'restore']);
    Route::delete('/ressources/{id}/forceDelete', [RessourceController::class, 'forceDelete']);

    Route::apiResource('/ressources', RessourceController::class);


    Route::post('/domaines/{domaine}/inscrire', [DomaineController::class, 'inscrire']);

    //
    Route::post('/events/{eventId}/register', [UserEventController::class, 'store'])->middleware('auth:api');


});
// ressources



