<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseScheduleController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_id' => 'required|exists:courses,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
                'time' => 'required|date_format:H:i',
                'duration' => 'required|integer|min:1|max:480',
                'location' => 'nullable|string|max:255',
                'status' => 'required|in:active,cancelled,completed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            Schedule::create([
                'course_id' => $request->course_id,
                'title' => $request->title,
                'description' => $request->description,
                'day' => $request->day,
                'time' => $request->time,
                'duration' => $request->duration,
                'location' => $request->location,
                'status' => $request->status,
            ]);

            return redirect()->back()
                ->with('success', 'Schedule added to course successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error adding schedule: ' . $e->getMessage());
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
} 