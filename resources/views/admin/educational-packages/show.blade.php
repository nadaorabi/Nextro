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
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
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
            max-width: 200px;
            border-radius: 10px;
        }
        @media (max-width: 600px) {
            .card-body {
                padding: 1rem 0.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
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
                    <div class="btn-group">
                        <a href="{{ route('admin.educational-packages.edit', $package) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Edit
                        </a>
                        <button type="button" class="btn btn-danger" onclick="deletePackage({{ $package->id }})">
                            <i class="fas fa-trash me-2"></i>
                            Delete
                        </button>
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
                                        <div class="col-md-3">
                                            <strong>Category:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            <span class="badge bg-info">{{ $package->category->name ?? 'No Category' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Price:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            <span class="text-primary fw-bold">
                                                {{ $package->price }} {{ $package->currency ?? 'USD' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Status:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            <span class="badge {{ $package->status == 'active' ? 'bg-success' : 'bg-secondary' }} status-badge">
                                                {{ ucfirst($package->status) }}
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
                                
                                @if($package->image)
                                    <img src="{{ asset('storage/' . $package->image) }}" 
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
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">Included Courses</h5>
                            <span class="badge bg-primary">{{ $package->courses->count() }} courses</span>
                            <button class="btn btn-success btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#addCoursesModal">
                                <i class="fas fa-plus"></i> Add Courses
                            </button>
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
                                                
                                                <div class="mt-3">
                                                    <a href="{{ route('admin.educational-courses.show', $course) }}" 
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-eye me-1"></i>
                                                        View Course
                                                    </a>
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
                                <p class="text-muted">Edit the package to add courses.</p>
                                <a href="{{ route('admin.educational-packages.edit', $package) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>
                                    Edit Package
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Students Section -->
                @if($package->students->count() > 0)
                    <div class="card shadow-sm mt-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Enrolled Students</h5>
                                <span class="badge bg-success">{{ $package->students->count() }} students</span>
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
                                        @foreach($package->students as $studentPackage)
                                            <tr>
                                                <td>{{ $studentPackage->student->name ?? 'N/A' }}</td>
                                                <td>{{ $studentPackage->student->email ?? 'N/A' }}</td>
                                                <td>{{ $studentPackage->created_at->format('M d, Y') }}</td>
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
                        <h5 class="modal-title">Add Courses to Package</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control mb-3" id="searchCourseInput" placeholder="Search courses...">
                        <div style="max-height: 350px; overflow-y: auto;">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Course</th>
                                        <th>Discount (%)</th>
                                    </tr>
                                </thead>
                                <tbody id="coursesListBody">
                                    @foreach($allCourses as $course)
                                        @if(!$package->courses->contains($course->id))
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="courses[{{ $course->id }}][selected]" value="1" class="course-checkbox">
                                            </td>
                                            <td>{{ $course->title }}</td>
                                            <td>
                                                <input type="number" name="courses[{{ $course->id }}][discount]" class="form-control form-control-sm discount-input" min="0" max="100" step="0.01" disabled>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="noResultsMsg" class="text-center text-muted d-none">No results found.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Selected Courses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function deletePackage(packageId) {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const form = document.getElementById('deleteForm');
            form.action = `/admin/educational-packages/${packageId}`;
            modal.show();
        }

        // بحث ديناميكي
        document.getElementById('searchCourseInput').addEventListener('input', function() {
            let val = this.value.toLowerCase();
            let rows = document.querySelectorAll('#coursesListBody tr');
            let found = false;
            rows.forEach(row => {
                let text = row.children[1].innerText.toLowerCase();
                if(text.includes(val)) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });
            document.getElementById('noResultsMsg').classList.toggle('d-none', found);
        });

        // تفعيل حقل الخصم عند اختيار الكورس
        document.querySelectorAll('.course-checkbox').forEach(cb => {
            cb.addEventListener('change', function() {
                let discountInput = this.closest('tr').querySelector('.discount-input');
                discountInput.disabled = !this.checked;
                if(!this.checked) discountInput.value = '';
            });
        });
    </script>
@endpush
