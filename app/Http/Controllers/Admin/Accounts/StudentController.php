<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'student');

        $totalStudents = User::where('role', 'student')->count();
        $activeStudents = User::where('role', 'student')->where('is_active', '1')->count();
        $graduatedStudents = User::where('role', 'student')->where('is_active', '2')->count();
        $blockedStudents = User::where('role', 'student')->where('is_active', '0')->count();

        $studentsThisMonth = User::where('role', 'student')
            ->whereMonth('created_at', now()->month)
            ->count();

        $students = $query->latest()->paginate(10)->appends($request->all());

        return view('admin.accounts.student.index', compact(
            'students',
            'totalStudents',
            'activeStudents',
            'graduatedStudents',
            'blockedStudents',
            'studentsThisMonth'
        ));
    }


    public function create()
    {
        return view('admin.accounts.student.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'         => 'required|string|max:150',
                'father_name'  => 'nullable|string|max:150',
                'mother_name'  => 'nullable|string|max:150',
                'mobile'       => 'required|string|unique:users,mobile|max:15',
                'alt_mobile'   => 'nullable|string|max:15',
                'email'        => 'nullable|email|unique:users,email|max:150',
                'national_id'  => 'nullable|string|max:20',
                'address'      => 'nullable|string|max:500',
                'birth_date'   => 'nullable|date|before:today',
                'notes'        => 'nullable|string|max:1000',
                'is_active'    => 'required|boolean',
            ]);

            $year = now()->format('Y');
            do {
                $randomDigits = rand(1000, 9999);
                $loginId = $year . $randomDigits;
            } while (User::where('login_id', $loginId)->exists());

            $plainPassword = Str::random(8);

            $user = new User();

            $user->name = $validated['name'];
            $user->father_name = $validated['father_name'] ?? null;
            $user->mother_name = $validated['mother_name'] ?? null;
            $user->mobile = $validated['mobile'];
            $user->alt_mobile = $validated['alt_mobile'] ?? null;
            $user->email = $validated['email'] ?? null;
            $user->national_id = $validated['national_id'] ?? null;
            $user->address = $validated['address'] ?? null;
            $user->birth_date = $validated['birth_date'] ?? null;
            $user->notes = $validated['notes'] ?? null;
            $user->is_active = $validated['is_active'];
            $user->role = 'student';
            $user->login_id = $loginId;
            $user->plain_password = $plainPassword;
            $user->password = Hash::make($plainPassword);

            $user->save();

            return redirect()->back()->with('success', 'Student created successfully with password: ' . $plainPassword);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create student. Please try again.');
        }
    }

    public function show($id)
    {
        $student = User::where('role', 'student')->findOrFail($id);
        return view('admin.accounts.student.show', compact('student'));
    }

    public function edit($id)
    {
        $student = User::where('role', 'student')->findOrFail($id);
        return view('admin.accounts.student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        try {
            $student = User::where('role', 'student')->findOrFail($id);
            
            $validated = $request->validate([
                'name'         => 'required|string|max:150',
                'father_name'  => 'nullable|string|max:150',
                'mother_name'  => 'nullable|string|max:150',
                'mobile'       => 'required|string|max:15|unique:users,mobile,' . $id,
                'alt_mobile'   => 'nullable|string|max:15',
                'email'        => 'nullable|email|max:150|unique:users,email,' . $id,
                'national_id'  => 'nullable|string|max:20',
                'address'      => 'nullable|string|max:500',
                'birth_date'   => 'nullable|date|before:today',
                'notes'        => 'nullable|string|max:1000',
                'is_active'    => 'required|boolean',
            ]);

            $student->update($validated);
            
            return redirect()->back()->with('success', 'Student updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update student. Please try again.');
        }
    }

    public function destroy($id)
    {
        try {
            $student = User::where('role', 'student')->findOrFail($id);
            
            // Delete student's related data if needed
            // You can add more deletion logic here for related models
            
            $student->delete();
            
            return redirect()->back()->with('success', 'Student deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete student. Please try again.');
        }
    }
}
