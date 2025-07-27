@extends('layouts.teacher')

@section('title', 'Take Attendance')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12" style="max-width:1200px;margin:auto;">
      
      <!-- Header Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0"><i class="fas fa-camera me-2"></i>Take Attendance</h4>
              <p class="text-muted mb-0">{{ $schedule->course->title }} - {{ __(ucfirst($schedule->day_of_week)) }}</p>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ route('teacher.attendance.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Attendance
              </a>
              <a href="{{ route('teacher.attendance.qr-codes', $schedule->id) }}" class="btn btn-outline-primary">
                <i class="fas fa-qrcode"></i> QR Codes
              </a>
              <a href="{{ route('teacher.attendance.schedule-details', $schedule->id) }}" class="btn btn-outline-secondary">
                <i class="fas fa-list"></i> Details
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Schedule Info -->
      <div class="card shadow-sm mb-4">
        <div class="card-header">
          <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Schedule Information</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <div>
                <small class="text-muted">Course:</small><br>
                <span class="fw-bold">{{ $schedule->course->title }}</span>
              </div>
            </div>
            <div class="col-md-2">
              <div>
                <small class="text-muted">Day:</small><br>
                <span class="fw-bold">{{ __(ucfirst($schedule->day_of_week)) }}</span>
              </div>
            </div>
            <div class="col-md-3">
              <div>
                <small class="text-muted">Time:</small><br>
                <span class="fw-bold">{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</span>
              </div>
            </div>
            <div class="col-md-4">
              <div>
                <small class="text-muted">Room:</small><br>
                <span class="fw-bold">{{ $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name) : 'Not Assigned' }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Statistics -->
      <div class="row mb-4">
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-primary">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-users"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number" id="totalStudents">{{ $studentCount }}</div>
                <div class="stats-label">Total Students</div>
                <div class="stats-description">Enrolled in session</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-success">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-check-circle"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number" id="currentAttendance">{{ $presentCount }}</div>
                <div class="stats-label">Present</div>
                <div class="stats-description">Students present</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-danger">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-exclamation-circle"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number" id="currentAbsence">{{ $absentCount }}</div>
                <div class="stats-label">Absent</div>
                <div class="stats-description">Students absent</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-warning">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-clock"></i>
              </div>
              <div class="stats-content">
                <div class="stats-number" id="pendingCount">{{ $pendingCount }}</div>
                <div class="stats-label">Pending</div>
                <div class="stats-description">Not marked yet</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="stats-card stats-card-info">
            <div class="stats-card-body">
              <div class="stats-icon">
                <i class="fas fa-chart-line"></i>
              </div>
              <div class="stats-content">
                @php
                  $totalMarked = $presentCount + $absentCount;
                  $attendancePercentage = $totalMarked > 0 ? round(($presentCount / $totalMarked) * 100, 1) : 0;
                @endphp
                <div class="stats-number" id="attendancePercentage">{{ $attendancePercentage }}%</div>
                <div class="stats-label">Attendance Rate</div>
                <div class="stats-description">Current rate</div>
              </div>
            </div>
            <div class="stats-card-decoration"></div>
          </div>
        </div>
      </div>
        
      <!-- QR Scanner Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-header">
          <h5 class="mb-0"><i class="fas fa-qrcode me-2"></i>QR Code Scanner</h5>
        </div>
        <div class="card-body text-center">
          <button class="btn btn-primary btn-lg" id="openScanModal">
            <i class="fas fa-camera me-2"></i> Start Scanning
          </button>
          <button class="btn btn-outline-info ms-2" id="refreshStats">
            <i class="fas fa-sync-alt me-1"></i> Refresh Stats
          </button>
        </div>
      </div>

      <!-- Present Students Table -->
      <div class="card shadow-sm" id="presentStudentsSection">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Students Present Today</h5>
            <div class="d-flex gap-2">
              <button class="btn btn-sm btn-outline-success" id="exportAttendance">
                <i class="fas fa-download me-1"></i> Export
              </button>
              <button class="btn btn-sm btn-outline-primary" id="refreshList">
                <i class="fas fa-sync-alt me-1"></i> Refresh
              </button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Search and Filter -->
          <div class="row mb-3">
            <div class="col-md-6">
              <input type="text" class="form-control" id="searchStudent" placeholder="Search students...">
            </div>
            <div class="col-md-3">
              <select class="form-select" id="filterStatus">
                <option value="">All Status</option>
                <option value="present">Present</option>
                <option value="absent">Absent</option>
              </select>
            </div>
            <div class="col-md-3">
              <button class="btn btn-outline-secondary w-100" id="clearFilters">
                <i class="fas fa-times me-1"></i> Clear Filters
              </button>
            </div>
          </div>
          
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th>Student Name</th>
                  <th>Login ID</th>
                  <th>Check-in Time</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="presentStudentsTable">
                <!-- Will be populated by JavaScript -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- QR Scanner Modal -->
<div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="scanModalLabel">
          <i class="fas fa-qrcode me-2"></i>
          QR Code Scanner - {{ $schedule->course->title }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
            <div class="scanner-container position-relative bg-dark rounded">
              <div id="qr-reader" style="width: 100%"></div>
              
              <!-- منطقة عرض رسائل التأكيد -->
              <div id="scan-message-overlay" class="position-absolute w-100 h-100 d-none" 
                   style="top: 0; left: 0; background: rgba(0,0,0,0.8); z-index: 1000; display: flex; align-items: center; justify-content: center;">
                <div class="text-center text-white">
                  <div id="scan-message-icon" class="mb-3">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                  </div>
                  <div id="scan-message-text" class="h5 mb-0">Processing...</div>
                </div>
              </div>
            </div>
            <!-- Camera Controls -->
            <div class="mt-3 text-center">
              <button class="btn btn-sm btn-outline-primary me-2" id="switchCamera">
                <i class="fas fa-sync-alt me-1"></i> Switch Camera
              </button>
              <button class="btn btn-sm btn-outline-secondary" id="toggleFlash">
                <i class="fas fa-lightbulb me-1"></i> Flash
              </button>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-3 bg-light rounded">
              <h6 class="text-center mb-3">Scan Statistics</h6>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span>Total Students:</span>
                <span class="badge bg-info" id="totalStudentCount">{{ $studentCount }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span>Present:</span>
                <span class="badge bg-primary" id="attendanceCount">{{ $presentCount }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span>Absent:</span>
                <span class="badge bg-danger" id="absentCount">{{ $absentCount }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span>Pending:</span>
                <span class="badge bg-warning" id="pendingCount">{{ $pendingCount }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span>Attendance Rate:</span>
                @php
                  $totalMarked = $presentCount + $absentCount;
                  $attendancePercentage = $totalMarked > 0 ? round(($presentCount / $totalMarked) * 100, 1) : 0;
                @endphp
                <span class="badge bg-success" id="attendancePercent">{{ $attendancePercentage }}%</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span>Last Scan:</span>
                <span id="lastScanTime">-</span>
              </div>
              <div class="mt-4">
                <h6 class="mb-2">Recent Scans</h6>
                <div id="recentScansList" class="list-group"></div>
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

<!-- Export Modal -->
<div class="modal fade" id="exportModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Export Attendance Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Export Format:</label>
          <select class="form-select" id="exportType">
            <option value="excel">Excel (.xlsx)</option>
            <option value="pdf">PDF</option>
            <option value="csv">CSV</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Data Range:</label>
          <select class="form-select" id="exportRange">
            <option value="current">Current Session Only</option>
            <option value="all">All Course Sessions</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmExport">Export</button>
      </div>
    </div>
  </div>
</div>

<audio id="beepSound" src="/sounds/beep.mp3"></audio>

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
let attendanceCount = {{ $presentCount }};
const recentScans = [];
let html5QrcodeScanner = null;
let currentFacingMode = "environment";
let flashEnabled = false;
let lastScanId = null;
let lastScanTime = 0;

// Show Toast
function showToast(message, type = 'info') {
  let toast = document.createElement('div');
  toast.className = `alert alert-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show position-fixed`;
  toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
  toast.innerHTML = `${message}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>`;
  document.body.appendChild(toast);
  setTimeout(() => toast.remove(), 5000);
}

// Show Scan Progress
function showScanProgress(message, type = 'info') {
  const overlay = document.getElementById('scan-message-overlay');
  const messageText = document.getElementById('scan-message-text');
  const messageIcon = document.getElementById('scan-message-icon');
  
  // تحديث النص
  messageText.textContent = message;
  
  // تحديث الأيقونة حسب النوع
  if (type === 'success') {
    messageIcon.innerHTML = '<i class="fas fa-check-circle fa-2x text-success"></i>';
  } else if (type === 'error') {
    messageIcon.innerHTML = '<i class="fas fa-exclamation-circle fa-2x text-danger"></i>';
  } else {
    messageIcon.innerHTML = '<i class="fas fa-spinner fa-spin fa-2x text-info"></i>';
  }
  
  // إظهار الـ overlay
  overlay.classList.remove('d-none');
  overlay.style.display = 'flex';
}

// Hide Scan Progress
function hideScanProgress() {
  const overlay = document.getElementById('scan-message-overlay');
  overlay.classList.add('d-none');
  overlay.style.display = 'none';
}

// Show Success Message
function showScanSuccess(studentName) {
  showScanProgress(`${studentName} marked as present successfully!`, 'success');
  
  // إخفاء الرسالة بعد 3 ثواني
  setTimeout(() => {
    hideScanProgress();
  }, 3000);
}

// Show Error Message
function showScanError(message) {
  showScanProgress(message, 'error');
  
  // إخفاء الرسالة بعد 3 ثواني
  setTimeout(() => {
    hideScanProgress();
  }, 3000);
}

// Update Statistics
function updateStats() {
  fetch(`{{ route('teacher.attendance.get-stats', $schedule->id) }}`)
    .then(res => res.json())
    .then(data => {
      document.getElementById('currentAttendance').textContent = data.present_count;
      document.getElementById('currentAbsence').textContent = data.absent_count;
      document.getElementById('pendingCount').textContent = data.pending_count;
      
      // حساب نسبة الحضور
      const totalMarked = data.present_count + data.absent_count;
      const attendancePercentage = totalMarked > 0 ? Math.round((data.present_count / totalMarked) * 100 * 10) / 10 : 0;
      
      document.getElementById('attendancePercentage').textContent = attendancePercentage + '%';
      document.getElementById('attendanceCount').textContent = data.present_count;
      document.getElementById('attendancePercent').textContent = attendancePercentage + '%';
      document.getElementById('absentCount').textContent = data.absent_count;
      document.getElementById('pendingCount').textContent = data.pending_count;
      
      attendanceCount = data.present_count;
      loadPresentStudents();
    })
    .catch(err => {
      showToast('Error updating statistics', 'error');
    });
}

// Load Present Students
function loadPresentStudents() {
  fetch(`{{ route('teacher.attendance.get-present-students', $schedule->id) }}`)
    .then(res => res.json())
    .then(data => {
      updatePresentStudentsTable(data.students);
    })
    .catch(err => {
      showToast('Error loading student list', 'error');
    });
}

function updateRecentScansList() {
  const list = document.getElementById('recentScansList');
  list.innerHTML = recentScans.map(scan => `
    <div class="list-group-item d-flex justify-content-between align-items-center">
      <span>${scan.name ? scan.name + ' - ' : ''}${scan.id}</span>
      <small class="text-muted">${scan.time}</small>
    </div>
  `).join('');
}

function updatePresentStudentsTable(students) {
  const section = document.getElementById('presentStudentsSection');
  const table = document.getElementById('presentStudentsTable');
  if (students && students.length > 0) {
    section.style.display = '';
    table.innerHTML = students.map(s => `
      <tr>
        <td>${s.name}</td>
        <td>${s.login_id}</td>
        <td>${s.time}</td>
        <td><span class="badge bg-success">Present</span></td>
        <td>
          <button class="btn btn-sm btn-outline-danger" onclick="removeAttendance(${s.id})">
            <i class="fas fa-times"></i> Remove
          </button>
        </td>
      </tr>
    `).join('');
  } else {
    table.innerHTML = '<tr><td colspan="5" class="text-center text-muted">No students present yet</td></tr>';
  }
}

// Remove Attendance
function removeAttendance(studentId) {
  if (confirm('Are you sure you want to remove this student\'s attendance?')) {
    fetch(`{{ route('teacher.attendance.remove') }}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({
        student_id: studentId,
        schedule_id: {{ $schedule->id }}
      })
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === 'success') {
        showToast('Attendance removed successfully', 'success');
        updateStats();
      } else {
        showToast(data.message, 'error');
      }
    })
    .catch(err => {
      showToast('Error removing attendance', 'error');
    });
  }
}

// Filter Students
function filterStudents() {
  const searchTerm = document.getElementById('searchStudent').value.toLowerCase();
  const filterStatus = document.getElementById('filterStatus').value;
  const rows = document.querySelectorAll('#presentStudentsTable tr');
  
  rows.forEach(row => {
    const name = row.cells[0]?.textContent.toLowerCase() || '';
    const id = row.cells[1]?.textContent.toLowerCase() || '';
    const status = row.cells[3]?.textContent.toLowerCase() || '';
    
    const matchesSearch = name.includes(searchTerm) || id.includes(searchTerm);
    const matchesStatus = !filterStatus || status.includes(filterStatus);
    
    row.style.display = matchesSearch && matchesStatus ? '' : 'none';
  });
}

// Export Attendance
function exportAttendance() {
  const exportType = document.getElementById('exportType').value;
  const exportRange = document.getElementById('exportRange').value;
  
  const url = `{{ route('teacher.attendance.export') }}?type=${exportType}&range=${exportRange}&schedule_id={{ $schedule->id }}`;
  window.open(url, '_blank');
  
  const modal = bootstrap.Modal.getInstance(document.getElementById('exportModal'));
  modal.hide();
  showToast('Exporting data...', 'info');
}

// QR Scanner Functions
function startScanner() {
  const config = {
    fps: 10,
    qrbox: { width: 250, height: 250 },
    aspectRatio: 1.0,
    facingMode: currentFacingMode
  };

  html5QrcodeScanner = new Html5Qrcode("qr-reader");
  
  Html5Qrcode.getCameras().then(devices => {
    if (devices && devices.length) {
      let cameraId = devices.find(device => 
        device.label.toLowerCase().includes(currentFacingMode === "environment" ? "back" : "front")
      )?.id || devices[0].id;
      
      html5QrcodeScanner.start(
        cameraId,
        config,
        onScanSuccess,
        onScanFailure
      ).catch(err => {
        showToast('Error starting camera: ' + err, 'error');
      });
    }
  }).catch(err => {
    showToast('Error accessing cameras: ' + err, 'error');
  });
}

function onScanSuccess(decodedText, decodedResult) {
  const now = Date.now();
  if (lastScanId === decodedText && (now - lastScanTime) < 2000) {
    return; // Prevent duplicate scans within 2 seconds
  }
  
  lastScanId = decodedText;
  lastScanTime = now;

  // Play beep sound
  document.getElementById('beepSound')?.play().catch(() => {});

  // إظهار مؤشر التحميل في نافذة الكاميرا
  showScanProgress('Processing scan...', 'info');

  // Send attendance data
  fetch(`{{ route('teacher.attendance.scan') }}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
      qr: decodedText,
      schedule_id: {{ $schedule->id }}
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      // إظهار رسالة نجاح مع تفاصيل الطالب
      showScanSuccess(data.present_students?.[0]?.name || 'Student');
      
      // إضافة إلى قائمة المسح الأخير
      recentScans.unshift({
        id: decodedText,
        name: data.present_students?.[0]?.name || 'Unknown',
        time: new Date().toLocaleTimeString()
      });
      if (recentScans.length > 5) recentScans.pop();
      updateRecentScansList();
      
      // تحديث الإحصائيات
      updateStats();
      document.getElementById('lastScanTime').textContent = new Date().toLocaleTimeString();
      
      // إظهار رسالة نجاح في نافذة الكاميرا لمدة 3 ثواني
      setTimeout(() => {
        hideScanProgress();
      }, 3000);
      
    } else {
      // إظهار رسالة خطأ
      showScanError(data.message || 'Failed to mark attendance');
      
      // إخفاء رسالة الخطأ بعد 3 ثواني
      setTimeout(() => {
        hideScanProgress();
      }, 3000);
    }
  })
  .catch(err => {
    showScanError('Error processing scan');
    setTimeout(() => {
      hideScanProgress();
    }, 3000);
  });
}

function onScanFailure(error) {
  // Ignore scan failures - they're too frequent
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
  // Initial load
  updateStats();
  
  // Control buttons
  document.getElementById('refreshStats').addEventListener('click', updateStats);
  document.getElementById('refreshList').addEventListener('click', loadPresentStudents);
  document.getElementById('exportAttendance').addEventListener('click', () => {
    new bootstrap.Modal(document.getElementById('exportModal')).show();
  });
  document.getElementById('confirmExport').addEventListener('click', exportAttendance);
  
  // Filter and search
  document.getElementById('searchStudent').addEventListener('input', filterStudents);
  document.getElementById('filterStatus').addEventListener('change', filterStudents);
  document.getElementById('clearFilters').addEventListener('click', () => {
    document.getElementById('searchStudent').value = '';
    document.getElementById('filterStatus').value = '';
    filterStudents();
  });
  
  // Scanner controls
  document.getElementById('openScanModal').addEventListener('click', () => {
    const modal = new bootstrap.Modal(document.getElementById('scanModal'));
    modal.show();
    setTimeout(() => startScanner(), 500);
  });
  
  document.getElementById('switchCamera').addEventListener('click', () => {
    currentFacingMode = currentFacingMode === "environment" ? "user" : "environment";
    if (html5QrcodeScanner) {
      html5QrcodeScanner.stop().then(() => {
        startScanner();
      }).catch(err => console.error(err));
    }
  });

  // Stop scanner when modal closes
  document.getElementById('scanModal').addEventListener('hidden.bs.modal', function () {
    if (html5QrcodeScanner) {
      html5QrcodeScanner.stop().catch(err => console.error(err));
    }
  });
});
</script>
@endpush

<style>
.card {
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    border: none;
}

.badge {
    font-size: 0.85rem;
    border-radius: 12px;
    padding: 0.4em 0.8em;
}

.table thead th {
    font-weight: bold;
    color: #344767;
    background: #f8f9fa !important;
    border-bottom: 2px solid #e9ecef;
}

.table td, .table th {
    vertical-align: middle;
    padding: 1rem 0.75rem;
}

/* Stats Cards */
.stats-card {
    position: relative;
    border-radius: 20px;
    padding: 1.5rem;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: none;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
}

.stats-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 48px rgba(0, 0, 0, 0.18);
}

.stats-card-body {
    display: flex;
    align-items: center;
    position: relative;
    z-index: 2;
}

.stats-icon {
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 16px;
    margin-right: 1rem;
    font-size: 1.8rem;
    color: white;
    position: relative;
    overflow: hidden;
}

.stats-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    transform: scale(0);
    transition: transform 0.3s ease;
}

.stats-card:hover .stats-icon::before {
    transform: scale(1);
}

.stats-content {
    flex: 1;
}

.stats-number {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.5rem;
    color: white;
}

.stats-label {
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 0.25rem;
}

.stats-description {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.7);
    font-weight: 500;
}

.stats-card-decoration {
    position: absolute;
    top: -30px;
    right: -30px;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    transition: all 0.4s ease;
}

.stats-card:hover .stats-card-decoration {
    transform: scale(1.2);
    background: rgba(255, 255, 255, 0.15);
}

/* Color Variants */
.stats-card-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.stats-card-primary .stats-icon {
    background: rgba(255, 255, 255, 0.15);
}

.stats-card-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.stats-card-success .stats-icon {
    background: rgba(255, 255, 255, 0.15);
}

.stats-card-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.stats-card-info .stats-icon {
    background: rgba(255, 255, 255, 0.15);
}

.stats-card-danger {
    background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
}

.stats-card-danger .stats-icon {
    background: rgba(255, 255, 255, 0.15);
}

.stats-card-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.stats-card-warning .stats-icon {
    background: rgba(255, 255, 255, 0.15);
}

/* Animation */
@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stats-card {
    animation: slideInUp 0.6s ease-out;
}

.stats-card:nth-child(2) {
    animation-delay: 0.1s;
}

.stats-card:nth-child(3) {
    animation-delay: 0.2s;
}

.stats-card:nth-child(4) {
    animation-delay: 0.3s;
}

.scanner-container {
    min-height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* تحسين مظهر رسائل التأكيد */
#scan-message-overlay {
    backdrop-filter: blur(5px);
    transition: all 0.3s ease;
}

#scan-message-overlay .text-white {
    background: rgba(0, 0, 0, 0.9);
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    animation: messageSlideIn 0.3s ease-out;
}

@keyframes messageSlideIn {
    from {
        opacity: 0;
        transform: scale(0.8);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

/* تحسين مظهر الأيقونات */
#scan-message-icon i {
    animation: iconPulse 1s ease-in-out infinite;
}

@keyframes iconPulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

/* تحسين مظهر النص */
#scan-message-text {
    font-weight: 600;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
}
</style>
@endsection 