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

        .management-actions {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
        }

        .management-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 10px;
            padding: 0.75rem 1rem;
            margin: 0.25rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .management-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-xl {
            max-width: 90%;
        }

        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 0.75rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
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
                        <button class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#editCourseModal">
                            <i class="fas fa-edit"></i>&nbsp;&nbsp;Edit Course
                        </button>
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
                                    <span class="badge badge-status {{ $course->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($course->status) }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Price</div>
                                <div class="info-value">
                                    @if($course->is_free)
                                        <span class="badge bg-success">Free</span>
                                    @else
                                        <div>
                                            @if($course->hasDiscount())
                                                <div class="text-decoration-line-through text-muted">
                                                    {{ $course->formatted_original_price }}
                                                </div>
                                                <div class="text-success fw-bold">
                                                    {{ $course->formatted_price }}
                                                    <span class="badge bg-danger ms-2">{{ $course->discount_percentage }}% OFF</span>
                                                </div>
                                            @else
                                                <div class="text-primary fw-bold">
                                                    {{ $course->formatted_price }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Created Date</div>
                                <div class="info-value">{{ $course->created_at->format('F d, Y \a\t g:i A') }}</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="info-label">Last Updated</div>
                                <div class="info-value">{{ $course->updated_at->format('F d, Y \a\t g:i A') }}</div>
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

                <!-- Management Actions -->
                <div class="management-actions">
                    <h6 class="text-white mb-3">
                        <i class="fas fa-tools me-2"></i>Course Management
                    </h6>
                    <div class="d-grid gap-2">
                        <a href="#" class="management-btn" data-bs-toggle="modal" data-bs-target="#addInstructorModal">
                            <i class="fas fa-user-plus me-2"></i>Add Instructor
                        </a>
                        <a href="#" class="management-btn" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                            <i class="fas fa-user-graduate me-2"></i>Add Student
                        </a>
                        <a href="#" class="management-btn" data-bs-toggle="modal" data-bs-target="#addMaterialModal">
                            <i class="fas fa-file-upload me-2"></i>Add Material
                        </a>
                        <a href="#" class="management-btn" data-bs-toggle="modal" data-bs-target="#addExamModal">
                            <i class="fas fa-clipboard-list me-2"></i>Add Exam
                        </a>
                        <a href="#" class="management-btn" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                            <i class="fas fa-calendar-plus me-2"></i>Add Schedule
                        </a>
                        <a href="#" class="management-btn" onclick="toggleCourseStatus()">
                            <i class="fas fa-toggle-on me-2"></i>Toggle Status
                        </a>
                        <a href="#" class="management-btn" onclick="duplicateCourse()">
                            <i class="fas fa-copy me-2"></i>Duplicate Course
                        </a>
                        <a href="#" class="management-btn" onclick="exportCourseData()">
                            <i class="fas fa-download me-2"></i>Export Data
                        </a>
                        <a href="#" class="management-btn" onclick="deleteCourse()">
                            <i class="fas fa-trash me-2"></i>Delete Course
                        </a>
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

        <!-- Schedules Section -->
        <div class="card info-card mb-4">
            <div class="card-header pb-0">
                <h6 class="section-title">
                    <i class="fas fa-calendar-alt me-2"></i>Course Schedules
                </h6>
            </div>
            <div class="card-body">
                @if($course->schedules && $course->schedules->count() > 0)
                    <div class="row">
                        @foreach($course->schedules as $schedule)
                            <div class="col-md-6 col-lg-4 mb-3">
                                <div class="list-item">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-clock text-success fa-2x"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $schedule->title ?? 'Schedule' }}</div>
                                            <div class="text-muted small">Day: {{ $schedule->day ?? 'Not set' }}</div>
                                            <div class="text-muted small">Time: {{ $schedule->time ?? 'Not set' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-calendar-alt"></i>
                        <h5>No Schedules Set</h5>
                        <p>No schedules have been set for this course yet.</p>
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

    <!-- Edit Course Modal -->
    <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl">
            <form action="{{ route('admin.educational-courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="editCourseModalLabel">
                        <i class="fas fa-edit me-2"></i>Edit Course
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold text-primary">
                                    <i class="fas fa-book me-2"></i>Course Title
                                </label>
                                <input type="text" name="title" value="{{ $course->title }}" 
                                    class="form-control form-control-lg" 
                                    placeholder="Enter course title..." required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-primary">
                                    <i class="fas fa-clock me-2"></i>Credit Hours
                                </label>
                                <input type="number" name="credit_hours" value="{{ $course->credit_hours }}" 
                                    class="form-control form-control-lg" 
                                    placeholder="Enter credit hours..." required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-primary">
                                    <i class="fas fa-tag me-2"></i>Category
                                </label>
                                <select name="category_id" class="form-select form-select-lg" required>
                                    @foreach ($categories ?? [] as $cat)
                                        <option value="{{ $cat->id }}" {{ $course->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold text-primary">
                                    <i class="fas fa-toggle-on me-2"></i>Status
                                </label>
                                <select name="status" class="form-select form-select-lg">
                                    <option value="active" {{ $course->status === 'active' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="archived" {{ $course->status === 'archived' ? 'selected' : '' }}>
                                        Archived
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold text-primary">
                                    <i class="fas fa-align-left me-2"></i>Description
                                </label>
                                <textarea name="description" class="form-control"
                                    rows="4" placeholder="Enter course description...">{{ $course->description }}</textarea>
                            </div>
                            
                            <!-- Price Section -->
                            <div class="card mb-4">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 fw-bold">
                                        <i class="fas fa-dollar-sign me-2"></i>
                                        Pricing Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_free" id="isFree" value="1" 
                                                   {{ $course->is_free ? 'checked' : '' }}>
                                            <label class="form-check-label" for="isFree">
                                                This course is free
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <div id="priceFields" class="{{ $course->is_free ? 'd-none' : '' }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Price</label>
                                                    <input type="number" name="price" class="form-control" 
                                                           step="0.01" min="0" value="{{ $course->price }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Currency</label>
                                                    <select name="currency" class="form-select">
                                                        <option value="USD" {{ $course->currency == 'USD' ? 'selected' : '' }}>USD</option>
                                                        <option value="SAR" {{ $course->currency == 'SAR' ? 'selected' : '' }}>SAR</option>
                                                        <option value="AED" {{ $course->currency == 'AED' ? 'selected' : '' }}>AED</option>
                                                        <option value="EUR" {{ $course->currency == 'EUR' ? 'selected' : '' }}>EUR</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Discount Percentage</label>
                                                    <div class="input-group">
                                                        <input type="number" name="discount_percentage" class="form-control" 
                                                               step="0.01" min="0" max="100" value="{{ $course->discount_percentage }}">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                    <small class="text-muted">Enter 0 for no discount</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Final Price</label>
                                                    <div class="form-control-plaintext" id="finalPrice">
                                                        {{ $course->formatted_price }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <!-- Add Instructor Modal -->
    <div class="modal fade" id="addInstructorModal" tabindex="-1" aria-labelledby="addInstructorModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.course.instructors.store') }}" method="POST" class="modal-content border-0 shadow-lg">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addInstructorModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Add Instructor to Course
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Select Instructor</label>
                        <select name="instructor_id" class="form-select form-select-lg" required>
                            <option value="">Choose an instructor...</option>
                            @foreach($teachers ?? [] as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }} ({{ $teacher->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Role</label>
                        <select name="role" class="form-select form-select-lg" required>
                            <option value="primary">Primary Instructor</option>
                            <option value="assistant">Assistant Instructor</option>
                            <option value="guest">Guest Lecturer</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Notes</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Any additional notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-plus me-2"></i>Add Instructor
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.course.enrollments.store') }}" method="POST" class="modal-content border-0 shadow-lg">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addStudentModalLabel">
                        <i class="fas fa-user-graduate me-2"></i>Enroll Student in Course
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Select Student</label>
                        <select name="student_id" class="form-select form-select-lg" required>
                            <option value="">Choose a student...</option>
                            @foreach($students ?? [] as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Enrollment Date</label>
                        <input type="date" name="enrollment_date" class="form-control form-control-lg" 
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select form-select-lg" required>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="dropped">Dropped</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Notes</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="Any additional notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-plus me-2"></i>Enroll Student
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Material Modal -->
    <div class="modal fade" id="addMaterialModal" tabindex="-1" aria-labelledby="addMaterialModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.course.materials.store') }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addMaterialModalLabel">
                        <i class="fas fa-file-upload me-2"></i>Add Course Material
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Material Title</label>
                        <input type="text" name="title" class="form-control form-control-lg" 
                               placeholder="Enter material title..." required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter material description..."></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Type</label>
                        <select name="type" class="form-select form-select-lg" required>
                            <option value="">Select type...</option>
                            <option value="pdf">PDF Document</option>
                            <option value="video">Video</option>
                            <option value="document">Word Document</option>
                            <option value="presentation">Presentation</option>
                            <option value="link">External Link</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">File or URL</label>
                        <input type="file" name="file" class="form-control form-control-lg" 
                               accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4,.avi,.mov">
                        <small class="text-muted">Or enter URL for external links</small>
                        <input type="url" name="url" class="form-control mt-2" placeholder="https://example.com">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select form-select-lg" required>
                            <option value="active">Active</option>
                            <option value="draft">Draft</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-plus me-2"></i>Add Material
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Exam Modal -->
    <div class="modal fade" id="addExamModal" tabindex="-1" aria-labelledby="addExamModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.course.exams.store') }}" method="POST" class="modal-content border-0 shadow-lg">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addExamModalLabel">
                        <i class="fas fa-clipboard-list me-2"></i>Add Course Exam
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Exam Title</label>
                        <input type="text" name="title" class="form-control form-control-lg" 
                               placeholder="Enter exam title..." required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter exam description..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Exam Date</label>
                                <input type="date" name="date" class="form-control form-control-lg" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Duration (minutes)</label>
                                <input type="number" name="duration" class="form-control form-control-lg" 
                                       placeholder="120" min="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Total Marks</label>
                                <input type="number" name="total_marks" class="form-control form-control-lg" 
                                       placeholder="100" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Passing Marks</label>
                                <input type="number" name="passing_marks" class="form-control form-control-lg" 
                                       placeholder="50" min="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select form-select-lg" required>
                            <option value="scheduled">Scheduled</option>
                            <option value="active">Active</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-plus me-2"></i>Add Exam
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Schedule Modal -->
    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.course.schedules.store') }}" method="POST" class="modal-content border-0 shadow-lg">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addScheduleModalLabel">
                        <i class="fas fa-calendar-plus me-2"></i>Add Course Schedule
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Schedule Title</label>
                        <input type="text" name="title" class="form-control form-control-lg" 
                               placeholder="Enter schedule title..." required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter schedule description..."></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Day of Week</label>
                                <select name="day" class="form-select form-select-lg" required>
                                    <option value="">Select day...</option>
                                    <option value="monday">Monday</option>
                                    <option value="tuesday">Tuesday</option>
                                    <option value="wednesday">Wednesday</option>
                                    <option value="thursday">Thursday</option>
                                    <option value="friday">Friday</option>
                                    <option value="saturday">Saturday</option>
                                    <option value="sunday">Sunday</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Time</label>
                                <input type="time" name="time" class="form-control form-control-lg" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Duration (minutes)</label>
                                <input type="number" name="duration" class="form-control form-control-lg" 
                                       placeholder="90" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold">Room/Location</label>
                                <input type="text" name="location" class="form-control form-control-lg" 
                                       placeholder="Room 101 or Online">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Status</label>
                        <select name="status" class="form-select form-select-lg" required>
                            <option value="active">Active</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-plus me-2"></i>Add Schedule
                    </button>
                </div>
            </form>
        </div>
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
        // Price calculation for edit modal
        function setupPriceCalculation() {
            const isFreeCheckbox = document.getElementById('isFree');
            const priceFields = document.getElementById('priceFields');
            const priceInput = document.querySelector('#editCourseModal input[name="price"]');
            const discountInput = document.querySelector('#editCourseModal input[name="discount_percentage"]');
            const currencySelect = document.querySelector('#editCourseModal select[name="currency"]');
            const finalPriceElement = document.getElementById('finalPrice');

            if (isFreeCheckbox) {
                isFreeCheckbox.addEventListener('change', function() {
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
                        finalPriceElement.textContent = 'Free';
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
            const modal = document.getElementById('editCourseModal');
            if (modal) {
                modal.addEventListener('shown.bs.modal', function() {
                    updateFinalPrice();
                });
            }
        }

        // Course management functions
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

        // Form validation and submission handling
        function setupFormValidation() {
            const forms = document.querySelectorAll('form');
            
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    // Remove any previous error states
                    form.querySelectorAll('.is-invalid').forEach(field => {
                        field.classList.remove('is-invalid');
                    });
                    
                    // Check required fields
                    const requiredFields = form.querySelectorAll('[required]');
                    let hasErrors = false;
                    
                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            hasErrors = true;
                            field.classList.add('is-invalid');
                            
                            // Add error message
                            let errorDiv = field.parentNode.querySelector('.invalid-feedback');
                            if (!errorDiv) {
                                errorDiv = document.createElement('div');
                                errorDiv.className = 'invalid-feedback';
                                field.parentNode.appendChild(errorDiv);
                            }
                            errorDiv.textContent = 'This field is required.';
                        } else {
                            field.classList.remove('is-invalid');
                            const errorDiv = field.parentNode.querySelector('.invalid-feedback');
                            if (errorDiv) {
                                errorDiv.remove();
                            }
                        }
                    });
                    
                    if (hasErrors) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        // Show error message
                        const firstError = form.querySelector('.is-invalid');
                        if (firstError) {
                            firstError.focus();
                        }
                        
                        return false;
                    }
                    
                    // If no errors, show loading state
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        const originalText = submitBtn.innerHTML;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                        submitBtn.disabled = true;
                        
                        // Re-enable button after 10 seconds if no response
                        setTimeout(() => {
                            submitBtn.innerHTML = originalText;
                            submitBtn.disabled = false;
                        }, 10000);
                    }
                });
            });
        }

        // Modal event handling
        function setupModalEvents() {
            const modals = document.querySelectorAll('.modal');
            
            modals.forEach(modal => {
                // Prevent modal from closing when clicking inside
                modal.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                
                // Prevent modal from closing when clicking on backdrop
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }
                });
                
                // Prevent ESC key from closing modal
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && modal.classList.contains('show')) {
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }
                });
            });
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function () {
            setupPriceCalculation();
            setupFormValidation();
            setupModalEvents();
            
            // Show success/error messages
            @if(session('success'))
                // You can add a toast notification here
                console.log('Success: {{ session('success') }}');
            @endif
            
            @if(session('error'))
                // You can add a toast notification here
                console.log('Error: {{ session('error') }}');
            @endif
        });
    </script>
@endpush
