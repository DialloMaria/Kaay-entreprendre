<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// login
Route::post('/login', [AuthController::class,'login']);

// register
Route::post('/register', [AuthController::class,'register']);


