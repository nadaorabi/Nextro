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

    @media print {
        .no-print {
            display: none !important;
        }
        .table th, .table td {
            border: 1px solid #000 !important;
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
                    <p class="hero-subtitle">View and manage all schedule sessions</p>
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

    <!-- Simple Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="" class="row g-3 align-items-end">
                <div class="col-md-2">
                    <select name="course_id" class="form-select">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="instructor_id" class="form-select">
                        <option value="">All Instructors</option>
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ request('instructor_id') == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="room_id" class="form-select">
                        <option value="">All Rooms</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>{{ $room->room_number ?? $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <input type="date" name="session_date" class="form-control" value="{{ request('session_date') }}" placeholder="Date">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="col-md-1">
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

    <!-- Schedule Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Schedule Sessions</h5>
        </div>
        <div class="card-body">
            <div id="print-schedule-table">
                <div class="table-responsive">
                                         <table class="table" id="schedules-table">
                         <thead>
                             <tr>
                                 <th>Date</th>
                                 <th>Day</th>
                                 <th>Time</th>
                                 <th>Course</th>
                                 <th>Category</th>
                                 <th>Instructor</th>
                                 <th>Room</th>
                             </tr>
                         </thead>
                        <tbody>
                            @forelse($schedules as $sch)
                                <tr>
                                    <td>
                                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($sch->session_date)->format('M d, Y') }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ ucfirst($sch->day_of_week) }}</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ substr($sch->start_time,0,5) }} - {{ substr($sch->end_time,0,5) }}</span>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $sch->course->title ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $sch->course->category->name ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <div class="text-muted">
                                            @php 
                                                $instructors = $sch->course->courseInstructors->map(function($ci){ 
                                                    return $ci->instructor->name ?? null; 
                                                })->filter()->join(', '); 
                                            @endphp
                                            {{ $instructors ?: 'Not Assigned' }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $sch->room ? ($sch->room->room_number ?? $sch->room->name ?? 'Room #' . $sch->room->id) : 'Not Assigned' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="mb-3">
                                            <i class="fas fa-calendar-times fa-3x text-muted opacity-50"></i>
                                        </div>
                                        <h6 class="text-muted mb-2">No Schedules Found</h6>
                                        <p class="text-muted mb-0">No schedules match your search criteria</p>
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
</script>
@endsection 