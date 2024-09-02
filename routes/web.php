<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InquiryController;

$controller_path = 'App\Http\Controllers';
// Main Page Route

Route::get('/', [FrontController::class, 'index'])->name('front');

Route::middleware('auth', 'verified')->group(function () {
  Route::get('/Dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::resource('/course', CourseController::class, ['names' => 'course']);
  Route::resource('/inquiry', InquiryController::class, ['names' => 'inquiry']);
});

// authentication
Route::get('/auth/login', [LoginBasic::class, 'index'])->name('login');
Route::post('auth/signin', [LoginBasic::class, 'signin'])->name('signin');
Route::get('auth/logout', [LoginBasic::class, 'logout'])->name('logout');
Route::get('/auth/register', [RegisterBasic::class, 'index'])->name('auth-register');
Route::get('/auth/forgot-password', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password');
Route::put('/auth/register', [RegisterBasic::class, 'index'])->name('process-register');
Route::resource('/student/register', $controller_path . '\authentications\RegisterBasic', ['names' => 'students']);

//email verification
Route::get('/email/verify', function () {
  return view('content.authentications.verify-email');
})
  ->middleware('auth')
  ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();

  return redirect('/Dashboard');
})
  ->middleware(['auth', 'signed'])
  ->name('verification.verify');

//google login
Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name(
  'google.redirect'
);
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name(
  'google.callback'
);
