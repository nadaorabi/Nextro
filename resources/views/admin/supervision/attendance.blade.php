<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>تسجيل الحضور</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
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
    .card { border-radius: 15px; box-shadow: 0 0 20px rgba(0,0,0,0.08); }
    .card-body { padding: 2rem 2.5rem; }
    .filter-bar { background: #f8f9fa; border-radius: 12px; box-shadow: 0 0 12px rgba(0,0,0,0.04); padding: 18px 24px; margin-bottom: 24px; display: flex; flex-wrap: wrap; gap: 16px; align-items: center; justify-content: center; max-width: 900px; margin-left: auto; margin-right: auto; }
    .table th, .table td { vertical-align: middle; text-align: center; }
    .status-present { background: #27ae60; color: #fff; padding: 6px 16px; border-radius: 6px; font-weight: bold; }
    .status-absent { background: #c0392b; color: #fff; padding: 6px 16px; border-radius: 6px; font-weight: bold; }
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
      <h1 class="welcome-animated mb-4">تسجيل الحضور</h1>
    </div>
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12" style="max-width:900px;margin:auto;">
          <div class="card shadow-sm">
            <div class="card-body">
              <form class="filter-bar" onsubmit="event.preventDefault(); filterAttendance();">
                <select class="form-select" id="courseSelect" style="max-width:180px;">
                  <option value="">اختر الدورة</option>
                  <option value="1">دورة الرياضيات</option>
                  <option value="2">دورة اللغة العربية</option>
                </select>
                <select class="form-select" id="materialSelect" style="max-width:180px;">
                  <option value="">اختر المادة</option>
                </select>
                <input type="date" class="form-control" id="dateSelect" style="max-width:170px;">
                <button type="submit" class="btn btn-info"><i class="fas fa-filter"></i> تصفية</button>
              </form>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>اسم الطالب</th>
                      <th>الدورة</th>
                      <th>المادة</th>
                      <th>التاريخ</th>
                      <th>الحالة</th>
                      <th>ملاحظة</th>
                    </tr>
                  </thead>
                  <tbody id="attendanceTableBody">
                    <!-- بيانات الحضور -->
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
  const attendanceData = [
    {id: 1, student: 'محمد الأحمد', courseId: 1, course: 'دورة الرياضيات', material: 'رياضيات 1', date: '2024-06-01', status: 'present', note: ''},
    {id: 2, student: 'سارة يوسف', courseId: 1, course: 'دورة الرياضيات', material: 'رياضيات 2', date: '2024-06-01', status: 'absent', note: 'مريض'},
    {id: 3, student: 'خالد العلي', courseId: 2, course: 'دورة اللغة العربية', material: 'بلاغة', date: '2024-06-01', status: 'present', note: ''},
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
    const tbody = document.getElementById('attendanceTableBody');
    tbody.innerHTML = data.map((item, idx) => `
      <tr>
        <td>${idx + 1}</td>
        <td>${item.student}</td>
        <td>${item.course}</td>
        <td>${item.material}</td>
        <td>${item.date}</td>
        <td>
          <span class="${item.status === 'present' ? 'status-present' : 'status-absent'}">
            ${item.status === 'present' ? 'حاضر' : 'غائب'}
          </span>
        </td>
        <td>${item.note || '-'}</td>
      </tr>
    `).join('');
  }

  function filterAttendance() {
    const courseId = document.getElementById('courseSelect').value;
    const material = document.getElementById('materialSelect').value;
    const date = document.getElementById('dateSelect').value;
    let filtered = attendanceData;
    if (courseId) filtered = filtered.filter(a => a.courseId == courseId);
    if (material) filtered = filtered.filter(a => a.material === material);
    if (date) filtered = filtered.filter(a => a.date === date);
    renderTable(filtered);
  }

  window.onload = function() {
    updateMaterials();
    renderTable(attendanceData);
    document.getElementById('courseSelect').addEventListener('change', updateMaterials);
  }
  </script>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>
</html> 