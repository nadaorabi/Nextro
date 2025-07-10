@extends('layouts.admin')

@section('title', 'Package Schedule Details')

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

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="20" cy="20" r="1" fill="white" opacity="0.1"/><circle cx="80" cy="80" r="1" fill="white" opacity="0.1"/><circle cx="40" cy="60" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
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

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }
        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
        }
        .breadcrumb-item.active {
            color: #495057;
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
                        <i class="fas fa-box me-2"></i>
                        Package: {{ $package->name }}
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.schedules.index') }}">Schedule Management</a></li>
                            <li class="breadcrumb-item active">{{ $package->name }}</li>
                        </ol>
                    </nav>
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

    <!-- Package Information -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Package Information</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong class="text-dark">Package Name:</strong>
                        <p class="mb-2 text-muted">{{ $package->name }}</p>
                    </div>
                    <div class="mb-3">
                        <strong class="text-dark">Description:</strong>
                        <p class="mb-2 text-muted">{{ $package->description ?: 'No description available' }}</p>
                    </div>
                    <div class="mb-3">
                        <strong class="text-dark">Category:</strong>
                        <span class="badge bg-info ms-2">{{ $package->category ? $package->category->name : 'Unassigned' }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <strong class="text-dark">Courses:</strong>
                        <span class="badge bg-primary ms-2">{{ $package->courses->count() }}</span>
                    </div>
                    <div class="mb-3">
                        <strong class="text-dark">Status:</strong>
                        <span class="badge bg-{{ $package->status === 'active' ? 'success' : 'danger' }} ms-2">
                            {{ $package->status === 'active' ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="mb-3">
                        <strong class="text-dark">Created Date:</strong>
                        <p class="mb-2 text-muted">{{ $package->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Package Courses -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Package Courses</h5>
        </div>
        <div class="card-body">
            @if($package->courses->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Course Name</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Schedules</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($package->courses as $course)
                                <tr>
                                    <td>{{ $course->name ?? $course->title }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            {{ $course->category ? $course->category->name : 'Unassigned' }}
                                        </span>
                                    </td>
                                    <td>{{ $course->duration_hours ?? '-' }} hours</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $course->schedules->count() }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $course->status === 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($course->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.schedules.show', $course->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-calendar me-1"></i>
                                            View Schedule
                                        </a>
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#courseScheduleModal{{ $course->id }}">
                                            <i class="fas fa-eye me-1"></i>
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-book fa-3x text-muted opacity-50"></i>
                    </div>
                    <h6 class="text-muted mb-2">No Courses Found</h6>
                    <p class="text-muted mb-0">This package doesn't have any courses assigned yet</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Course Schedule Modals -->
@foreach($package->courses as $course)
<div class="modal fade" id="courseScheduleModal{{ $course->id }}" tabindex="-1" aria-labelledby="courseScheduleModalLabel{{ $course->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="courseScheduleModalLabel{{ $course->id }}">
                    {{ $course->name ?? $course->title }} - Schedule Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($course->schedules->count() > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Room</th>
                                    <th>Session Date</th>
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
                                        <td>{{ $schedule->session_date ? \Carbon\Carbon::parse($schedule->session_date)->format('M d, Y') : '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <div class="mb-3">
                            <i class="fas fa-calendar-times fa-3x text-muted opacity-50"></i>
                        </div>
                        <p class="text-muted">No schedules found for this course</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="{{ route('admin.schedules.show', $course->id) }}" class="btn btn-primary">
                    <i class="fas fa-calendar me-1"></i>
                    Manage Schedule
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach

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

@endsection 