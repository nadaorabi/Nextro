<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>استعراض الشكاوى</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
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
    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0,0,0,0.08);
      margin-bottom: 30px;
    }
    .card-body {
      padding: 2rem 2.5rem;
    }
    .filter-bar {
      background: #f8f9fa;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0,0,0,0.04);
      padding: 18px 24px;
      margin-bottom: 24px;
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      align-items: center;
      justify-content: center;
      max-width: 900px;
      margin-left: auto;
      margin-right: auto;
    }
    .table th, .table td {
      vertical-align: middle;
      text-align: center;
    }
    .badge-open {
      background: #f1c40f;
      color: #fff;
      padding: 6px 16px;
      border-radius: 6px;
      font-weight: bold;
    }
    .badge-closed {
      background: #27ae60;
      color: #fff;
      padding: 6px 16px;
      border-radius: 6px;
      font-weight: bold;
    }
    .badge-pending {
      background: #3498db;
      color: #fff;
      padding: 6px 16px;
      border-radius: 6px;
      font-weight: bold;
    }
    @media (max-width: 600px) {
      .card-body { padding: 1rem 0.5rem; }
      .filter-bar { flex-direction: column; gap: 10px; padding: 10px 5px; }
      .welcome-animated { font-size: 1.5rem; }
    }
  </style>
</head>
<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container mt-4 text-center">
      <h1 class="welcome-animated mb-4">استعراض الشكاوى</h1>
    </div>
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12" style="max-width:900px;margin:auto;">
          <div class="card shadow-sm">
            <div class="card-body">
              <!-- شريط الفلاتر -->
              <form class="filter-bar" onsubmit="event.preventDefault(); filterComplaints();">
                <select class="form-select" id="courseSelect" onchange="updateMaterials()" style="max-width:180px;">
                  <option value="">اختر الدورة</option>
                  <option value="1">دورة الرياضيات</option>
                  <option value="2">دورة اللغة العربية</option>
                </select>
                <select class="form-select" id="materialSelect" style="max-width:180px;">
                  <option value="">اختر المادة</option>
                </select>
                <select class="form-select" id="statusSelect" style="max-width:170px;">
                  <option value="">كل الحالات</option>
                  <option value="open">مفتوحة</option>
                  <option value="pending">قيد المراجعة</option>
                  <option value="closed">مغلقة</option>
                </select>
                <button type="submit" class="btn btn-info"><i class="fas fa-filter"></i> تصفية</button>
              </form>
              <!-- جدول الشكاوى -->
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>اسم الطالب</th>
                      <th>الدورة</th>
                      <th>المادة</th>
                      <th>تاريخ الشكوى</th>
                      <th>الحالة</th>
                      <th>نص الشكوى</th>
                    </tr>
                  </thead>
                  <tbody id="complaintsTableBody">
                    <!-- بيانات تجريبية -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script>
    // بيانات تجريبية
    const courses = [
      {id: 1, name: 'دورة الرياضيات', materials: ['رياضيات 1', 'رياضيات 2']},
      {id: 2, name: 'دورة اللغة العربية', materials: ['نحو', 'بلاغة']}
    ];
    const complaintsData = [
      {id: 1, student: 'محمد الأحمد', course: 'دورة الرياضيات', material: 'رياضيات 1', date: '2024-06-01', status: 'open', text: 'المدرس يتأخر عن الحصة.'},
      {id: 2, student: 'سارة يوسف', course: 'دورة الرياضيات', material: 'رياضيات 2', date: '2024-06-02', status: 'pending', text: 'المادة صعبة جداً.'},
      {id: 3, student: 'خالد العلي', course: 'دورة اللغة العربية', material: 'بلاغة', date: '2024-06-03', status: 'closed', text: 'تم حل المشكلة.'},
    ];
    function updateMaterials() {
      const courseId = document.getElementById('courseSelect').value;
      const materialSelect = document.getElementById('materialSelect');
      materialSelect.innerHTML = '<option value="">اختر المادة</option>';
      if (!courseId) return;
      const course = courses.find(c => c.id == courseId);
      if (course) {
        course.materials.forEach(mat => {
          const opt = document.createElement('option');
          opt.value = mat;
          opt.textContent = mat;
          materialSelect.appendChild(opt);
        });
      }
    }
    function renderTable(data) {
      const tbody = document.getElementById('complaintsTableBody');
      tbody.innerHTML = data.map((item, idx) => `
        <tr>
          <td>${idx + 1}</td>
          <td>${item.student}</td>
          <td>${item.course}</td>
          <td>${item.material}</td>
          <td>${item.date}</td>
          <td>
            <span class="badge badge-${item.status}">
              ${item.status === 'open' ? 'مفتوحة' : item.status === 'pending' ? 'قيد المراجعة' : 'مغلقة'}
            </span>
          </td>
          <td>${item.text}</td>
        </tr>
      `).join('');
    }
    function filterComplaints() {
      const course = document.getElementById('courseSelect').selectedOptions[0]?.textContent || '';
      const material = document.getElementById('materialSelect').value;
      const status = document.getElementById('statusSelect').value;
      let filtered = complaintsData;
      if (course && course !== 'اختر الدورة') filtered = filtered.filter(a => a.course === course);
      if (material) filtered = filtered.filter(a => a.material === material);
      if (status) filtered = filtered.filter(a => a.status === status);
      renderTable(filtered);
    }
    // أول تحميل
    window.onload = function() {
      updateMaterials();
      renderTable(complaintsData);
    }
  </script>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>
</html> 