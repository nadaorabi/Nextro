<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\User;
use App\Models\Room;
use App\Models\Payment;
use App\Models\Receipt;
use App\Models\Course;
use App\Models\Package;
use PDF;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role == 'admin') {
            session()->flash('welcome', 'Welcome System Administrator');
        }
        
        // Get real statistics from database
        $stats = [
            'total_students' => User::where('role', 'student')->count(),
            'total_teachers' => User::where('role', 'teacher')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'total_courses' => Course::count(),
            'total_packages' => Package::count(),
            'total_rooms' => Room::count(),
            'active_students' => User::where('role', 'student')->where('is_active', 1)->count(),
            'active_teachers' => User::where('role', 'teacher')->where('is_active', 1)->count(),
            'pending_students' => User::where('role', 'student')->where('is_active', 2)->count(),
            'pending_teachers' => User::where('role', 'teacher')->where('is_active', 2)->count(),
            'blocked_students' => User::where('role', 'student')->where('is_active', 0)->count(),
            'blocked_teachers' => User::where('role', 'teacher')->where('is_active', 0)->count(),
            'students_this_month' => User::where('role', 'student')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'teachers_this_month' => User::where('role', 'teacher')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'total_payments' => Payment::count(),
            'payments_this_month' => Payment::whereMonth('payment_date', now()->month)
                ->whereYear('payment_date', now()->year)
                ->count(),
            'total_revenue' => Payment::where('type', 'payment')->sum('amount'),
            'revenue_this_month' => Payment::where('type', 'payment')
                ->whereMonth('payment_date', now()->month)
                ->whereYear('payment_date', now()->year)
                ->sum('amount'),
        ];
        
        return view('admin.dashboard', compact('stats'));
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

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('admin.profile')->with('success', 'Password changed successfully!');
    }

    public function updateProfileImage(Request $request)
    {
        try {
            \Log::info('Profile image upload started', [
                'user_id' => auth()->id(),
                'has_file' => $request->hasFile('profile_image'),
                'file_size' => $request->file('profile_image')?->getSize(),
                'file_type' => $request->file('profile_image')?->getMimeType()
            ]);

            $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = auth()->user();
            
            // Delete old image if exists
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
                \Log::info('Old profile image deleted', ['old_path' => $user->profile_image]);
            }

            // Store new image
            $imagePath = $request->file('profile_image')->store('profile-images', 'public');
            
            \Log::info('Image stored', ['new_path' => $imagePath]);
            
            if (!$imagePath) {
                throw new \Exception('Failed to store image');
            }
            
            // Verify the file was actually stored
            if (!Storage::disk('public')->exists($imagePath)) {
                throw new \Exception('Image file was not stored properly');
            }
            
            $user->update([
                'profile_image' => $imagePath,
            ]);

            \Log::info('Profile image updated successfully', [
                'user_id' => $user->id,
                'image_path' => $imagePath,
                'image_url' => Storage::disk('public')->url($imagePath)
            ]);

            // Check if it's an AJAX request
            if ($request->ajax()) {
                            return response()->json([
                'success' => true,
                'message' => 'Profile image updated successfully!',
                'image_url' => \App\Helpers\ImageHelper::getProfileImageUrl($user)
            ]);
            } else {
                // Traditional form submission
                return redirect()->route('admin.profile')->with('success', 'Profile image updated successfully! Please refresh the page to see the changes.');
            }
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Profile image validation error', ['errors' => $e->errors()]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation error: ' . implode(', ', $e->errors()['profile_image'] ?? ['Invalid image file'])
                ], 422);
            } else {
                return redirect()->route('admin.profile')->withErrors($e->errors());
            }
            
        } catch (\Exception $e) {
            \Log::error('Profile image upload error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error uploading image: ' . $e->getMessage()
                ], 500);
            } else {
                return redirect()->route('admin.profile')->with('error', 'Error uploading image: ' . $e->getMessage());
            }
        }
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
        return view('admin.accounts.teacher.teachers-create');
    }
    public function teachersList()
    {
        return view('admin.accounts.teacher.teachers-list');
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
    public function financePayments(Request $request)
    {
        // فلترة متقدمة
        $query = Payment::with(['user']);
        
        // فلترة بالبحث
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
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
        
        // إحصائيات شاملة
        $totalRevenue = Payment::where('amount', '>', 0)->sum('amount');
        $totalExpenses = Payment::where('amount', '<', 0)->sum('amount');
        $currentBalance = $totalRevenue + $totalExpenses; // Expenses are negative
        
        // إحصائيات تفصيلية
        $studentFees = Payment::where('type', 'student_fee')->sum('amount');
        $packageFees = Payment::where('type', 'package_fee')->sum('amount');
        $instructorShares = Payment::where('type', 'instructor_share')->sum('amount');
        $instructorPayments = Payment::where('type', 'instructor_payment')->sum('amount');
        $discounts = Payment::where('type', 'discount')->sum('amount');
        $refunds = Payment::where('type', 'refund')->sum('amount');
        
        // بيانات للفلترة
        $users = User::select('id', 'name', 'email', 'role')->orderBy('name')->get();
        $courses = Course::select('id', 'title')->orderBy('title')->get();
        $packages = Package::select('id', 'name')->orderBy('name')->get();
        
        return view('admin.finance', compact(
            'payments', 
            'totalRevenue', 
            'totalExpenses', 
            'currentBalance',
            'studentFees',
            'packageFees', 
            'instructorShares',
            'instructorPayments',
            'discounts',
            'refunds',
            'users', 
            'courses', 
            'packages'
        ));
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
            'message' => 'Payment saved successfully',
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
            'message' => 'Payment updated successfully',
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
            'message' => 'Payment deleted successfully'
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
