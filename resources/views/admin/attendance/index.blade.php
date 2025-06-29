@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1 fw-bold" style="color:#5f5aad">
                        <i class="fas fa-clipboard-check text-primary me-2"></i>
                        إدارة الحضور والغياب
                    </h2>
                    <div class="text-muted small">اختر المادة والمحاضرة لأخذ الحضور أو عرض التفاصيل</div>
                </div>
                <div>
                    <a href="{{ route('admin.attendance.details') }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-list me-1"></i> تفاصيل الحضور
                    </a>
                    <a href="{{ route('admin.attendance.export') }}" class="btn btn-outline-success">
                        <i class="fas fa-download me-1"></i> تصدير البيانات
                    </a>
                </div>
            </div>

            <!-- Courses List -->
            @forelse($courses as $course)
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                        <div class="fw-bold" style="color:#5f5aad;font-size:1.1rem">
                            <i class="fas fa-book me-2"></i>{{ $course->title }}
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="text-muted small">
                                <i class="fas fa-users me-1"></i>{{ $course->enrollments_count ?? 0 }} طالب
                            </div>
                            <div>
                                @foreach($course->courseInstructors as $courseInstructor)
                                    <span class="badge bg-light text-dark me-1">
                                        <i class="fas fa-chalkboard-teacher me-1"></i>{{ $courseInstructor->instructor->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <!-- معلومات المسار والباكج -->
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        @if($course->category)
                            <span class="badge bg-primary">
                                <i class="fas fa-folder me-1"></i>{{ $course->category->name }}
                            </span>
                        @endif
                        @if($course->packages_count > 0)
                            <span class="badge bg-success">
                                <i class="fas fa-box me-1"></i>باكج ({{ $course->packages_count }})
                            </span>
                        @endif
                        @if($course->is_free)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-gift me-1"></i>مجاني
                            </span>
                        @else
                            <span class="badge bg-info">
                                <i class="fas fa-dollar-sign me-1"></i>{{ $course->price ?? 0 }} {{ $course->currency ?? 'ر.س' }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- تفاصيل الباكجات المرتبطة -->
                    @if($course->packages && $course->packages->count() > 0)
                        <div class="mb-3">
                            <small class="text-muted fw-bold">
                                <i class="fas fa-boxes me-1"></i>الباكجات المرتبطة:
                            </small>
                            <div class="d-flex flex-wrap gap-1 mt-1">
                                @foreach($course->packages as $package)
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-box me-1"></i>{{ $package->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- وصف الكورس -->
                    @if($course->description)
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>{{ Str::limit($course->description, 150) }}
                            </small>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>اليوم</th>
                                    <th>الوقت</th>
                                    <th>القاعة</th>
                                    <th>الكلي / الحضور</th>
                                    <th class="text-center">إجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($course->schedules as $schedule)
                                <tr>
                                    <td>{{ __(ucfirst($schedule->day_of_week)) }}</td>
                                    <td>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
                                    <td>{{ $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name) : 'غير محدد' }}</td>
                                    <td class="text-center">
                                        @php $stat = $scheduleStats[$schedule->id] ?? null; @endphp
                                        @if($stat)
                                            <span style="color:#5f5aad;font-weight:bold;font-size:1.15em">{{ $stat['students'] }}</span>
                                            <span style="color:#888;font-size:1.1em">/</span>
                                            <span style="color:#28a745;font-weight:bold;font-size:1.15em">{{ $stat['present'] }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.attendance.take', $schedule->id) }}" class="btn btn-outline-primary btn-sm me-1">
                                            <i class="fas fa-camera me-1"></i> أخذ الحضور
                                        </a>
                                        <a href="{{ route('admin.attendance.qr-codes', $schedule->id) }}" class="btn btn-outline-info btn-sm me-1">
                                            <i class="fas fa-qrcode me-1"></i> QR Codes
                                        </a>
                                        <a href="{{ route('admin.attendance.schedule-details', $schedule->id) }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-list me-1"></i> التفاصيل
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-muted text-center">لا توجد محاضرات مجدولة لهذه المادة</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @empty
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-book-open text-muted mb-3" style="font-size: 4rem;"></i>
                    <h4 class="text-muted">لا توجد مواد دراسية</h4>
                    <p class="text-muted">لم يتم إضافة أي مواد دراسية بعد</p>
                </div>
            </div>
            @endforelse
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

.badge.bg-primary {
    background-color: #5f5aad !important;
}

.badge.bg-success {
    background-color: #28a745 !important;
}

.badge.bg-warning {
    background-color: #ffc107 !important;
}

.badge.bg-info {
    background-color: #17a2b8 !important;
}

.badge.bg-light {
    background-color: #f8f9fa !important;
    color: #6c757d !important;
    border: 1px solid #dee2e6 !important;
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

.btn-outline-primary, .btn-outline-secondary, .btn-outline-danger, .btn-outline-success, .btn-outline-info {
    border-radius: 8px;
    font-weight: 500;
}

.gap-1 { gap: 0.25rem !important; }
.gap-2 { gap: 0.5rem !important; }
.gap-3 { gap: 1rem !important; }

@media (max-width: 576px) {
    .card {
        padding: 0.5rem !important;
    }
    .table-responsive {
        font-size: 0.95rem;
    }
    .badge {
        font-size: 0.8rem;
        padding: 0.3em 0.8em;
    }
}
</style>
@endsection 