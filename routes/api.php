<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RessourceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// login
Route::post('/login', [AuthController::class,'login']);

// register
Route::post('/register', [AuthController::class,'register']);


// middleware
// Route::middleware('auth:api')->group(function () {

    Route::apiResource('/ressources', RessourceController::class);
// });
// ressources



