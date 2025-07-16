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
use App\Models\Schedule;
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
            return redirect()->route('login')->with('error', 'You must login first');
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

        // حساب الرسوم المستحقة
        $totalCoursesDue = $enrollments->sum(function($enrollment) {
            return $enrollment->course ? $enrollment->course->final_price : 0;
        });
        $totalPackagesDue = $studentPackages->sum(function($sp) {
            return $sp->package ? ($sp->package->discounted_price ?? $sp->package->price) : 0;
        });
        $totalDiscount = $payments->where('type', 'discount')->sum('amount');
        $totalDue = $totalCoursesDue + $totalPackagesDue - $totalDiscount;
        $outstandingBalance = $totalDue - $totalPaid + $totalRefunded;

        // جلب الجداول الزمنية للطالب
        $courseSchedules = collect();
        foreach ($enrollments as $enrollment) {
            if ($enrollment->course && $enrollment->course->schedules) {
                foreach ($enrollment->course->schedules as $schedule) {
                    // البحث عن سجل الحضور لهذا الطالب في هذه الحصة
                    $attendance = Attendance::where('enrollment_id', $enrollment->id)
                        ->where('schedule_id', $schedule->id)
                        ->where('date', $schedule->session_date)
                        ->first();
                    
                    $attendanceStatus = 'pending'; // الحالة الافتراضية
                    if ($attendance) {
                        $attendanceStatus = $attendance->status;
                    }
                    
                    $courseSchedules->push([
                        'type' => 'course',
                        'name' => $enrollment->course->title,
                        'category' => $enrollment->course->category->name ?? '',
                        'session_date' => $schedule->session_date,
                        'day_of_week' => $schedule->day_of_week,
                        'start_time' => $schedule->start_time,
                        'end_time' => $schedule->end_time,
                        'room' => $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name ?? '') : '',
                        'attendance_status' => $attendanceStatus,
                        'instructor' => $enrollment->course->courseInstructors->first()->instructor->name ?? 'No Instructor',
                        'course_id' => $enrollment->course->id,
                        'schedule_id' => $schedule->id,
                    ]);
                }
            }
        }

        // جميع جداول الكورسات ضمن البكجات
        $packageSchedules = collect();
        foreach ($studentPackages as $sp) {
            if ($sp->package && $sp->package->packageCourses) {
                foreach ($sp->package->packageCourses as $pc) {
                    $course = $pc->course;
                    if ($course && $course->schedules) {
                        foreach ($course->schedules as $schedule) {
                            // البحث عن سجل الحضور لهذا الطالب في هذه الحصة
                            // Note: For package courses, we need to find the enrollment for this specific course
                            $enrollment = $enrollments->where('course_id', $course->id)->first();
                            $attendance = null;
                            $attendanceStatus = 'pending'; // الحالة الافتراضية
                            
                            if ($enrollment) {
                                $attendance = Attendance::where('enrollment_id', $enrollment->id)
                                    ->where('schedule_id', $schedule->id)
                                    ->where('date', $schedule->session_date)
                                    ->first();
                                
                                if ($attendance) {
                                    $attendanceStatus = $attendance->status;
                                }
                            }
                            
                            $packageSchedules->push([
                                'type' => 'package',
                                'package_name' => $sp->package->name,
                                'name' => $course->title,
                                'category' => $course->category->name ?? '',
                                'session_date' => $schedule->session_date,
                                'day_of_week' => $schedule->day_of_week,
                                'start_time' => $schedule->start_time,
                                'end_time' => $schedule->end_time,
                                'room' => $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name ?? '') : '',
                                'attendance_status' => $attendanceStatus,
                                'instructor' => $course->courseInstructors->first()->instructor->name ?? 'No Instructor',
                                'course_id' => $course->id,
                                'schedule_id' => $schedule->id,
                            ]);
                        }
                    }
                }
            }
        }

        // دمج وترتيب كل الجداول حسب التاريخ والوقت
        $allSchedules = $courseSchedules->merge($packageSchedules)->sortBy([['session_date', 'asc'], ['start_time', 'asc']])->values();

        // جلب المعاملات المالية الأخيرة
        $recentTransactions = $payments->take(10);

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
            'netPayment',
            'totalDue',
            'outstandingBalance',
            'allSchedules',
            'recentTransactions'
        ));
    }
    public function ShowCoursesPage()
    {
        return view('User/Courses');
    }
    
}


