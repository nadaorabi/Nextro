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
    gap: 24px;
    margin-bottom: 32px;
    flex-wrap: wrap;
}
.stats-card {
    flex: 1 1 220px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 2px 12px rgba(44,62,80,0.09);
    padding: 28px 18px 22px 18px;
    display: flex;
    align-items: center;
    min-width: 220px;
    position: relative;
}
.stats-card .icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, #e0e7ff 0%, #6366f1 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.7rem;
    color: #fff;
    margin-left: 18px;
    box-shadow: 0 2px 8px rgba(99,102,241,0.10);
}
.stats-card .stat-title {
    color: #64748b;
    font-size: 1.05rem;
    font-weight: 600;
    margin-bottom: 2px;
}
.stats-card .stat-value {
    font-size: 2.1rem;
    font-weight: 800;
    color: #6366f1;
    margin-bottom: 2px;
}
.stats-card .stat-desc {
    font-size: 1rem;
    color: #22c55e;
    font-weight: 600;
}
.stats-card .stat-desc.negative {
    color: #ef4444;
}

@media (max-width: 991px) {
    .stats-row { flex-direction: column; gap: 16px; }
    .stats-card { min-width: 0; }
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
    .merged-card .info { min-width: 0; }
    .merged-card .info .details-row { flex-direction: column; gap: 8px; }
}
</style>

<div class="merged-card">
    <div class="header-row">
        <div class="header-title">
            <i class="fas fa-chalkboard-teacher"></i>
            Financial Account for {{ $teacher->name }}
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.accounts.teachers.list') }}" class="action-btn back-btn">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
            <button type="button" class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                <i class="fas fa-plus me-2"></i> إضافة معاملة مالية
            </button>
        </div>
    </div>
    <div class="header-desc">Manage financial transactions for: {{ $teacher->name }}</div>
    <div class="main-row">
        <div class="info">
           
            <div class="details-row">
                <div class="detail"><i class="fas fa-id-card"></i> {{ $teacher->national_id ?? 'Not set' }}</div>
                <div class="detail"><i class="fas fa-phone"></i> {{ $teacher->mobile ?? 'Not set' }}</div>
                <div class="detail"><i class="fas fa-envelope"></i> {{ $teacher->email ?? 'Not set' }}</div>
            </div>
        </div>
        <div class="balance">
         
        </div>
    </div>
</div>

<div class="stats-row">
    <div class="stats-card">
        <div class="icon"><i class="fas fa-coins"></i></div>
        <div>
            <div class="stat-title">إجمالي الأرباح</div>
            <div class="stat-value">{{ number_format($totalEarnings, 2) }} د.ك</div>
            <div class="stat-desc">+{{ number_format($totalEarnings, 2) }} هذا الشهر</div>
        </div>
    </div>
    <div class="stats-card">
        <div class="icon" style="background:linear-gradient(135deg,#f87171 0%,#ef4444 100%);"><i class="fas fa-credit-card"></i></div>
        <div>
            <div class="stat-title">إجمالي الدفعات</div>
            <div class="stat-value" style="color:#ef4444;">{{ number_format(abs($totalPayouts), 2) }} د.ك</div>
            <div class="stat-desc negative">-{{ number_format(abs($totalPayouts), 2) }} هذا الشهر</div>
        </div>
    </div>
    <div class="stats-card">
        <div class="icon" style="background:linear-gradient(135deg,#22d3ee 0%,#6366f1 100%);"><i class="fas fa-calculator"></i></div>
        <div>
            <div class="stat-title">صافي الرصيد</div>
            <div class="stat-value" style="color:{{ $netBalance >= 0 ? '#22c55e' : '#ef4444' }};">{{ number_format($netBalance, 2) }} د.ك</div>
            <div class="stat-desc {{ $netBalance >= 0 ? '' : 'negative' }}">{{ $netBalance >= 0 ? 'رصيد إيجابي' : 'رصيد سلبي' }}</div>
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