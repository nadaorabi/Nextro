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
    .finance-card {
      transition: all 0.3s ease;
      border-radius: 15px;
    }
    .finance-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .stat-card {
      background: linear-gradient(45deg, #4CAF50, #45a049);
      color: white;
      border-radius: 15px;
      padding: 20px;
    }
    .stat-card.income {
      background: linear-gradient(45deg, #2196F3, #1976D2);
    }
    .stat-card.expenses {
      background: linear-gradient(45deg, #FF5722, #F4511E);
    }
    .stat-card.balance {
      background: linear-gradient(45deg, #9C27B0, #7B1FA2);
    }
    .transaction-row {
      transition: all 0.3s ease;
    }
    .transaction-row:hover {
      background-color: #f8f9fa;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('teacher.parts.sidebar-teacher')
  <div class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#courseEarningsModal">Course Earnings Report</button>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="courseEarningsModal" tabindex="-1" aria-labelledby="courseEarningsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title" id="courseEarningsModalLabel"><i class="fa fa-chart-bar me-2"></i>Course Earnings Report</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background: #f8fafc;">
              <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                  <thead style="background: linear-gradient(90deg, #4CAF50 0%, #2196F3 100%); color: #fff;">
                    <tr>
                      <th><i class="fa fa-book-open me-1"></i>Course Name</th>
                      <th><i class="fa fa-dollar-sign me-1"></i>Total Earnings</th>
                      <th><i class="fa fa-users me-1"></i>Number of Students</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($courseStats as $row)
                      <tr style="transition: background 0.2s;">
                        <td><span class="fw-bold text-primary"><i class="fa fa-book me-1"></i>{{ $row['course_title'] }}</span></td>
                        <td><span class="fw-bold text-success" style="font-size:1.1rem;"><i class="fa fa-arrow-up me-1"></i>${{ number_format($row['earnings'], 2) }}</span></td>
                        <td><span class="badge bg-info text-dark" style="font-size:1rem;"><i class="fa fa-user-graduate me-1"></i>{{ $row['enrollments_count'] }}</span></td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Statistic Cards -->
      <div class="row mb-4">
        <div class="col-md-4 mb-3">
          <div class="card text-center" style="background: #f6f8ff; border: none; box-shadow: 0 2px 8px #e0e7ff;">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div>
                <div style="font-size: 1.1rem; color: #6c63ff; font-weight: bold;">Total Earnings</div>
                <div style="font-size: 2rem; color: #6c63ff; font-weight: bold;">${{ number_format($totalEarnings, 2) }}</div>
                <div style="color: #27ae60; font-size: 0.95rem;">+${{ number_format($totalEarnings, 2) }} this month</div>
              </div>
              <div style="font-size:2.5rem; color:#6c63ff;"><i class="fa fa-coins"></i></div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card text-center" style="background: #fff6f6; border: none; box-shadow: 0 2px 8px #ffe0e0;">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div>
                <div style="font-size: 1.1rem; color: #ff3b3b; font-weight: bold;">Total Payments</div>
                <div style="font-size: 2rem; color: #ff3b3b; font-weight: bold;">${{ number_format($totalPayments, 2) }}</div>
                <div style="color: #ff3b3b; font-size: 0.95rem;">-${{ number_format($totalPayments, 2) }} this month</div>
              </div>
              <div style="font-size:2.5rem; color:#ff3b3b;"><i class="fa fa-credit-card"></i></div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card text-center" style="background: #f6fff6; border: none; box-shadow: 0 2px 8px #e0ffe0;">
            <div class="card-body d-flex align-items-center justify-content-between">
              <div>
                <div style="font-size: 1.1rem; color: #27ae60; font-weight: bold;">Net Balance</div>
                <div style="font-size: 2rem; color: #27ae60; font-weight: bold;">${{ number_format($netBalance, 2) }}</div>
                <div style="color: #27ae60; font-size: 0.95rem;">Positive Balance</div>
              </div>
              <div style="font-size:2.5rem; color:#27ae60;"><i class="fa fa-calculator"></i></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Success/Alert Message -->
      @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
      @endif

      <!-- Transaction Table -->
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mb-0">Financial Transactions History</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Transaction Type</th>
                  <th>Student Name</th>
                  <th>Amount</th>
                  <th>Balance After</th>
                  <th>Notes</th>
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
                @foreach($payments as $payment)
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
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($payment->payment_date ?? $payment->created_at)->format('Y-m-d H:i') }}</td>
                        <td>
                            <span class="badge {{ $typeLabel == 'Course Share' ? 'bg-success' : ($typeLabel == 'Instructor Payment' ? 'bg-danger' : 'bg-secondary') }}">{{ $typeLabel }}</span>
                        </td>
                        <td>{{ $typeLabel == 'Course Share' ? $studentName : '-' }}</td>
                        <td class="text-success">+${{ number_format($amount, 2) }}</td>
                        <td>${{ number_format($balance, 2) }}</td>
                        <td>{{ $typeLabel == 'Course Share' ? ($courseName != '-' ? 'Profit: '.$courseName : '-') : '-' }}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
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

      yearFilter.addEventListener('change', filterTransactions);
      dateFilter.addEventListener('change', filterTransactions);
    });
  </script>
</body>

</html> 