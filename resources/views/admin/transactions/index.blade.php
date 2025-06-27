@extends('layouts.admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<div class="container py-4">
    <div class="mb-4">
        <h2 class="fw-bold mb-2" style="color:#2563eb"><i class="fas fa-money-check-alt me-2"></i>جميع الحركات المالية</h2>
        <div class="text-muted mb-3">إدارة ومراجعة جميع المعاملات المالية للطلاب والأساتذة في النظام</div>
    </div>
    <!-- Filter Bar -->
    <div class="card shadow-sm mb-4 p-3" style="border-radius:18px;background:linear-gradient(90deg,#f1f5fb 0%,#e3eafe 100%);">
        <form class="row g-2 align-items-center" id="filterForm" method="get">
            <div class="col-md-3 col-12">
                <input type="text" name="search" class="form-control" placeholder="بحث بالاسم أو الملاحظات..." value="{{ request('search') }}" style="border-radius:12px;">
            </div>
            <div class="col-md-2 col-6">
                <select name="role" class="form-select" style="border-radius:12px;">
                    <option value="">نوع الحساب</option>
                    <option value="student" @if(request('role')=='student') selected @endif>طالب</option>
                    <option value="teacher" @if(request('role')=='teacher') selected @endif>أستاذ</option>
                </select>
            </div>
            <div class="col-md-2 col-6">
                <select name="user_id" class="form-select" style="border-radius:12px;">
                    <option value="">كل المستخدمين</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" @if(request('user_id')==$u->id) selected @endif>{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-6">
                <select name="course_id" class="form-select" style="border-radius:12px;">
                    <option value="">كل المواد</option>
                    @foreach($courses as $c)
                        <option value="{{ $c->id }}" @if(request('course_id')==$c->id) selected @endif>{{ $c->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-6">
                <select name="package_id" class="form-select" style="border-radius:12px;">
                    <option value="">كل البكجات</option>
                    @foreach($packages as $p)
                        <option value="{{ $p->id }}" @if(request('package_id')==$p->id) selected @endif>{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 col-6">
                <select name="type" class="form-select" style="border-radius:12px;">
                    <option value="">كل الأنواع</option>
                    <option value="course_enrollment" @if(request('type')=='course_enrollment') selected @endif>تسجيل كورس</option>
                    <option value="package_enrollment" @if(request('type')=='package_enrollment') selected @endif>تسجيل بكج</option>
                    <option value="payment" @if(request('type')=='payment') selected @endif>دفعة</option>
                    <option value="refund" @if(request('type')=='refund') selected @endif>استرداد</option>
                    <option value="salary" @if(request('type')=='salary') selected @endif>راتب أستاذ</option>
                    <!-- أضف أنواع أخرى حسب الحاجة -->
                </select>
            </div>
            <div class="col-md-2 col-6">
                <input type="date" name="from" class="form-control" value="{{ request('from') }}" style="border-radius:12px;">
            </div>
            <div class="col-md-2 col-6">
                <input type="date" name="to" class="form-control" value="{{ request('to') }}" style="border-radius:12px;">
            </div>
            <div class="col-md-2 col-12">
                <button type="submit" class="btn btn-primary w-100" style="border-radius:12px;"><i class="fas fa-filter me-1"></i> فلترة</button>
            </div>
            <div class="col-md-2 col-12">
                <button type="button" class="btn btn-success w-100" style="border-radius:12px;"><i class="fas fa-plus"></i> إضافة معاملة</button>
            </div>
        </form>
    </div>
    <!-- Table -->
    <div class="card shadow-sm" style="border-radius:18px;">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>نوع الحساب</th>
                        <th>نوع المعاملة</th>
                        <th>المبلغ</th>
                        <th>التاريخ</th>
                        <th>ملاحظات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $pay)
                        <tr>
                            <td>{{ $pay->id }}</td>
                            <td>{{ $pay->user->name ?? '-' }}</td>
                            <td>
                                @if($pay->user)
                                    <span class="badge {{ $pay->user->role=='student' ? 'bg-primary' : 'bg-success' }}">{{ $pay->user->role=='student' ? 'طالب' : 'أستاذ' }}</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($pay->type=='course_enrollment')
                                    <span class="badge bg-info">تسجيل كورس</span>
                                @elseif($pay->type=='package_enrollment')
                                    <span class="badge bg-info">تسجيل بكج</span>
                                @elseif($pay->type=='payment')
                                    <span class="badge bg-success">دفعة</span>
                                @elseif($pay->type=='refund')
                                    <span class="badge bg-warning text-dark">استرداد</span>
                                @elseif($pay->type=='salary')
                                    <span class="badge bg-dark">راتب أستاذ</span>
                                @else
                                    <span class="badge bg-secondary">{{ $pay->type }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold {{ $pay->amount > 0 ? 'text-success' : 'text-danger' }}">{{ number_format($pay->amount,2) }}</span>
                            </td>
                            <td>{{ $pay->payment_date ? date('Y-m-d', strtotime($pay->payment_date)) : '-' }}</td>
                            <td>{{ $pay->notes }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">لا توجد حركات مالية</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $payments->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
<style>
.table th, .table td { vertical-align: middle !important; }
</style> 