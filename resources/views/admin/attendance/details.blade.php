@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Attendance Details & Reports</h2>
        <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Overview
        </a>
    </div>

    <!-- إحصائيات سريعة -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h5 class="card-title text-primary">Total Students</h5>
                    <h2 class="mb-0">{{ $stats['total'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h5 class="card-title text-success">Present</h5>
                    <h2 class="mb-0">{{ $stats['present'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-danger">
                <div class="card-body">
                    <h5 class="card-title text-danger">Absent</h5>
                    <h2 class="mb-0">{{ $stats['absent'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-info">
                <div class="card-body">
                    <h5 class="card-title text-info">Attendance Rate</h5>
                    <h2 class="mb-0">{{ $stats['total'] ? round(100 * ($stats['present'] / $stats['total']), 1) : 0 }}%</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- فلاتر البحث -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filters</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.attendance.details') }}" id="filterForm">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Course</label>
                        <select name="course_id" class="form-select" onchange="this.form.submit()">
                            <option value="">All Courses</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $courseId == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Schedule</label>
                        <select name="schedule_id" class="form-select" onchange="this.form.submit()">
                            <option value="">All Schedules</option>
                            @foreach($schedules as $schedule)
                                <option value="{{ $schedule->id }}" {{ $scheduleId == $schedule->id ? 'selected' : '' }}>
                                    {{ $schedule->course->title }} - {{ $schedule->day_of_week }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ $date }}" onchange="this.form.submit()">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="all" {{ $status == 'all' || !$status ? 'selected' : '' }}>All</option>
                            <option value="present" {{ $status == 'present' ? 'selected' : '' }}>Present</option>
                            <option value="absent" {{ $status == 'absent' ? 'selected' : '' }}>Absent</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Search Student</label>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Name or login_id" value="{{ $search }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">&nbsp;</label>
                        <a href="{{ route('admin.attendance.details') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-undo"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- جدول الطلاب -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Students Attendance</h5>
            <div>
                <button class="btn btn-success btn-sm" onclick="exportToExcel()">
                    <i class="fas fa-file-excel me-1"></i> Export Excel
                </button>
                <button class="btn btn-info btn-sm" onclick="printTable()">
                    <i class="fas fa-print me-1"></i> Print
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="attendanceTable">
                    <thead class="table-light">
                        <tr>
                            <th>Student Name</th>
                            <th>Login ID</th>
                            <th>Course</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th>Method</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendanceRecords as $record)
                            <tr class="{{ $record['status'] == 'present' ? 'table-success' : 'table-danger' }}">
                                <td>{{ $record['student']->name }}</td>
                                <td><span class="badge bg-secondary">{{ $record['student']->login_id }}</span></td>
                                <td>{{ $record['course']->title }}</td>
                                <td>
                                    @if($record['schedule'])
                                        {{ __($record['schedule']->day_of_week) }}<br>
                                        {{ $record['schedule']->start_time }} - {{ $record['schedule']->end_time }}<br>
                                        {{ $record['schedule']->room->name ?? $record['schedule']->room->room_number ?? '-' }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($record['status'] == 'present')
                                        <span class="badge bg-success"><i class="fas fa-check me-1"></i>Present</span>
                                    @else
                                        <span class="badge bg-danger"><i class="fas fa-times me-1"></i>Absent</span>
                                    @endif
                                </td>
                                <td>{{ $record['time'] }}</td>
                                <td>
                                    @if($record['method'] == 'QR')
                                        <span class="badge bg-info">QR</span>
                                    @elseif($record['method'] == 'manual')
                                        <span class="badge bg-primary">MANUAL</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($record['status'] == 'present')
                                        <button class="btn btn-sm btn-warning" onclick="markAbsent({{ $record['student']->id }}, '{{ $record['date'] }}', {{ $record['schedule']->id ?? 'null' }})">
                                            <i class="fas fa-user-times"></i> Mark Absent
                                        </button>
                                    @else
                                        <button class="btn btn-sm btn-success" onclick="markPresent({{ $record['student']->id }}, '{{ $record['date'] }}', {{ $record['schedule']->id ?? 'null' }})">
                                            <i class="fas fa-user-check"></i> Mark Present
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function markPresent(enrollmentId, date, scheduleId) {
    if (confirm('Mark this student as present?')) {
        fetch('{{ route("admin.attendance.mark-present") }}', {
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
                alert('Error: ' + data.message);
            }
        });
    }
}

function markAbsent(enrollmentId, date, scheduleId) {
    if (confirm('Mark this student as absent?')) {
        fetch('{{ route("admin.attendance.mark-absent") }}', {
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
                alert('Error: ' + data.message);
            }
        });
    }
}

function exportToExcel() {
    // تنفيذ تصدير Excel
    window.open('{{ route("admin.attendance.export") }}?' + new URLSearchParams(window.location.search));
}

function printTable() {
    window.print();
}

// تحديث تلقائي للفلاتر
document.querySelectorAll('select, input[type="date"]').forEach(element => {
    element.addEventListener('change', function() {
        if (this.name !== 'search') {
            document.getElementById('filterForm').submit();
        }
    });
});
</script>

<style>
@media print {
    .btn, .card-header, .form-control, .form-select {
        display: none !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
    .table {
        border: 1px solid #000 !important;
    }
    .table th, .table td {
        border: 1px solid #000 !important;
    }
}
</style>
@endsection 