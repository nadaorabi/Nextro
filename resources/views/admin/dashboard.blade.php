<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  <title>
  dashboard admin
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

<body class="g-sidenav-show   bg-gray-100">
 
  @include('admin.parts.sidebar-admin')

  <main class="main-content position-relative border-radius-lg ">
    <!-- Animated Welcome Message -->
    <div class="container mt-4 text-center">
      <h1 class="welcome-animated">Welcome, Admin </h1>
    </div>
    <style>
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
    </style>
    <!-- End Animated Welcome Message -->
    <!-- Navbar -->
  
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
    <!-- Total Students -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Students</p>
                <h5 class="font-weight-bolder">{{ $stats['total_students'] ?? 0 }}</h5>
                    <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">+{{ $stats['students_this_month'] ?? 0 }}</span>
                  This month
                    </p>
                    <br> <br>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="ni ni-hat-3 text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Total Teachers -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Teachers</p>
                <h5 class="font-weight-bolder">{{ $stats['total_teachers'] ?? 0 }}</h5>
                    <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">+{{ $stats['teachers_this_month'] ?? 0 }}</span>
                  This month
                    </p>
                    <br> <br>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Total Courses -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Courses</p>
                <h5 class="font-weight-bolder">{{ $stats['total_courses'] ?? 0 }}</h5>
                    <p class="mb-0">
                  <span class="text-info text-sm font-weight-bolder">Active</span>
                  Educational courses
                    </p>
                    
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                <i class="ni ni-books text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Total Revenue -->
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Revenue</p>
                <h5 class="font-weight-bolder">${{ number_format($stats['total_revenue'] ?? 0, 2) }}</h5>
                    <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">+${{ number_format($stats['revenue_this_month'] ?? 0, 2) }}</span>
                  This month
                    </p>
                    <br>
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

  <!-- Student Performance Chart and Quick Tasks -->
      <div class="row mt-4">
    <!-- Student Performance Chart -->
        <div class="col-lg-7 mb-lg-0 mb-4">
          <div class="card z-index-2 h-100">
            <div class="card-header pb-0 pt-3 bg-transparent">
          <h6 class="text-capitalize">Institute Statistics Overview</h6>
              <p class="text-sm mb-0">
                <i class="fa fa-arrow-up text-success"></i>
            <span class="font-weight-bold">{{ $stats['total_students'] ?? 0 }}</span> total students enrolled
              </p>
            </div>
            <div class="card-body p-3">
              <div class="row">
                <div class="col-md-6">
                  <div class="card bg-gradient-primary text-white mb-3">
                    <div class="card-body">
                      <h6 class="card-title">Total Packages</h6>
                      <h3 class="mb-0">{{ $stats['total_packages'] ?? 0 }}</h3>
                      <small>Educational packages available</small>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card bg-gradient-success text-white mb-3">
                    <div class="card-body">
                      <h6 class="card-title">Total Rooms</h6>
                      <h3 class="mb-0">{{ $stats['total_rooms'] ?? 0 }}</h3>
                      <small>Available facilities</small>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card bg-gradient-info text-white mb-3">
                    <div class="card-body">
                      <h6 class="card-title">Total Payments</h6>
                      <h3 class="mb-0">{{ $stats['total_payments'] ?? 0 }}</h3>
                      <small>Financial transactions</small>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="card bg-gradient-warning text-white mb-3">
                    <div class="card-body">
                      <h6 class="card-title">This Month</h6>
                      <h3 class="mb-0">{{ $stats['payments_this_month'] ?? 0 }}</h3>
                      <small>Recent payments</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <!-- Quick Tasks -->
        <div class="col-lg-5">
      <div class="card" style="font-size: 1.3rem; min-height: 350px;">
            <div class="card-header pb-0 p-3">
          <h6 class="mb-0">Quick Tasks</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
            <!-- Active Students -->
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-success shadow text-center">
                  <i class="ni ni-hat-3 text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">✅ Active Students</h6>
                  <span class="text-xs">{{ $stats['active_students'] ?? 0 }} active students</span>
                    </div>
                  </div>
                </li>
            <!-- Active Teachers -->
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-info shadow text-center">
                  <i class="ni ni-single-02 text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">👨‍🏫 Active Teachers</h6>
                  <span class="text-xs">{{ $stats['active_teachers'] ?? 0 }} active teachers</span>
                    </div>
                  </div>
                </li>
            <!-- Pending Accounts -->
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-warning shadow text-center">
                  <i class="ni ni-time-alarm text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">⏳ Pending Accounts</h6>
                  <span class="text-xs">{{ ($stats['pending_students'] ?? 0) + ($stats['pending_teachers'] ?? 0) }} pending accounts</span>
                    </div>
                  </div>
                </li>
            <!-- Blocked Accounts -->
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-danger shadow text-center">
                  <i class="ni ni-lock-circle text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">🚫 Blocked Accounts</h6>
                  <span class="text-xs">{{ ($stats['blocked_students'] ?? 0) + ($stats['blocked_teachers'] ?? 0) }} blocked accounts</span>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

  <!-- Class Performance Table and Carousel -->
  <div class="row mt-4">
    <!-- Class Performance Table -->
    <div class="col-lg-7 mb-lg-0 mb-4">
      <div class="card">
        <div class="card-header pb-0 p-3">
          <h6 class="mb-2">System Overview</h6>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center">
            <thead>
              <tr>
                <th>Category</th>
                <th>Count</th>
                <th>Status</th>
                <th>Details</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Total Students</td>
                <td>{{ $stats['total_students'] ?? 0 }}</td>
                <td><span class="badge bg-success">Active</span></td>
                <td>{{ $stats['active_students'] ?? 0 }} active, {{ $stats['pending_students'] ?? 0 }} pending</td>
              </tr>
              <tr>
                <td>Total Teachers</td>
                <td>{{ $stats['total_teachers'] ?? 0 }}</td>
                <td><span class="badge bg-info">Active</span></td>
                <td>{{ $stats['active_teachers'] ?? 0 }} active, {{ $stats['pending_teachers'] ?? 0 }} pending</td>
              </tr>
              <tr>
                <td>Total Courses</td>
                <td>{{ $stats['total_courses'] ?? 0 }}</td>
                <td><span class="badge bg-primary">Available</span></td>
                <td>Educational courses in system</td>
              </tr>
              <tr>
                <td>Total Packages</td>
                <td>{{ $stats['total_packages'] ?? 0 }}</td>
                <td><span class="badge bg-warning">Available</span></td>
                <td>Educational packages</td>
              </tr>
              <tr>
                <td>Total Revenue</td>
                <td>${{ number_format($stats['total_revenue'] ?? 0, 2) }}</td>
                <td><span class="badge bg-success">Income</span></td>
                <td>${{ number_format($stats['revenue_this_month'] ?? 0, 2) }} this month</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Carousel Section -->
    <div class="col-lg-5">
      <div class="card card-carousel overflow-hidden h-100 p-0">
        <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
          <div class="carousel-inner border-radius-lg h-100">
            <div class="carousel-item h-100 active" style="background-image: url('{{ asset('images/img-school-1-min.jpg') }}'); background-size: cover; background-position: center;">
              <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                  <i class="ni ni-hat-3 text-dark opacity-10"></i>
                </div>
                <h5 class="text-white mb-1">Student Management</h5>
                <p>{{ $stats['total_students'] ?? 0 }} students enrolled in our institute</p>
              </div>
            </div>
            <div class="carousel-item h-100" style="background-image: url('{{ asset('images/teacher-min.jpg') }}'); background-size: cover; background-position: center;">
              <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                  <i class="ni ni-single-02 text-dark opacity-10"></i>
                </div>
                <h5 class="text-white mb-1">Teacher Excellence</h5>
                <p>{{ $stats['total_teachers'] ?? 0 }} qualified teachers providing quality education</p>
              </div>
            </div>
            <div class="carousel-item h-100" style="background-image: url('{{ asset('images/img-school-3-min.jpg') }}'); background-size: cover; background-position: center;">
              <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                  <i class="ni ni-money-coins text-dark opacity-10"></i>
                </div>
                <h5 class="text-white mb-1">Financial Overview</h5>
                <p>Total revenue: ${{ number_format($stats['total_revenue'] ?? 0, 2) }}</p>
              </div>
            </div>
            <div class="carousel-item h-100" style="background-image: url('{{ asset('images/img-school-2-min.jpg') }}'); background-size: cover; background-position: center;">
              <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                  <i class="ni ni-books text-dark opacity-10"></i>
                </div>
                <h5 class="text-white mb-1">Educational Excellence</h5>
                <p>{{ $stats['total_courses'] ?? 0 }} courses available for students</p>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
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
  <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
  <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Mobile apps",
          tension: 0.4,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#5e72e4",
          backgroundColor: gradientStroke1,
          borderWidth: 3,
          fill: true,
          data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
          maxBarThickness: 6

        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#fbfbfb',
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#ccc',
              padding: 20,
              font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
              },
            }
          },
        },
      },
    });
  </script>
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
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html>