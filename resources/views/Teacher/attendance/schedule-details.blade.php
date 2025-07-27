@extends('layouts.teacher')

@section('title', 'Schedule Attendance Details')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12" style="max-width:1200px;margin:auto;">
      
      <!-- Header Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Schedule Attendance Details</h4>
              <p class="text-muted mb-0">{{ $schedule->course->title }} - {{ __(ucfirst($schedule->day_of_week)) }}</p>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ route('teacher.attendance.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Attendance
              </a>
              <a href="{{ route('teacher.attendance.take', $schedule->id) }}" class="btn btn-primary">
                <i class="fas fa-camera"></i> Take Attendance
              </a>
              <a href="{{ route('teacher.attendance.qr-codes', $schedule->id) }}" class="btn btn-info">
                <i class="fas fa-qrcode"></i> QR Codes
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

      <!-- Attendance Statistics -->
      <div class="row mb-4">
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-primary">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-users"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number">{{ $totalStudents }}</div>
                <div class="stats-label">Total Students</div>
                <div class="stats-description">Enrolled in course</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-success">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number">{{ $presentCount }}</div>
                <div class="stats-label">Present</div>
                <div class="stats-description">Students present</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-danger">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-exclamation-circle"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number">{{ $absentCount }}</div>
                <div class="stats-label">Absent</div>
                <div class="stats-description">Students absent</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-warning">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-clock"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number">{{ $pendingCount }}</div>
                <div class="stats-label">Pending</div>
                <div class="stats-description">Not marked yet</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
      </div>

      <!-- Students Table -->
      <div class="card shadow-sm">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Students Attendance Status</h5>
            <span class="text-muted">{{ count($studentsData) }} students enrolled</span>
          </div>
        </div>
        <div class="card-body p-0">
          @if(count($studentsData) > 0)
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead>
                  <tr>
                    <th>Student</th>
                    <th>Login ID</th>
                    <th>Status</th>
                    <th>Check-in Method</th>
                    <th>Check-in Time</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($studentsData as $studentData)
                    <tr>
                      <td>
                        <div class="fw-bold">{{ $studentData['student']->name }}</div>
                      </td>
                      <td>
                        <span class="text-muted">{{ $studentData['student']->login_id }}</span>
                      </td>
                      <td>
                        @if($studentData['status'] === 'present')
                          <span class="badge bg-success">Present</span>
                        @elseif($studentData['status'] === 'absent')
                          <span class="badge bg-danger">Absent</span>
                        @elseif($studentData['status'] === 'pending')
                          <span class="badge bg-warning">Pending</span>
                        @else
                          <span class="badge bg-secondary">Not Set</span>
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
                      <td>
                        <div class="d-flex gap-1">
                          @if($studentData['status'] === 'present')
                            <button class="btn btn-sm btn-outline-danger mark-absent-btn" 
                                    data-enrollment="{{ $studentData['enrollment']->id }}"
                                    data-schedule="{{ $schedule->id }}"
                                    data-date="{{ date('Y-m-d') }}">
                              <i class="fas fa-times me-1"></i> Mark Absent
                            </button>
                          @elseif($studentData['status'] === 'absent')
                            <button class="btn btn-sm btn-outline-success mark-present-btn"
                                    data-enrollment="{{ $studentData['enrollment']->id }}"
                                    data-schedule="{{ $schedule->id }}"
                                    data-date="{{ date('Y-m-d') }}">
                              <i class="fas fa-check me-1"></i> Mark Present
                            </button>
                          @else
                            <button class="btn btn-sm btn-success mark-present-btn"
                                    data-enrollment="{{ $studentData['enrollment']->id }}"
                                    data-schedule="{{ $schedule->id }}"
                                    data-date="{{ date('Y-m-d') }}">
                              <i class="fas fa-check me-1"></i> Present
                            </button>
                            <button class="btn btn-sm btn-danger mark-absent-btn" 
                                    data-enrollment="{{ $studentData['enrollment']->id }}"
                                    data-schedule="{{ $schedule->id }}"
                                    data-date="{{ date('Y-m-d') }}">
                              <i class="fas fa-times me-1"></i> Absent
                            </button>
                          @endif
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mark Present
    document.querySelectorAll('.mark-present-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const enrollmentId = this.dataset.enrollment;
            const scheduleId = this.dataset.schedule;
            const date = this.dataset.date;
            fetch("{{ route('teacher.attendance.mark-present') }}", {
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
                alert('An error occurred while marking attendance');
            });
        });
    });
    
    // Mark Absent
    document.querySelectorAll('.mark-absent-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const enrollmentId = this.dataset.enrollment;
            const scheduleId = this.dataset.schedule;
            const date = this.dataset.date;
            fetch("{{ route('teacher.attendance.mark-absent') }}", {
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
                alert('An error occurred while marking attendance');
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
    font-size: 0.85rem;
    border-radius: 12px;
    padding: 0.4em 0.8em;
}

.table thead th {
    font-weight: bold;
    color: #344767;
    background: #f8f9fa !important;
    border-bottom: 2px solid #e9ecef;
}

.table td, .table th {
    vertical-align: middle;
    padding: 1rem 0.75rem;
}

/* Stats Cards */
.stats-card {
    position: relative;
    border-radius: 20px;
    padding: 1.5rem;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: none;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
}

.stats-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.18);
}

.stats-card-body {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stats-content {
    flex: 1;
}

.stats-number {
    font-size: 2rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.stats-label {
    font-weight: 600;
    color: #344767;
    margin-bottom: 0.25rem;
}

.stats-description {
    font-size: 0.875rem;
    color: #6c757d;
}

.stats-card-decoration {
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    transform: translate(30px, -30px);
}

.stats-card-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.stats-card-success {
    background: linear-gradient(135deg, #2dce89 0%, #2dcecc 100%);
    color: white;
}

.stats-card-danger {
    background: linear-gradient(135deg, #f5365c 0%, #f56036 100%);
    color: white;
}

.stats-card-warning {
    background: linear-gradient(135deg, #fb6340 0%, #fbb140 100%);
    color: white;
}

.stats-card-info {
    background: linear-gradient(135deg, #11cdef 0%, #1171ef 100%);
    color: white;
}

@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    .d-flex.gap-1 {
        flex-direction: column;
        gap: 0.25rem !important;
    }
    
    .stats-card {
        margin-bottom: 1rem;
    }
    
    .stats-number {
        font-size: 1.5rem;
    }
}
</style>
@endsection 