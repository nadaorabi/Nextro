<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'ShowHomePage'])->name('home_page');

// راوتات تسجيل الدخول والتسجيل للمستخدمين (خارج الجروب)
Route::get('user/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('user/login1', [UserController::class, 'login'])->name('login.post');
Route::get('user/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('user/register1', [UserController::class, 'register'])->name('register.post');

// راوتات تتطلب أن يكون المستخدم مسجل دخوله كمستخدم عادي فقط للكورسات
Route::get('user/Courses', [HomeController::class, 'ShowCoursesPage'])->middleware('isUser')->name('courses_page');

// بقية الصفحات متاحة للجميع
Route::get('user/About', [HomeController::class, 'ShowAboutPage'])->name('about_page');
Route::get('user/Gallery', [HomeController::class, 'ShowGalleryPage'])->name('gallery_page');
Route::get('user/News', [HomeController::class, 'ShowNewsPage'])->name('news_page');
Route::get('user/Staff', [HomeController::class, 'ShowStaffPage'])->name('Staff_page');
Route::get('user/Elements', [HomeController::class, 'ShowElementsPage'])->name('elements_page');
Route::get('user/Contact', [HomeController::class, 'ShowContactPage'])->name('Contact_page');
Route::get('user/Profile', [HomeController::class, 'ShowProfilePage'])->name('profile_page');

// راوتات تسجيل دخول وتسجيل مدرس (خارج الجروب)
Route::get('teacher/login', [TeacherController::class, 'showLoginForm'])->name('teacher.login');
Route::post('teacher/login', [TeacherController::class, 'login'])->name('teacher.login.post');
Route::get('teacher/sign-up', [TeacherController::class, 'showRegisterForm'])->name('teacher.sign-up');
Route::post('teacher/register', [TeacherController::class, 'register'])->name('teacher.register.post');

// راوتات تتطلب أن يكون المستخدم مدرس
Route::prefix('teacher')->middleware('isTeacher')->group(function () {
    Route::get('dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('billing', [TeacherController::class, 'billing'])->name('teacher.billing');
    Route::get('profile', [TeacherController::class, 'profile'])->name('teacher.profile');
   
    Route::get('tables', [TeacherController::class, 'tables'])->name('teacher.tables');
    
    Route::get('students', [TeacherController::class, 'students'])->name('teacher.students');
    Route::get('materials', [TeacherController::class, 'materials'])->name('teacher.materials');
    Route::get('complaints', [TeacherController::class, 'complaints'])->name('teacher.complaints');
    Route::get('finance', [TeacherController::class, 'finance'])->name('teacher.finance');
    Route::post('logout', [TeacherController::class, 'logout'])->name('teacher.logout');
});


