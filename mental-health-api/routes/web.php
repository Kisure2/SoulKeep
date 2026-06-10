<?php

use Illuminate\Support\Facades\Route;

// Halaman Landing (Tampilan Utama pendukung SDG 3)
Route::get('/', function () {
    return view('welcome');
});

// Halaman Autentikasi (Web Form)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
});

// Halaman Dashboard Utama (Diakses setelah login web sukses)
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Halaman Fitur SDG 3 Baru (Kesehatan Mental & Kesejahteraan)
Route::get('/assessment', function () {
    return view('assessment');
});

Route::get('/relaxation', function () {
    return view('relaxation');
});

Route::get('/education', function () {
    return view('education');
});

Route::get('/games', function () {
    return view('games');
});

Route::get('/games/jurnal', function () { return view('games_jurnal'); });
Route::get('/games/wordle', function () { return view('games_wordle'); });
Route::get('/games/puzzle', function () { return view('games_puzzle'); });

Route::get('/nearby', function () {
    return view('nearby');
});