<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'teacher');

        $totalTeachers = User::where('role', 'teacher')->count();
        $activeTeachers = User::where('role', 'teacher')->where('is_active', '1')->count();
        $experiencedTeachers = User::where('role', 'teacher')->where('is_experienced', true)->count();
        $notExperiencedTeachers = User::where('role', 'teacher')->where('is_experienced', false)->count();
        $blockedTeachers = User::where('role', 'teacher')->where('is_active', '0')->count();

        $teachersThisMonth = User::where('role', 'teacher')
            ->whereMonth('created_at', now()->month)
            ->count();

        // Get all teachers without pagination for frontend filtering
        $teachers = $query->latest()->get();

        return view('admin.accounts.teacher.index', compact(
            'teachers',
            'totalTeachers',
            'activeTeachers',
            'experiencedTeachers',
            'notExperiencedTeachers',
            'blockedTeachers',
            'teachersThisMonth'
        ));
    }

    public function create()
    {
        return view('admin.accounts.teacher.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'         => 'required|string|max:150',
                'user_name'    => 'required|string|max:50|unique:users,user_name',
                'mobile'       => 'required|string|unique:users,mobile|max:15',
                'email'        => 'nullable|email|unique:users,email|max:150',
                'address'      => 'nullable|string|max:500',
                'notes'        => 'nullable|string|max:500',
                'is_active'    => 'required|boolean',
            ]);

            $year = now()->format('Y');
            do {
                $randomDigits = rand(1000, 9999);
                $loginId = 'TCH' . $year . $randomDigits;
            } while (User::where('login_id', $loginId)->exists());

            $plainPassword = Str::random(8);

            $user = new User();

            $user->name = $validated['name'];
            $user->user_name = $validated['user_name'];
            $user->mobile = $validated['mobile'];
            $user->email = $validated['email'] ?? null;
            $user->address = $validated['address'] ?? null;
            $user->notes = $validated['notes'] ?? null;
            $user->is_active = $validated['is_active'];
            $user->role = 'teacher';
            $user->login_id = $loginId;
            $user->plain_password = $plainPassword;
            $user->password = Hash::make($plainPassword);

            if ($request->hasFile('profile_image')) {
                $user->profile_image = $request->file('profile_image')->store('profile-images', 'public');
            } else {
                $gender = strtolower($request->input('gender', 'male'));
                $user->profile_image = $gender === 'female' ? 'defaults/default-teacher-female.jpg' : 'defaults/default-teacher-male.jpg';
            }

            $user->save();

            return redirect()->route('admin.accounts.teachers.list')->with('success', 'Teacher created successfully with password: ' . $plainPassword);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create teacher: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $teacher = User::where('role', 'teacher')->findOrFail($id);
        $latestPayments = $teacher->payments()->latest('payment_date')->limit(5)->get();
        $coursesTaught = $teacher->coursesTaught()->with(['course.schedules.room'])->get();
        $allSchedules = collect();
        foreach ($coursesTaught as $courseInstructor) {
            $course = $courseInstructor->course;
            if ($course && $course->schedules) {
                foreach ($course->schedules as $schedule) {
                    $allSchedules->push([
                        'course' => $course->title,
                        'session_date' => $schedule->session_date,
                        'day_of_week' => $schedule->day_of_week,
                        'start_time' => $schedule->start_time,
                        'end_time' => $schedule->end_time,
                        'room' => $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name ?? '') : '',
                    ]);
                }
            }
        }
        $allSchedules = $allSchedules->sortBy([['session_date', 'asc'], ['start_time', 'asc']])->values();
        return view('admin.accounts.teacher.show', compact('teacher', 'latestPayments', 'allSchedules', 'coursesTaught'));
    }

    public function edit($id)
    {
        $teacher = User::where('role', 'teacher')->findOrFail($id);
        return view('admin.accounts.teacher.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        try {
            $teacher = User::where('role', 'teacher')->findOrFail($id);
            
            $validated = $request->validate([
                'name'         => 'required|string|max:150',
                'user_name'    => 'required|string|max:50|unique:users,user_name,' . $id,
                'mobile'       => 'required|string|max:15|unique:users,mobile,' . $id,
                'email'        => 'nullable|email|max:150|unique:users,email,' . $id,
                'address'      => 'nullable|string|max:500',
                'notes'        => 'nullable|string|max:500',
                'is_active'    => 'required|boolean',
            ]);

            $teacher->update($validated);
            
            return redirect()->route('admin.accounts.teachers.show', $id)->with('success', 'Teacher updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update teacher: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $teacher = User::where('role', 'teacher')->findOrFail($id);
            
            // Delete teacher's related data if needed
            // You can add more deletion logic here for related models
            
            $teacher->delete();
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Teacher deleted successfully'
                ]);
            }
            
            return redirect()->route('admin.accounts.teachers.list')->with('success', 'Teacher deleted successfully');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete teacher. Please try again.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to delete teacher: ' . $e->getMessage());
        }
    }

    public function toggleExperience($id)
    {
        try {
            $teacher = User::where('role', 'teacher')->findOrFail($id);
            $newStatus = $teacher->toggleExperienceStatus();
            
            $statusText = $newStatus ? 'Experienced' : 'Not Experienced';
            
            return response()->json([
                'success' => true,
                'message' => "Teacher experience status changed to: {$statusText}",
                'is_experienced' => $newStatus,
                'status_text' => $statusText
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change experience status: ' . $e->getMessage()
            ], 500);
        }
    }
} 