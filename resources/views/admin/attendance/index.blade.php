@extends('layouts.admin')

@section('title', 'Attendance Management')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12" style="max-width:1200px;margin:auto;">
      
      <!-- Header Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0"><i class="fas fa-clipboard-check me-2"></i>Attendance Management</h4>
              <p class="text-muted mb-0">Track and manage student attendance for all courses</p>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ route('admin.attendance.details') }}" class="btn btn-outline-primary">
                <i class="fas fa-chart-bar"></i> Attendance Reports
              </a>
              <a href="{{ route('admin.attendance.export') }}" class="btn btn-success">
                <i class="fas fa-download"></i> Export Data
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Overall Statistics -->
      <div class="row mb-4">
        @php
          $totalCourses = $courses->count();
          $totalSchedules = $courses->sum(function($course) { return $course->schedules->count(); });
          $totalStudents = $courses->sum(function($course) { return $course->enrollments_count ?? 0; });
          $totalPresentToday = collect($scheduleStats)->sum('present');
        @endphp
        
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-primary">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-book"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number">{{ $totalCourses }}</div>
                <div class="stats-label">Total Courses</div>
                <div class="stats-description">Active courses</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-success">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-calendar-alt"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number">{{ $totalSchedules }}</div>
                <div class="stats-label">Total Schedules</div>
                <div class="stats-description">Weekly schedules</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-info">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-users"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number">{{ $totalStudents }}</div>
                <div class="stats-label">Total Students</div>
                <div class="stats-description">Enrolled students</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-warning">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number">{{ $totalPresentToday }}</div>
                <div class="stats-label">Present Today</div>
                <div class="stats-description">Students present</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
      </div>

      <!-- Success Messages -->
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle me-2"></i>
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-circle me-2"></i>
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- Courses and Schedules Table -->
      <div class="card shadow-sm">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Course Schedules & Attendance</h5>
            <span class="text-muted">Total Courses: {{ $totalCourses }}</span>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th>Course Details</th>
                  <th>Schedule Info</th>
                  <th>Room</th>
                  <th>Students</th>
                  <th>Attendance</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($courses as $course)
                  @forelse($course->schedules as $schedule)
                    <tr>
                      <td>
                        <div>
                          <div class="fw-bold text-primary">{{ $course->title }}</div>
                          <div class="text-muted small">
                            @if($course->category)
                              <span class="badge bg-light text-dark">{{ $course->category->name }}</span>
                            @endif
                            @if($course->is_free)
                              <span class="badge bg-success">Free</span>
                            @else
                              <span class="badge bg-info">{{ $course->price ?? 0 }} {{ $course->currency ?? 'KWD' }}</span>
                            @endif
                          </div>
                          @if($course->courseInstructors->count() > 0)
                            <div class="text-muted small mt-1">
                              Instructor: {{ $course->courseInstructors->first()->instructor->name }}
                            </div>
                          @endif
                        </div>
                      </td>
                      <td>
                        <div>
                          <div class="fw-bold">{{ __(ucfirst($schedule->day_of_week)) }}</div>
                          <div class="text-muted">{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</div>
                        </div>
                      </td>
                      <td>
                        <span class="badge bg-light text-dark">
                          {{ $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name) : 'Not Assigned' }}
                        </span>
                      </td>
                      <td>
                        <div class="text-center">
                          <span class="badge bg-primary">{{ $course->enrollments_count ?? 0 }} Students</span>
                        </div>
                      </td>
                      <td>
                        <div class="text-center">
                          @php $stat = $scheduleStats[$schedule->id] ?? null; @endphp
                          @if($stat)
                            <div class="d-flex align-items-center justify-content-center gap-1">
                              <span class="badge bg-success">{{ $stat['present'] }} Present</span>
                              <span class="badge bg-danger">{{ $stat['students'] - $stat['present'] }} Absent</span>
                            </div>
                            <div class="text-muted small mt-1">
                              {{ $stat['students'] > 0 ? round(($stat['present'] / $stat['students']) * 100, 1) : 0 }}% Attendance
                            </div>
                          @else
                            <span class="text-muted">No data</span>
                          @endif
                        </div>
                      </td>
                      <td>
                        <div class="d-flex gap-1 flex-wrap">
                          <a href="{{ route('admin.attendance.take', $schedule->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-camera me-1"></i> Take Attendance
                          </a>
                          <a href="{{ route('admin.attendance.qr-codes', $schedule->id) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-qrcode me-1"></i> QR Codes
                          </a>
                          <a href="{{ route('admin.attendance.schedule-details', $schedule->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-list me-1"></i> Details
                          </a>
                        </div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center text-muted py-3">
                        No schedules found for {{ $course->title }}
                      </td>
                    </tr>
                  @endforelse
                @empty
                  <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                      <i class="fas fa-book-open fa-3x mb-3"></i>
                      <br>No courses found
                      <br><small>Please add courses to start managing attendance</small>
                    </td>
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
    position: relative;
    z-index: 2;
}

.stats-icon {
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    margin-right: 1rem;
    font-size: 1.8rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.stats-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    transform: scale(0);
    transition: transform 0.3s ease;
}

.stats-card:hover .stats-icon::before {
    transform: scale(1);
}

.stats-content {
    flex: 1;
}

.stats-number {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.5rem;
    color: white;
}

.stats-label {
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 0.25rem;
}

.stats-description {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.7);
    font-weight: 500;
}

.stats-card-decoration {
    position: absolute;
    top: -30px;
    right: -30px;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    transition: all 0.4s ease;
}

.stats-card:hover .stats-card-decoration {
    transform: scale(1.2);
    background: rgba(255, 255, 255, 0.15);
}

/* Color Variants */
.stats-card-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.stats-card-primary .stats-icon {
    background: rgba(255, 255, 255, 0.15);
}

.stats-card-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.stats-card-success .stats-icon {
    background: rgba(255, 255, 255, 0.15);
}

.stats-card-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.stats-card-info .stats-icon {
    background: rgba(255, 255, 255, 0.15);
}

.stats-card-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.stats-card-warning .stats-icon {
    background: rgba(255, 255, 255, 0.15);
}

/* Animation */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stats-card {
    animation: slideInUp 0.6s ease-out;
}

.stats-card:nth-child(2) {
    animation-delay: 0.1s;
}

.stats-card:nth-child(3) {
    animation-delay: 0.2s;
}

.stats-card:nth-child(4) {
    animation-delay: 0.3s;
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
}
</style>
@endsection 