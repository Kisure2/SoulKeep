<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─── Public ──────────────────────────────────────────────────────────────────

Route::get('/', fn() => view('welcome'));

Route::get('/login', function (\Illuminate\Http\Request $request) {
    if ($request->session()->has('user')) {
        $role = $request->session()->get('role', 'user');
        return redirect($role === 'admin' ? '/admin/dashboard' : ($role === 'therapist' ? '/therapist/dashboard' : '/dashboard'));
    }
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'webLogin']);

Route::get('/register', function (\Illuminate\Http\Request $request) {
    if ($request->session()->has('user')) {
        return redirect('/dashboard');
    }
    return view('auth.register');
});
Route::post('/register', [AuthController::class, 'webRegister']);

Route::post('/logout', [AuthController::class, 'webLogout'])->name('logout');

// News (public)
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');

// ─── Authenticated (any role) ─────────────────────────────────────────────────

Route::middleware('webauth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'));
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword']);

    Route::get('/assessment', fn() => view('assessment'));
    Route::get('/relaxation', fn() => view('relaxation'));
    Route::get('/education', fn() => view('education'));
    Route::get('/games', fn() => view('games'));
    Route::get('/games/jurnal', fn() => view('games_jurnal'));
    Route::get('/games/wordle', fn() => view('games_wordle'));
    Route::get('/games/puzzle', fn() => view('games_puzzle'));
    Route::get('/nearby', fn() => view('nearby'));
});

// ─── User Chat ────────────────────────────────────────────────────────────────

Route::middleware(['webauth', 'role:user'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/therapists', [ChatController::class, 'therapists']);
    Route::post('/chat/start/{therapist}', [ChatController::class, 'startRoom']);
    Route::get('/chat/room/{room}', [ChatController::class, 'room'])->name('chat.room');
    Route::post('/chat/room/{room}/send', [ChatController::class, 'sendMessage']);
    Route::post('/chat/room/{room}/read', [ChatController::class, 'markRead']);
    Route::get('/chat/room/{room}/messages', [ChatController::class, 'messages']);
});

// ─── Therapist Panel ──────────────────────────────────────────────────────────

Route::middleware(['webauth', 'role:therapist'])->prefix('therapist')->group(function () {
    Route::get('/dashboard', [ChatController::class, 'index'])->name('therapist.dashboard');
    Route::get('/room/{room}', [ChatController::class, 'room'])->name('therapist.room');
    Route::post('/room/{room}/send', [ChatController::class, 'sendMessage']);
    Route::post('/room/{room}/read', [ChatController::class, 'markRead']);
    Route::post('/room/{room}/close', [ChatController::class, 'closeRoom']);
    Route::get('/room/{room}/messages', [ChatController::class, 'messages']);
});

// ─── Admin Panel ──────────────────────────────────────────────────────────────

Route::middleware(['webauth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/therapists', [AdminController::class, 'therapists'])->name('admin.therapists');
    Route::post('/therapists/{user}/approve', [AdminController::class, 'approveTherapist']);
    Route::post('/therapists/{user}/reject', [AdminController::class, 'rejectTherapist']);
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser']);

    Route::get('/news', [NewsController::class, 'adminIndex'])->name('admin.news');
    Route::get('/news/create', [NewsController::class, 'create']);
    Route::post('/news', [NewsController::class, 'store']);
    Route::get('/news/{news}/edit', [NewsController::class, 'edit']);
    Route::put('/news/{news}', [NewsController::class, 'update']);
    Route::delete('/news/{news}', [NewsController::class, 'destroy']);
});