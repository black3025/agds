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
use App\Http\Controllers\ClassScheduleController;
use App\Http\Controllers\EnrollmentAdminController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\EventController;
$controller_path = 'App\Http\Controllers';
// Main Page Route

Route::get('/', [FrontController::class, 'index'])->name('front');
Route::get('/reviews', [FrontController::class, 'review'])->name('front-review');

Route::middleware('auth', 'verified')->group(function () {
  Route::get('/Dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/getCourse', [CourseController::class, 'getCourse'])->name('getCourse');

  //Student
  Route::middleware('isStudent')->group(function () {
    Route::resource('/course', CourseController::class, ['names' => 'course']);

    Route::resource('/inquiry', InquiryController::class, ['names' => 'inquiry']);

    Route::resource('/enrollment', EnrollmentController::class, ['names' => 'enrollment']);
    Route::get('/enrolled', [EnrollmentController::class, 'enrolled'])->name('my enrollment');
    Route::get('/completed-course', [EnrollmentController::class, 'completed'])->name('completed course');
    Route::get('/enrolled-sched/{id}', [EnrollmentController::class, 'enrolledsched'])->name('Course Schedule');

    Route::resource('/review', ReviewController::class, ['names' => 'review']);
    Route::get('/fetchreview/{id}', [ReviewController::class, 'fetchreview'])->name('fetchreview');

    Route::post('/checkConflict', [EnrollmentController::class, 'checkConflict'])->name('checkConflict');
    Route::post('/redeem', [EnrollmentController::class, 'redeem'])->name('redeem');
    Route::post('/enrollUp', [EnrollmentController::class, 'enrollUp'])->name('enrollUp');

    Route::get('/getReservation', [EnrollmentController::class, 'getReservation'])->name('getReservation');
    Route::get('/reservation', [EnrollmentController::class, 'reservation'])->name('my reservation');
    Route::get('/deleteEnrollment/{id}', [EnrollmentController::class, 'deleteEnrollment'])->name('deleteEnrollment');
  });
  //Admin
  Route::middleware('isAdmin')->group(function () {
    Route::get('/admin/Dashboard', [DashboardController::class, 'adminIndex'])->name('admin-dashboard');
    Route::get('/admin/approveEnrollment/{id}', [EnrollmentAdminController::class, 'approveEnrollment'])->name(
      'approveEnrollment'
    );
    Route::get('/admin/deleteEnrollment/{id}', [EnrollmentAdminController::class, 'deleteEnrollment'])->name(
      'admindeleteEnrollment'
    );
    Route::get('/admin/getReservation', [EnrollmentAdminController::class, 'getReservation'])->name('AgetReservation');
    Route::get('/admin/reservation', [EnrollmentAdminController::class, 'reservation'])->name('admin reservation');

    Route::get('/admin/user-status/{id}', [UserController::class, 'updateStatus'])->name('user-status');
    Route::resource('/admin/students', StudentController::class, ['names' => 'student']);
    Route::resource('admin/users', UserController::class, ['names' => 'user']);
    Route::resource('/admin/course', CourseController::class, ['names' => 'admin-course']);

    Route::resource('/admin/schedule', ClassScheduleController::class, ['names' => 'schedule']);
    Route::get('/admin/sched-status/{id}', [ClassScheduleController::class, 'updateStatus'])->name('sched-status');

    Route::post('/admin/updateCourse', [CourseController::class, 'updateCourse'])->name('updateCourse');

    Route::resource('/admin/teachers', TeacherController::class, ['names' => 'teacher']);
    Route::get('/getTeacher', [TeacherController::class, 'getTeacher'])->name('getTeacher');
    Route::post('/updateTeacher', [TeacherController::class, 'updateTeacher'])->name('updateTeacher');

    Route::resource('/admin/rooms', RoomController::class, ['names' => 'room']);
    Route::get('/getRoom', [RoomController::class, 'getRoom'])->name('getRoom');
    Route::post('/updateRoom', [RoomController::class, 'updateRoom'])->name('updateRoom');
    Route::get('/admin/room-status/{id}', [RoomController::class, 'updateStatus'])->name('room-status');

    Route::resource('/admin/enrollments', EnrollmentAdminController::class, ['names' => 'admin-enrollment']);
    Route::get('/getEnrollments', [EnrollmentAdminController::class, 'getEnrollments'])->name('getEnrollments');

    Route::get('/admin/post', [PostController::class, 'AdminIndex'])->name('post-index');
    Route::get('/getPosts', [PostController::class, 'getPosts'])->name('getPosts');

    Route::resource('/admin/review', ReviewController::class, ['names' => 'admin-review']);
  });

  //Teacher
  Route::middleware('isTeacher')->group(function () {
    Route::get('/teacher/Dashboard', [DashboardController::class, 'teacherIndex'])->name('teacher-dashboard');
    Route::resource('/teacher/course', CourseController::class, ['names' => 'teacher-course']);
    Route::get('/class/close/{id}', [ClassScheduleController::class, 'classClose'])->name('close-course');
    Route::resource('/teacher/students', StudentController::class, ['names' => 'teacher-student']);
    Route::get('/teacher/course-sched/{id}', [EnrollmentAdminController::class, 'coursesched'])->name(
      'Teacher Schedule'
    );
    Route::get('/teacher/resched/{id}', [EventController::class, 'resched'])->name('resched');
  });
});
Route::resource('/users', UserController::class, ['names' => 'user']);
Route::post('/updateUser', [UserController::class, 'updateUser'])->name('userUpdate');
Route::post('/updatePic', [UserController::class, 'updatePic'])->name('userPic');

Route::resource('/contactus', $controller_path . '\ContactUsController', ['names' => 'contactus']);

// authentication
Route::get('/auth/login', [LoginBasic::class, 'index'])->name('login');
Route::post('auth/signin', [LoginBasic::class, 'signin'])->name('signin');
Route::get('auth/logout', [LoginBasic::class, 'logout'])->name('logout');
Route::get('/auth/register', [RegisterBasic::class, 'index'])->name('auth-register');
Route::get('/auth/forgot-password', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password');
Route::put('/auth/register', [RegisterBasic::class, 'index'])->name('process-register');
Route::resource('/student/register', $controller_path . '\authentications\RegisterBasic', ['names' => 'students']);

//notification
Route::get('/mark-as-read', [EnrollmentController::class, 'markAsRead'])->name('mark-as-read');

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

Route::post('/email/verification-notification', [LoginBasic::class, 'resendVerify'])
  ->middleware(['auth', 'throttle:6,1'])
  ->name('verification.send');
