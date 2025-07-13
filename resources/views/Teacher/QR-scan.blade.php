{{-- Unified attendance system with admin --}}
@extends('layouts.teacher')
@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-2">
        <div class="col-12">
            <div class="page-header d-flex align-items-center justify-content-between flex-wrap" style="background: linear-gradient(135deg, #fff 0%, #fff 100%); color: rgb(123, 105, 172); border-radius: 15px; padding: 1.2rem; margin-bottom: 1rem; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                <div class="d-flex align-items-center w-100 justify-content-between flex-wrap">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-clipboard-check fa-2x"></i>
                        </div>
                        <div>
                            <h2 class="mb-1">Attendance Management</h2>
                            <p class="mb-0 opacity-75">Select a course and session to take attendance or view details</p>
                        </div>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0 d-flex gap-2">
                        <a href="{{ route('teacher.attendance.details') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-list me-1"></i> Attendance Details
                            </a>
                        <a href="{{ route('teacher.attendance.export') }}" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-download me-1"></i> Export Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-12">
            @forelse($teacherCourses as $courseInstructor)
            @php $course = $courseInstructor->course; @endphp
            <div class="schedule-card card mb-4">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                        <div class="fw-bold" style="color:#374a67;font-size:1.1rem">
                            <i class="fas fa-book me-2" style="color:#3db6f5;"></i>{{ $course->title }}
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="text-muted small">
                                <i class="fas fa-users me-1"></i>{{ $course->enrollments->count() }} Students
                            </div>
                            <div>
                                <span class="badge bg-light text-dark me-1" style="border:1px solid #e3eafc; background:#f5faff; color:#3db6f5;">
                                    <i class="fas fa-chalkboard-teacher me-1"></i>{{ $courseInstructor->instructor->name }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        @if($course->category)
                            <span class="category-badge">
                                <i class="fas fa-folder me-1"></i>{{ $course->category->name }}
                            </span>
                        @endif
                        @if($course->packages && $course->packages->count() > 0)
                            <span class="category-badge" style="background: linear-gradient(135deg, #20c997 0%, #1ea085 100%);">
                                <i class="fas fa-box me-1"></i>Package ({{ $course->packages->count() }})
                            </span>
                        @endif
                        @if($course->is_free)
                            <span class="category-badge" style="background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%); color:#856404;">
                                <i class="fas fa-gift me-1"></i>Free
                            </span>
                        @else
                            <span class="category-badge">
                                <i class="fas fa-dollar-sign me-1"></i>{{ $course->price ?? 0 }} {{ $course->currency ?? 'SAR' }}
                            </span>
                        @endif
                    </div>
                    @if($course->packages && $course->packages->count() > 0)
                        <div class="mb-3">
                            <small class="text-muted fw-bold">
                                <i class="fas fa-boxes me-1"></i>Linked Packages:
                            </small>
                            <div class="d-flex flex-wrap gap-1 mt-1">
                                @foreach($course->packages as $package)
                                    <span class="category-badge">
                                        <i class="fas fa-box me-1"></i>{{ $package->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($course->description)
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>{{ Str::limit($course->description, 150) }}
                            </small>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead class="table-header">
                                <tr>
                                    <th class="py-2" style="font-size:0.93rem;">DATE</th>
                                    <th class="py-2" style="font-size:0.93rem;">DAY</th>
                                    <th class="py-2" style="font-size:0.93rem;">TIME</th>
                                    <th class="py-2" style="font-size:0.93rem;">ROOM</th>
                                    <th class="py-2" style="font-size:0.93rem;">SUBJECT</th>
                                    <th class="py-2" style="font-size:0.93rem;">CATEGORY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($course->schedules as $schedule)
                                <tr class="table-row" style="font-size:0.97rem; height:38px;">
                                    <td class="py-2">{{ \Carbon\Carbon::parse($schedule->session_date)->format('Y-m-d') }}</td>
                                    <td class="py-2">{{ __(ucfirst($schedule->day_of_week)) }}</td>
                                    <td class="py-2">
                                        <span class="type-badge">
                                            <i class="fas fa-clock me-1"></i> {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        <span class="type-badge">
                                            <i class="fas fa-door-open me-1"></i> {{ $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name) : '-' }}
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        <span class="subject-badge">
                                            {{ $course->title }}
                                        </span>
                                    </td>
                                    <td class="py-2">
                                        <span class="category-badge">
                                            {{ $course->category ? $course->category->name : '-' }}
                                        </span>
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
            <div class="schedule-card card shadow-sm border-0">
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
<!-- Modal for QR Code Scanner -->
@yield('qr_modal')
<style>
.page-header {
    background: linear-gradient(135deg,#fff 0%,#fff 100%);
    color: rgb(123, 105, 172);
    border-radius: 15px;
    padding: 1.2rem;
    margin-bottom: 1rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}
.schedule-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    border: none;
    transition: all 0.3s ease;
}
.schedule-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 25px rgba(0,0,0,0.12);
}
.table-header {
    background: linear-gradient(135deg,rgb(255, 255, 255) 0%,rgb(255, 255, 255) 100%) !important;
    color: rgb(123, 105, 172) !important;
    border-bottom: 2px solid #e9ecef;
}
.table-header th {
    color: rgb(123, 105, 172) !important;
    font-weight: 600 !important;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}
.table-row {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f8f9fa;
}
.table-row:hover {
    background: linear-gradient(135deg, rgba(0, 123, 255, 0.05) 0%, rgba(0, 86, 179, 0.05) 100%) !important;
    transform: scale(1.01);
}
.subject-badge {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    display: inline-block;
    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
}
.category-badge {
    background: linear-gradient(135deg, #20c997 0%, #1ea085 100%);
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    display: inline-block;
    box-shadow: 0 2px 8px rgba(32, 201, 151, 0.3);
}
.type-badge {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    display: inline-block;
    box-shadow: 0 2px 8px rgba(108, 117, 125, 0.3);
}
.table {
    margin-bottom: 0;
    border-radius: 0;
    background: #fff;
}
.table-header th, .table-header td {
    border-radius: 0 !important;
}
.table-row td, .table-row th {
    padding-top: 0.5rem !important;
    padding-bottom: 0.5rem !important;
}
</style>
@yield('qr_scripts')
@endsection