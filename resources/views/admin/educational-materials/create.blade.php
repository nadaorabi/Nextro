<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>إضافة مادة أو دورة</title>
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
    .table th, .table td {
      vertical-align: middle;
      text-align: center;
    }
    .btn-group .btn {
      border-radius: 8px !important;
      font-weight: 500;
      margin: 0 2px;
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
    @media (max-width: 600px) {
      .card-body { padding: 1rem 0.5rem; }
      .table-responsive { font-size: 0.95rem; }
    }
  </style>
</head>
<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container mt-4 text-center">
      <h1 class="welcome-animated mb-4">إضافة مادة أو دورة جديدة</h1>
    </div>
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12" style="max-width:900px;margin:auto;">
          <div class="card shadow-sm">
            <div class="card-body">
              <h4 class="mb-4 fw-bold text-primary text-center">
                <i class="fas fa-plus-circle me-2"></i>
                إضافة مادة أو دورة جديدة
              </h4>
              <form action="#" method="POST" class="text-start" enctype="multipart/form-data">
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">اسم المادة أو الدورة</label>
                      <div class="col-md-9">
                        <input type="text" name="name" class="form-control" required placeholder="أدخل اسم المادة أو الدورة">
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">الوصف</label>
                      <div class="col-md-9">
                        <textarea name="description" class="form-control" rows="3" placeholder="أدخل وصف المادة أو الدورة"></textarea>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">النوع</label>
                      <div class="col-md-9">
                        <select name="type" class="form-select" required>
                            <option value="">-- اختر --</option>
                            <option value="مادة">مادة</option>
                            <option value="دورة">دورة</option>
                        </select>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">إضافة المادة إلى دورة (اختياري)</label>
                      <div class="col-md-9">
                        <select name="course_id" class="form-select">
                            <option value="">-- بدون ربط --</option>
                            <option value="1">دورة البرمجة الشاملة</option>
                            <option value="2">دورة اللغة الإنجليزية المكثفة</option>
                            <option value="3">دورة الرياضيات المتقدمة</option>
                        </select>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">اختر الأستاذ</label>
                      <div class="col-md-9">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="teacher" id="teacher1" value="1" required>
                            <label class="form-check-label" for="teacher1">أ. محمد الأحمد</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="teacher" id="teacher2" value="2">
                            <label class="form-check-label" for="teacher2">أ. سارة يوسف</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="teacher" id="teacher3" value="3">
                            <label class="form-check-label" for="teacher3">د. خالد العلي</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="teacher" id="teacher4" value="4">
                            <label class="form-check-label" for="teacher4">أ. ريم الحسن</label>
                        </div>
                      </div>
                  </div>
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary">إضافة</button>
                  </div>
              </form>
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
</body>
</html> 