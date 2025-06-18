<!DOCTYPE html>
<html lang="ar" dir="LTR
">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>إدارة المالية</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show rtl bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

@include('admin.parts.sidebar-admin')

    <main class="main-content position-relative border-radius-lg">
        <!-- Welcome Message -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1 class="text-gradient text-primary">إدارة المالية 💰</h1>
                                    <p class="mb-0">إدارة المدفوعات والإيصالات المالية في مكان واحد</p>
                                </div>
                                <div class="col-lg-6 text-end d-flex flex-column justify-content-center">
                                    <button class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                                        <i class="fas fa-plus"></i>&nbsp;&nbsp;إضافة معاملة جديدة
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- الإحصائيات -->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">إجمالي المدفوعات</p>
                                        <h5 class="font-weight-bolder">15,000 ريال</h5>
                                        <p class="mb-0">
                                            <span class="text-success text-sm font-weight-bolder">+3%</span>
                                            منذ الشهر الماضي
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
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
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">عدد المعاملات</p>
                                        <h5 class="font-weight-bolder">45</h5>
                                        <p class="mb-0">
                                            <span class="text-success text-sm font-weight-bolder">+5</span>
                                            هذا الأسبوع
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
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
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">المعاملات المعلقة</p>
                                        <h5 class="font-weight-bolder">5</h5>
                                        <p class="mb-0">
                                            <span class="text-danger text-sm font-weight-bolder">-2</span>
                                            منذ أمس
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="ni ni-clock-2 text-lg opacity-10" aria-hidden="true"></i>
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
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">متوسط المعاملات</p>
                                        <h5 class="font-weight-bolder">333 ريال</h5>
                                        <p class="mb-0">
                                            <span class="text-success text-sm font-weight-bolder">+1%</span>
                                            هذا الشهر
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="ni ni-chart-bar-32 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs للتبديل بين المدفوعات والإيصالات -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <ul class="nav nav-tabs nav-justified" id="financeTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="payments-tab" data-bs-toggle="tab" data-bs-target="#payments" type="button" role="tab" aria-controls="payments" aria-selected="true">
                                        <i class="fas fa-money-bill-wave me-2"></i>المدفوعات
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="receipts-tab" data-bs-toggle="tab" data-bs-target="#receipts" type="button" role="tab" aria-controls="receipts" aria-selected="false">
                                        <i class="fas fa-receipt me-2"></i>الإيصالات
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <!-- أدوات البحث والفلترة -->
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" id="searchInput" placeholder="بحث...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" id="statusFilter">
                                        <option value="">جميع الحالات</option>
                                        <option value="completed">مكتمل</option>
                                        <option value="pending">معلق</option>
                                        <option value="cancelled">ملغي</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" id="typeFilter">
                                        <option value="">جميع الأنواع</option>
                                        <option value="tuition">رسوم دراسية</option>
                                        <option value="books">رسوم كتب</option>
                                        <option value="activities">رسوم نشاطات</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        <input type="date" class="form-control" id="dateFilter">
                                    </div>
                                </div>
                            </div>

                            <div class="tab-content" id="financeTabContent">
                                <!-- تاب المدفوعات -->
                                <div class="tab-pane fade show active" id="payments" role="tabpanel" aria-labelledby="payments-tab">
                                    <div class="table-responsive" style="min-height: 500px; max-height: 600px; overflow-y: auto;">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم المعاملة</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">التاريخ</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">اسم الطالب</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">المبلغ</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">نوع المعاملة</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الحالة</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الإجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">#12345</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0">2024-01-15</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0">أحمد محمد</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0">500 ريال</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0">رسوم دراسية</p>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-sm bg-gradient-success">مكتمل</span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="tooltip" title="عرض التفاصيل">
                                                            <i class="fas fa-eye text-dark me-2"></i>
                                                        </button>
                                                        <button class="btn btn-link text-primary px-3 mb-0" data-bs-toggle="tooltip" title="تعديل">
                                                            <i class="fas fa-pencil-alt text-dark me-2"></i>
                                                        </button>
                                                        <button class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="tooltip" title="حذف">
                                                            <i class="far fa-trash-alt me-2"></i>
                                                        </button>
                                                        <button class="btn btn-link text-success px-3 mb-0" data-bs-toggle="tooltip" title="طباعة الإيصال">
                                                            <i class="fas fa-print me-2"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!-- يمكن تكرار الصفوف حسب الحاجة -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- تاب الإيصالات -->
                                <div class="tab-pane fade" id="receipts" role="tabpanel" aria-labelledby="receipts-tab">
                                    <div class="table-responsive" style="min-height: 500px; max-height: 600px; overflow-y: auto;">
                                        <table class="table align-items-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم الإيصال</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">التاريخ</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">اسم الطالب</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">المبلغ</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">البيان</th>
                                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الإجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-sm">#R-12345</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0">2024-01-15</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0">أحمد محمد</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0">500 ريال</p>
                                                    </td>
                                                    <td>
                                                        <p class="text-sm font-weight-bold mb-0">رسوم دراسية</p>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-link text-dark px-3 mb-0" data-bs-toggle="tooltip" title="عرض التفاصيل">
                                                            <i class="fas fa-eye text-dark me-2"></i>
                                                        </button>
                                                        <button class="btn btn-link text-success px-3 mb-0" data-bs-toggle="tooltip" title="طباعة">
                                                            <i class="fas fa-print me-2"></i>
                                                        </button>
                                                        <button class="btn btn-link text-danger text-gradient px-3 mb-0" data-bs-toggle="tooltip" title="حذف">
                                                            <i class="far fa-trash-alt me-2"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <!-- يمكن تكرار الصفوف حسب الحاجة -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- ترقيم الصفحات -->
                            <div class="d-flex justify-content-between align-items-center p-3">
                                <p class="text-sm mb-0">عرض 1-10 من 50 سجل</p>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-end mb-0">
                                        <li class="page-item disabled">
                                            <a class="page-link" href="javascript:;" tabindex="-1">
                                                <i class="fa fa-angle-right"></i>
                                                <span class="sr-only">السابق</span>
                                            </a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="javascript:;">1</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:;">2</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:;">
                                                <i class="fa fa-angle-left"></i>
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

        <!-- Modal إضافة معاملة جديدة -->
        <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTransactionModalLabel">إضافة معاملة جديدة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">اسم الطالب</label>
                                        <select class="form-select" required>
                                            <option value="">اختر الطالب...</option>
                                            <option value="1">أحمد محمد</option>
                                            <option value="2">سارة خالد</option>
                                            <option value="3">محمد علي</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">المبلغ</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" placeholder="أدخل المبلغ" required>
                                            <span class="input-group-text">ريال</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">نوع المعاملة</label>
                                        <select class="form-select" required>
                                            <option value="">اختر النوع...</option>
                                            <option value="tuition">رسوم دراسية</option>
                                            <option value="books">رسوم كتب</option>
                                            <option value="activities">رسوم نشاطات</option>
                                            <option value="other">أخرى</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">تاريخ المعاملة</label>
                                        <input type="date" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">طريقة الدفع</label>
                                        <select class="form-select" required>
                                            <option value="">اختر الطريقة...</option>
                                            <option value="cash">نقداً</option>
                                            <option value="card">بطاقة ائتمان</option>
                                            <option value="transfer">تحويل بنكي</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-control-label">الحالة</label>
                                        <select class="form-select" required>
                                            <option value="completed">مكتمل</option>
                                            <option value="pending">معلق</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <label class="form-control-label">ملاحظات</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>

                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" id="generateReceipt" checked>
                                <label class="form-check-label" for="generateReceipt">
                                    إصدار إيصال تلقائياً
                                </label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="button" class="btn btn-primary">حفظ وطباعة</button>
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

    <!-- إضافة سكربت للبحث والفلترة -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // تفعيل tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // البحث
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('keyup', function() {
            // قم بتنفيذ البحث هنا
        });

        // الفلترة
        const statusFilter = document.getElementById('statusFilter');
        const typeFilter = document.getElementById('typeFilter');
        const dateFilter = document.getElementById('dateFilter');

        [statusFilter, typeFilter, dateFilter].forEach(filter => {
            filter.addEventListener('change', function() {
                // قم بتنفيذ الفلترة هنا
            });
        });
    });
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html> 