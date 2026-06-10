<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Models\User;

// ─── Tingkat 1: API Key (X-API-KEY wajib) ────────────────────────────────────

Route::middleware(['api.key'])->group(function () {

    // Public: Register & Login
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);

    // Public: News (read only)
    Route::get('news', [NewsController::class, 'index']);

    // ─── Tingkat 2: JWT (Bearer Token wajib) ─────────────────────────────────

    Route::middleware('auth:api')->group(function () {

        // Profile
        Route::get('profile',  [ProfileController::class, 'apiShow']);
        Route::post('profile', [ProfileController::class, 'apiUpdate']); // POST for multipart/form-data

        // Moods
        Route::get('moods/stats',   [MoodController::class, 'stats']);
        Route::get('moods',         [MoodController::class, 'index']);
        Route::post('moods',        [MoodController::class, 'store']);
        Route::delete('moods/{id}', [MoodController::class, 'destroy']);

        // Assessments
        Route::get('assessments',  [AssessmentController::class, 'index']);
        Route::post('assessments', [AssessmentController::class, 'store']);

        // News (create/update/delete — admin only enforced in controller)
        Route::post('news',          [NewsController::class, 'store']);
        Route::put('news/{id}',      [NewsController::class, 'update']);
        Route::delete('news/{id}',   [NewsController::class, 'destroy']);

        // Chat
        Route::get('therapists',                        [ChatController::class, 'getTherapists']);
        Route::post('chat/start',                       [ChatController::class, 'startChat']);
        Route::get('chat/rooms',                        [ChatController::class, 'myRooms']);
        Route::get('chat/rooms/{id}/messages',          [ChatController::class, 'getMessages']);
        Route::post('chat/rooms/{id}/messages',         [ChatController::class, 'apiSendMessage']);
    });

    // ─── Tingkat 3: Basic Auth (admin endpoint lama) ─────────────────────────

    Route::middleware('auth.basic')->get('admin/users', function () {
        return User::select('id', 'name', 'email', 'role', 'status', 'created_at')->get();
    });
});

// ─── Admin API (API Key + Basic Auth) ────────────────────────────────────────

Route::middleware(['api.key', 'auth.basic'])->prefix('admin')->group(function () {
    Route::get('users',                       [AdminController::class, 'apiUsers']);
    Route::get('therapists/applications',     [AdminController::class, 'therapistApplications']);
    Route::post('therapists/{id}/verify',     [AdminController::class, 'verifyTherapist']);
    Route::delete('therapists/{id}/reject',   [AdminController::class, 'apiRejectTherapist']);
    Route::get('news',                        [NewsController::class, 'index']);
    Route::post('news',                       [NewsController::class, 'store']);
    Route::put('news/{id}',                   [NewsController::class, 'update']);
    Route::delete('news/{id}',                [NewsController::class, 'destroy']);
});