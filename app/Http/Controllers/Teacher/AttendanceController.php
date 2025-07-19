<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display attendance details for the authenticated teacher
     */
    public function details()
    {
        $teacher = Auth::user();
        
        // Get all courses taught by this teacher
        $teacherCourses = Course::whereHas('courseInstructors', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })->with(['enrollments', 'schedules.attendances'])->get();
        
        return view('Teacher.attendance.details', compact('teacherCourses'));
    }
    
    /**
     * Display attendance details for a specific schedule
     */
    public function scheduleDetails(Schedule $schedule)
    {
        $teacher = Auth::user();
        
        // Check if teacher is authorized for this schedule
        if (!$schedule->course->courseInstructors->where('instructor_id', $teacher->id)->count()) {
            abort(403, 'Unauthorized');
        }
        
        $attendances = Attendance::where('schedule_id', $schedule->id)
            ->with(['student', 'schedule'])
            ->get();
            
        $enrollments = Enrollment::where('course_id', $schedule->course_id)
            ->with('student')
            ->get();
            
        return view('Teacher.attendance.schedule-details', compact('schedule', 'attendances', 'enrollments'));
    }
    
    /**
     * Display QR codes for students in a schedule
     */
    public function studentQRCodes(Schedule $schedule)
    {
        $teacher = Auth::user();
        
        // Check if teacher is authorized for this schedule
        if (!$schedule->course->courseInstructors->where('instructor_id', $teacher->id)->count()) {
            abort(403, 'Unauthorized');
        }
        
        $enrollments = Enrollment::where('course_id', $schedule->course_id)
            ->with('student')
            ->get();
            
        return view('Teacher.attendance.qr-codes', compact('schedule', 'enrollments'));
    }
    
    /**
     * Handle QR code scan for attendance
     */
    public function scan(Request $request)
    {
        $request->validate([
            'qr' => 'required|string',
            'schedule_id' => 'required|exists:schedules,id'
        ]);
        
        $teacher = Auth::user();
        $schedule = Schedule::findOrFail($request->schedule_id);
        
        // Check if teacher is authorized for this schedule
        if (!$schedule->course->courseInstructors->where('instructor_id', $teacher->id)->count()) {
            return response()->json([
                'success' => false,
                'message' => 'غير مصرح لك بأخذ الحضور لهذه المحاضرة'
            ], 403);
        }
        
        // Find student by QR code (assuming QR contains student ID or login_id)
        $student = User::where('role', 'student')
            ->where(function($query) use ($request) {
                $query->where('id', $request->qr)
                      ->orWhere('login_id', $request->qr)
                      ->orWhere('user_name', $request->qr);
            })
            ->first();
            
        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على الطالب'
            ]);
        }
        
        // Check if student is enrolled in this course
        $enrollment = Enrollment::where('student_id', $student->id)
            ->where('course_id', $schedule->course_id)
            ->first();
            
        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'الطالب غير مسجل في هذه المادة'
            ]);
        }
        
        // Check if attendance already exists
        $existingAttendance = Attendance::where('student_id', $student->id)
            ->where('schedule_id', $schedule->id)
            ->first();
            
        if ($existingAttendance) {
            return response()->json([
                'success' => false,
                'message' => 'تم تسجيل الحضور مسبقاً لهذا الطالب'
            ]);
        }
        
        // Create attendance record
        Attendance::create([
            'student_id' => $student->id,
            'schedule_id' => $schedule->id,
            'status' => 'present',
            'marked_by' => $teacher->id,
            'marked_at' => now()
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الحضور بنجاح',
            'student_name' => $student->name
        ]);
    }
    
    /**
     * Mark student as present manually
     */
    public function markPresent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id'
        ]);
        
        $teacher = Auth::user();
        $schedule = Schedule::findOrFail($request->schedule_id);
        
        // Check if teacher is authorized for this schedule
        if (!$schedule->course->courseInstructors->where('instructor_id', $teacher->id)->count()) {
            return response()->json([
                'success' => false,
                'message' => 'غير مصرح لك بأخذ الحضور لهذه المحاضرة'
            ], 403);
        }
        
        // Check if attendance already exists
        $existingAttendance = Attendance::where('student_id', $request->student_id)
            ->where('schedule_id', $request->schedule_id)
            ->first();
            
        if ($existingAttendance) {
            $existingAttendance->update([
                'status' => 'present',
                'marked_by' => $teacher->id,
                'marked_at' => now()
            ]);
        } else {
            Attendance::create([
                'student_id' => $request->student_id,
                'schedule_id' => $request->schedule_id,
                'status' => 'present',
                'marked_by' => $teacher->id,
                'marked_at' => now()
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الحضور بنجاح'
        ]);
    }
    
    /**
     * Mark student as absent manually
     */
    public function markAbsent(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id'
        ]);
        
        $teacher = Auth::user();
        $schedule = Schedule::findOrFail($request->schedule_id);
        
        // Check if teacher is authorized for this schedule
        if (!$schedule->course->courseInstructors->where('instructor_id', $teacher->id)->count()) {
            return response()->json([
                'success' => false,
                'message' => 'غير مصرح لك بأخذ الحضور لهذه المحاضرة'
            ], 403);
        }
        
        // Check if attendance already exists
        $existingAttendance = Attendance::where('student_id', $request->student_id)
            ->where('schedule_id', $request->schedule_id)
            ->first();
            
        if ($existingAttendance) {
            $existingAttendance->update([
                'status' => 'absent',
                'marked_by' => $teacher->id,
                'marked_at' => now()
            ]);
        } else {
            Attendance::create([
                'student_id' => $request->student_id,
                'schedule_id' => $request->schedule_id,
                'status' => 'absent',
                'marked_by' => $teacher->id,
                'marked_at' => now()
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'تم تسجيل الغياب بنجاح'
        ]);
    }
    
    /**
     * Export attendance data
     */
    public function export()
    {
        $teacher = Auth::user();
        
        // Get all courses taught by this teacher
        $teacherCourses = Course::whereHas('courseInstructors', function($query) use ($teacher) {
            $query->where('instructor_id', $teacher->id);
        })->with(['enrollments', 'schedules.attendances'])->get();
        
        // Generate CSV or Excel file
        $filename = 'attendance_report_' . $teacher->id . '_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($teacherCourses) {
            $file = fopen('php://output', 'w');
            
            // CSV Headers
            fputcsv($file, ['المادة', 'التاريخ', 'الطالب', 'الحالة', 'الوقت']);
            
            foreach ($teacherCourses as $course) {
                foreach ($course->schedules as $schedule) {
                    foreach ($schedule->attendances as $attendance) {
                        fputcsv($file, [
                            $course->title,
                            $schedule->session_date,
                            $attendance->student->name,
                            $attendance->status,
                            $attendance->marked_at
                        ]);
                    }
                }
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Show attendance by enrollment
     */
    public function attendanceByEnrollment(Enrollment $enrollment)
    {
        $teacher = Auth::user();
        
        // Check if teacher is authorized for this course
        if (!$enrollment->course->courseInstructors->where('instructor_id', $teacher->id)->count()) {
            abort(403, 'Unauthorized');
        }
        
        $attendances = Attendance::where('student_id', $enrollment->student_id)
            ->whereHas('schedule', function($query) use ($enrollment) {
                $query->where('course_id', $enrollment->course_id);
            })
            ->with(['schedule', 'student'])
            ->get();
            
        return view('Teacher.attendance.by-enrollment', compact('enrollment', 'attendances'));
    }
    
    /**
     * Take attendance for a specific schedule
     */
    public function take(Schedule $schedule)
    {
        $teacher = Auth::user();
        
        // Check if teacher is authorized for this schedule
        if (!$schedule->course->courseInstructors->where('instructor_id', $teacher->id)->count()) {
            abort(403, 'Unauthorized');
        }
        
        $enrollments = Enrollment::where('course_id', $schedule->course_id)
            ->with('student')
            ->get();
            
        $attendances = Attendance::where('schedule_id', $schedule->id)
            ->with('student')
            ->get();
            
        return view('Teacher.attendance.take', compact('schedule', 'enrollments', 'attendances'));
    }
} 