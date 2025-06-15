<?php

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn() => response()->json(auth()->user()));
    
});

//Route::middleware('auth:sanctum')->group(function () {
    //Route::post('/logout', [AuthController::class, 'logout']);
//});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn () => response()->json(auth()->user()));

    Route::apiResource('books', App\Http\Controllers\BooksController::class);
    Route::apiResource('authors', App\Http\Controllers\AuthorsController::class);
    Route::apiResource('loans', App\Http\Controllers\LoansController::class);
});
