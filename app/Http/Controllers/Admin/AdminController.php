<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use App\Models\Room;
use App\Models\Payment;
use App\Models\Receipt;
use PDF;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role == 'admin') {
            session()->flash('welcome', 'أهلاً وسهلاً بك مسؤول النظام');
        }
        return view('Admin.dashboard');
    }

    public function billing()
    {
        return view('admin.billing');
    }
    public function tables()
    {
        return view('admin.tables');
    }
    public function students()
    {
        return view('admin.students');
    }
    public function QR_scan()
    {
        return view('admin.QR-scan');
    }
    public function materials()
    {
        return view('admin.materials');
    }
    public function complaints()
    {
        return view('admin.complaints');
    }
    public function finance()
    {
        return view('admin.finance.finance');
    }
    public function financeReports()
    {
        return view('admin.finance.reports');
    }
    public function profile()
    {
        return view('admin.profile');
    }

    // إدارة حسابات: طلاب
    public function studentsCreate()
    {
        return view('admin.accounts.students-create');
    }
    public function studentsList()
    {
        return view('admin.accounts.students-list');
    }
    // إدارة حسابات: أساتذة
    public function teachersCreate()
    {
        return view('admin.accounts.teachers-create');
    }
    public function teachersList()
    {
        return view('admin.accounts.teachers-list');
    }
    // إدارة حسابات: مسؤولين
    public function adminsCreate()
    {
        return view('admin.accounts.admins-create');
    }
    public function adminsList()
    {
        return view('admin.accounts.admins-list');
    }

    // Educational Materials Management
    public function materialsCreate()
    {
        return view('admin.educational-materials.create');
    }
    public function materialsEdit()
    {
        return view('admin.educational-materials.edit');
    }
    public function materialsLink()
    {
        return view('admin.educational-materials.link');
    }
    public function materialsList()
    {
        return view('admin.educational-materials.list');
    }

    public function supervisionAttendance()
    {
        return view('admin.supervision.attendance');
    }
    public function supervisionComplaints()
    {
        return view('admin.supervision.complaints');
    }
    public function supervisionQR()
    {
        return view('admin.supervision.qr');
    }

    // جداول
    public function tablesCreate()
    {
        return view('admin.tables.create');
    }
    public function tablesEdit()
    {
        return view('admin.tables.edit');
    }
    public function tablesList()
    {
        return view('admin.tables.list');
    }
    // إدارة القاعات والمرافق
    public function hallsCreate()
    {
        return view('admin.facilities.halls-create');
    }

    public function hallsStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'location' => 'required|string|max:255',
            'type' => 'required|string|in:classroom,lab,hall',
            'facilities' => 'nullable|array',
            'notes' => 'nullable|string'
        ]);

        // Here you would typically store the hall in your database
        // For now, we'll just redirect back with success message

        return redirect()->route('admin.facilities.halls.list')
            ->with('success', 'Hall created successfully');
    }

    public function hallsList()
    {
        return view('admin.facilities.halls-list');
    }

    public function facilitiesManage()
    {
        return view('admin.facilities.facilities-manage');
    }

    // مالية
    public function financePayments()
    {
        return view('admin.finance.finance-payments');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('staff.login');
    }

    /**
     * حفظ دفعة جديدة
     */
    public function storePayment(Request $request)
    {
        // التحقق من البيانات
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:tuition,books,activities,other',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,card,transfer',
            'status' => 'required|in:completed,pending',
            'notes' => 'nullable|string'
        ]);

        // حفظ الدفعة
        $payment = Payment::create($validated);

        // إنشاء إيصال تلقائياً
        if ($payment->status === 'completed') {
            $receipt = Receipt::create([
                'payment_id' => $payment->id,
                'receipt_number' => 'R-' . str_pad($payment->id, 5, '0', STR_PAD_LEFT),
                'amount' => $payment->amount,
                'date' => $payment->payment_date
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'تم حفظ الدفعة بنجاح',
            'payment' => $payment,
            'receipt' => $receipt ?? null
        ]);
    }

    /**
     * تحديث دفعة
     */
    public function updatePayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $validated = $request->validate([
            'amount' => 'sometimes|numeric|min:0',
            'type' => 'sometimes|in:tuition,books,activities,other',
            'payment_date' => 'sometimes|date',
            'payment_method' => 'sometimes|in:cash,card,transfer',
            'status' => 'sometimes|in:completed,pending',
            'notes' => 'nullable|string'
        ]);

        $payment->update($validated);

        // إنشاء إيصال إذا تم تغيير الحالة إلى مكتمل
        if ($payment->status === 'completed' && !$payment->receipt) {
            $receipt = Receipt::create([
                'payment_id' => $payment->id,
                'receipt_number' => 'R-' . str_pad($payment->id, 5, '0', STR_PAD_LEFT),
                'amount' => $payment->amount,
                'date' => $payment->payment_date
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث الدفعة بنجاح',
            'payment' => $payment
        ]);
    }

    /**
     * حذف دفعة
     */
    public function deletePayment($id)
    {
        $payment = Payment::findOrFail($id);

        // حذف الإيصال المرتبط إن وجد
        if ($payment->receipt) {
            $payment->receipt->delete();
        }

        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم حذف الدفعة بنجاح'
        ]);
    }

    /**
     * إنشاء إيصال للدفعة
     */
    public function generateReceipt($id)
    {
        $payment = Payment::with('student')->findOrFail($id);

        // إنشاء PDF
        $pdf = PDF::loadView('admin.finance.receipt-pdf', [
            'payment' => $payment
        ]);

        return $pdf->download('receipt-' . $payment->id . '.pdf');
    }
}
