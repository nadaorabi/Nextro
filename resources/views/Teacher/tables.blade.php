<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
    Teacher Schedules - {{ $teacher->name }}
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
    
    .schedule-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 2px 15px rgba(0,0,0,0.08);
      border: none;
      transition: all 0.3s ease;
    }
    
    .schedule-card:hover {
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
    
    .time-badge {
      background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(108, 117, 125, 0.3);
    }
    
    .room-badge {
      background: linear-gradient(135deg, #495057 0%, #343a40 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(73, 80, 87, 0.3);
    }
    
    .subject-badge {
      background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }
    
    .category-badge {
      background: linear-gradient(135deg, #20c997 0%, #1ea085 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(32, 201, 151, 0.3);
    }
    
    .stats-card {
      background: white;
      border-radius: 15px;
      padding: 1.5rem;
      box-shadow: 0 2px 15px rgba(0,0,0,0.08);
      margin-bottom: 1rem;
      border: 1px solid #e9ecef;
      transition: all 0.3s ease;
    }
    
    .stats-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 25px rgba(0,0,0,0.12);
    }
    
    .stats-number {
      font-size: 1.5rem;
      font-weight: 600;
      color: rgb(123, 105, 172);
    }
    
    .stats-label {
      color: #6c757d;
      font-size: 0.875rem;
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
    
    .course-statistics-header h6 {
      color: rgb(123, 105, 172) !important;
    }
    
    .course-statistics-header i {
      color: rgb(123, 105, 172) !important;
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
                <i class="fas fa-calendar-alt fa-2x"></i>
              </div>
              <div>
                <h2 class="mb-1">Teacher Schedules</h2>
                <p class="mb-0 opacity-75">View all schedules and courses for {{ $teacher->name }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
     
      <div class="row">
        <div class="col-12">
          <div class="schedule-card card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <i class="fas fa-table text-muted me-2"></i>
                <h5 class="mb-0">Schedule Details</h5>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead class="table-header">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Day</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Time</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Room</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category</th>
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
                          <i class="fas fa-clock me-1"></i>
                          {{ substr($schedule['start_time'], 0, 5) }} - {{ substr($schedule['end_time'], 0, 5) }}
                        </span>
                      </td>
                      <td>
                        <span class="room-badge">
                          <i class="fas fa-door-open me-1"></i>
                          {{ $schedule['room'] ?: 'Not specified' }}
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
                      <td colspan="6" class="text-center text-muted py-4 empty-state">
                        <i class="fas fa-calendar-times fa-2x mb-3 d-block"></i>
                        <p class="mb-0">No schedules found for this teacher</p>
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

      <!-- Course Statistics -->
      @if($teacherCourses->count() > 0)
      <div class="row mt-4">
        <div class="col-12">
          <div class="schedule-card card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center course-statistics-header">
                <i class="fas fa-chart-bar me-2"></i>
                <h6 class="mb-0">Course Statistics</h6>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                @foreach($teacherCourses as $courseInstructor)
                @php $course = $courseInstructor->course; @endphp
                <div class="col-md-4 mb-3">
                  <div class="stats-card">
                    <h6 class="mb-3 text-dark">{{ $course->title }}</h6>
                    <div class="row text-center">
                      <div class="col-6">
                        <div class="stats-number">{{ $course->enrollments->count() }}</div>
                        <div class="stats-label">Students</div>
                      </div>
                      <div class="col-6">
                        <div class="stats-number">{{ $course->schedules->count() }}</div>
                        <div class="stats-label">Sessions</div>
                      </div>
                    </div>
                    <div class="mt-3">
                      <span class="badge bg-secondary me-1">{{ $course->category->name ?? 'Not specified' }}</span>
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