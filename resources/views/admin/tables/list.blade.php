<!DOCTYPE html>
<html lang="ar" dir="LTR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>قائمة الجداول</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show rtl bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    
@include('admin.parts.sidebar-admin')

    <main class="main-content position-relative border-radius-lg overflow-hidden">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">الصفحات</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">قائمة الجداول</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">قائمة الجداول</h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h6>قائمة الجداول الدراسية</h6>
                                <button class="btn btn-primary btn-sm" onclick="window.location.href='create'">إضافة جدول جديد</button>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">عنوان الجدول</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">العام الدراسي</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ البداية</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">تاريخ النهاية</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">جدول الفصل الأول</h6>
                                                        <p class="text-xs text-secondary mb-0">المرحلة الابتدائية</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">2023-2024</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">2024-01-01</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">2024-06-30</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="edit" class="btn btn-link text-dark px-3 mb-0">
                                                    <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>تعديل
                                                </a>
                                                <button class="btn btn-link text-danger text-gradient px-3 mb-0">
                                                    <i class="far fa-trash-alt me-2"></i>حذف
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">جدول الفصل الثاني</h6>
                                                        <p class="text-xs text-secondary mb-0">المرحلة المتوسطة</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">2023-2024</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">2024-02-01</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">2024-07-30</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="edit" class="btn btn-link text-dark px-3 mb-0">
                                                    <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>تعديل
                                                </a>
                                                <button class="btn btn-link text-danger text-gradient px-3 mb-0">
                                                    <i class="far fa-trash-alt me-2"></i>حذف
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  </div>
</main> 

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