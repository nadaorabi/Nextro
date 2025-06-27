@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<div class="container py-4">
    <!-- Header -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-2" style="color:#2563eb">
                    <i class="fas fa-user-graduate me-2"></i>حساب الطالب المالي
                </h2>
                <div class="text-muted">إدارة الحركات المالية للطالب: {{ $student->name }}</div>
            </div>
            <a href="{{ route('admin.accounts.students.list') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>عودة للطلاب
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Student Info Card -->
    <div class="card shadow-sm mb-4" style="border-radius:18px;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);color:white;">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-2">{{ $student->name }}</h4>
                    <p class="mb-1"><i class="fas fa-id-card me-2"></i>{{ $student->national_id ?? 'غير محدد' }}</p>
                    <p class="mb-1"><i class="fas fa-phone me-2"></i>{{ $student->mobile ?? 'غير محدد' }}</p>
                    <p class="mb-0"><i class="fas fa-envelope me-2"></i>{{ $student->email ?? 'غير محدد' }}</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="text-center">
                        <div class="h2 mb-0">{{ number_format($balance, 2) }} د.ك</div>
                        <div class="text-white-50">الرصيد الحالي</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm" style="border-radius:15px;">
                <div class="card-body text-center">
                    <div class="h3 text-primary mb-1">{{ number_format($totalDue, 2) }} د.ك</div>
                    <div class="text-muted">مجموع الرسوم المستحقة</div>
                    <i class="fas fa-file-invoice-dollar text-primary mt-2" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm" style="border-radius:15px;">
                <div class="card-body text-center">
                    <div class="h3 text-success mb-1">{{ number_format($totalPaid, 2) }} د.ك</div>
                    <div class="text-muted">إجمالي المدفوع</div>
                    <i class="fas fa-arrow-up text-success mt-2" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
        @if($totalDiscount > 0)
        <div class="col-md-3">
            <div class="card shadow-sm" style="border-radius:15px;">
                <div class="card-body text-center">
                    <div class="h3 text-info mb-1">{{ number_format($totalDiscount, 2) }} د.ك</div>
                    <div class="text-muted">إجمالي الخصومات</div>
                    <i class="fas fa-percent text-info mt-2" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-3">
            <div class="card shadow-sm" style="border-radius:15px;">
                <div class="card-body text-center">
                    <div class="h3 {{ $outstanding > 0 ? 'text-danger' : 'text-success' }} mb-1">{{ number_format($outstanding, 2) }} د.ك</div>
                    <div class="text-muted">المبلغ المتبقي/المستحق</div>
                    <i class="fas fa-balance-scale {{ $outstanding > 0 ? 'text-danger' : 'text-success' }} mt-2" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Transaction Button -->
    <div class="mb-4">
        <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
            <i class="fas fa-plus me-2"></i>إضافة معاملة مالية
        </button>
    </div>

    <!-- Transactions Table -->
    <div class="card shadow-sm" style="border-radius:18px;">
        <div class="card-header bg-transparent border-0 pb-0">
            <div class="row align-items-center">
                <div class="col-6">
                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>سجل الحركات المالية</h5>
                </div>
                <div class="col-6 text-end">
                    <span class="text-muted">إجمالي النتائج: {{ $allPayments->total() }}</span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>التاريخ</th>
                            <th>نوع المعاملة</th>
                            <th>المبلغ</th>
                            <th>الرصيد بعد المعاملة</th>
                            <th>ملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $runningBalance = 0; @endphp
                        @forelse($allPayments as $payment)
                            @php $runningBalance += $payment->amount; @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle me-3" style="width: 40px; height: 40px;">
                                            <i class="ni ni-money-coins text-white opacity-10"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ date('Y-m-d', strtotime($payment->payment_date)) }}</div>
                                            <div class="text-muted small">{{ date('H:i', strtotime($payment->payment_date)) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($payment->type == 'student_fee')
                                        <span class="badge bg-info">رسوم طالب</span>
                                    @elseif($payment->type == 'instructor_payment')
                                        <span class="badge bg-warning text-dark">دفعة أستاذ</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $payment->type }}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold {{ $payment->amount > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $payment->amount > 0 ? '+' : '' }}{{ number_format($payment->amount, 2) }} د.ك
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold {{ $runningBalance >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ number_format($runningBalance, 2) }} د.ك
                                    </span>
                                </td>
                                <td>{{ $payment->notes ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <br>لا توجد حركات مالية لهذا الطالب
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $allPayments->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus me-2"></i>إضافة معاملة مالية للطالب: {{ $student->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.students.account.transaction.store', $student) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">نوع المعاملة</label>
                        <select name="type" class="form-select" required>
                            <option value="">اختر النوع</option>
                            <option value="student_fee">رسوم طالب</option>
                            <option value="refund">استرداد</option>
                            <option value="discount">خصم</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">المبلغ</label>
                        <div class="input-group">
                            <input type="number" name="amount" class="form-control" step="0.01" required>
                            <span class="input-group-text">د.ك</span>
                        </div>
                        <div class="form-text">استخدم قيمة سالبة للخصم أو الاسترداد</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ملاحظات</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="سبب المعاملة..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-primary">إضافة المعاملة</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<style>
.card {
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
}
.table th {
    font-weight: 600;
    color: #495057;
}
</style> 