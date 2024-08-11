<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// login
Route::post('/login', [AuthController::class,'login']);

// register
Route::post('/register', [AuthController::class,'register']);



Route::get('categorie', [CategorieController::class, 'index']);
Route::post('categorie', [CategorieController::class, 'store']);
Route::post('categorie/{categorie}', [CategorieController::class, 'update']);
Route::delete('categorie/{categorie}', [CategorieController::class, 'destroy']);
