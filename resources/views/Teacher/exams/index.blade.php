<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
    Exams - {{ Auth::user()->name }}
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
  <style>
    .page-header {
      background: linear-gradient(135deg,rgb(255, 255, 255) 0%,rgb(255, 255, 255) 100%);
      color: rgb(123, 105, 172);
      border-radius: 15px;
      padding: 1.2rem;
      margin-bottom: 1rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .exams-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 2px 15px rgba(0,0,0,0.08);
      border: none;
      transition: all 0.3s ease;
    }

    .exams-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 25px rgba(0,0,0,0.12);
    }

    .table-header {
      background: linear-gradient(135deg,rgb(255, 255, 255) 0%,rgb(255, 255, 255) 100%) !important;
      color: rgb(123, 105, 172) !important;
      border-bottom: 2px solid #e9ecef;
    }

    .table-header th {
      color: rgb(123, 105, 172) !important;
      font-weight: 600 !important;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
    }

    .table-row {
      transition: all 0.2s ease;
      border-bottom: 1px solid #f8f9fa;
    }

    .table-row:hover {
      background: linear-gradient(135deg, rgba(0, 123, 255, 0.05) 0%, rgba(0, 86, 179, 0.05) 100%) !important;
      transform: scale(1.01);
    }

    .type-badge {
      background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }

    .type-badge.manual {
      background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
      box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
    }

    .delivery-badge {
      background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
    }

    .delivery-badge.file {
      background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
      box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
    }

    .duration-badge {
      background: linear-gradient(135deg, #6f42c1 0%, #5a2d91 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(111, 66, 193, 0.3);
    }

    .card-header {
      background: linear-gradient(135deg,rgb(245, 247, 249) 0%,rgb(255, 255, 255) 100%);
      color: rgb(123, 105, 172);
      border-radius: 15px 15px 0 0;
      border: none;
    }

    .card-header h5, .card-header h6 {
      color: rgb(123, 105, 172) !important;
      font-weight: 600;
    }

    .card-header i {
      color: rgb(123, 105, 172) !important;
    }

    .btn-primary {
      background: linear-gradient(135deg, rgb(123, 105, 172) 0%, rgb(103, 85, 152) 100%);
      border: none;
      border-radius: 10px;
      padding: 0.75rem 1.5rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 15px rgba(123, 105, 172, 0.4);
    }

    .btn-link {
      color: rgb(123, 105, 172);
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .btn-link:hover {
      color: rgb(103, 85, 152);
      transform: translateY(-1px);
    }

    .table {
      margin-bottom: 0;
    }

    .table td {
      vertical-align: middle;
      padding: 1rem 0.75rem;
    }

    .table th {
      padding: 1rem 0.75rem;
      border-top: none;
    }

    .empty-state {
      background: linear-gradient(135deg, rgba(0, 123, 255, 0.05) 0%, rgba(0, 86, 179, 0.05) 100%);
      border-radius: 15px;
      padding: 3rem 2rem;
    }

    .empty-state i {
      color: rgb(123, 105, 172);
      opacity: 0.8;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
 
  @include('teacher.parts.sidebar-teacher')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->

    <!-- End Navbar -->
    <div class="container-fluid py-4">

      <!-- Page Header -->
      <div class="row mb-2">
        <div class="col-12">
          <div class="page-header">
            <div class="d-flex align-items-center">
              <div class="me-3">
                <i class="fas fa-file-alt fa-2x"></i>
              </div>
              <div>
                <h2 class="mb-1">Exams</h2>
                <p class="mb-0 opacity-75">Manage all your course examinations</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="exams-card card">
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <i class="fas fa-list text-muted me-2"></i>
                  <h5 class="mb-0">Exam List</h5>
                </div>
                <a href="{{ route('teacher.exams.create') }}" class="btn btn-primary btn-sm">
                  <i class="fas fa-plus"></i> Add New Exam
                </a>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead class="table-header">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Exam</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Course</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Delivery</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Grade</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Duration (minutes)</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Start Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">End Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($exams as $exam)
                    <tr class="table-row">
                      <td class="ps-4">
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $exam->title }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ Str::limit($exam->description, 50) }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $exam->course->title ?? 'Not specified' }}</p>
                      </td>
                      <td>
                        <span class="type-badge {{ $exam->type == 'auto' ? '' : 'manual' }}">
                          {{ $exam->type == 'auto' ? 'Auto' : 'Manual' }}
                        </span>
                      </td>
                      <td>
                        <div class="d-flex flex-column">
                          <span class="delivery-badge {{ ($exam->delivery_type ?? 'online') == 'online' ? '' : 'file' }}">
                            {{ ($exam->delivery_type ?? 'online') == 'online' ? 'Online' : 'File' }}
                          </span>
                          @if(($exam->delivery_type ?? 'online') == 'file' && $exam->file_path)
                            <a href="{{ asset('storage/' . $exam->file_path) }}" target="_blank" 
                               class="text-xs text-primary mt-1">
                              <i class="fas fa-download"></i> Download
                            </a>
                          @endif
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $exam->total_grade }}</p>
                      </td>
                      <td>
                        <span class="duration-badge">
                          <i class="fas fa-clock me-1"></i>
                          {{ $exam->duration }}
                        </span>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">
                          {{ $exam->start_at ? $exam->start_at->format('Y-m-d H:i') : 'Not specified' }}
                        </p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">
                          {{ $exam->end_at ? $exam->end_at->format('Y-m-d H:i') : 'Not specified' }}
                        </p>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a href="{{ route('teacher.exams.show', $exam) }}" 
                             class="btn btn-link text-secondary px-3 mb-0">
                            <i class="fas fa-eye text-primary me-1"></i>View
                          </a>
                          <a href="{{ route('teacher.exams.edit', $exam) }}" 
                             class="btn btn-link text-secondary px-3 mb-0">
                            <i class="fas fa-edit text-warning me-1"></i>Edit
                          </a>
                          <form action="{{ route('teacher.exams.destroy', $exam) }}" 
                                method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-secondary px-3 mb-0"
                                    onclick="return confirm('Are you sure you want to delete this exam?')">
                              <i class="fas fa-trash text-danger me-1"></i>Delete
                            </button>
                          </form>
                          @if(($exam->delivery_type ?? 'online') == 'online')
                            <a href="{{ route('teacher.exams.questions.list', $exam) }}" class="btn btn-link text-info px-3 mb-0">
                              <i class="fas fa-question-circle me-1"></i>Questions
                            </a>
                          @endif
                        </div>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="9" class="text-center text-muted py-4 empty-state">
                        <i class="fas fa-file-alt fa-2x mb-3 d-block"></i>
                        <p class="mb-0">No exams available yet</p>
                      </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark"></span>
            <span class="badge filter bg-gradient-info" data-color="info"></span>
            <span class="badge filter bg-gradient-success" data-color="success"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary px-3 mb-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0" target="_blank">
            <i class="fab fa-twitter me-1"></i>Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0" target="_blank">
            <i class="fab fa-facebook-square me-1"></i>Share
          </a>
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/argon-dashboard.js') }}"></script>
</body>

</html> 