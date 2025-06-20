<!DOCTYPE html>
<html lang="en" dir="LTR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>
        Educational Materials List
    </title>
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
    .welcome-animated {
      display: inline-block;
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
      0%   { transform: translateY(0); }
      100% { transform: translateY(-20px); }
    }
    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      100% { background-position: 100% 50%; }
    }
    .table th, .table td {
      vertical-align: middle;
      text-align: center;
    }
    .btn-info {
      background: #007bff;
      color: #fff;
      border: none;
    }
    .btn-info:hover {
      background: #0056b3;
      color: #fff;
    }
    .btn-danger {
      background: #dc3545;
      color: #fff;
      border: none;
    }
    .btn-danger:hover {
      background: #a71d2a;
      color: #fff;
    }
    .btn-secondary {
      background: #6c757d;
      color: #fff;
      border: none;
    }
    .btn-secondary:hover {
      background: #495057;
      color: #fff;
    }
    .badge-primary {
      background-color: #3498db;
    }
    .badge-success {
      background-color: #2ecc71;
    }
    .status-active {
      color: #27ae60;
      background-color: #daf6e6;
      padding: 6px 12px;
      border-radius: 6px;
    }
    .status-inactive {
      color: #c0392b;
      background-color: #fad7d3;
      padding: 6px 12px;
      border-radius: 6px;
    }
    .filter-bar {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      align-items: center;
      margin-bottom: 20px;
      justify-content: flex-end;
    }
    .filter-bar select, .filter-bar input[type="text"] {
      min-width: 140px;
      max-width: 200px;
      border-radius: 8px;
      border: 1px solid #ddd;
      padding: 6px 12px;
    }
    @media (max-width: 600px) {
      .filter-bar { flex-direction: column; gap: 10px; align-items: stretch; }
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
                                    <h1 class="text-gradient text-primary welcome-animated">Educational Materials 📚</h1>
                                    <p class="mb-0">Manage, add, and edit educational materials and resources</p>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <a href="{{ url('admin/educational-materials/create') }}" class="btn btn-primary mb-0">
                                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Material
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Materials</p>
                                                <h5 class="font-weight-bolder">125</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">+12</span>
                                                    this month
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

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Active</p>
                                                <h5 class="font-weight-bolder">118</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">94%</span>
                                                    of materials
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Categories</p>
                                                <h5 class="font-weight-bolder">8</h5>
                                                <p class="mb-0">
                                                    <span class="text-info text-sm font-weight-bolder">subjects</span>
                                                    available
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

                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Downloads</p>
                                                <h5 class="font-weight-bolder">2,847</h5>
                                                <p class="mb-0">
                                                    <span class="text-warning text-sm font-weight-bolder">+23%</span>
                                                    this week
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                <i class="ni ni-download text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
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
                                            <option>Draft</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Category</label>
                                        <select id="category-filter" class="form-select">
                                            <option value="">All Categories</option>
                                            <option>Mathematics</option>
                                            <option>Physics</option>
                                            <option>Chemistry</option>
                                            <option>Biology</option>
                                            <option>Arabic</option>
                                            <option>English</option>
                                            <option>History</option>
                                            <option>Geography</option>
                                        </select>
                                    </div>
    </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Grade Level</label>
                                        <select id="grade-filter" class="form-select">
                                            <option value="">All Grades</option>
                                            <option>Grade 9</option>
                                            <option>Grade 10</option>
                                            <option>Grade 11</option>
                                            <option>Grade 12</option>
                </select>
                                    </div>
              </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Search</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input id="search-input" type="text" class="form-control" placeholder="Search by name, description...">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

                    <!-- Materials Table -->
                    <div class="card">
                        <div class="card-header pb-0">
                           
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="materials-table" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Material</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Grade</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Created Date</th>
                                            <th class="text-secondary opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('images/theme/bootstrap.jpg') }}" class="avatar avatar-sm me-3" alt="material1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Advanced Mathematics</h6>
                                                        <p class="text-xs text-secondary mb-0">Comprehensive math curriculum for advanced students</p>
                                                    </div>
                                                </div>
                                            </td>
                                             <td>
                                                <p class="text-xs font-weight-bold mb-0">MAT-001</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Mathematics</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-info">Grade 12</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-success">Active</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">2024-01-15</p>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-link text-info p-2" data-bs-toggle="modal" data-bs-target="#editMaterialModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                     <button class="btn btn-link text-primary p-2">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-link text-warning p-2">
                                                        <i class="fas fa-download"></i>
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
                                                        <img src="{{ asset('images/theme/angular.jpg') }}" class="avatar avatar-sm me-3" alt="material2">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Physics Fundamentals</h6>
                                                        <p class="text-xs text-secondary mb-0">Basic physics concepts and experiments</p>
                                                    </div>
                                                </div>
                                            </td>
                                             <td>
                                                <p class="text-xs font-weight-bold mb-0">PHY-002</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Physics</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-info">Grade 11</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-success">Active</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">2024-01-10</p>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-link text-info p-2" data-bs-toggle="modal" data-bs-target="#editMaterialModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                     <button class="btn btn-link text-primary p-2">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-link text-warning p-2">
                                                        <i class="fas fa-download"></i>
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
                                                        <img src="{{ asset('images/theme/react.jpg') }}" class="avatar avatar-sm me-3" alt="material3">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Chemistry Lab Manual</h6>
                                                        <p class="text-xs text-secondary mb-0">Laboratory experiments and safety guidelines</p>
                                                    </div>
                                                </div>
                                            </td>
                                             <td>
                                                <p class="text-xs font-weight-bold mb-0">CHE-003</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Chemistry</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-info">Grade 10</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-warning">Draft</span>
            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">2024-01-05</p>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-link text-info p-2" data-bs-toggle="modal" data-bs-target="#editMaterialModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                     <button class="btn btn-link text-primary p-2">
                                                        <i class="fas fa-eye"></i>
                    </button>
                                                    <button class="btn btn-link text-warning p-2">
                                                        <i class="fas fa-download"></i>
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
                                <p class="text-sm mb-0">Showing 1-10 of 125 materials</p>
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
                                        <li class="page-item"><a class="page-link" href="javascript:;">13</a></li>
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

    <!-- Modal Edit Material -->
    <div class="modal fade" id="editMaterialModal" tabindex="-1" aria-labelledby="editMaterialModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editMaterialModalLabel">Edit Educational Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Material Name</label>
                            <input type="text" class="form-control" value="Advanced Mathematics" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3">Comprehensive math curriculum for advanced students</textarea>
                        </div>
                         <div class="mb-3">
                            <label class="form-label">Material ID</label>
                            <input type="text" class="form-control" value="MAT-001" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" required>
                                <option selected>Mathematics</option>
                                <option>Physics</option>
                                <option>Chemistry</option>
                                <option>Biology</option>
                                <option>Arabic</option>
                                <option>English</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Grade Level</label>
                            <select class="form-select" required>
                                <option selected>Grade 12</option>
                                <option>Grade 11</option>
                                <option>Grade 10</option>
                                <option>Grade 9</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" required>
                                <option selected>Active</option>
                                <option>Inactive</option>
                                <option>Draft</option>
                            </select>
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
                    <p class="mb-0">Are you sure you want to delete the educational material "Advanced Mathematics"?</p>
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
            const categoryFilter = document.getElementById('category-filter');
            const gradeFilter = document.getElementById('grade-filter');
            const materialsTable = document.getElementById('materials-table');
            const tableRows = materialsTable.querySelectorAll('tbody tr');

            function filterMaterials() {
                const searchText = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                const categoryValue = categoryFilter.value;
                const gradeValue = gradeFilter.value;

                tableRows.forEach(row => {
                    const name = row.cells[0].querySelector('h6').textContent.toLowerCase();
                    const description = row.cells[0].querySelector('p').textContent.toLowerCase();
                    const materialId = row.cells[1].textContent.toLowerCase().trim();
                    const category = row.cells[2].textContent.trim();
                    const grade = row.cells[3].textContent.trim();
                    const status = row.cells[4].textContent.trim();
                    
                    const searchMatch = name.includes(searchText) || description.includes(searchText) || materialId.includes(searchText);
                    const statusMatch = statusValue === '' || status === statusValue;
                    const categoryMatch = categoryValue === '' || category === categoryValue;
                    const gradeMatch = gradeValue === '' || grade === gradeValue;

                    if (searchMatch && statusMatch && categoryMatch && gradeMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('keyup', filterMaterials);
            statusFilter.addEventListener('change', filterMaterials);
            categoryFilter.addEventListener('change', filterMaterials);
            gradeFilter.addEventListener('change', filterMaterials);
        });
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html> 