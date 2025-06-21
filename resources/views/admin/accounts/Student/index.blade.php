<!DOCTYPE html>
<html lang="en" dir="LTR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>Student Management</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
    <style>
        .custom-icon-style {
            display: inline-block;
            transform: translateY(-4px);
            /* You can adjust this value for vertical alignment */
        }

        /* Delete Modal Styles */
        .delete-modal .modal-content {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }

        .delete-modal .modal-header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            padding: 1.5rem;
        }

        .delete-modal .modal-body {
            padding: 2rem;
        }

        .delete-modal .icon-shape {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .delete-modal .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: none;
            border-radius: 10px;
        }

        .delete-modal .modal-footer {
            padding: 1.5rem;
            background: #f8f9fa;
        }

        .delete-modal .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .delete-modal .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .delete-modal .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .delete-modal .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .delete-modal .form-control.valid {
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .delete-modal .form-control.is-invalid {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        /* Animation for modal */
        .delete-modal.fade .modal-dialog {
            transform: scale(0.8);
            transition: transform 0.3s ease-out;
        }

        .delete-modal.show .modal-dialog {
            transform: scale(1);
        }

        @media print {
            body>*:not(#studentCardPrintArea) {
                display: none;
            }

            .modal-backdrop {
                display: none !important;
            }

            #studentCardModal {
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
                position: absolute !important;
                top: 0 !important;
                left: 0 !important;
                width: 100% !important;
                height: 100% !important;
                overflow: visible !important;
            }

            .modal-dialog {
                margin: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
            }

            #studentCardPrintArea {
                visibility: visible;
            }

            .modal-footer,
            .modal-header .btn-close {
                display: none;
            }
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    @include('admin.parts.sidebar-admin')

    <main class="main-content position-relative border-radius-lg overflow-hidden">

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <!-- Success Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Welcome Card -->
                    <div class="card mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1 class="text-gradient text-primary">Student Management</h1>
                                    <p class="mb-0">Manage, add, and edit student accounts</p>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <a href="{{ url('admin/accounts/students/create') }}" class="btn btn-primary mb-0">
                                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Student
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Students
                                                </p>
                                                <h5 class="font-weight-bolder">{{ $totalStudents }}</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">+{{ $studentsThisMonth }}</span>
                                                    this month
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div
                                                class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                <i class="ni ni-hat-3 text-lg opacity-10 custom-icon-style"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Active</p>
                                                <h5 class="font-weight-bolder">{{ $activeStudents }}</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">{{ round(($activeStudents/$totalStudents)*100) }}%</span>
                                                    of students
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div
                                                class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                <i class="ni ni-check-bold text-lg opacity-10 custom-icon-style"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Graduated</p>
                                                <h5 class="font-weight-bolder">{{ $graduatedStudents }}</h5>
                                                <p class="mb-0">
                                                    <span class="text-info text-sm font-weight-bolder">5</span> this
                                                    year
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div
                                                class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                                <i class="ni ni-trophy text-lg opacity-10 custom-icon-style"
                                                    aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Blocked</p>
                                                <h5 class="font-weight-bolder">{{ $blockedStudents }}</h5>
                                                <p class="mb-0">
                                                    <span class="text-danger text-sm font-weight-bolder">account</span>
                                                    blocked
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div
                                                class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                <i class="ni ni-fat-delete text-lg opacity-10 custom-icon-style"
                                                    aria-hidden="true"></i>
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
                                    <div class="form-group">
                                        <label class="form-label">Status</label>
                                        <select id="status-filter" class="form-select">
                                            <option value="">All Statuses</option>
                                            <option>Active</option>
                                            <option>Graduated</option>
                                            <option>Blocked</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Level</label>
                                        <select id="level-filter" class="form-select">
                                            <option value="">All Levels</option>
                                            <option>Level 1</option>
                                            <option>Level 2</option>
                                            <option>Level 3</option>
                                            <option>Level 4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Registration Date</label>
                                        <select id="date-filter" class="form-select">
                                            <option value="">All Dates</option>
                                            <option value="this_month">This Month</option>
                                            <option value="last_month">Last Month</option>
                                            <option value="last_3_months">Last 3 Months</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Search</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input id="search-input" type="text" class="form-control"
                                                placeholder="Search by name, email, or ID...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Students Table -->
                    <div class="card">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="students-table" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>ID</th>
                                            <th>Password</th>
                                            <th>Status</th>
                                            <th>Registration Date</th>
                                            <th>QR</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset($student->avatar ?? 'images/default-avatar.png') }}"
                                                                class="avatar avatar-sm me-3" 
                                                                onerror="this.src='{{ asset('images/default-avatar.png') }}'"
                                                                alt="{{ $student->name }}">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $student->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $student->email ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $student->login_id }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $student->plain_password ?? '-' }}</p>
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge badge-sm {{ $student->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                        {{ $student->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $student->created_at->format('Y-m-d') }}</p>
                                                </td>
                                                <td>
                                                    <button class="btn btn-link text-secondary p-2 qr-button"
                                                        data-bs-toggle="modal" data-bs-target="#studentCardModal"
                                                        data-name="{{ $student->name }}" data-id="{{ $student->login_id }}"
                                                        data-email="{{ $student->email ?? '-' }}"
                                                        data-avatar="{{ asset($student->avatar ?? 'images/default-avatar.png') }}"
                                                        data-registration-date="{{ $student->created_at->format('Y-m-d') }}">
                                                        <i class="fas fa-qrcode"></i>
                                                    </button>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="{{ route('admin.accounts.students.edit', $student->id) }}"
                                                            class="btn btn-link text-info p-2">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.accounts.students.show', $student->id) }}"
                                                            class="btn btn-link text-primary p-2">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <form action="{{ route('admin.accounts.students.destroy', $student->id) }}"
                                                            method="POST" onsubmit="return false;" class="delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link text-danger p-2 delete-btn"
                                                                    data-student-id="{{ $student->id }}"
                                                                    data-student-name="{{ $student->name }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center p-3">
                                <p class="text-sm mb-0">Showing {{ $students->firstItem() }} -
                                    {{ $students->lastItem() }} of {{ $students->total() }} students</p>
                                {{ $students->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Modal Student Card -->
    <div class="modal fade" id="studentCardModal" tabindex="-1" aria-labelledby="studentCardModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentCardModalLabel">Student ID Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="studentCardPrintArea">
                    <div class="card card-plain">
                        <div class="card-body">
                            <!-- Student Image and Name -->
                            <div class="d-flex align-items-center mb-4">
                                <img src="" id="modal-student-avatar" alt="Student Avatar"
                                    class="avatar avatar-xl rounded-circle me-3"
                                    onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                                <div>
                                    <h5 class="mb-0" id="modal-student-name"></h5>
                                    <p class="text-sm text-muted mb-0" id="modal-student-email"></p>
                                </div>
                            </div>

                            <!-- QR Code -->
                            <div class="d-flex justify-content-center my-4">
                                <div id="qrcode"></div>
                            </div>

                            <!-- Student Details -->
                            <hr class="my-3">
                            <div class="text-center">
                                <div class="row">
                                    <div class="col-4">
                                        <strong class="d-block text-xs text-muted">ID</strong>
                                        <span id="modal-student-id" class="font-weight-bold"></span>
                                    </div>
                                    <div class="col-4">
                                        <strong class="d-block text-xs text-muted">Level</strong>
                                        <span id="modal-student-level" class="font-weight-bold"></span>
                                    </div>
                                    <div class="col-4">
                                        <strong class="d-block text-xs text-muted">Registered</strong>
                                        <span id="modal-student-reg-date" class="font-weight-bold"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="printStudentCard()"><i
                            class="fas fa-print"></i> Print</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Student -->
    <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="Youssef Ahmed" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="youssef@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Student ID</label>
                            <input type="text" class="form-control" value="STU-001" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Level</label>
                            <select class="form-select" required>
                                <option>Level 1</option>
                                <option>Level 2</option>
                                <option selected>Level 3</option>
                                <option>Level 4</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" required>
                                <option selected>Active</option>
                                <option>Graduated</option>
                                <option>Blocked</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" value="0123456789">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Confirmation -->
    <div class="modal fade delete-modal" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white border-0">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-white bg-gradient-danger shadow-danger text-center rounded-circle me-3">
                            <i class="fas fa-exclamation-triangle text-danger text-lg opacity-10"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                            <p class="text-white-50 mb-0 small">This action cannot be undone</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-user-times text-white text-lg opacity-10" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="text-danger mb-2">Are you sure you want to delete this student?</h6>
                        <p class="text-muted mb-0" id="deleteStudentName"></p>
                    </div>
                    
                    <div class="alert alert-warning border-0">
                        <div class="d-flex">
                            <i class="fas fa-exclamation-triangle text-warning me-2 mt-1"></i>
                            <div>
                                <strong>Warning:</strong> This will permanently delete the student account and all associated data.
                                <ul class="mb-0 mt-2 small">
                                    <li>Student profile will be removed</li>
                                    <li>All records will be deleted</li>
                                    <li>This action cannot be undone</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Confirmation Input -->
                    <div class="form-group">
                        <label for="deleteConfirmation" class="form-label text-danger">
                            <i class="fas fa-keyboard me-2"></i>Type "DELETE" to confirm
                        </label>
                        <input type="text" id="deleteConfirmation" class="form-control" 
                               placeholder="Type DELETE to confirm" 
                               required>
                        <div class="form-text text-muted">
                            This extra step helps prevent accidental deletions.
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary" disabled>
                            <i class="fas fa-trash me-2"></i>Delete Student
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('status-filter');
            const levelFilter = document.getElementById('level-filter');
            const dateFilter = document.getElementById('date-filter');
            const studentsTable = document.getElementById('students-table');
            const tableRows = studentsTable.querySelectorAll('tbody tr');

            function filterStudents() {
                const searchText = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                const levelValue = levelFilter.value;
                const dateValue = dateFilter.value;

                tableRows.forEach(row => {
                    const name = row.cells[0].querySelector('h6').textContent.toLowerCase();
                    const email = row.cells[0].querySelector('p').textContent.toLowerCase();
                    const studentId = row.cells[1].textContent.toLowerCase().trim();
                    const level = row.cells[2].textContent.trim();
                    const status = row.cells[3].textContent.trim();
                    const registrationDateText = row.cells[4].textContent.trim();
                    const registrationDate = registrationDateText ? new Date(registrationDateText) : null;

                    const searchMatch = name.includes(searchText) || email.includes(searchText) || studentId.includes(searchText);
                    const statusMatch = statusValue === '' || status === statusValue;
                    const levelMatch = levelValue === '' || level === levelValue;

                    let dateMatch = true;
                    if (dateValue && registrationDate) {
                        const today = new Date();
                        today.setHours(0, 0, 0, 0);

                        if (dateValue === 'this_month') {
                            dateMatch = registrationDate.getFullYear() === today.getFullYear() && registrationDate.getMonth() === today.getMonth();
                        } else if (dateValue === 'last_month') {
                            const lastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                            const thisMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                            dateMatch = registrationDate >= lastMonth && registrationDate < thisMonth;
                        } else if (dateValue === 'last_3_months') {
                            const threeMonthsAgo = new Date(today.getFullYear(), today.getMonth() - 3, today.getDate());
                            dateMatch = registrationDate >= threeMonthsAgo && registrationDate <= new Date();
                        }
                    } else if (dateValue !== '') {
                        dateMatch = false;
                    }


                    if (searchMatch && statusMatch && levelMatch && dateMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('keyup', filterStudents);
            statusFilter.addEventListener('change', filterStudents);
            levelFilter.addEventListener('change', filterStudents);
            dateFilter.addEventListener('change', filterStudents);
        });
    </script>
    <script>
        var qrcode = null; // Declare qrcode variable in a broader scope

        document.addEventListener('DOMContentLoaded', function () {
            // Initialize QR Code generator
            qrcode = new QRCode(document.getElementById("qrcode"), {
                width: 128,
                height: 128
            });

            // Handle image loading errors
            document.querySelectorAll('img[src*="avatar"]').forEach(function(img) {
                img.addEventListener('error', function() {
                    this.src = '{{ asset("images/default-avatar.png") }}';
                });
            });

            const studentCardModal = document.getElementById('studentCardModal');
            studentCardModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const name = button.getAttribute('data-name');
                const id = button.getAttribute('data-id');
                const level = button.getAttribute('data-level');
                const email = button.getAttribute('data-email');
                const avatar = button.getAttribute('data-avatar');
                const regDate = button.getAttribute('data-registration-date');

                const modalTitle = studentCardModal.querySelector('.modal-title');
                const studentName = studentCardModal.querySelector('#modal-student-name');
                const studentId = studentCardModal.querySelector('#modal-student-id');
                const studentLevel = studentCardModal.querySelector('#modal-student-level');
                const studentEmail = studentCardModal.querySelector('#modal-student-email');
                const studentAvatar = studentCardModal.querySelector('#modal-student-avatar');
                const studentRegDate = studentCardModal.querySelector('#modal-student-reg-date');

                modalTitle.textContent = 'Student ID Card: ' + name;
                studentName.textContent = name;
                studentId.textContent = id;
                studentLevel.textContent = level || 'N/A';
                studentEmail.textContent = email;
                studentAvatar.src = avatar;
                studentRegDate.textContent = regDate;

                // Handle modal image error
                studentAvatar.onerror = function() {
                    this.src = '{{ asset("images/default-avatar.png") }}';
                };

                // Clear previous QR code and generate new one with only student ID
                document.getElementById('qrcode').innerHTML = '';
                new QRCode(document.getElementById('qrcode'), {
                    text: id, // Only student ID
                    width: 128,
                    height: 128,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            });
        });

        function printStudentCard() {
            window.print();
        }

        // Delete confirmation modal functionality
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteModal = document.getElementById('deleteConfirmModal');
            const deleteStudentName = document.getElementById('deleteStudentName');
            const deleteForm = document.getElementById('deleteForm');
            const deleteConfirmation = document.getElementById('deleteConfirmation');
            const deleteSubmitBtn = deleteForm.querySelector('button[type="submit"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const studentName = this.getAttribute('data-student-name');
                    const studentId = this.getAttribute('data-student-id');
                    const form = this.closest('.delete-form');
                    
                    // Update modal content
                    deleteStudentName.textContent = studentName;
                    
                    // Update form action
                    deleteForm.action = form.action;
                    
                    // Reset confirmation input
                    deleteConfirmation.value = '';
                    deleteSubmitBtn.disabled = true;
                    
                    // Show modal with animation
                    const modal = new bootstrap.Modal(deleteModal, {
                        backdrop: 'static',
                        keyboard: false
                    });
                    modal.show();
                });
            });

            // Handle confirmation input
            deleteConfirmation.addEventListener('input', function() {
                const isConfirmed = this.value.toUpperCase() === 'DELETE';
                deleteSubmitBtn.disabled = !isConfirmed;
                
                // Update input styling
                this.classList.remove('valid', 'is-invalid');
                
                if (this.value.length > 0) {
                    if (isConfirmed) {
                        this.classList.add('valid');
                        deleteSubmitBtn.classList.remove('btn-secondary');
                        deleteSubmitBtn.classList.add('btn-danger');
                    } else {
                        this.classList.add('is-invalid');
                        deleteSubmitBtn.classList.remove('btn-danger');
                        deleteSubmitBtn.classList.add('btn-secondary');
                    }
                } else {
                    deleteSubmitBtn.classList.remove('btn-danger');
                    deleteSubmitBtn.classList.add('btn-secondary');
                }
            });

            // Handle form submission
            deleteForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                if (deleteConfirmation.value.toUpperCase() !== 'DELETE') {
                    return;
                }
                
                // Show loading state
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Deleting...';
                submitBtn.disabled = true;

                // Submit the form
                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Deleted Successfully!';
                        submitBtn.classList.remove('btn-danger');
                        submitBtn.classList.add('btn-success');
                        
                        // Close modal after delay
                        setTimeout(() => {
                            const modal = bootstrap.Modal.getInstance(deleteModal);
                            modal.hide();
                            
                            // Reload page after modal is hidden
                            setTimeout(() => {
                                location.reload();
                            }, 300);
                        }, 1500);
                    } else {
                        throw new Error(data.message || 'Failed to delete student');
                    }
                })
                .catch(error => {
                    // Reset button state
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                    
                    // Show error message in modal
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'alert alert-danger mt-3';
                    errorDiv.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>' + error.message;
                    
                    const modalBody = deleteModal.querySelector('.modal-body');
                    modalBody.appendChild(errorDiv);
                    
                    // Remove error message after 5 seconds
                    setTimeout(() => {
                        errorDiv.remove();
                    }, 5000);
                });
            });

            // Reset modal when hidden
            deleteModal.addEventListener('hidden.bs.modal', function() {
                const submitBtn = deleteForm.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-trash me-2"></i>Delete Student';
                submitBtn.disabled = true;
                submitBtn.classList.remove('btn-success', 'btn-danger');
                submitBtn.classList.add('btn-secondary');
                
                // Reset confirmation input
                deleteConfirmation.value = '';
                deleteConfirmation.classList.remove('valid', 'is-invalid');
                
                // Remove any error messages
                const errorMessages = deleteModal.querySelectorAll('.alert-danger');
                errorMessages.forEach(msg => msg.remove());
            });
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html>