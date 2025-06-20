<!DOCTYPE html>
<html lang="ar" dir="LTR">

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
    .btn-success {
      background: #28a745;
      color: #fff;
      border: none;
    }
    .btn-success:hover {
      background: #1e7e34;
      color: #fff;
    }
    .badge-primary {
      background-color: #3498db;
    }
    .badge-success {
      background-color: #2ecc71;
    }
    .status-open {
      color: #f39c12;
      background-color: #fef5e7;
      padding: 6px 12px;
      border-radius: 6px;
      font-weight: bold;
    }
    .status-pending {
      color: #3498db;
      background-color: #ebf3fd;
      padding: 6px 12px;
      border-radius: 6px;
      font-weight: bold;
    }
    .status-closed {
      color: #27ae60;
      background-color: #daf6e6;
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
                  <h1 class="text-gradient text-primary welcome-animated">استعراض الشكاوى 📋</h1>
                  <p class="mb-0">إدارة ومراجعة شكاوى الطلاب والمدرسين</p>
                </div>
                <div class="col-lg-6 text-end">
                  <button class="btn btn-primary mb-0" onclick="addNewComplaint()">
                    <i class="fas fa-plus"></i>&nbsp;&nbsp;إضافة شكوى جديدة
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
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">إجمالي الشكاوى</p>
                        <h5 class="font-weight-bolder">89</h5>
                        <p class="mb-0">
                          <span class="text-info text-sm font-weight-bolder">+12</span>
                          هذا الشهر
                        </p>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                        <i class="ni ni-chat-round text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
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
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">مفتوحة</p>
                        <h5 class="font-weight-bolder">23</h5>
                        <p class="mb-0">
                          <span class="text-warning text-sm font-weight-bolder">26%</span>
                          من الشكاوى
                        </p>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                        <i class="ni ni-time-alarm text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
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
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">قيد المراجعة</p>
                        <h5 class="font-weight-bolder">34</h5>
                        <p class="mb-0">
                          <span class="text-info text-sm font-weight-bolder">38%</span>
                          من الشكاوى
                        </p>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                        <i class="ni ni-settings text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
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
                        <p class="text-sm mb-0 text-uppercase font-weight-bold">مغلقة</p>
                        <h5 class="font-weight-bolder">32</h5>
                        <p class="mb-0">
                          <span class="text-success text-sm font-weight-bolder">36%</span>
                          من الشكاوى
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
                    <label class="form-label">الحالة</label>
                    <select id="statusSelect" class="form-select">
                      <option value="">جميع الحالات</option>
                  <option value="open">مفتوحة</option>
                  <option value="pending">قيد المراجعة</option>
                  <option value="closed">مغلقة</option>
                </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label class="form-label">البحث</label>
                    <div class="input-group">
                      <span class="input-group-text"><i class="fas fa-search"></i></span>
                      <input id="search-input" type="text" class="form-control" placeholder="البحث بالاسم أو النص...">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Complaints Table -->
          <div class="card">
            <div class="card-header pb-0">
             
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table id="complaints-table" class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الطالب</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الدورة</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">المادة</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تاريخ الشكوى</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الحالة</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">نص الشكوى</th>
                      <th class="text-secondary opacity-7">الإجراءات</th>
                    </tr>
                  </thead>
                  <tbody id="complaintsTableBody">
                    <!-- سيتم ملء البيانات بواسطة JavaScript -->
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->
              <div class="d-flex justify-content-between align-items-center p-3">
                <p class="text-sm mb-0">عرض 1-10 من 89 شكوى</p>
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
                    <li class="page-item"><a class="page-link" href="javascript:;">9</a></li>
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

  <!-- Modal Edit Complaint -->
  <div class="modal fade" id="editComplaintModal" tabindex="-1" aria-labelledby="editComplaintModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editComplaintModalLabel">تعديل الشكوى</h5>
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
              <label class="form-label">تاريخ الشكوى</label>
              <input type="date" class="form-control" value="2024-06-01" required>
            </div>
            <div class="mb-3">
              <label class="form-label">الحالة</label>
              <select class="form-select" required>
                <option selected>مفتوحة</option>
                <option>قيد المراجعة</option>
                <option>مغلقة</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">نص الشكوى</label>
              <textarea class="form-control" rows="4" required>المدرس يتأخر عن الحصة بشكل مستمر مما يؤثر على سير العملية التعليمية.</textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">الرد على الشكوى</label>
              <textarea class="form-control" rows="3" placeholder="أضف ردك على الشكوى هنا..."></textarea>
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

  <!-- Modal Reply to Complaint -->
  <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="replyModalLabel">الرد على الشكوى</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label class="form-label">اسم الطالب</label>
              <input type="text" class="form-control" value="محمد الأحمد" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label">نص الشكوى</label>
              <textarea class="form-control" rows="3" readonly>المدرس يتأخر عن الحصة بشكل مستمر مما يؤثر على سير العملية التعليمية.</textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">الرد على الشكوى</label>
              <textarea class="form-control" rows="4" placeholder="اكتب ردك على الشكوى هنا..." required></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">تحديث الحالة</label>
              <select class="form-select" required>
                <option value="pending">قيد المراجعة</option>
                <option value="closed">مغلقة</option>
                <option value="open">مفتوحة</option>
              </select>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="notifyStudent">
                <label class="form-check-label" for="notifyStudent">
                  إرسال إشعار للطالب بالرد
                </label>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
          <button type="button" class="btn btn-success">إرسال الرد</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Transfer to Teacher -->
  <div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="transferModalLabel">تحويل الشكوى لاستاذ</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label class="form-label">اسم الطالب</label>
              <input type="text" class="form-control" value="محمد الأحمد" readonly>
            </div>
            <div class="mb-3">
              <label class="form-label">نص الشكوى</label>
              <textarea class="form-control" rows="3" readonly>المدرس يتأخر عن الحصة بشكل مستمر مما يؤثر على سير العملية التعليمية.</textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">اختر الاستاذ</label>
              <select class="form-select" required>
                <option value="">اختر الاستاذ...</option>
                <option value="1">أ. أحمد محمد - مدرس الرياضيات</option>
                <option value="2">أ. سارة خالد - مدرسة اللغة العربية</option>
                <option value="3">أ. خالد علي - مدرس الفيزياء</option>
                <option value="4">أ. فاطمة حسن - مدرسة الكيمياء</option>
                <option value="5">أ. عمر يوسف - مدرس الرياضيات</option>
                <option value="6">أ. نور الدين - مدرس اللغة العربية</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">ملاحظة للاستاذ</label>
              <textarea class="form-control" rows="3" placeholder="أضف ملاحظة أو تعليمات للاستاذ..."></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">أولوية التحويل</label>
              <select class="form-select" required>
                <option value="low">منخفضة</option>
                <option value="medium" selected>متوسطة</option>
                <option value="high">عالية</option>
                <option value="urgent">عاجلة</option>
              </select>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="notifyTeacher" checked>
                <label class="form-check-label" for="notifyTeacher">
                  إرسال إشعار للاستاذ
                </label>
              </div>
            </div>
            <div class="mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="notifyStudentTransfer">
                <label class="form-check-label" for="notifyStudentTransfer">
                  إشعار الطالب بالتحويل
                </label>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
          <button type="button" class="btn btn-info">تحويل الشكوى</button>
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
          <p class="mb-0">هل أنت متأكد من حذف هذه الشكوى؟</p>
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
    
    const complaintsData = [
      {id: 1, student: 'محمد الأحمد', courseId: 1, course: 'دورة الرياضيات', material: 'رياضيات 1', date: '2024-06-01', status: 'open', text: 'المدرس يتأخر عن الحصة بشكل مستمر مما يؤثر على سير العملية التعليمية.'},
      {id: 2, student: 'سارة يوسف', courseId: 1, course: 'دورة الرياضيات', material: 'رياضيات 2', date: '2024-06-02', status: 'pending', text: 'المادة صعبة جداً وأحتاج إلى شرح إضافي.'},
      {id: 3, student: 'خالد العلي', courseId: 2, course: 'دورة اللغة العربية', material: 'بلاغة', date: '2024-06-03', status: 'closed', text: 'تم حل المشكلة بنجاح، شكراً لكم.'},
      {id: 4, student: 'فاطمة محمد', courseId: 2, course: 'دورة اللغة العربية', material: 'نحو', date: '2024-06-04', status: 'open', text: 'الكتاب المدرسي يحتوي على أخطاء في التمارين.'},
      {id: 5, student: 'أحمد حسن', courseId: 3, course: 'دورة الفيزياء', material: 'فيزياء 1', date: '2024-06-05', status: 'pending', text: 'أحتاج إلى جلسات تقوية إضافية.'},
      {id: 6, student: 'نور الدين', courseId: 3, course: 'دورة الفيزياء', material: 'فيزياء 2', date: '2024-06-06', status: 'closed', text: 'تم توفير الجلسات الإضافية المطلوبة.'},
      {id: 7, student: 'ليلى أحمد', courseId: 4, course: 'دورة الكيمياء', material: 'كيمياء 1', date: '2024-06-07', status: 'open', text: 'المختبر يحتاج إلى تجهيزات جديدة.'},
      {id: 8, student: 'عمر خالد', courseId: 4, course: 'دورة الكيمياء', material: 'كيمياء 2', date: '2024-06-08', status: 'pending', text: 'أحتاج إلى مراجعة شاملة للمادة.'},
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
      const tbody = document.getElementById('complaintsTableBody');
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
            <span class="status-${item.status}">
              ${item.status === 'open' ? 'مفتوحة' : item.status === 'pending' ? 'قيد المراجعة' : 'مغلقة'}
            </span>
          </td>
          <td>
            <p class="text-xs text-secondary mb-0">${item.text.length > 50 ? item.text.substring(0, 50) + '...' : item.text}</p>
          </td>
          <td class="align-middle">
            <div class="d-flex align-items-center gap-2">
              <button class="btn btn-link text-success p-2" data-bs-toggle="modal" data-bs-target="#replyModal" title="رد على الشكوى">
                <i class="fas fa-reply"></i>
              </button>
              <button class="btn btn-link text-info p-2" data-bs-toggle="modal" data-bs-target="#transferModal" title="تحويل لاستاذ">
                <i class="fas fa-exchange-alt"></i>
              </button>
              <button class="btn btn-link text-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal" title="حذف الشكوى">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </td>
        </tr>
      `).join('');
    }

    function filterComplaints() {
      const courseId = document.getElementById('courseSelect').value;
      const material = document.getElementById('materialSelect').value;
      const status = document.getElementById('statusSelect').value;
      const searchText = document.getElementById('search-input').value.toLowerCase();
      
      let filtered = complaintsData;
      
      if (courseId) filtered = filtered.filter(a => a.courseId == courseId);
      if (material) filtered = filtered.filter(a => a.material === material);
      if (status) filtered = filtered.filter(a => a.status === status);
      if (searchText) filtered = filtered.filter(a => 
        a.student.toLowerCase().includes(searchText) || 
        a.text.toLowerCase().includes(searchText)
      );
      
      renderTable(filtered);
    }

    function addNewComplaint() {
      // يمكن إضافة منطق إضافة شكوى جديدة هنا
      alert('سيتم إضافة شكوى جديدة');
    }

    document.addEventListener('DOMContentLoaded', function() {
      updateMaterials();
      renderTable(complaintsData);
      
      document.getElementById('courseSelect').addEventListener('change', updateMaterials);
      document.getElementById('courseSelect').addEventListener('change', filterComplaints);
      document.getElementById('materialSelect').addEventListener('change', filterComplaints);
      document.getElementById('statusSelect').addEventListener('change', filterComplaints);
      document.getElementById('search-input').addEventListener('keyup', filterComplaints);
    });
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html> 