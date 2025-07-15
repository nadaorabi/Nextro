<!DOCTYPE html>
<html lang="en" dir="LTR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>Student Account Management</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
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
        .stat-card.danger::before { background: #f5365c; }
        
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
        .stat-card .stat-icon.danger { background: linear-gradient(45deg, #f5365c, #f56036); }
        
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
        .stat-card .stat-description .danger { color: #f5365c; }
        
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
                                    <h1 class="text-gradient text-primary">Student Account Management</h1>
                                    <p class="mb-0">View, manage, and oversee all registered student accounts</p>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <a href="{{ url('admin/accounts/students/create') }}" class="btn btn-primary mb-0">
                                        <i class="fas fa-user-plus"></i>&nbsp;&nbsp;Create New Student
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
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="stat-title">Total Students</div>
                                <div class="stat-value">{{ $totalStudents }}</div>
                                <div class="stat-description">
                                    <span class="highlight success">+{{ $studentsThisMonth }}</span> new this month
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card stat-card success">
                                <div class="stat-icon success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stat-title">Active Students</div>
                                <div class="stat-value">{{ $activeStudents }}</div>
                                <div class="stat-description">
                                    <span class="highlight success">{{ $totalStudents > 0 ? round(($activeStudents/$totalStudents)*100) : 0 }}%</span> of all students
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card stat-card info">
                                <div class="stat-icon info">
                                    <i class="fas fa-trophy"></i>
                                </div>
                                <div class="stat-title">Graduated Students</div>
                                <div class="stat-value">{{ $graduatedStudents }}</div>
                                <div class="stat-description">
                                    <span class="highlight info">5</span> this year
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card stat-card danger">
                                <div class="stat-icon danger">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <div class="stat-title">Inactive Students</div>
                                <div class="stat-value">{{ $blockedStudents }}</div>
                                <div class="stat-description">
                                    <span class="highlight danger">accounts</span> suspended
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
                                        <label class="form-label">Account Status</label>
                                        <select id="status-filter" class="form-select">
                                            <option value="">All Statuses</option>
                                            <option>Active</option>
                                            <option>Graduated</option>
                                            <option>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Study Level</label>
                                        <select id="level-filter" class="form-select">
                                            <option value="">All Levels</option>
                                            <option>Beginner Level</option>
                                            <option>Intermediate Level</option>
                                            <option>Advanced Level</option>
                                            <option>Expert Level</option>
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
                                        <label class="form-label">Search Students</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input id="search-input" type="text" class="form-control"
                                                placeholder="Search by name, email, or student ID...">
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
                                            <th>Student Information</th>
                                            <th>Student ID</th>
                                            <th>Initial Password</th>
                                            <th>Account Status</th>
                                            <th>Registration Date</th>
                                            <th>QR Code</th>
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
                                                                {{ $student->mobile ?? '-' }}</p>
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
                                                        <a href="{{ route('admin.students.account', $student->id) }}"
                                                            class="btn btn-link text-success p-2" title="Financial Account">
                                                            <i class="fas fa-wallet"></i>
                                                        </a>
                                                        <button class="btn btn-link text-dark p-2"
                                                            onclick="printCredentials('{{ $student->login_id }}', '{{ $student->plain_password }}', '{{ $student->name }}')"
                                                            title="Print Credentials">
                                                            <i class="fas fa-key"></i>
                                                        </button>
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
                                <p class="text-sm mb-0">Showing {{ $students->firstItem() ?? 0 }} -
                                    {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} total students</p>
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
                    <h5 class="modal-title" id="studentCardModalLabel">Student Identification Card</h5>
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
                                    <div class="col-6 text-center">
                                        <strong class="d-block text-xs text-muted">Student ID</strong>
                                        <span id="modal-student-id" class="font-weight-bold"></span>
                                    </div>
                                    <div class="col-6 text-center">
                                        <strong class="d-block text-xs text-muted">Registration Date</strong>
                                        <span id="modal-student-reg-date" class="font-weight-bold"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                    <button type="button" class="btn btn-primary" onclick="printStudentCard()">
                        <i class="fas fa-print"></i> Print ID Card
                    </button>
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
                    <h5 class="modal-title" id="editStudentModalLabel">Edit Student Information</h5>
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
                            <i class="bi bi-exclamation-triangle text-danger text-lg opacity-10"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0" id="deleteConfirmModalLabel">Confirm Student Deletion</h5>
                            <p class="text-white-50 mb-0 small">This action is permanent and cannot be undone</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-person-x text-white text-lg opacity-10" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="text-danger mb-2">Are you absolutely sure you want to delete this student account?</h6>
                        <p class="text-muted mb-0" id="deleteStudentName"></p>
                    </div>
                    
                    <div class="alert alert-warning border-0">
                        <div class="d-flex">
                            <i class="bi bi-exclamation-triangle text-warning me-2 mt-1"></i>
                            <div>
                                <strong>Warning:</strong> This will permanently delete the student account and all associated data.
                                <ul class="mb-0 mt-2 small">
                                    <li>Complete student profile will be removed</li>
                                    <li>All enrollment and attendance records will be deleted</li>
                                    <li>Financial records and payment history will be lost</li>
                                    <li>This action cannot be reversed or undone</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Confirmation Input -->
                    <div class="form-group">
                        <label for="deleteConfirmation" class="form-label text-danger">
                            <i class="bi bi-keyboard me-2"></i>Type "DELETE" to confirm
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
                        <i class="bi bi-x me-2"></i>Cancel Deletion
                    </button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary" disabled>
                            <i class="bi bi-trash me-2"></i>Permanently Delete Student
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
            const categoryFilter = document.getElementById('level-filter');
            const dateFilter = document.getElementById('date-filter');
            const studentsTable = document.getElementById('students-table');
            const tableRows = studentsTable.querySelectorAll('tbody tr');

            function filterStudents() {
                const searchText = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                const categoryValue = categoryFilter.value;
                const dateValue = dateFilter.value;

                tableRows.forEach(row => {
                    const name = row.cells[0].querySelector('h6').textContent.toLowerCase();
                    const email = row.cells[0].querySelector('p').textContent.toLowerCase();
                    const studentId = row.cells[1].textContent.toLowerCase().trim();
                    const category = row.cells[2].textContent.trim();
                    const status = row.cells[3].textContent.trim();
                    const registrationDateText = row.cells[4].textContent.trim();
                    const registrationDate = registrationDateText ? new Date(registrationDateText) : null;

                    const searchMatch = name.includes(searchText) || email.includes(searchText) || studentId.includes(searchText);
                    const statusMatch = statusValue === '' || status === statusValue;
                    const categoryMatch = categoryValue === '' || category === categoryValue;

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


                    if (searchMatch && statusMatch && categoryMatch && dateMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('keyup', filterStudents);
            statusFilter.addEventListener('change', filterStudents);
            categoryFilter.addEventListener('change', filterStudents);
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
                const email = button.getAttribute('data-email');
                const avatar = button.getAttribute('data-avatar');
                const regDate = button.getAttribute('data-registration-date');

                const modalTitle = studentCardModal.querySelector('.modal-title');
                const studentName = studentCardModal.querySelector('#modal-student-name');
                const studentId = studentCardModal.querySelector('#modal-student-id');
                const studentEmail = studentCardModal.querySelector('#modal-student-email');
                const studentAvatar = studentCardModal.querySelector('#modal-student-avatar');
                const studentRegDate = studentCardModal.querySelector('#modal-student-reg-date');

                modalTitle.textContent = 'Student Identification Card: ' + name;
                studentName.textContent = name;
                studentId.textContent = id;
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

        function printCredentials(studentId, studentPassword, studentName) {
            if (!studentPassword || studentPassword.trim() === '') {
                alert('Initial password is not available for this student account.');
                return;
            }

            const printWindow = window.open('', 'PRINT', 'height=500,width=700');

            printWindow.document.write('<html><head><title>Student Credentials</title>');
            printWindow.document.write('<style>');
            printWindow.document.write(`
                body { background: linear-gradient(120deg, #4f8cff 0%, #6dd5ed 100%); margin:0; height:100vh; display:flex; align-items:center; justify-content:center; }
                .cred-card { background: rgba(255,255,255,0.85); border-radius: 22px; box-shadow: 0 8px 32px rgba(44,62,80,0.18); border: 2px solid #4f8cff; padding: 40px 32px 32px 32px; width: 420px; max-width:95vw; margin:auto; font-family: 'Segoe UI', Arial, sans-serif; animation: fadeInCard 0.8s cubic-bezier(.4,2,.6,1) both; }
                .cred-card h2 { color: #4f8cff; margin-bottom: 18px; font-size: 2.1rem; letter-spacing: 1px; text-align:center; }
                .cred-card .cred-label { color: #6c757d; font-size: 1.1rem; margin-bottom: 2px; display:block; }
                .cred-card .cred-value { color: #222; font-size: 1.35rem; font-weight: bold; margin-bottom: 18px; letter-spacing: 0.5px; }
                .cred-card .cred-pass { color: #fff; background: linear-gradient(90deg, #4f8cff 0%, #6dd5ed 100%); border-radius: 10px; font-size: 1.5rem; font-weight: bold; padding: 10px 0; margin-bottom: 10px; text-align:center; letter-spacing: 1px; box-shadow: 0 2px 8px rgba(44,62,80,0.10); }
                .cred-card .cred-id { color: #4f8cff; font-size: 1.1rem; font-weight: 500; margin-bottom: 8px; text-align:center; }
                .cred-card .cred-footer { color: #6c757d; font-size: 0.95rem; text-align:center; margin-top: 18px; }
                .cred-card .print-btn { display: block; width: 100%; margin: 18px auto 0 auto; background: linear-gradient(90deg, #4f8cff 0%, #6dd5ed 100%); color: #fff; border: none; border-radius: 8px; font-size: 1.15rem; font-weight: bold; padding: 10px 0; cursor: pointer; transition: background 0.2s; box-shadow: 0 2px 8px rgba(44,62,80,0.10); }
                .cred-card .print-btn:hover { background: linear-gradient(90deg, #6dd5ed 0%, #4f8cff 100%); }
                @keyframes fadeInCard { 0% { opacity:0; transform: translateY(40px) scale(0.95);} 100% { opacity:1; transform: translateY(0) scale(1);} }
                @media print {
                  html, body { background: #fff !important; height:100%; margin:0; padding:0; }
                  body { display: flex; align-items: flex-start; justify-content: center; min-height: 100vh; }
                  .cred-card { box-shadow:none !important; border:2px solid #4f8cff !important; width: 95vw !important; max-width: 420px !important; margin: 0 auto !important; position: relative; top: 2vh; }
                  .print-btn { display: none !important; }
                }
            `);
            printWindow.document.write('</style></head><body>');
            printWindow.document.write('<div class="cred-card">');
            printWindow.document.write('<div style="position:absolute; left:32px; top:24px; font-size:2.2rem; font-weight:900; color:#4f8cff; letter-spacing:2px; font-family:inherit;">Nextro</div>');
            printWindow.document.write('<h2 style="font-size:1.25rem; margin-top:48px; margin-bottom:18px; color:#4f8cff; text-align:center; font-weight:700; letter-spacing:1px;">Student Credentials</h2>');
            printWindow.document.write(`<div class="cred-label">Student Name</div><div class="cred-value">${studentName}</div>`);
            printWindow.document.write(`<div class="cred-label">Student ID</div><div class="cred-id">${studentId}</div>`);
            printWindow.document.write(`<div class="cred-label">Password</div><div class="cred-pass">${studentPassword}</div>`);
            printWindow.document.write('<div class="cred-footer">Keep this information secure and confidential</div>');
            printWindow.document.write('<button class="print-btn" onclick="window.print()">Print Credentials</button>');
            printWindow.document.write('</div>');
            printWindow.document.write('</body></html>');

            printWindow.document.close();
            printWindow.focus();
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
                        submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Student Deleted Successfully!';
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
                        throw new Error(data.message || 'Failed to delete student account');
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
                submitBtn.innerHTML = '<i class="fas fa-trash me-2"></i>Permanently Delete Student';
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