@extends('layouts.teacher')
@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1 fw-bold" style="color:#5f5aad">
                        <i class="fas fa-clipboard-check text-primary me-2"></i>
                        Attendance Details
                    </h2>
                    <div class="text-muted small">View and manage attendance for all your courses</div>
                </div>
                <div>
                    <a href="{{ route('teacher.attendance.export') }}" class="btn btn-outline-success">
                        <i class="fas fa-download me-1"></i> Export Data
                    </a>
                </div>
            </div>

            <!-- Courses List -->
            @forelse($teacherCourses as $course)
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                        <div class="fw-bold" style="color:#5f5aad;font-size:1.1rem">
                            <i class="fas fa-book me-2"></i>{{ $course->title }}
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="text-muted small">
                                <i class="fas fa-users me-1"></i>{{ $course->enrollments->count() }} Students
                            </div>
                            <div>
                                <span class="badge bg-light text-dark me-1">
                                    <i class="fas fa-chalkboard-teacher me-1"></i>{{ $course->courseInstructors->first()->instructor->name ?? 'Not specified' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Course Category and Package Information -->
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        @if($course->category)
                            <span class="badge bg-primary">
                                <i class="fas fa-folder me-1"></i>{{ $course->category->name }}
                            </span>
                        @endif
                        @if($course->packages && $course->packages->count() > 0)
                            <span class="badge bg-success">
                                <i class="fas fa-box me-1"></i>Package ({{ $course->packages->count() }})
                            </span>
                        @endif
                        @if($course->is_free)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-gift me-1"></i>Free
                            </span>
                        @else
                            <span class="badge bg-info">
                                <i class="fas fa-dollar-sign me-1"></i>{{ $course->price ?? 0 }} {{ $course->currency ?? 'SAR' }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Linked Packages Details -->
                    @if($course->packages && $course->packages->count() > 0)
                        <div class="mb-3">
                            <small class="text-muted fw-bold">
                                <i class="fas fa-boxes me-1"></i>Linked Packages:
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
                    
                    <!-- Course Description -->
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
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Room</th>
                                    <th>Total / Present</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($course->schedules as $schedule)
                                @php
                                    $today = now()->format('Y-m-d');
                                    $scheduleDate = $schedule->session_date;
                                    $status = '';
                                    $statusClass = '';
                                    
                                    if ($scheduleDate < $today) {
                                        $status = 'Completed';
                                        $statusClass = 'text-muted';
                                    } elseif ($scheduleDate == $today) {
                                        $status = 'Today';
                                        $statusClass = 'text-success fw-bold';
                                    } else {
                                        $status = 'Upcoming';
                                        $statusClass = 'text-warning';
                                    }
                                    
                                    // Calculate attendance statistics
                                    $totalStudents = \App\Models\Enrollment::where('course_id', $course->id)->count();
                                    $presentStudents = \App\Models\Attendance::where('schedule_id', $schedule->id)
                                        ->where('status', 'present')
                                        ->count();
                                @endphp
                                <tr>
                                    <td>
                                        <span class="{{ $statusClass }}">{{ \Carbon\Carbon::parse($schedule->session_date)->format('Y-m-d') }}</span>
                                        <br><small class="text-muted">{{ $status }}</small>
                                    </td>
                                    <td>{{ __(ucfirst($schedule->day_of_week)) }}</td>
                                    <td>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
                                    <td>{{ $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name) : 'Not specified' }}</td>
                                    <td class="text-center">
                                        <span style="color:#5f5aad;font-weight:bold;font-size:1.15em">{{ $totalStudents }}</span>
                                        <span style="color:#888;font-size:1.1em">/</span>
                                        <span style="color:#28a745;font-weight:bold;font-size:1.15em">{{ $presentStudents }}</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-primary btn-sm me-1" onclick="openAttendanceModal('{{ $course->title }}', {{ $schedule->id }})">
                                            <i class="fas fa-camera me-1"></i> Take Attendance
                                        </button>
                                        <a href="{{ route('teacher.attendance.qr-codes', $schedule->id) }}" class="btn btn-outline-info btn-sm me-1">
                                            <i class="fas fa-qrcode me-1"></i> QR Codes
                                        </a>
                                        <a href="{{ route('teacher.attendance.schedule-details', $schedule->id) }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-list me-1"></i> Details
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-muted text-center">No scheduled sessions for this course</td>
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
                    <h4 class="text-muted">No courses assigned</h4>
                    <p class="text-muted">No courses have been assigned to you yet</p>
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
</style>
@endsection 