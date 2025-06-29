@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Student QR Codes - {{ $schedule->course->title }}</h2>
        <a href="{{ route('admin.attendance.take', $schedule->id) }}" class="btn btn-primary">
            <i class="fas fa-camera me-1"></i> Take Attendance
        </a>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Schedule Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <strong>Course:</strong> {{ $schedule->course->title }}
                </div>
                <div class="col-md-3">
                    <strong>Day:</strong> {{ $schedule->day_of_week }}
                </div>
                <div class="col-md-3">
                    <strong>Time:</strong> {{ $schedule->start_time }} - {{ $schedule->end_time }}
                </div>
                <div class="col-md-3">
                    <strong>Room:</strong> {{ $schedule->room->name ?? $schedule->room->room_number ?? 'N/A' }}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($enrollments as $enrollment)
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card h-100">
                <div class="card-header text-center">
                    <h6 class="mb-0">{{ $enrollment->student->name }}</h6>
                </div>
                <div class="card-body text-center">
                    <div id="qr-{{ $enrollment->student->id }}" class="mb-3"></div>
                    <small class="text-muted">login_id: {{ $enrollment->student->login_id }}</small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach($enrollments as $enrollment)
        QRCode.toCanvas(document.getElementById('qr-{{ $enrollment->student->id }}'), '{{ $enrollment->student->login_id }}', {
            width: 150,
            height: 150,
            margin: 2,
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
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
}

.card:hover {
    transform: translateY(-2px);
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px 15px 0 0 !important;
}

#qr-{{ $enrollment->student->id ?? 'placeholder' }} {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 150px;
}
</style>
@endsection 