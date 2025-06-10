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
    <!-- Navbar -->
  
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
    <!-- Number of Classes -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">My Current Classes</p>
                <h5 class="font-weight-bolder">5</h5>
                    <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">+1</span>
                  Since last semester
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
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Number of Students</p>
                <h5 class="font-weight-bolder">120</h5>
                    <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">+3</span>
                  This week
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
    <!-- New Assignments -->
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Assignments Received</p>
                <h5 class="font-weight-bolder">37</h5>
                    <p class="mb-0">
                  <span class="text-danger text-sm font-weight-bolder">+10</span>
                  Today
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                <i class="ni ni-folder-17 text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Graded Exams -->
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Graded Exams</p>
                <h5 class="font-weight-bolder">22</h5>
                    <p class="mb-0">
                  <span class="text-success text-sm font-weight-bolder">+4</span>
                  This week
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="ni ni-check-bold text-lg opacity-10" aria-hidden="true"></i>
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
          <h6 class="text-capitalize">Student Performance Tracking</h6>
              <p class="text-sm mb-0">
                <i class="fa fa-arrow-up text-success"></i>
            <span class="font-weight-bold">+4%</span> improvement since last week
              </p>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
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
            <!-- Assignments Awaiting Grading -->
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                  <i class="ni ni-folder-17 text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">📌 Assignments Awaiting Grading</h6>
                  <span class="text-xs">12 assignments not graded yet</span>
                    </div>
                  </div>
                </li>
            <!-- Today's Scheduled Lessons -->
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                  <i class="ni ni-calendar-grid-58 text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">📅 Today's Scheduled Lessons</h6>
                  <span class="text-xs">3 scheduled classes</span>
                    </div>
                  </div>
                </li>
            <!-- New Messages from Students -->
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                  <i class="ni ni-email-83 text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">📤 New Messages from Students</h6>
                  <span class="text-xs">5 new messages</span>
                    </div>
                  </div>
                </li>
            <!-- Review or Evaluation Requests -->
                <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                  <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                  <i class="ni ni-ruler-pencil text-white opacity-10"></i>
                    </div>
                    <div class="d-flex flex-column">
                  <h6 class="mb-1 text-dark text-sm">🎓 Review or Evaluation Requests</h6>
                  <span class="text-xs">2 new requests</span>
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
          <h6 class="mb-2">Class Performance</h6>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center">
            <tbody>
              <tr>
                <td>10th Grade - Mathematics</td>
                <td>28 students</td>
                <td>87%</td>
                <td>5% absence</td>
              </tr>
              <tr>
                <td>9th Grade - Science</td>
                <td>32 students</td>
                <td>79%</td>
                <td>8% absence</td>
              </tr>
              <tr>
                <td>11th Grade - Chemistry</td>
                <td>20 students</td>
                <td>92%</td>
                <td>3% absence</td>
              </tr>
              <tr>
                <td>8th Grade - Physics</td>
                <td>25 students</td>
                <td>73%</td>
                <td>11% absence</td>
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
            <div class="carousel-item h-100 active" style="background-image: url('{{ asset('images/carousel-1.jpg') }}'); background-size: cover;">
              <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                  <i class="ni ni-camera-compact text-dark opacity-10"></i>
                </div>
                <h5 class="text-white mb-1">Get started with Argon</h5>
                <p>There's nothing I really wanted to do in life that I wasn't able to get good at.</p>
              </div>
            </div>
            <div class="carousel-item h-100" style="background-image: url('{{ asset('images/carousel-2.jpg') }}'); background-size: cover;">
              <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                  <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                </div>
                <h5 class="text-white mb-1">Faster way to create web pages</h5>
                <p>That's my skill. I'm not really specifically talented at anything except for the ability to learn.</p>
              </div>
            </div>
            <div class="carousel-item h-100" style="background-image: url('{{ asset('images/carousel-3.jpg') }}'); background-size: cover;">
              <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                  <i class="ni ni-trophy text-dark opacity-10"></i>
                </div>
                <h5 class="text-white mb-1">Share with us your design tips!</h5>
                <p>Don't be afraid to be wrong because you can't learn anything from a compliment.</p>
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