<!DOCTYPE html>
<html lang="en" dir="LTR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        
        /* Table Responsive Styles */
        .table-responsive {
            overflow-x: auto;
        }
        
        #students-table {
            font-size: 0.875rem;
        }
        
        #students-table th,
        #students-table td {
            padding: 0.75rem 0.5rem;
            white-space: nowrap;
        }
        
        #students-table th:first-child,
        #students-table td:first-child {
            min-width: 200px;
            white-space: normal;
        }
        
        #students-table th:nth-child(2),
        #students-table td:nth-child(2) {
            min-width: 120px;
        }
        
        #students-table th:nth-child(3),
        #students-table td:nth-child(3) {
            min-width: 100px;
        }
        
        #students-table th:nth-child(4),
        #students-table td:nth-child(4) {
            min-width: 100px;
        }
        
        #students-table th:nth-child(5),
        #students-table td:nth-child(5) {
            min-width: 100px;
        }
        
        #students-table th:nth-child(6),
        #students-table td:nth-child(6) {
            min-width: 80px;
        }
        
        #students-table th:last-child,
        #students-table td:last-child {
            min-width: 150px;
        }
        
        /* Compact student info */
        .student-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .student-info .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .student-info .details h6 {
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }
        
        .student-info .details p {
            font-size: 0.75rem;
            margin-bottom: 0;
        }
        
        /* Compact action buttons */
        .action-buttons {
            display: flex;
            gap: 0.25rem;
            flex-wrap: wrap;
        }
        
        .action-buttons .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
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
            
            /* Make table more compact on mobile */
            #students-table {
                font-size: 0.75rem;
            }
            
            #students-table th,
            #students-table td {
                padding: 0.5rem 0.25rem;
            }
            
            .student-info .avatar {
                width: 24px;
                height: 24px;
            }
            
            .action-buttons .btn {
                padding: 0.2rem 0.4rem;
                font-size: 0.7rem;
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
                                    <span class="highlight info">{{ $totalStudents > 0 ? round(($graduatedStudents/$totalStudents)*100) : 0 }}%</span> of all students
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
                                    <span class="highlight danger">{{ $totalStudents > 0 ? round(($blockedStudents/$totalStudents)*100) : 0 }}%</span> of all students
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
                                        <select id="account-filter" class="form-select">
                                            <option value="">All Statuses</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Graduation Status</label>
                                        <select id="graduation-filter" class="form-select">
                                            <option value="">All Students</option>
                                            <option value="graduated">Graduated</option>
                                            <option value="not-graduated">Not Graduated</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Search</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input id="search-input" type="text" class="form-control" placeholder="Search by name, email, or student ID...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">&nbsp;</label>
                                        <button id="clear-search" class="btn btn-secondary w-100">
                                            <i class="fas fa-times"></i> Clear
                                        </button>
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
                                            <th>Student Info</th>
                                            <th>ID</th>
                                            <th>Password</th>
                                            <th>Account Status</th>
                                            <th>Graduation Status</th>
                                            <th>Reg. Date</th>
                                            <th>QR</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    <div class="student-info">
                                                        <img src="{{ asset($student->avatar ?? 'images/default-avatar.png') }}"
                                                            class="avatar" 
                                                            onerror="this.src='{{ asset('images/default-avatar.png') }}'"
                                                            alt="{{ $student->name }}">
                                                        <div class="details">
                                                            <h6 class="mb-0">{{ $student->name }}</h6>
                                                            <p class="text-secondary mb-0">
                                                                {{ $student->mobile ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">{{ $student->login_id }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">{{ $student->plain_password ?? '-' }}</span>
                                                </td>

                                                <td>
                                                    <span
                                                        class="badge badge-sm {{ $student->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                        {{ $student->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge badge-sm {{ $student->is_graduated ? 'bg-gradient-warning' : 'bg-gradient-info' }} me-2">
                                                            {{ $student->is_graduated ? 'Graduated' : 'Not Graduated' }}
                                                        </span>
                                                        <button class="btn btn-sm {{ $student->is_graduated ? 'btn-outline-warning' : 'btn-outline-info' }} toggle-graduation-btn"
                                                                data-student-id="{{ $student->id }}"
                                                                data-current-status="{{ $student->is_graduated ? 'graduated' : 'not_graduated' }}"
                                                                title="{{ $student->is_graduated ? 'Remove Graduation' : 'Mark as Graduated' }}">
                                                            <i class="fas {{ $student->is_graduated ? 'fa-user-graduate' : 'fa-graduation-cap' }}"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">
                                                        {{ $student->created_at->format('Y-m-d') }}</span>
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
                                                    <div class="action-buttons">
                                                        <a href="{{ route('admin.accounts.students.edit', $student->id) }}"
                                                            class="btn btn-link text-info" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.accounts.students.show', $student->id) }}"
                                                            class="btn btn-link text-primary" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.students.account', $student->id) }}"
                                                            class="btn btn-link text-success" title="Financial Account">
                                                            <i class="fas fa-wallet"></i>
                                                        </a>
                                                        <button class="btn btn-link text-dark"
                                                            onclick="printCredentials('{{ $student->login_id }}', '{{ $student->plain_password }}', '{{ $student->name }}')"
                                                            title="Print Credentials">
                                                            <i class="fas fa-key"></i>
                                                        </button>
                                                        <form action="{{ route('admin.accounts.students.destroy', $student->id) }}"
                                                            method="POST" onsubmit="return false;" class="delete-form d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link text-danger delete-btn"
                                                                    data-student-id="{{ $student->id }}"
                                                                    data-student-name="{{ $student->name }}"
                                                                    title="Delete">
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

                            <!-- Results Count -->
                            <div class="d-flex justify-content-between align-items-center p-3">
                                <p class="text-sm mb-0">Showing {{ $students->count() }} of {{ $students->count() }} total students</p>
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
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white border-0">
                    <div class="d-flex align-items-center">
                        <div class="icon icon-shape bg-white bg-gradient-danger shadow-danger text-center rounded-circle me-3">
                            <i class="fas fa-exclamation-triangle text-danger text-lg opacity-10"></i>
                        </div>
                        <div>
                            <h5 class="modal-title mb-0" id="deleteConfirmModalLabel">Delete Student</h5>
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
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" disabled>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const accountFilter = document.getElementById('account-filter');
            const graduationFilter = document.getElementById('graduation-filter');
            const searchInput = document.getElementById('search-input');
            const clearBtn = document.getElementById('clear-search');
            const tableRows = document.querySelectorAll('#students-table tbody tr');
            const countElement = document.querySelector('.d-flex.justify-content-between.align-items-center p');

            // فلترة بسيطة
            function filterTable() {
                const accountStatus = accountFilter.value;
                const graduationStatus = graduationFilter.value;
                const searchText = searchInput.value.toLowerCase();
                let visibleCount = 0;

                tableRows.forEach(row => {
                    let show = true;
                    
                    // فلترة حسب حالة الحساب
                    if (accountStatus) {
                        const statusCell = row.querySelector('td:nth-child(4) span');
                        const status = statusCell.textContent.trim().toLowerCase();
                        if (accountStatus === 'active' && status !== 'active') show = false;
                        if (accountStatus === 'inactive' && status !== 'inactive') show = false;
                    }
                    
                    // فلترة حسب التخرج
                    if (graduationStatus) {
                        const gradCell = row.querySelector('td:nth-child(5) span');
                        const gradStatus = gradCell.textContent.trim().toLowerCase();
                        if (graduationStatus === 'graduated' && gradStatus !== 'graduated') show = false;
                        if (graduationStatus === 'not-graduated' && gradStatus !== 'not graduated') show = false;
                    }
                    
                    // فلترة حسب البحث
                    if (searchText) {
                        const name = row.querySelector('td:nth-child(1) h6').textContent.toLowerCase();
                        const mobile = row.querySelector('td:nth-child(1) p').textContent.toLowerCase();
                        const id = row.querySelector('td:nth-child(2) span').textContent.toLowerCase();
                        if (!name.includes(searchText) && !mobile.includes(searchText) && !id.includes(searchText)) {
                            show = false;
                        }
                    }
                    
                    row.style.display = show ? '' : 'none';
                    if (show) visibleCount++;
                });
                
                // تحديث العداد
                if (countElement) {
                    countElement.textContent = `Showing ${visibleCount} of ${tableRows.length} total students`;
                }
            }

            // Event listeners
            accountFilter.addEventListener('change', filterTable);
            graduationFilter.addEventListener('change', filterTable);
            searchInput.addEventListener('input', filterTable);
            
            // زر مسح البحث
            clearBtn.addEventListener('click', function() {
                searchInput.value = '';
                filterTable();
                searchInput.focus();
            });

            // زر التخرج
            document.addEventListener('click', function(e) {
                if (e.target.closest('.toggle-graduation-btn')) {
                    const button = e.target.closest('.toggle-graduation-btn');
                    const studentId = button.dataset.studentId;
                    const studentName = button.closest('tr').querySelector('td:nth-child(1) h6').textContent;
                    const currentStatus = button.dataset.currentStatus;
                    const isCurrentlyGraduated = currentStatus === 'graduated';
                    
                    // SweetAlert للتأكيد
                    Swal.fire({
                        title: 'Change Graduation Status',
                        text: `Are you sure you want to ${isCurrentlyGraduated ? 'remove graduation from' : 'mark as graduated'} ${studentName}?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, change it!',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const originalHTML = button.innerHTML;
                            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                            button.disabled = true;
                            
                            // إنشاء FormData بدلاً من JSON
                            const formData = new FormData();
                            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                            
                            fetch(`/admin/accounts/students/${studentId}/toggle-graduation`, {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    // إظهار رسالة نجاح
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Graduation status updated successfully!',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        // Refresh الصفحة بعد النجاح
                                        window.location.reload();
                                    });
                                } else {
                                    throw new Error(data.message || 'Failed to update graduation status');
                                }
                            })
                            .catch(error => {
                                button.innerHTML = originalHTML;
                                button.disabled = false;
                                
                                // إظهار رسالة خطأ
                                Swal.fire({
                                    title: 'Error!',
                                    text: error.message,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            });
                        }
                    });
                }
            });

            // تشغيل الفلترة الأولية
            filterTable();
        });

        // كود الحذف
        document.addEventListener('DOMContentLoaded', function() {
            const deleteConfirmation = document.getElementById('deleteConfirmation');
            const deleteForm = document.getElementById('deleteForm');
            const deleteButton = deleteForm.querySelector('button[type="submit"]');

            // تفعيل زر الحذف عند كتابة DELETE
            deleteConfirmation.addEventListener('input', function() {
                if (this.value === 'DELETE') {
                    deleteButton.disabled = false;
                    deleteButton.classList.remove('btn-secondary');
                    deleteButton.classList.add('btn-danger');
                } else {
                    deleteButton.disabled = true;
                    deleteButton.classList.remove('btn-danger');
                    deleteButton.classList.add('btn-secondary');
                }
            });

            // معالجة أزرار الحذف
            document.addEventListener('click', function(e) {
                if (e.target.closest('.delete-btn')) {
                    const button = e.target.closest('.delete-btn');
                    const studentId = button.dataset.studentId;
                    const studentName = button.dataset.studentName;
                    
                    // تحديث معلومات المودال
                    document.getElementById('deleteStudentName').textContent = studentName;
                    deleteForm.action = `/admin/accounts/students/${studentId}`;
                    
                    // إعادة تعيين حقل التأكيد
                    deleteConfirmation.value = '';
                    deleteButton.disabled = true;
                    deleteButton.classList.remove('btn-danger');
                    deleteButton.classList.add('btn-secondary');
                    
                    // فتح المودال
                    const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
                    modal.show();
                }
            });
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html>