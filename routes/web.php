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
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;

$controller_path = 'App\Http\Controllers';
// Main Page Route

Route::get('/', [FrontController::class, 'index'])->name('front');

Route::middleware('auth', 'verified')->group(function () {
  Route::get('/Dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/getCourse', [CourseController::class, 'getCourse'])->name('getCourse');
  //Student
  Route::middleware('isStudent')->group(function () {
    Route::resource('/course', CourseController::class, ['names' => 'course']);
    Route::resource('/inquiry', InquiryController::class, ['names' => 'inquiry']);
    Route::resource('/enrollment', EnrollmentController::class, ['names' => 'enrollment']);
    Route::get('/enrolled', [EnrollmentController::class, 'enrolled'])->name('myenrollment');
  });
  //Admin
  Route::middleware('isAdmin')->group(function () {
    Route::get('/admin/Dashboard', [DashboardController::class, 'adminIndex'])->name('admin-dashboard');
    Route::resource('/admin/users', UserController::class, ['names' => 'user']);
    Route::resource('/admin/students', StudentController::class, ['names' => 'student']);
    Route::resource('/admin/teachers', TeacherController::class, ['names' => 'teacher']);
    Route::resource('/admin/course', CourseController::class, ['names' => 'admin-course']);
    Route::post('/admin/updateCourse', [CourseController::class, 'updateCourse'])->name('updateCourse');
  });
});

Route::resource('/contactus', $controller_path . '\ContactUsController', ['names' => 'contactus']);

// authentication
Route::get('/auth/login', [LoginBasic::class, 'index'])->name('login');
Route::post('auth/signin', [LoginBasic::class, 'signin'])->name('signin');
Route::get('auth/logout', [LoginBasic::class, 'logout'])->name('logout');
Route::get('/auth/register', [RegisterBasic::class, 'index'])->name('auth-register');
Route::get('/auth/forgot-password', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password');
Route::put('/auth/register', [RegisterBasic::class, 'index'])->name('process-register');
Route::resource('/student/register', $controller_path . '\authentications\RegisterBasic', ['names' => 'students']);

//email verification
Route::get('/email/verify', [LoginBasic::class, 'emailVerify'])
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
