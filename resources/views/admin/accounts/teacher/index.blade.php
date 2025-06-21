<!DOCTYPE html>
<html lang="en" dir="LTR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>Teacher Management</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
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
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Teachers</p>
                                                <h5 class="font-weight-bolder">{{ $totalTeachers }}</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">+{{ $teachersThisMonth }}</span>
                                                    this month
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                <i class="ni ni-single-02 text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
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
                                                <h5 class="font-weight-bolder">{{ $activeTeachers }}</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">{{ $totalTeachers > 0 ? round(($activeTeachers/$totalTeachers)*100) : 0 }}%</span>
                                                    of teachers
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

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Experienced</p>
                                                <h5 class="font-weight-bolder">{{ $graduatedTeachers }}</h5>
                                                <p class="mb-0">
                                                    <span class="text-info text-sm font-weight-bolder">5+ years</span>
                                                    experience
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                                <i class="ni ni-trophy text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Inactive</p>
                                                <h5 class="font-weight-bolder">{{ $blockedTeachers }}</h5>
                                                <p class="mb-0">
                                                    <span class="text-danger text-sm font-weight-bolder">account</span>
                                                    inactive
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                <i class="ni ni-fat-delete text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
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
                                            <option>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Specialization</label>
                                        <select id="specialization-filter" class="form-select">
                                            <option value="">All Specializations</option>
                                            <option>Mathematics</option>
                                            <option>Science</option>
                                            <option>English</option>
                                            <option>Arabic</option>
                                            <option>Computer Science</option>
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

                    <!-- Teachers Table -->
                    <div class="card">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="teachers-table" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Teacher</th>
                                            <th>ID</th>
                                            <th>Password</th>
                                            <th>Specialization</th>
                                            <th>Status</th>
                                            <th>Registration Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($teachers as $teacher)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset($teacher->avatar ?? 'images/default-avatar.png') }}"
                                                                class="avatar avatar-sm me-3" 
                                                                onerror="this.src='{{ asset('images/default-avatar.png') }}'"
                                                                alt="{{ $teacher->name }}">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $teacher->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $teacher->email ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $teacher->login_id }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $teacher->plain_password ?? '-' }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $teacher->specialization ?? '-' }}</p>
                                                </td>
                                                <td>
                                                    <span class="badge badge-sm {{ $teacher->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                                        {{ $teacher->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $teacher->created_at->format('Y-m-d') }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="{{ route('admin.accounts.teachers.show', $teacher->id) }}" class="btn btn-sm btn-info px-2 py-1 mb-0" title="View Details">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.accounts.teachers.edit', $teacher->id) }}" class="btn btn-sm btn-warning px-2 py-1 mb-0" title="Edit Teacher">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button class="btn btn-sm btn-success px-2 py-1 mb-0" title="Print Credentials" onclick="printCredentials('{{ $teacher->login_id }}', '{{ $teacher->name }}', '{{ $teacher->plain_password }}')">
                                                        <i class="fas fa-print"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger px-2 py-1 mb-0" title="Delete Teacher"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#deleteConfirmModal"
                                                            data-teacher-id="{{ $teacher->id }}"
                                                            data-teacher-name="{{ $teacher->name }}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center p-3">
                                <p class="text-sm mb-0">Showing {{ $teachers->firstItem() }} -
                                    {{ $teachers->lastItem() }} of {{ $teachers->total() }} teachers</p>
                                {{ $teachers->links('pagination::bootstrap-4') }}
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
                        <h6 class="text-danger mb-2">Are you sure you want to delete this teacher?</h6>
                        <p class="text-muted mb-0" id="deleteTeacherName"></p>
                    </div>
                    
                    <div class="alert alert-warning border-0">
                        <div class="d-flex">
                            <i class="fas fa-exclamation-triangle text-warning me-2 mt-1"></i>
                            <div>
                                <strong>Warning:</strong> This will permanently delete the teacher account and all associated data.
                                <ul class="mb-0 mt-2 small">
                                    <li>Teacher profile will be removed</li>
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
                            <i class="fas fa-trash me-2"></i>Delete Teacher
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
            const specializationFilter = document.getElementById('specialization-filter');
            const dateFilter = document.getElementById('date-filter');
            const teachersTable = document.getElementById('teachers-table');
            const tableRows = teachersTable.querySelectorAll('tbody tr');

            function filterTeachers() {
                const searchText = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                const specializationValue = specializationFilter.value;
                const dateValue = dateFilter.value;

                tableRows.forEach(row => {
                    const name = row.cells[0].querySelector('h6').textContent.toLowerCase();
                    const email = row.cells[0].querySelector('p').textContent.toLowerCase();
                    const teacherId = row.cells[1].textContent.toLowerCase().trim();
                    const specialization = row.cells[3].textContent.trim();
                    const status = row.cells[4].textContent.trim();
                    const registrationDateText = row.cells[5].textContent.trim();
                    const registrationDate = registrationDateText ? new Date(registrationDateText) : null;

                    const searchMatch = name.includes(searchText) || email.includes(searchText) || teacherId.includes(searchText);
                    const statusMatch = statusValue === '' || status === statusValue;
                    const specializationMatch = specializationValue === '' || specialization === specializationValue;

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

                    if (searchMatch && statusMatch && specializationMatch && dateMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('keyup', filterTeachers);
            statusFilter.addEventListener('change', filterTeachers);
            specializationFilter.addEventListener('change', filterTeachers);
            dateFilter.addEventListener('change', filterTeachers);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
    function printCredentials(loginId, name, password) {
        const printWindow = window.open('', 'PRINT', 'height=400,width=600');
        
        printWindow.document.write('<html><head><title>Print Credentials</title>');
        printWindow.document.write('<style>');
        printWindow.document.write(`
            @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap');
            body { 
                font-family: 'Tajawal', sans-serif; 
                text-align: center; 
                margin: 20px;
                direction: rtl;
            }
            .credential-card {
                border: 2px solid #007bff;
                border-radius: 15px;
                padding: 25px;
                width: 350px;
                margin: auto;
                background-color: #f8f9fa;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            }
            .credential-card h3 {
                color: #0056b3;
                border-bottom: 2px solid #0056b3;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }
            .credential-card p {
                font-size: 16px;
                margin: 10px 0;
                text-align: right;
            }
            .credential-card span {
                font-weight: 700;
                background-color: #e9ecef;
                padding: 3px 8px;
                border-radius: 5px;
                font-family: monospace;
            }
        `);
        printWindow.document.write('</style></head><body>');
        
        printWindow.document.write('<div class="credential-card">');
        printWindow.document.write('<h3>بيانات الدخول</h3>');
        printWindow.document.write('<p>الاسم: <span>' + name + '</span></p>');
        printWindow.document.write('<p>معرف الدخول (ID): <span>' + loginId + '</span></p>');
        printWindow.document.write('<p>كلمة المرور: <span>' + password + '</span></p>');
        printWindow.document.write('</div>');
        
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.focus();
        
        setTimeout(() => {
            printWindow.print();
            printWindow.close();
        }, 250);
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        const deleteConfirmModal = document.getElementById('deleteConfirmModal');
        deleteConfirmModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const teacherId = button.getAttribute('data-teacher-id');
            const teacherName = button.getAttribute('data-teacher-name');

            const modalTeacherName = deleteConfirmModal.querySelector('#deleteTeacherName');
            const deleteForm = deleteConfirmModal.querySelector('#deleteForm');
            
            modalTeacherName.textContent = teacherName;
            let action = "{{ route('admin.accounts.teachers.destroy', ':id') }}";
            action = action.replace(':id', teacherId);
            deleteForm.setAttribute('action', action);
        });

        const deleteConfirmationInput = document.getElementById('deleteConfirmation');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

        deleteConfirmationInput.addEventListener('input', function() {
            if (this.value.trim().toUpperCase() === 'DELETE') {
                confirmDeleteBtn.disabled = false;
            } else {
                confirmDeleteBtn.disabled = true;
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