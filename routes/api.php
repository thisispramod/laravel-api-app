<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; 
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\CategoryController; 

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::apiResource('posts', PostController::class);
    Route::get('/posts/{id}', [PostController::class, 'show']);
    // Route::middleware(['throttle:posts'])->group(function () {
    //     Route::post('/posts', [PostController::class, 'store']);
    // });
    Route::apiResource('categories', CategoryController::class); 
    Route::apiResource('user', AuthController::class); 
}); 
