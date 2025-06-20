<!DOCTYPE html>
<html lang="en" dir="LTR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>
        Teachers List
    </title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
    <style>
        .custom-icon-style {
            display: inline-block;
            transform: translateY(-4px); /* You can adjust this value for vertical alignment */
        }
        .welcome-animated {
            /* Add your existing styles here */
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
                    <!-- Welcome Card -->
                    <div class="card mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1 class="text-gradient text-primary welcome-animated">Teachers List 🧑‍🏫</h1>
                                    <p class="mb-0">Manage, add, and edit teacher accounts</p>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <a href="{{ url('admin/accounts/teachers/create') }}" class="btn btn-primary mb-0">
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
                                                <h5 class="font-weight-bolder">50</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">+5</span>
                                                    this semester
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
                                                <h5 class="font-weight-bolder">45</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">90%</span>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">On Leave</p>
                                                <h5 class="font-weight-bolder">2</h5>
                                                <p class="mb-0">
                                                    <span class="text-info text-sm font-weight-bolder">2</span> currently
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                                <i class="ni ni-button-pause text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
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
                                                <h5 class="font-weight-bolder">3</h5>
                                                <p class="mb-0">
                                                    <span class="text-danger text-sm font-weight-bolder">account</span>
                                                    blocked
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
                                            <option>On Leave</option>
                                            <option>Blocked</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Subject</label>
                                        <select id="subject-filter" class="form-select">
                                            <option value="">All Subjects</option>
                                            <option>Mathematics</option>
                                            <option>Physics</option>
                                            <option>Chemistry</option>
                                            <option>Biology</option>
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
                                            <input id="search-input" type="text" class="form-control" placeholder="Search by name, email, or ID...">
                                        </div>
                                    </div>
                                </div>
                           </div>
                        </div>
                    </div>

                    <!-- Teachers Table -->
                    <div class="card">
                        <div class="card-header pb-0">
                           
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="teachers-table" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teacher</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subject</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Registration Date</th>
                                            <th class="text-secondary opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('images/team-1.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Dr. Ahmed Fathy</h6>
                                                        <p class="text-xs text-secondary mb-0">ahmed.fathy@example.com</p>
                                                    </div>
                                                </div>
                                            </td>
                                             <td>
                                                <p class="text-xs font-weight-bold mb-0">TCH-001</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Mathematics</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-success">Active</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">2023-08-15</p>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-link text-info p-2" data-bs-toggle="modal" data-bs-target="#editTeacherModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                     <button class="btn btn-link text-primary p-2">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-link text-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('images/team-2.jpg') }}" class="avatar avatar-sm me-3" alt="user2">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Dr. Mona Said</h6>
                                                        <p class="text-xs text-secondary mb-0">mona.said@example.com</p>
                                                    </div>
                                                </div>
                                            </td>
                                             <td>
                                                <p class="text-xs font-weight-bold mb-0">TCH-002</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Physics</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-success">Active</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">2022-08-15</p>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-link text-info p-2" data-bs-toggle="modal" data-bs-target="#editTeacherModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                     <button class="btn btn-link text-primary p-2">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-link text-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('images/team-3.jpg') }}" class="avatar avatar-sm me-3" alt="user3">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Dr. Hany Adel</h6>
                                                        <p class="text-xs text-secondary mb-0">hany.adel@example.com</p>
                                                    </div>
                                                </div>
                                            </td>
                                             <td>
                                                <p class="text-xs font-weight-bold mb-0">TCH-003</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Chemistry</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-info">On Leave</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">2021-08-15</p>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-link text-info p-2" data-bs-toggle="modal" data-bs-target="#editTeacherModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                     <button class="btn btn-link text-primary p-2">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-link text-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center p-3">
                                <p class="text-sm mb-0">Showing 1-10 of 50 teachers</p>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript:;" tabindex="-1">
                                                <i class="fa fa-angle-left"></i>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="javascript:;">1</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:;">2</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:;">...</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:;">5</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:;">
                                                <i class="fa fa-angle-right"></i>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Edit Teacher -->
    <div class="modal fade" id="editTeacherModal" tabindex="-1" aria-labelledby="editTeacherModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTeacherModalLabel">Edit Teacher Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="Dr. Ahmed Fathy" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="ahmed.fathy@example.com" required>
                        </div>
                         <div class="mb-3">
                            <label class="form-label">Teacher ID</label>
                            <input type="text" class="form-control" value="TCH-001" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <select class="form-select" required>
                                <option selected>Mathematics</option>
                                <option>Physics</option>
                                <option>Chemistry</option>
                                <option>Biology</option>
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
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to delete the teacher account "Dr. Ahmed Fathy"?</p>
                    <p class="text-danger mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Confirm Deletion</button>
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
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('status-filter');
            const subjectFilter = document.getElementById('subject-filter');
            const dateFilter = document.getElementById('date-filter');
            const teachersTable = document.getElementById('teachers-table');
            const tableRows = teachersTable.querySelectorAll('tbody tr');

            function filterTeachers() {
                const searchText = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                const subjectValue = subjectFilter.value;
                const dateValue = dateFilter.value;

                tableRows.forEach(row => {
                    const name = row.cells[0].querySelector('h6').textContent.toLowerCase();
                    const email = row.cells[0].querySelector('p').textContent.toLowerCase();
                    const teacherId = row.cells[1].textContent.toLowerCase().trim();
                    const subject = row.cells[2].textContent.trim();
                    const status = row.cells[3].textContent.trim();
                    const registrationDateText = row.cells[4].textContent.trim();
                    const registrationDate = registrationDateText ? new Date(registrationDateText) : null;
                    
                    const searchMatch = name.includes(searchText) || email.includes(searchText) || teacherId.includes(searchText);
                    const statusMatch = statusValue === '' || status === statusValue;
                    const subjectMatch = subjectValue === '' || subject === subjectValue;

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


                    if (searchMatch && statusMatch && subjectMatch && dateMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('keyup', filterTeachers);
            statusFilter.addEventListener('change', filterTeachers);
            subjectFilter.addEventListener('change', filterTeachers);
            dateFilter.addEventListener('change', filterTeachers);
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html> 