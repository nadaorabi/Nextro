<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  <title>
    Assignments - {{ Auth::user()->name }}
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
 
  @include('teacher.parts.sidebar-teacher')

  <main class="main-content position-relative border-radius-lg ">
    <!-- Header -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Assignments</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Assignments</h6>
        </nav>
      </div>
    </nav>
    <!-- End Header -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Assignments</h6>
                <a href="{{ route('teacher.assignments.create') }}" class="btn btn-primary btn-sm">
                  <i class="fas fa-plus"></i> Add New Assignment
                </a>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assignment</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Course</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Delivery</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Total Grade</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Start Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">End Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($assignments as $assignment)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $assignment->title }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ Str::limit($assignment->description, 50) }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $assignment->course->title ?? 'Not specified' }}</p>
                      </td>
                      <td>
                        <span class="badge badge-sm bg-gradient-{{ $assignment->type == 'auto' ? 'success' : 'info' }}">
                          {{ $assignment->type == 'auto' ? 'Auto' : 'Manual' }}
                        </span>
                      </td>
                      <td>
                        <span class="badge badge-sm bg-gradient-{{ $assignment->delivery_type == 'online' ? 'primary' : 'warning' }}">
                          {{ $assignment->delivery_type == 'online' ? 'Online' : 'File' }}
                        </span>
                        @if($assignment->delivery_type == 'file' && $assignment->file_path)
                          <br><small class="text-xs text-muted">
                            <i class="fas fa-download"></i> 
                            <a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank" class="text-primary">Download</a>
                          </small>
                        @endif
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $assignment->total_grade }}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">
                          {{ $assignment->start_at ? $assignment->start_at->format('Y-m-d H:i') : 'Not specified' }}
                        </p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">
                          {{ $assignment->end_at ? $assignment->end_at->format('Y-m-d H:i') : 'Not specified' }}
                        </p>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a href="{{ route('teacher.assignments.show', $assignment) }}" 
                             class="btn btn-link text-secondary px-3 mb-0">
                            <i class="fas fa-eye text-primary me-1"></i>View
                          </a>
                          <a href="{{ route('teacher.assignments.edit', $assignment) }}" 
                             class="btn btn-link text-secondary px-3 mb-0">
                            <i class="fas fa-edit text-warning me-1"></i>Edit
                          </a>
                          <form action="{{ route('teacher.assignments.destroy', $assignment) }}" 
                                method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-secondary px-3 mb-0"
                                    onclick="return confirm('Are you sure you want to delete this assignment?')">
                              <i class="fas fa-trash text-danger me-1"></i>Delete
                            </button>
                          </form>
                          @if($assignment->delivery_type == 'online')
                            <a href="{{ route('teacher.assignments.questions.list', $assignment) }}" class="btn btn-link text-info px-3 mb-0">
                              <i class="fas fa-question-circle me-1"></i>Questions
                            </a>
                          @endif
                        </div>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="8" class="text-center py-4">
                        <p class="text-sm text-secondary mb-0">No assignments available yet</p>
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
    </div>
  </main>

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
  <script src="{{ asset('js/argon-dashboard.js?v=2.1.0') }}"></script>
</body>

</html> 