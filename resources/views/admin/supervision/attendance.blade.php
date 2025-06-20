<!DOCTYPE html>
<html lang="ar" dir="LTR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>
        تسجيل الحضور
    </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
  <style>
        .custom-icon-style {
            display: inline-block;
            transform: translateY(-4px);
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
    .table th, .table td {
      vertical-align: middle;
      text-align: center;
    }
    .btn-info {
      background: #007bff;
      color: #fff;
      border: none;
    }
    .btn-info:hover {
      background: #0056b3;
      color: #fff;
    }
    .btn-danger {
      background: #dc3545;
      color: #fff;
      border: none;
    }
    .btn-danger:hover {
      background: #a71d2a;
      color: #fff;
    }
    .btn-secondary {
      background: #6c757d;
      color: #fff;
      border: none;
    }
    .btn-secondary:hover {
      background: #495057;
      color: #fff;
    }
    .badge-primary {
      background-color: #3498db;
    }
    .badge-success {
      background-color: #2ecc71;
    }
    .status-present {
      color: #27ae60;
      background-color: #daf6e6;
      padding: 6px 12px;
      border-radius: 6px;
      font-weight: bold;
    }
    .status-absent {
      color: #c0392b;
      background-color: #fad7d3;
      padding: 6px 12px;
      border-radius: 6px;
      font-weight: bold;
    }
    .filter-bar {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      align-items: center;
      margin-bottom: 20px;
      justify-content: flex-end;
    }
    .filter-bar select, .filter-bar input[type="text"] {
      min-width: 140px;
      max-width: 200px;
      border-radius: 8px;
      border: 1px solid #ddd;
      padding: 6px 12px;
    }
    @media (max-width: 600px) {
      .filter-bar { flex-direction: column; gap: 10px; align-items: stretch; }
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    
  @include('admin.parts.sidebar-admin')

    <main class="main-content position-relative border-radius-lg overflow-hidden">
        
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <!-- Welcome Card -->
                    <div class="card mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1 class="text-gradient text-primary welcome-animated">تسجيل الحضور 📊</h1>
                                    <p class="mb-0">إدارة وتسجيل حضور الطلاب في الدورات المختلفة</p>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <button class="btn btn-primary mb-0" onclick="addNewAttendance()">
                                        <i class="fas fa-plus"></i>&nbsp;&nbsp;إضافة تسجيل حضور جديد
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">إجمالي الطلاب</p>
                                                <h5 class="font-weight-bolder">156</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">+8</span>
                                                    هذا الشهر
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                <i class="ni ni-single-02 text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">الحضور اليوم</p>
                                                <h5 class="font-weight-bolder">142</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">91%</span>
                                                    نسبة الحضور
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                <i class="ni ni-check-bold text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">الغياب</p>
                                                <h5 class="font-weight-bolder">14</h5>
                                                <p class="mb-0">
                                                    <span class="text-danger text-sm font-weight-bolder">9%</span>
                                                    نسبة الغياب
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                <i class="ni ni-fat-remove text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">الدورات النشطة</p>
                                                <h5 class="font-weight-bolder">12</h5>
                                                <p class="mb-0">
                                                    <span class="text-info text-sm font-weight-bolder">+2</span>
                                                    هذا الأسبوع
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                                <i class="ni ni-books text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>

                    <!-- Filters -->
                    <div class="card mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">الدورة</label>
                                        <select id="courseSelect" class="form-select">
                                            <option value="">جميع الدورات</option>
                  <option value="1">دورة الرياضيات</option>
                  <option value="2">دورة اللغة العربية</option>
                                            <option value="3">دورة الفيزياء</option>
                                            <option value="4">دورة الكيمياء</option>
                </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">المادة</label>
                                        <select id="materialSelect" class="form-select">
                                            <option value="">جميع المواد</option>
                </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">التاريخ</label>
                                        <input type="date" id="dateSelect" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">البحث</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input id="search-input" type="text" class="form-control" placeholder="البحث بالاسم...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Table -->
                    <div class="card">
                        <div class="card-header pb-0">
                           
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="attendance-table" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الطالب</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الدورة</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">المادة</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">التاريخ</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الحالة</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ملاحظة</th>
                                            <th class="text-secondary opacity-7">الإجراءات</th>
                    </tr>
                  </thead>
                  <tbody id="attendanceTableBody">
                                        <!-- سيتم ملء البيانات بواسطة JavaScript -->
                  </tbody>
                </table>
              </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center p-3">
                                <p class="text-sm mb-0">عرض 1-10 من 156 تسجيل حضور</p>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript:;" tabindex="-1">
                                                <i class="fa fa-angle-left"></i>
                                                <span class="sr-only">السابق</span>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="javascript:;">1</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:;">2</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:;">...</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:;">16</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:;">
                                                <i class="fa fa-angle-right"></i>
                                                <span class="sr-only">التالي</span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

    <!-- Modal Edit Attendance -->
    <div class="modal fade" id="editAttendanceModal" tabindex="-1" aria-labelledby="editAttendanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAttendanceModalLabel">تعديل تسجيل الحضور</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">اسم الطالب</label>
                            <input type="text" class="form-control" value="محمد الأحمد" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الدورة</label>
                            <select class="form-select" required>
                                <option selected>دورة الرياضيات</option>
                                <option>دورة اللغة العربية</option>
                                <option>دورة الفيزياء</option>
                                <option>دورة الكيمياء</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">المادة</label>
                            <select class="form-select" required>
                                <option selected>رياضيات 1</option>
                                <option>رياضيات 2</option>
                                <option>نحو</option>
                                <option>بلاغة</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">التاريخ</label>
                            <input type="date" class="form-control" value="2024-06-01" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الحالة</label>
                            <select class="form-select" required>
                                <option selected>حاضر</option>
                                <option>غائب</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ملاحظة</label>
                            <textarea class="form-control" rows="3" placeholder="أضف ملاحظة إذا لزم الأمر"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary">حفظ التغييرات</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Confirmation -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">هل أنت متأكد من حذف تسجيل الحضور هذا؟</p>
                    <p class="text-danger mb-0">لا يمكن التراجع عن هذا الإجراء.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-danger">تأكيد الحذف</button>
                </div>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
  <script>
  // بيانات تجريبية
  const courses = [
    {id: 1, name: 'دورة الرياضيات', materials: ['رياضيات 1', 'رياضيات 2']},
            {id: 2, name: 'دورة اللغة العربية', materials: ['نحو', 'بلاغة']},
            {id: 3, name: 'دورة الفيزياء', materials: ['فيزياء 1', 'فيزياء 2']},
            {id: 4, name: 'دورة الكيمياء', materials: ['كيمياء 1', 'كيمياء 2']}
  ];
        
  const attendanceData = [
    {id: 1, student: 'محمد الأحمد', courseId: 1, course: 'دورة الرياضيات', material: 'رياضيات 1', date: '2024-06-01', status: 'present', note: ''},
    {id: 2, student: 'سارة يوسف', courseId: 1, course: 'دورة الرياضيات', material: 'رياضيات 2', date: '2024-06-01', status: 'absent', note: 'مريض'},
    {id: 3, student: 'خالد العلي', courseId: 2, course: 'دورة اللغة العربية', material: 'بلاغة', date: '2024-06-01', status: 'present', note: ''},
            {id: 4, student: 'فاطمة محمد', courseId: 2, course: 'دورة اللغة العربية', material: 'نحو', date: '2024-06-01', status: 'present', note: ''},
            {id: 5, student: 'أحمد حسن', courseId: 3, course: 'دورة الفيزياء', material: 'فيزياء 1', date: '2024-06-01', status: 'absent', note: 'سفر'},
            {id: 6, student: 'نور الدين', courseId: 3, course: 'دورة الفيزياء', material: 'فيزياء 2', date: '2024-06-01', status: 'present', note: ''},
            {id: 7, student: 'ليلى أحمد', courseId: 4, course: 'دورة الكيمياء', material: 'كيمياء 1', date: '2024-06-01', status: 'present', note: ''},
            {id: 8, student: 'عمر خالد', courseId: 4, course: 'دورة الكيمياء', material: 'كيمياء 2', date: '2024-06-01', status: 'absent', note: 'موعد طبي'},
  ];

  function updateMaterials() {
    const courseId = document.getElementById('courseSelect').value;
    const materialSelect = document.getElementById('materialSelect');
            materialSelect.innerHTML = '<option value="">جميع المواد</option>';
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
                    <td>
                        <div class="d-flex px-2 py-1">
                            <div>
                                <img src="{{ asset('images/team-1.jpg') }}" class="avatar avatar-sm me-3" alt="student">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">${item.student}</h6>
                                <p class="text-xs text-secondary mb-0">طالب</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">${item.course}</p>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">${item.material}</p>
                    </td>
                    <td>
                        <p class="text-xs font-weight-bold mb-0">${item.date}</p>
                    </td>
        <td>
          <span class="${item.status === 'present' ? 'status-present' : 'status-absent'}">
            ${item.status === 'present' ? 'حاضر' : 'غائب'}
          </span>
        </td>
                    <td>
                        <p class="text-xs text-secondary mb-0">${item.note || '-'}</p>
                    </td>
                    <td class="align-middle">
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-link text-info p-2" data-bs-toggle="modal" data-bs-target="#editAttendanceModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-link text-primary p-2">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-link text-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
      </tr>
    `).join('');
  }

  function filterAttendance() {
    const courseId = document.getElementById('courseSelect').value;
    const material = document.getElementById('materialSelect').value;
    const date = document.getElementById('dateSelect').value;
            const searchText = document.getElementById('search-input').value.toLowerCase();
            
    let filtered = attendanceData;
            
    if (courseId) filtered = filtered.filter(a => a.courseId == courseId);
    if (material) filtered = filtered.filter(a => a.material === material);
    if (date) filtered = filtered.filter(a => a.date === date);
            if (searchText) filtered = filtered.filter(a => a.student.toLowerCase().includes(searchText));
            
    renderTable(filtered);
  }

        function addNewAttendance() {
            // يمكن إضافة منطق إضافة تسجيل حضور جديد هنا
            alert('سيتم إضافة تسجيل حضور جديد');
        }

        document.addEventListener('DOMContentLoaded', function() {
    updateMaterials();
    renderTable(attendanceData);
            
    document.getElementById('courseSelect').addEventListener('change', updateMaterials);
            document.getElementById('courseSelect').addEventListener('change', filterAttendance);
            document.getElementById('materialSelect').addEventListener('change', filterAttendance);
            document.getElementById('dateSelect').addEventListener('change', filterAttendance);
            document.getElementById('search-input').addEventListener('keyup', filterAttendance);
        });
  </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html> 