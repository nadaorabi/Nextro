<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseInstructor;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseInstructorController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_id' => 'required|exists:courses,id',
                'instructor_id' => 'required|exists:users,id',
                'role' => 'required|in:primary,assistant,guest',
                'notes' => 'nullable|string|max:500',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Check if instructor is already assigned to this course
            $existingAssignment = CourseInstructor::where('course_id', $request->course_id)
                ->where('instructor_id', $request->instructor_id)
                ->first();

            if ($existingAssignment) {
                return redirect()->back()
                    ->with('error', 'This instructor is already assigned to this course.');
            }

            CourseInstructor::create([
                'course_id' => $request->course_id,
                'instructor_id' => $request->instructor_id,
                'role' => $request->role,
                'notes' => $request->notes,
            ]);

            return redirect()->back()
                ->with('success', 'Instructor assigned to course successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error assigning instructor: ' . $e->getMessage());
        }
    }

    public function destroy(CourseInstructor $courseInstructor)
    {
        try {
            $courseInstructor->delete();
            return redirect()->back()
                ->with('success', 'Instructor removed from course successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error removing instructor: ' . $e->getMessage());
        }
    }
} 