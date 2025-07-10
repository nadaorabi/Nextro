@extends('layouts.admin')

@section('title', 'Attendance Reports')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12" style="max-width:1200px;margin:auto;">
      
      <!-- Header Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Attendance Reports</h4>
              <p class="text-muted mb-0">View and filter attendance records</p>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Attendance
              </a>
              <a href="{{ route('admin.attendance.export') }}" class="btn btn-success">
                <i class="fas fa-download"></i> Export Data
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Filters Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-header">
          <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Search & Filters</h5>
        </div>
        <div class="card-body">
          <form method="GET" action="{{ route('admin.attendance.details') }}" class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Course</label>
              <select name="course_id" class="form-select">
                <option value="">All Courses</option>
                @foreach($courses as $course)
                  <option value="{{ $course->id }}" {{ $courseId == $course->id ? 'selected' : '' }}>
                    {{ $course->title }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <label class="form-label">Schedule</label>
              <select name="schedule_id" class="form-select">
                <option value="">All Schedules</option>
                @foreach($schedules as $schedule)
                  <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : '' }}>
                    {{ $schedule->course->title }} - {{ __(ucfirst($schedule->day_of_week)) }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <label class="form-label">Date</label>
              <input type="date" name="date" class="form-control" value="{{ $date }}">
            </div>
            <div class="col-md-2">
              <label class="form-label">Status</label>
              <select name="status" class="form-select">
                <option value="all" {{ $status == 'all' ? 'selected' : '' }}>All Status</option>
                <option value="present" {{ $status == 'present' ? 'selected' : '' }}>Present</option>
                <option value="absent" {{ $status == 'absent' ? 'selected' : '' }}>Absent</option>
              </select>
            </div>
            <div class="col-md-2">
              <label class="form-label">Search Student</label>
              <input type="text" name="search" class="form-control" placeholder="Name or Login ID" value="{{ $search }}">
            </div>
            <div class="col-12 d-flex gap-2 justify-content-end">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-search me-1"></i> Apply Filters
              </button>
              <a href="{{ route('admin.attendance.details') }}" class="btn btn-outline-secondary">
                <i class="fas fa-times me-1"></i> Reset
              </a>
            </div>
          </form>
        </div>
      </div>

      <!-- Results Table -->
      <div class="card shadow-sm">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Attendance Records</h5>
            @if(count($attendanceRecords) > 0)
              <span class="text-muted">{{ count($attendanceRecords) }} records found</span>
            @endif
          </div>
        </div>
        <div class="card-body p-0">
          @if(count($attendanceRecords) > 0)
            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead>
                  <tr>
                    <th>Student</th>
                    <th>Login ID</th>
                    <th>Course</th>
                    <th>Schedule</th>
                    <th>Start Time</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Method</th>
                    <th>Check-in Time</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($attendanceRecords as $record)
                    <tr>
                      <td>
                        <div class="fw-bold">{{ $record['student']->name }}</div>
                      </td>
                      <td>
                        <span class="text-muted">{{ $record['student']->login_id }}</span>
                      </td>
                      <td>{{ $record['course']->title }}</td>
                      <td>
                        @if(isset($record['schedule']))
                          <div>
                            <div class="fw-bold">{{ __(ucfirst($record['schedule']->day_of_week)) }}</div>
                          </div>
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
                          <span class="badge bg-success">Present</span>
                        @else
                          <span class="badge bg-danger">Absent</span>
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
              <i class="fas fa-inbox fa-3x mb-3"></i>
              <h5>No Results Found</h5>
              <p>Try adjusting your search criteria to get results</p>
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

@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
}
</style>
@endsection 