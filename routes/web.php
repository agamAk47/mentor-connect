<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\MentorshipRequestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StartupController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file defines all web routes for the MentorConnect platform.
| Routes are organized by module and demonstrate:
| - Named routes (Unit II)
| - Route parameters (Unit II)
| - Route groups and prefixes (Unit III)
|
*/

// ==========================================
// PUBLIC ROUTES
// ==========================================

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Community Board (Feature 22 - Query Builder)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

// ==========================================
// AUTHENTICATION ROUTES
// ==========================================

// Registration - Role Selection
Route::get('/register', [AuthController::class, 'showRoleSelection'])->name('register');

// Startup Registration
Route::get('/register/startup', [AuthController::class, 'showStartupRegister'])->name('register.startup');
Route::post('/register/startup', [AuthController::class, 'registerStartup'])->name('register.startup.submit');

// Mentor Registration
Route::get('/register/mentor', [AuthController::class, 'showMentorRegister'])->name('register.mentor');
Route::post('/register/mentor', [AuthController::class, 'registerMentor'])->name('register.mentor.submit');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// PROTECTED ROUTES (Unit III - Middleware)
// ==========================================

// Generic Authenticated Routes (Controller handles role checks)
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/startups/{id}', [StartupController::class, 'show'])->name('startups.show');

// Messages
Route::get('/messages', [App\Http\Controllers\MessageController::class, 'inbox'])->name('messages.inbox');
Route::get('/messages/{receiverType}/{receiverId}', [App\Http\Controllers\MessageController::class, 'index'])->name('messages.index');
Route::post('/messages/{receiverType}/{receiverId}', [App\Http\Controllers\MessageController::class, 'store'])->name('messages.store');

// Startup Only Routes
Route::middleware(['role:startup'])->group(function () {
    // Startup Dashboard (Step 8)
    Route::get('/dashboard/startup', [DashboardController::class, 'startupDashboard'])->name('dashboard.startup');
    
    // Mentor browsing page (Step 4)
    Route::get('/mentors', [MentorController::class, 'index'])->name('mentors.index');
    
    // Mentor detail profile page (Step 5)
    Route::get('/mentors/{id}', [MentorController::class, 'show'])->name('mentors.show');
    
    // Send Mentorship Request (Step 6)
    Route::post('/requests', [MentorshipRequestController::class, 'store'])->name('requests.store');
    
    // Submit a Review (Feature 2)
    Route::post('/mentors/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// Mentor Only Routes
Route::middleware(['role:mentor'])->group(function () {
    // Mentor Dashboard (Step 7)
    Route::get('/dashboard/mentor', [DashboardController::class, 'mentorDashboard'])->name('dashboard.mentor');
    
    // Accept / Reject Request (Step 7 - Eloquent update)
    Route::patch('/requests/{id}', [DashboardController::class, 'updateRequestStatus'])->name('requests.update');
});

// ==========================================
// ADMIN ROUTES (Unit III - Middleware)
// ==========================================

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/mentors', [AdminController::class, 'mentors'])->name('mentors');
    Route::patch('/mentors/{id}/approve', [AdminController::class, 'approveMentor'])->name('mentors.approve');
    Route::patch('/mentors/{id}/reject', [AdminController::class, 'rejectMentor'])->name('mentors.reject');
    Route::delete('/mentors/{id}', [AdminController::class, 'deleteMentor'])->name('mentors.delete');
    Route::get('/startups', [AdminController::class, 'startups'])->name('startups');
    Route::delete('/startups/{id}', [AdminController::class, 'deleteStartup'])->name('startups.delete');
    Route::get('/requests', [AdminController::class, 'requests'])->name('requests');
    Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
    Route::delete('/posts/{id}', [AdminController::class, 'deletePost'])->name('posts.delete');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('statistics');
});
