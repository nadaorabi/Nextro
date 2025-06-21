<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Educational\CategoryController;
use App\Http\Controllers\Admin\Accounts\StudentController;
use App\Http\Controllers\Admin\Educational\CourseController;
use App\Http\Controllers\Admin\Educational\PackageController;

use App\Models\Category;
use App\Models\Course;

// الصفحة الرئيسية
Route::get('/', [HomeController::class, 'ShowHomePage'])->name('home_page');

// راوتات تسجيل الدخول والتسجيل للمستخدمين (خارج الجروب)
Route::get('user/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('user/login1', [UserController::class, 'login'])->name('login.post');
Route::get('user/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('user/register1', [UserController::class, 'register'])->name('register.post');
Route::post('user/logout', [UserController::class, 'logout'])->name('logout');

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

// صفحة تسجيل الدخول الموحدة للمدرس/الأدمن
Route::get('staff/login', [TeacherController::class, 'showLoginForm'])->name('staff.login');
Route::post('staff/login', [TeacherController::class, 'login'])->name('staff.login.post');
Route::get('staff/sign-up', [TeacherController::class, 'showRegisterForm'])->name('staff.sign-up');
Route::post('staff/register', [TeacherController::class, 'register'])->name('staff.register.post');

// راوتات الأدمن
Route::prefix('admin')->middleware('isAdmin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('billing', [AdminController::class, 'billing'])->name('billing');
    Route::get('tables', [AdminController::class, 'tables'])->name('tables');
    Route::get('students', [AdminController::class, 'students'])->name('students');
    Route::get('QR-scan', [AdminController::class, 'QR_scan'])->name('QR-scan');
    Route::get('materials', [AdminController::class, 'materials'])->name('materials');
    Route::get('complaints', [AdminController::class, 'complaints'])->name('complaints');
    Route::get('finance', [AdminController::class, 'finance'])->name('finance');
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('logout', [AdminController::class, 'logout'])->name('logout');


    // Accounts Management
    Route::prefix('accounts/students')->name('accounts.students.')->group(function () {
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/store', [StudentController::class, 'store'])->name('store');
        Route::get('/list', [StudentController::class, 'index'])->name('list');
        Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit');
        Route::put('/{id}', [StudentController::class, 'update'])->name('update');
        Route::get('/{id}', [StudentController::class, 'show'])->name('show');
        Route::delete('/{id}', [StudentController::class, 'destroy'])->name('destroy');
    });

    /////////////
    Route::get('accounts/teachers/create', [AdminController::class, 'teachersCreate'])->name('accounts.teachers.create');
    Route::get('accounts/teachers/list', [AdminController::class, 'teachersList'])->name('accounts.teachers.list');
    Route::get('accounts/admins/create', [AdminController::class, 'adminsCreate'])->name('accounts.admins.create');
    Route::get('accounts/admins/list', [AdminController::class, 'adminsList'])->name('accounts.admins.list');
    
    // Educational Categories Management
    Route::prefix('educational-categories')->name('educational-categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        Route::get('show/{category}', [CategoryController::class, 'show'])->name('show');
    });

    // Educational Courses Management
    Route::prefix('educational-courses')->name('educational-courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/create', [CourseController::class, 'create'])->name('create');
        Route::get('/edit', [CourseController::class, 'edit'])->name('edit');
        Route::post('/store', [CourseController::class, 'store'])->name('store');
        Route::put('/{course}', [CourseController::class, 'update'])->name('update');
        Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy');
        Route::get('show/{course}', [CourseController::class, 'show'])->name('show');
    });

    Route::get('educational-courses/list', [CourseController::class, 'index'])->name('educational-courses.index');
    Route::get('educational-courses/create', [CourseController::class, 'create'])->name('educational-courses.create');

    Route::get('educational-packages/list', [PackageController::class, 'index'])->name('educational-packages.index');
    Route::get('educational-packages/create', [PackageController::class, 'create'])->name('educational-packages.create');

    Route::get('educational-materials/create', [AdminController::class, 'materialsCreate'])->name('educational-materials.create');
    Route::get('educational-materials/edit', [AdminController::class, 'materialsEdit'])->name('educational-materials.edit');
    Route::get('educational-materials/link', [AdminController::class, 'materialsLink'])->name('educational-materials.link');
    Route::get('educational-materials/list', [AdminController::class, 'materialsList'])->name('educational-materials.list');
    // المتابعة والإشراف
    Route::get('supervision/attendance', [AdminController::class, 'supervisionAttendance'])->name('supervision.attendance');
    Route::get('supervision/complaints', [AdminController::class, 'supervisionComplaints'])->name('supervision.complaints');
    Route::get('supervision/qr', [AdminController::class, 'supervisionQR'])->name('supervision.qr');
    // جداول
    Route::get('tables/create', [AdminController::class, 'tablesCreate'])->name('tables.create');
    Route::get('tables/edit', [AdminController::class, 'tablesEdit'])->name('tables.edit');
    Route::get('tables/list', [AdminController::class, 'tablesList'])->name('tables.list');
    // إدارة القاعات والمرافق
    Route::prefix('facilities')->name('facilities.')->group(function () {
        Route::get('halls/create', [AdminController::class, 'hallsCreate'])->name('halls.create');
        Route::post('halls/store', [AdminController::class, 'hallsStore'])->name('halls.store');
        Route::get('halls/list', [AdminController::class, 'hallsList'])->name('halls.list');
        Route::get('manage', [AdminController::class, 'facilitiesManage'])->name('manage');
    });
    // مالية
    Route::get('finance/payments', [AdminController::class, 'financePayments'])->name('finance.payments');
});

// راوتات المدرس
Route::prefix('teacher')->middleware('isTeacher')->name('teacher.')->group(function () {
    Route::get('dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
    Route::get('billing', [TeacherController::class, 'billing'])->name('billing');
    Route::get('tables', [TeacherController::class, 'tables'])->name('tables');
    Route::get('students', [TeacherController::class, 'students'])->name('students');
    Route::get('QR-scan', [TeacherController::class, 'QR_scan'])->name('QR-scan');
    Route::get('materials', [TeacherController::class, 'materials'])->name('materials');
    Route::get('complaints', [TeacherController::class, 'complaints'])->name('complaints');
    Route::get('finance', [TeacherController::class, 'finance'])->name('finance');
    Route::get('profile', [TeacherController::class, 'profile'])->name('profile');
    Route::post('logout', [TeacherController::class, 'logout'])->name('logout');
});

