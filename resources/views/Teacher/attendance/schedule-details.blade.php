@extends('layouts.teacher')
@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <!-- Header with white background -->
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-2 fw-bold" style="color:#5f5aad">
                                <i class="fas fa-clipboard-check text-primary me-2"></i>
                                Attendance Details - {{ $schedule->course->title }}
                            </h2>
                            <div class="text-muted small">
                                {{ \Carbon\Carbon::parse($schedule->session_date)->format('Y-m-d') }} - 
                                {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('teacher.attendance.details') }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>
                            <a href="{{ route('teacher.attendance.export') }}" class="btn btn-outline-success">
                                <i class="fas fa-download me-1"></i> Export Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ $enrollments->count() }}</h4>
                                    <small>Total Students</small>
                                </div>
                                <div>
                                    <i class="fas fa-users fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ $attendances->where('status', 'present')->count() }}</h4>
                                    <small>Present</small>
                                </div>
                                <div>
                                    <i class="fas fa-check-circle fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ $enrollments->count() - $attendances->where('status', 'present')->count() }}</h4>
                                    <small>Absent</small>
                                </div>
                                <div>
                                    <i class="fas fa-times-circle fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ $attendances->where('status', 'present')->count() > 0 ? round(($attendances->where('status', 'present')->count() / $enrollments->count()) * 100, 1) : 0 }}%</h4>
                                    <small>Attendance Rate</small>
                                </div>
                                <div>
                                    <i class="fas fa-percentage fa-2x opacity-75"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Students List -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        Students List
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Student</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Marked Time</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($enrollments as $enrollment)
                                @php
                                    $attendance = $attendances->where('student_id', $enrollment->student_id)->first();
                                    $status = $attendance ? $attendance->status : 'absent';
                                @endphp
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm rounded-circle me-3">
                                                <img src="{{ asset('images/defaults/default-student.jpg') }}" alt="Avatar" class="rounded-circle" width="40">
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $enrollment->student->name }}</h6>
                                                <small class="text-muted">ID: {{ $enrollment->student->login_id ?? 'N/A' }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $enrollment->student->email }}</td>
                                    <td>{{ $enrollment->student->mobile ?? 'Not specified' }}</td>
                                    <td>
                                        @if($status == 'present')
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i> Present
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="fas fa-times me-1"></i> Absent
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($attendance && $attendance->marked_at)
                                            {{ \Carbon\Carbon::parse($attendance->marked_at)->format('H:i A') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($status == 'present')
                                            <button class="btn btn-outline-danger btn-sm" onclick="markAbsent({{ $enrollment->student_id }}, {{ $schedule->id }})">
                                                <i class="fas fa-times me-1"></i> Absent
                                            </button>
                                        @else
                                            <button class="btn btn-outline-success btn-sm" onclick="markPresent({{ $enrollment->student_id }}, {{ $schedule->id }})">
                                                <i class="fas fa-check me-1"></i> Present
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-muted text-center">No students enrolled in this course</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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

.avatar {
    width: 40px;
    height: 40px;
    object-fit: cover;
}
</style>

<script>
function markPresent(studentId, scheduleId) {
    if (confirm('Do you want to mark this student as present?')) {
        fetch('/teacher/attendance/mark-present', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                student_id: studentId,
                schedule_id: scheduleId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while marking attendance');
        });
    }
}

function markAbsent(studentId, scheduleId) {
    if (confirm('Do you want to mark this student as absent?')) {
        fetch('/teacher/attendance/mark-absent', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                student_id: studentId,
                schedule_id: scheduleId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while marking absence');
        });
    }
}
</script>
@endsection 