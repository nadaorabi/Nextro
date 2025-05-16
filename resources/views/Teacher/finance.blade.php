<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
    الإدارة المالية
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
  <style>
    .finance-card {
      transition: all 0.3s ease;
      border-radius: 15px;
    }
    .finance-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .stat-card {
      background: linear-gradient(45deg, #4CAF50, #45a049);
      color: white;
      border-radius: 15px;
      padding: 20px;
    }
    .stat-card.income {
      background: linear-gradient(45deg, #2196F3, #1976D2);
    }
    .stat-card.expenses {
      background: linear-gradient(45deg, #FF5722, #F4511E);
    }
    .stat-card.balance {
      background: linear-gradient(45deg, #9C27B0, #7B1FA2);
    }
    .transaction-row {
      transition: all 0.3s ease;
    }
    .transaction-row:hover {
      background-color: #f8f9fa;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('teacher.parts.sidebar-teacher')
  <div class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <!-- إحصائيات سريعة -->
      <div class="row mb-4">
        <div class="col-xl-4 col-sm-6 mb-4">
          <div class="card finance-card">
            <div class="stat-card income">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h6 class="mb-0">إجمالي الإيرادات</h6>
                  <h3 class="mb-0">$24,500</h3>
                </div>
                <div class="icon icon-shape bg-white text-center rounded-circle">
                  <i class="fas fa-arrow-up text-success"></i>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <span class="text-white me-2">
                  <i class="fas fa-arrow-up"></i> 3.48%
                </span>
                <span class="text-white">من الشهر الماضي</span>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-4">
          <div class="card finance-card">
            <div class="stat-card expenses">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h6 class="mb-0">إجمالي المصروفات</h6>
                  <h3 class="mb-0">$12,300</h3>
                </div>
                <div class="icon icon-shape bg-white text-center rounded-circle">
                  <i class="fas fa-arrow-down text-danger"></i>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <span class="text-white me-2">
                  <i class="fas fa-arrow-down"></i> 2.15%
                </span>
                <span class="text-white">من الشهر الماضي</span>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-4">
          <div class="card finance-card">
            <div class="stat-card balance">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h6 class="mb-0">الرصيد الحالي</h6>
                  <h3 class="mb-0">$12,200</h3>
                </div>
                <div class="icon icon-shape bg-white text-center rounded-circle">
                  <i class="fas fa-wallet text-primary"></i>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <span class="text-white me-2">
                  <i class="fas fa-arrow-up"></i> 1.33%
                </span>
                <span class="text-white">من الشهر الماضي</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- المعاملات المالية -->
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-6 d-flex align-items-center">
                  <h6 class="mb-0">المعاملات المالية</h6>
                </div>
                <div class="col-6 text-end">
                  <button class="btn btn-primary btn-sm mb-0">
                    <i class="fas fa-plus me-2"></i>إضافة معاملة
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">التفاصيل</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">النوع</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">المبلغ</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">التاريخ</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الحالة</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الإجراءات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="transaction-row">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">رسوم الطلاب</h6>
                            <p class="text-xs text-secondary mb-0">دفعة شهرية</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="badge badge-sm bg-gradient-success">إيراد</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-success text-xs font-weight-bold">+$5,000</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">23/04/2024</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="badge badge-sm bg-gradient-success">مكتمل</span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-link text-primary text-gradient px-3 mb-0">
                          <i class="fas fa-eye me-2"></i>عرض
                        </button>
                        <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="fas fa-trash-alt me-2"></i>حذف
                        </button>
                      </td>
                    </tr>
                    <tr class="transaction-row">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">مصاريف المكتب</h6>
                            <p class="text-xs text-secondary mb-0">مستلزمات مكتبية</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="badge badge-sm bg-gradient-danger">مصروف</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-danger text-xs font-weight-bold">-$300</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">22/04/2024</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="badge badge-sm bg-gradient-success">مكتمل</span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-link text-primary text-gradient px-3 mb-0">
                          <i class="fas fa-eye me-2"></i>عرض
                        </button>
                        <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="fas fa-trash-alt me-2"></i>حذف
                        </button>
                      </td>
                    </tr>
                    <tr class="transaction-row">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">راتب المعلمين</h6>
                            <p class="text-xs text-secondary mb-0">رواتب شهرية</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <span class="badge badge-sm bg-gradient-danger">مصروف</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-danger text-xs font-weight-bold">-$8,000</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">21/04/2024</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="badge badge-sm bg-gradient-warning">قيد المعالجة</span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-link text-primary text-gradient px-3 mb-0">
                          <i class="fas fa-eye me-2"></i>عرض
                        </button>
                        <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="fas fa-trash-alt me-2"></i>حذف
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
  </div>

  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
</body>

</html> 