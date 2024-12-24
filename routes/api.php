<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', [UserController::class, 'user']);
    Route::post('update', [UserController::class, 'update']);
    Route::get('fetch-news', [NewsController::class, 'fetchNews']);
    Route::get('category', [NewsController::class, 'category']);
    Route::get('authors', [NewsController::class, 'authors']);
    Route::post('logout', [AuthController::class, 'logout']);
});
