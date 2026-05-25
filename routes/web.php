<?php

use App\Http\Controllers\web\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'register'])->name('register');

// Rotas de autenticação (para formulários)
Route::post('/login', [HomeController::class, 'authenticate'])->name('login.authenticate');
Route::post('/register', [HomeController::class, 'store'])->name('register.store');