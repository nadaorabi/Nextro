@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Attendance & Absence</h2>
        <a href="{{ route('admin.attendance.details') }}" class="btn btn-primary">
            <i class="fas fa-chart-bar me-1"></i> Detailed Reports & Filters
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Course</th>
                            <th>Instructor(s)</th>
                            <th>Created At</th>
                            <th>Schedules</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr>
                                <td>{{ $course->title }}</td>
                                <td>
                                    @php
                                        $instructors = $course->courseInstructors->map(function($ci){ return $ci->instructor->name ?? null; })->filter()->join(', ');
                                    @endphp
                                    {{ $instructors ?: '-' }}
                                </td>
                                <td>{{ $course->created_at ? $course->created_at->format('Y-m-d') : '-' }}</td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        @forelse($course->schedules as $sch)
                                            <li>
                                                {{ __(ucfirst($sch->day_of_week)) }} {{ substr($sch->start_time,0,5) }}
                                                <a href="{{ route('admin.attendance.take', $sch->id) }}" class="btn btn-sm btn-primary ms-2">Take Attendance</a>
                                                <span class="badge bg-success ms-2">Present: {{ $scheduleStats[$sch->id]['present'] ?? 0 }}/{{ $scheduleStats[$sch->id]['students'] ?? 0 }}</span>
                                                <span class="badge bg-danger ms-1">Absent: {{ $scheduleStats[$sch->id]['absent'] ?? 0 }}</span>
                                                <span class="badge bg-info ms-1">%{{ $scheduleStats[$sch->id]['students'] ? round(100 * ($scheduleStats[$sch->id]['present'] / max($scheduleStats[$sch->id]['students'],1)), 1) : 0 }} present</span>
                                            </li>
                                        @empty
                                            <li class="text-muted">No schedules</li>
                                        @endforelse
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No courses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection 