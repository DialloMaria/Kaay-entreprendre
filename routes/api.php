<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\TemoignageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('categorie', [CategorieController::class, 'index']);
Route::post('categorie', [CategorieController::class, 'store']);
Route::post('categorie/{categorie}', [CategorieController::class, 'update']);
Route::delete('categorie/{categorie}', [CategorieController::class, 'destroy']);

Route::apiResource('temoignages', TemoignageController::class);
