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
    // إدارة الحسابات
    Route::get('accounts/students/create', [StudentController::class, 'create'])->name('accounts.students.create');
    Route::post('accounts/students/store', [StudentController::class, 'store'])->name('accounts.students.store');
    Route::get('accounts/students/list', [StudentController::class, 'index'])->name('accounts.students.list');
    Route::get('accounts/students/edit', [StudentController::class, 'edit'])->name('accounts.students.edit');
    Route::get('accounts/students/show', [StudentController::class, 'show'])->name('accounts.students.show');
    Route::get('accounts/students/destroy', [StudentController::class, 'destroy'])->name('accounts.students.destroy');
    /////////////
    Route::get('accounts/teachers/create', [AdminController::class, 'teachersCreate'])->name('accounts.teachers.create');
    Route::get('accounts/teachers/list', [AdminController::class, 'teachersList'])->name('accounts.teachers.list');
    Route::get('accounts/admins/create', [AdminController::class, 'adminsCreate'])->name('accounts.admins.create');
    Route::get('accounts/admins/list', [AdminController::class, 'adminsList'])->name('accounts.admins.list');
    // إدارة المواد التعليميه
    Route::get('educational-categories/create', [CategoryController::class, 'create'])->name('educational-categories.create');
    Route::post('educational-categories/store', [CategoryController::class, 'store'])->name('educational-categories.store');
    Route::get('educational-categories/list', [CategoryController::class, 'index'])->name('educational-categories.index');

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

