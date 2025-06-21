@extends('layouts.admin')

@section('title', 'Course Details')

@push('styles')
    <style>
        .custom-icon-style {
            transform: translateY(-4px);
            display: inline-block;
        }

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
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-20px);
            }
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        .info-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .info-label {
            color: #6c757d;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3748;
        }

        .avatar-sm {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .badge-status {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
        }

        .stats-card.success {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stats-card.info {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stats-card.warning {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .course-image {
            max-width: 300px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .action-btn {
            border-radius: 10px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .list-item {
            padding: 1rem;
            border-radius: 10px;
            background: #f8f9fa;
            margin-bottom: 0.5rem;
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
        }

        .list-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">

        <!-- Welcome Card -->
        <div class="card mb-4 info-card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="text-gradient text-primary welcome-animated">Course Details 📚</h1>
                        <p class="mb-0">View and manage course information and related data</p>
                    </div>
                    <div class="col-lg-4 text-end">
                        <a href="{{ route('admin.educational-courses.index') }}" class="btn btn-secondary mb-0 me-2">
                            <i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back to Courses
                        </a>
                        <a href="{{ route('admin.educational-courses.edit', $course->id) }}" class="btn btn-primary mb-0">
                            <i class="fas fa-edit"></i>&nbsp;&nbsp;Edit Course
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Information -->
        <div class="row mb-4">
            <div class="col-lg-8">
                <div class="card info-card">
                    <div class="card-header pb-0">
                        <h6 class="section-title">
                            <i class="fas fa-book me-2"></i>Course Information
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Course Title</div>
                                <div class="info-value">{{ $course->title }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Category</div>
                                <div class="info-value">
                                    @if($course->category)
                                        <span class="badge bg-info">{{ $course->category->name }}</span>
                                    @else
                                        <span class="text-muted">No category assigned</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Credit Hours</div>
                                <div class="info-value">{{ $course->credit_hours }} hours</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Status</div>
                                <div class="info-value">
                                    @if($course->status === 'active')
                                        <span class="badge badge-status bg-success">Active</span>
                                    @else
                                        <span class="badge badge-status bg-secondary">Archived</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Created Date</div>
                                <div class="info-value">{{ $course->created_at->format('Y-m-d H:i') }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Last Updated</div>
                                <div class="info-value">{{ $course->updated_at->format('Y-m-d H:i') }}</div>
                            </div>
                        </div>
                        
                        @if($course->description)
                            <div class="mb-4">
                                <div class="info-label">Description</div>
                                <div class="info-value" style="font-weight: normal; line-height: 1.6;">
                                    {!! nl2br(e($course->description)) !!}
                                </div>
                            </div>
                        @endif

                        @if($course->image)
                            <div class="mb-4">
                                <div class="info-label">Course Image</div>
                                <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" class="course-image mt-2">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-12 mb-3">
                        <div class="card stats-card">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Enrolled Students</p>
                                            <h5 class="font-weight-bolder">{{ $course->enrollments->count() ?? 0 }}</h5>
                                            <p class="mb-0">
                                                <span class="text-light text-sm font-weight-bolder">Active enrollments</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon icon-shape bg-white shadow text-center rounded-circle">
                                            <i class="ni ni-single-02 text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card stats-card success">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Materials</p>
                                            <h5 class="font-weight-bolder">{{ $course->materials->count() ?? 0 }}</h5>
                                            <p class="mb-0">
                                                <span class="text-light text-sm font-weight-bolder">Available resources</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon icon-shape bg-white shadow text-center rounded-circle">
                                            <i class="ni ni-books text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="card stats-card info">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Instructors</p>
                                            <h5 class="font-weight-bolder">{{ $course->course_instructors->count() ?? 0 }}</h5>
                                            <p class="mb-0">
                                                <span class="text-light text-sm font-weight-bolder">Assigned teachers</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon icon-shape bg-white shadow text-center rounded-circle">
                                            <i class="ni ni-hat-3 text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card stats-card warning">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Exams</p>
                                            <h5 class="font-weight-bolder">{{ $course->exams->count() ?? 0 }}</h5>
                                            <p class="mb-0">
                                                <span class="text-light text-sm font-weight-bolder">Scheduled tests</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="icon icon-shape bg-white shadow text-center rounded-circle">
                                            <i class="ni ni-paper-diploma text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card info-card">
                    <div class="card-header pb-0">
                        <h6 class="section-title">
                            <i class="fas fa-tools me-2"></i>Quick Actions
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary action-btn" onclick="toggleCourseStatus()">
                                <i class="fas fa-toggle-on me-2"></i>Toggle Status
                            </button>
                            <button class="btn btn-outline-info action-btn" onclick="duplicateCourse()">
                                <i class="fas fa-copy me-2"></i>Duplicate Course
                            </button>
                            <button class="btn btn-outline-warning action-btn" onclick="exportCourseData()">
                                <i class="fas fa-download me-2"></i>Export Data
                            </button>
                            <button class="btn btn-outline-danger action-btn" onclick="deleteCourse()">
                                <i class="fas fa-trash me-2"></i>Delete Course
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Instructors Section -->
        <div class="card info-card mb-4">
            <div class="card-header pb-0">
                <h6 class="section-title">
                    <i class="fas fa-chalkboard-teacher me-2"></i>Course Instructors
                </h6>
            </div>
            <div class="card-body">
                @if($course->course_instructors && $course->course_instructors->count() > 0)
                    <div class="row">
                        @foreach($course->course_instructors as $instructor)
                            <div class="col-md-4 col-lg-3 mb-3">
                                <div class="list-item">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $instructor->user->avatar ? asset('storage/' . $instructor->user->avatar) : asset('images/theme/avatar-default.png') }}" 
                                             class="avatar-sm me-3" alt="Instructor">
                                        <div>
                                            <div class="fw-bold">{{ $instructor->user->name ?? 'Unknown' }}</div>
                                            <div class="text-muted small">{{ $instructor->user->email ?? 'No email' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-user-tie"></i>
                        <h5>No Instructors Assigned</h5>
                        <p>This course doesn't have any instructors assigned yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Enrolled Students Section -->
        <div class="card info-card mb-4">
            <div class="card-header pb-0">
                <h6 class="section-title">
                    <i class="fas fa-users me-2"></i>Enrolled Students
                </h6>
            </div>
            <div class="card-body">
                @if($course->enrollments && $course->enrollments->count() > 0)
                    <div class="row">
                        @foreach($course->enrollments as $enrollment)
                            <div class="col-md-4 col-lg-3 mb-3">
                                <div class="list-item">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $enrollment->student->avatar ? asset('storage/' . $enrollment->student->avatar) : asset('images/theme/avatar-default.png') }}" 
                                             class="avatar-sm me-3" alt="Student">
                                        <div>
                                            <div class="fw-bold">{{ $enrollment->student->name ?? 'Unknown' }}</div>
                                            <div class="text-muted small">{{ $enrollment->student->email ?? 'No email' }}</div>
                                            <div class="text-muted small">Enrolled: {{ $enrollment->created_at->format('Y-m-d') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-user-graduate"></i>
                        <h5>No Students Enrolled</h5>
                        <p>No students have enrolled in this course yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Materials Section -->
        <div class="card info-card mb-4">
            <div class="card-header pb-0">
                <h6 class="section-title">
                    <i class="fas fa-book-open me-2"></i>Course Materials
                </h6>
            </div>
            <div class="card-body">
                @if($course->materials && $course->materials->count() > 0)
                    <div class="row">
                        @foreach($course->materials as $material)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="list-item">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            @if($material->type === 'pdf')
                                                <i class="fas fa-file-pdf text-danger fa-2x"></i>
                                            @elseif($material->type === 'video')
                                                <i class="fas fa-video text-primary fa-2x"></i>
                                            @elseif($material->type === 'document')
                                                <i class="fas fa-file-word text-info fa-2x"></i>
                                            @else
                                                <i class="fas fa-file text-secondary fa-2x"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $material->title }}</div>
                                            <div class="text-muted small">{{ ucfirst($material->type) }}</div>
                                            <div class="text-muted small">Added: {{ $material->created_at->format('Y-m-d') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-file-alt"></i>
                        <h5>No Materials Available</h5>
                        <p>No materials have been added to this course yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Exams Section -->
        <div class="card info-card mb-4">
            <div class="card-header pb-0">
                <h6 class="section-title">
                    <i class="fas fa-clipboard-check me-2"></i>Course Exams
                </h6>
            </div>
            <div class="card-body">
                @if($course->exams && $course->exams->count() > 0)
                    <div class="row">
                        @foreach($course->exams as $exam)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="list-item">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-clipboard-list text-warning fa-2x"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $exam->title }}</div>
                                            <div class="text-muted small">Date: {{ $exam->date ?? 'Not set' }}</div>
                                            <div class="text-muted small">Duration: {{ $exam->duration ?? 'Not set' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-clipboard-list"></i>
                        <h5>No Exams Scheduled</h5>
                        <p>No exams have been scheduled for this course yet.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Complaints Section -->
        <div class="card info-card mb-4">
            <div class="card-header pb-0">
                <h6 class="section-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Course Complaints
                </h6>
            </div>
            <div class="card-body">
                @if($course->complaints && $course->complaints->count() > 0)
                    <div class="row">
                        @foreach($course->complaints as $complaint)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="list-item">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-exclamation-circle text-danger fa-2x"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $complaint->title }}</div>
                                            <div class="text-muted small">Status: {{ ucfirst($complaint->status ?? 'pending') }}</div>
                                            <div class="text-muted small">Date: {{ $complaint->created_at->format('Y-m-d') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-thumbs-up"></i>
                        <h5>No Complaints</h5>
                        <p>No complaints have been filed for this course.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Packages Section -->
        @if($course->packages && $course->packages->count() > 0)
        <div class="card info-card mb-4">
            <div class="card-header pb-0">
                <h6 class="section-title">
                    <i class="fas fa-box me-2"></i>Course Packages
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($course->packages as $package)
                        <div class="col-md-6 col-lg-4 mb-3">
                            <div class="list-item">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-box text-success fa-2x"></i>
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $package->name }}</div>
                                        <div class="text-muted small">Price: {{ $package->price ?? '0' }} {{ $package->currency ?? 'USD' }}</div>
                                        <div class="text-muted small">Status: {{ ucfirst($package->status ?? 'active') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                            <strong class="text-warning">{{ $course->title }}</strong>
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
                    <form action="{{ route('admin.educational-courses.destroy', $course->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-lg px-4">
                            <i class="fas fa-trash-alt me-2"></i>Delete Course
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function toggleCourseStatus() {
            if (confirm('Are you sure you want to toggle the course status?')) {
                window.location.href = "{{ route('admin.educational-courses.toggle-status', $course->id) }}";
            }
        }

        function duplicateCourse() {
            if (confirm('Are you sure you want to duplicate this course?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('admin.educational-courses.duplicate', $course->id) }}";
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                form.appendChild(csrfToken);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function exportCourseData() {
            window.location.href = "{{ route('admin.educational-courses.export') }}?course_id={{ $course->id }}";
        }

        function deleteCourse() {
            const modal = new bootstrap.Modal(document.getElementById('deleteCourseModal'));
            modal.show();
        }
    </script>
@endpush
