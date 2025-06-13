<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>تعديل مادة أو دورة</title>
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
    .table {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0,0,0,0.07);
      overflow: hidden;
    }
    .table th, .table td {
      vertical-align: middle;
      text-align: center;
    }
    .btn-edit, .btn-delete {
      border-radius: 8px;
      padding: 7px 18px;
      font-weight: 600;
      margin: 0 2px;
    }
    .btn-edit {
      background: #007bff;
      color: #fff;
      border: none;
      transition: 0.2s;
    }
    .btn-edit:hover {
      background: #0056b3;
    }
    .btn-delete {
      background: #dc3545;
      color: #fff;
      border: none;
      transition: 0.2s;
    }
    .btn-delete:hover {
      background: #a71d2a;
    }
    .modal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0; top: 0; width: 100vw; height: 100vh;
      background: rgba(0,0,0,0.3);
      align-items: center;
      justify-content: center;
    }
    .modal-content {
      background: #fff;
      border-radius: 12px;
      padding: 30px 25px;
      min-width: 320px;
      max-width: 95vw;
      box-shadow: 0 8px 32px rgba(0,0,0,0.18);
      position: relative;
    }
    .modal-close {
      position: absolute;
      top: 10px; right: 15px;
      font-size: 1.5rem;
      color: #888;
      cursor: pointer;
    }
  </style>
</head>
<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container mt-4 text-center">
      <h1 class="welcome-animated mb-4">تعديل مادة أو دورة</h1>
    </div>
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12" style="max-width:900px;margin:auto;">
          <div class="card shadow-sm">
            <div class="card-body">
              <h4 class="mb-4 fw-bold text-primary text-center">
                <i class="fas fa-edit me-2"></i>
                تعديل مادة أو دورة
              </h4>
              <form action="#" method="POST" class="text-start" enctype="multipart/form-data">
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">اسم المادة أو الدورة</label>
                      <div class="col-md-9">
                        <select name="material_id" class="form-select" required>
                            <option value="">-- اختر المادة أو الدورة --</option>
                            <option value="1">الرياضيات للصف الأول</option>
                            <option value="2">اللغة العربية</option>
                            <option value="3">العلوم العامة</option>
                            <option value="4">البرمجة للمبتدئين</option>
                        </select>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">الوصف</label>
                      <div class="col-md-9">
                        <textarea name="description" class="form-control" rows="3" placeholder="أدخل وصف المادة أو الدورة">{{ old('description', $material->description ?? '') }}</textarea>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">النوع</label>
                      <div class="col-md-9">
                        <select name="type" class="form-select" required>
                            <option value="">-- اختر --</option>
                            <option value="مادة" {{ (old('type', $material->type ?? '') == 'مادة') ? 'selected' : '' }}>مادة</option>
                            <option value="دورة" {{ (old('type', $material->type ?? '') == 'دورة') ? 'selected' : '' }}>دورة</option>
                        </select>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">إضافة المادة إلى دورة (اختياري)</label>
                      <div class="col-md-9">
                        <select name="course_id" class="form-select">
                            <option value="">-- بدون ربط --</option>
                            <option value="1" {{ (old('course_id', $material->course_id ?? '') == '1') ? 'selected' : '' }}>دورة البرمجة الشاملة</option>
                            <option value="2" {{ (old('course_id', $material->course_id ?? '') == '2') ? 'selected' : '' }}>دورة اللغة الإنجليزية المكثفة</option>
                            <option value="3" {{ (old('course_id', $material->course_id ?? '') == '3') ? 'selected' : '' }}>دورة الرياضيات المتقدمة</option>
                        </select>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">اختر الأستاذ</label>
                      <div class="col-md-9">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="teacher" id="teacher1" value="1" {{ (old('teacher', $material->teacher_id ?? '') == '1') ? 'checked' : '' }} required>
                            <label class="form-check-label" for="teacher1">أ. محمد الأحمد</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="teacher" id="teacher2" value="2" {{ (old('teacher', $material->teacher_id ?? '') == '2') ? 'checked' : '' }}>
                            <label class="form-check-label" for="teacher2">أ. سارة يوسف</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="teacher" id="teacher3" value="3" {{ (old('teacher', $material->teacher_id ?? '') == '3') ? 'checked' : '' }}>
                            <label class="form-check-label" for="teacher3">د. خالد العلي</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="teacher" id="teacher4" value="4" {{ (old('teacher', $material->teacher_id ?? '') == '4') ? 'checked' : '' }}>
                            <label class="form-check-label" for="teacher4">أ. ريم الحسن</label>
                        </div>
                      </div>
                  </div>
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
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