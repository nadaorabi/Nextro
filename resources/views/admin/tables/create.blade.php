<!DOCTYPE html>
<html lang="ar" dir="LTR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>إنشاء جدول جديد</title>
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
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">إنشاء جدول جديد</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">إنشاء جدول جديد</h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>إنشاء جدول دراسي جديد</h6>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">عنوان الجدول</label>
                                            <input type="text" class="form-control" placeholder="أدخل عنوان الجدول">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">العام الدراسي</label>
                                            <input type="text" class="form-control" placeholder="مثال: 2023-2024">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">تاريخ البداية</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">تاريخ النهاية</label>
                                            <input type="date" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h6 class="mb-3">الحصص الدراسية</h6>
                                        <div id="periods-container">
                                            <div class="row period-row mb-3">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label">اسم المادة</label>
                                                        <input type="text" class="form-control" placeholder="أدخل اسم المادة">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label">المدرس</label>
                                                        <input type="text" class="form-control" placeholder="اسم المدرس">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-control-label">اليوم</label>
                                                        <select class="form-control">
                                                            <option>السبت</option>
                                                            <option>الأحد</option>
                                                            <option>الاثنين</option>
                                                            <option>الثلاثاء</option>
                                                            <option>الأربعاء</option>
                                                            <option>الخميس</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label class="form-control-label">الوقت</label>
                                                        <input type="time" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button type="button" class="btn btn-danger btn-sm mb-0" onclick="removePeriod(this)">
                                                        <i class="fas fa-trash"></i> حذف
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-info btn-sm" onclick="addPeriod()">
                                            <i class="fas fa-plus"></i> إضافة حصة
                                        </button>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">حفظ الجدول</button>
                                        <button type="button" class="btn btn-secondary" onclick="window.location.href='list'">إلغاء</button>
                                    </div>
                                </div>
                            </form>
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

        function addPeriod() {
            const container = document.getElementById('periods-container');
            const periodRow = container.querySelector('.period-row').cloneNode(true);
            // Clear inputs
            periodRow.querySelectorAll('input').forEach(input => input.value = '');
            periodRow.querySelector('select').selectedIndex = 0;
            container.appendChild(periodRow);
        }

        function removePeriod(button) {
            const periodsCount = document.querySelectorAll('.period-row').length;
            if (periodsCount > 1) {
                button.closest('.period-row').remove();
            } else {
                alert('يجب أن يحتوي الجدول على حصة واحدة على الأقل');
            }
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html> 