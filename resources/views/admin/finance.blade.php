<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>الإدارة المالية المركزية</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
  <style>
    /* إعادة الخلفية الافتراضية للنظام */
    body.bg-gray-100 {
      background: #f8f9fa !important;
    }
    .main-content, .container-fluid {
      background: transparent !important;
    }
    /* احتفظ فقط بتلوين الكروت والإحصائيات */
    .finance-card {
      transition: all 0.3s ease;
      border-radius: 15px;
      border: none;
      box-shadow: 0 4px 6px rgba(0,0,0,0.07);
      background: #fff;
    }
    .finance-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    .stat-card {
      color: white;
      border-radius: 20px;
      padding: 25px;
      position: relative;
      overflow: hidden;
    }
    .stat-card.income {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    .stat-card.expenses {
      background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }
    .stat-card.balance {
      background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
      color: #333;
    }
    .stat-card.transactions {
      background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
      color: #333;
    }
    /* باقي التنسيقات كما هي */
    .transaction-row {
      transition: all 0.3s ease;
      border-radius: 10px;
      margin: 2px 0;
    }
    .transaction-row:hover {
      background-color: #f8f9fa;
      transform: scale(1.01);
    }
    .filter-section {
      background: #fff;
      border-radius: 20px;
      padding: 25px;
      margin-bottom: 30px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .form-control, .form-select {
      border-radius: 12px;
      border: 2px solid #e9ecef;
      transition: all 0.3s ease;
      font-size: 14px;
    }
    .form-control:focus, .form-select:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .btn {
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
      border: none;
    }
    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .badge {
      border-radius: 8px;
      font-size: 11px;
      font-weight: 600;
      padding: 6px 12px;
    }
    .badge-student-fee { background: linear-gradient(45deg, #4facfe, #00f2fe); }
    .badge-instructor-share { background: linear-gradient(45deg, #43e97b, #38f9d7); }
    .badge-instructor-payment { background: linear-gradient(45deg, #fa709a, #fee140); }
    .badge-discount { background: linear-gradient(45deg, #a8edea, #fed6e3); color: #333; }
    .badge-refund { background: linear-gradient(45deg, #ff9a9e, #fecfef); color: #333; }
    .badge-package-fee { background: linear-gradient(45deg, #ffecd2, #fcb69f); color: #333; }
    .table {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .table thead th {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 1px;
    }
    .amount-positive { color: #28a745; font-weight: 700; }
    .amount-negative { color: #dc3545; font-weight: 700; }
    .action-buttons .btn {
      padding: 4px 8px;
      font-size: 12px;
      margin: 0 2px;
    }
    .quick-stats {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 20px;
      padding: 20px;
      color: white;
      margin-bottom: 30px;
    }
    .quick-stats h5 {
      color: rgba(255,255,255,0.8);
      font-size: 14px;
      margin-bottom: 10px;
    }
    .quick-stats .number {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 5px;
    }
    .quick-stats .change {
      font-size: 12px;
      opacity: 0.8;
    }
    .filter-toggle {
      background: rgba(255,255,255,0.2);
      border: none;
      color: white;
      border-radius: 10px;
      padding: 8px 15px;
      font-size: 14px;
      transition: all 0.3s ease;
    }
    .filter-toggle:hover {
      background: rgba(255,255,255,0.3);
      transform: translateY(-2px);
    }
    .filter-toggle.active {
      background: rgba(255,255,255,0.4);
      font-weight: 600;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')

  <!-- Finance Page Content Start -->
  <main class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <!-- Header -->
      <div class="mb-4">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h2 class="fw-bold mb-2" style="color:#667eea">
              <i class="fas fa-chart-line me-2"></i>الإدارة المالية المركزية
            </h2>
            <div class="text-muted">مراقبة وإدارة جميع الحركات المالية في النظام التعليمي</div>
          </div>
          <div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
              <i class="fas fa-plus me-2"></i>إضافة معاملة
            </button>
          </div>
        </div>
      </div>

      <!-- Success Message -->
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif

      <!-- Statistics Cards -->
      <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card finance-card stat-card income">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold opacity-8">إجمالي الإيرادات</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ number_format($totalRevenue, 2) }} د.ك
                    </h5>
                    <p class="text-sm mb-0 opacity-8">
                      <i class="fas fa-arrow-up me-1"></i>
                      {{ number_format(($totalRevenue > 0 ? ($totalRevenue / max($totalRevenue, 1)) * 100 : 0), 1) }}% من إجمالي الحركات
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-white shadow text-center rounded-circle opacity-8">
                    <i class="ni ni-money-coins text-lg text-primary" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card finance-card stat-card expenses">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold opacity-8">إجمالي المصروفات</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ number_format(abs($totalExpenses), 2) }} د.ك
                    </h5>
                    <p class="text-sm mb-0 opacity-8">
                      <i class="fas fa-arrow-down me-1"></i>
                      {{ number_format(($totalExpenses < 0 ? (abs($totalExpenses) / max(abs($totalExpenses), 1)) * 100 : 0), 1) }}% من إجمالي الحركات
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-white shadow text-center rounded-circle opacity-8">
                    <i class="ni ni-cart text-lg text-danger" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card finance-card stat-card balance">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold opacity-8">الرصيد الحالي</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ number_format($currentBalance, 2) }} د.ك
                    </h5>
                    <p class="text-sm mb-0 opacity-8">
                      <i class="fas fa-{{ $currentBalance >= 0 ? 'arrow-up' : 'arrow-down' }} me-1"></i>
                      {{ $currentBalance >= 0 ? 'رصيد إيجابي' : 'رصيد سالب' }}
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-white shadow text-center rounded-circle opacity-8">
                    <i class="ni ni-chart-bar-32 text-lg text-warning" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6">
          <div class="card finance-card stat-card transactions">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold opacity-8">إجمالي المعاملات</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ number_format($payments->total()) }}
                    </h5>
                    <p class="text-sm mb-0 opacity-8">
                      <i class="fas fa-list me-1"></i>
                      {{ $payments->count() }} في هذه الصفحة
                    </p>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-white shadow text-center rounded-circle opacity-8">
                    <i class="ni ni-paper-diploma text-lg text-info" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Advanced Filter Section -->
      <div class="filter-section">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6 class="mb-0 text-dark fw-bold">
            <i class="fas fa-filter me-2"></i>فلترة متقدمة
          </h6>
          <div>
            <button class="filter-toggle active" onclick="toggleFilter('all')">الكل</button>
            <button class="filter-toggle" onclick="toggleFilter('students')">الطلاب</button>
            <button class="filter-toggle" onclick="toggleFilter('teachers')">الأساتذة</button>
            <button class="filter-toggle" onclick="toggleFilter('income')">الإيرادات</button>
            <button class="filter-toggle" onclick="toggleFilter('expenses')">المصروفات</button>
          </div>
        </div>
        
        <form method="get" class="row g-3">
          <div class="col-lg-3 col-md-6">
            <label class="form-label fw-bold text-dark">بحث سريع</label>
            <input type="text" name="search" class="form-control" 
                   placeholder="اسم المستخدم، ملاحظات، دورة..." 
                   value="{{ request('search') }}">
          </div>
          
          <div class="col-lg-2 col-md-6">
            <label class="form-label fw-bold text-dark">نوع الحساب</label>
            <select name="role" class="form-select">
              <option value="">الكل</option>
              <option value="student" @if(request('role')=='student') selected @endif>طالب</option>
              <option value="teacher" @if(request('role')=='teacher') selected @endif>أستاذ</option>
            </select>
          </div>
          
          <div class="col-lg-2 col-md-6">
            <label class="form-label fw-bold text-dark">نوع المعاملة</label>
            <select name="type" class="form-select">
              <option value="">الكل</option>
              <option value="student_fee" @if(request('type')=='student_fee') selected @endif>رسوم طالب</option>
              <option value="package_fee" @if(request('type')=='package_fee') selected @endif>رسوم باقة</option>
              <option value="instructor_share" @if(request('type')=='instructor_share') selected @endif>حصة أستاذ</option>
              <option value="instructor_payment" @if(request('type')=='instructor_payment') selected @endif>دفعة أستاذ</option>
              <option value="discount" @if(request('type')=='discount') selected @endif>خصم</option>
              <option value="refund" @if(request('type')=='refund') selected @endif>استرداد</option>
            </select>
          </div>
          
          <div class="col-lg-2 col-md-6">
            <label class="form-label fw-bold text-dark">من تاريخ</label>
            <input type="date" name="from" class="form-control" value="{{ request('from') }}">
          </div>
          
          <div class="col-lg-2 col-md-6">
            <label class="form-label fw-bold text-dark">إلى تاريخ</label>
            <input type="date" name="to" class="form-control" value="{{ request('to') }}">
          </div>
          
          <div class="col-lg-1 col-md-6">
            <label class="form-label fw-bold text-dark">&nbsp;</label>
            <button type="submit" class="btn btn-primary w-100">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </form>
        
        @if(request('search') || request('role') || request('type') || request('from') || request('to'))
          <div class="mt-3">
            <a href="{{ route('admin.finance.payments') }}" class="btn btn-outline-secondary btn-sm">
              <i class="fas fa-times me-1"></i>إلغاء الفلترة
            </a>
            <span class="text-muted ms-2">نتائج الفلترة: {{ $payments->total() }} معاملة</span>
          </div>
        @endif
      </div>

      <!-- Transaction History -->
      <div class="row mt-4">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row align-items-center">
                <div class="col-6">
                  <h6 class="mb-0 fw-bold">
                    <i class="fas fa-history me-2"></i>سجل المعاملات المالية
                  </h6>
                </div>
                <div class="col-6 text-end">
                  <span class="badge bg-primary">{{ $payments->total() }} معاملة</span>
                  <span class="text-muted ms-2">الصفحة {{ $payments->currentPage() }} من {{ $payments->lastPage() }}</span>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">التاريخ</th>
                      <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">المستخدم</th>
                      <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">نوع الحساب</th>
                      <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">نوع المعاملة</th>
                      <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">المبلغ</th>
                      <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">الملاحظات</th>
                      <th class="text-center text-uppercase text-white text-xxs font-weight-bolder opacity-7">الإجراءات</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($payments as $payment)
                      <tr class="transaction-row">
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">
                                {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') : '-' }}
                              </h6>
                              <p class="text-xs text-muted mb-0">
                                {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('H:i') : '-' }}
                              </p>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm fw-bold">{{ $payment->user->name ?? 'غير محدد' }}</h6>
                              <p class="text-xs text-muted mb-0">
                                {{ $payment->user->email ?? 'لا يوجد بريد إلكتروني' }}
                              </p>
                            </div>
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          @if($payment->user)
                            <span class="badge badge-sm {{ $payment->user->role == 'student' ? 'bg-gradient-primary' : 'bg-gradient-success' }}">
                              <i class="fas fa-{{ $payment->user->role == 'student' ? 'user-graduate' : 'chalkboard-teacher' }} me-1"></i>
                              {{ $payment->user->role == 'student' ? 'طالب' : 'أستاذ' }}
                            </span>
                          @else
                            <span class="badge badge-sm bg-gradient-secondary">غير محدد</span>
                          @endif
                        </td>
                        <td class="align-middle text-center text-sm">
                          @switch($payment->type)
                            @case('student_fee')
                              <span class="badge badge-sm badge-student-fee">
                                <i class="fas fa-graduation-cap me-1"></i>رسوم طالب
                              </span>
                              @break
                            @case('package_fee')
                              <span class="badge badge-sm badge-package-fee">
                                <i class="fas fa-box me-1"></i>رسوم باقة
                              </span>
                              @break
                            @case('instructor_share')
                              <span class="badge badge-sm badge-instructor-share">
                                <i class="fas fa-share-alt me-1"></i>حصة أستاذ
                              </span>
                              @break
                            @case('instructor_payment')
                              <span class="badge badge-sm badge-instructor-payment">
                                <i class="fas fa-money-bill-wave me-1"></i>دفعة أستاذ
                              </span>
                              @break
                            @case('discount')
                              <span class="badge badge-sm badge-discount">
                                <i class="fas fa-percentage me-1"></i>خصم
                              </span>
                              @break
                            @case('refund')
                              <span class="badge badge-sm badge-refund">
                                <i class="fas fa-undo me-1"></i>استرداد
                              </span>
                              @break
                            @default
                              <span class="badge badge-sm bg-gradient-secondary">{{ $payment->type }}</span>
                          @endswitch
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-sm font-weight-bold {{ $payment->amount > 0 ? 'amount-positive' : 'amount-negative' }}">
                            <i class="fas fa-{{ $payment->amount > 0 ? 'arrow-up' : 'arrow-down' }} me-1"></i>
                            {{ $payment->amount > 0 ? '+' : '' }}{{ number_format($payment->amount, 2) }} د.ك
                          </span>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0 text-dark">
                            {{ $payment->notes ?? 'لا توجد ملاحظات' }}
                          </p>
                          @if($payment->type == 'instructor_share' && $payment->notes)
                            <small class="text-muted">من دورة: {{ $payment->notes }}</small>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <div class="action-buttons">
                            @if(in_array($payment->type, ['instructor_payment', 'discount', 'refund']))
                              <button class="btn btn-sm btn-outline-primary" onclick="editTransaction({{ $payment->id }})" title="تعديل">
                                <i class="fas fa-edit"></i>
                              </button>
                              <button class="btn btn-sm btn-outline-danger" onclick="deleteTransaction({{ $payment->id }})" title="حذف">
                                <i class="fas fa-trash"></i>
                              </button>
                            @endif
                            @if($payment->amount > 0)
                              <button class="btn btn-sm btn-outline-success" onclick="generateReceipt({{ $payment->id }})" title="إيصال">
                                <i class="fas fa-receipt"></i>
                              </button>
                            @endif
                          </div>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                          <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                          <br>
                          <h6 class="text-muted">لا توجد معاملات مالية</h6>
                          <p class="text-muted">لم يتم العثور على أي معاملات مالية تطابق معايير البحث</p>
                        </td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="p-3">
                {{ $payments->withQueryString()->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Finance Page Content End -->

  <!-- Add Transaction Modal -->
  <div class="modal fade" id="addTransactionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-gradient-primary text-white">
          <h5 class="modal-title">
            <i class="fas fa-plus me-2"></i>إضافة معاملة مالية جديدة
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.transactions.store') }}" method="POST" id="transactionForm">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">نوع المعاملة</label>
                  <select name="type" class="form-select" id="transactionType" required>
                    <option value="">اختر نوع المعاملة</option>
                    <option value="student_fee">رسوم طالب</option>
                    <option value="package_fee">رسوم باقة</option>
                    <option value="instructor_payment">دفعة أستاذ</option>
                    <option value="discount">خصم</option>
                    <option value="refund">استرداد</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">المستخدم</label>
                  <select name="user_id" class="form-select" id="userSelect" required>
                    <option value="">اختر المستخدم</option>
                    @foreach($users as $user)
                      <option value="{{ $user->id }}" data-role="{{ $user->role }}">
                        {{ $user->name }} ({{ $user->role == 'student' ? 'طالب' : 'أستاذ' }})
                      </option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">المبلغ</label>
                  <div class="input-group">
                    <input type="number" name="amount" class="form-control" step="0.01" required>
                    <span class="input-group-text">د.ك</span>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label fw-bold">تاريخ المعاملة</label>
                  <input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
              </div>
            </div>
            
            <div class="mb-3">
              <label class="form-label fw-bold">الملاحظات</label>
              <textarea name="notes" class="form-control" rows="3" 
                        placeholder="أدخل تفاصيل المعاملة، مثل اسم الدورة أو الباقة أو سبب الخصم/الاسترداد..."></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times me-1"></i>إلغاء
            </button>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-1"></i>حفظ المعاملة
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
  <script>
    // Filter toggle functionality
    function toggleFilter(type) {
      // Remove active class from all buttons
      document.querySelectorAll('.filter-toggle').forEach(btn => {
        btn.classList.remove('active');
      });
      
      // Add active class to clicked button
      event.target.classList.add('active');
      
      // Here you can add AJAX filtering logic
      console.log('Filter type:', type);
    }
    
    // Dynamic form behavior
    document.getElementById('transactionType').addEventListener('change', function() {
      const type = this.value;
      const userSelect = document.getElementById('userSelect');
      const options = userSelect.querySelectorAll('option');
      
      // Reset user selection
      userSelect.value = '';
      
      // Filter users based on transaction type
      options.forEach(option => {
        if (option.value === '') return; // Skip placeholder
        
        const userRole = option.dataset.role;
        let showOption = true;
        
        switch(type) {
          case 'student_fee':
          case 'package_fee':
          case 'discount':
          case 'refund':
            showOption = userRole === 'student';
            break;
          case 'instructor_payment':
            showOption = userRole === 'teacher';
            break;
          default:
            showOption = true;
        }
        
        option.style.display = showOption ? '' : 'none';
      });
    });
    
    // Transaction actions
    function editTransaction(id) {
      // Create a modal for editing
      const modal = `
        <div class="modal fade" id="editTransactionModal" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                  <i class="fas fa-edit me-2"></i>تعديل المعاملة
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <form id="editTransactionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                  <div class="mb-3">
                    <label class="form-label fw-bold">المبلغ</label>
                    <div class="input-group">
                      <input type="number" name="amount" class="form-control" step="0.01" required>
                      <span class="input-group-text">د.ك</span>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">تاريخ المعاملة</label>
                    <input type="date" name="payment_date" class="form-control" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">الملاحظات</label>
                    <textarea name="notes" class="form-control" rows="3"></textarea>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>إلغاء
                  </button>
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>حفظ التعديلات
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      `;
      
      // Remove existing modal if any
      const existingModal = document.getElementById('editTransactionModal');
      if (existingModal) {
        existingModal.remove();
      }
      
      // Add modal to body
      document.body.insertAdjacentHTML('beforeend', modal);
      
      // Set form action
      document.getElementById('editTransactionForm').action = `/admin/transactions/${id}`;
      
      // Show modal
      const editModal = new bootstrap.Modal(document.getElementById('editTransactionModal'));
      editModal.show();
    }
    
    function deleteTransaction(id) {
      if (confirm('هل أنت متأكد من حذف هذه المعاملة؟ لا يمكن التراجع عن هذا الإجراء.')) {
        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/transactions/${id}`;
        form.innerHTML = `
          @csrf
          @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
      }
    }
    
    function generateReceipt(id) {
      // Redirect to receipt generation route
      window.open(`/admin/transactions/${id}/receipt`, '_blank');
    }
    
    // Add success message handling
    @if(session('success'))
      // Show success message
      const successAlert = document.createElement('div');
      successAlert.className = 'alert alert-success alert-dismissible fade show';
      successAlert.innerHTML = `
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      `;
      document.querySelector('.container-fluid').insertBefore(successAlert, document.querySelector('.mb-4'));
    @endif
    
    @if(session('error'))
      // Show error message
      const errorAlert = document.createElement('div');
      errorAlert.className = 'alert alert-danger alert-dismissible fade show';
      errorAlert.innerHTML = `
        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      `;
      document.querySelector('.container-fluid').insertBefore(errorAlert, document.querySelector('.mb-4'));
    @endif
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html> 