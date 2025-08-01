<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoogleAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::post('register', [AuthController::class, 'register']);
Route::post('login',    [AuthController::class, 'login']);

// Google OAuth (redirect+callback) - useful for web/SPA
Route::get('auth/google/redirect', [GoogleAuthController::class, 'redirect']);
Route::get('auth/google/callback', [GoogleAuthController::class, 'callback']);

// If you implement ID token-based login later
// Route::post('auth/google/id-token', [GoogleAuthController::class, 'loginWithIdToken']);

// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::get('me',        [AuthController::class, 'me']);
    Route::post('logout',   [AuthController::class, 'logout']);
    Route::post('logout-all', [AuthController::class, 'logoutAll']);
});
