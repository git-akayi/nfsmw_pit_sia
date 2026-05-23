<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LeaderboardController;

// ✅ Public
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// ✅ Protected
Route::middleware('auth:sanctum')->group(function () {

    // Endpoint 3 — Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Endpoint 4 — Get full leaderboard (all users sorted by bounty)
    Route::get('/leaderboard', [LeaderboardController::class, 'index']);

    // Endpoint 5 — Get my own profile/stats
    Route::get('/my-profile', [LeaderboardController::class, 'myProfile']);

    // Endpoint 6 — Update my own stats (bounty, ride, area, specialty)
    Route::put('/my-profile', [LeaderboardController::class, 'updateProfile']);

    // Endpoint 7 — Get single user by rank
    Route::get('/leaderboard/{id}', [LeaderboardController::class, 'show']);
});