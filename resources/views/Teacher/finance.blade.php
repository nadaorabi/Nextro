<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
    الإدارة المالية
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
    
    .finance-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 2px 15px rgba(0,0,0,0.08);
      border: none;
      transition: all 0.3s ease;
    }
    
    .finance-card:hover {
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
    
    .earnings-badge {
      background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }
    
    .payment-badge {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }
    
    .balance-badge {
      background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
    }
    
    .transaction-type-badge {
      background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(108, 117, 125, 0.3);
    }
    
    .course-share-badge {
      background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }
    
    .instructor-payment-badge {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
    }
    
    .modal-content {
      border-radius: 15px;
      border: none;
      box-shadow: 0 4px 25px rgba(0,0,0,0.12);
    }
    
    .modal-header {
      background: linear-gradient(135deg,rgb(123, 105, 172) 0%,rgb(123, 105, 172) 100%);
      color: white;
      border-radius: 15px 15px 0 0;
      border: none;
    }
    
    .btn-info {
      background: linear-gradient(135deg,rgb(123, 105, 172) 0%,rgb(123, 105, 172) 100%);
      border: none;
      border-radius: 10px;
      padding: 0.75rem 1.5rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-info:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(123, 105, 172, 0.4);
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
            <div class="d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <div class="me-3">
                  <i class="fas fa-coins fa-2x"></i>
                </div>
                <div>
                  <h2 class="mb-1">Financial Management</h2>
                  <p class="mb-0 opacity-75">View all financial transactions and statistics</p>
                </div>
              </div>
              <div class="ms-auto">
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#courseEarningsModal" style="margin-left: auto; position: absolute; right: 20px; top: 50%; transform: translateY(-50%);">
                  <i class="fas fa-chart-bar me-2"></i>Course Earnings Report
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="courseEarningsModal" tabindex="-1" aria-labelledby="courseEarningsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="courseEarningsModalLabel">
                <i class="fas fa-chart-bar me-2"></i>Course Earnings Report
              </h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background: #f8fafc;">
              <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                  <thead class="table-header">
                    <tr>
                      <th><i class="fas fa-book-open me-1"></i>Course Name</th>
                      <th><i class="fas fa-dollar-sign me-1"></i>Total Earnings</th>
                      <th><i class="fas fa-users me-1"></i>Number of Students</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($courseStats as $row)
                      <tr class="table-row">
                        <td>
                          <span class="fw-bold text-primary">
                            <i class="fas fa-book me-1"></i>{{ $row['course_title'] }}
                          </span>
                        </td>
                        <td>
                          <span class="earnings-badge">
                            <i class="fas fa-arrow-up me-1"></i>${{ number_format($row['earnings'], 2) }}
                          </span>
                        </td>
                        <td>
                          <span class="balance-badge">
                            <i class="fas fa-user-graduate me-1"></i>{{ $row['enrollments_count'] }}
                          </span>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Statistics Cards -->
      <div class="row mb-4">
        <div class="col-md-4 mb-3">
          <div class="stats-card">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="stats-label">Total Earnings</div>
                <div class="stats-number">${{ number_format($totalEarnings, 2) }}</div>
                <div style="color: #28a745; font-size: 0.875rem;">
                  <i class="fas fa-arrow-up me-1"></i>+${{ number_format($totalEarnings, 2) }} this month
                </div>
              </div>
              <div style="font-size: 2.5rem; color: rgb(123, 105, 172);">
                <i class="fas fa-coins"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="stats-card">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="stats-label">Total Payments</div>
                <div class="stats-number">${{ number_format($totalPayments, 2) }}</div>
                <div style="color: #dc3545; font-size: 0.875rem;">
                  <i class="fas fa-arrow-down me-1"></i>-${{ number_format($totalPayments, 2) }} this month
                </div>
              </div>
              <div style="font-size: 2.5rem; color: rgb(123, 105, 172);">
                <i class="fas fa-credit-card"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="stats-card">
            <div class="d-flex align-items-center justify-content-between">
              <div>
                <div class="stats-label">Net Balance</div>
                <div class="stats-number">${{ number_format($netBalance, 2) }}</div>
                <div style="color: #17a2b8; font-size: 0.875rem;">
                  <i class="fas fa-check-circle me-1"></i>Positive Balance
                </div>
              </div>
              <div style="font-size: 2.5rem; color: rgb(123, 105, 172);">
                <i class="fas fa-calculator"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Success/Alert Message -->
      @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
      @endif

      <!-- Transaction Table -->
      <div class="row">
        <div class="col-12">
          <div class="finance-card card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <i class="fas fa-table text-muted me-2"></i>
                <h5 class="mb-0">Financial Transactions History</h5>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead class="table-header">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-4">Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Transaction Type</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Balance After</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Notes</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $balance = 0; @endphp
                    @php
                        function extractStudentName($payment) {
                            if ($payment->type == 'instructor_share') {
                                $text = $payment->notes ?? $payment->description ?? '';
                                // ابحث عن اسم الطالب بعد 'الطالب' وحتى أول كلمة فاصلة أو 'في' أو نهاية الجملة
                                if (preg_match('/الطالب\s+([\p{L}\s]+?)(?:\s+في|\s+من|\s+على|\s+ب|\s+ل|\s+و|,|\.|$)/u', $text, $matches)) {
                                    return trim($matches[1]);
                                }
                                // ابحث عن student: ...
                                if (preg_match('/student:?\s*([\p{L}\s]+?)(?:\s+in|\s+for|,|\.|$)/ui', $text, $matches)) {
                                    return trim($matches[1]);
                                }
                                // ابحث عن name: ...
                                if (preg_match('/name:?\s*([\p{L}\s]+?)(?:\s+in|\s+for|,|\.|$)/ui', $text, $matches)) {
                                    return trim($matches[1]);
                                }
                                // إذا كان النص كله اسم الطالب
                                if (trim($text) && mb_strlen($text) < 30) return trim($text);
                            }
                            return '-';
                        }
                        function extractCourseName($payment) {
                            $text = $payment->notes ?? $payment->description ?? '';
                            if (preg_match('/course:?\s*([\p{L}\s]+)/ui', $text, $matches)) {
                                return trim($matches[1]);
                            } elseif (preg_match('/دورة:?\s*([\p{L}\s]+)/u', $text, $matches)) {
                                return trim($matches[1]);
                            } elseif (preg_match('/أرباح:?\s*([\p{L}\s]+)/u', $text, $matches)) {
                                return trim($matches[1]);
                            } elseif (preg_match('/في الدورة\s+([\p{L}\s]+)/u', $text, $matches)) {
                                return trim($matches[1]);
                            }
                            return '-';
                        }
                    @endphp
                    @forelse($payments as $payment)
                        @php
                            $typeLabel = $payment->type == 'instructor_share' ? 'Course Share' : ($payment->type == 'instructor_payment' ? 'Instructor Payment' : ucfirst($payment->type));
                            $studentName = extractStudentName($payment);
                            $courseName = extractCourseName($payment);
                            $amount = abs($payment->amount);
                            if ($payment->type == 'instructor_share') {
                                $balance += $amount;
                            } elseif ($payment->type == 'instructor_payment') {
                                $balance -= $amount;
                            }
                        @endphp
                        <tr class="table-row">
                            <td class="ps-4">
                                <span class="text-secondary text-xs font-weight-bold">
                                    {{ \Carbon\Carbon::parse($payment->payment_date ?? $payment->created_at)->format('Y-m-d H:i') }}
                                </span>
                            </td>
                            <td>
                                @if($typeLabel == 'Course Share')
                                    <span class="course-share-badge">
                                        <i class="fas fa-share-alt me-1"></i>{{ $typeLabel }}
                                    </span>
                                @elseif($typeLabel == 'Instructor Payment')
                                    <span class="instructor-payment-badge">
                                        <i class="fas fa-money-bill-wave me-1"></i>{{ $typeLabel }}
                                    </span>
                                @else
                                    <span class="transaction-type-badge">
                                        <i class="fas fa-exchange-alt me-1"></i>{{ $typeLabel }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="text-secondary text-xs font-weight-bold">
                                    {{ $typeLabel == 'Course Share' ? $studentName : '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="earnings-badge">
                                    <i class="fas fa-plus me-1"></i>${{ number_format($amount, 2) }}
                                </span>
                            </td>
                            <td>
                                <span class="balance-badge">
                                    <i class="fas fa-wallet me-1"></i>${{ number_format($balance, 2) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-secondary text-xs font-weight-bold">
                                    {{ $typeLabel == 'Course Share' ? ($courseName != '-' ? 'Profit: '.$courseName : '-') : '-' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                                                <tr>
                          <td colspan="6" class="text-center text-muted py-4 empty-state">
                            <i class="fas fa-receipt fa-2x mb-3 d-block"></i>
                            <p class="mb-0">No financial transactions found for this teacher</p>
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
            <i class="fa fa-times"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-sm">
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
        <p class="text-sm d-xl-none d-lg-none">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarPosition(this)">
        </div>
        <hr class="horizontal dark my-sm">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm">
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0" target="_blank">
            <i class="fab fa-twitter me-1"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0" target="_blank">
            <i class="fab fa-facebook-square me-1"></i> Share
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
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const yearFilter = document.getElementById('yearFilter');
      const dateFilter = document.getElementById('dateFilter');
      const tableRows = document.querySelectorAll('tbody tr');

      function filterTransactions() {
        const selectedYear = yearFilter.value;
        const selectedDate = dateFilter.value;

        tableRows.forEach(row => {
          const dateCell = row.querySelector('h6.mb-0');
          const rowDate = new Date(dateCell.textContent.split('/').reverse().join('-'));
          
          let showRow = true;

          if (selectedYear && rowDate.getFullYear().toString() !== selectedYear) {
            showRow = false;
          }

          if (selectedDate) {
            const filterDate = new Date(selectedDate);
            if (rowDate.toDateString() !== filterDate.toDateString()) {
              showRow = false;
            }
          }

          row.style.display = showRow ? '' : 'none';
        });
      }

      if (yearFilter) yearFilter.addEventListener('change', filterTransactions);
      if (dateFilter) dateFilter.addEventListener('change', filterTransactions);
    });
  </script>
</body>

</html> 