<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// use App\Models\User;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
   
    public function showLoginForm()
    {
        return view('Teacher.sign-in');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // Search for user using user_name
        $user = User::where('user_name', $credentials['user_name'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            if ($user->role == 'teacher') {
                Auth::login($user, $request->filled('remember'));
                $request->session()->regenerate();
                session()->flash('welcome', 'Welcome Teacher');
                return redirect()->intended(route('teacher.dashboard'));
            } elseif ($user->role == 'admin') {
                Auth::login($user, $request->filled('remember'));
                $request->session()->regenerate();
                session()->flash('welcome', 'Welcome System Administrator');
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
            return back()->withErrors([
                'user_name' => 'This account is not authorized to login from here.'
            ]);
        }

        return back()->withErrors([
            'user_name' => 'Invalid credentials.',
        ]);
    }

    // ========== التسجيل ==========
    public function showRegisterForm()
    {
        return view('teacher.sign-up');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255', 'unique:users,user_name'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'terms' => ['required', 'accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
        ]);

        Auth::login($user);

        return redirect()->route('teacher.dashboard');
    }

    // ========== تسجيل الخروج ==========
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('staff.login');
    }
  
    public function dashboard()
    {
        // جلب بيانات المعلم المسجل دخوله
        $teacher = auth()->user();
        
        // جلب الكورسات التي يدرسها المعلم
        $teacherCourses = \App\Models\CourseInstructor::where('instructor_id', $teacher->id)
            ->with(['course.category', 'course.enrollments', 'course.schedules'])
            ->get();
        
        // إحصائيات المعلم
        $totalCourses = $teacherCourses->count();
        $totalStudents = 0;
        $totalSchedules = 0;
        $totalEarnings = 0;
        
        foreach ($teacherCourses as $courseInstructor) {
            $course = $courseInstructor->course;
            $enrollmentsCount = $course->enrollments->count();
            $totalStudents += $enrollmentsCount;
            $totalSchedules += $course->schedules->count();
            $totalEarnings += $enrollmentsCount * ($course->price ?? 0) * ($courseInstructor->percentage / 100);
        }
        
        // جلب الجداول القادمة (اليوم والغد)
        $today = now()->format('Y-m-d');
        $tomorrow = now()->addDay()->format('Y-m-d');
        
        $upcomingSchedules = collect();
        foreach ($teacherCourses as $courseInstructor) {
            $course = $courseInstructor->course;
            if ($course && $course->schedules) {
                foreach ($course->schedules as $schedule) {
                    if ($schedule->session_date >= $today) {
                        $upcomingSchedules->push([
                            'id' => $schedule->id,
                            'course' => $course->title,
                            'category' => $course->category->name ?? '',
                            'session_date' => $schedule->session_date,
                            'day_of_week' => $schedule->day_of_week,
                            'start_time' => $schedule->start_time,
                            'end_time' => $schedule->end_time,
                            'room' => $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name ?? '') : '',
                            'course_id' => $course->id,
                        ]);
                    }
                }
            }
        }
        
        // ترتيب الجداول القادمة
        $upcomingSchedules = $upcomingSchedules->sortBy([['session_date', 'asc'], ['start_time', 'asc']])->values();
        
        // جلب آخر المدفوعات
        $recentPayments = \App\Models\Payment::where('user_id', $teacher->id)
            ->where('type', 'instructor_share')
            ->orderBy('payment_date', 'desc')
            ->limit(5)
            ->get();
        
        if (auth()->user()->role == 'teacher') {
            session()->flash('welcome', 'Welcome Teacher');
        }
        
        return view('teacher.dashboard', compact(
            'teacher',
            'teacherCourses',
            'totalCourses',
            'totalStudents',
            'totalSchedules',
            'totalEarnings',
            'upcomingSchedules',
            'recentPayments'
        ));
    }

    public function billing()           { return view('teacher.billing'); }
    public function profile()
    {
        // جلب بيانات المعلم المسجل دخوله
        $teacher = auth()->user();
        
        // جلب الكورسات التي يدرسها المعلم
        $teacherCourses = \App\Models\CourseInstructor::where('instructor_id', $teacher->id)
            ->with(['course.category', 'course.enrollments', 'course.schedules'])
            ->get();
        
        // إحصائيات المعلم
        $totalCourses = $teacherCourses->count();
        $totalStudents = 0;
        $totalSchedules = 0;
        
        foreach ($teacherCourses as $courseInstructor) {
            $course = $courseInstructor->course;
            $totalStudents += $course->enrollments->count();
            $totalSchedules += $course->schedules->count();
        }
        
        // جلب المدفوعات للمعلم
        $payments = \App\Models\Payment::where('user_id', $teacher->id)
            ->where('type', 'instructor_share')
            ->orderBy('payment_date', 'desc')
            ->limit(5)
            ->get();
        
        return view('teacher.profile', compact(
            'teacher', 
            'teacherCourses', 
            'totalCourses', 
            'totalStudents', 
            'totalSchedules',
            'payments'
        ));
    }
    public function rtl()               { return view('teacher.rtl'); }
    public function tables()
    {
        // جلب بيانات المعلم المسجل دخوله
        $teacher = auth()->user();
        
        // جلب الكورسات التي يدرسها المعلم
        $teacherCourses = \App\Models\CourseInstructor::where('instructor_id', $teacher->id)
            ->with(['course.category', 'course.schedules.room'])
            ->get();
        
        // تجميع جميع الجداول للمعلم
        $allSchedules = collect();
        foreach ($teacherCourses as $courseInstructor) {
            $course = $courseInstructor->course;
            if ($course && $course->schedules) {
                foreach ($course->schedules as $schedule) {
                    $allSchedules->push([
                        'course' => $course->title,
                        'category' => $course->category->name ?? '',
                        'session_date' => $schedule->session_date,
                        'day_of_week' => $schedule->day_of_week,
                        'start_time' => $schedule->start_time,
                        'end_time' => $schedule->end_time,
                        'room' => $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name ?? '') : '',
                        'course_id' => $course->id,
                        'schedule_id' => $schedule->id,
                    ]);
                }
            }
        }
        
        // ترتيب الجداول حسب التاريخ والوقت
        $allSchedules = $allSchedules->sortBy([['session_date', 'asc'], ['start_time', 'asc']])->values();
        
        return view('teacher.tables', compact('teacher', 'allSchedules', 'teacherCourses'));
    }
    public function virtualReality()    { return view('teacher.virtual-reality'); }
    public function students()
    {
        // جلب بيانات المعلم المسجل دخوله
        $teacher = auth()->user();
        
        // جلب الكورسات التي يدرسها المعلم
        $teacherCourses = \App\Models\CourseInstructor::where('instructor_id', $teacher->id)
            ->with(['course.category', 'course.enrollments.student'])
            ->get();
        
        // تجميع جميع الطلاب المسجلين في كورسات المعلم
        $allStudents = collect();
        
        // الطلاب المسجلين في الكورسات مباشرة
        foreach ($teacherCourses as $courseInstructor) {
            $course = $courseInstructor->course;
            if ($course && $course->enrollments) {
                foreach ($course->enrollments as $enrollment) {
                    $student = $enrollment->student;
                    if ($student) {
                        // تجنب تكرار الطالب إذا كان مسجل في أكثر من كورس للمعلم
                        $existingStudent = $allStudents->where('id', $student->id)->first();
                        if (!$existingStudent) {
                            $allStudents->push([
                                'id' => $student->id,
                                'name' => $student->name,
                                'login_id' => $student->login_id,
                                'email' => $student->email,
                                'mobile' => $student->mobile,
                                'avatar' => $student->avatar,
                                'courses' => collect(),
                                'packages' => collect(),
                                'enrollments' => collect(),
                                'enrollment_type' => 'course',
                            ]);
                        }
                        
                        // إضافة الكورس للطالب
                        $studentData = $allStudents->where('id', $student->id)->first();
                        if ($studentData) {
                            $studentData['courses']->push([
                                'id' => $course->id,
                                'title' => $course->title,
                                'category' => $course->category->name ?? '',
                                'enrollment_id' => $enrollment->id,
                                'enrollment_date' => $enrollment->enrollment_date,
                                'status' => $enrollment->status,
                                'type' => 'direct_course',
                            ]);
                            $studentData['enrollments']->push($enrollment);
                        }
                    }
                }
            }
        }
        
        // الطلاب المسجلين في البكجات التي تحتوي على كورسات المعلم
        foreach ($teacherCourses as $courseInstructor) {
            $course = $courseInstructor->course;
            
            // البحث عن البكجات التي تحتوي على هذا الكورس
            $packagesWithCourse = \App\Models\PackageCourse::where('course_id', $course->id)
                ->with(['package.students.student'])
                ->get();
            
            foreach ($packagesWithCourse as $packageCourse) {
                $package = $packageCourse->package;
                if ($package && $package->students) {
                    foreach ($package->students as $studentPackage) {
                        $student = $studentPackage->student;
                        if ($student) {
                            // تجنب تكرار الطالب إذا كان مسجل في أكثر من كورس للمعلم
                            $existingStudent = $allStudents->where('id', $student->id)->first();
                            if (!$existingStudent) {
                                $allStudents->push([
                                    'id' => $student->id,
                                    'name' => $student->name,
                                    'login_id' => $student->login_id,
                                    'email' => $student->email,
                                    'mobile' => $student->mobile,
                                    'avatar' => $student->avatar,
                                    'courses' => collect(),
                                    'packages' => collect(),
                                    'enrollments' => collect(),
                                    'enrollment_type' => 'package',
                                ]);
                            }
                            
                            // إضافة البكج للطالب
                            $studentData = $allStudents->where('id', $student->id)->first();
                            if ($studentData) {
                                // إضافة الكورس من البكج
                                $studentData['courses']->push([
                                    'id' => $course->id,
                                    'title' => $course->title,
                                    'category' => $course->category->name ?? '',
                                    'enrollment_id' => null,
                                    'enrollment_date' => $studentPackage->purchase_date,
                                    'status' => 'active',
                                    'type' => 'package_course',
                                    'package_name' => $package->name,
                                ]);
                                
                                // إضافة البكج إذا لم يكن موجود
                                $existingPackage = $studentData['packages']->where('id', $package->id)->first();
                                if (!$existingPackage) {
                                    $studentData['packages']->push([
                                        'id' => $package->id,
                                        'name' => $package->name,
                                        'title' => $package->title,
                                        'purchase_date' => $studentPackage->purchase_date,
                                        'amount_paid' => $studentPackage->amount_paid,
                                        'student_package_id' => $studentPackage->id,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }
        
        // ترتيب الطلاب حسب الاسم
        $allStudents = $allStudents->sortBy('name')->values();
        
        return view('teacher.students', compact('teacher', 'allStudents', 'teacherCourses'));
    }
    public function materials()
    {
        // جلب بيانات المعلم المسجل دخوله
        $teacher = auth()->user();
        
        // جلب الكورسات التي يدرسها المعلم
        $teacherCourses = \App\Models\CourseInstructor::where('instructor_id', $teacher->id)
            ->with(['course.category', 'course.materials'])
            ->get();
        
        // تجميع جميع المواد الدراسية للمعلم
        $allMaterials = collect();
        foreach ($teacherCourses as $courseInstructor) {
            $course = $courseInstructor->course;
            if ($course && $course->materials) {
                foreach ($course->materials as $material) {
                    $allMaterials->push([
                        'id' => $material->id,
                        'title' => $material->title,
                        'description' => $material->description,
                        'file_path' => $material->file_path,
                        'file_type' => $material->file_type,
                        'file_size' => $material->file_size,
                        'upload_date' => $material->created_at,
                        'course' => $course->title,
                        'category' => $course->category->name ?? '',
                        'course_id' => $course->id,
                    ]);
                }
            }
        }
        
        // ترتيب المواد حسب تاريخ الرفع
        $allMaterials = $allMaterials->sortByDesc('upload_date')->values();
        
        return view('teacher.materials', compact('teacher', 'allMaterials', 'teacherCourses'));
    }
    public function complaints()
    {
        // جلب بيانات المعلم المسجل دخوله
        $teacher = auth()->user();
        
        // جلب الكورسات التي يدرسها المعلم
        $teacherCourses = \App\Models\CourseInstructor::where('instructor_id', $teacher->id)
            ->with(['course.category', 'course.complaints.student'])
            ->get();
        
        // تجميع جميع الشكاوى المتعلقة بكورسات المعلم
        $allComplaints = collect();
        foreach ($teacherCourses as $courseInstructor) {
            $course = $courseInstructor->course;
            if ($course && $course->complaints) {
                foreach ($course->complaints as $complaint) {
                    $allComplaints->push([
                        'id' => $complaint->id,
                        'title' => $complaint->title,
                        'description' => $complaint->description,
                        'status' => $complaint->status,
                        'priority' => $complaint->priority,
                        'created_at' => $complaint->created_at,
                        'student' => $complaint->student->name ?? '',
                        'student_id' => $complaint->student_id,
                        'course' => $course->title,
                        'category' => $course->category->name ?? '',
                        'course_id' => $course->id,
                    ]);
                }
            }
        }
        
        // ترتيب الشكاوى حسب الأولوية والتاريخ
        $allComplaints = $allComplaints->sortBy([
            ['priority', 'desc'],
            ['created_at', 'desc']
        ])->values();
        
        return view('teacher.complaints', compact('teacher', 'allComplaints', 'teacherCourses'));
    }
    public function finance()
    {
        $teacher = auth()->user();
        // جلب كل العمليات المالية للأستاذ مرتبة من الأقدم للأحدث
        $payments = \App\Models\Payment::where('user_id', $teacher->id)
            ->orderBy('payment_date', 'asc')
            ->get();
        // إجمالي الأرباح: فقط العمليات من نوع instructor_share
        $totalEarnings = $payments->where('type', 'instructor_share')->sum('amount');
        // إجمالي الدفعات: فقط العمليات من نوع instructor_payment
        $totalPayments = $payments->where('type', 'instructor_payment')->sum('amount');
        // صافي الرصيد
        $netBalance = $totalEarnings - $totalPayments;
        // جلب الكورسات التي يدرسها المعلم مع نسبه
        $teacherCourses = \App\Models\CourseInstructor::where('instructor_id', $teacher->id)
            ->with(['course.category', 'course.enrollments'])
            ->get();
        // إحصائيات الكورسات (بدون تغيير)
        $courseStats = collect();
        foreach ($teacherCourses as $courseInstructor) {
            $course = $courseInstructor->course;
            $enrollmentsCount = $course->enrollments->count();
            $courseEarnings = $enrollmentsCount * ($course->price ?? 0) * ($courseInstructor->percentage / 100);
            $courseStats->push([
                'course_id' => $course->id,
                'course_title' => $course->title,
                'category' => $course->category->name ?? '',
                'enrollments_count' => $enrollmentsCount,
                'percentage' => $courseInstructor->percentage,
                'course_price' => $course->price ?? 0,
                'earnings' => $courseEarnings,
            ]);
        }
        return view('teacher.finance', compact(
            'teacher', 
            'payments', 
            'teacherCourses', 
            'totalEarnings', 
            'totalPayments', 
            'netBalance',
            'courseStats'
        ));
    }
    public function QR_scan()
    {
        // جلب بيانات المعلم المسجل دخوله
        $teacher = auth()->user();
        
        // جلب الكورسات التي يدرسها المعلم مع الجداول والعلاقات
        $courses = \App\Models\CourseInstructor::where('instructor_id', $teacher->id)
            ->with([
                'course.category', 
                'course.schedules.room', 
                'course.enrollments',
                'course.packages',
                'instructor'
            ])
            ->get();
        
        $scheduleStats = [];
        foreach ($courses as $courseInstructor) {
            $course = $courseInstructor->course;
            
            // التحقق من وجود الكورس والجداول
            if ($course && $course->schedules) {
                foreach ($course->schedules as $schedule) {
                    $studentCount = \App\Models\Enrollment::where('course_id', $course->id)->count();
                    
                    // حساب الحضور للمحاضرة المحددة فقط
                    $presentCount = \App\Models\Attendance::whereIn('enrollment_id', \App\Models\Enrollment::where('course_id', $course->id)->pluck('id'))
                        ->where('schedule_id', $schedule->id)
                        ->where('status', 'present')
                        ->count();
                        
                    $absentCount = \App\Models\Attendance::whereIn('enrollment_id', \App\Models\Enrollment::where('course_id', $course->id)->pluck('id'))
                        ->where('schedule_id', $schedule->id)
                        ->where('status', 'absent')
                        ->count();
                        
                    // الطلاب الذين لم يتم أخذ الحضور لهم بعد (pending)
                    $pendingCount = $studentCount - $presentCount - $absentCount;
                    
                    $scheduleStats[$schedule->id] = [
                        'students' => $studentCount,
                        'present' => $presentCount,
                        'absent' => $absentCount,
                        'pending' => $pendingCount,
                    ];
                }
            }
        }
        return view('teacher.QR-scan', compact('teacher', 'courses', 'scheduleStats'));
    }
    public function financeCoursesReport()
    {
        $teacher = auth()->user();
        // جلب كل العمليات المالية للأستاذ
        $payments = \App\Models\Payment::where('user_id', $teacher->id)
            ->where('type', 'instructor_share')
            ->get();
        // جلب الكورسات التي يدرسها المعلم
        $teacherCourses = \App\Models\CourseInstructor::where('instructor_id', $teacher->id)
            ->with(['course.enrollments'])
            ->get();
        // تجميع الأرباح حسب المادة
        $courseEarnings = [];
        foreach ($teacherCourses as $courseInstructor) {
            $course = $courseInstructor->course;
            $courseName = $course->title;
            $courseId = $course->id;
            // أرباح المادة
            $earnings = 0;
            foreach ($payments as $payment) {
                $desc = $payment->notes ?? $payment->description ?? '';
                // ابحث عن اسم المادة في الوصف
                if (stripos($desc, $courseName) !== false) {
                    $earnings += $payment->amount;
                }
            }
            $courseEarnings[] = [
                'course' => $courseName,
                'earnings' => $earnings,
                'students' => $course->enrollments->count(),
            ];
        }
        return view('teacher.finance-courses-report', compact('teacher', 'courseEarnings'));
    }
}
