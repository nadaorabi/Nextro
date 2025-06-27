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
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('notes', 'like', "%{$search}%");
        }
        
        // فلترة بنوع الحساب
        if ($request->filled('role')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('role', $request->role);
            });
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
        
        // إحصائيات
        $totalRevenue = Payment::where('amount', '>', 0)->sum('amount');
        $totalExpenses = Payment::where('amount', '<', 0)->sum('amount');
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

        return redirect()->back()->with('success', 'تم إضافة المعاملة المالية بنجاح');
    }

    public function update(Request $request, Payment $payment)
    {
        // التحقق من أن المعاملة قابلة للتعديل
        if (!in_array($payment->type, ['instructor_payment', 'discount', 'refund'])) {
            return redirect()->back()->with('error', 'لا يمكن تعديل هذا النوع من المعاملات');
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

        return redirect()->back()->with('success', 'تم تحديث المعاملة المالية بنجاح');
    }

    public function destroy(Payment $payment)
    {
        // التحقق من أن المعاملة قابلة للحذف
        if (!in_array($payment->type, ['instructor_payment', 'discount', 'refund'])) {
            return redirect()->back()->with('error', 'لا يمكن حذف هذا النوع من المعاملات');
        }

        $payment->delete();

        return redirect()->back()->with('success', 'تم حذف المعاملة المالية بنجاح');
    }

    public function generateReceipt(Payment $payment)
    {
        // التحقق من أن المعاملة إيجابية (دفع)
        if ($payment->amount <= 0) {
            return redirect()->back()->with('error', 'لا يمكن إنشاء إيصال لمعاملة غير إيجابية');
        }

        // هنا يمكن إضافة منطق إنشاء PDF للإيصال
        // للآن سنقوم بإنشاء إيصال بسيط
        
        $receiptData = [
            'receipt_number' => 'R-' . str_pad($payment->id, 6, '0', STR_PAD_LEFT),
            'payment' => $payment,
            'user' => $payment->user,
            'date' => $payment->payment_date,
            'amount' => $payment->amount,
            'type' => $this->getTransactionTypeName($payment->type),
            'notes' => $payment->notes
        ];

        // يمكن إضافة مكتبة PDF هنا لإنشاء إيصال حقيقي
        // return PDF::loadView('admin.receipts.payment', $receiptData)->download('receipt-' . $payment->id . '.pdf');
        
        return redirect()->back()->with('success', 'تم إنشاء الإيصال بنجاح');
    }

    private function getTransactionTypeName($type)
    {
        $types = [
            'student_fee' => 'رسوم طالب',
            'package_fee' => 'رسوم باقة',
            'instructor_share' => 'حصة أستاذ',
            'instructor_payment' => 'دفعة أستاذ',
            'discount' => 'خصم',
            'refund' => 'استرداد'
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

        return redirect()->back()->with('success', 'تم إضافة المعاملة المالية للطالب بنجاح');
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

        return redirect()->back()->with('success', 'تم إضافة المعاملة المالية للأستاذ بنجاح');
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
        return redirect()->route('admin.teachers.account', $teacher->id)->with('success', 'تم تعديل الدفعة بنجاح');
    }

    public function deleteTeacherTransaction(User $teacher, Payment $payment)
    {
        if ($teacher->role !== 'teacher' || $payment->user_id !== $teacher->id || $payment->type === 'instructor_share') {
            abort(404);
        }
        $payment->delete();
        return redirect()->route('admin.teachers.account', $teacher->id)->with('success', 'تم حذف الدفعة بنجاح');
    }
} 