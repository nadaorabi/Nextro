@extends('layouts.admin')

@section('title', 'Course Schedule Management')

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
</style>
@endpush

@section('content')
<div class="container-fluid mt-4">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-content">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="hero-title">
                        Course Schedule: {{ $course->name ?? $course->title }}
                    </h1>
                    <p class="hero-subtitle">Manage and view course schedule sessions</p>
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

    <!-- Add Schedule Form -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Add New Schedule</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.schedules.store') }}" class="row g-3 align-items-end">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                
                <div class="col-md-2">
                    <input type="time" name="start_time" id="start_time" class="form-control" required placeholder="Start Time">
                </div>
                
                <div class="col-md-2">
                    <input type="time" name="end_time" id="end_time" class="form-control" required placeholder="End Time">
                </div>
                
                <div class="col-md-3">
                    <select name="room_id" id="room_id" class="form-select" required>
                        <option value="">Select Room</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-3">
                    <input type="date" name="session_date" id="session_date" class="form-control" required onchange="showDayOfWeek()">
                    <div id="dayOfWeekDisplay" class="mt-2 text-primary small" style="display: none;"></div>
                </div>
                
                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-plus me-2"></i>Add
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Current Schedules -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Current Schedules</h5>
        </div>
        <div class="card-body">
            @if($course->schedules->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Room</th>
                                <th>Added On</th>
                                <th>Session Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course->schedules as $schedule)
                                <tr>
                                    <td>
                                        <span class="badge bg-primary">{{ ucfirst($schedule->day_of_week) }}</span>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $schedule->room ? $schedule->room->room_number : 'Room #' . $schedule->room_id }}
                                        </span>
                                    </td>
                                    <td>{{ $schedule->created_at->format('M d, Y h:i A') }}</td>
                                    <td>{{ $schedule->session_date ? \Carbon\Carbon::parse($schedule->session_date)->format('M d, Y') : '' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $schedule->id }}">
                                                <i class="fas fa-edit me-1"></i>
                                                Edit
                                            </button>
                                            <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure you want to delete this schedule?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash me-1"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $schedule->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ route('admin.schedules.update', $schedule->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                                                                <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $schedule->id }}">
                                                Edit Schedule Times
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                                        <div class="modal-body">
                                                                                                        <div class="mb-3">
                                                <label class="form-label">Start Time</label>
                                                <input type="time" name="start_time" class="form-control" value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">End Time</label>
                                                <input type="time" name="end_time" class="form-control" value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}" required>
                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-calendar-times fa-3x text-muted opacity-50"></i>
                    </div>
                    <h6 class="text-muted mb-2">No Schedule Sessions Yet</h6>
                    <p class="text-muted">Add schedule sessions using the form above</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Messages -->
@if(session('error'))
    <div class="alert alert-danger alert-dismissible">
        <i class="fas fa-exclamation-circle me-2"></i>
        {!! session('error') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger alert-dismissible">
        <i class="fas fa-exclamation-triangle me-2"></i>
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<script>
function showDayOfWeek() {
    const input = document.getElementById('session_date');
    const display = document.getElementById('dayOfWeekDisplay');
    
    if (input.value) {
        const date = new Date(input.value);
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const dayName = days[date.getDay()];
        
        display.innerHTML = `<i class="fas fa-calendar me-1"></i>Day: ${dayName}`;
        display.style.display = 'block';
    } else {
        display.style.display = 'none';
    }
}
</script>
@endsection 