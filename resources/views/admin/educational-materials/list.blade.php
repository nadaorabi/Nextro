<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>قائمة المواد التعليمية</title>
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
    .status-active {
      color: #27ae60;
      background-color: #daf6e6;
      padding: 6px 12px;
      border-radius: 6px;
    }
    .status-inactive {
      color: #c0392b;
      background-color: #fad7d3;
      padding: 6px 12px;
      border-radius: 6px;
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
  @include('admin.parts.sidebar-admin')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container mt-4 text-center">
      <h1 class="welcome-animated mb-4">قائمة المواد التعليمية</h1>
    </div>
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12" style="max-width:900px;margin:auto;">
          <div class="card shadow-sm">
            <div class="card-body">
              <h4 class="mb-4 fw-bold text-primary text-center">
                <i class="fas fa-list me-2"></i>
                قائمة المواد التعليمية
              </h4>
              <div class="filter-bar">
                <input type="text" id="searchBox" placeholder="بحث باسم المادة...">
                <select id="typeFilter">
                  <option value="all">كل الأنواع</option>
                  <option value="تاسع">تاسع</option>
                  <option value="بكلوريا">بكلوريا</option>
                </select>
                <button class="btn btn-primary" onclick="addMaterial()">
                  <i class="fas fa-plus ms-2"></i>
                  إضافة مادة جديدة
                </button>
              </div>
              <div class="table-responsive">
                <table class="table align-middle mb-0">
                  <thead class="bg-light">
                    <tr>
                      <th>#</th>
                      <th>اسم المادة</th>
                      <th>الوصف</th>
                      <th>النوع</th>
                      <th>الأستاذ</th>
                      <th>الحالة</th>
                      <th>تاريخ الإنشاء</th>
                      <th>الإجراءات</th>
                    </tr>
                  </thead>
                  <tbody id="materialsTableBody">
                    <!-- سيتم إضافة الصفوف عن طريق JavaScript -->
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
const materials = [
    {
        id: 1,
        name: 'الرياضيات للصف الأول',
        description: 'كتاب الرياضيات الأساسي للصف الأول الابتدائي',
        type: 'تاسع',
        teacher: 'أ. محمد الأحمد',
        status: true,
        created_at: '2024-01-15'
    },
    {
        id: 2,
        name: 'اللغة العربية',
        description: 'منهج اللغة العربية الشامل',
        type: 'بكلوريا',
        teacher: 'أ. سارة يوسف',
        status: true,
        created_at: '2024-01-16'
    },
    {
        id: 3,
        name: 'العلوم العامة',
        description: 'مادة العلوم للمرحلة المتوسطة',
        type: 'تاسع',
        teacher: 'د. خالد العلي',
        status: false,
        created_at: '2024-01-17'
    }
];
let filteredMaterials = [...materials];

function renderTable() {
    const tbody = document.getElementById('materialsTableBody');
    tbody.innerHTML = filteredMaterials.map((item, index) => `
        <tr>
            <td>${index + 1}</td>
            <td>${item.name}</td>
            <td>${item.description}</td>
            <td><span class="badge badge-primary">${item.type}</span></td>
            <td>${item.teacher}</td>
            <td>
                <span class="${item.status ? 'status-active' : 'status-inactive'}">
                    ${item.status ? 'نشط' : 'غير نشط'}
                </span>
            </td>
            <td>${item.created_at}</td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-info btn-sm" onclick="goToEdit(${item.id})">
                        <i class="fas fa-edit"></i> تعديل
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="deleteMaterial(${item.id})">
                        <i class="fas fa-trash"></i> حذف
                    </button>
                    <button class="btn btn-secondary btn-sm" onclick="showFiles(${item.id})">
                        <i class="fas fa-folder-open"></i> ملفات المادة
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

function addMaterial() {
    alert('سيتم توجيهك إلى صفحة إضافة مادة جديدة');
}
function goToEdit(id) {
    // غير الرابط حسب مسار صفحة التعديل لديك
    window.location.href = `/admin/educational-materials/edit?id=${id}`;
}
function deleteMaterial(id) {
    const mat = filteredMaterials.find(m => m.id === id);
    if (confirm(`هل أنت متأكد من حذف المادة: "${mat.name}"؟ لا يمكن التراجع عن هذا الإجراء!`)) {
        const index = materials.findIndex(m => m.id === id);
        if (index > -1) {
            materials.splice(index, 1);
        }
        filterAndRender();
    }
}
function showFiles(id) {
    alert('عرض ملفات المادة رقم: ' + id);
}
function filterAndRender() {
    const type = document.getElementById('typeFilter').value;
    const search = document.getElementById('searchBox').value.trim();
    filteredMaterials = materials.filter(m => {
        const typeMatch = (type === 'all' || m.type === type);
        const searchMatch = (m.name.includes(search));
        return typeMatch && searchMatch;
    });
    renderTable();
}
document.getElementById('typeFilter').addEventListener('change', filterAndRender);
document.getElementById('searchBox').addEventListener('input', filterAndRender);
window.onload = filterAndRender;

  </script><script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>
</html> 