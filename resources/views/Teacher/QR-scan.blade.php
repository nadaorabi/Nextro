<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>Student Attendance System</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
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
  <style>
    body {
      font-family: 'Cairo', 'Open Sans', sans-serif;
      background: linear-gradient(135deg, #e0e7ff 0%, #f8fafc 100%);
      min-height: 100vh;
    }
    .modern-card {
      background: #fff;
      border-radius: 1.5rem;
      box-shadow: 0 4px 24px 0 rgba(80, 120, 200, 0.10);
      padding: 2rem 1.5rem;
      margin: 2rem auto;
      max-width: 900px;
    }
    .modern-title {
      font-size: 1.7rem;
      font-weight: 700;
      color: #4f5bd5;
      margin-bottom: 1.5rem;
      letter-spacing: 1px;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    .modern-title i {
      font-size: 1.5rem;
      color: #4f5bd5;
    }
    .subject-table {
      background: #f6f9ff;
      border-radius: 1rem;
      overflow-x: auto;
      box-shadow: 0 2px 8px 0 rgba(80, 120, 200, 0.07);
      min-width: 600px;
    }
    .table-responsive, .table-responsive.p-0 {
      overflow-x: auto;
      border-radius: 1rem;
      box-shadow: 0 2px 8px 0 rgba(80, 120, 200, 0.07);
      background: #fff;
    }
    .subject-table th, .subject-table td {
      vertical-align: middle;
      text-align: center;
      font-size: 1.05rem;
      padding: 1rem 0.5rem;
      white-space: nowrap;
    }
    .subject-table th {
      background: #e3eafe;
      color: #4f5bd5;
      font-weight: 700;
      border: none;
    }
    .subject-table td {
      background: #fff;
      border: none;
    }
    .badge-modern {
      background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
      color: #fff;
      font-size: 1rem;
      border-radius: 2rem;
      padding: 0.4rem 1.2rem;
      font-weight: 600;
    }
    .btn-modern, .btn-primary {
      background: linear-gradient(90deg, #4f5bd5 0%, #5fd2ff 100%);
      color: #fff !important;
      border: none;
      border-radius: 1.5rem;
      font-size: 1.1rem;
      font-weight: 600;
      padding: 0.6rem 1.5rem;
      transition: box-shadow 0.2s, background 0.2s;
      box-shadow: 0 2px 8px 0 rgba(80, 120, 200, 0.10);
    }
    .btn-modern:hover, .btn-primary:hover {
      background: linear-gradient(90deg, #5fd2ff 0%, #4f5bd5 100%);
      color: #fff !important;
      box-shadow: 0 4px 16px 0 rgba(80, 120, 200, 0.15);
    }
    /* Mobile subject cards */
    .mobile-subjects-list { display: none; }
    @media (max-width: 767px) {
      .modern-card {
        padding: 1rem 0.5rem;
        margin: 1rem 0.2rem;
      }
      .subject-table th, .subject-table td {
        font-size: 0.92rem;
        padding: 0.6rem 0.2rem;
      }
      .modern-title {
        font-size: 1.2rem;
      }
      .table-responsive, .table-responsive.p-0 {
        border-radius: 1rem;
        box-shadow: 0 2px 8px 0 rgba(80, 120, 200, 0.07);
        background: #fff;
        margin-bottom: 1rem;
      }
      .subject-table {
        min-width: 500px;
      }
      .table-responsive { display: none !important; }
      .mobile-subjects-list { display: block; }
      .mobile-subject-card {
        background: #fff;
        border-radius: 1.2rem;
        box-shadow: 0 2px 8px 0 rgba(80, 120, 200, 0.10);
        margin-bottom: 1.2rem;
        padding: 1.2rem 1rem 1.5rem 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.7rem;
        position: relative;
      }
      .mobile-subject-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #4f5bd5;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
      }
      .mobile-subject-row {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.2rem;
        font-size: 0.98rem;
      }
      .mobile-subject-row i {
        color: #5fd2ff;
        font-size: 1.1em;
        min-width: 18px;
        text-align: center;
      }
      .mobile-subject-students .badge-modern {
        font-size: 0.95rem;
        padding: 0.3rem 1rem;
        background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
        color: #fff;
      }
      .mobile-subject-btn {
        margin-top: 0.7rem;
        width: 100%;
        display: flex;
        justify-content: center;
      }
      .mobile-subject-btn .btn-modern {
        width: 100%;
        font-size: 1.08rem;
        padding: 0.7rem 0;
      }
    }
    /* QR scan modal styles */
    .modal-content {
      border-radius: 1.2rem;
    }
    .modal-header {
      background: linear-gradient(90deg, #4f5bd5 0%, #5fd2ff 100%);
      color: #fff;
      border-top-left-radius: 1.2rem;
      border-top-right-radius: 1.2rem;
    }
    .modal-title i {
      color: #fff;
    }
    .modal-footer {
      border-bottom-left-radius: 1.2rem;
      border-bottom-right-radius: 1.2rem;
    }
    .alert-warning {
      font-size: 1rem;
      border-radius: 1rem;
    }
    .scanner-container {
      position: relative;
      background: #000;
      min-height: 300px;
      border-radius: 1rem;
      overflow: hidden;
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
    .attendance-stats {
      background: #f6f9ff;
      border-radius: 1rem;
      box-shadow: 0 2px 8px 0 rgba(80, 120, 200, 0.07);
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('teacher.parts.sidebar-teacher')
  <main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6 class="modern-title"><i class="fa fa-book-open"></i> Subjects</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 subject-table">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Subject</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Section</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Students</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Mathematics</h6>
                            <p class="text-xs text-secondary mb-0">First Grade</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Science Department</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-modern">25 Students</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-success fw-bold">Active</span>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-modern btn-sm" onclick="openAttendanceModal('Mathematics')">
                          <i class="fas fa-camera me-1"></i> Take Attendance
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Physics</h6>
                            <p class="text-xs text-secondary mb-0">Second Grade</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Science Department</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-modern">18 Students</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-success fw-bold">Active</span>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-modern btn-sm" onclick="openAttendanceModal('Physics')">
                          <i class="fas fa-camera me-1"></i> Take Attendance
                        </button>
                      </td>
                    </tr>
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
            Take Attendance - <span id="subjectName"></span>
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
                <h6 class="text-center mb-3">Attendance Stats</h6>
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span>Present Count:</span>
                  <span class="badge bg-primary" id="attendanceCount">0</span>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <span>Last Scan:</span>
                  <span id="lastScanTime">-</span>
                </div>
                <div class="recent-scans mt-4">
                  <h6 class="mb-2">Recent Scans</h6>
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
            <i class="fas fa-times me-1"></i> Close
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile subject cards -->
  <div class="mobile-subjects-list" id="mobileSubjectsList"></div>

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
            Student attendance recorded: ${decodedText}
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

        // Play success sound
        const beepSound = document.getElementById('beepSound');
        beepSound.currentTime = 0;
        beepSound.volume = 1.0;
        beepSound.play();
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

    // Add this new function
    function startScan() {
      // Unlock beep sound for browser autoplay
      const beepSound = document.getElementById('beepSound');
      beepSound.muted = true;
      beepSound.play().then(() => {
        beepSound.pause();
        beepSound.currentTime = 0;
        beepSound.muted = false;
      });

      // ... existing code ...
      qrReaderDiv.style.display = 'block';
      startScanBtn.disabled = true;
      if (!html5QrCode) {
        html5QrCode = new Html5Qrcode("qr-reader");
      }
      html5QrCode.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 200 },
        qrCodeMessage => {
          if (!scannedStudents.has(qrCodeMessage)) {
            scannedStudents.add(qrCodeMessage);
            // Hide duplicate alert
            document.getElementById('duplicateAlert').style.display = 'none';
            // Play beep sound
            beepSound.currentTime = 0;
            beepSound.volume = 1.0;
            beepSound.play();
            // Add to scanned list
            const li = document.createElement('li');
            li.className = 'list-group-item list-group-item-success';
            li.textContent = `Scanned: ${qrCodeMessage}`;
            scannedList.appendChild(li);
          } else {
            // Show duplicate alert only, no beep
            const alertDiv = document.getElementById('duplicateAlert');
            alertDiv.textContent = 'This student has already been scanned.';
            alertDiv.style.display = 'block';
            setTimeout(() => { alertDiv.style.display = 'none'; }, 2000);
          }
        },
        errorMessage => {
          // Ignore errors
        }
      ).catch(err => {
        alert('Unable to start QR scanner: ' + err);
      });
    }

    // Update stats and recent scans
    function updateStats(qrCodeMessage) {
      // Update attendance count
      let countDiv = document.getElementById('attendanceCount');
      if (countDiv) {
        countDiv.textContent = attendanceCount;
      }
      // Update last scan time
      let now = new Date();
      let lastScanTimeDiv = document.getElementById('lastScanTime');
      if (lastScanTimeDiv) {
        lastScanTimeDiv.textContent = now.toLocaleTimeString();
      }
      // Add to recent scans
      recentScans.unshift({ id: qrCodeMessage, time: now.toLocaleTimeString() });
      if (recentScans.length > 5) recentScans.pop();
      let recentScansList = document.getElementById('recentScansList');
      if (recentScansList) {
        recentScansList.innerHTML = recentScans.map(scan =>
          `<div class="list-group-item recent-scan-item d-flex justify-content-between align-items-center">
            <span>${scan.id}</span>
            <small class="text-muted">${scan.time}</small>
          </div>`
        ).join('');
      }
    }

    // Render mobile subject cards on mobile
    const subjects = [
      {
        subject: 'Mathematics',
        grade: 'First Grade',
        section: 'Science Department',
        students: 25,
        status: 'Active',
        btn: '<button class="btn btn-modern btn-sm" onclick="openAttendanceModal(\'Mathematics\')"><i class="fas fa-camera me-1"></i> Take Attendance</button>'
      },
      {
        subject: 'Physics',
        grade: 'Second Grade',
        section: 'Science Department',
        students: 18,
        status: 'Active',
        btn: '<button class="btn btn-modern btn-sm" onclick="openAttendanceModal(\'Physics\')"><i class="fas fa-camera me-1"></i> Take Attendance</button>'
      }
    ];
    function renderMobileSubjects() {
      const container = document.getElementById('mobileSubjectsList');
      if (!container) return;
      if (window.innerWidth > 767) {
        container.innerHTML = '';
        return;
      }
      container.innerHTML = subjects.map(s => `
        <div class="mobile-subject-card">
          <div class="mobile-subject-title"><i class="fa fa-book-open"></i> ${s.subject}</div>
          <div class="mobile-subject-row"><i class="fa fa-layer-group"></i> <b>Section:</b> ${s.section}</div>
          <div class="mobile-subject-row mobile-subject-students"><i class="fa fa-users"></i> <b>Students:</b> <span class="badge badge-modern">${s.students} Students</span></div>
          <div class="mobile-subject-row"><i class="fa fa-check-circle"></i> <b>Status:</b> <span class="text-success">${s.status}</span></div>
          <div class="mobile-subject-row"><i class="fa fa-graduation-cap"></i> <b>Grade:</b> ${s.grade}</div>
          <div class="mobile-subject-btn">${s.btn}</div>
        </div>
      `).join('');
    }
    window.addEventListener('resize', renderMobileSubjects);
    document.addEventListener('DOMContentLoaded', renderMobileSubjects);
  </script>

  <audio id="beepSound" class="success-sound" src="https://cdn.pixabay.com/audio/2022/03/15/audio_115b9b7bfa.mp3"></audio>
  <div id="duplicateAlert" class="alert alert-warning text-center py-2" style="display:none; font-size:0.95rem;">This student has already been scanned.</div>
</body>

</html>