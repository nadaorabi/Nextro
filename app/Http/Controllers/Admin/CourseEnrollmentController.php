<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseEnrollmentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_id' => 'required|exists:courses,id',
                'student_id' => 'required|exists:users,id',
                'enrollment_date' => 'required|date',
                'status' => 'required|in:active,pending,completed,dropped',
                'notes' => 'nullable|string|max:500',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Check if student is already enrolled in this course
            $existingEnrollment = Enrollment::where('course_id', $request->course_id)
                ->where('student_id', $request->student_id)
                ->first();

            if ($existingEnrollment) {
                return redirect()->back()
                    ->with('error', 'This student is already enrolled in this course.');
            }

            Enrollment::create([
                'course_id' => $request->course_id,
                'student_id' => $request->student_id,
                'enrollment_date' => $request->enrollment_date,
                'status' => $request->status,
                'notes' => $request->notes,
            ]);

            return redirect()->back()
                ->with('success', 'Student enrolled in course successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error enrolling student: ' . $e->getMessage());
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