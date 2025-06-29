@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1 fw-bold" style="color:#5f5aad">
                        <i class="fas fa-chart-bar text-primary me-2"></i>
                        تقارير الحضور والغياب
                    </h2>
                    <div class="text-muted small">عرض وتصفية سجلات الحضور والغياب</div>
                </div>
                <div>
                    <a href="{{ route('admin.attendance.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> العودة
                    </a>
                    <a href="{{ route('admin.attendance.export') }}" class="btn btn-outline-success">
                        <i class="fas fa-download me-1"></i> تصدير البيانات
                    </a>
                </div>
            </div>

            <!-- Filters Card -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.attendance.details') }}" class="row g-3 align-items-end">
                        <div class="col-md-3 col-6">
                            <label class="form-label">المادة</label>
                            <select name="course_id" class="form-select">
                                <option value="">جميع المواد</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" {{ $courseId == $course->id ? 'selected' : '' }}>
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label">المحاضرة</label>
                            <select name="schedule_id" class="form-select">
                                <option value="">جميع المحاضرات</option>
                                @foreach($schedules as $schedule)
                                    <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : '' }}>
                                        {{ $schedule->course->title }} - {{ __(ucfirst($schedule->day_of_week)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-6">
                            <label class="form-label">التاريخ</label>
                            <input type="date" name="date" class="form-control" value="{{ $date }}">
                        </div>
                        <div class="col-md-2 col-6">
                            <label class="form-label">الحالة</label>
                            <select name="status" class="form-select">
                                <option value="all" {{ $status == 'all' ? 'selected' : '' }}>جميع الحالات</option>
                                <option value="present" {{ $status == 'present' ? 'selected' : '' }}>حاضر</option>
                                <option value="absent" {{ $status == 'absent' ? 'selected' : '' }}>غائب</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-12">
                            <label class="form-label">البحث</label>
                            <input type="text" name="search" class="form-control" placeholder="اسم الطالب أو Login ID" value="{{ $search }}">
                        </div>
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-1"></i> تطبيق الفلاتر
                            </button>
                            <a href="{{ route('admin.attendance.details') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> إعادة تعيين
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    @if(count($attendanceRecords) > 0)
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>الطالب</th>
                                    <th>Login ID</th>
                                    <th>المادة</th>
                                    <th>المحاضرة</th>
                                    <th>بداية المحاضرة</th>
                                    <th>التاريخ</th>
                                    <th>الحالة</th>
                                    <th>طريقة التسجيل</th>
                                    <th>وقت التسجيل</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendanceRecords as $record)
                                <tr>
                                    <td class="fw-bold" style="color:#5f5aad">{{ $record['student']->name }}</td>
                                    <td class="text-muted">{{ $record['student']->login_id }}</td>
                                    <td>{{ $record['course']->title }}</td>
                                    <td>
                                        @if(isset($record['schedule']))
                                            {{ __(ucfirst($record['schedule']->day_of_week)) }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($record['schedule']))
                                            {{ $record['schedule']->start_time ? substr($record['schedule']->start_time, 0, 5) : '-' }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $record['date'] }}</td>
                                    <td>
                                        @if($record['status'] === 'present')
                                            <span class="badge bg-success">حاضر</span>
                                        @else
                                            <span class="badge bg-danger">غائب</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($record['method'])
                                            <span class="badge bg-info">{{ $record['method'] }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($record['time'])
                                            <span class="badge bg-light text-dark">{{ $record['time'] }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-search mb-3" style="font-size: 3rem;"></i>
                        <div>لا توجد نتائج</div>
                        <div class="small">جرب تغيير معايير البحث للحصول على نتائج</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    border: none;
}

.badge {
    font-size: 0.9rem;
    border-radius: 12px;
    padding: 0.4em 1em;
}

.table thead th {
    font-weight: bold;
    color: #5f5aad;
    background: #f8f9fb !important;
    border-bottom: 2px solid #e9ecef;
}

.table td, .table th {
    vertical-align: middle;
}

.btn-outline-primary, .btn-outline-secondary, .btn-outline-danger, .btn-outline-success {
    border-radius: 8px;
    font-weight: 500;
}

@media (max-width: 576px) {
    .card {
        padding: 0.5rem !important;
    }
    .table-responsive {
        font-size: 0.95rem;
    }
}
</style>
@endsection 