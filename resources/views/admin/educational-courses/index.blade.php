@extends('layouts.admin')

@section('title', 'Educational Courses List')

@push('styles')
    <style>
        .stat-card {
            min-height: 140px;
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 24px;
            background: #fff;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.04);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--card-color, #5e72e4);
        }
        
        .stat-card.primary::before { background: #5e72e4; }
        .stat-card.success::before { background: #2dce89; }
        .stat-card.info::before { background: #11cdef; }
        .stat-card.warning::before { background: #fb6340; }
        
        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px auto;
            font-size: 24px;
            color: white;
        }
        
        .stat-card .stat-icon.primary { background: linear-gradient(45deg, #5e72e4, #825ee4); }
        .stat-card .stat-icon.success { background: linear-gradient(45deg, #2dce89, #2dcecc); }
        .stat-card .stat-icon.info { background: linear-gradient(45deg, #11cdef, #1171ef); }
        .stat-card .stat-icon.warning { background: linear-gradient(45deg, #fb6340, #fbb140); }
        
        .stat-card .stat-title {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #8898aa;
            margin-bottom: 8px;
            line-height: 1.2;
        }
        
        .stat-card .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #32325d;
            margin-bottom: 4px;
            line-height: 1;
        }
        
        .stat-card .stat-description {
            font-size: 0.875rem;
            color: #8898aa;
            margin: 0;
            line-height: 1.3;
        }
        
        .stat-card .stat-description .highlight {
            font-weight: 600;
        }
        
        .stat-card .stat-description .success { color: #2dce89; }
        .stat-card .stat-description .info { color: #11cdef; }
        .stat-card .stat-description .warning { color: #fb6340; }

        .welcome-animated {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            animation: bounce 1.5s infinite alternate, gradientMove 3s linear infinite;
            letter-spacing: 2px;
            margin-top: 20px;
            background: linear-gradient(90deg, #007bff, #00c6ff, #007bff);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-20px); }
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .modal-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .border-dashed {
            border-style: dashed !important;
        }

        .bg-light-warning {
            background-color: rgba(255, 193, 7, 0.1) !important;
        }

        .bg-light-danger {
            background-color: rgba(220, 53, 69, 0.1) !important;
        }

        .btn-lg {
            border-radius: 10px;
            font-weight: 600;
        }

        .alert {
            border-radius: 10px;
        }

        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translate(0, -50px);
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        .icon-shape {
            transition: all 0.3s ease;
        }

        .icon-shape:hover {
            transform: scale(1.1);
        }

        .border-dashed:hover {
            border-color: #667eea !important;
            background-color: rgba(102, 126, 234, 0.05) !important;
        }

        .course-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }

        .price-display {
            min-width: 120px;
        }

        /* Custom file input styling for English */
        input[type="file"] {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            color: #495057 !important;
        }

        input[type="file"]::-webkit-file-upload-button {
            background: #007bff;
            color: white;
            border: none;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            cursor: pointer;
            margin-right: 10px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            font-size: 0.875rem;
        }

        input[type="file"]::-webkit-file-upload-button:hover {
            background: #0056b3;
        }

        /* For Firefox */
        input[type="file"]::file-selector-button {
            background: #007bff;
            color: white;
            border: none;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            cursor: pointer;
            margin-right: 10px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            font-size: 0.875rem;
        }

        input[type="file"]::file-selector-button:hover {
            background: #0056b3;
        }
        
        @media (max-width: 991px) {
            .stat-card {
                min-height: 120px;
                padding: 20px;
            }
            
            .stat-card .stat-icon {
                width: 48px;
                height: 48px;
                font-size: 20px;
                margin-bottom: 12px;
            }
            
            .stat-card .stat-value {
                font-size: 2rem;
            }

            .modal-dialog.modal-lg {
                max-width: 95%;
                margin: 0.5rem auto;
            }

            .modal-body .row {
                flex-direction: column;
            }

            .modal-body .col-md-8,
            .modal-body .col-md-4 {
                max-width: 100%;
                flex: 0 0 100%;
            }

            .course-image {
                width: 40px;
                height: 40px;
            }

            .modal-body .card {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 576px) {
            .btn-group .btn {
                padding: 0.375rem 0.5rem;
                font-size: 0.875rem;
            }
            
            .table-responsive {
                font-size: 0.875rem;
            }

            .course-image {
                width: 35px;
                height: 35px;
            }

            .modal-dialog.modal-lg {
                max-width: 98%;
                margin: 0.25rem auto;
            }

            .modal-body {
                padding: 1rem !important;
            }

            .form-control-lg,
            .form-select-lg {
                font-size: 1rem;
                padding: 0.5rem 0.75rem;
            }

            .btn-lg {
                padding: 0.5rem 1rem;
                font-size: 1rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')

    <!-- Welcome Card -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="text-gradient text-primary">Educational Courses Management</h1>
                    <p class="mb-0">Manage, add, and edit educational courses and materials</p>
                </div>
                <div class="col-lg-6 text-end">
                    <a href="{{ route('admin.educational-courses.create') }}" class="btn btn-primary mb-0">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Course
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card primary">
                <div class="stat-icon primary">
                    <i class="fas fa-book"></i>
                </div>
                <div class="stat-title">Total Courses</div>
                <div class="stat-value">{{ $totalCourses }}</div>
                <div class="stat-description">
                    <span class="highlight success">+{{ $courses->count() }}</span> on this page
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-title">Active Courses</div>
                <div class="stat-value">{{ $activeCourses }}</div>
                <div class="stat-description">
                    <span class="highlight success">{{ round(($activeCourses / max($totalCourses, 1)) * 100) }}%</span> are active
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card info">
                <div class="stat-icon info">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="stat-title">Linked Categories</div>
                <div class="stat-value">{{ $linkedCategories }}</div>
                <div class="stat-description">
                    <span class="highlight info">{{ $linkedCategories }}</span> categories linked
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-title">Latest Course</div>
                <div class="stat-value">{{ $latestCourse ? \Illuminate\Support\Str::limit($latestCourse->title, 10) : '-' }}</div>
                <div class="stat-description">
                    <span class="highlight warning">{{ $latestCourse ? $latestCourse->created_at->diffForHumans() : 'None' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Status Filter</label>
                        <select id="status-filter" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="Active">Active</option>
                            <option value="Archived">Archived</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Category Filter</label>
                        <select id="category-filter" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categoriesList as $category)
                                <option value="{{ strtolower($category->name) }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Search Courses</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input id="search-input" type="text" class="form-control" placeholder="Search by course title...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Courses Table -->
    <div class="card">
        <div class="card-header pb-0">
            <h6 class="text-primary fw-bold">Educational Courses</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Course Details</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Course ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Category</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Price</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Created Date</th>
                            <th class="text-secondary opacity-7">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr data-title="{{ strtolower($course->title) }}" data-status="{{ $course->status }}"
                                data-category="{{ strtolower($course->category?->name ?? '') }}">
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ $course->image ? asset('storage/' . $course->image) : asset('images/theme/course-default.png') }}"
                                                class="avatar avatar-sm me-3 course-image" alt="course">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $course->title }}</h6>
                                            <p class="text-xs text-secondary mb-0">
                                                {{ \Illuminate\Support\Str::limit($course->description, 50) ?: 'No description available' }}
                                            </p>
                                            <small class="text-xs text-info">
                                                <i class="fas fa-clock me-1"></i>{{ $course->credit_hours }} Credit Hours
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">
                                        CRS-{{ str_pad($course->id, 3, '0', STR_PAD_LEFT) }}</p>
                                </td>
                                <td>
                                    <span class="badge badge-sm bg-gradient-info">{{ $course->category?->name ?? 'No Category' }}</span>
                                </td>
                                <td class="price-display">
                                    @if($course->is_free)
                                        <span class="badge badge-sm bg-gradient-success">Free</span>
                                    @else
                                        @if($course->hasDiscount())
                                            <div class="text-decoration-line-through text-muted small">
                                                {{ $course->formatted_original_price }}
                                            </div>
                                            <div class="text-success fw-bold small">
                                                {{ $course->formatted_price }}
                                            </div>
                                            <span class="badge bg-danger small">{{ $course->discount_percentage }}% OFF</span>
                                        @else
                                            <div class="text-primary fw-bold small">
                                                {{ $course->formatted_price }}
                                            </div>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    @if($course->status === 'active')
                                        <span class="badge badge-sm bg-gradient-success">Active</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-warning">Archived</span>
                                    @endif
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ $course->created_at->format('Y-m-d') }}
                                    </p>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="btn btn-link text-info p-2" data-bs-toggle="modal"
                                            data-bs-target="#editCourseModal-{{ $course->id }}"
                                            title="Edit Course">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <a href="{{ route('admin.educational-courses.show', $course->id) }}"
                                            class="btn btn-link text-primary p-2"
                                            title="View Course Details">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <button class="btn btn-link text-danger p-2" data-bs-toggle="modal"
                                            data-bs-target="#deleteCourseModal"
                                            onclick="confirmCourseDelete({{ $course->id }}, '{{ $course->title }}')"
                                            title="Delete Course">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fas fa-book-open fa-3x mb-3"></i>
                                        <h5>No courses found</h5>
                                        <p>Start by adding your first course to get started.</p>
                                        <a href="{{ route('admin.educational-courses.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Add First Course
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form method="POST" id="deleteCourseForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content border-0 shadow-lg">
                            <div class="modal-header bg-white text-dark border-bottom">
                                <h5 class="modal-title fw-bold" id="deleteCourseModalLabel">
                                    <i class="fas fa-exclamation-triangle me-2 text-danger"></i>Confirm Deletion
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4 text-center bg-white">
                                <div class="mb-4">
                                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-trash-alt text-white text-lg opacity-10" style="font-size: 2rem; line-height: 80px;"></i>
                                    </div>
                                    <h4 class="text-danger fw-bold mb-3">Are you sure?</h4>
                                    <p class="text-muted mb-2">You are about to delete the course:</p>
                                    <div class="alert alert-warning border-0 bg-light-warning">
                                        <strong class="text-warning" id="courseNamePlaceholder"></strong>
                                    </div>
                                    <div class="alert alert-danger border-0 bg-light-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <strong>This action cannot be undone!</strong>
                                        <br>
                                        <small>All associated data will be permanently removed.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-white border-top justify-content-center">
                                <button type="button" class="btn btn-secondary btn-lg px-4 me-3" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </button>
                                <button type="submit" class="btn btn-danger btn-lg px-4">
                                    <i class="fas fa-trash-alt me-2"></i>Delete Course
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center p-3">
                <p class="text-sm mb-0">Showing
                    {{ $courses->firstItem() }}-{{ $courses->lastItem() }} of
                    {{ $courses->total() }} courses
                </p>
                {{ $courses->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    @foreach ($courses as $course)
        <!-- Edit Course Modal -->
        <div class="modal fade" id="editCourseModal-{{ $course->id }}" tabindex="-1"
            aria-labelledby="editCourseModalLabel-{{ $course->id }}" aria-hidden="true"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('admin.educational-courses.update', $course->id) }}" method="POST"
                    enctype="multipart/form-data" class="modal-content border-0 shadow-lg">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-white text-dark border-bottom">
                        <h5 class="modal-title fw-bold" id="editCourseModalLabel-{{ $course->id }}">
                            <i class="fas fa-edit me-2 text-primary"></i>Edit Course
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 bg-white">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-primary">
                                        <i class="fas fa-book me-2"></i>Course Title
                                    </label>
                                    <input type="text" name="title" value="{{ old('title', $course->title) }}"
                                        class="form-control form-control-lg border-2 border-light @error('title') is-invalid @enderror"
                                        placeholder="Enter course title..." required>
                                    @error('title')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold text-primary">
                                                <i class="fas fa-clock me-2"></i>Credit Hours
                                            </label>
                                            <input type="number" name="credit_hours" value="{{ old('credit_hours', $course->credit_hours) }}"
                                                class="form-control border-2 border-light @error('credit_hours') is-invalid @enderror"
                                                placeholder="Enter credit hours..." required>
                                            @error('credit_hours')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold text-primary">
                                                <i class="fas fa-tag me-2"></i>Category
                                            </label>
                                            <select name="category_id" class="form-select border-2 border-light @error('category_id') is-invalid @enderror" required>
                                                <option value="">Select Category</option>
                                                @foreach ($categoriesList as $cat)
                                                    <option value="{{ $cat->id }}" {{ old('category_id', $course->category_id) == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold text-primary">
                                                <i class="fas fa-toggle-on me-2"></i>Status
                                            </label>
                                            <select name="status" class="form-select border-2 border-light @error('status') is-invalid @enderror">
                                                <option value="active" {{ old('status', $course->status) === 'active' ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="archived" {{ old('status', $course->status) === 'archived' ? 'selected' : '' }}>
                                                    Archived
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Pricing Section - Compact -->
                                <div class="border rounded-3 p-3 bg-light">
                                    <h6 class="mb-3 fw-bold text-primary">
                                        <i class="fas fa-dollar-sign me-2"></i>Pricing Information
                                    </h6>
                                    
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="is_free" id="isFree-{{ $course->id }}" value="1" 
                                               {{ old('is_free', $course->is_free) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-bold text-success" for="isFree-{{ $course->id }}">
                                            <i class="fas fa-gift me-1"></i>This course is free
                                        </label>
                                    </div>
                                    
                                    <div id="priceFields-{{ $course->id }}" class="{{ old('is_free', $course->is_free) ? 'd-none' : '' }}">
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <label class="form-label small">Price</label>
                                                <input type="number" name="price" class="form-control form-control-sm border-2 border-light" 
                                                       step="0.01" min="0" value="{{ old('price', $course->price) }}">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Currency</label>
                                                <select name="currency" class="form-select form-select-sm border-2 border-light">
                                                    <option value="USD" {{ old('currency', $course->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                                                    <option value="SAR" {{ old('currency', $course->currency) == 'SAR' ? 'selected' : '' }}>SAR</option>
                                                    <option value="AED" {{ old('currency', $course->currency) == 'AED' ? 'selected' : '' }}>AED</option>
                                                    <option value="EUR" {{ old('currency', $course->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                                                </select>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Discount %</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="number" name="discount_percentage" class="form-control border-2 border-light" 
                                                           step="0.01" min="0" max="100" value="{{ old('discount_percentage', $course->discount_percentage) }}">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small">Final Price</label>
                                                <div class="form-control form-control-sm bg-success text-white fw-bold text-center" id="finalPrice-{{ $course->id }}">
                                                    {{ $course->formatted_price }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-primary">
                                        <i class="fas fa-image me-2"></i>Course Image
                                    </label>
                                    <div class="border-2 border-dashed border-light rounded-3 p-3 text-center bg-light">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" id="courseImage-{{ $course->id }}" lang="en">
                                        <small class="text-muted d-block mt-2">Upload new image (optional)</small>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @if ($course->image)
                                        <div class="mt-3 text-center">
                                            <label class="form-label fw-bold text-success">Current Image:</label>
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ asset('storage/' . $course->image) }}"
                                                    class="img-thumbnail rounded-3 shadow-sm"
                                                    width="150" alt="Current course image">
                                                <div class="position-absolute top-0 end-0">
                                                    <span class="badge bg-success rounded-pill">
                                                        <i class="fas fa-check"></i> Current
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-bold text-primary">
                                        <i class="fas fa-align-left me-2"></i>Description
                                    </label>
                                    <textarea name="description" class="form-control border-2 border-light @error('description') is-invalid @enderror"
                                        rows="4" placeholder="Enter course description...">{{ old('description', $course->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-white border-top">
                        <button type="button" class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Set page language to English to ensure file input displays English text
        document.documentElement.lang = 'en';
        
        function confirmCourseDelete(courseId, courseTitle) {
            const form = document.getElementById('deleteCourseForm');
            const namePlaceholder = document.getElementById('courseNamePlaceholder');
            namePlaceholder.textContent = `"${courseTitle}"`;
            form.action = `/admin/educational-courses/${courseId}`;
        }

        // Price calculation functions for modals
        function setupPriceCalculation(courseId) {
            const isFreeCheckbox = document.getElementById(`isFree-${courseId}`);
            const priceFields = document.getElementById(`priceFields-${courseId}`);
            const priceInput = document.querySelector(`#editCourseModal-${courseId} input[name="price"]`);
            const discountInput = document.querySelector(`#editCourseModal-${courseId} input[name="discount_percentage"]`);
            const currencySelect = document.querySelector(`#editCourseModal-${courseId} select[name="currency"]`);
            const finalPriceElement = document.getElementById(`finalPrice-${courseId}`);

            if (isFreeCheckbox) {
                isFreeCheckbox.addEventListener('change', function(e) {
                    if (this.checked) {
                        priceFields.classList.add('d-none');
                        if (priceInput) priceInput.value = '0';
                        if (discountInput) discountInput.value = '0';
                        updateFinalPrice();
                    } else {
                        priceFields.classList.remove('d-none');
                    }
                });
            }

            function updateFinalPrice() {
                const price = parseFloat(priceInput?.value) || 0;
                const discount = parseFloat(discountInput?.value) || 0;
                const currency = currencySelect?.value || 'USD';
                const isFree = isFreeCheckbox?.checked || false;
                
                let finalPrice = 0;
                
                if (!isFree && price > 0) {
                    if (discount > 0) {
                        const discountAmount = (price * discount) / 100;
                        finalPrice = price - discountAmount;
                    } else {
                        finalPrice = price;
                    }
                }
                
                if (finalPriceElement) {
                    if (isFree || finalPrice === 0) {
                        finalPriceElement.innerHTML = '<span class="badge bg-success">Free</span>';
                    } else {
                        finalPriceElement.textContent = `${currency} ${finalPrice.toFixed(2)}`;
                    }
                }
            }

            // Add event listeners for price calculation
            if (priceInput) {
                priceInput.addEventListener('input', updateFinalPrice);
            }
            
            if (discountInput) {
                discountInput.addEventListener('input', updateFinalPrice);
            }
            
            if (currencySelect) {
                currencySelect.addEventListener('change', updateFinalPrice);
            }

            // Initialize final price on modal show
            const modal = document.getElementById(`editCourseModal-${courseId}`);
            if (modal) {
                modal.addEventListener('shown.bs.modal', function() {
                    updateFinalPrice();
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Force English for all file inputs
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.setAttribute('lang', 'en');
                input.style.fontFamily = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
            });

            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('status-filter');
            const categoryFilter = document.getElementById('category-filter');
            const tableRows = document.querySelectorAll('table tbody tr[data-title]');

            function filterCourses() {
                const searchText = searchInput.value.toLowerCase();
                const selectedStatus = statusFilter.value;
                const selectedCategory = categoryFilter.value;

                tableRows.forEach(row => {
                    const title = row.dataset.title;
                    const status = row.dataset.status;
                    const category = row.dataset.category;
                    
                    // Convert status to display format for comparison
                    const displayStatus = status === 'active' ? 'Active' : 'Archived';

                    const matchesSearch = title.includes(searchText);
                    const matchesStatus = selectedStatus === '' || displayStatus === selectedStatus;
                    const matchesCategory = selectedCategory === '' || category === selectedCategory;

                    row.style.display = (matchesSearch && matchesStatus && matchesCategory) ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterCourses);
            statusFilter.addEventListener('change', filterCourses);
            categoryFilter.addEventListener('change', filterCourses);

            // Setup price calculation for all course modals
            @foreach($courses as $course)
                setupPriceCalculation({{ $course->id }});
            @endforeach
        });
    </script>
@endpush