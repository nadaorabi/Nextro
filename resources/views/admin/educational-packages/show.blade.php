@extends('layouts.admin')

@section('title', 'Package Details')

@push('styles')
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .card-body {
            padding: 2rem 2.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #344767;
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
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
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .info-row {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .course-card {
            transition: transform 0.2s;
        }

        .course-card:hover {
            transform: translateY(-2px);
        }

        .package-image {
            max-width: 300px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        /* تحسين الأيقونات */
        .package-image .fas {
            font-size: 3rem;
        }

        /* Enhanced Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .btn-modern {
            border-radius: 10px;
            padding: 10px 20px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-edit {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }
        
        .btn-edit:hover {
            background: linear-gradient(45deg, #5a67d8, #6b46c1);
            transform: translateY(-2px);
            color: white;
        }
        
        .btn-delete {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
        }
        
        .btn-delete:hover {
            background: linear-gradient(45deg, #ff5252, #d32f2f);
            transform: translateY(-2px);
            color: white;
        }

        /* Enhanced Modal */
        .modal-content {
            border-radius: 15px;
            border: none;
        }
        
        .modal-header {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px 30px;
            border: none;
        }
        
        .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }
        
        .modal-header .btn-close:hover {
            opacity: 1;
        }
        
        .modal-body {
            padding: 30px;
        }
        
        .modal-footer {
            padding: 20px 30px;
            border-top: 1px solid #eee;
            border-radius: 0 0 15px 15px;
        }

        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: #667eea;
            font-weight: 700;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        @media (max-width: 600px) {
            .card-body {
                padding: 1rem;
            }
            
            .action-buttons {
                justify-content: center;
                width: 100%;
            }
            
            .btn-modern {
                flex: 1;
                justify-content: center;
                min-width: 120px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <!-- Header Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start flex-wrap">
                            <div class="mb-3 mb-lg-0">
                                <h4 class="mb-1 fw-bold text-primary">
                                    <i class="fas fa-box me-2"></i>
                                    Package Details
                                </h4>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('admin.educational-packages.index') }}">Packages</a></li>
                                        <li class="breadcrumb-item active">{{ $package->name }}</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="action-buttons">
                                <a href="{{ route('admin.educational-packages.edit', $package) }}" class="btn btn-modern btn-edit">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <button type="button" class="btn btn-modern btn-delete" onclick="deletePackage({{ $package->id }})">
                                    <i class="fas fa-trash"></i>
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package Information -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Package Information</h5>
                                
                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Name:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            {{ $package->name }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Description:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            {{ $package->description ?: 'No description available' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong>Category:</strong>
                                                </div>
                                                <div class="col-6">
                                                    <span class="badge bg-info">{{ $package->category->name ?? 'No Category' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-6">
                                                    <strong>Status:</strong>
                                                </div>
                                                <div class="col-6">
                                                    <span class="badge {{ $package->status == 'active' ? 'bg-success' : 'bg-secondary' }} status-badge">
                                                        {{ ucfirst($package->status) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Original Price:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            <span class="text-primary fw-bold">
                                                {{ $package->original_price }} {{ $package->currency ?? 'USD' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Final Price:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            <span class="text-success fw-bold">
                                                {{ $package->discounted_price ?? $package->original_price }} {{ $package->currency ?? 'USD' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Created:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            {{ $package->created_at->format('F d, Y \a\t g:i A') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Last Updated:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            {{ $package->updated_at->format('F d, Y \a\t g:i A') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Package Image</h5>
                                
                                @if($package->hasImage())
                                    <img src="{{ $package->getImageUrl() }}" 
                                         alt="Package Image" class="img-fluid package-image">
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No image available</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Statistics -->
                        <div class="card shadow-sm mt-4">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Statistics</h5>
                                
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="text-primary fw-bold fs-4">{{ $package->courses->count() }}</div>
                                        <div class="text-muted small">Courses</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-success fw-bold fs-4">{{ $package->students->count() }}</div>
                                        <div class="text-muted small">Students</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses Section -->
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                            <h5 class="card-title mb-0">Included Courses</h5>
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <span class="badge bg-primary">{{ $package->courses->count() }} courses</span>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCoursesModal">
                                    <i class="fas fa-plus me-1"></i> Add Courses
                                </button>
                            </div>
                        </div>

                        @if($package->courses->count() > 0)
                            <div class="row">
                                @foreach($package->courses as $course)
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="card course-card h-100">
                                            <div class="card-body">
                                                <h6 class="card-title fw-bold">{{ $course->title }}</h6>
                                                <p class="card-text text-muted small">
                                                    {{ Str::limit($course->description, 100) }}
                                                </p>
                                                
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="badge bg-info">{{ $course->credit_hours }} credits</span>
                                                    <span class="badge {{ $course->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ ucfirst($course->status) }}
                                                    </span>
                                                </div>
                                                
                                                <div class="mt-3 d-flex gap-2">
                                                    <a href="{{ route('admin.educational-courses.show', $course) }}" 
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-eye me-1"></i>
                                                        View Course
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            data-bs-toggle="modal" data-bs-target="#removeCourseModal" 
                                                            data-course-id="{{ $course->id }}" 
                                                            data-course-title="{{ $course->title }}">
                                                        <i class="fas fa-trash"></i> Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">No courses assigned to this package</h6>
                                <p class="text-muted">Add courses to this package to get started.</p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCoursesModal">
                                    <i class="fas fa-plus me-2"></i>
                                    Add Courses
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Students Section -->
                @if($package->enrolledStudents->count() > 0)
                    <div class="card shadow-sm mt-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Enrolled Students</h5>
                                <span class="badge bg-success">{{ $package->enrolledStudents->count() }} students</span>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Enrollment Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($package->enrolledStudents as $student)
                                            <tr>
                                                <td>{{ $student->name ?? 'N/A' }}</td>
                                                <td>{{ $student->email ?? 'N/A' }}</td>
                                                <td>{{ $student->pivot->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <span class="badge bg-success">Enrolled</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this package? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Courses Modal -->
    <div class="modal fade" id="addCoursesModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.educational-packages.add-courses', $package) }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-plus-circle me-2"></i>
                            Add Courses to Package
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-section">
                            <h6 class="section-title">
                                <i class="fas fa-book me-2"></i>Available Courses
                            </h6>
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">
                                                <input type="checkbox" id="selectAllCourses" class="form-check-input">
                                            </th>
                                            <th>Course Title</th>
                                            <th>Credits</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allCourses as $course)
                                            @if(!$package->courses->contains($course->id))
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="courses[{{ $course->id }}][selected]" value="1" class="form-check-input course-checkbox">
                                                </td>
                                                <td>
                                                    <div>
                                                        <strong>{{ $course->title }}</strong>
                                                        @if($course->description)
                                                            <div class="text-muted small mt-1">{{ Str::limit($course->description, 80) }}</div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $course->credit_hours }}</span>
                                                </td>
                                                <td>
                                                    <strong>{{ $course->price }} {{ $package->currency ?? 'USD' }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge {{ $course->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ ucfirst($course->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>
                            Add Selected Courses
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Remove Course Modal -->
    <div class="modal fade" id="removeCourseModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="removeCourseForm" action="">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Remove Course from Package</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Are you sure you want to remove <span id="modalCourseTitle" class="fw-bold text-danger"></span> from this package?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>
                            Confirm Remove
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Select All functionality
        document.getElementById('selectAllCourses').addEventListener('change', function() {
            const isChecked = this.checked;
            const checkboxes = document.querySelectorAll('.course-checkbox');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });

        // Delete package function
        function deletePackage(packageId) {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const form = document.getElementById('deleteForm');
            form.action = `/admin/educational-packages/${packageId}`;
            modal.show();
        }

        // Remove course modal
        let removeModal = document.getElementById('removeCourseModal');
        removeModal.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget;
            let courseId = button.getAttribute('data-course-id');
            let courseTitle = button.getAttribute('data-course-title');
            
            document.getElementById('modalCourseTitle').innerText = courseTitle;
            document.getElementById('removeCourseForm').action = `/admin/educational-packages/{{ $package->id }}/remove-course/${courseId}`;
        });

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
@endpush
