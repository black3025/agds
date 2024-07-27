<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\authentications\LoginBasic;
// Main Page Route

Route::get('/', [FrontController::class, 'index'])->name('front');

Route::middleware('auth')->group(function () {
  Route::get('/Dashboard', [Analytics::class, 'index'])->name('dashboard');
});

// authentication
Route::get('/auth/login', [LoginBasic::class, 'index'])->name('login');
Route::get('/auth/register', [RegisterBasic::class, 'index'])->name('auth-register');
Route::get('/auth/forgot-password', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password');
    