@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
/* هيدر كبير وناعم */
.teacher-header {
    background: linear-gradient(90deg, #b4cafe 0%, #e0e7ff 100%);
    border-radius: 18px;
    padding: 36px 32px 28px 32px;
    margin-bottom: 32px;
    box-shadow: 0 4px 24px rgba(44,62,80,0.08);
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    position: relative;
}
.teacher-header .header-title {
    font-size: 2.7rem;
    font-weight: 800;
    color: #6366f1;
    margin-bottom: 8px;
    letter-spacing: -1px;
}
.teacher-header .header-desc {
    color: #64748b;
    font-size: 1.1rem;
    margin-bottom: 0;
}
.teacher-header .header-icon {
    font-size: 2.5rem;
    color: #6366f1;
    margin-left: 10px;
}
.teacher-header .add-btn {
    position: absolute;
    top: 28px;
    right: 32px;
    background: #6366f1;
    color: #fff;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 2px 8px rgba(99,102,241,0.13);
    padding: 12px 28px;
    transition: background 0.2s;
    border: none;
}
.teacher-header .add-btn:hover {
    background: #4f46e5;
}

/* بطاقات الإحصائيات */
.stats-row {
    display: flex;
    gap: 18px;
    margin-bottom: 32px;
    flex-wrap: nowrap;
    overflow-x: auto;
}
.stats-card {
    flex: 1 1 170px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 8px rgba(44,62,80,0.09);
    padding: 16px 10px 14px 10px;
    display: flex;
    align-items: center;
    min-width: 170px;
    max-width: 210px;
    position: relative;
}
.stats-card .icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #e0e7ff 0%, #6366f1 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    color: #fff;
    margin-left: 10px;
    box-shadow: 0 2px 6px rgba(99,102,241,0.10);
}
.stats-card .stat-title {
    color: #64748b;
    font-size: 0.95rem;
    font-weight: 600;
    margin-bottom: 2px;
}
.stats-card .stat-value {
    font-size: 1.3rem;
    font-weight: 800;
    color: #6366f1;
    margin-bottom: 2px;
}
.stats-card .stat-desc {
    font-size: 0.92rem;
    color: #22c55e;
    font-weight: 600;
}
.stats-card .stat-desc.negative {
    color: #ef4444;
}

@media (max-width: 991px) {
    .stats-row { flex-direction: column; gap: 10px; }
    .stats-card { min-width: 0; max-width: 100%; }
    .teacher-header { flex-direction: column; align-items: flex-start; padding: 28px 12px 18px 12px; }
    .teacher-header .add-btn { position: static; margin-top: 18px; }
}

/* تحسين الجداول */
.card, .table-responsive { border-radius: 18px !important; }
.table th { font-weight: 700; color: #6366f1; background: #f3f4f6; border: none; }
.table td { border: none; }

.merged-card {
    background: #fff;
    border-radius: 22px;
    color: #2d3748;
    box-shadow: 0 4px 24px rgba(44,62,80,0.08);
    padding: 32px 32px 32px 32px;
    margin-bottom: 28px;
    display: flex;
    flex-direction: column;
    gap: 0;
    position: relative;
}
.merged-card .header-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 6px;
}
.merged-card .header-title {
    font-size: 2.1rem;
    font-weight: 800;
    color: #6366f1;
    letter-spacing: -1px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.merged-card .header-title i {
    font-size: 2rem;
}
.merged-card .header-actions {
    display: flex;
    align-items: center;
    gap: 18px;
}
.merged-card .action-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 18px;
    font-size: 0.98rem;
    font-weight: 700;
    border-radius: 10px;
    border: none;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
    box-shadow: none;
    min-width: 110px;
    justify-content: center;
    height: 38px;
}
.merged-card .action-btn i {
    font-size: 1rem;
    margin-right: 4px;
}
.merged-card .back-btn {
    background: #7b8ca6;
    color: #fff;
}
.merged-card .back-btn:hover {
    background: #6a7a91;
    color: #fff;
}
.merged-card .edit-btn {
    background: #5a6ff1;
    color: #fff;
}
.merged-card .edit-btn:hover {
    background: #4256c6;
    color: #fff;
}
.merged-card .header-desc {
    color: #64748b;
    font-size: 1.08rem;
    margin-bottom: 18px;
    margin-top: 2px;
}
.merged-card .main-row {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 24px;
    margin-bottom: 0;
    flex-wrap: wrap;
}
.merged-card .info {
    display: flex;
    flex-direction: column;
    gap: 10px;
    min-width: 220px;
}
.merged-card .info .name {
    font-size: 2rem;
    font-weight: 800;
    color: #6366f1;
    margin-bottom: 10px;
}
.merged-card .info .details-row {
    display: flex;
    gap: 32px;
    margin-top: 8px;
}
.merged-card .info .detail {
    font-size: 1.08rem;
    color: #64748b;
    display: flex;
    align-items: center;
    gap: 6px;
}
.merged-card .info .detail i {
    color: #64748b;
    font-size: 1.1rem;
}
.merged-card .balance {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: flex-start;
    min-width: 200px;
    margin-top: 8px;
}
.merged-card .balance .amount {
    font-size: 2.3rem;
    font-weight: 800;
    color: #6366f1;
    margin-bottom: 0;
    direction: ltr;
    text-align: right;
}
@media (max-width: 991px) {
    .merged-card { padding: 20px 12px 16px 12px; }
    .merged-card .header-row, .merged-card .main-row { flex-direction: column; align-items: flex-start; gap: 18px; }
    .merged-card .header-actions { flex-direction: column; gap: 10px; align-items: flex-start; }
    .merged-card .balance { align-items: flex-start; margin-top: 18px; }
    .merged-card .balance { align-items: flex-start; margin-top: 18px; }
    .merged-card .info { min-width: 0; }
    .merged-card .info .details-row { flex-direction: column; gap: 8px; }
}
</style>

<div class="merged-card">
    <div class="header-row">
        <div class="header-title">
            <i class="fas fa-user-graduate"></i>
            Financial Account for {{ $student->name }}
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.accounts.students.list') }}" class="action-btn back-btn">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
            <!-- Add Transaction Button -->
            <button type="button" class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                <i class="fas fa-plus me-2"></i> إضافة معاملة مالية
            </button>
        </div>
    </div>
    <div class="header-desc">Manage financial transactions for: {{ $student->name }}</div>
    <div class="main-row">
        <div class="info">
           
            <div class="details-row">
                <div class="detail"><i class="fas fa-id-card"></i> {{ $student->national_id ?? 'Not set' }}</div>
                <div class="detail"><i class="fas fa-phone"></i> {{ $student->mobile ?? 'Not set' }}</div>
                <div class="detail"><i class="fas fa-envelope"></i> {{ $student->email ?? 'Not set' }}</div>
            </div>
        </div>
        <div class="balance">
     
        </div>
    </div>
</div>

<div class="stats-row" style="flex-wrap:nowrap;overflow-x:auto;">
    <div class="stats-card">
        <div class="icon"><i class="fas fa-file-invoice-dollar"></i></div>
        <div>
            <div class="stat-title">مجموع الرسوم المستحقة</div>
            <div class="stat-value">{{ number_format($totalDue, 2) }} د.ك</div>
            <div class="stat-desc">إجمالي الرسوم</div>
        </div>
    </div>
    <div class="stats-card">
        <div class="icon" style="background:linear-gradient(135deg,#f87171 0%,#ef4444 100%);"><i class="fas fa-arrow-up"></i></div>
        <div>
            <div class="stat-title">إجمالي المدفوع</div>
            <div class="stat-value" style="color:#22c55e;">{{ number_format($totalPaid, 2) }} د.ك</div>
            <div class="stat-desc">المدفوعات</div>
        </div>
    </div>
    <div class="stats-card">
        <div class="icon" style="background:linear-gradient(135deg,#22d3ee 0%,#6366f1 100%);"><i class="fas fa-percent"></i></div>
        <div>
            <div class="stat-title">إجمالي الخصومات</div>
            <div class="stat-value" style="color:#22d3ee;">{{ number_format($totalDiscount, 2) }} د.ك</div>
            <div class="stat-desc">الخصومات المطبقة</div>
        </div>
    </div>
    <div class="stats-card">
        <div class="icon" style="background:linear-gradient(135deg,#22d3ee 0%,#6366f1 100%);"><i class="fas fa-balance-scale"></i></div>
        <div>
            <div class="stat-title">المبلغ المتبقي/المستحق</div>
            <div class="stat-value" style="color:{{ $outstanding > 0 ? '#ef4444' : '#22c55e' }};">{{ number_format($outstanding, 2) }} د.ك</div>
            <div class="stat-desc {{ $outstanding > 0 ? 'negative' : '' }}">{{ $outstanding > 0 ? 'مستحق' : 'مدفوع بالكامل' }}</div>
        </div>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

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
                                @elseif($payment->type == 'refund')
                                    <span class="badge bg-success">استرداد</span>
                                @elseif($payment->type == 'discount')
                                    <span class="badge bg-danger">خصم</span>
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