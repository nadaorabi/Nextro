@extends('layouts.admin')

@section('title', 'Courses List')

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

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .form-select,
        .form-control {
            border-radius: 8px;
        }

        /* Modal Enhancements */
        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .modal-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
        }

        .modal-body {
            background-color: #ffffff;
        }

        .modal-footer {
            background-color: #ffffff;
            border-top: 1px solid #e9ecef;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-lg {
            border-radius: 10px;
            font-weight: 600;
        }

        /* Animation for modal */
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translate(0, -50px);
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        /* Icon animations */
        .icon-shape {
            transition: all 0.3s ease;
        }

        .icon-shape:hover {
            transform: scale(1.1);
        }

        .bg-light-warning {
            background-color: rgba(255, 193, 7, 0.1) !important;
        }

        .bg-light-danger {
            background-color: rgba(220, 53, 69, 0.1) !important;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">

        <!-- Welcome Card -->
        <div class="card mb-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h1 class="text-gradient text-primary welcome-animated">Educational Courses 📚</h1>
                        <p class="mb-0">Manage, add, and edit educational materials and resources</p>
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
            <!-- Total Courses -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Courses</p>
                                    <h5 class="font-weight-bolder">{{ $totalCourses }}</h5>
                                    <p class="mb-0">
                                        <span
                                            class="text-success text-sm font-weight-bolder">+{{ $courses->count() }}</span>
                                        on this page
                                    </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-books text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Courses -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Active Courses</p>
                                    <h5 class="font-weight-bolder">{{ $activeCourses }}</h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">
                                            {{ round(($activeCourses / max($totalCourses, 1)) * 100) }}%
                                        </span> are active
                                    </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-check-bold text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Linked Categories -->
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Linked Categories</p>
                                    <h5 class="font-weight-bolder">{{ $linkedCategories }}</h5>
                                    <p class="mb-0">
                                        <span class="text-info text-sm font-weight-bolder">
                                            {{ $linkedCategories }}
                                        </span> categories linked
                                    </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                    <i class="ni ni-tag text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Course -->
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Last Created</p>
                                    <h5 class="font-weight-bolder">
                                        {{ $latestCourse ? \Illuminate\Support\Str::limit($latestCourse->title, 14) : '-' }}
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-warning text-sm font-weight-bolder">
                                            {{ $latestCourse ? $latestCourse->created_at->diffForHumans() : '' }}
                                        </span>
                                        created
                                    </p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-time-alarm text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select id="status-filter" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Category</label>
                        <select id="category-filter" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categoriesList as $category)
                                <option value="{{ strtolower($category->name) }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Search</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input id="search-input" type="text" class="form-control" placeholder="Search by title...">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Credit Hours</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                            <tr data-title="{{ strtolower($course->title) }}" data-status="{{ $course->status }}"
                                data-category="{{ strtolower($course->category?->name ?? '') }}">
                                <td>{{ $course->id }}</td>
                                <td class="text-start">{{ $course->title }}</td>
                                <td>{{ $course->credit_hours }}</td>
                                <td>{{ $course->category?->name ?? '-' }}</td>
                                <td>
                                    <span class="badge bg-{{ $course->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($course->status) }}
                                    </span>
                                </td>
                                <td>{{ $course->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.educational-courses.show', $course->id) }}"
                                            class="btn btn-link text-primary p-2">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-link text-info p-2" data-bs-toggle="modal"
                                            data-bs-target="#editCourseModal-{{ $course->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button class="btn btn-link text-danger p-2" data-bs-toggle="modal"
                                            data-bs-target="#deleteCourseModal"
                                            onclick="confirmCourseDelete({{ $course->id }}, '{{ $course->title }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit Course -->
                            <div class="modal fade" id="editCourseModal-{{ $course->id }}" tabindex="-1" aria-labelledby="editCourseModalLabel-{{ $course->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ route('admin.educational-courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="modal-content border-0 shadow-lg">
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
                                                <div class="col-md-6">
                                                    <div class="mb-4">
                                                        <label class="form-label fw-bold text-primary">
                                                            <i class="fas fa-book me-2"></i>Course Title
                                                        </label>
                                                        <input type="text" name="title" value="{{ $course->title }}" 
                                                            class="form-control form-control-lg border-2 border-light" 
                                                            placeholder="Enter course title..." required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label fw-bold text-primary">
                                                            <i class="fas fa-clock me-2"></i>Credit Hours
                                                        </label>
                                                        <input type="number" name="credit_hours" value="{{ $course->credit_hours }}" 
                                                            class="form-control form-control-lg border-2 border-light" 
                                                            placeholder="Enter credit hours..." required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label fw-bold text-primary">
                                                            <i class="fas fa-tag me-2"></i>Category
                                                        </label>
                                                        <select name="category_id" class="form-select form-select-lg border-2 border-light" required>
                                                            @foreach ($categoriesList as $cat)
                                                                <option value="{{ $cat->id }}" {{ $course->category_id == $cat->id ? 'selected' : '' }}>
                                                                    {{ $cat->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-4">
                                                        <label class="form-label fw-bold text-primary">
                                                            <i class="fas fa-align-left me-2"></i>Description
                                                        </label>
                                                        <textarea name="description" class="form-control border-2 border-light"
                                                            rows="6" placeholder="Enter course description...">{{ $course->description }}</textarea>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label class="form-label fw-bold text-primary">
                                                            <i class="fas fa-toggle-on me-2"></i>Status
                                                        </label>
                                                        <select name="status" class="form-select form-select-lg border-2 border-light">
                                                            <option value="active" {{ $course->status === 'active' ? 'selected' : '' }}>
                                                                <i class="fas fa-check-circle"></i> Active
                                                            </option>
                                                            <option value="archived" {{ $course->status === 'archived' ? 'selected' : '' }}>
                                                                <i class="fas fa-archive"></i> Archived
                                                            </option>
                                                        </select>
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

                <!-- Modal Delete Confirmation -->
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

                <div class="mt-3">
                    {{ $courses->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmCourseDelete(courseId, courseTitle) {
            const form = document.getElementById('deleteCourseForm');
            const namePlaceholder = document.getElementById('courseNamePlaceholder');
            namePlaceholder.textContent = `"${courseTitle}"`;
            form.action = `/admin/educational-courses/${courseId}`;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('status-filter');
            const categoryFilter = document.getElementById('category-filter');
            const tableRows = document.querySelectorAll('table tbody tr');

            function filterCourses() {
                const searchText = searchInput.value.toLowerCase();
                const selectedStatus = statusFilter.value.toLowerCase();
                const selectedCategory = categoryFilter.value.toLowerCase();

                tableRows.forEach(row => {
                    const title = row.dataset.title;
                    const status = row.dataset.status;
                    const category = row.dataset.category;

                    const matchesSearch = title.includes(searchText);
                    const matchesStatus = selectedStatus === '' || status === selectedStatus;
                    const matchesCategory = selectedCategory === '' || category === selectedCategory;

                    row.style.display = (matchesSearch && matchesStatus && matchesCategory) ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterCourses);
            statusFilter.addEventListener('change', filterCourses);
            categoryFilter.addEventListener('change', filterCourses);
        });
    </script>
@endpush