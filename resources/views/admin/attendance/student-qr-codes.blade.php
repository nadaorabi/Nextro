@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1 fw-bold" style="color:#5f5aad">
                        <i class="fas fa-qrcode text-primary me-2"></i>
                        QR Codes للطلاب
                    </h2>
                    <div class="text-muted small">{{ $schedule->course->title }} - {{ __(ucfirst($schedule->day_of_week)) }}</div>
                </div>
                <div>
                    <a href="{{ route('admin.attendance.take', $schedule->id) }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-camera me-1"></i> أخذ الحضور
                    </a>
                    <a href="{{ route('admin.attendance.schedule-details', $schedule->id) }}" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-1"></i> التفاصيل
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

            <!-- QR Cards Grid -->
            <div class="row g-3">
                @foreach($studentsData as $studentData)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card shadow-sm border-0 h-100 d-flex flex-column align-items-center p-3">
                        <div class="mb-2">
                            <img src="{{ asset($studentData['student']->avatar ?? 'images/default-avatar.png') }}"
                                 class="avatar avatar-md rounded-circle mb-2"
                                 style="width:60px;height:60px;object-fit:cover"
                                 onerror="this.src='{{ asset('images/default-avatar.png') }}'"
                                 alt="{{ $studentData['student']->name }}">
                        </div>
                        <div class="mb-2">
                            <div id="qr-{{ $studentData['student']->id }}" style="width:110px;height:110px;"></div>
                        </div>
                        <div class="fw-bold mb-1" style="color:#5f5aad">{{ $studentData['student']->name }}</div>
                        <div class="text-muted small mb-1">ID: {{ $studentData['student']->login_id }}</div>
                        <div class="mb-2">
                            @if($studentData['status'] === 'present')
                                <span class="badge bg-success">حاضر</span>
                            @else
                                <span class="badge bg-danger">غائب</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach($studentsData as $studentData)
        QRCode.toCanvas(document.getElementById('qr-{{ $studentData['student']->id }}'), '{{ $studentData['student']->login_id }}', {
            width: 110,
            height: 110,
            margin: 1,
            color: {
                dark: '#000000',
                light: '#FFFFFF'
            }
        }, function (error) {
            if (error) console.error(error);
        });
    @endforeach
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

h2, .fw-bold {
    font-family: inherit;
}

@media (max-width: 576px) {
    .card {
        padding: 0.5rem !important;
    }
}
</style>
@endsection 