<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

// ── Public auth routes ────────────────────────────────
Route::post('register', [AuthController::class, 'register']);
Route::post('login',    [AuthController::class, 'login']);

// ── Public post reads ─────────────────────────────────
Route::get('posts',        [PostController::class, 'index']);
Route::get('posts/{post}', [PostController::class, 'show']);

// ── Protected routes (Bearer token required) ──────────
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout',     [AuthController::class,  'logout']);
    Route::get('me',          [AuthController::class,  'me']);

    Route::get('my-posts',       [PostController::class, 'myPosts']);
    Route::post('posts',           [PostController::class, 'store']);
    Route::put('posts/{post}',    [PostController::class, 'update']);
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
});
