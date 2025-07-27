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
    .profile-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: none;
      color: #6C2EB7;
      border: none;
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      transition: all 0.3s ease;
      font-size: 1.2rem;
    }
    .profile-btn:hover {
      color: #5B21B6;
      transform: translateY(-2px);
      text-decoration: none;
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
    
    /* Medium screens - two cards per row */
    @media (max-width: 992px) {
      .teacher-info-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.8rem;
      }
    }
    
    /* Small screens - one card per row */
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
    .schedule-slot {
      background: linear-gradient(45deg, #6C2EB7, #8B5CF6);
      color: white;
      border-radius: 4px;
      padding: 3px;
      margin: 1px;
      font-size: 0.65rem;
    }
    .schedule-slot .course-name {
      color: white;
      margin-bottom: 1px;
      font-size: 0.6rem;
    }
    .schedule-slot .room-info {
      color: white;
      font-size: 0.55rem;
    }
    .empty-slot {
      color: #ccc;
      font-size: 0.8rem;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
    }
    .table-bordered td, .table-bordered th {
      border: 1px solid #dee2e6;
    }
    /* Fix last row columns */
    .table tbody tr:last-child td {
      border-bottom: 2px solid #dee2e6;
    }
    .table tbody tr td:last-child {
      border-right: 2px solid #dee2e6;
    }
    .table tbody tr:last-child td:last-child {
      border-bottom-right-radius: 4px;
    }
    .table tbody tr:last-child td:first-child {
      border-bottom-left-radius: 4px;
    }
    /* Ensure all borders are visible */
    .table-bordered {
      border: 2px solid #dee2e6;
    }
    .table-bordered th,
    .table-bordered td {
      border: 1px solid #dee2e6 !important;
    }
    .table-bordered th:last-child,
    .table-bordered td:last-child {
      border-right: 2px solid #dee2e6 !important;
    }
    .table-bordered tbody tr:last-child td {
      border-bottom: 2px solid #dee2e6 !important;
    }
    /* Force border display */
    .table-responsive {
      border: 1px solid #dee2e6;
      border-radius: 4px;
    }
    .table {
      border-collapse: collapse !important;
      border-spacing: 0;
    }
    .table th,
    .table td {
      border: 1px solid #dee2e6 !important;
      position: relative;
    }
    .table th:last-child,
    .table td:last-child {
      border-right: 2px solid #dee2e6 !important;
    }
    .table tbody tr:last-child td {
      border-bottom: 2px solid #dee2e6 !important;
    }
    /* Ensure consistent cell display */
    .table td {
      min-width: 60px;
      text-align: center;
      vertical-align: middle;
      padding: 8px 4px;
    }
    .table td:first-child {
      min-width: 80px;
      font-weight: bold;
      background-color: #f8f9fa;
    }
    /* Consistent table styling */
    .table {
      border-collapse: collapse;
      width: 100%;
    }
    .table th {
      background-color: #f8f9fa;
      border-bottom: 2px solid #dee2e6;
      font-weight: 600;
      text-align: center;
    }
    .table td {
      border-bottom: 1px solid #dee2e6;
      vertical-align: middle;
    }
    .table tbody tr:hover {
      background-color: rgba(108, 46, 183, 0.05);
    }
    /* Mobile responsive table */
    @media (max-width: 768px) {
      .table-responsive {
        overflow-x: scroll;
        overflow-y: hidden;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: #6C2EB7 #f8f9fa;
        touch-action: pan-x;
        -webkit-user-select: none;
        user-select: none;
      }
      .table-responsive::-webkit-scrollbar {
        height: 6px;
      }
      .table-responsive::-webkit-scrollbar-track {
        background: #f8f9fa;
        border-radius: 3px;
      }
      .table-responsive::-webkit-scrollbar-thumb {
        background: #6C2EB7;
        border-radius: 3px;
      }
      .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #5B21B6;
      }
      .table {
        min-width: 600px;
        white-space: nowrap;
      }
      .schedule-slot {
        min-width: 80px;
        white-space: normal;
        word-wrap: break-word;
      }
      .schedule-slot .course-name {
        font-size: 0.5rem;
        line-height: 1.2;
      }
      .schedule-slot .room-info {
        font-size: 0.45rem;
        line-height: 1.1;
      }
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
    
    <!-- Enhanced Teacher Information Card -->
    <div class="container-fluid py-2">
      <div class="teacher-profile-card">
        <div class="teacher-header">
          <a href="{{ route('teacher.profile') }}" class="profile-btn">
            <i class="fas fa-user"></i>
          </a>
                    <div class="d-flex align-items-center">
            <div class="teacher-avatar me-3">
              <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div>
              <h2 class="teacher-name">{{ $teacher->name }}</h2>
                        </div>
                    </div>
                    </div>
        
        <!-- Card Body -->
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
        <!-- Number of Courses -->
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
                
        <!-- Number of Students -->
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
                
        <!-- Number of Sessions -->
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

        <!-- Earnings -->
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

      <!-- Upcoming Schedules and Courses -->
      <div class="row mt-4">
        <!-- Upcoming Schedules -->
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0 main-purple">
                <i class="fas fa-calendar-alt me-2 main-purple"></i>
                Upcoming Schedules
                            </h6>
                        </div>
            <div class="card-body p-3">
              @if($upcomingSchedules->count() > 0)
                <div class="d-block d-md-none mb-2">
                                                    <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Swipe left/right to view all schedules
                                                    </small>
                                                </div>
                @php
                  $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                  $timeSlots = ['9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM', '4:00 PM'];
                @endphp
                <div class="table-responsive">
                  <table class="table table-bordered align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center" style="width: 80px;">Day/Time</th>
                        @foreach($timeSlots as $time)
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center" style="width: 60px;">
                          {{ $time }}
                        </th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($days as $day)
                      <tr>
                        <td class="text-center font-weight-bold" style="background-color: #f8f9fa;">
                          {{ __(ucfirst($day)) }}
                        </td>
                        @foreach($timeSlots as $time)
                        @php
                          // Convert display time to 24-hour format for comparison
                          $time24 = '';
                          if (strpos($time, 'AM') !== false) {
                            $time24 = str_replace([' AM', ':00'], '', $time);
                            if ($time24 == '12') $time24 = '00';
                            else $time24 = str_pad($time24, 2, '0', STR_PAD_LEFT);
                          } else {
                            $time24 = str_replace([' PM', ':00'], '', $time);
                            if ($time24 != '12') $time24 = $time24 + 12;
                            $time24 = str_pad($time24, 2, '0', STR_PAD_LEFT);
                          }
                          $time24 .= ':00';
                          
                          $schedule = $upcomingSchedules->where('day_of_week', strtolower($day))
                                                      ->where('start_time', '<=', $time24)
                                                      ->where('end_time', '>', $time24)
                                                      ->first();
                        @endphp
                        <td class="text-center" style="height: 50px; vertical-align: middle;">
                          @if($schedule)
                            <div class="schedule-slot">
                              <div class="course-name text-xs font-weight-bold">{{ $schedule['course'] }}</div>
                              <div class="room-info text-xs">
                                <strong>Room: {{ $schedule['room'] ?: 'N/A' }}</strong>
                                                </div>
                                            </div>
                          @else
                            <div class="empty-slot text-muted">-</div>
                                            @endif
                        </td>
                                        @endforeach
                      </tr>
                                    @endforeach
                    </tbody>
                  </table>
                                </div>
                            @else
                <div class="text-center text-muted py-4">
                  <i class="fas fa-calendar-times fa-2x mb-3"></i>
                  <p class="mb-0">No upcoming schedules</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
        <!-- Courses -->
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
                  <table class="table table-bordered align-items-center mb-0" style="min-width: 400px;">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Students</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Earnings %</th>
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
                <table class="table table-bordered align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount ($)</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Notes</th>
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