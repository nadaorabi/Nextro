@extends('layouts.admin')

@section('title', 'Schedule Board')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #f8f9fc 0%, #e9ecef 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: #495057;
        position: relative;
        overflow: hidden;
        border: 1px solid #dee2e6;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #495057;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        opacity: 0.8;
        margin-bottom: 0;
        color: #6c757d;
    }

    .hero-btn {
        background: #007bff;
        border: 1px solid #007bff;
        color: #fff;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .hero-btn:hover {
        background: #0056b3;
        border-color: #0056b3;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,123,255,0.3);
    }

    /* Course Differentiation Styles */
    .course-section {
        margin-bottom: 2rem;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .course-section:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .course-header {
        padding: 1.5rem;
        color: white;
        font-weight: 600;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
    }

    .course-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, var(--course-color), var(--course-color-dark));
        z-index: -1;
    }

    .course-header h5 {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 700;
    }

    .course-info {
        display: flex;
        gap: 1rem;
        align-items: center;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .course-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .course-schedule-table {
        margin: 0;
    }

    .course-schedule-table thead th {
        background: #f8f9fa;
        color: #495057;
        font-weight: 600;
        border: none;
        padding: 1rem;
        font-size: 0.9rem;
    }

    .course-schedule-table tbody tr {
        transition: all 0.2s ease;
    }

    .course-schedule-table tbody tr:hover {
        background-color: rgba(var(--course-color-rgb), 0.05);
    }

    .course-schedule-table tbody td {
        padding: 1rem;
        border-color: #f1f3f4;
        vertical-align: middle;
    }

    .time-slot {
        font-weight: 600;
        color: var(--course-color);
        font-size: 0.9rem;
    }

    .instructor-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .instructor-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: var(--course-color);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .room-badge {
        background: var(--course-color);
        color: white;
        border-radius: 15px;
        padding: 0.25rem 0.75rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .empty-course {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }

    .empty-course i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    /* Course Color Variables */
    .course-1 { --course-color: #667eea; --course-color-dark: #5a67d8; --course-color-rgb: 102, 126, 234; }
    .course-2 { --course-color: #f093fb; --course-color-dark: #e91e63; --course-color-rgb: 240, 147, 251; }
    .course-3 { --course-color: #4facfe; --course-color-dark: #00f2fe; --course-color-rgb: 79, 172, 254; }
    .course-4 { --course-color: #43e97b; --course-color-dark: #38f9d7; --course-color-rgb: 67, 233, 123; }
    .course-5 { --course-color: #fa709a; --course-color-dark: #fee140; --course-color-rgb: 250, 112, 154; }
    .course-6 { --course-color: #a8edea; --course-color-dark: #fed6e3; --course-color-rgb: 168, 237, 234; }
    .course-7 { --course-color: #ffecd2; --course-color-dark: #fcb69f; --course-color-rgb: 255, 236, 210; }
    .course-8 { --course-color: #ff9a9e; --course-color-dark: #fecfef; --course-color-rgb: 255, 154, 158; }

    /* Enhanced Filters */
    .filter-card {
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 2rem;
    }

    .filter-card .card-body {
        padding: 1.5rem;
    }

    .form-select, .form-control {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .form-select:focus, .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-primary {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #5a67d8, #6b46c1);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    @media print {
        .no-print {
            display: none !important;
        }
        .course-section {
            break-inside: avoid;
            margin-bottom: 1rem;
        }
        .course-header {
            background: #f8f9fa !important;
            color: #495057 !important;
        }
    }

    @media (max-width: 768px) {
        .course-header {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
        
        .course-info {
            flex-wrap: wrap;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid mt-4">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="hero-title">Schedule Board</h1>
                    <p class="hero-subtitle">View and manage all schedule sessions organized by course</p>
                </div>
                <div>
                    <a href="{{ route('admin.schedules.index') }}" class="btn hero-btn">
                        <i class="fas fa-arrow-left me-2"></i>
                        Back to Schedule Management
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Filters -->
    <div class="card filter-card">
        <div class="card-body">
            <h6 class="mb-3"><i class="fas fa-filter me-2"></i>Filter Schedule Sessions</h6>
            <form method="GET" action="" class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label class="form-label small">Course</label>
                    <select name="course_id" class="form-select">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small">Instructor</label>
                    <select name="instructor_id" class="form-select">
                        <option value="">All Instructors</option>
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ request('instructor_id') == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small">Room</label>
                    <select name="room_id" class="form-select">
                        <option value="">All Rooms</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>{{ $room->room_number ?? $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small">Date</label>
                    <input type="date" name="session_date" class="form-control" value="{{ request('session_date') }}" placeholder="Date">
                </div>
                <div class="col-md-1">
                    <label class="form-label small">&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="col-md-1">
                    <label class="form-label small">&nbsp;</label>
                    <a href="{{ route('admin.schedules.board') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Export Buttons -->
    <div class="d-flex justify-content-end mb-3 no-print">
        <button type="button" class="btn btn-outline-dark me-2" onclick="window.print()">
            <i class="fas fa-print me-1"></i>Print
        </button>
        <button type="button" class="btn btn-outline-success" onclick="exportTableToExcel('schedules-table')">
            <i class="fas fa-file-excel me-1"></i>Excel
        </button>
    </div>

    <!-- Course-Based Schedule Display -->
    @php
        $groupedSchedules = $schedules->groupBy('course_id');
        $courseCounter = 1;
    @endphp

    @forelse($groupedSchedules as $courseId => $courseSchedules)
        @php
            $course = $courseSchedules->first()->course;
            $courseClass = 'course-' . ($courseCounter % 8 + 1);
            $courseCounter++;
        @endphp
        
        <div class="course-section {{ $courseClass }}">
            <div class="course-header">
                <div>
                    <h5>
                        <i class="fas fa-graduation-cap me-2"></i>
                        {{ $course->title ?? 'Unknown Course' }}
                    </h5>
                    <div class="course-info">
                        @if($course->category)
                            <span class="course-badge">
                                <i class="fas fa-tag me-1"></i>{{ $course->category->name }}
                            </span>
                        @endif
                        <span class="course-badge">
                            <i class="fas fa-calendar me-1"></i>{{ $courseSchedules->count() }} sessions
                        </span>
                    </div>
                </div>
                <div class="course-info">
                    @php 
                        $instructors = $course->courseInstructors->map(function($ci){ 
                            return $ci->instructor->name ?? null; 
                        })->filter()->join(', '); 
                    @endphp
                    @if($instructors)
                        <span class="course-badge">
                            <i class="fas fa-user-tie me-1"></i>{{ $instructors }}
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table course-schedule-table" id="schedules-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Instructor</th>
                            <th>Room</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courseSchedules as $schedule)
                            <tr>
                                <td>
                                    <span class="fw-semibold">{{ \Carbon\Carbon::parse($schedule->session_date)->format('M d, Y') }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary">{{ ucfirst($schedule->day_of_week) }}</span>
                                </td>
                                <td>
                                    <span class="time-slot">{{ substr($schedule->start_time,0,5) }} - {{ substr($schedule->end_time,0,5) }}</span>
                                </td>
                                <td>
                                    <div class="instructor-info">
                                        @php 
                                            $instructors = $schedule->course->courseInstructors->map(function($ci){ 
                                                return $ci->instructor->name ?? null; 
                                            })->filter(); 
                                        @endphp
                                        @if($instructors->count() > 0)
                                            @foreach($instructors->take(2) as $instructor)
                                                <div class="instructor-avatar">
                                                    {{ substr($instructor, 0, 1) }}
                                                </div>
                                            @endforeach
                                            <span class="text-muted">{{ $instructors->join(', ') }}</span>
                                        @else
                                            <span class="text-muted">Not Assigned</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="room-badge">
                                        {{ $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name ?? 'Room #' . $schedule->room->id) : 'Not Assigned' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @empty
        <div class="card">
            <div class="card-body">
                <div class="empty-course">
                    <i class="fas fa-calendar-times"></i>
                    <h6 class="text-muted mb-2">No Schedules Found</h6>
                    <p class="text-muted mb-0">No schedules match your search criteria</p>
                </div>
            </div>
        </div>
    @endforelse
</div>

<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    filename = filename ? filename + '.xls' : 'schedule-sessions.xls';
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], { type: dataType });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
    document.body.removeChild(downloadLink);
}

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endsection 