@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<div class="container py-4">
    <!-- Header -->
    <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="fw-bold mb-2" style="color:#2563eb">
                    <i class="fas fa-chalkboard-teacher me-2"></i>حساب الأستاذ المالي
                </h2>
                <div class="text-muted">إدارة الحركات المالية للأستاذ: {{ $teacher->name }}</div>
            </div>
            <a href="{{ route('admin.accounts.teachers.list') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>عودة للأساتذة
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

    <!-- Teacher Info Card -->
    <div class="card shadow-sm mb-4" style="border-radius:18px;background:linear-gradient(135deg,#f093fb 0%,#f5576c 100%);color:white;">
        <div class="card-body p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4 class="mb-2">{{ $teacher->name }}</h4>
                    <p class="mb-1"><i class="fas fa-id-card me-2"></i>{{ $teacher->national_id ?? 'غير محدد' }}</p>
                    <p class="mb-1"><i class="fas fa-phone me-2"></i>{{ $teacher->mobile ?? 'غير محدد' }}</p>
                    <p class="mb-0"><i class="fas fa-envelope me-2"></i>{{ $teacher->email ?? 'غير محدد' }}</p>
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
        <div class="col-md-4">
            <div class="card shadow-sm" style="border-radius:15px;">
                <div class="card-body text-center">
                    <div class="h3 text-success mb-1">{{ number_format($totalEarnings, 2) }} د.ك</div>
                    <div class="text-muted">إجمالي الأرباح</div>
                    <i class="fas fa-coins text-success mt-2" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm" style="border-radius:15px;">
                <div class="card-body text-center">
                    <div class="h3 text-danger mb-1">{{ number_format(abs($totalPayouts), 2) }} د.ك</div>
                    <div class="text-muted">إجمالي الدفعات</div>
                    <i class="fas fa-credit-card text-danger mt-2" style="font-size: 2rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm" style="border-radius:15px;">
                <div class="card-body text-center">
                    <div class="h3 {{ $netBalance >= 0 ? 'text-success' : 'text-danger' }} mb-1">
                        {{ number_format($netBalance, 2) }} د.ك
                    </div>
                    <div class="text-muted">صافي الرصيد</div>
                    <i class="fas fa-calculator {{ $netBalance >= 0 ? 'text-success' : 'text-danger' }} mt-2" style="font-size: 2rem;"></i>
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
                    <span class="text-muted">إجمالي النتائج: {{ $payments->total() }}</span>
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
                            <th>اسم الطالب</th>
                            <th>المبلغ</th>
                            <th>الرصيد بعد المعاملة</th>
                            <th>ملاحظات</th>
                            <th>إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // جلب كل الحركات المالية للأستاذ (بدون paginate)
                            $allPayments = \App\Models\Payment::where('user_id', $teacher->id)->orderBy('payment_date')->orderBy('id')->get();
                            $balances = [];
                            $current = 0;
                            foreach ($allPayments as $p) {
                                $current += $p->amount;
                                $balances[$p->id] = $current;
                            }
                        @endphp
                        @forelse($payments as $payment)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle me-3" style="width: 40px; height: 40px;">
                                            <i class="ni ni-money-coins text-white opacity-10"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ date('Y-m-d', strtotime($payment->payment_date)) }}</div>
                                            <div class="text-muted small">{{ date('H:i', strtotime($payment->payment_date)) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($payment->type == 'instructor_payment')
                                        <span class="badge bg-warning text-dark">دفعة أستاذ</span>
                                    @elseif($payment->type == 'salary')
                                        <span class="badge bg-success">راتب</span>
                                    @elseif($payment->type == 'bonus')
                                        <span class="badge bg-info">مكافأة</span>
                                    @elseif($payment->type == 'deduction')
                                        <span class="badge bg-danger">خصم</span>
                                    @elseif($payment->type == 'instructor_share')
                                        <span class="badge bg-primary">نسبة من دورة</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $payment->type }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($payment->type == 'instructor_share')
                                        @php
                                            $studentName = null;
                                            if (preg_match('/تسجيل الطالب: (.*?) في الدورة:/u', $payment->notes, $matches)) {
                                                $studentName = $matches[1];
                                            }
                                        @endphp
                                        {{ $studentName ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold {{ $payment->amount > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $payment->amount > 0 ? '+' : '' }}{{ number_format($payment->amount, 2) }} د.ك
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold {{ ($balances[$payment->id] ?? 0) >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ number_format($balances[$payment->id] ?? 0, 2) }} د.ك
                                    </span>
                                </td>
                                <td>
                                    @if($payment->type == 'instructor_share')
                                        @php
                                            $courseName = null;
                                            if (preg_match('/الدورة: (.*)$/u', $payment->notes, $matches)) {
                                                $courseName = $matches[1];
                                            }
                                        @endphp
                                        أرباح: {{ $courseName ?? '-' }}
                                    @else
                                        {{ $payment->notes ?? '-' }}
                                    @endif
                                </td>
                                <td>
                                    @if(in_array($payment->type, ['instructor_payment', 'salary', 'bonus', 'deduction']))
                                        <a href="{{ route('admin.teachers.account.transaction.edit', [$teacher->id, $payment->id]) }}" class="btn btn-sm btn-primary" title="تعديل"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('admin.teachers.account.transaction.delete', [$teacher->id, $payment->id]) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذه الدفعة؟');"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <br>لا توجد حركات مالية لهذا الأستاذ
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-3">
                {{ $payments->links() }}
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
                    <i class="fas fa-plus me-2"></i>إضافة معاملة مالية للأستاذ: {{ $teacher->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.teachers.account.transaction.store', $teacher) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">نوع المعاملة</label>
                        <select name="type" class="form-select" required>
                            <option value="">اختر النوع</option>
                            <option value="salary">راتب</option>
                            <option value="bonus">مكافأة</option>
                            <option value="instructor_payment">دفعة أستاذ</option>
                            <option value="deduction">خصم</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">المبلغ</label>
                        <div class="input-group">
                            <input type="number" name="amount" class="form-control" step="0.01" required>
                            <span class="input-group-text">د.ك</span>
                        </div>
                        <div class="form-text">استخدم قيمة سالبة للخصم</div>
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