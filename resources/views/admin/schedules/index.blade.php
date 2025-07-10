@extends('layouts.admin')

@section('title', 'Schedule Management')

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

    .course-card {
        border-radius: 16px;
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
        background: #fff;
        overflow: hidden;
    }

    .course-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        border-color: #dee2e6;
    }

    .course-card .card-body {
        padding: 1.5rem;
    }

    .course-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .course-description {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 1rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .course-meta {
        margin-bottom: 0.75rem;
    }

    .course-meta .meta-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
        font-size: 0.85rem;
    }

    .course-meta .meta-label {
        color: #868e96;
        font-weight: 500;
    }

    .badge-soft-info {
        background-color: #e3f2fd;
        color: #1976d2;
        border: 1px solid #bbdefb;
    }

    .badge-soft-primary {
        background-color: #e8f4f8;
        color: #0277bd;
        border: 1px solid #b3e5fc;
    }

    .badge-soft-success {
        background-color: #e8f5e8;
        color: #2e7d32;
        border: 1px solid #c8e6c9;
    }

    .badge-soft-danger {
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid #ffcdd2;
    }

    .course-actions {
        padding-top: 1rem;
        border-top: 1px solid #f1f3f4;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-view-schedule {
        background: linear-gradient(45deg, #6c5ce7, #a29bfe);
        border: none;
        color: white;
        font-size: 0.85rem;
        font-weight: 500;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-view-schedule:hover {
        background: linear-gradient(45deg, #5f4fcf, #9189f7);
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(108, 92, 231, 0.3);
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
                    <h1 class="hero-title">Schedule Management</h1>
                    <p class="hero-subtitle">Manage course and package schedules efficiently</p>
                </div>
                <div>
                    <a href="{{ route('admin.schedules.board') }}" class="btn hero-btn me-2">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Schedule Board
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Simple Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Search..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="course" {{ request('type') === 'course' ? 'selected' : '' }}>Courses</option>
                        <option value="package" {{ request('type') === 'package' ? 'selected' : '' }}>Packages</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Content Tabs -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#courses">
                <i class="fas fa-book me-2"></i>Courses ({{ $courses->count() }})
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#packages">
                <i class="fas fa-box me-2"></i>Packages ({{ $packages->count() }})
            </a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">
        <!-- Courses Tab -->
        <div class="tab-pane active" id="courses">
            @if($courses->count() > 0)
                <div class="row">
                    @foreach($courses as $course)
                        <div class="col-12 col-md-6 col-xl-4 mb-4">
                            <div class="card course-card h-100">
                                <div class="card-body">
                                    <h6 class="course-title">{{ $course->title }}</h6>
                                    <p class="course-description">{{ $course->description ?: 'No description available' }}</p>
                                    
                                    <div class="course-meta">
                                        <div class="meta-item">
                                            <span class="meta-label">Category:</span>
                                            <span class="badge badge-soft-info">{{ $course->category->name ?? 'No Category' }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <span class="meta-label">Schedules:</span>
                                            <span class="badge badge-soft-primary">{{ $course->schedules->count() }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="course-actions">
                                        <span class="badge badge-soft-{{ $course->status === 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($course->status) }}
                                        </span>
                                        <a href="{{ route('admin.schedules.show', $course->id) }}" class="btn btn-view-schedule">
                                            <i class="fas fa-calendar me-1"></i>
                                            View Schedule
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-book fa-3x text-muted opacity-50"></i>
                        </div>
                        <h6 class="text-muted mb-2">No Courses Found</h6>
                        <p class="text-muted mb-0">No courses match your search criteria</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Packages Tab -->
        <div class="tab-pane" id="packages">
            @if($packages->count() > 0)
                <div class="row">
                    @foreach($packages as $package)
                        <div class="col-12 col-md-6 col-xl-4 mb-4">
                            <div class="card course-card h-100">
                                <div class="card-body">
                                    <h6 class="course-title">{{ $package->name }}</h6>
                                    <p class="course-description">{{ $package->description ?: 'No description available' }}</p>
                                    
                                    <div class="course-meta">
                                        <div class="meta-item">
                                            <span class="meta-label">Category:</span>
                                            <span class="badge badge-soft-info">{{ $package->category->name ?? 'No Category' }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <span class="meta-label">Courses:</span>
                                            <span class="badge badge-soft-primary">{{ $package->courses->count() }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="course-actions">
                                        <span class="badge badge-soft-{{ $package->status === 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($package->status) }}
                                        </span>
                                        <a href="{{ route('admin.schedules.show-package', $package->id) }}" class="btn btn-view-schedule">
                                            <i class="fas fa-calendar me-1"></i>
                                            View Schedule
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-box fa-3x text-muted opacity-50"></i>
                        </div>
                        <h6 class="text-muted mb-2">No Packages Found</h6>
                        <p class="text-muted mb-0">No packages match your search criteria</p>
                    </div>
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

@endsection 