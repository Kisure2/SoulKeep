<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\AssessmentController;
use App\Models\User;

// Tingkat 1: Proteksi API Key (Wajib menyertakan X-API-KEY di header)
Route::middleware(['api.key'])->group(function () {
    
    // URL Publik untuk Register dan Login (Menghasilkan JWT Token)
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // Tingkat 2: Proteksi JWT (Wajib menyertakan Bearer Token hasil login)
    Route::middleware('auth:api')->group(function () {
        Route::get('moods/stats', [MoodController::class, 'stats']);
        Route::get('moods', [MoodController::class, 'index']);
        Route::post('moods', [MoodController::class, 'store']);
        Route::delete('moods/{id}', [MoodController::class, 'destroy']);
        Route::get('assessments', [AssessmentController::class, 'index']);
        Route::post('assessments', [AssessmentController::class, 'store']);
    });

    // Tingkat 3: Menggunakan fitur Basic Auth bawaan Laravel
    // Skenario: Endpoint khusus admin internal untuk memantau seluruh pengguna terdaftar
    Route::middleware('auth.basic')->get('admin/users', function () {
        return User::all();
    });

});