<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;



// صفحات تسجيبيل المستخدمين 
Route::get('/user/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/user/register', [UserController::class, 'register'])->name('register.post');

// صفحات تسجيل الدخول والخروج
Route::get('/user/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/user/login', [UserController::class, 'login'])->name('login.post');
Route::post('/user/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

// صفحات المدرسين
Route::prefix('teacher')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [TeacherController::class, 'showLoginForm'])->name('teacher.login');
        Route::post('login', [TeacherController::class, 'login'])->name('teacher.login.post');
        Route::get('register', [TeacherController::class, 'showRegisterForm'])->name('teacher.register');
        Route::post('register', [TeacherController::class, 'register'])->name('teacher.register.post');
    });

    Route::middleware(['auth', 'teacher'])->group(function () {
        Route::get('dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
        Route::post('logout', [TeacherController::class, 'logout'])->name('teacher.logout');
    });
});

// صفحات خاصة لكل دور
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    })->name('teacher.dashboard');

    Route::get('/student/dashboard', function () {
        return view('student.dashboard');
    })->name('student.dashboard');
});
//صفحات الموقع الرئيسي
Route::get('/', action: [HomeController::class, 'ShowHomePage'])->name('home_page');
Route::get('/About', action: [HomeController::class, 'ShowAboutPage'])->name('about_page');
Route::get('/Gallery', action: [HomeController::class, 'ShowGalleryPage'])->name('gallery_page');
Route::get('/News', action: [HomeController::class, 'ShowNewsPage'])->name('news_page');
Route::get('/Staff', action: [HomeController::class, 'ShowStaffPage'])->name('Staff_page');
Route::get('/Elements', action: [HomeController::class, 'ShowElementsPage'])->name('elements_page');

Route::get('/Contact', action: [HomeController::class, 'ShowContactPage'])->name('Contact_page');
Route::get('/Profile', action: [HomeController::class, 'ShowProfilePage'])->name('profile_page');
Route::get('/Courses', action: [HomeController::class, 'ShowCoursesPage'])->name('courses_page');