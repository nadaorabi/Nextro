<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // عرض قائمة المواد والحصص وزر أخذ الحضور
    public function index(Request $request)
    {
        $courses = \App\Models\Course::with(['courseInstructors.instructor', 'schedules', 'category', 'packages'])
            ->withCount(['enrollments', 'packages'])
            ->get();
        $scheduleStats = [];
        foreach ($courses as $course) {
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
        return view('admin.attendance.index', compact('courses', 'scheduleStats'));
    }

    // عرض تفاصيل الحضور والغياب مع الفلاتر
    public function details(Request $request)
    {
        // الفلاتر
        $courseId = $request->get('course_id');
        $scheduleId = $request->get('schedule_id');
        $date = $request->get('date');
        $status = $request->get('status'); // present, absent, all
        $search = $request->get('search'); // بحث بالاسم أو login_id

        // جلب البيانات للفلاتر
        $courses = \App\Models\Course::orderBy('title')->get();
        $schedules = \App\Models\Schedule::with('course')->orderBy('day_of_week')->get();
        
        // بناء الاستعلام
        $query = \App\Models\Enrollment::with(['student', 'course', 'attendance']);

        // تطبيق الفلاتر
        if ($courseId) {
            $query->where('course_id', $courseId);
        }
        
        if ($scheduleId) {
            $schedule = \App\Models\Schedule::find($scheduleId);
            if ($schedule) {
                $query->where('course_id', $schedule->course_id);
            }
        }

        if ($search) {
            $query->whereHas('student', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('login_id', 'like', "%{$search}%");
            });
        }

        $enrollments = $query->get();

        // جلب كل سجلات الحضور المرتبطة بهذه enrollments
        $attendanceRecords = [];
        foreach ($enrollments as $enrollment) {
            foreach ($enrollment->attendance as $att) {
                // فلترة حسب التاريخ إذا لزم الأمر
                if (!$date || $att->date == $date) {
                    if ($status == 'present' && $att->status != 'present') continue;
                    if ($status == 'absent' && $att->status == 'present') continue;
                    $attendanceRecords[] = [
                        'student' => $enrollment->student,
                        'course' => $enrollment->course,
                        'date' => $att->date,
                        'status' => $att->status,
                        'time' => $att->created_at ? $att->created_at->format('H:i:s') : '-',
                        'method' => $att->method,
                        'schedule' => $att->schedule,
                    ];
                }
            }
        }

        // إحصائيات
        $stats = [
            'total' => count($attendanceRecords),
            'present' => collect($attendanceRecords)->where('status', 'present')->count(),
            'absent' => collect($attendanceRecords)->where('status', '!=', 'present')->count(),
        ];

        return view('admin.attendance.details', compact(
            'attendanceRecords',
            'courses', 
            'schedules', 
            'stats',
            'courseId',
            'scheduleId', 
            'date', 
            'status', 
            'search'
        ));
    }

    // عرض واجهة أخذ الحضور بالكاميرا
    public function take($scheduleId)
    {
        $schedule = \App\Models\Schedule::with(['course.courseInstructors.instructor', 'room'])->findOrFail($scheduleId);
        $studentCount = \App\Models\Enrollment::where('course_id', $schedule->course_id)->count();
        
        // حساب الحضور للمحاضرة المحددة فقط
        $presentCount = \App\Models\Attendance::where('schedule_id', $scheduleId)
            ->where('date', date('Y-m-d'))
            ->where('status', 'present')
            ->count();
            
        $absentCount = \App\Models\Attendance::where('schedule_id', $scheduleId)
            ->where('date', date('Y-m-d'))
            ->where('status', 'absent')
            ->count();
            
        // الطلاب الذين لم يتم أخذ الحضور لهم بعد (pending)
        $pendingCount = $studentCount - $presentCount - $absentCount;
        
        return view('admin.attendance.take', compact('schedule', 'studentCount', 'presentCount', 'absentCount', 'pendingCount'));
    }

    // عرض QR codes للطلاب
    public function studentQRCodes($scheduleId)
    {
        $schedule = \App\Models\Schedule::with(['course.courseInstructors.instructor', 'room'])->findOrFail($scheduleId);
        
        // جلب الطلاب المسجلين في هذا الكورس مع بيانات الحضور
        $enrollments = \App\Models\Enrollment::with(['student', 'attendance' => function($q) use ($scheduleId) {
            $q->where('schedule_id', $scheduleId);
        }])->where('course_id', $schedule->course_id)->get();
        
        // تحضير البيانات مع حالة الحضور لكل طالب
        $studentsData = [];
        foreach ($enrollments as $enrollment) {
            $attendance = $enrollment->attendance->first();
            $status = 'pending'; // الحالة الافتراضية
            
            if ($attendance) {
                $status = $attendance->status; // present, absent, أو pending
            }
            
            $studentsData[] = [
                'enrollment' => $enrollment,
                'student' => $enrollment->student,
                'status' => $status,
                'method' => $attendance ? $attendance->method : null,
                'time' => $attendance && $attendance->status === 'present' ? $attendance->created_at->format('H:i:s') : null,
            ];
        }
        
        // إحصائيات
        $totalStudents = count($studentsData);
        $presentCount = collect($studentsData)->where('status', 'present')->count();
        $absentCount = collect($studentsData)->where('status', 'absent')->count();
        $pendingCount = collect($studentsData)->where('status', 'pending')->count();
            
        return view('admin.attendance.student-qr-codes', compact('schedule', 'studentsData', 'totalStudents', 'presentCount', 'absentCount', 'pendingCount'));
    }

    // استقبال بيانات QR وتسجيل الحضور
    public function scan(Request $request)
    {
        $data = $request->validate([
            'qr' => 'required', // QR يحتوي على login_id
            'schedule_id' => 'required|exists:schedules,id',
        ]);
        $qrValue = $data['qr'];
        $scheduleId = $data['schedule_id'];
        $today = date('Y-m-d');

        // جلب الحصة
        $schedule = \App\Models\Schedule::findOrFail($scheduleId);
        
        // التحقق من أن المستخدم مدرس ومسموح له بأخذ الحضور لهذا الكورس
        $user = auth()->user();
        if ($user && $user->role === 'teacher') {
            $courseInstructor = \App\Models\CourseInstructor::where('instructor_id', $user->id)
                ->where('course_id', $schedule->course_id)
                ->first();
            
            if (!$courseInstructor) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not allowed to take attendance for this course!'
                ], 403);
            }
        }

        // Get student by login_id only
        $student = \App\Models\User::where('login_id', $qrValue)
            ->where('role', 'student')
            ->first();
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found (invalid QR)!'
            ]);
        }

        // Get enrollment for this student in this course
        $enrollment = \App\Models\Enrollment::where('student_id', $student->id)
            ->where('course_id', $schedule->course_id)
            ->first();

        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'Student is not enrolled in this course!'
            ]);
        }

        // تحقق من عدم تكرار الحضور لنفس الجلسة
        $existingAttendance = \App\Models\Attendance::where('enrollment_id', $enrollment->id)
            ->where('schedule_id', $scheduleId)
            ->first();
            
        if ($existingAttendance) {
            if ($existingAttendance->status === 'present') {
                return response()->json([
                    'success' => false,
                    'message' => 'Attendance for student (' . $student->name . ') has already been recorded today.',
                    'student_name' => $student->name,
                    'login_id' => $student->login_id,
                ]);
            } elseif ($existingAttendance->status === 'absent') {
                return response()->json([
                    'success' => false,
                    'message' => 'Student (' . $student->name . ') is marked as absent for today.',
                    'student_name' => $student->name,
                    'login_id' => $student->login_id,
                ]);
            }
        }

        // تحديث أو إنشاء سجل الحضور
        if ($existingAttendance) {
            // تحديث السجل الموجود من pending إلى present
            $existingAttendance->update([
                'status' => 'present',
                'method' => 'QR',
            ]);
        } else {
            // إنشاء سجل جديد
            \App\Models\Attendance::create([
                'enrollment_id' => $enrollment->id,
                'schedule_id' => $scheduleId,
                'date' => $today,
                'status' => 'present',
                'method' => 'QR',
            ]);
        }

        // جلب قائمة الطلاب الحاضرين لهذه الحصة اليوم
        $attendances = \App\Models\Attendance::where('schedule_id', $scheduleId)
            ->where('date', $today)
            ->where('status', 'present')
            ->with(['enrollment.student'])
            ->get();
        $presentStudents = $attendances->map(function($a) {
            return [
                'name' => $a->enrollment->student->name ?? '',
                'login_id' => $a->enrollment->student->login_id ?? '',
                'time' => $a->created_at ? $a->created_at->format('H:i') : '',
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Attendance recorded successfully!',
            'present_students' => $presentStudents
        ]);
    }

    // تسجيل الحضور يدوياً
    public function markPresent(Request $request)
    {
        $data = $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'schedule_id' => 'required|exists:schedules,id',
            'date' => 'required|date',
        ]);

        // البحث عن سجل الحضور الموجود
        $existingAttendance = \App\Models\Attendance::where('enrollment_id', $data['enrollment_id'])
            ->where('schedule_id', $data['schedule_id'])
            
            ->first();

        if ($existingAttendance) {
            if ($existingAttendance->status === 'present') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Attendance already recorded for this student in this session.'
                ]);
            } else {
                // تحديث السجل الموجود إلى present
                $existingAttendance->update([
                    'status' => 'present',
                    'method' => 'manual',
                ]);
            }
        } else {
            // إنشاء سجل جديد
            \App\Models\Attendance::create([
                'enrollment_id' => $data['enrollment_id'],
                'schedule_id' => $data['schedule_id'],
                'date' => $data['date'],
                'status' => 'present',
                'method' => 'manual',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Attendance marked as present successfully!'
        ]);
    }

    // تسجيل الغياب يدوياً
    public function markAbsent(Request $request)
    {
        $data = $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
            'schedule_id' => 'required|exists:schedules,id',
            'date' => 'required|date',
        ]);

        // البحث عن سجل الحضور الموجود أو إنشاء واحد جديد
        $attendance = \App\Models\Attendance::where('enrollment_id', $data['enrollment_id'])
            ->where('schedule_id', $data['schedule_id'])
            
            ->first();
            
        if ($attendance) {
            // تحديث الحالة إلى absent
            $attendance->update([
                'status' => 'absent',
                'method' => 'manual',
            ]);
        } else {
            // إنشاء سجل جديد بحالة absent
            \App\Models\Attendance::create([
                'enrollment_id' => $data['enrollment_id'],
                'schedule_id' => $data['schedule_id'],
                'date' => $data['date'],
                'status' => 'absent',
                'method' => 'manual',
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Student marked as absent successfully!'
        ]);
    }

    // تصدير البيانات إلى Excel
    public function export(Request $request)
    {
        $scheduleId = $request->get('schedule_id');
        $exportType = $request->get('type', 'csv');
        $exportRange = $request->get('range', 'current');
        $date = $request->get('date', date('Y-m-d'));
        
        if ($scheduleId) {
            $schedule = \App\Models\Schedule::findOrFail($scheduleId);
            $enrollments = \App\Models\Enrollment::with(['student', 'attendance' => function($q) use ($scheduleId, $date) {
                $q->where('schedule_id', $scheduleId)
                  ->where('date', $date);
            }])->where('course_id', $schedule->course_id)->get();
        } else {
            // نفس منطق الفلترة من دالة details
            $courseId = $request->get('course_id');
            $search = $request->get('search');
            $status = $request->get('status');

            $query = \App\Models\Enrollment::with(['student', 'course', 'attendance' => function($q) use ($date) {
                $q->where('date', $date);
            }]);

            if ($courseId) {
                $query->where('course_id', $courseId);
            }

            if ($search) {
                $query->whereHas('student', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('login_id', 'like', "%{$search}%");
                });
            }

            $enrollments = $query->get();

            if ($status && $status !== 'all') {
                $enrollments = $enrollments->filter(function($enrollment) use ($status, $date) {
                    if ($status === 'present') {
                        return $enrollment->attendance->where('date', $date)->where('status', 'present')->count() > 0;
                    } elseif ($status === 'absent') {
                        return $enrollment->attendance->where('date', $date)->where('status', 'present')->count() === 0;
                    }
                    return true;
                });
            }
        }

        // إنشاء ملف CSV
        $filename = 'attendance_report_' . $date . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($enrollments, $date, $scheduleId) {
            $file = fopen('php://output', 'w');
            
            // Header
            if ($scheduleId) {
                fputcsv($file, ['Student Name', 'Login ID', 'Date', 'Status', 'Time', 'Method']);
            } else {
                fputcsv($file, ['Student Name', 'Login ID', 'Course', 'Date', 'Status', 'Time', 'Method']);
            }
            
            // Data
            foreach ($enrollments as $enrollment) {
                $attendance = $enrollment->attendance->first();
                $isPresent = $attendance && $attendance->status === 'present';
                
                if ($scheduleId) {
                    fputcsv($file, [
                        $enrollment->student->name,
                        $enrollment->student->login_id,
                        $date,
                        $isPresent ? 'Present' : 'Absent',
                        $isPresent ? ($attendance->created_at ? $attendance->created_at->format('H:i:s') : '-') : '-',
                        $isPresent ? ($attendance->method ?? 'Manual') : '-'
                    ]);
                } else {
                    fputcsv($file, [
                        $enrollment->student->name,
                        $enrollment->student->login_id,
                        $enrollment->course->title,
                        $date,
                        $isPresent ? 'Present' : 'Absent',
                        $isPresent ? ($attendance->created_at ? $attendance->created_at->format('H:i:s') : '-') : '-',
                        $isPresent ? ($attendance->method ?? 'Manual') : '-'
                    ]);
                }
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function attendanceByEnrollment($enrollmentId)
    {
        $enrollment = \App\Models\Enrollment::with([
            'course',
            'student',
            'attendance' => function($q) { $q->orderBy('date', 'desc'); },
            'attendance.schedule'
        ])->findOrFail($enrollmentId);

        $result = [];
        foreach ($enrollment->attendance as $att) {
            $schedule = $att->schedule;
            $result[] = [
                'date' => $att->date,
                'day' => $schedule ? __($schedule->day_of_week) : date('l', strtotime($att->date)),
                'start_time' => $schedule ? $schedule->start_time : '-',
                'end_time' => $schedule ? $schedule->end_time : '-',
                'room' => $schedule && $schedule->room ? ($schedule->room->name ?? $schedule->room->room_number) : '-',
                'status' => $att->status,
                'method' => $att->method,
                'time' => $att->created_at ? $att->created_at->format('H:i:s') : '-',
            ];
        }

        return response()->json([
            'student' => $enrollment->student->name,
            'course' => $enrollment->course->title,
            'sessions' => $result,
        ]);
    }

    // عرض تفاصيل الحضور والغياب لمحاضرة محددة
    public function scheduleDetails($scheduleId)
    {
        $schedule = \App\Models\Schedule::with(['course.courseInstructors.instructor', 'room'])->findOrFail($scheduleId);
        
        // جلب جميع الطلاب المسجلين في هذا الكورس
        $enrollments = \App\Models\Enrollment::with(['student', 'attendance' => function($q) use ($scheduleId) {
            $q->where('schedule_id', $scheduleId);
        }])->where('course_id', $schedule->course_id)->get();
        
        // تحضير البيانات مع حالة الحضور لكل طالب
        $studentsData = [];
        foreach ($enrollments as $enrollment) {
            $attendance = $enrollment->attendance->first();
            $status = 'pending'; // الحالة الافتراضية
            
            if ($attendance) {
                $status = $attendance->status; // present, absent, أو pending
            }
            
            $studentsData[] = [
                'student' => $enrollment->student,
                'enrollment' => $enrollment,
                'status' => $status,
                'method' => $attendance ? $attendance->method : null,
                'time' => $attendance && $attendance->status === 'present' ? $attendance->created_at->format('H:i:s') : null,
                'attendance_id' => $attendance ? $attendance->id : null,
            ];
        }
        
        // إحصائيات
        $totalStudents = count($studentsData);
        $presentCount = collect($studentsData)->where('status', 'present')->count();
        $absentCount = collect($studentsData)->where('status', 'absent')->count();
        $pendingCount = collect($studentsData)->where('status', 'pending')->count();
        
        $view = 'admin.attendance.schedule-details';
        if (auth()->check() && auth()->user()->role === 'teacher') {
            $view = 'Teacher.attendance.schedule-details';
        }
        return view($view, compact(
            'schedule', 
            'studentsData', 
            'totalStudents', 
            'presentCount', 
            'absentCount',
            'pendingCount'
        ));
    }

    // الحصول على الإحصائيات الحالية
    public function getStats($scheduleId)
    {
        $schedule = \App\Models\Schedule::findOrFail($scheduleId);
        $studentCount = \App\Models\Enrollment::where('course_id', $schedule->course_id)->count();
        
        // حساب الحضور للمحاضرة المحددة فقط
        $presentCount = \App\Models\Attendance::where('schedule_id', $scheduleId)
            ->where('date', date('Y-m-d'))
            ->where('status', 'present')
            ->count();
            
        $absentCount = \App\Models\Attendance::where('schedule_id', $scheduleId)
            ->where('date', date('Y-m-d'))
            ->where('status', 'absent')
            ->count();
            
        // الطلاب الذين لم يتم أخذ الحضور لهم بعد (pending)
        $pendingCount = $studentCount - $presentCount - $absentCount;
        
        // حساب نسبة الحضور (تستثني الطلاب في الانتظار)
        $totalMarked = $presentCount + $absentCount;
        $percentage = $totalMarked > 0 ? round(($presentCount / $totalMarked) * 100, 1) : 0;
        
        return response()->json([
            'total_students' => $studentCount,
            'present_count' => $presentCount,
            'absent_count' => $absentCount,
            'pending_count' => $pendingCount,
            'percentage' => $percentage
        ]);
    }

    // الحصول على قائمة الطلاب الحاضرين
    public function getPresentStudents($scheduleId)
    {
        $schedule = \App\Models\Schedule::findOrFail($scheduleId);
        
        $attendances = \App\Models\Attendance::where('schedule_id', $scheduleId)
            ->where('date', date('Y-m-d'))
            ->where('status', 'present')
            ->with(['enrollment.student'])
            ->get();
        
        $students = $attendances->map(function($a) {
            return [
                'id' => $a->enrollment->student->id,
                'name' => $a->enrollment->student->name ?? '',
                'login_id' => $a->enrollment->student->login_id ?? '',
                'time' => $a->created_at ? $a->created_at->format('H:i') : '',
                'attendance_id' => $a->id
            ];
        });
        
        return response()->json([
            'students' => $students
        ]);
    }

    // حذف حضور طالب
    public function removeAttendance(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
        ]);
        
        $enrollment = \App\Models\Enrollment::where('student_id', $data['student_id'])
            ->where('course_id', \App\Models\Schedule::find($data['schedule_id'])->course_id)
            ->first();
            
        if (!$enrollment) {
            return response()->json([
                'status' => 'error',
                'message' => 'Student is not enrolled in this course.'
            ]);
        }
        
        $deleted = \App\Models\Attendance::where('enrollment_id', $enrollment->id)
            ->where('schedule_id', $data['schedule_id'])
            ->where('date', date('Y-m-d'))
            ->where('status', 'present')
            ->delete();
            
        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Attendance deleted successfully.'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Attendance record not found.'
            ]);
        }
    }
} 