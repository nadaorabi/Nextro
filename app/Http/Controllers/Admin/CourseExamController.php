<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseExamController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_id' => 'required|exists:courses,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'date' => 'required|date|after:today',
                'duration' => 'required|integer|min:1|max:480',
                'total_marks' => 'required|integer|min:1|max:1000',
                'passing_marks' => 'required|integer|min:1|max:1000',
                'status' => 'required|in:scheduled,active,completed,cancelled',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Validate that passing marks is not greater than total marks
            if ($request->passing_marks > $request->total_marks) {
                return redirect()->back()
                    ->with('error', 'Passing marks cannot be greater than total marks.')
                    ->withInput();
            }

            Exam::create([
                'course_id' => $request->course_id,
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'duration' => $request->duration,
                'total_marks' => $request->total_marks,
                'passing_marks' => $request->passing_marks,
                'status' => $request->status,
            ]);

            return redirect()->back()
                ->with('success', 'Exam added to course successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error adding exam: ' . $e->getMessage());
        }
    }

    public function destroy(Exam $exam)
    {
        try {
            $exam->delete();
            return redirect()->back()
                ->with('success', 'Exam removed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error removing exam: ' . $e->getMessage());
        }
    }
} 