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
        $courses = Course::with('schedules')->get();
        // يمكنك إضافة فلترة حسب الطلب لاحقاً
        return view('admin.schedules.index', compact('courses'));
    }

    // عرض الجدولة لكورس أو مسار
    public function show(Course $course)
    {
        $course->load('schedules');
        $rooms = \App\Models\Room::all();
        return view('admin.schedules.show', compact('course', 'rooms'));
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
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'room_id' => $request->room_id,
            ];
            
            \Log::info('Creating schedule with data:', $scheduleData);
            
            Schedule::create($scheduleData);
            
            return redirect()->back()->with('success', 'تمت إضافة الجدولة بنجاح!');
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

        $schedule->start_time = $request->start_time;
        $schedule->end_time = $request->end_time;
        $schedule->save();

        return redirect()->back()->with('success', 'تم تعديل أوقات الجدولة بنجاح!');
    }
} 