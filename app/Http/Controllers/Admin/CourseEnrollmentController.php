<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\User;
use App\Models\CourseInstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseEnrollmentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_id' => 'required|exists:courses,id',
                'student_ids' => 'required|array|min:1',
                'student_ids.*' => 'exists:users,id',
                'enrollment_date' => 'required|date',
                'status' => 'required|in:active,pending,completed,dropped',
                'notes' => 'nullable|string|max:500',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $added = 0;
            $skipped = 0;
            foreach ($request->student_ids as $student_id) {
                // Check if student is already enrolled in this course
                $existingEnrollment = \App\Models\Enrollment::where('course_id', $request->course_id)
                    ->where('student_id', $student_id)
                    ->first();
                if ($existingEnrollment) {
                    $skipped++;
                    continue;
                }
                $enrollment = \App\Models\Enrollment::create([
                    'course_id' => $request->course_id,
                    'student_id' => $student_id,
                    'enrollment_date' => $request->enrollment_date,
                    'status' => $request->status,
                    'notes' => $request->notes,
                ]);

                // حساب الخصم وتسجيل معاملة مالية
                $discount = 0;
                if ($request->has('discounts') && isset($request->discounts[$student_id])) {
                    $discount = floatval($request->discounts[$student_id]);
                }
                $course = \App\Models\Course::find($request->course_id);
                $coursePrice = $course->is_free ? 0 : floatval($course->price);
                $finalPrice = $coursePrice;
                if ($discount > 0 && $discount <= 100) {
                    $finalPrice = $coursePrice - ($coursePrice * $discount / 100);
                }
                if ($finalPrice > 0) {
                    \App\Models\Payment::create([
                        'user_id' => $student_id,
                        'amount' => $finalPrice,
                        'type' => 'student_fee',
                        'notes' => 'Course: ' . $course->title . ' | Discount: ' . $discount . '%',
                        'payment_date' => now(),
                    ]);

                    // إضافة نسبة الأستاذ
                    $courseInstructor = CourseInstructor::where('course_id', $course->id)
                        ->where('role', 'primary')
                        ->first();
                    if ($courseInstructor && $courseInstructor->percentage > 0) {
                        $instructorShare = $finalPrice * ($courseInstructor->percentage / 100);
                        \App\Models\Payment::create([
                            'user_id' => $courseInstructor->instructor_id,
                            'amount' => $instructorShare,
                            'type' => 'instructor_share',
                            'notes' => 'نسبة من تسجيل طالب جديد في الدورة: ' . $course->title,
                            'payment_date' => now(),
                        ]);
                    }
                }
                $added++;
            }

            $msg = '';
            if ($added > 0) $msg .= "$added student(s) enrolled successfully. ";
            if ($skipped > 0) $msg .= "$skipped student(s) were already enrolled.";

            return redirect()->back()->with('success', trim($msg));

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error enrolling students: ' . $e->getMessage());
        }
    }

    public function destroy(Enrollment $enrollment)
    {
        try {
            $enrollment->delete();
            return redirect()->back()
                ->with('success', 'Student enrollment removed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error removing enrollment: ' . $e->getMessage());
        }
    }
} 