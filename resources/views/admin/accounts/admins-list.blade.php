<!DOCTYPE html>
<html lang="ar" dir="LTR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>إدارة الحسابات الإدارية</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    
    @include('admin.parts.sidebar-admin')

    <main class="main-content position-relative border-radius-lg overflow-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">الصفحات</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">إدارة الحسابات الإدارية</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">إدارة الحسابات الإدارية</h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <!-- Welcome Card -->
                    <div class="card mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1 class="text-gradient text-primary">إدارة الحسابات الإدارية 👥</h1>
                                    <p class="mb-0">إدارة وإضافة وتعديل حسابات المدراء</p>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <a href="{{ url('admin/accounts/admins/create') }}" class="btn btn-primary mb-0">
                                        <i class="fas fa-plus"></i>&nbsp;&nbsp;إضافة مدير جديد
                                    </a>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">إجمالي المدراء</p>
                                                <h5 class="font-weight-bolder">15</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">+2</span>
                                                    هذا الشهر
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                                <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">نشط</p>
                                                <h5 class="font-weight-bolder">13</h5>
                                                <p class="mb-0">
                                                    <span class="text-success text-sm font-weight-bolder">87%</span>
                                                    من المدراء
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                                <i class="fas fa-user-check text-lg opacity-10" aria-hidden="true"></i>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">معلق</p>
                                                <h5 class="font-weight-bolder">1</h5>
                                                <p class="mb-0">
                                                    <span class="text-warning text-sm font-weight-bolder">حساب</span>
                                                    معلق
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                                <i class="fas fa-user-clock text-lg opacity-10" aria-hidden="true"></i>
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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold">محظور</p>
                                                <h5 class="font-weight-bolder">1</h5>
                                                <p class="mb-0">
                                                    <span class="text-danger text-sm font-weight-bolder">حساب</span>
                                                    محظور
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                                <i class="fas fa-user-slash text-lg opacity-10" aria-hidden="true"></i>
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
                                        <label class="form-label">الحالة</label>
                                        <select class="form-select">
                                            <option value="">جميع الحالات</option>
                                            <option>نشط</option>
                                            <option>معلق</option>
                                            <option>محظور</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">الصلاحية</label>
                                        <select class="form-select">
                                            <option value="">جميع الصلاحيات</option>
                                            <option>مدير عام</option>
                                            <option>مدير أكاديمي</option>
                                            <option>مدير مالي</option>
                                            <option>مدير إداري</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">تاريخ التسجيل</label>
                                        <select class="form-select">
                                            <option value="">جميع التواريخ</option>
                                            <option>هذا الشهر</option>
                                            <option>الشهر الماضي</option>
                                            <option>آخر 3 أشهر</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">بحث</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input type="text" class="form-control" placeholder="البحث بالاسم أو البريد الإلكتروني...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admins Table -->
                    <div class="card">
                        <div class="card-header pb-0">
                           
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المدير</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">البريد الإلكتروني</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الصلاحية</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الحالة</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تاريخ التسجيل</th>
                                            <th class="text-secondary opacity-7">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('images/team-1.jpg') }}" class="avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">أحمد محمد</h6>
                                                        <p class="text-xs text-secondary mb-0">مدير عام</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">ahmed@example.com</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">مدير عام</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-success">نشط</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">2024-01-15</p>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-link text-info p-2" data-bs-toggle="modal" data-bs-target="#editAdminModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-link text-warning p-2" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                                        <i class="fas fa-key"></i>
                                                    </button>
                                                    <button class="btn btn-link text-success p-2">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button class="btn btn-link text-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('images/team-2.jpg') }}" class="avatar avatar-sm me-3" alt="user2">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">فاطمة علي</h6>
                                                        <p class="text-xs text-secondary mb-0">مديرة أكاديمية</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">fatima@example.com</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">مديرة أكاديمية</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-success">نشط</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">2024-01-20</p>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-link text-info p-2" data-bs-toggle="modal" data-bs-target="#editAdminModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-link text-warning p-2" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                                        <i class="fas fa-key"></i>
                                                    </button>
                                                    <button class="btn btn-link text-success p-2">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button class="btn btn-link text-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('images/team-3.jpg') }}" class="avatar avatar-sm me-3" alt="user3">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">محمد حسن</h6>
                                                        <p class="text-xs text-secondary mb-0">مدير مالي</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">mohamed@example.com</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">مدير مالي</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-sm bg-gradient-warning">معلق</span>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">2024-02-01</p>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-link text-info p-2" data-bs-toggle="modal" data-bs-target="#editAdminModal">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-link text-warning p-2" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                                        <i class="fas fa-key"></i>
                                                    </button>
                                                    <button class="btn btn-link text-success p-2">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button class="btn btn-link text-danger p-2" data-bs-toggle="modal" data-bs-target="#deleteConfirmModal">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center p-3">
                                <p class="text-sm mb-0">عرض 1-10 من 15 مدير</p>
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

    <!-- Modal Add Admin -->
    <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAdminModalLabel">إضافة مدير جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">الاسم الكامل</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الصلاحية</label>
                            <select class="form-select" required>
                                <option value="">اختر الصلاحية...</option>
                                <option value="general">مدير عام</option>
                                <option value="academic">مدير أكاديمي</option>
                                <option value="financial">مدير مالي</option>
                                <option value="administrative">مدير إداري</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">رقم الهاتف</label>
                            <input type="tel" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary">حفظ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Admin -->
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAdminModalLabel">تعديل بيانات المدير</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">الاسم الكامل</label>
                            <input type="text" class="form-control" value="أحمد محمد" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" value="ahmed@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">الصلاحية</label>
                            <select class="form-select" required>
                                <option value="general" selected>مدير عام</option>
                                <option value="academic">مدير أكاديمي</option>
                                <option value="financial">مدير مالي</option>
                                <option value="administrative">مدير إداري</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">رقم الهاتف</label>
                            <input type="tel" class="form-control" value="0123456789">
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

    <!-- Modal Change Password -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">تغيير كلمة المرور</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">كلمة المرور الجديدة</label>
                            <input type="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تأكيد كلمة المرور الجديدة</label>
                            <input type="password" class="form-control" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary">تغيير كلمة المرور</button>
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
                    <p class="mb-0">هل أنت متأكد من حذف حساب المدير "أحمد محمد"؟</p>
                    <p class="text-danger mb-0">هذا الإجراء لا يمكن التراجع عنه.</p>
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
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html> 