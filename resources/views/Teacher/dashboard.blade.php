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
    .teacher-profile-card {
      background: #ffffff;
      color: #2d3748;
      border-radius: 12px;
      padding: 0;
      margin-bottom: 2rem;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      border: 1px solid #e2e8f0;
      overflow: hidden;
    }
    .teacher-header {
      background: #ffffff;
      color: #6C2EB7;
      padding: 1rem;
      position: relative;
    }
    .teacher-header::before {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      width: 100px;
      height: 100px;
      background: rgba(108, 46, 183, 0.05);
      border-radius: 50%;
      transform: translate(50%, -50%);
    }
    .teacher-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background: linear-gradient(45deg, #6C2EB7, #8B5CF6);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.3rem;
      color: white;
      border: 2px solid #e2e8f0;
    }
    .teacher-name {
      font-size: 1.2rem;
      font-weight: 700;
      margin-bottom: 0;
      color: #6C2EB7;
    }
    .teacher-subtitle {
      font-size: 0.9rem;
      opacity: 0.8;
      color: #6C2EB7;
    }
    .teacher-body {
      padding: 1rem;
    }
    .teacher-info-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
      margin-top: 0.5rem;
    }
    
    /* للشاشات المتوسطة - بطاقتين في السطر */
    @media (max-width: 992px) {
      .teacher-info-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.8rem;
      }
    }
    
    /* للشاشات الصغيرة - بطاقة واحدة في السطر */
    @media (max-width: 576px) {
      .teacher-info-grid {
        grid-template-columns: 1fr;
        gap: 0.6rem;
      }
    }
    .teacher-info-item {
      display: flex;
      align-items: center;
      padding: 0.8rem;
      background: #f8fafc;
      border-radius: 6px;
      border-left: 3px solid #6C2EB7;
      transition: all 0.3s ease;
    }
    .teacher-info-item:hover {
      background: #edf2f7;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .teacher-info-item i {
      width: 20px;
      margin-right: 0.8rem;
      color: #6C2EB7;
      font-size: 1rem;
    }
    .teacher-info-content {
      flex: 1;
    }
    .teacher-info-label {
      font-size: 0.8rem;
      color: #6C2EB7;
      margin-bottom: 0.2rem;
      font-weight: 500;
    }
    .teacher-info-value {
      font-size: 1rem;
      color: #2d3748;
      font-weight: 600;
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
    
    <!-- بطاقة معلومات المعلم المحسنة -->
    <div class="container-fluid py-2">
      <div class="teacher-profile-card">
        <div class="teacher-header">
          <div class="d-flex align-items-center">
            <div class="teacher-avatar me-3">
              <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div>
              <h2 class="teacher-name">{{ $teacher->name }}</h2>
            </div>
          </div>
        </div>
        
        <!-- جسم البطاقة -->
        <div class="teacher-body">
          <div class="teacher-info-grid">
            <div class="teacher-info-item">
              <i class="fas fa-id-card"></i>
              <div class="teacher-info-content">
                <div class="teacher-info-label">ID Number</div>
                <div class="teacher-info-value">{{ $teacher->login_id }}</div>
              </div>
            </div>
            
            <div class="teacher-info-item">
              <i class="fas fa-phone"></i>
              <div class="teacher-info-content">
                <div class="teacher-info-label">Phone Number</div>
                <div class="teacher-info-value">{{ $teacher->mobile ?? 'Not set' }}</div>
              </div>
            </div>
            
            @if($teacher->email)
            <div class="teacher-info-item">
              <i class="fas fa-envelope"></i>
              <div class="teacher-info-content">
                <div class="teacher-info-label">Email Address</div>
                <div class="teacher-info-value">{{ $teacher->email }}</div>
              </div>
            </div>
            @endif
            
            <div class="teacher-info-item">
              <i class="fas fa-calendar-alt"></i>
              <div class="teacher-info-content">
                <div class="teacher-info-label">Join Date</div>
                <div class="teacher-info-value">{{ \Carbon\Carbon::parse($teacher->created_at)->format('Y-m-d') }}</div>
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
                    <p class="mb-0"><br>
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