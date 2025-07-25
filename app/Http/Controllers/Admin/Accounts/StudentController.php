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
        $graduatedStudents = User::where('role', 'student')->where('is_graduated', true)->count();
        $notGraduatedStudents = User::where('role', 'student')->where('is_graduated', false)->count();
        $blockedStudents = User::where('role', 'student')->where('is_active', '0')->count();

        $studentsThisMonth = User::where('role', 'student')
            ->whereMonth('created_at', now()->month)
            ->count();

        // Get all students without pagination for frontend filtering
        $students = $query->latest()->get();

        return view('admin.accounts.Student.index', compact(
            'students',
            'totalStudents',
            'activeStudents',
            'graduatedStudents',
            'notGraduatedStudents',
            'blockedStudents',
            'studentsThisMonth'
        ));
    }


    public function create()
    {
        return view('admin.accounts.Student.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'         => 'required|string|max:150',
                'user_name'    => 'required|string|max:50|unique:users,user_name',
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
            $user->user_name = $validated['user_name'];
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

            if ($request->hasFile('profile_image')) {
                $user->profile_image = $request->file('profile_image')->store('profile-images', 'public');
            } else {
                $gender = strtolower($request->input('gender', 'male'));
                $user->profile_image = $gender === 'female' ? 'defaults/default-student-female.jpg' : 'defaults/default-student-male.jpg';
            }

            $user->save();

            return redirect()->route('admin.accounts.students.list')->with('success', 'Student created successfully with password: ' . $plainPassword);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create student: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $student = User::with(['studentNotes.admin'])->findOrFail($id);

        // الكورسات المسجل بها الطالب
        $enrollments = \App\Models\Enrollment::with(['course', 'course.category', 'course.courseInstructors.instructor', 'course.schedules.room'])
            ->where('student_id', $id)
            ->get();

        // البكجات المسجل بها الطالب
        $studentPackages = \App\Models\StudentPackage::with(['package', 'package.packageCourses.course.schedules.room'])
            ->where('student_id', $id)
            ->get();

        // جميع جداول الكورسات المسجل بها الطالب مباشرة
        $courseSchedules = collect();
        foreach ($enrollments as $enrollment) {
            if ($enrollment->course && $enrollment->course->schedules) {
                foreach ($enrollment->course->schedules as $schedule) {
                    // البحث عن سجل الحضور لهذا الطالب في هذه الحصة
                    $attendance = \App\Models\Attendance::where('enrollment_id', $enrollment->id)
                        ->where('schedule_id', $schedule->id)
                        ->where('date', $schedule->session_date)
                        ->first();
                    
                    $attendanceStatus = 'pending'; // الحالة الافتراضية
                    if ($attendance) {
                        $attendanceStatus = $attendance->status;
                    }
                    
                    $courseSchedules->push([
                        'type' => 'course',
                        'name' => $enrollment->course->title,
                        'category' => $enrollment->course->category->name ?? '',
                        'session_date' => $schedule->session_date,
                        'day_of_week' => $schedule->day_of_week,
                        'start_time' => $schedule->start_time,
                        'end_time' => $schedule->end_time,
                        'room' => $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name ?? '') : '',
                        'attendance_status' => $this->getAttendanceStatus($enrollment->id, $schedule->id, $schedule->session_date),
                    ]);
                }
            }
        }

        // جميع جداول الكورسات ضمن البكجات
        $packageSchedules = collect();
        foreach ($studentPackages as $sp) {
            if ($sp->package && $sp->package->packageCourses) {
                foreach ($sp->package->packageCourses as $pc) {
                    $course = $pc->course;
                    if ($course && $course->schedules) {
                        foreach ($course->schedules as $schedule) {
                            // البحث عن سجل الحضور لهذا الطالب في هذه الحصة
                            $attendance = \App\Models\Attendance::where('enrollment_id', $enrollment->id)
                                ->where('schedule_id', $schedule->id)
                                ->where('date', $schedule->session_date)
                                ->first();
                            
                            $attendanceStatus = 'pending'; // الحالة الافتراضية
                            if ($attendance) {
                                $attendanceStatus = $attendance->status;
                            }
                            
                            $packageSchedules->push([
                                'type' => 'package',
                                'package_name' => $sp->package->name,
                                'name' => $course->title,
                                'category' => $course->category->name ?? '',
                                'session_date' => $schedule->session_date,
                                'day_of_week' => $schedule->day_of_week,
                                'start_time' => $schedule->start_time,
                                'end_time' => $schedule->end_time,
                                'room' => $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name ?? '') : '',
                                'attendance_status' => $this->getAttendanceStatus($enrollment->id, $schedule->id, $schedule->session_date),
                            ]);
                        }
                    }
                }
            }
        }

        // دمج وترتيب كل الجداول حسب التاريخ والوقت
        $allSchedules = $courseSchedules->merge($packageSchedules)->sortBy([['session_date', 'asc'], ['start_time', 'asc']])->values();

        // الحركات المالية
        $payments = $student->payments()->orderByDesc('payment_date')->get();
        $totalPaid = $student->payments()->where('type', 'student_fee')->sum('amount');
        $totalDiscount = $student->payments()->where('type', 'discount')->sum('amount');
        $totalCoursesDue = $enrollments->sum(function($enrollment) {
            return $enrollment->course ? $enrollment->course->final_price : 0;
        });
        $totalPackagesDue = $studentPackages->sum(function($sp) {
            return $sp->package ? ($sp->package->discounted_price ?? $sp->package->price) : 0;
        });
        $totalDue = $totalCoursesDue + $totalPackagesDue - $totalDiscount;
        $totalRefunded = $student->payments()->where('type', 'refund')->sum('amount');
        $outstanding = $totalDue - $totalPaid + $totalRefunded;
        $totalBalance = $payments->sum('amount');

        return view('admin.accounts.Student.show', compact('student', 'enrollments', 'studentPackages', 'payments', 'totalBalance', 'totalDue', 'totalPaid', 'totalDiscount', 'outstanding', 'allSchedules'));
    }

    public function edit($id)
    {
        $student = User::where('role', 'student')->findOrFail($id);
        return view('admin.accounts.Student.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        try {
            $student = User::where('role', 'student')->findOrFail($id);
            
            $validated = $request->validate([
                'name'         => 'required|string|max:150',
                'user_name'    => 'required|string|max:50|unique:users,user_name,' . $id,
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
                    'notes' => 'Course enrollment: ' . $course->title . ($discountAmount > 0 ? ' (discount: ' . $courseDiscount . '%)' : ''),
                    'payment_date' => now(),
                ]);

                // إضافة نسبة الأستاذ
                $courseInstructor = \App\Models\CourseInstructor::where('course_id', $course->id)
                    ->where('role', 'primary')
                    ->first();
                if ($courseInstructor && $courseInstructor->percentage > 0) {
                    $instructorShare = $finalAmount * ($courseInstructor->percentage / 100);
                    \App\Models\Payment::create([
                        'user_id' => $courseInstructor->instructor_id,
                        'amount' => $instructorShare,
                        'type' => 'instructor_share',
                        'notes' => 'Instructor share from student enrollment: ' . $student->name . ' in course: ' . $course->title,
                        'payment_date' => now(),
                    ]);
                }
                
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
                    'notes' => 'Package enrollment: ' . $package->name . ($discountAmount > 0 ? ' (discount: ' . $discount . '%)' : ''),
                    'payment_date' => now(),
                ]);
                
                $successCount++;
            }
        }

        // رسائل النتيجة
        $messages = [];
        
        if ($successCount > 0) {
            $messages[] = "Successfully enrolled in {$successCount} course(s)/package(s)!";
        }
        
        if (!empty($enrolledCourses)) {
            $coursesList = implode(', ', $enrolledCourses);
            $messages[] = "The following courses are already enrolled: {$coursesList}";
        }
        
        if (!empty($enrolledPackages)) {
            $packagesList = implode(', ', $enrolledPackages);
            $messages[] = "The following packages are already enrolled: {$packagesList}";
        }

        if (!empty($conflictingCourses)) {
            $conflictsList = implode(', ', $conflictingCourses);
            $messages[] = "Cannot enroll the following packages due to conflicts: {$conflictsList}";
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
                'notes' => 'Course removal: ' . $course->title . ' (refund)',
                'payment_date' => now(),
            ]);

            return redirect()->back()->with('success', 'Course removed successfully and amount refunded!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove course: ' . $e->getMessage());
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
                'notes' => 'Package removal: ' . $package->name . ' (refund)',
                'payment_date' => now(),
            ]);

            return redirect()->back()->with('success', 'Package removed successfully and amount refunded!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove package: ' . $e->getMessage());
        }
    }

    // Helper method to get attendance status
    private function getAttendanceStatus($enrollmentId, $scheduleId, $date)
    {
        $attendance = \App\Models\Attendance::where('enrollment_id', $enrollmentId)
            ->where('schedule_id', $scheduleId)
            ->where('date', $date)
            ->first();
        
        return $attendance ? $attendance->status : 'pending';
    }

    public function addTransaction(Request $request, $id)
    {
        try {
            $request->validate([
                'type' => 'required|in:student_fee,payment,refund,discount',
                'amount' => 'required|numeric|min:0.01',
                'notes' => 'nullable|string|max:500',
            ]);

            $student = User::where('role', 'student')->findOrFail($id);

            Payment::create([
                'user_id' => $student->id,
                'type' => $request->type,
                'amount' => $request->amount,
                'payment_date' => now(),
                'notes' => $request->notes ?? 'Transaction added by admin',
            ]);

            return redirect()->back()->with('success', 'Transaction added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add transaction: ' . $e->getMessage());
        }
    }

    public function toggleGraduation($id)
    {
        try {
            $student = User::where('role', 'student')->findOrFail($id);
            $newStatus = $student->toggleGraduationStatus();
            
            $statusText = $newStatus ? 'Graduated' : 'Not Graduated';
            
            return response()->json([
                'success' => true,
                'message' => "Student graduation status changed to: {$statusText}",
                'is_graduated' => $newStatus,
                'status_text' => $statusText
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to change graduation status: ' . $e->getMessage()
            ], 500);
        }
    }
}
