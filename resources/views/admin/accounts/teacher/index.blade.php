<!DOCTYPE html>
<html lang="en" dir="LTR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>Teacher Management</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .custom-icon-style {
            display: inline-block;
            transform: translateY(-4px);
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

        /* Student Card Modal Styles */
        .student-card-modal .modal-content {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
        }

        .student-card-modal .modal-header {
            background: linear-gradient(135deg, #4f8cff 0%, #6dd5ed 100%);
            padding: 2rem;
            text-align: center;
        }

        .student-card-modal .modal-body {
            padding: 2rem;
            background: #f8fafc;
        }

        .student-card-modal .card-preview {
            background: linear-gradient(135deg, #4f8cff 0%, #6dd5ed 100%);
            border-radius: 15px;
            padding: 2rem;
            color: white;
            text-align: center;
            margin-bottom: 1rem;
        }

        .student-card-modal .qr-code-container {
            display: flex;
            justify-content: center;
            margin: 1rem 0;
        }

        .student-card-modal .print-btn {
            background: linear-gradient(135deg, #4f8cff 0%, #6dd5ed 100%);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .student-card-modal .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(79, 140, 255, 0.4);
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
        
        #teachers-table {
            font-size: 0.875rem;
        }
        
        #teachers-table th,
        #teachers-table td {
            padding: 0.75rem 0.5rem;
            white-space: nowrap;
        }
        
        #teachers-table th:first-child,
        #teachers-table td:first-child {
            min-width: 200px;
            white-space: normal;
        }
        
        #teachers-table th:nth-child(2),
        #teachers-table td:nth-child(2) {
            min-width: 120px;
        }
        
        #teachers-table th:nth-child(3),
        #teachers-table td:nth-child(3) {
            min-width: 100px;
        }
        
        #teachers-table th:nth-child(4),
        #teachers-table td:nth-child(4) {
            min-width: 120px;
        }
        
        #teachers-table th:nth-child(5),
        #teachers-table td:nth-child(5) {
            min-width: 80px;
        }
        
        #teachers-table th:nth-child(6),
        #teachers-table td:nth-child(6) {
            min-width: 100px;
        }
        
        #teachers-table th:last-child,
        #teachers-table td:last-child {
            min-width: 150px;
        }
        
        /* Compact teacher info */
        .teacher-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .teacher-info .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .teacher-info .details h6 {
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }
        
        .teacher-info .details p {
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
            #teachers-table {
                font-size: 0.75rem;
            }
            
            #teachers-table th,
            #teachers-table td {
                padding: 0.5rem 0.25rem;
            }
            
            .teacher-info .avatar {
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
                                    <h1 class="text-gradient text-primary">Teacher Management</h1>
                                    <p class="mb-0">Manage, add, and edit teacher accounts</p>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <a href="{{ route('admin.accounts.teachers.create') }}" class="btn btn-primary mb-0">
                                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Teacher
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
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="stat-title">Total Teachers</div>
                                <div class="stat-value">{{ $totalTeachers }}</div>
                                <div class="stat-description">
                                    <span class="highlight success">+{{ $teachersThisMonth }}</span> this month
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card stat-card success">
                                <div class="stat-icon success">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="stat-title">Active</div>
                                <div class="stat-value">{{ $activeTeachers }}</div>
                                <div class="stat-description">
                                    <span class="highlight success">{{ $totalTeachers > 0 ? round(($activeTeachers/$totalTeachers)*100) : 0 }}%</span> of teachers
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card stat-card info">
                                <div class="stat-icon info">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="stat-title">Experienced</div>
                                <div class="stat-value">{{ $experiencedTeachers }}</div>
                                <div class="stat-description">
                                    <span class="highlight info">{{ $totalTeachers > 0 ? round(($experiencedTeachers/$totalTeachers)*100) : 0 }}%</span> of teachers
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card stat-card danger">
                                <div class="stat-icon danger">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <div class="stat-title">Inactive</div>
                                <div class="stat-value">{{ $blockedTeachers }}</div>
                                <div class="stat-description">
                                    <span class="highlight danger">account</span> inactive
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
                                        <label class="form-label">Experience Status</label>
                                        <select id="experience-filter" class="form-select">
                                            <option value="">All Teachers</option>
                                            <option value="experienced">Experienced</option>
                                            <option value="not-experienced">Not Experienced</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Search</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input id="search-input" type="text" class="form-control" placeholder="Search by name, email, or teacher ID...">
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

                    <!-- Teachers Table -->
                    <div class="card">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="teachers-table" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Teacher Info</th>
                                            <th>ID</th>
                                            <th>Password</th>
                                            <th>Experience Status</th>
                                            <th>Account Status</th>
                                            <th>Reg. Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                            <tr>
                                                <td>
                                                    <div class="teacher-info">
                                                        <img src="{{ $teacher->image ? asset('storage/' . $teacher->image) : asset('images/default-avatar.png') }}"
                                                            class="avatar"
                                                            onerror="this.src='{{ asset('images/default-avatar.png') }}'"
                                                            alt="{{ $teacher->name }}">
                                                        <div class="details">
                                                            <h6 class="mb-0">{{ $teacher->name }}</h6>
                                                            <p class="text-secondary mb-0">
                                                                {{ $teacher->mobile ?? '-' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">{{ $teacher->login_id }}</span>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">{{ $teacher->plain_password ?? '-' }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge badge-sm {{ $teacher->is_experienced ? 'bg-gradient-warning' : 'bg-gradient-info' }} me-2">
                                                            {{ $teacher->is_experienced ? 'Experienced' : 'Not Experienced' }}
                                                        </span>
                                                        <button class="btn btn-sm {{ $teacher->is_experienced ? 'btn-outline-warning' : 'btn-outline-info' }} toggle-experience-btn"
                                                                data-teacher-id="{{ $teacher->id }}"
                                                                data-current-status="{{ $teacher->is_experienced ? 'experienced' : 'not_experienced' }}"
                                                                title="{{ $teacher->is_experienced ? 'Remove Experience' : 'Mark as Experienced' }}">
                                                            <i class="fas {{ $teacher->is_experienced ? 'fa-star' : 'fa-user-tie' }}"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-sm {{ $teacher->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                        {{ $teacher->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-xs font-weight-bold">
                                                        {{ $teacher->created_at->format('Y-m-d') }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <div class="action-buttons">
                                                        <a href="{{ route('admin.accounts.teachers.edit', $teacher->id) }}"
                                                            class="btn btn-link text-info" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                        <a href="{{ route('admin.accounts.teachers.show', $teacher->id) }}"
                                                            class="btn btn-link text-primary" title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.teachers.account', $teacher->id) }}"
                            class="btn btn-link text-success" title="Financial Account">
                            <i class="fas fa-wallet"></i>
                        </a>
                                                        <button class="btn btn-link text-dark"
                            onclick="printCredentials('{{ $teacher->login_id }}', '{{ $teacher->name }}', '{{ $teacher->plain_password }}')"
                            title="Print Login Credentials">
                            <i class="fas fa-key"></i>
                    </button>
                                                        
                                                        <form action="{{ route('admin.accounts.teachers.destroy', $teacher->id) }}"
                                                            method="POST" onsubmit="return false;" class="delete-form d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link text-danger delete-btn"
                                                            data-teacher-id="{{ $teacher->id }}"
                                                            data-teacher-name="{{ $teacher->name }}"
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
                                <p class="text-sm mb-0">Showing {{ $teachers->count() }} of {{ $teachers->count() }} total teachers</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

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
                            <h5 class="modal-title mb-0" id="deleteConfirmModalLabel">Confirm Teacher Deletion</h5>
                            <p class="text-white-50 mb-0 small">This action cannot be undone</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="bi bi-person-x text-white text-lg opacity-10" style="font-size: 2rem;"></i>
                        </div>
                        <h6 class="text-danger mb-2">Are you sure you want to delete this teacher account?</h6>
                        <p class="text-muted mb-0" id="deleteTeacherName"></p>
                    </div>
                    
                    <div class="alert alert-warning border-0">
                        <div class="d-flex">
                            <i class="bi bi-exclamation-triangle text-warning me-2 mt-1"></i>
                            <div>
                                <strong>Warning:</strong> This will permanently delete the teacher account and all associated data.
                                <ul class="mb-0 mt-2 small">
                                    <li>Teacher profile will be permanently removed</li>
                                    <li>All course assignments will be deleted</li>
                                    <li>All financial records will be removed</li>
                                    <li>This action cannot be undone</li>
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
                        <i class="bi bi-x me-2"></i>Cancel
                    </button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary" disabled>
                            <i class="bi bi-trash me-2"></i>Delete Teacher Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Card Modal -->
    <div class="modal fade student-card-modal" id="studentCardModal" tabindex="-1" aria-labelledby="studentCardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentCardModalLabel">Teacher ID Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-preview">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center">
                                <img id="modal-student-avatar" src="" alt="Avatar" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                            </div>
                            <div class="col-md-6">
                                <h4 id="modal-student-name" class="mb-2"></h4>
                                <p class="mb-1"><strong>ID:</strong> <span id="modal-student-id"></span></p>
                                <p class="mb-1"><strong>Level:</strong> <span id="modal-student-level"></span></p>
                                <p class="mb-1"><strong>Email:</strong> <span id="modal-student-email"></span></p>
                                <p class="mb-0"><strong>Registration Date:</strong> <span id="modal-student-reg-date"></span></p>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="qr-code-container">
                                    <div id="qrcode"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn print-btn" onclick="printStudentCard()">
                            <i class="fas fa-print me-2"></i>Print ID Card
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>

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

                modalTitle.textContent = 'Teacher ID Card: ' + name;
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

                // Clear previous QR code and generate new one with only teacher ID
                document.getElementById('qrcode').innerHTML = '';
                new QRCode(document.getElementById('qrcode'), {
                    text: id, // Only teacher ID
                    width: 128,
                    height: 128,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
            });

            const searchInput = document.getElementById('search-input');
            const accountFilter = document.getElementById('account-filter');
            const experienceFilter = document.getElementById('experience-filter');
            const clearSearchBtn = document.getElementById('clear-search');
            const teachersTable = document.getElementById('teachers-table');
            const tableRows = teachersTable.querySelectorAll('tbody tr');

            function filterTeachers() {
                const searchText = searchInput.value.toLowerCase();
                const accountValue = accountFilter.value;
                const experienceValue = experienceFilter.value;
                let visibleCount = 0;

                tableRows.forEach(row => {
                    let show = true;
                    
                    // فلترة حسب حالة الحساب
                    if (accountValue) {
                        const statusCell = row.querySelector('td:nth-child(5) span');
                        const status = statusCell.textContent.trim().toLowerCase();
                        if (accountValue === 'active' && status !== 'active') show = false;
                        if (accountValue === 'inactive' && status !== 'inactive') show = false;
                    }
                    
                    // فلترة حسب الخبرة
                    if (experienceValue) {
                        const expCell = row.querySelector('td:nth-child(4) span');
                        const expStatus = expCell.textContent.trim().toLowerCase();
                        if (experienceValue === 'experienced' && expStatus !== 'experienced') show = false;
                        if (experienceValue === 'not-experienced' && expStatus !== 'not experienced') show = false;
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
                const countElement = document.querySelector('.d-flex.justify-content-between.align-items-center p');
                if (countElement) {
                    countElement.textContent = `Showing ${visibleCount} of ${tableRows.length} total teachers`;
                }
            }

            searchInput.addEventListener('keyup', filterTeachers);
            accountFilter.addEventListener('change', filterTeachers);
            experienceFilter.addEventListener('change', filterTeachers);
            clearSearchBtn.addEventListener('click', function() {
                searchInput.value = '';
                filterTeachers();
            });
        });

        function printStudentCard() {
            window.print();
        }

        function printCredentials(loginId, name, password) {
            if (!password || password.trim() === '') {
                alert('Initial password is not available for this teacher.');
                return;
            }

            const printWindow = window.open('', 'PRINT', 'height=500,width=700');

            printWindow.document.write('<html><head><title>Teacher Credentials</title>');
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
            printWindow.document.write('<h2 style="font-size:1.25rem; margin-top:48px; margin-bottom:18px; color:#4f8cff; text-align:center; font-weight:700; letter-spacing:1px;">Teacher Credentials</h2>');
            printWindow.document.write(`<div class="cred-label">Teacher Name</div><div class="cred-value">${name}</div>`);
            printWindow.document.write(`<div class="cred-label">Teacher ID</div><div class="cred-id">${loginId}</div>`);
            printWindow.document.write(`<div class="cred-label">Password</div><div class="cred-pass">${password}</div>`);
            printWindow.document.write('<div class="cred-footer">Keep this information confidential</div>');
            printWindow.document.write('<button class="print-btn" onclick="window.print()">Print</button>');
            printWindow.document.write('</div>');
            printWindow.document.write('</body></html>');

            printWindow.document.close();
            printWindow.focus();
        }
    
        // Delete confirmation modal functionality
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            const deleteModal = document.getElementById('deleteConfirmModal');
            const deleteTeacherName = document.getElementById('deleteTeacherName');
            const deleteForm = document.getElementById('deleteForm');
            const deleteConfirmation = document.getElementById('deleteConfirmation');
            const deleteSubmitBtn = deleteForm.querySelector('button[type="submit"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const teacherName = this.getAttribute('data-teacher-name');
                    const teacherId = this.getAttribute('data-teacher-id');
                    const form = this.closest('.delete-form');
            
                    // Update modal content
                    deleteTeacherName.textContent = teacherName;
                    
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
                        throw new Error(data.message || 'Failed to delete teacher');
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
                submitBtn.innerHTML = '<i class="fas fa-trash me-2"></i>Delete Teacher';
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

        // كود زر الخبرة
        document.addEventListener('DOMContentLoaded', function() {
            // زر الخبرة
            document.addEventListener('click', function(e) {
                if (e.target.closest('.toggle-experience-btn')) {
                    const button = e.target.closest('.toggle-experience-btn');
                    const teacherId = button.dataset.teacherId;
                    const teacherName = button.closest('tr').querySelector('td:nth-child(1) h6').textContent;
                    const currentStatus = button.dataset.currentStatus;
                    const isCurrentlyExperienced = currentStatus === 'experienced';
                    
                    // SweetAlert للتأكيد
                    Swal.fire({
                        title: 'Change Experience Status',
                        text: `Are you sure you want to ${isCurrentlyExperienced ? 'remove experience from' : 'mark as experienced'} ${teacherName}?`,
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
                            
                            // إنشاء FormData
                            const formData = new FormData();
                            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                            
                            fetch(`/admin/accounts/teachers/${teacherId}/toggle-experience`, {
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
                                        text: 'Experience status updated successfully!',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        // Refresh الصفحة بعد النجاح
                                        window.location.reload();
                                    });
                                } else {
                                    throw new Error(data.message || 'Failed to update experience status');
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
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html> 