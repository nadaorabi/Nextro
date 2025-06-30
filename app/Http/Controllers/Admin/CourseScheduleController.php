<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CourseScheduleController extends Controller
{
    // عرض جميع الكورسات والمسارات مع الفلترة
    public function index(Request $request)
    {
        $query = Course::with(['schedules', 'category']);
        $packageQuery = \App\Models\Package::with(['courses.schedules', 'category']);
        
        // فلترة حسب البحث
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('category', function($catQuery) use ($search) {
                      $catQuery->where('name', 'like', "%{$search}%");
                  });
            });
            
            $packageQuery->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhereHas('category', function($catQuery) use ($search) {
                      $catQuery->where('name', 'like', "%{$search}%");
                  });
            });
        }
        
        // فلترة حسب النوع
        if ($request->filled('type')) {
            if ($request->type === 'package') {
                $query = Course::whereRaw('1 = 0'); // لا تظهر الكورسات
            } elseif ($request->type === 'course') {
                $packageQuery = \App\Models\Package::whereRaw('1 = 0'); // لا تظهر البكجات
            }
        }
        
        // فلترة حسب الحالة
        if ($request->filled('status')) {
            $query->where('status', $request->status);
            $packageQuery->where('status', $request->status);
        }
        
        $courses = $query->get();
        $packages = $packageQuery->get();
        
        // إضافة تسجيل للتشخيص
        \Log::info('Schedules index request:', [
            'search' => $request->search,
            'type' => $request->type,
            'status' => $request->status,
            'courses_count' => $courses->count(),
            'packages_count' => $packages->count()
        ]);
        
        return view('admin.schedules.index', compact('courses', 'packages'));
    }

    // عرض الجدولة لكورس أو مسار
    public function show(Course $course)
    {
        $course->load('schedules');
        $rooms = \App\Models\Room::all();
        return view('admin.schedules.show', compact('course', 'rooms'));
    }

    // عرض تفاصيل البكج والمواد الموجودة فيه
    public function showPackage(\App\Models\Package $package)
    {
        $package->load(['courses.schedules', 'courses.category']);
        $rooms = \App\Models\Room::all();
        return view('admin.schedules.show-package', compact('package', 'rooms'));
    }

    // إضافة أو تعديل الجدولة مع التحقق من التعارض
    public function store(Request $request)
    {
        // Add debugging to see what's being received
        \Log::info('Schedule store request data:', $request->all());
        
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'session_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'room_id' => 'required|exists:rooms,id',
        ], [
            'course_id.required' => 'يجب اختيار الكورس.',
            'course_id.exists' => 'الكورس غير موجود.',
            'session_date.required' => 'يجب اختيار تاريخ الجلسة.',
            'session_date.date' => 'صيغة التاريخ غير صحيحة.',
            'start_time.required' => 'يجب إدخال وقت البداية.',
            'start_time.date_format' => 'صيغة وقت البداية غير صحيحة.',
            'end_time.required' => 'يجب إدخال وقت النهاية.',
            'end_time.date_format' => 'صيغة وقت النهاية غير صحيحة.',
            'end_time.after' => 'وقت النهاية يجب أن يكون بعد وقت البداية.',
            'room_id.required' => 'يجب اختيار القاعة.',
            'room_id.exists' => 'القاعة غير موجودة.',
        ]);

        if ($validator->fails()) {
            \Log::error('Schedule validation failed:', $validator->errors()->toArray());
            \Log::info('Received data:', $request->all());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // تحقق من أن التاريخ والوقت ليس في الماضي
        $now = now();
        $sessionDateTime = \Carbon\Carbon::parse($request->session_date . ' ' . $request->start_time);
        if ($sessionDateTime < $now) {
            return redirect()->back()->with('error', 'لا يمكن إضافة جلسة بتاريخ أو وقت قديم.')->withInput();
        }

        // حساب يوم الأسبوع تلقائياً من التاريخ
        $date = new \DateTime($request->session_date);
        $days = ['sunday','monday','tuesday','wednesday','thursday','friday','saturday'];
        $day_of_week = $days[$date->format('w')];

        // مقارنة ذكية: البحث عن أي جلسة متعارضة في نفس القاعة والتاريخ وتداخل الوقت
        $conflict = Schedule::where('room_id', $request->room_id)
            ->where('session_date', $request->session_date)
            ->where(function($q) use ($request) {
                $q->where(function($q2) use ($request) {
                    $q2->where('start_time', '<', $request->end_time)
                        ->where('end_time', '>', $request->start_time);
                });
            })
            ->first();

        if ($conflict) {
            $roomName = $conflict->room ? $conflict->room->name : 'Unknown';
            $msg = 'يوجد تعارض في القاعة <b>' . $roomName . '</b> بتاريخ <b>' . $conflict->session_date . '</b> من <b>' . $conflict->start_time . '</b> إلى <b>' . $conflict->end_time . '</b>.';
            return redirect()->back()->with('error', $msg)->withInput();
        }

        // مقارنة ذكية: منع تداخل نفس الكورس في أي قاعة بنفس التاريخ وتداخل الوقت
        $courseConflict = Schedule::where('course_id', $request->course_id)
            ->where('session_date', $request->session_date)
            ->where(function($q) use ($request) {
                $q->where(function($q2) use ($request) {
                    $q2->where('start_time', '<', $request->end_time)
                        ->where('end_time', '>', $request->start_time);
                });
            })
            ->first();

        if ($courseConflict) {
            $roomName = $courseConflict->room ? $courseConflict->room->name : 'Unknown';
            $msg = 'لا يمكن جدولة نفس الكورس في أكثر من قاعة بنفس الوقت!<br>الكورس محجوز بالفعل في القاعة <b>' . $roomName . '</b> بتاريخ <b>' . $courseConflict->session_date . '</b> من <b>' . $courseConflict->start_time . '</b> إلى <b>' . $courseConflict->end_time . '</b>.';
            return redirect()->back()->with('error', $msg)->withInput();
        }

        try {
            $scheduleData = [
                'course_id' => $request->course_id,
                'day_of_week' => $day_of_week,
                'session_date' => $request->session_date,
                'start_time' => $request->start_time . ':00',
                'end_time' => $request->end_time . ':00',
                'room_id' => $request->room_id,
            ];
            
            \Log::info('Creating schedule with data:', $scheduleData);
            
            $schedule = Schedule::create($scheduleData);
            
            // Create default pending attendance records for all enrolled students
            $enrollments = \App\Models\Enrollment::where('course_id', $request->course_id)->get();
            $attendanceRecords = [];
            foreach ($enrollments as $enrollment) {
                $attendanceRecords[] = [
                    'enrollment_id' => $enrollment->id,
                    'schedule_id' => $schedule->id,
                    'date' => $request->session_date,
                    'status' => 'pending',
                    'method' => 'auto',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            
            if (!empty($attendanceRecords)) {
                \App\Models\Attendance::insert($attendanceRecords);
            }
            
            return redirect()->back()->with('success', 'Schedule added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error creating schedule:', [
                'message' => $e->getMessage(),
                'data' => $request->all()
            ]);
            
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء إضافة الجدولة: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Schedule $schedule)
    {
        try {
            $schedule->delete();
            return redirect()->back()
                ->with('success', 'Schedule removed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error removing schedule: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validator = Validator::make($request->all(), [
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ], [
            'start_time.required' => 'يجب إدخال وقت البداية.',
            'start_time.date_format' => 'صيغة وقت البداية غير صحيحة.',
            'end_time.required' => 'يجب إدخال وقت النهاية.',
            'end_time.date_format' => 'صيغة وقت النهاية غير صحيحة.',
            'end_time.after' => 'وقت النهاية يجب أن يكون بعد وقت البداية.',
        ]);

        if ($validator->fails()) {
            \Log::error('Schedule update validation failed:', $validator->errors()->toArray());
            \Log::info('Received data:', $request->all());
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // لا يسمح بتساوي وقت البداية والنهاية
        if ($request->start_time == $request->end_time) {
            return redirect()->back()->with('error', 'وقت البداية ووقت النهاية لا يمكن أن يكونا متساويين.')->withInput();
        }

        // لا يسمح بوقت قديم
        $now = now();
        $sessionDateTime = Carbon::parse($schedule->session_date . ' ' . $request->start_time);
        if ($sessionDateTime < $now) {
            return redirect()->back()->with('error', 'لا يمكن تعديل الجدولة إلى وقت قديم.')->withInput();
        }

        // تحقق من عدم وجود تعارض مع نفس القاعة والتاريخ
        $conflict = Schedule::where('room_id', $schedule->room_id)
            ->where('session_date', $schedule->session_date)
            ->where('id', '!=', $schedule->id)
            ->where(function($q) use ($request) {
                $q->where(function($q2) use ($request) {
                    $q2->where('start_time', '<', $request->end_time)
                        ->where('end_time', '>', $request->start_time);
                });
            })
            ->first();
        if ($conflict) {
            return redirect()->back()->with('error', 'يوجد تعارض مع جدولة أخرى في نفس القاعة والتاريخ.')->withInput();
        }

        // تحقق من عدم وجود تعارض مع نفس الكورس في قاعة أخرى بنفس الوقت
        $courseConflict = Schedule::where('course_id', $schedule->course_id)
            ->where('session_date', $schedule->session_date)
            ->where('id', '!=', $schedule->id)
            ->where(function($q) use ($request) {
                $q->where(function($q2) use ($request) {
                    $q2->where('start_time', '<', $request->end_time)
                        ->where('end_time', '>', $request->start_time);
                });
            })
            ->first();
        if ($courseConflict) {
            return redirect()->back()->with('error', 'لا يمكن جدولة نفس الكورس في أكثر من قاعة بنفس الوقت!')->withInput();
        }

        // إضافة ثواني للوقت قبل الحفظ (00:00)
        $start_time_with_seconds = $request->start_time . ':00';
        $end_time_with_seconds = $request->end_time . ':00';

        $schedule->start_time = $start_time_with_seconds;
        $schedule->end_time = $end_time_with_seconds;
        $schedule->save();

        return redirect()->back()->with('success', 'تم تعديل أوقات الجدولة بنجاح!');
    }

    public function schedulesBoard(Request $request)
    {
        \Log::info('schedulesBoard method called', ['request' => $request->all()]);
        
        $query = \App\Models\Schedule::with([
            'course.category',
            'room',
            'course.courseInstructors.instructor',
        ]);

        // فلترة حسب المادة
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }
        // فلترة حسب القاعة
        if ($request->filled('room_id')) {
            $query->where('room_id', $request->room_id);
        }
        // فلترة حسب الأستاذ
        if ($request->filled('instructor_id')) {
            $query->whereHas('course.courseInstructors', function($q) use ($request) {
                $q->where('instructor_id', $request->instructor_id);
            });
        }
        // فلترة حسب المسار
        if ($request->filled('category_id')) {
            $query->whereHas('course.category', function($q) use ($request) {
                $q->where('id', $request->category_id);
            });
        }
        // فلترة حسب اليوم أو التاريخ
        if ($request->filled('session_date')) {
            $query->where('session_date', $request->session_date);
        } elseif ($request->filled('week_start')) {
            $query->whereBetween('session_date', [$request->week_start, $request->week_end]);
        }

        $schedules = $query->orderBy('session_date')->orderBy('start_time')->get();
        $courses = \App\Models\Course::with('category')->get();
        $rooms = \App\Models\Room::all();
        $categories = \App\Models\Category::all();
        $instructors = \App\Models\User::where('role', 'teacher')->get();

        return view('admin.schedules.board', compact('schedules', 'courses', 'rooms', 'categories', 'instructors'));
    }
} 