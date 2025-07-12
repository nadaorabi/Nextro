<?php

namespace App\Http\Controllers;

// from ali
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\StudentPackage;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Payment;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function ShowHomePage()
    {
        return view('User/index');
    }
    public function ShowAboutPage()
    {
        return view('User/about');
    }
    public function ShowGalleryPage()
    {
        return view('User/gallery');
    }
    public function ShowNewsPage()
    {
        return view('User/news');
      
    }
    public function ShowStaffPage()
    {
        return view('User/staff');
    }
    public function ShowElementsPage()
    {
        return view('User/elements');
    }
    public function ShowContactPage()
    {
        return view('User/contact');
    }
    public function ShowProfilePage()
    {
        // التحقق من أن المستخدم مسجل دخوله
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول أولاً');
        }

        $user = Auth::user();
        
        // جلب الكورسات المسجل بها الطالب
        $enrollments = $user->enrollments()
            ->with(['course.category', 'course.courseInstructors.instructor', 'course.schedules.room'])
            ->get();

        // جلب البكجات المسجل بها الطالب
        $studentPackages = $user->packages()
            ->with(['package.category', 'package.packageCourses.course.schedules.room'])
            ->get();

        // جلب سجلات الحضور
        $attendances = Attendance::whereIn('enrollment_id', $enrollments->pluck('id'))
            ->with(['enrollment.course', 'schedule'])
            ->orderBy('date', 'desc')
            ->get();

        // جلب الدرجات
        $grades = Grade::whereIn('enrollment_id', $enrollments->pluck('id'))
            ->with(['enrollment.course'])
            ->orderBy('created_at', 'desc')
            ->get();

        // جلب المدفوعات
        $payments = $user->payments()
            ->orderBy('payment_date', 'desc')
            ->get();

        // حساب إحصائيات الحضور
        $totalSessions = $attendances->count();
        $presentSessions = $attendances->where('status', 'present')->count();
        $absentSessions = $attendances->where('status', 'absent')->count();
        $lateSessions = $attendances->where('status', 'late')->count();
        $attendanceRate = $totalSessions > 0 ? round(($presentSessions / $totalSessions) * 100, 2) : 0;

        // حساب إحصائيات الدرجات
        $totalGrades = $grades->count();
        $averageGrade = $totalGrades > 0 ? round($grades->avg('score'), 2) : 0;
        $highestGrade = $totalGrades > 0 ? $grades->max('score') : 0;
        $lowestGrade = $totalGrades > 0 ? $grades->min('score') : 0;

        // حساب إحصائيات مالية
        // إجمالي المدفوعات (رسوم الطالب)
        $totalPaid = $payments->where('type', 'student_fee')->sum('amount');
        // إجمالي الاستردادات (استرداد الباقات)
        $totalRefunded = $payments->where('type', 'package_refund')->sum('amount');
        // صافي المدفوعات = المدفوعات + الاستردادات (كلاهما قيم موجبة)
        $netPayment = $totalPaid + $totalRefunded;

        return view('User/profile', compact(
            'user',
            'enrollments',
            'studentPackages',
            'attendances',
            'grades',
            'payments',
            'attendanceRate',
            'totalSessions',
            'presentSessions',
            'absentSessions',
            'lateSessions',
            'averageGrade',
            'totalGrades',
            'highestGrade',
            'lowestGrade',
            'totalPaid',
            'totalRefunded',
            'netPayment'
        ));
    }
    public function ShowCoursesPage()
    {
        return view('User/Courses');
    }
    
}


