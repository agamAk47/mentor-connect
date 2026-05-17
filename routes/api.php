<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MentorApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// ==========================================
// REST API Endpoints (Unit VI)
// ==========================================

Route::prefix('mentors')->group(function () {
    // Get all approved mentors (with optional ?category=Name filter)
    Route::get('/', [MentorApiController::class, 'index']);
    
    // Get details of a specific mentor
    Route::get('/{id}', [MentorApiController::class, 'show']);
});

// Get all mentor categories
Route::get('/categories', [MentorApiController::class, 'categories']);
