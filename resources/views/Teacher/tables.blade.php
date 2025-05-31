<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
    نظام حضور الطلاب
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
  <!-- QR Code Scanner -->
  <script src="https://unpkg.com/html5-qrcode"></script>
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('teacher.parts.sidebar-teacher')
  <main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>المواد الدراسية</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المادة</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">القسم</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">عدد الطلاب</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الحالة</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">الرياضيات</h6>
                            <p class="text-xs text-secondary mb-0">الصف الأول</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">قسم العلوم</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">25 طالب</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">نشط</span>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-primary btn-sm" onclick="openAttendanceModal('الرياضيات')">
                          <i class="fas fa-camera me-1"></i> أخذ الحضور
                        </button>
                      </td>
                    </tr>
                    <!-- يمكن إضافة المزيد من المواد هنا -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Modal for QR Code Scanner -->
  <div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
        <div class="modal-header bg-gradient-primary text-white">
          <h5 class="modal-title" id="attendanceModalLabel">
            <i class="fas fa-qrcode me-2"></i>
            أخذ الحضور - <span id="subjectName"></span>
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="row">
            <div class="col-md-8">
              <div class="scanner-container position-relative" style="border-radius: 10px; overflow: hidden;">
                <div id="qr-reader" style="width: 100%"></div>
                <div class="scanner-overlay">
                  <div class="scanner-line"></div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="attendance-stats p-3 bg-light rounded">
                <h6 class="text-center mb-3">إحصائيات الحضور</h6>
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span>عدد الحضور:</span>
                  <span class="badge bg-primary" id="attendanceCount">0</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span>آخر مسح:</span>
                  <span id="lastScanTime">-</span>
                </div>
                <div class="recent-scans mt-4">
                  <h6 class="mb-2">آخر المسح</h6>
                  <div id="recentScansList" class="list-group">
                    <!-- Recent scans will be added here -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="qr-reader-results" class="mt-3"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i> إغلاق
          </button>
        </div>
      </div>
    </div>
  </div>

  <style>
    .scanner-container {
      position: relative;
      background: #000;
      min-height: 400px;
    }
    
    .scanner-overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      pointer-events: none;
    }
    
    .scanner-line {
      position: absolute;
      width: 100%;
      height: 2px;
      background: #00ff00;
      box-shadow: 0 0 8px #00ff00;
      animation: scan 2s linear infinite;
    }
    
    @keyframes scan {
      0% { top: 0; }
      100% { top: 100%; }
    }
    
    .scan-success {
      animation: success-pulse 0.5s ease-in-out;
    }
    
    @keyframes success-pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); }
    }
    
    .recent-scan-item {
      transition: all 0.3s ease;
    }
    
    .recent-scan-item:hover {
      transform: translateX(-5px);
    }
  </style>

  <!-- Core JS Files -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>

  <script>
    let attendanceCount = 0;
    const recentScans = [];
    
    function openAttendanceModal(subject) {
      document.getElementById('subjectName').textContent = subject;
      var modal = new bootstrap.Modal(document.getElementById('attendanceModal'));
      modal.show();
      
      // Initialize QR Scanner
      const html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", 
        { 
          fps: 10, 
          qrbox: 250,
          aspectRatio: 1.0
        }
      );
      
      html5QrcodeScanner.render((decodedText, decodedResult) => {
        // Add success animation
        const scannerContainer = document.querySelector('.scanner-container');
        scannerContainer.classList.add('scan-success');
        setTimeout(() => {
          scannerContainer.classList.remove('scan-success');
        }, 500);
        
        // Update attendance count
        attendanceCount++;
        document.getElementById('attendanceCount').textContent = attendanceCount;
        
        // Update last scan time
        const now = new Date();
        document.getElementById('lastScanTime').textContent = now.toLocaleTimeString();
        
        // Add to recent scans
        recentScans.unshift({
          id: decodedText,
          time: now.toLocaleTimeString()
        });
        
        // Keep only last 5 scans
        if (recentScans.length > 5) {
          recentScans.pop();
        }
        
        // Update recent scans list
        updateRecentScansList();
        
        // Show success message
        const resultsDiv = document.getElementById('qr-reader-results');
        resultsDiv.innerHTML = `
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            تم تسجيل حضور الطالب: ${decodedText}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        `;
        
        // Here you can add AJAX call to save attendance
        // Example:
        // fetch('/save-attendance', {
        //   method: 'POST',
        //   body: JSON.stringify({
        //     student_id: decodedText,
        //     subject: subject
        //   })
        // });
      });
    }
    
    function updateRecentScansList() {
      const list = document.getElementById('recentScansList');
      list.innerHTML = recentScans.map(scan => `
        <div class="list-group-item recent-scan-item d-flex justify-content-between align-items-center">
          <span>${scan.id}</span>
          <small class="text-muted">${scan.time}</small>
        </div>
      `).join('');
    }
  </script>
</body>

</html>