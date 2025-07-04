<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
    جداول المعلم - {{ $teacher->name }}
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
    .schedule-card {
      transition: all 0.3s ease;
      border: none;
      box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15);
    }
    .schedule-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0.5rem 2rem 0 rgba(136, 152, 170, .2);
    }
    .table-row {
      transition: all 0.2s ease;
    }
    .table-row:hover {
      background-color: #f8f9fe !important;
      transform: scale(1.01);
    }
    .time-badge {
      background: linear-gradient(45deg, #5e72e4, #825ee4);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 50px;
      font-size: 0.875rem;
    }
    .room-badge {
      background: linear-gradient(45deg, #11cdef, #1171ef);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 50px;
      font-size: 0.875rem;
    }
    .subject-badge {
      background: linear-gradient(45deg, #fb6340, #fbb140);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 50px;
      font-size: 0.875rem;
    }
    .category-badge {
      background: linear-gradient(45deg, #2dce89, #2dcecc);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 50px;
      font-size: 0.875rem;
    }
    .table-header {
      background: linear-gradient(45deg, #5e72e4, #825ee4) !important;
    }
    .table-container {
      border-radius: 1rem;
      overflow: hidden;
      box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15);
    }
    .schedule-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #344767;
      margin-bottom: 1rem;
    }
    .schedule-subtitle {
      color: #67748e;
      font-size: 1rem;
      margin-bottom: 2rem;
    }
    .teacher-info-card {
      background: linear-gradient(45deg, #5e72e4, #825ee4);
      color: white;
      border-radius: 1rem;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }
    .stats-card {
      background: white;
      border-radius: 1rem;
      padding: 1.5rem;
      box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15);
      margin-bottom: 1rem;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">

  @include('teacher.parts.sidebar-teacher')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
  
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <!-- معلومات المعلم -->
          <div class="teacher-info-card">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h3 class="mb-2">
                  <i class="fas fa-chalkboard-teacher me-2"></i>
                  {{ $teacher->name }}
                </h3>
                <p class="mb-1">
                  <i class="fas fa-id-card me-2"></i>
                  رقم الهوية: {{ $teacher->login_id }}
                </p>
                <p class="mb-1">
                  <i class="fas fa-phone me-2"></i>
                  الهاتف: {{ $teacher->mobile ?? 'غير محدد' }}
                </p>
                @if($teacher->email)
                <p class="mb-0">
                  <i class="fas fa-envelope me-2"></i>
                  البريد الإلكتروني: {{ $teacher->email }}
                </p>
                @endif
              </div>
              <div class="col-md-4 text-end">
                <div class="stats-card">
                  <h4 class="mb-1">{{ $teacherCourses->count() }}</h4>
                  <p class="mb-0 text-muted">الكورسات</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
      <div class="row">
        <div class="col-12">
          <div class="schedule-card card mb-4">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <i class="fa fa-calendar-alt text-primary me-2" style="font-size:1.5rem;"></i>
                <div>
                  <h5 class="schedule-title mb-0">جداول المعلم</h5>
                  <p class="schedule-subtitle mb-0">جميع الجداول والكورسات الخاصة بالمعلم</p>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <div class="table-container">
                  <table class="table align-items-center mb-0">
                    <thead class="table-header">
                      <tr>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-8 ps-4">التاريخ</th>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-8">اليوم</th>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-8">الوقت</th>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-8">القاعة</th>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-8">المادة</th>
                        <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-8">المسار</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($allSchedules as $schedule)
                      <tr class="table-row">
                        <td class="ps-4">
                          <span class="text-secondary text-xs font-weight-bold">
                            {{ \Carbon\Carbon::parse($schedule['session_date'])->format('Y-m-d') }}
                          </span>
                        </td>
                        <td>
                          <span class="text-secondary text-xs font-weight-bold">
                            {{ __(ucfirst($schedule['day_of_week'])) }}
                          </span>
                        </td>
                        <td>
                          <span class="time-badge">
                            <i class="fa fa-clock me-1"></i>
                            {{ substr($schedule['start_time'], 0, 5) }} - {{ substr($schedule['end_time'], 0, 5) }}
                          </span>
                        </td>
                        <td>
                          <span class="room-badge">
                            <i class="fa fa-door-open me-1"></i>
                            {{ $schedule['room'] ?: 'غير محدد' }}
                          </span>
                        </td>
                        <td>
                          <span class="subject-badge">{{ $schedule['course'] }}</span>
                        </td>
                        <td>
                          <span class="category-badge">{{ $schedule['category'] }}</span>
                        </td>
                      </tr>
                      @empty
                      <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                          <i class="fas fa-calendar-times fa-2x mb-3"></i>
                          <p class="mb-0">لا توجد جداول لهذا المعلم حالياً</p>
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

      <!-- إحصائيات إضافية -->
      @if($teacherCourses->count() > 0)
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <h6 class="mb-0">
                <i class="fas fa-chart-bar me-2"></i>
                إحصائيات الكورسات
              </h6>
            </div>
            <div class="card-body">
              <div class="row">
                @foreach($teacherCourses as $courseInstructor)
                @php $course = $courseInstructor->course; @endphp
                <div class="col-md-4 mb-3">
                  <div class="stats-card">
                    <h6 class="mb-2">{{ $course->title }}</h6>
                    <div class="row text-center">
                      <div class="col-6">
                        <h5 class="text-primary mb-1">{{ $course->enrollments->count() }}</h5>
                        <small class="text-muted">الطلاب</small>
                      </div>
                      <div class="col-6">
                        <h5 class="text-success mb-1">{{ $course->schedules->count() }}</h5>
                        <small class="text-muted">الحصص</small>
                      </div>
                    </div>
                    <div class="mt-2">
                      <span class="badge bg-info">{{ $course->category->name ?? 'غير محدد' }}</span>
                      @if($courseInstructor->percentage > 0)
                      <span class="badge bg-warning">{{ $courseInstructor->percentage }}%</span>
                      @endif
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

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
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
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
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
</body>

</html>