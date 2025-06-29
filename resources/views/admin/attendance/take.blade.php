@extends('layouts.admin')
@section('content')
<div class="container-fluid py-4">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
      <div class="modern-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <div class="modern-title">
            <i class="fas fa-camera"></i> أخذ الحضور بالكاميرا
          </div>
          <div>
            <a href="{{ route('admin.attendance.qr-codes', $schedule->id) }}" class="btn btn-outline-primary me-2">
              <i class="fas fa-qrcode me-1"></i> QR Codes
            </a>
            <a href="{{ route('admin.attendance.schedule-details', $schedule->id) }}" class="btn btn-outline-secondary">
              <i class="fas fa-list me-1"></i> التفاصيل
            </a>
          </div>
        </div>
        
        <!-- إحصائيات سريعة -->
        <div class="row mb-4">
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card bg-gradient-primary text-white">
              <div class="stat-icon">👥</div>
              <div class="stat-number" id="totalStudents">{{ $studentCount }}</div>
              <div class="stat-label">إجمالي الطلاب</div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card bg-gradient-success text-white">
              <div class="stat-icon">✅</div>
              <div class="stat-number" id="currentAttendance">{{ $currentAttendanceCount }}</div>
              <div class="stat-label">الحضور الحالي</div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card bg-gradient-danger text-white">
              <div class="stat-icon">❌</div>
              <div class="stat-number" id="currentAbsence">{{ $studentCount - $currentAttendanceCount }}</div>
              <div class="stat-label">الغياب الحالي</div>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 mb-3">
            <div class="stat-card bg-gradient-info text-white">
              <div class="stat-icon">📊</div>
              <div class="stat-number" id="attendancePercentage">{{ round(($currentAttendanceCount / $studentCount) * 100, 1) }}%</div>
              <div class="stat-label">نسبة الحضور</div>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <div><strong>المادة:</strong> {{ $schedule->course->title }}</div>
          <div><strong>اليوم:</strong> {{ __(ucfirst($schedule->day_of_week)) }}</div>
          <div><strong>الوقت:</strong> {{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</div>
          <div><strong>القاعة:</strong> {{ $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name) : 'غير محدد' }}</div>
        </div>
        
        <div class="text-center mt-4">
          <button class="btn btn-modern btn-lg" id="openScanModal">
            <i class="fas fa-camera me-2"></i> بدء المسح
          </button>
          <button class="btn btn-outline-info ms-2" id="refreshStats">
            <i class="fas fa-sync-alt me-1"></i> تحديث الإحصائيات
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- قائمة الطلاب الحاضرين -->
<div class="mt-5" id="presentStudentsSection">
  <div class="modern-card">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="mb-0">الطلاب الحاضرون اليوم</h5>
      <div>
        <button class="btn btn-sm btn-outline-success" id="exportAttendance">
          <i class="fas fa-download me-1"></i> تصدير
        </button>
        <button class="btn btn-sm btn-outline-primary" id="refreshList">
          <i class="fas fa-sync-alt me-1"></i> تحديث
        </button>
      </div>
    </div>
    
    <!-- فلترة وبحث -->
    <div class="row mb-3">
      <div class="col-md-6">
        <input type="text" class="form-control" id="searchStudent" placeholder="البحث في الطلاب...">
      </div>
      <div class="col-md-3">
        <select class="form-select" id="filterStatus">
          <option value="">جميع الحالات</option>
          <option value="present">حاضر</option>
          <option value="absent">غائب</option>
        </select>
      </div>
      <div class="col-md-3">
        <button class="btn btn-outline-secondary w-100" id="clearFilters">
          <i class="fas fa-times me-1"></i> مسح الفلاتر
        </button>
      </div>
    </div>
    
    <div class="table-responsive">
      <table class="table table-bordered table-hover text-center align-middle">
        <thead class="table-light">
          <tr>
            <th>الاسم</th>
            <th>الرقم الأكاديمي</th>
            <th>وقت الحضور</th>
            <th>الحالة</th>
            <th>الإجراءات</th>
          </tr>
        </thead>
        <tbody id="presentStudentsTable"></tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal for QR Code Scanner -->
<div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
      <div class="modal-header bg-gradient-primary text-white">
        <h5 class="modal-title" id="scanModalLabel">
          <i class="fas fa-qrcode me-2"></i>
          أخذ الحضور - {{ $schedule->course->title }}
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="row">
          <div class="col-md-8">
            <div class="scanner-container position-relative" style="border-radius: 10px; overflow: hidden; background:#000;">
              <div id="qr-reader" style="width: 100%"></div>
              <div class="scanner-overlay">
                <div class="scanner-line"></div>
              </div>
            </div>
            <!-- تحكم الكاميرا -->
            <div class="camera-controls mt-3 text-center">
              <button class="btn btn-sm btn-outline-primary me-2" id="switchCamera">
                <i class="fas fa-sync-alt me-1"></i> تبديل الكاميرا
              </button>
              <button class="btn btn-sm btn-outline-secondary" id="toggleFlash">
                <i class="fas fa-lightbulb me-1"></i> الفلاش
              </button>
            </div>
          </div>
          <div class="col-md-4">
            <div class="attendance-stats p-3 bg-light rounded">
              <h6 class="text-center mb-3">إحصائيات الحضور</h6>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span>عدد الطلاب المسجلين:</span>
                <span class="badge bg-info" id="totalStudentCount">{{ $studentCount }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span>عدد الحضور الحالي:</span>
                <span class="badge bg-primary" id="attendanceCount">{{ $currentAttendanceCount }}</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span>نسبة الحضور:</span>
                <span class="badge bg-success" id="attendancePercent">{{ round(($currentAttendanceCount / $studentCount) * 100, 1) }}%</span>
              </div>
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span>آخر مسح:</span>
                <span id="lastScanTime">-</span>
              </div>
              <div class="recent-scans mt-4">
                <h6 class="mb-2">آخر عمليات المسح</h6>
                <div id="recentScansList" class="list-group"></div>
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

<!-- Modal for Export -->
<div class="modal fade" id="exportModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">تصدير بيانات الحضور</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">نوع التصدير:</label>
          <select class="form-select" id="exportType">
            <option value="excel">Excel (.xlsx)</option>
            <option value="pdf">PDF</option>
            <option value="csv">CSV</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">نطاق البيانات:</label>
          <select class="form-select" id="exportRange">
            <option value="current">المحاضرة الحالية فقط</option>
            <option value="all">جميع محاضرات المادة</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-primary" id="confirmExport">تصدير</button>
      </div>
    </div>
  </div>
</div>

<audio id="beepSound" src="/sounds/beep.mp3"></audio>

@push('scripts')
<script src="https://unpkg.com/html5-qrcode"></script>
<script>
let attendanceCount = {{ $currentAttendanceCount }};
const recentScans = [];
let html5QrcodeScanner = null;
let currentFacingMode = "environment";
let flashEnabled = false;
let lastScanId = null;
let lastScanTime = 0;

// دالة إظهار Toast
function showToast(message, type = 'info') {
  let toast = document.createElement('div');
  toast.className = `smart-toast show ${type}`;
  toast.innerHTML = `<span class="toast-icon">${
    type === 'success' ? '✅' : type === 'error' ? '❌' : 'ℹ️'
  }</span> ${message}`;
  document.body.appendChild(toast);
  setTimeout(() => { toast.classList.remove('show'); }, 2500);
  setTimeout(() => { toast.remove(); }, 3000);
}

// تحديث الإحصائيات
function updateStats() {
  fetch(`{{ route('admin.attendance.get-stats', $schedule->id) }}`)
    .then(res => res.json())
    .then(data => {
      document.getElementById('currentAttendance').textContent = data.present_count;
      document.getElementById('currentAbsence').textContent = data.total_students - data.present_count;
      document.getElementById('attendancePercentage').textContent = data.percentage + '%';
      document.getElementById('attendanceCount').textContent = data.present_count;
      document.getElementById('attendancePercent').textContent = data.percentage + '%';
      attendanceCount = data.present_count;
      loadPresentStudents();
    })
    .catch(err => {
      showToast('خطأ في تحديث الإحصائيات', 'error');
    });
}

// تحميل قائمة الطلاب الحاضرين
function loadPresentStudents() {
  fetch(`{{ route('admin.attendance.get-present-students', $schedule->id) }}`)
    .then(res => res.json())
    .then(data => {
      updatePresentStudentsTable(data.students);
    })
    .catch(err => {
      showToast('خطأ في تحميل قائمة الطلاب', 'error');
    });
}

function updateRecentScansList() {
  const list = document.getElementById('recentScansList');
  list.innerHTML = recentScans.map(scan => `
    <div class="list-group-item recent-scan-item d-flex justify-content-between align-items-center">
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
        <td><span class="badge bg-success">حاضر</span></td>
        <td>
          <button class="btn btn-sm btn-outline-danger" onclick="removeAttendance(${s.id})">
            <i class="fas fa-times"></i>
          </button>
        </td>
      </tr>
    `).join('');
  } else {
    section.style.display = 'none';
    table.innerHTML = '';
  }
}

// حذف حضور طالب
function removeAttendance(studentId) {
  if (confirm('هل أنت متأكد من حذف حضور هذا الطالب؟')) {
    fetch(`{{ route('admin.attendance.remove') }}`, {
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
        showToast('تم حذف الحضور بنجاح', 'success');
        updateStats();
      } else {
        showToast(data.message, 'error');
      }
    })
    .catch(err => {
      showToast('خطأ في حذف الحضور', 'error');
    });
  }
}

// فلترة وبحث
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

// تصدير البيانات
function exportAttendance() {
  const exportType = document.getElementById('exportType').value;
  const exportRange = document.getElementById('exportRange').value;
  
  const url = `{{ route('admin.attendance.export') }}?type=${exportType}&range=${exportRange}&schedule_id={{ $schedule->id }}`;
  window.open(url, '_blank');
  
  const modal = bootstrap.Modal.getInstance(document.getElementById('exportModal'));
  modal.hide();
  showToast('جاري تصدير البيانات...', 'info');
}

// Event Listeners
document.addEventListener('DOMContentLoaded', function() {
  // تحديث الإحصائيات عند التحميل
  updateStats();
  
  // أزرار التحكم
  document.getElementById('refreshStats').addEventListener('click', updateStats);
  document.getElementById('refreshList').addEventListener('click', loadPresentStudents);
  document.getElementById('exportAttendance').addEventListener('click', () => {
    new bootstrap.Modal(document.getElementById('exportModal')).show();
  });
  document.getElementById('confirmExport').addEventListener('click', exportAttendance);
  
  // فلترة وبحث
  document.getElementById('searchStudent').addEventListener('input', filterStudents);
  document.getElementById('filterStatus').addEventListener('change', filterStudents);
  document.getElementById('clearFilters').addEventListener('click', () => {
    document.getElementById('searchStudent').value = '';
    document.getElementById('filterStatus').value = '';
    filterStudents();
  });
  
  // تبديل الكاميرا
  document.getElementById('switchCamera').addEventListener('click', () => {
    currentFacingMode = currentFacingMode === "environment" ? "user" : "environment";
    if (html5QrcodeScanner) {
      html5QrcodeScanner.stop().then(() => {
        startScanner();
      });
    }
  });
  
  // تبديل الفلاش
  document.getElementById('toggleFlash').addEventListener('click', () => {
    flashEnabled = !flashEnabled;
    const btn = document.getElementById('toggleFlash');
    btn.innerHTML = `<i class="fas fa-lightbulb me-1"></i> ${flashEnabled ? 'إيقاف' : 'تشغيل'} الفلاش`;
    // هنا يمكن إضافة كود للتحكم في فلاش الكاميرا
  });
});

function startScanner() {
  html5QrcodeScanner.start(
    { 
      facingMode: currentFacingMode,
      ...(flashEnabled && { torch: true })
    },
    { fps: 10, qrbox: 250, aspectRatio: 1.0 },
    qrCodeMessage => {
      fetch("{{ route('admin.attendance.scan') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
          qr: qrCodeMessage,
          schedule_id: {{ $schedule->id }}
        })
      })
      .then(res => res.json())
      .then(data => {
        const scannerContainer = document.querySelector('.scanner-container');
        scannerContainer.classList.add('scan-success');
        setTimeout(() => { scannerContainer.classList.remove('scan-success'); }, 500);
        
        const now = new Date();
        const nowTime = now.getTime();
        document.getElementById('lastScanTime').textContent = now.toLocaleTimeString();
        if (data.status === 'success') {
          if (lastScanId !== qrCodeMessage || nowTime - lastScanTime > 5000) {
            recentScans.unshift({ id: qrCodeMessage, name: data.student_name || '', time: now.toLocaleTimeString() });
            if (recentScans.length > 5) recentScans.pop();
            updateRecentScansList();
            lastScanId = qrCodeMessage;
            lastScanTime = nowTime;
          }
          showToast(data.message, 'success');
          updateStats(); // تحديث الإحصائيات بعد كل مسح ناجح
          const beepSound = document.getElementById('beepSound');
          beepSound.currentTime = 0;
          beepSound.play();
        } else {
          if (lastScanId !== (data.login_id || qrCodeMessage) || nowTime - lastScanTime > 5000) {
            recentScans.unshift({ id: data.login_id || qrCodeMessage, name: data.student_name || '', time: now.toLocaleTimeString() });
            if (recentScans.length > 5) recentScans.pop();
            updateRecentScansList();
            lastScanId = data.login_id || qrCodeMessage;
            lastScanTime = nowTime;
          }
          showToast(data.message, 'error');
        }
      })
      .catch(() => {
        showToast('حدث خطأ أثناء معالجة الرمز الشريطي', 'error');
      });
    },
    errorMessage => {
      // تجاهل أخطاء عدم وجود كود
    }
  );
}

document.getElementById('openScanModal').onclick = function() {
  var modal = new bootstrap.Modal(document.getElementById('scanModal'));
  modal.show();
  if (!html5QrcodeScanner) {
    html5QrcodeScanner = new Html5Qrcode("qr-reader");
  }
  startScanner();
};
</script>
@endpush

<style>
/* Modern Card Styles */
.stat-card {
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
    transform: translateX(-100%);
    transition: transform 0.6s;
}

.stat-card:hover::before {
    transform: translateX(100%);
}

.stat-icon {
    font-size: 2rem;
    margin-bottom: 1rem;
    opacity: 0.8;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    transition: transform 0.2s ease;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.9;
    margin: 0;
}

/* Schedule Info Card */
.schedule-info-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.schedule-header {
    background: rgba(255, 255, 255, 0.1);
    padding: 1rem 1.5rem;
    color: white;
    font-weight: bold;
}

.schedule-content {
    padding: 1.5rem;
    color: white;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.info-label {
    font-size: 0.8rem;
    opacity: 0.8;
}

.info-value {
    font-weight: bold;
    font-size: 1rem;
}

/* Camera Section */
.camera-section {
    margin-top: 2rem;
}

.camera-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.camera-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1rem 1.5rem;
}

.camera-body {
    padding: 2rem;
}

.camera-controls {
    text-align: center;
}

.camera-btn {
    border-radius: 50px;
    padding: 0.75rem 2rem;
    font-weight: bold;
    transition: all 0.3s ease;
}

.camera-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* Scanner Styles */
.camera-container {
    display: flex;
    justify-content: center;
    margin: 2rem 0;
}

.scanner-frame {
    position: relative;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.qr-scanner {
    width: 100%;
    max-width: 400px;
    height: 400px;
}

.scanner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
}

.scanner-corner {
    position: absolute;
    width: 30px;
    height: 30px;
    border: 3px solid #667eea;
}

.top-left {
    top: 20px;
    left: 20px;
    border-right: none;
    border-bottom: none;
}

.top-right {
    top: 20px;
    right: 20px;
    border-left: none;
    border-bottom: none;
}

.bottom-left {
    bottom: 20px;
    left: 20px;
    border-right: none;
    border-top: none;
}

.bottom-right {
    bottom: 20px;
    right: 20px;
    border-left: none;
    border-top: none;
}

.scanner-line {
    position: absolute;
    top: 50%;
    left: 20px;
    right: 20px;
    height: 2px;
    background: linear-gradient(90deg, transparent, #667eea, transparent);
    animation: scan 2s linear infinite;
}

@keyframes scan {
    0% { transform: translateY(-100px); }
    50% { transform: translateY(100px); }
    100% { transform: translateY(-100px); }
}

/* Scan Result */
.scan-result {
    margin-top: 1rem;
}

.scan-alert {
    border-radius: 10px;
    border: none;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Loading Overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-spinner {
    text-align: center;
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stat-card {
        padding: 1rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .camera-body {
        padding: 1rem;
    }
    
    .qr-scanner {
        height: 300px;
    }
    
    .scanner-corner {
        width: 20px;
        height: 20px;
        border-width: 2px;
    }
    
    .top-left, .top-right, .bottom-left, .bottom-right {
        top: 10px;
        left: 10px;
        right: 10px;
        bottom: 10px;
    }
}

@media (max-width: 576px) {
    .stat-card {
        margin-bottom: 1rem;
    }
    
    .camera-btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
    
    .qr-scanner {
        height: 250px;
    }
}

/* Gradient Backgrounds */
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #56ab2f 0%, #a8e6cf 100%);
}

.bg-gradient-danger {
    background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.smart-toast {
    position: fixed;
    bottom: 32px;
    left: 50%;
    transform: translateX(-50%);
    min-width: 260px;
    max-width: 90vw;
    z-index: 99999;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.13);
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.08rem;
    font-weight: 500;
    border-right: 6px solid #5f5aad;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s, bottom 0.3s;
}
.smart-toast.show {
    opacity: 1;
    pointer-events: auto;
    bottom: 48px;
}
.smart-toast.success { border-right-color: #28a745; }
.smart-toast.error { border-right-color: #dc3545; }
.smart-toast.info { border-right-color: #5f5aad; }
.smart-toast .toast-icon { font-size: 1.3em; }
</style>
@endsection 