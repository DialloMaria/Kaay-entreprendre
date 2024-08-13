<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SousDomaineController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Routes des categories

Route::get('categorie', [CategorieController::class, 'index']);
Route::post('categorie', [CategorieController::class, 'store']);
Route::post('categorie/{categorie}', [CategorieController::class, 'update']);
Route::delete('categorie/{categorie}', [CategorieController::class, 'destroy']);

// middleware
// Route::middleware('auth:api')->group(function () {
// Route des forums
Route::get('forum',[ForumController::class, 'index']);
Route::post('forum', [ForumController::class, 'store']);
Route::delete('forum/{forum}', [ForumController::class, 'destroy']);

// });



// Routes des message
Route::get('message', [MessageController::class, 'index']);
Route::post('message', [MessageController::class, 'store']);
Route::post('message/{message}', [MessageController::class, 'update']);
Route::delete('message/{message}', [MessageController::class, 'destroy']);

// route sousdomaine
Route::get('sousdomaine', [SousDomaineController::class, 'index']);
Route::post('sousdomaine', [SousDomaineController::class,'store']);
Route::post('sousdomaine/{sousdomaine}', [SousDomaineController::class, 'update']);
Route::delete('sousdomaine/{sousdomaine}', [SousDomaineController::class, 'destroy']);

// route domaine


// login
Route::post('/login', [AuthController::class,'login']);

// register
Route::post('/register', [AuthController::class,'register']);


