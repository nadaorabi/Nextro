<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>مسح كود QR لطالب</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
  <style>
    body, .main-content, .card, .card-body, .table, .qr-stats {
      direction: ltr !important;
      text-align: right !important;
    }
    .table th, .table td {
      text-align: right !important;
    }
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
    .card { border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.08); }
    .card-body { padding: 2rem 2.5rem; }
    .qr-stats { background: #f6f9ff; border-radius: 1rem; box-shadow: 0 2px 8px 0 rgba(80, 120, 200, 0.07); }
    .qr-stats .badge { font-size: 1rem; border-radius: 2rem; padding: 0.4rem 1.2rem; font-weight: 600; }
    .recent-scans-list { margin-top: 1rem; }
    .recent-scan-item { background: #e3eafe; border-radius: 0.7rem; padding: 0.5rem 1rem; margin-bottom: 0.5rem; display: flex; justify-content: space-between; align-items: center; font-size: 1rem; }
    .btn-modern { background: linear-gradient(90deg, #4f5bd5 0%, #5fd2ff 100%); color: #fff !important; border: none; border-radius: 1.5rem; font-size: 1.1rem; font-weight: 600; padding: 0.6rem 1.5rem; transition: box-shadow 0.2s, background 0.2s; box-shadow: 0 2px 8px 0 rgba(80, 120, 200, 0.10); }
    .btn-modern:hover { background: linear-gradient(90deg, #5fd2ff 0%, #4f5bd5 100%); color: #fff !important; box-shadow: 0 4px 16px 0 rgba(80, 120, 200, 0.15); }
    @media (max-width: 600px) {
      .card-body { padding: 1rem 0.5rem; }
      .welcome-animated { font-size: 1.5rem; }
    }
  </style>
</head>
<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container mt-4 text-center">
      <h1 class="welcome-animated mb-4">مسح كود QR لطالب</h1>
    </div>
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12" style="max-width:900px;margin:auto;">
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="row">
                <div class="col-md-7 mb-4 mb-md-0">
                  <div id="qr-reader" style="width:100%;max-width:350px;margin:auto;display:none;"></div>
                  <button id="startScanBtn" class="btn btn-modern w-100 mt-2 mb-3" onclick="startQRScan()"><i class="fas fa-qrcode me-2"></i>بدء المسح بالكاميرا</button>
                  <div id="qr-result" class="mt-3"></div>
                </div>
                <div class="col-md-5">
                  <div class="qr-stats p-3">
                    <h6 class="text-center mb-3">إحصائيات المسح</h6>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <span>عدد الطلاب الممسوحين:</span>
                      <span class="badge bg-primary" id="attendanceCount">0</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                      <span>آخر مسح:</span>
                      <span id="lastScanTime">-</span>
                    </div>
                    <div class="recent-scans-list">
                      <h6 class="mb-2">آخر عمليات المسح</h6>
                      <div id="recentScansList"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
  <script src="https://unpkg.com/html5-qrcode"></script>
  <script>
const students = [
  { code: "STU123", name: "محمد الأحمد", grade: "العاشر", email: "mohammad@example.com", phone: "0999999999" },
  { code: "STU456", name: "سارة يوسف", grade: "الحادي عشر", email: "sara@example.com", phone: "0988888888" },
  { code: "STU789", name: "خالد العلي", grade: "الثاني عشر", email: "khaled@example.com", phone: "0977777777" },
];
let attendanceCount = 0;
const recentScans = [];
let qrScanner = null;
function startQRScan() {
  document.getElementById('qr-reader').style.display = 'block';
  document.getElementById('startScanBtn').disabled = true;
  if (!qrScanner) {
    qrScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250 });
    qrScanner.render(onScanSuccess);
  }
}
function onScanSuccess(decodedText, decodedResult) {
  const student = students.find(s => s.code === decodedText);
  let resultDiv = document.getElementById('qr-result');
  if (student) {
    attendanceCount++;
    document.getElementById('attendanceCount').textContent = attendanceCount;
    const now = new Date();
    document.getElementById('lastScanTime').textContent = now.toLocaleTimeString();
    recentScans.unshift({ id: decodedText, name: student.name, time: now.toLocaleTimeString() });
    if (recentScans.length > 5) recentScans.pop();
    updateRecentScansList();
    resultDiv.innerHTML = `
      <div class="alert alert-success">
        <b>تم العثور على الطالب:</b><br>
        <b>الاسم:</b> ${student.name}<br>
        <b>الصف:</b> ${student.grade}<br>
        <b>البريد الإلكتروني:</b> ${student.email}<br>
        <b>رقم الجوال:</b> ${student.phone}
      </div>
    `;
  } else {
    resultDiv.innerHTML = `<div class="alert alert-danger">الطالب غير موجود!</div>`;
  }
}
function updateRecentScansList() {
  const list = document.getElementById('recentScansList');
  list.innerHTML = recentScans.map(scan => `
    <div class="recent-scan-item">
      <span>${scan.name} (${scan.id})</span>
      <small class="text-muted">${scan.time}</small>
    </div>
  `).join('');
}
  </script>
</body>
</html> 