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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="card mb-4 info-card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="text-gradient text-primary welcome-animated">{{ $course->title }}</h1>
                        <p class="mb-0">Category: <span class="badge bg-info">{{ $course->category->name ?? '-' }}</span></p>
                        <p class="mb-0">Credit Hours: <b>{{ $course->credit_hours }}</b></p>
                        <p class="mb-0">Status: <span class="badge {{ $course->status == 'active' ? 'bg-success' : 'bg-secondary' }}">{{ ucfirst($course->status) }}</span></p>
                        <p class="mb-0">Created: {{ $course->created_at->format('Y-m-d') }}</p>
                    </div>
                    <div class="col-lg-4 text-end">
                        <a href="{{ route('admin.educational-courses.index') }}" class="btn btn-secondary mb-0 me-2">
                            <i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back
                        </a>
                        <button class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#editCourseModal">
                            <i class="fas fa-edit"></i>&nbsp;&nbsp;Edit
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body p-3 text-center">
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">Enrolled Students</p>
                        <h2>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#studentsModal" style="text-decoration:underline; color:inherit;">
                                {{ $course->enrollments->count() ?? 0 }}
                            </a>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal: Students List -->
        <div class="modal fade" id="studentsModal" tabindex="-1" aria-labelledby="studentsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="studentsModalLabel"><i class="fas fa-users me-2"></i>Enrolled Students</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="GET" class="mb-3">
                            <input type="text" class="form-control" placeholder="Search student by name or email..." id="studentSearchInput" onkeyup="filterStudents()">
                        </form>
                        <div class="mb-3 text-end">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                                <i class="fas fa-user-plus"></i> Add Student
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle" id="studentsTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Enrolled At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($course->enrollments as $enrollment)
                                        <tr>
                                            <td>{{ $enrollment->student->name ?? '-' }}</td>
                                            <td>{{ $enrollment->student->email ?? '-' }}</td>
                                            <td>{{ $enrollment->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <form method="POST" action="{{ route('admin.course.enrollments.destroy', $enrollment->id) }}" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- نهاية المودال -->

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

        <!-- Add Student Modal -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('admin.course.enrollments.store') }}" method="POST" class="modal-content border-0 shadow-lg">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addStudentModalLabel">
                            <i class="fas fa-user-graduate me-2"></i>Enroll Students in Course
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold">ابحث عن طالب</label>
                            <input type="text" id="studentSearchBox" class="form-control mb-2" placeholder="اكتب اسم الطالب...">
                            <div id="studentsCheckboxList" style="max-height: 200px; overflow-y: auto; border: 1px solid #eee; border-radius: 8px; padding: 10px;">
                                @foreach($students ?? [] as $student)
                                    <div class="form-check student-checkbox-item mb-2">
                                        <input class="form-check-input student-checkbox" type="checkbox" name="student_ids[]" value="{{ $student->id }}" id="student_{{ $student->id }}" onchange="toggleDiscountInput({{ $student->id }})">
                                        <label class="form-check-label" for="student_{{ $student->id }}">
                                            {{ $student->name }} ({{ $student->email }})
                                        </label>
                                        <div class="discount-input mt-2" id="discount_input_{{ $student->id }}" style="display:none;">
                                            <input type="number" name="discounts[{{ $student->id }}]" class="form-control form-control-sm" min="0" max="100" step="0.01" placeholder="نسبة الخصم %">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
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
                            <i class="fas fa-plus me-2"></i>Enroll Students
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.getElementById('studentSearchBox').addEventListener('keyup', function() {
    var filter = this.value.toLowerCase();
    var items = document.querySelectorAll('#studentsCheckboxList .student-checkbox-item');
    items.forEach(function(item) {
        var txt = item.textContent.toLowerCase();
        item.style.display = txt.indexOf(filter) > -1 ? '' : 'none';
    });
});

function toggleDiscountInput(studentId) {
    var cb = document.getElementById('student_' + studentId);
    var inputDiv = document.getElementById('discount_input_' + studentId);
    if (cb.checked) {
        inputDiv.style.display = '';
    } else {
        inputDiv.style.display = 'none';
        inputDiv.querySelector('input').value = '';
    }
}

function filterStudents() {
    var input = document.getElementById("studentSearchInput");
    var filter = input.value.toLowerCase();
    var table = document.getElementById("studentsTable");
    var trs = table.querySelectorAll("tbody tr");
    var anyVisible = false;
    trs.forEach(function(tr) {
        if (tr.textContent.toLowerCase().indexOf(filter) > -1) {
            tr.style.display = "";
            anyVisible = true;
        } else {
            tr.style.display = "none";
        }
    });
    // رسالة لا يوجد نتائج
    var noResultRow = document.getElementById("noResultRow");
    if (!anyVisible) {
        if (!noResultRow) {
            noResultRow = document.createElement("tr");
            noResultRow.id = "noResultRow";
            noResultRow.innerHTML = '<td colspan="4" class="text-center text-muted">لا يوجد نتائج</td>';
            table.querySelector("tbody").appendChild(noResultRow);
        }
    } else {
        if (noResultRow) noResultRow.remove();
    }
}
</script>
@endpush
