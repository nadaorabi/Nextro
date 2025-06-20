<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>إضافة مدرس</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>
<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12" style="max-width:900px;margin:auto;">
          <div class="card shadow-sm">
            <div class="card-body text-center">
              <p class="lead">هذه الصفحة مخصصة لإضافة مدرس جديد إلى النظام.</p>
              <form action="#" method="POST" class="text-start" enctype="multipart/form-data">
                  <div class="mb-3">
                      <label class="form-label">الاسم الكامل</label>
                      <input type="text" name="name" class="form-control w-100" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">البريد الإلكتروني</label>
                      <input type="email" name="email" class="form-control w-100" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">رقم الهاتف</label>
                      <input type="tel" name="phone" class="form-control w-100" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">المادة التي يدرسها</label>
                      <select name="subject" class="form-select w-100" required>
                          <option value="">اختر المادة...</option>
                          <option value="mathematics">الرياضيات</option>
                          <option value="physics">الفيزياء</option>
                          <option value="chemistry">الكيمياء</option>
                          <option value="arabic">اللغة العربية</option>
                          <option value="english">اللغة الإنجليزية</option>
                          <option value="history">التاريخ</option>
                          <option value="geography">الجغرافيا</option>
                      </select>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">كلمة المرور</label>
                      <input type="password" name="password" class="form-control w-100" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">تأكيد كلمة المرور</label>
                      <input type="password" name="password_confirmation" class="form-control w-100" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">صورة الملف الشخصي</label>
                      <input type="file" name="photo" class="form-control w-100" accept="image/*">
                  </div>
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary w-100">إضافة المدرس</button>
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