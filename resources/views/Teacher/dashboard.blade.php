<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  <title>
    Teacher Dashboard - {{ $teacher->name }}
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
  <style>
    .welcome-animated {
        display: inline-block;
        font-size: 2.5rem;
        font-weight: bold;
        color: #007bff;
        animation: bounce 1.5s infinite alternate, gradientMove 3s linear infinite;
        letter-spacing: 2px;
        margin-top: 20px;
        background: linear-gradient(90deg,rgb(129, 121, 240),rgb(100, 131, 219),rgb(205, 126, 231));
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
    .teacher-info-card {
      background: linear-gradient(45deg,rgb(255, 255, 255),rgb(255, 255, 255));
      color:rgb(123, 105, 172);
      border-radius: 1rem;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }
    .schedule-card {
      background: white;
      border-radius: 1rem;
      padding: 1rem;
      margin-bottom: 1rem;
      box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15);
      transition: transform 0.3s ease;
    }
    .schedule-card:hover {
      transform: translateY(-5px);
    }
    .course-badge {
      background: linear-gradient(45deg, #2dce89, #2dcecc);
      color: white;
      padding: 0.3rem 0.8rem;
      border-radius: 50px;
      font-size: 0.8rem;
      margin: 0.2rem;
      display: inline-block;
    }
    .main-purple {
      color: rgb(123, 105, 172) !important;
    }
    .icon-strong-purple {
      color: #6C2EB7 !important;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
 
  @include('teacher.parts.sidebar-teacher')

  <main class="main-content position-relative border-radius-lg ">
    <!-- Animated Welcome Message -->
    <div class="container mt-4 text-center">
      <h1 class="welcome-animated">Welcome, {{ $teacher->name }}</h1>
    </div>
    <!-- End Animated Welcome Message -->
    
    <!-- معلومات المعلم -->
    <div class="container-fluid py-4">
      <div class="teacher-info-card">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h3 class="mb-2">
              <i class="fas fa-chalkboard-teacher me-2"></i>
              {{ $teacher->name }}
            </h3>
            <p class="mb-1">
              <i class="fas fa-id-card me-2"></i>
              ID: {{ $teacher->login_id }}
            </p>
            <p class="mb-1">
              <i class="fas fa-phone me-2"></i>
              Phone: {{ $teacher->mobile ?? 'Not set' }}
            </p>
            @if($teacher->email)
            <p class="mb-0">
              <i class="fas fa-envelope me-2"></i>
              Email: {{ $teacher->email }}
            </p>
            @endif
          </div>
          <div class="col-md-4 text-end">
            <div class="row text-center">
              <div class="col-6">
                <h4 class="mb-1">{{ $totalCourses }}</h4>
                <small>Courses</small>
              </div>
              <div class="col-6">
                <h4 class="mb-1">{{ $totalStudents }}</h4>
                <small>Students</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- عدد الكورسات -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Current Courses</p>
                    <h5 class="font-weight-bolder">{{ $totalCourses }}</h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">+{{ $teacherCourses->count() }}</span>
                      Active Courses
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-books text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- عدد الطلاب -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Students</p>
                    <h5 class="font-weight-bolder">{{ $totalStudents }}</h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">+{{ $totalStudents }}</span>
                      Registered Students
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- عدد الحصص -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Sessions</p>
                    <h5 class="font-weight-bolder">{{ $totalSchedules }}</h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">+{{ $totalSchedules }}</span>
                      Scheduled Sessions
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- الأرباح -->
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Earnings</p>
                    <h5 class="font-weight-bolder">${{ number_format($totalEarnings, 2) }}</h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">USD</span>
                      Earnings
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- الجداول القادمة والكورسات -->
      <div class="row mt-4">
        <!-- الجداول القادمة -->
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0 main-purple">
                <i class="fas fa-calendar-alt me-2 main-purple"></i>
                الجداول القادمة
              </h6>
            </div>
            <div class="card-body p-3">
              @if($upcomingSchedules->count() > 0)
                @foreach($upcomingSchedules->take(5) as $schedule)
                <div class="schedule-card">
                  <div class="row align-items-center">
                    <div class="col-md-8">
                      <h6 class="mb-1">{{ $schedule['course'] }}</h6>
                      <p class="mb-1 text-muted">
                        <i class="fas fa-calendar me-1 icon-strong-purple"></i>
                        {{ \Carbon\Carbon::parse($schedule['session_date'])->format('Y-m-d') }}
                        ({{ __(ucfirst($schedule['day_of_week'])) }})
                      </p>
                      <p class="mb-0 text-muted">
                        <i class="fas fa-clock me-1 icon-strong-purple"></i>
                        {{ substr($schedule['start_time'], 0, 5) }} - {{ substr($schedule['end_time'], 0, 5) }}
                      </p>
                      <p class="mb-0 text-muted">
                        <i class="fas fa-door-open me-1 icon-strong-purple"></i>
                        {{ $schedule['room'] ?: 'غير محدد' }}
                      </p>
                    </div>
                    <div class="col-md-4 text-end">
                      <span class="course-badge">{{ $schedule['category'] }}</span>
                    </div>
                  </div>
                </div>
                @endforeach
              @else
                <div class="text-center text-muted py-4">
                  <i class="fas fa-calendar-times fa-2x mb-3"></i>
                  <p class="mb-0">لا توجد جداول قادمة</p>
                </div>
              @endif
            </div>
          </div>
        </div>
        
        <!-- الكورسات -->
        <div class="col-lg-5">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0 main-purple">
                <i class="fas fa-book me-2 main-purple"></i>
                My Courses
              </h6>
            </div>
            <div class="card-body p-3">
              @if($teacherCourses->count() > 0)
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th>Course</th>
                        <th>Category</th>
                        <th>Students</th>
                        <th>Earnings %</th>
                      </tr>
                    </thead>
                    <tbody>
                @foreach($teacherCourses as $courseInstructor)
                @php $course = $courseInstructor->course; @endphp
                        <tr>
                          <td>{{ $course->title }}</td>
                          <td>{{ $course->category->name ?? 'Not set' }}</td>
                          <td>{{ $course->enrollments->count() }}</td>
                          <td>{{ $courseInstructor->percentage }}%</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="text-center text-muted py-4">
                  <i class="fas fa-book fa-2x mb-3"></i>
                  <p class="mb-0">No courses assigned to you</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Payments -->
      @if($recentPayments->count() > 0)
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0 main-purple">
                <i class="fas fa-money-bill-wave me-2 main-purple"></i>
                Recent Payments
              </h6>
            </div>
            <div class="card-body p-3">
              <div class="table-responsive">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Amount ($)</th>
                      <th>Notes</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($recentPayments as $payment)
                    <tr>
                      <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') }}</td>
                      <td>${{ number_format($payment->amount, 2) }}</td>
                      <td>{{ $payment->notes }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html>