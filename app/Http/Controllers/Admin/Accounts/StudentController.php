<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\StudentNote;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->back()->with('error', 'Failed to create student: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $student = User::with(['studentNotes.admin'])->findOrFail($id);

        // الكورسات المسجل بها الطالب
        $enrollments = \App\Models\Enrollment::with(['course', 'course.category', 'course.courseInstructors.instructor'])
            ->where('student_id', $id)
            ->get();

        // البكجات المسجل بها الطالب
        $studentPackages = \App\Models\StudentPackage::with(['package', 'package.packageCourses.course'])
            ->where('student_id', $id)
            ->get();

        // الحركات المالية
        $payments = $student->payments()->orderByDesc('payment_date')->get();

        // حساب الرصيد الإجمالي
        $totalBalance = $payments->sum('amount');

        return view('admin.accounts.Student.show', compact('student', 'enrollments', 'studentPackages', 'payments', 'totalBalance'));
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
            return redirect()->back()->with('error', 'Failed to update student: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $student = User::where('role', 'student')->findOrFail($id);
            
            // Delete student's related data if needed
            // You can add more deletion logic here for related models
            
            $student->delete();
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Student deleted successfully'
                ]);
            }
            
            return redirect()->back()->with('success', 'Student deleted successfully');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete student. Please try again.'
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Failed to delete student: ' . $e->getMessage());
        }
    }

    public function addNote(Request $request, $id)
    {
        try {
            $request->validate([
                'note' => 'required|string|max:1000',
            ]);

            $note = StudentNote::create([
                'student_id' => $id,
                'admin_id' => Auth::id(),
                'note' => $request->note,
            ]);

            \Log::info('Note created successfully', [
                'note_id' => $note->id,
                'student_id' => $id,
                'admin_id' => Auth::id(),
                'note_text' => $request->note
            ]);

            return redirect()->back()->with('success', 'Note added successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to create note', [
                'error' => $e->getMessage(),
                'student_id' => $id,
                'admin_id' => Auth::id(),
                'note_text' => $request->note ?? 'null'
            ]);
            
            return redirect()->back()->with('error', 'Failed to add note: ' . $e->getMessage());
        }
    }

    public function deleteNote($noteId)
    {
        $note = StudentNote::findOrFail($noteId);
        $note->delete();
        return redirect()->back()->with('success', 'Note deleted successfully!');
    }

    public function selectCourse($id)
    {
        $student = User::findOrFail($id);
        $courses = \App\Models\Course::with('category')->get();
        $packages = \App\Models\Package::with(['category', 'packageCourses.course'])->get();
        $categories = \App\Models\Category::orderBy('name')->get();
        // الكورسات المسجلة مسبقاً
        $enrolledCourseIds = \App\Models\Enrollment::where('student_id', $id)
            ->pluck('course_id')
            ->toArray();
        // الباقات المسجلة مسبقاً
        $enrolledPackageIds = \App\Models\StudentPackage::where('student_id', $id)
            ->pluck('package_id')
            ->toArray();
        return view('admin.accounts.Student.select-course', compact(
            'student', 
            'courses', 
            'packages', 
            'enrolledCourseIds', 
            'enrolledPackageIds',
            'categories'
        ));
    }

    public function enrollCourse(Request $request, $id)
    {
        $request->validate([
            'courses' => 'nullable|array',
            'courses.*' => 'integer|exists:courses,id',
            'packages' => 'nullable|array',
            'packages.*' => 'integer|exists:packages,id',
            'discount' => 'nullable|numeric|min:0|max:100',
            'course_discounts' => 'nullable|array',
            'course_discounts.*' => 'nullable|numeric|min:0|max:100',
        ]);

        $student = User::findOrFail($id);
        $discount = $request->discount ?? 0;
        $enrolledCourses = [];
        $enrolledPackages = [];
        $conflictingCourses = [];
        $successCount = 0;

        // إضافة الكورسات
        if ($request->has('courses')) {
            foreach ($request->courses as $courseId) {
                // تحقق إذا كان الطالب مسجل مسبقًا في هذا الكورس
                $alreadyEnrolled = \App\Models\Enrollment::where('student_id', $student->id)
                    ->where('course_id', $courseId)
                    ->exists();
                
                if ($alreadyEnrolled) {
                    $course = \App\Models\Course::findOrFail($courseId);
                    $enrolledCourses[] = $course->title;
                    continue;
                }

                $course = \App\Models\Course::findOrFail($courseId);
                $price = $course->final_price;
                
                // خصم خاص بالكورس أو الخصم العام
                $courseDiscount = $request->input("course_discounts.{$courseId}", $discount);
                $discountAmount = $courseDiscount > 0 ? ($price * $courseDiscount / 100) : 0;
                $finalAmount = $price - $discountAmount;
                
                \App\Models\Enrollment::create([
                    'student_id' => $student->id,
                    'course_id' => $courseId,
                    'enrollment_date' => now(),
                ]);
                
                // إنشاء حركة مالية
                \App\Models\Payment::create([
                    'user_id' => $student->id,
                    'amount' => -$finalAmount, // سالب لأن الطالب يدفع
                    'type' => 'course_enrollment',
                    'notes' => 'تسجيل كورس: ' . $course->title . ($discountAmount > 0 ? ' (خصم: ' . $courseDiscount . '%)' : ''),
                    'payment_date' => now(),
                ]);
                
                $successCount++;
            }
        }

        // إضافة البكجات
        if ($request->has('packages')) {
            foreach ($request->packages as $packageId) {
                // تحقق إذا كان الطالب مسجل مسبقًا في هذه الباقة
                $alreadyEnrolled = \App\Models\StudentPackage::where('student_id', $student->id)
                    ->where('package_id', $packageId)
                    ->exists();
                
                if ($alreadyEnrolled) {
                    $package = \App\Models\Package::findOrFail($packageId);
                    $enrolledPackages[] = $package->name;
                    continue;
                }

                $package = \App\Models\Package::findOrFail($packageId);
                $price = $package->discounted_price ?? $package->price;
                $discountAmount = $discount > 0 ? ($price * $discount / 100) : 0;
                $finalAmount = $price - $discountAmount;

                // تحقق من تعارض الكورسات
                $packageCourses = $package->courses;
                $conflicts = [];
                
                foreach ($packageCourses as $packageCourse) {
                    $alreadyEnrolledInCourse = \App\Models\Enrollment::where('student_id', $student->id)
                        ->where('course_id', $packageCourse->id)
                        ->exists();
                    
                    if ($alreadyEnrolledInCourse) {
                        $conflicts[] = $packageCourse->title;
                    }
                }
                
                if (!empty($conflicts)) {
                    $conflictingCourses[] = $package->name . ' (يتعارض مع: ' . implode(', ', $conflicts) . ')';
                    continue;
                }
                
                \App\Models\StudentPackage::create([
                    'student_id' => $student->id,
                    'package_id' => $packageId,
                    'amount_paid' => $finalAmount,
                    'purchase_date' => now(),
                ]);
                
                // إنشاء حركة مالية
                \App\Models\Payment::create([
                    'user_id' => $student->id,
                    'amount' => -$finalAmount, // سالب لأن الطالب يدفع
                    'type' => 'package_enrollment',
                    'notes' => 'تسجيل باقة: ' . $package->name . ($discountAmount > 0 ? ' (خصم: ' . $discount . '%)' : ''),
                    'payment_date' => now(),
                ]);
                
                $successCount++;
            }
        }

        // رسائل النتيجة
        $messages = [];
        
        if ($successCount > 0) {
            $messages[] = "تم تسجيل {$successCount} كورس/باقة بنجاح!";
        }
        
        if (!empty($enrolledCourses)) {
            $coursesList = implode(', ', $enrolledCourses);
            $messages[] = "الكورسات التالية مسجلة مسبقاً: {$coursesList}";
        }
        
        if (!empty($enrolledPackages)) {
            $packagesList = implode(', ', $enrolledPackages);
            $messages[] = "الباقات التالية مسجلة مسبقاً: {$packagesList}";
        }

        if (!empty($conflictingCourses)) {
            $conflictsList = implode(', ', $conflictingCourses);
            $messages[] = "لا يمكن تسجيل الباقات التالية لوجود تعارض: {$conflictsList}";
        }

        $messageType = !empty($enrolledCourses) || !empty($enrolledPackages) || !empty($conflictingCourses) ? 'warning' : 'success';
        $message = implode(' | ', $messages);

        return redirect()->route('admin.accounts.students.show', $student->id)
            ->with($messageType, $message);
    }

    public function unenrollCourse($studentId, $enrollmentId)
    {
        try {
            $student = User::findOrFail($studentId);
            $enrollment = \App\Models\Enrollment::where('id', $enrollmentId)
                ->where('student_id', $studentId)
                ->with('course')
                ->firstOrFail();

            $course = $enrollment->course;
            $coursePrice = $course->final_price;

            // حذف التسجيل
            $enrollment->delete();

            // إنشاء حركة مالية للاسترداد
            \App\Models\Payment::create([
                'user_id' => $student->id,
                'amount' => $coursePrice, // موجب لأن الطالب يسترد المال
                'type' => 'course_refund',
                'notes' => 'حذف كورس: ' . $course->title . ' (استرداد)',
                'payment_date' => now(),
            ]);

            return redirect()->back()->with('success', 'تم حذف الكورس بنجاح واسترداد المبلغ!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'فشل في حذف الكورس: ' . $e->getMessage());
        }
    }

    public function unenrollPackage($studentId, $packageId)
    {
        try {
            $student = User::findOrFail($studentId);
            $studentPackage = \App\Models\StudentPackage::where('id', $packageId)
                ->where('student_id', $studentId)
                ->with('package')
                ->firstOrFail();

            $package = $studentPackage->package;
            $packagePrice = $studentPackage->amount_paid;

            // حذف التسجيل
            $studentPackage->delete();

            // إنشاء حركة مالية للاسترداد
            \App\Models\Payment::create([
                'user_id' => $student->id,
                'amount' => $packagePrice, // موجب لأن الطالب يسترد المال
                'type' => 'package_refund',
                'notes' => 'حذف باقة: ' . $package->name . ' (استرداد)',
                'payment_date' => now(),
            ]);

            return redirect()->back()->with('success', 'تم حذف الباقة بنجاح واسترداد المبلغ!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'فشل في حذف الباقة: ' . $e->getMessage());
        }
    }
}
