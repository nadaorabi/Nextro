@extends('layouts.admin')

@section('title', 'Student QR Codes')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12" style="max-width:1200px;margin:auto;">
      
      <!-- Header Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0"><i class="fas fa-qrcode me-2"></i>Student QR Codes</h4>
              <p class="text-muted mb-0">{{ $schedule->course->title }} - {{ __(ucfirst($schedule->day_of_week)) }}</p>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Attendance
              </a>
              <a href="{{ route('admin.attendance.take', $schedule->id) }}" class="btn btn-primary">
                <i class="fas fa-camera"></i> Take Attendance
              </a>
              <a href="{{ route('admin.attendance.schedule-details', $schedule->id) }}" class="btn btn-outline-secondary">
                <i class="fas fa-list"></i> Details
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Schedule Info Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-header">
          <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Schedule Information</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <div>
                <small class="text-muted">Course:</small><br>
                <span class="fw-bold">{{ $schedule->course->title }}</span>
              </div>
            </div>
            <div class="col-md-2">
              <div>
                <small class="text-muted">Day:</small><br>
                <span class="fw-bold">{{ __(ucfirst($schedule->day_of_week)) }}</span>
              </div>
            </div>
            <div class="col-md-3">
              <div>
                <small class="text-muted">Time:</small><br>
                <span class="fw-bold">{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</span>
              </div>
            </div>
            <div class="col-md-4">
              <div>
                <small class="text-muted">Room:</small><br>
                <span class="fw-bold">{{ $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name) : 'Not Assigned' }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- QR Codes Grid -->
      <div class="card shadow-sm">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Student QR Codes</h5>
            <span class="text-muted">{{ count($studentsData) }} students enrolled</span>
          </div>
        </div>
        <div class="card-body">
          @if(count($studentsData) > 0)
            <div class="row g-4">
              @foreach($studentsData as $studentData)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                  <div class="card border-0 h-100 text-center p-3" style="box-shadow: 0 2px 15px rgba(0,0,0,0.1);">
                    <div class="mb-3">
                      <img src="{{ asset($studentData['student']->avatar ?? 'images/default-avatar.png') }}"
                           class="rounded-circle mb-2"
                           style="width:60px;height:60px;object-fit:cover"
                           onerror="this.src='{{ asset('images/default-avatar.png') }}'"
                           alt="{{ $studentData['student']->name }}">
                    </div>
                    <div class="mb-3">
                      <div id="qr-{{ $studentData['student']->id }}" style="width:120px;height:120px;margin:0 auto;"></div>
                    </div>
                    <div class="mb-2">
                      <div class="fw-bold text-primary">{{ $studentData['student']->name }}</div>
                      <div class="text-muted small">ID: {{ $studentData['student']->login_id }}</div>
                    </div>
                    <div class="mb-0">
                      @if($studentData['status'] === 'present')
                        <span class="badge bg-success">Present</span>
                      @elseif($studentData['status'] === 'absent')
                        <span class="badge bg-danger">Absent</span>
                      @elseif($studentData['status'] === 'pending')
                        <span class="badge bg-warning">Pending</span>
                      @else
                        <span class="badge bg-secondary">Not Set</span>
                      @endif
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <div class="text-center py-5 text-muted">
              <i class="fas fa-users fa-3x mb-3"></i>
              <h5>No Students Enrolled</h5>
              <p>No students are enrolled in this course schedule</p>
            </div>
          @endif
        </div>
      </div>

    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    @foreach($studentsData as $studentData)
        QRCode.toCanvas(document.getElementById('qr-{{ $studentData['student']->id }}'), '{{ $studentData['student']->login_id }}', {
            width: 120,
            height: 120,
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
    font-size: 0.85rem;
    border-radius: 12px;
    padding: 0.4em 0.8em;
}

@media (max-width: 768px) {
    .row.g-4 > * {
        margin-bottom: 1rem;
    }
}
</style>
@endsection 