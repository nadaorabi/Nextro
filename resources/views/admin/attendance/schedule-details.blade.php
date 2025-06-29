@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1 fw-bold" style="color:#5f5aad">
                        <i class="fas fa-list text-primary me-2"></i>
                        تفاصيل الحضور والغياب
                    </h2>
                    <div class="text-muted small">{{ $schedule->course->title }} - {{ __(ucfirst($schedule->day_of_week)) }}</div>
                </div>
                <div>
                    <a href="{{ route('admin.attendance.take', $schedule->id) }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-camera me-1"></i> أخذ الحضور
                    </a>
                    <a href="{{ route('admin.attendance.qr-codes', $schedule->id) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-qrcode me-1"></i> QR Codes
                    </a>
                </div>
            </div>

            <!-- Lecture Info (Simple) -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body d-flex flex-wrap gap-4 align-items-center justify-content-between">
                    <div><strong>المادة:</strong> {{ $schedule->course->title }}</div>
                    <div><strong>اليوم:</strong> {{ __(ucfirst($schedule->day_of_week)) }}</div>
                    <div><strong>الوقت:</strong> {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</div>
                    <div><strong>القاعة:</strong> {{ $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name) : 'غير محدد' }}</div>
                </div>
            </div>

            <!-- Students Table -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>الطالب</th>
                                    <th>Login ID</th>
                                    <th>الحالة</th>
                                    <th>طريقة التسجيل</th>
                                    <th>وقت التسجيل</th>
                                    <th class="text-center">إجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($studentsData as $studentData)
                                <tr>
                                    <td class="fw-bold" style="color:#5f5aad">{{ $studentData['student']->name }}</td>
                                    <td class="text-muted">{{ $studentData['student']->login_id }}</td>
                                    <td>
                                        @if($studentData['status'] === 'present')
                                            <span class="badge bg-success">حاضر</span>
                                        @else
                                            <span class="badge bg-danger">غائب</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($studentData['method'])
                                            <span class="badge bg-info">{{ $studentData['method'] }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($studentData['time'])
                                            <span class="badge bg-light text-dark">{{ $studentData['time'] }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($studentData['status'] === 'present')
                                            <button class="btn btn-sm btn-outline-danger mark-absent-btn" 
                                                    data-enrollment="{{ $studentData['enrollment']->id }}"
                                                    data-schedule="{{ $schedule->id }}"
                                                    data-date="{{ date('Y-m-d') }}">
                                                <i class="fas fa-times me-1"></i> تسجيل غياب
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-outline-success mark-present-btn"
                                                    data-enrollment="{{ $studentData['enrollment']->id }}"
                                                    data-schedule="{{ $schedule->id }}"
                                                    data-date="{{ date('Y-m-d') }}">
                                                <i class="fas fa-check me-1"></i> تسجيل حضور
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mark Present
    document.querySelectorAll('.mark-present-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const enrollmentId = this.dataset.enrollment;
            const scheduleId = this.dataset.schedule;
            const date = this.dataset.date;
            fetch("{{ route('admin.attendance.mark-present') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    enrollment_id: enrollmentId,
                    schedule_id: scheduleId,
                    date: date
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء تسجيل الحضور');
            });
        });
    });
    // Mark Absent
    document.querySelectorAll('.mark-absent-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const enrollmentId = this.dataset.enrollment;
            const scheduleId = this.dataset.schedule;
            const date = this.dataset.date;
            fetch("{{ route('admin.attendance.mark-absent') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    enrollment_id: enrollmentId,
                    schedule_id: scheduleId,
                    date: date
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء تسجيل الغياب');
            });
        });
    });
});
</script>

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