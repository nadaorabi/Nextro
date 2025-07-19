<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\User;
use App\Models\Course;
use App\Models\Package;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // فلترة متقدمة
        $query = Payment::with(['user']);
        
        // فلترة بالبحث
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->whereHas('user', function($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })->orWhere('notes', 'like', "%{$search}%");
            });
        }
        
        // فلترة بنوع الحساب
        if ($request->filled('role')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('role', $request->role);
            });
        }
        
        // فلترة بالمستخدم المحدد
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        
        // فلترة بنوع المعاملة
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        // فلترة بالتاريخ
        if ($request->filled('from')) {
            $query->whereDate('payment_date', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $query->whereDate('payment_date', '<=', $request->to);
        }
        
        $payments = $query->orderByDesc('payment_date')->paginate(20);
        
        // إحصائيات (مع تطبيق نفس الفلاتر)
        $statsQuery = Payment::query();
        
        // تطبيق نفس الفلاتر على الإحصائيات
        if ($request->filled('role')) {
            $statsQuery->whereHas('user', function($q) use ($request) {
                $q->where('role', $request->role);
            });
        }
        if ($request->filled('user_id')) {
            $statsQuery->where('user_id', $request->user_id);
        }
        if ($request->filled('type')) {
            $statsQuery->where('type', $request->type);
        }
        if ($request->filled('from')) {
            $statsQuery->whereDate('payment_date', '>=', $request->from);
        }
        if ($request->filled('to')) {
            $statsQuery->whereDate('payment_date', '<=', $request->to);
        }
        
        $totalRevenue = (clone $statsQuery)->where('amount', '>', 0)->sum('amount');
        $totalExpenses = (clone $statsQuery)->where('amount', '<', 0)->sum('amount');
        $currentBalance = $totalRevenue + $totalExpenses; // Expenses are negative
        
        // بيانات للفلترة
        $users = User::select('id', 'name', 'role')->get();
        $courses = Course::select('id', 'title')->get();
        $packages = Package::select('id', 'name')->get();
        
        return view('admin.transactions.index', compact('payments', 'totalRevenue', 'totalExpenses', 'currentBalance', 'users', 'courses', 'packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:student_fee,package_fee,instructor_payment,discount,refund',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string|max:500'
        ]);

        Payment::create([
            'user_id' => $request->user_id,
            'type' => $request->type,
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'notes' => $request->notes
        ]);

        return redirect()->back()->with('success', 'Financial transaction added successfully');
    }

    public function update(Request $request, Payment $payment)
    {
        // التحقق من أن المعاملة قابلة للتعديل
        if (!in_array($payment->type, ['instructor_payment', 'discount', 'refund'])) {
            return redirect()->back()->with('error', 'This type of transaction cannot be modified');
        }

        $request->validate([
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string|max:500'
        ]);

        $payment->update([
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'notes' => $request->notes
        ]);

        return redirect()->back()->with('success', 'Financial transaction updated successfully');
    }

    public function destroy(Payment $payment)
    {
        // التحقق من أن المعاملة قابلة للحذف
        if (!in_array($payment->type, ['instructor_payment', 'discount', 'refund'])) {
            return redirect()->back()->with('error', 'This type of transaction cannot be deleted');
        }

        $payment->delete();

        return redirect()->back()->with('success', 'Financial transaction deleted successfully');
    }

    public function generateReceipt(Payment $payment)
    {
        // التحقق من أن المعاملة إيجابية (دفع)
        if ($payment->amount <= 0) {
            return redirect()->back()->with('error', 'Cannot generate receipt for non-positive transaction');
        }

        // إنشاء بيانات الإيصال
        $receiptData = [
            'receipt_number' => 'R-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT),
            'payment' => $payment,
            'user' => $payment->user,
            'date' => \Carbon\Carbon::parse($payment->payment_date),
            'amount' => $payment->amount,
            'type' => $this->getTransactionTypeName($payment->type),
            'notes' => $payment->notes,
            'institute_name' => 'NEXTRO',
            'institute_address' => 'Syria - Hama',
            'institute_phone' => '+963 33 123 4567',
            'institute_email' => 'info@nextro.edu.sy',
            'generated_at' => now()
        ];

        return view('admin.transactions.receipt', compact('receiptData'));
    }

    private function getTransactionTypeName($type)
    {
        $types = [
            'student_fee' => 'Student Fee',
            'package_fee' => 'Package Fee',
            'instructor_share' => 'Instructor Share',
            'instructor_payment' => 'Instructor Payment',
            'discount' => 'Discount',
            'refund' => 'Refund'
        ];

        return $types[$type] ?? $type;
    }

    public function studentAccount(User $student)
    {
        // التأكد من أن المستخدم طالب
        if ($student->role !== 'student') {
            abort(404);
        }

        // جميع الحركات المالية للطالب للجدول
        $allPayments = Payment::where('user_id', $student->id)
            ->orderByDesc('payment_date')
            ->paginate(20);

        // مجموع المدفوع فقط من معاملات دفع رسوم طالب
        $totalPaid = Payment::where('user_id', $student->id)
            ->where('type', 'student_fee')
            ->sum('amount');

        // مجموع الاسترداد فقط من معاملات refund
        $totalRefunded = Payment::where('user_id', $student->id)
            ->where('type', 'refund')
            ->sum('amount');

        // مجموع الخصومات فقط من معاملات discount
        $totalDiscount = Payment::where('user_id', $student->id)
            ->where('type', 'discount')
            ->sum('amount');

        // مجموع أسعار الكورسات المسجل بها الطالب
        $enrollments = \App\Models\Enrollment::with('course')
            ->where('student_id', $student->id)
            ->get();
        $totalCoursesDue = $enrollments->sum(function($enrollment) {
            return $enrollment->course ? $enrollment->course->final_price : 0;
        });

        // مجموع أسعار الباقات المسجل بها الطالب
        $studentPackages = \App\Models\StudentPackage::with('package')
            ->where('student_id', $student->id)
            ->get();
        $totalPackagesDue = $studentPackages->sum(function($sp) {
            return $sp->package ? ($sp->package->discounted_price ?? $sp->package->price) : 0;
        });

        // الرسوم المستحقة = الكورسات + الباقات - الخصومات
        $totalDue = $totalCoursesDue + $totalPackagesDue - $totalDiscount;
        $outstanding = $totalDue - $totalPaid + $totalRefunded;

        // الرصيد الحالي (من جميع المعاملات)
        $balance = Payment::where('user_id', $student->id)->sum('amount');

        return view('admin.students.account', compact('student', 'allPayments', 'balance', 'totalPaid', 'totalDue', 'outstanding', 'totalDiscount'));
    }

    public function storeStudentTransaction(Request $request, User $student)
    {
        // التأكد من أن المستخدم طالب
        if ($student->role !== 'student') {
            abort(404);
        }

        $request->validate([
            'type' => 'required|in:student_fee,refund,discount',
            'amount' => 'required|numeric',
            'notes' => 'nullable|string|max:500'
        ]);

        Payment::create([
            'user_id' => $student->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'notes' => $request->notes,
            'payment_date' => now()
        ]);

        return redirect()->back()->with('success', 'Student financial transaction added successfully');
    }

    public function teacherAccount(User $teacher)
    {
        // التأكد من أن المستخدم أستاذ
        if ($teacher->role !== 'teacher') {
            abort(404);
        }

        // حركات الأستاذ المالية
        $payments = Payment::where('user_id', $teacher->id)
            ->orderByDesc('payment_date')
            ->paginate(20);

        // حساب الرصيد
        $balance = Payment::where('user_id', $teacher->id)->sum('amount');

        // إحصائيات
        $totalSalary = Payment::where('user_id', $teacher->id)->where('amount', '>', 0)->sum('amount');
        $totalDeductions = Payment::where('user_id', $teacher->id)->where('amount', '<', 0)->sum('amount');

        // إجمالي أرباح الأستاذ (instructor_share فقط)
        $totalEarnings = Payment::where('user_id', $teacher->id)
            ->where('type', 'instructor_share')
            ->sum('amount');

        // إجمالي الدفعات للأستاذ (instructor_payment, salary, deduction)
        $totalPayouts = Payment::where('user_id', $teacher->id)
            ->whereIn('type', ['instructor_payment', 'salary', 'deduction'])
            ->sum('amount');

        // صافي الرصيد = الأرباح - الدفعات
        $netBalance = $totalEarnings - abs($totalPayouts);

        return view('admin.teachers.account', compact('teacher', 'payments', 'balance', 'totalSalary', 'totalDeductions', 'totalEarnings', 'totalPayouts', 'netBalance'));
    }

    public function storeTeacherTransaction(Request $request, User $teacher)
    {
        // التأكد من أن المستخدم أستاذ
        if ($teacher->role !== 'teacher') {
            abort(404);
        }

        $request->validate([
            'type' => 'required|in:instructor_payment,salary,bonus,deduction',
            'amount' => 'required|numeric',
            'notes' => 'nullable|string|max:500'
        ]);

        Payment::create([
            'user_id' => $teacher->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'notes' => $request->notes,
            'payment_date' => now()
        ]);

        return redirect()->back()->with('success', 'Teacher financial transaction added successfully');
    }

    public function editTeacherTransaction(User $teacher, Payment $payment)
    {
        if ($teacher->role !== 'teacher' || $payment->user_id !== $teacher->id || $payment->type === 'instructor_share') {
            abort(404);
        }
        return view('admin.teachers.edit-transaction', compact('teacher', 'payment'));
    }

    public function updateTeacherTransaction(Request $request, User $teacher, Payment $payment)
    {
        if ($teacher->role !== 'teacher' || $payment->user_id !== $teacher->id || $payment->type === 'instructor_share') {
            abort(404);
        }
        $request->validate([
            'amount' => 'required|numeric',
            'notes' => 'nullable|string|max:500',
        ]);
        $payment->update([
            'amount' => $request->amount,
            'notes' => $request->notes,
        ]);
        return redirect()->route('admin.teachers.account', $teacher->id)->with('success', 'Payment updated successfully');
    }

    public function deleteTeacherTransaction(User $teacher, Payment $payment)
    {
        if ($teacher->role !== 'teacher' || $payment->user_id !== $teacher->id || $payment->type === 'instructor_share') {
            abort(404);
        }
        $payment->delete();
        return redirect()->route('admin.teachers.account', $teacher->id)->with('success', 'Payment deleted successfully');
    }
} 