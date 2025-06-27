<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <title>Student Details - {{ $student->name }}</title>

  <!-- Fonts and CSS -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}">
  <link rel="stylesheet" href="{{ asset('css/admin-show-pages.css') }}">
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <style>
    .btn-danger.btn-sm {
      padding: 0.25rem 0.5rem;
      font-size: 0.875rem;
      border-radius: 0.2rem;
    }
    .btn-danger.btn-sm:hover {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    form[style*="display: inline"] {
      margin: 0;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')

  <main class="main-content position-relative border-radius-lg ">
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12" style="max-width:1000px;margin:auto;">
          
          <!-- Header Card -->
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="mb-0">Student Information</h4>
                  <p class="text-muted mb-0">View student details and information</p>
                </div>
                <div>
                  <a href="{{ route('admin.accounts.students.list') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                  </a>
                  <a href="{{ route('admin.accounts.students.edit', $student->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Student
                  </a>
                </div>
              </div>
            </div>
          </div>

          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle me-2"></i>
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i>
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <!-- Student Profile Card -->
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <div class="row">
                <!-- Student Photo -->
                <div class="col-md-3 text-center">
                  <img src="{{ asset($student->avatar ?? 'images/default-avatar.png') }}" 
                       class="avatar avatar-xxl rounded-circle mb-3"
                       onerror="this.src='{{ asset('images/default-avatar.png') }}'"
                       alt="{{ $student->name }}">
                  
                  <!-- Status Badge -->
                  <div class="mb-3">
                    @if($student->is_active == 1)
                      <span class="badge bg-success">Active</span>
                    @elseif($student->is_active == 2)
                      <span class="badge bg-info">Graduated</span>
                    @else
                      <span class="badge bg-danger">Inactive</span>
                    @endif
                  </div>

                  <!-- Student ID -->
                  <div class="text-center">
                    <h6 class="text-muted mb-1">Student ID</h6>
                    <h5 class="font-weight-bold text-primary">{{ $student->login_id }}</h5>
                  </div>
                </div>

                <!-- Student Information -->
                <div class="col-md-9">
                  <h4 class="mb-4">{{ $student->name }}</h4>
                  
                  <div class="row">
                    <!-- Personal Information -->
                    <div class="col-md-6">
                      <h6 class="text-uppercase text-muted mb-3">Personal Information</h6>
                      
                      <div class="mb-3">
                        <label class="form-label text-muted">Full Name</label>
                        <p class="font-weight-bold">{{ $student->name }}</p>
                      </div>

                      @if($student->father_name)
                      <div class="mb-3">
                        <label class="form-label text-muted">Father's Name</label>
                        <p class="font-weight-bold">{{ $student->father_name }}</p>
                      </div>
                      @endif

                      @if($student->mother_name)
                      <div class="mb-3">
                        <label class="form-label text-muted">Mother's Name</label>
                        <p class="font-weight-bold">{{ $student->mother_name }}</p>
                      </div>
                      @endif

                      @if($student->birth_date)
                      <div class="mb-3">
                        <label class="form-label text-muted">Birth Date</label>
                        <p class="font-weight-bold">{{ \Carbon\Carbon::parse($student->birth_date)->format('F d, Y') }}</p>
                      </div>
                      @endif

                      @if($student->national_id)
                      <div class="mb-3">
                        <label class="form-label text-muted">National ID</label>
                        <p class="font-weight-bold">{{ $student->national_id }}</p>
                      </div>
                      @endif
                    </div>

                    <!-- Contact Information -->
                    <div class="col-md-6">
                      <h6 class="text-uppercase text-muted mb-3">Contact Information</h6>
                      
                      <div class="mb-3">
                        <label class="form-label text-muted">Mobile Number</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-phone me-2 text-primary"></i>
                          {{ $student->mobile }}
                        </p>
                      </div>

                      @if($student->alt_mobile)
                      <div class="mb-3">
                        <label class="form-label text-muted">Alternative Mobile</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-phone me-2 text-secondary"></i>
                          {{ $student->alt_mobile }}
                        </p>
                      </div>
                      @endif

                      @if($student->email)
                      <div class="mb-3">
                        <label class="form-label text-muted">Email Address</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-envelope me-2 text-primary"></i>
                          {{ $student->email }}
                        </p>
                      </div>
                      @endif

                      @if($student->address)
                      <div class="mb-3">
                        <label class="form-label text-muted">Address</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                          {{ $student->address }}
                        </p>
                      </div>
                      @endif
                    </div>
                  </div>
                    </div>
                  </div>
                        </div>
                      </div>

     <!-- Account Information Card -->
     <div class="card shadow-sm mb-4">
            <div class="card-header">
              <h6 class="mb-0">Account Information</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label text-muted">Registration Date</label>
                  <p class="font-weight-bold">{{ $student->created_at->format('F d, Y') }}</p>
                </div>
                <div class="col-md-3">
                  <label class="form-label text-muted">Last Updated</label>
                  <p class="font-weight-bold">{{ $student->updated_at->format('F d, Y') }}</p>
                </div>
                <div class="col-md-3">
                  <label class="form-label text-muted">Login ID</label>
                  <p class="font-weight-bold text-primary">{{ $student->login_id }}</p>
                </div>
                <div class="col-md-3">
                  <label class="form-label text-muted">Password</label>
                  <div class="position-relative">
                    <input id="student-password" type="password" class="form-control font-weight-bold ps-4 pe-5 password-field" value="{{ $student->plain_password ?? '' }}" readonly>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" id="togglePassword">
                      <i class="fas fa-eye text-secondary"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Notes Section -->
          <div class="custom-card mb-4">
            <div class="custom-card-header d-flex justify-content-between align-items-center">
              <span>Notes</span>
              <button type="button" class="btn btn-main d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                <i class="fas fa-plus"></i> Add
              </button>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
                  <thead>
                    <tr>
                      <th>Added By</th>
                      <th>Note</th>
                      <th>Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse(($student->studentNotes ?? []) as $note)
                      <tr>
                        <td>
                          <span class="badge-custom badge-admin">{{ $note->admin->name ?? 'Admin' }}</span>
                        </td>
                        <td>{{ $note->note }}</td>
                        <td>{{ $note->created_at->format('Y-m-d') }}</td>
                        <td>
                          <form action="{{ route('admin.accounts.students.notes.delete', $note->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this note?')">
                              <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4" class="text-center text-muted">No notes found.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Student Enrollments Section -->
          <div class="custom-card mb-4">
            <div class="custom-card-header d-flex justify-content-between align-items-center">
              <span>Student Enrollments</span>
              <a href="{{ route('admin.accounts.students.courses.select', $student->id) }}" class="btn btn-main d-flex align-items-center gap-2">
                <i class="fas fa-plus"></i> إضافة كورس/مسار
              </a>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
                  <thead>
                    <tr>
                      <th>اسم المادة</th>
                      <th>مسارها</th>
                      <th>أستاذها</th>
                      <th>تاريخ التسجيل</th>
                      <th>الحضور والغياب</th>
                      <th>الإجراءات</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- الكورسات --}}
                    @foreach($enrollments as $enrollment)
                      <tr>
                        <td>{{ $enrollment->course->title ?? '-' }}</td>
                        <td>{{ $enrollment->course->category->name ?? '-' }}</td>
                        <td>
                          @if($enrollment->course && $enrollment->course->courseInstructors->count())
                            {{ $enrollment->course->courseInstructors->first()->instructor->name }}
                          @else
                            -
                          @endif
                        </td>
                        <td>{{ $enrollment->enrollment_date }}</td>
                        <td>
                          <button class="btn btn-attendance">
                            <i class="fas fa-calendar-check"></i> عرض الحضور
                          </button>
                        </td>
                        <td>
                          <form action="{{ route('admin.accounts.students.courses.unenroll', ['studentId' => $student->id, 'enrollmentId' => $enrollment->id]) }}" 
                                method="POST" 
                                style="display: inline;"
                                onsubmit="return confirm('هل أنت متأكد من حذف الكورس \'{{ $enrollment->course->title ?? 'الكورس' }}\'؟ سيتم استرداد المبلغ المدفوع.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fas fa-trash"></i> حذف
                            </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach

                    {{-- البكجات --}}
                    @foreach($studentPackages as $sp)
                      <tr>
                        <td>{{ $sp->package->title ?? '-' }}</td>
                        <td>
                          @if($sp->package && $sp->package->packageCourses->count())
                            @foreach($sp->package->packageCourses as $pc)
                              {{ $pc->course->title }}{{ !$loop->last ? ',' : '' }}
                            @endforeach
                          @else
                            -
                          @endif
                        </td>
                        <td>-</td>
                        <td>{{ $sp->purchase_date }}</td>
                        <td>
                          <button class="btn btn-attendance">
                            <i class="fas fa-calendar-check"></i> عرض الحضور
                          </button>
                        </td>
                        <td>
                          <form action="{{ route('admin.accounts.students.packages.unenroll', ['studentId' => $student->id, 'packageId' => $sp->id]) }}" 
                                method="POST" 
                                style="display: inline;"
                                onsubmit="return confirm('هل أنت متأكد من حذف الباقة \'{{ $sp->package->title ?? 'الباقة' }}\'؟ سيتم استرداد المبلغ المدفوع.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fas fa-trash"></i> حذف
                            </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach

                    @if($enrollments->isEmpty() && $studentPackages->isEmpty())
                      <tr>
                        <td colspan="6" class="text-center text-muted">لا يوجد تسجيلات بعد.</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Class Schedule Section -->
          <div class="custom-card mb-4">
            <div class="custom-card-header d-flex justify-content-between align-items-center">
              <span>Class Schedule</span>
              <button onclick="printScheduleTable()" class="btn btn-main d-flex align-items-center gap-2">
                <i class="fas fa-print"></i> Print
              </button>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table" id="schedule-table-print">
                  <thead>
                    <tr>
                      <th>اليوم \ الوقت</th>
                      <th>09:00 - 10:30</th>
                      <th>10:45 - 12:15</th>
                      <th>12:30 - 14:00</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>السبت</td>
                      <td>عربي<br><span style="font-size:0.93em; color:#28a745;">قاعة 1</span></td>
                      <td>رياضيات<br><span style="font-size:0.93em; color:#28a745;">قاعة 2</span></td>
                      <td>فيزياء<br><span style="font-size:0.93em; color:#28a745;">قاعة 3</span></td>
                    </tr>
                    <tr>
                      <td>الأحد</td>
                      <td>رياضيات<br><span style="font-size:0.93em; color:#28a745;">قاعة 2</span></td>
                      <td>عربي<br><span style="font-size:0.93em; color:#28a745;">قاعة 1</span></td>
                      <td>فيزياء<br><span style="font-size:0.93em; color:#28a745;">قاعة 3</span></td>
                    </tr>
                    <tr>
                      <td>الاثنين</td>
                      <td>عربي<br><span style="font-size:0.93em; color:#28a745;">قاعة 1</span></td>
                      <td>رياضيات<br><span style="font-size:0.93em; color:#28a745;">قاعة 2</span></td>
                      <td>فيزياء<br><span style="font-size:0.93em; color:#28a745;">قاعة 3</span></td>
                    </tr>
                    <tr>
                      <td>الثلاثاء</td>
                      <td>فيزياء<br><span style="font-size:0.93em; color:#28a745;">قاعة 3</span></td>
                      <td>عربي<br><span style="font-size:0.93em; color:#28a745;">قاعة 1</span></td>
                      <td>رياضيات<br><span style="font-size:0.93em; color:#28a745;">قاعة 2</span></td>
                    </tr>
                    <tr>
                      <td>الأربعاء</td>
                      <td>رياضيات<br><span style="font-size:0.93em; color:#28a745;">قاعة 2</span></td>
                      <td>فيزياء<br><span style="font-size:0.93em; color:#28a745;">قاعة 3</span></td>
                      <td>عربي<br><span style="font-size:0.93em; color:#28a745;">قاعة 1</span></td>
                    </tr>
                    <tr>
                      <td>الخميس</td>
                      <td>عربي<br><span style="font-size:0.93em; color:#28a745;">قاعة 1</span></td>
                      <td>رياضيات<br><span style="font-size:0.93em; color:#28a745;">قاعة 2</span></td>
                      <td>فيزياء<br><span style="font-size:0.93em; color:#28a745;">قاعة 3</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Three Simple Boxes Section -->
          <div class="row mb-4 stats-boxes-row">
            <div class="col-12 col-md-3 mb-3 mb-md-0">
              <div class="stats-box text-center">
                <div class="stats-icon mb-1">
                  <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stats-title">Total Courses</div>
                <div class="stats-value text-primary">{{ $enrollments->count() }}</div>
                <div class="stats-desc">Enrolled Courses</div>
              </div>
            </div>
            <div class="col-12 col-md-3 mb-3 mb-md-0">
              <div class="stats-box text-center">
                <div class="stats-icon mb-1">
                  <i class="fas fa-box"></i>
                </div>
                <div class="stats-title">Total Packages</div>
                <div class="stats-value text-info">{{ $studentPackages->count() }}</div>
                <div class="stats-desc">Enrolled Packages</div>
              </div>
            </div>
            <div class="col-12 col-md-3 mb-3 mb-md-0">
              <div class="stats-box text-center">
                <div class="stats-icon mb-1">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stats-title">Total Paid</div>
                <div class="stats-value text-warning">${{ number_format(abs($payments->where('amount', '<', 0)->sum('amount')), 2) }}</div>
                <div class="stats-desc">All Time</div>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <div class="stats-box text-center">
                <div class="stats-icon mb-1">
                  <i class="fas fa-wallet"></i>
                </div>
                <div class="stats-title">Current Balance</div>
                <div class="stats-value {{ $totalBalance >= 0 ? 'text-success' : 'text-danger' }}">${{ number_format($totalBalance, 2) }}</div>
                <div class="stats-desc">Account Balance</div>
              </div>
            </div>
          </div>

          <!-- Transaction History Section -->
          <div class="custom-card mb-4">
            <div class="custom-card-header d-flex justify-content-between align-items-center">
              <span>Transaction History</span>
              <div class="d-flex align-items-center gap-2 flex-wrap filter-bar">
                <!-- Dropdown for years -->
                <div class="dropdown">
                  <button class="filter-btn dropdown-toggle" type="button" id="yearDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span id="selectedYear">All Year</span> <i class="fas fa-chevron-down ms-1"></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="yearDropdown">
                    <li><a class="dropdown-item year-option" href="#" data-year="all">All Year</a></li>
                    <li><a class="dropdown-item year-option" href="#" data-year="2024">2024</a></li>
                    <li><a class="dropdown-item year-option" href="#" data-year="2023">2023</a></li>
                    <li><a class="dropdown-item year-option" href="#" data-year="2022">2022</a></li>
                  </ul>
                </div>
                <!-- Month picker -->
                <input type="month" class="filter-input" id="monthPicker" placeholder="شهر/سنة yyyy">
              </div>
            </div>
            <div class="custom-card-body p-0">
              <div class="table-responsive">
                <table class="table mb-0 transaction-table">
                  <thead>
                    <tr>
                      <th>DATE</th>
                      <th>DESCRIPTION</th>
                      <th>TYPE</th>
                      <th>AMOUNT</th>
                      <th>STATUS</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($payments as $payment)
                    <tr>
                      <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') : $payment->created_at->format('d/m/Y') }}</td>
                      <td>{{ $payment->notes }}</td>
                      <td>
                        <span style="background:{{ $payment->amount > 0 ? '#10b981' : '#ef4444' }}; color:#fff; border-radius:8px; font-weight:600; padding:4px 18px; font-size:1em;">
                          {{ $payment->amount > 0 ? 'INCOME' : 'EXPENSE' }}
                        </span>
                      </td>
                      <td style="font-weight:600; color:{{ $payment->amount > 0 ? '#10b981' : '#ef4444' }};">
                        {{ $payment->amount > 0 ? '+' : '-' }}${{ number_format(abs($payment->amount), 2) }}
                      </td>
                      <td><span style="background:#14b8a6; color:#fff; border-radius:8px; font-weight:600; padding:4px 18px; font-size:1em;">COMPLETED</span></td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="5" class="text-center text-muted">No transactions found.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <form action="{{ route('admin.accounts.students.destroy', $student->id) }}" 
                        method="POST" 
                        onsubmit="return confirmDelete('{{ $student->name }}')"
                        style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                      <i class="fas fa-trash"></i> Delete Student
                    </button>
                  </form>
                </div>
                <div>
                  <a href="{{ route('admin.accounts.students.courses.select', $student->id) }}" class="btn btn-success me-2">
                    <i class="fas fa-plus"></i> Add Course
                  </a>
                  <a href="{{ route('admin.accounts.students.list') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-list"></i> Back to List
                  </a>
                  <a href="{{ route('admin.accounts.students.edit', $student->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Student
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>

  <!-- Modals -->
  <!-- Modal لإضافة ملاحظة -->
<div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addNoteModalLabel">Add Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.accounts.students.notes.add', $student->id) }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="noteText" class="form-label">Note</label>
            <textarea class="form-control" id="noteText" name="note" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal تأكيد حذف الملاحظة -->
<div class="modal fade" id="confirmDeleteNoteModal" tabindex="-1" aria-labelledby="confirmDeleteNoteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteNoteModalLabel">تأكيد الحذف</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        هل أنت متأكد أنك تريد حذف هذه الملاحظة؟ لا يمكن التراجع عن هذا الإجراء.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteNoteBtn">حذف</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal للحضور والغياب -->
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attendanceModalLabel">سجل الحضور والغياب</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-md-4">
            <strong>المادة:</strong> <span id="modalCourse"></span>
          </div>
          <div class="col-md-4">
            <strong>الأستاذ:</strong> <span id="modalTeacher"></span>
          </div>
          <div class="col-md-4">
            <strong>المسار:</strong> <span id="modalTrack"></span>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>التاريخ</th>
                <th>اليوم</th>
                <th>الوقت</th>
                <th>الحالة</th>
                <th>ملاحظات</th>
              </tr>
            </thead>
            <tbody id="attendanceTableBody">
              <!-- سيتم ملؤها بالجافا سكريبت -->
            </tbody>
          </table>
        </div>
        <div class="row mt-3">
          <div class="col-md-6">
            <div class="card bg-light">
              <div class="card-body">
                <h6 class="card-title">إحصائيات الحضور</h6>
                <div class="row">
                  <div class="col-6">
                    <div class="text-center">
                      <div class="h4 text-success" id="presentCount">0</div>
                      <small class="text-muted">حضور</small>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="text-center">
                      <div class="h4 text-danger" id="absentCount">0</div>
                      <small class="text-muted">غياب</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card bg-light">
              <div class="card-body">
                <h6 class="card-title">نسبة الحضور</h6>
                <div class="text-center">
                  <div class="h4 text-primary" id="attendancePercentage">0%</div>
                  <div class="progress mt-2">
                    <div class="progress-bar bg-success" id="attendanceProgress" role="progressbar" style="width: 0%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
        <button type="button" class="btn btn-primary" onclick="printAttendanceReport()">
          <i class="fas fa-print"></i> طباعة التقرير
        </button>
      </div>
    </div>
  </div>
</div>
<!-- مودال إضافة كورس أو بكيج مع تفاصيل -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCourseModalLabel">إضافة كورس أو مسار</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body">
        <form onsubmit="event.preventDefault(); confirmAddCourse();">
          <!-- نوع التسجيل -->
          <div class="mb-3">
            <label class="form-label">نوع التسجيل</label>
            <select class="form-select" id="enrollType" onchange="toggleEnrollTypeDetails()">
              <option value="course">كورس</option>
              <option value="package">بكيج</option>
            </select>
          </div>
          <!-- اختيار الكورس -->
          <div class="mb-3" id="courseBox">
            <label class="form-label">اختر الكورس</label>
            <select class="form-select" id="courseSelect" onchange="showCourseDetails()">
              <option value="">-- اختر --</option>
              <option value="1">عربي</option>
              <option value="2">رياضيات</option>
              <option value="3">فيزياء</option>
            </select>
            <div id="courseDetails" class="mt-2" style="display:none;">
              <div class="border rounded p-2 bg-light">
                <div><b>الأستاذ:</b> <span id="courseTeacher"></span></div>
                <div><b>السعر:</b> <span id="coursePrice"></span></div>
                <div><b>الوصف:</b> <span id="courseDesc"></span></div>
              </div>
            </div>
          </div>
          <!-- اختيار البكيج -->
          <div class="mb-3 d-none" id="packageBox">
            <label class="form-label">اختر البكيج</label>
            <select class="form-select" id="packageSelect" onchange="showPackageDetails()">
              <option value="">-- اختر --</option>
              <option value="1">بكيج التاسع</option>
              <option value="2">بكيج الحادي عشر</option>
            </select>
            <div id="packageDetails" class="mt-2" style="display:none;">
              <div class="border rounded p-2 bg-light">
                <div><b>عدد الكورسات:</b> <span id="packageCourses"></span></div>
                <div><b>السعر:</b> <span id="packagePrice"></span></div>
                <div><b>الوصف:</b> <span id="packageDesc"></span></div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success w-100 mt-3">تأكيد الإضافة</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- مودال تأكيد الإضافة -->
<div class="modal fade" id="confirmAddModal" tabindex="-1" aria-labelledby="confirmAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmAddModalLabel">تمت الإضافة بنجاح</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
      </div>
      <div class="modal-body text-center">
        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
        <div>تمت إضافة الكورس/المسار للطالب بنجاح (وهمي - فرونت فقط)</div>
      </div>
    </div>
  </div>
</div>

  <!-- Scripts -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
  
  <script>
    function confirmDelete(studentName) {
      return confirm(`Are you sure you want to delete the student "${studentName}"?\n\nThis action cannot be undone.`);
    }
    
    // Password show/hide
    document.addEventListener('DOMContentLoaded', function() {
      const toggleBtn = document.getElementById('togglePassword');
      const pwdInput = document.getElementById('student-password');
      if(toggleBtn && pwdInput) {
        toggleBtn.addEventListener('click', function() {
          if (pwdInput.type === 'password') {
            pwdInput.type = 'text';
            this.innerHTML = '<i class="fas fa-eye-slash text-secondary"></i>';
          } else {
            pwdInput.type = 'password';
            this.innerHTML = '<i class="fas fa-eye text-secondary"></i>';
          }
        });
      }

      // Attendance Modal Functionality
      const attendanceModal = document.getElementById('attendanceModal');
      if (attendanceModal) {
        attendanceModal.addEventListener('show.bs.modal', function (event) {
          const button = event.relatedTarget;
          const course = button.getAttribute('data-course');
          const teacher = button.getAttribute('data-teacher');
          const track = button.getAttribute('data-track');
          
          // Set modal header information
          document.getElementById('modalCourse').textContent = course;
          document.getElementById('modalTeacher').textContent = teacher;
          document.getElementById('modalTrack').textContent = track;
          
          // Generate sample attendance data
          generateAttendanceData(course);
        });
      }
    });

    // Sample attendance data generator
    function generateAttendanceData(course) {
      const attendanceData = {
        'عربي': [
          { date: '2024-06-20', day: 'الخميس', time: '09:00 - 10:30', status: 'حاضر', notes: '' },
          { date: '2024-06-19', day: 'الأربعاء', time: '09:00 - 10:30', status: 'غائب', notes: 'عذر طبي' },
          { date: '2024-06-18', day: 'الثلاثاء', time: '09:00 - 10:30', status: 'حاضر', notes: '' },
          { date: '2024-06-17', day: 'الاثنين', time: '09:00 - 10:30', status: 'حاضر', notes: '' },
          { date: '2024-06-16', day: 'الأحد', time: '09:00 - 10:30', status: 'غائب', notes: 'سفر' },
          { date: '2024-06-15', day: 'السبت', time: '09:00 - 10:30', status: 'حاضر', notes: '' }
        ],
        'رياضيات': [
          { date: '2024-06-20', day: 'الخميس', time: '10:45 - 12:15', status: 'حاضر', notes: '' },
          { date: '2024-06-19', day: 'الأربعاء', time: '10:45 - 12:15', status: 'حاضر', notes: '' },
          { date: '2024-06-18', day: 'الثلاثاء', time: '10:45 - 12:15', status: 'غائب', notes: 'مرض' },
          { date: '2024-06-17', day: 'الاثنين', time: '10:45 - 12:15', status: 'حاضر', notes: '' },
          { date: '2024-06-16', day: 'الأحد', time: '10:45 - 12:15', status: 'حاضر', notes: '' },
          { date: '2024-06-15', day: 'السبت', time: '10:45 - 12:15', status: 'حاضر', notes: '' }
        ],
        'فيزياء': [
          { date: '2024-06-20', day: 'الخميس', time: '12:30 - 14:00', status: 'حاضر', notes: '' },
          { date: '2024-06-19', day: 'الأربعاء', time: '12:30 - 14:00', status: 'حاضر', notes: '' },
          { date: '2024-06-18', day: 'الثلاثاء', time: '12:30 - 14:00', status: 'حاضر', notes: '' },
          { date: '2024-06-17', day: 'الاثنين', time: '12:30 - 14:00', status: 'غائب', notes: 'موعد طبي' },
          { date: '2024-06-16', day: 'الأحد', time: '12:30 - 14:00', status: 'حاضر', notes: '' },
          { date: '2024-06-15', day: 'السبت', time: '12:30 - 14:00', status: 'حاضر', notes: '' }
        ]
      };

      const data = attendanceData[course] || [];
      const tableBody = document.getElementById('attendanceTableBody');
      tableBody.innerHTML = '';

      let presentCount = 0;
      let absentCount = 0;

      data.forEach(record => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${record.date}</td>
          <td>${record.day}</td>
          <td>${record.time}</td>
          <td>
            <span class="badge ${record.status === 'حاضر' ? 'bg-success' : 'bg-danger'}">
              ${record.status}
            </span>
          </td>
          <td>${record.notes || '-'}</td>
        `;
        tableBody.appendChild(row);

        if (record.status === 'حاضر') {
          presentCount++;
        } else {
          absentCount++;
        }
      });

      // Update statistics
      document.getElementById('presentCount').textContent = presentCount;
      document.getElementById('absentCount').textContent = absentCount;
      
      const total = presentCount + absentCount;
      const percentage = total > 0 ? Math.round((presentCount / total) * 100) : 0;
      document.getElementById('attendancePercentage').textContent = percentage + '%';
      document.getElementById('attendanceProgress').style.width = percentage + '%';
    }

    // Print attendance report
    function printAttendanceReport() {
      const course = document.getElementById('modalCourse').textContent;
      const teacher = document.getElementById('modalTeacher').textContent;
      const track = document.getElementById('modalTrack').textContent;
      const presentCount = document.getElementById('presentCount').textContent;
      const absentCount = document.getElementById('absentCount').textContent;
      const percentage = document.getElementById('attendancePercentage').textContent;

      const win = window.open('', '', 'height=700,width=900');
      win.document.write('<html><head><title>تقرير الحضور والغياب</title>');
      win.document.write('<style>body{font-family:Tahoma,Arial,sans-serif; direction:rtl;} table{width:100%;border-collapse:collapse;} th,td{border:1px solid #ddd;padding:8px;text-align:center;} th{background:#f2f2f2;} .header{text-align:center;margin-bottom:20px;} .stats{display:flex;justify-content:space-around;margin:20px 0;}</style>');
      win.document.write('</head><body>');
      win.document.write('<div class="header">');
      win.document.write('<h2>تقرير الحضور والغياب</h2>');
      win.document.write(`<p><strong>الطالب:</strong> {{ $student->name }} | <strong>المادة:</strong> ${course} | <strong>الأستاذ:</strong> ${teacher} | <strong>المسار:</strong> ${track}</p>`);
      win.document.write('</div>');
      
      win.document.write('<div class="stats">');
      win.document.write(`<div><strong>عدد الحضور:</strong> ${presentCount}</div>`);
      win.document.write(`<div><strong>عدد الغياب:</strong> ${absentCount}</div>`);
      win.document.write(`<div><strong>نسبة الحضور:</strong> ${percentage}</div>`);
      win.document.write('</div>');
      
      win.document.write(document.querySelector('#attendanceModal .table-responsive table').outerHTML);
      win.document.write('</body></html>');
      win.document.close();
      win.focus();
      setTimeout(function(){ win.print(); win.close(); }, 400);
    }

    // Print schedule table
    function printScheduleTable() {
      var table = document.getElementById('schedule-table-print');
      var win = window.open('', '', 'height=700,width=900');
      win.document.write('<html><head><title>Class Schedule</title>');
      win.document.write('<style>body{font-family:Tahoma,Arial,sans-serif;} table{width:100%;border-collapse:collapse;} th,td{border:1px solid #e3eaf1;padding:10px;text-align:center;font-size:1.1em;} th{background:#eaf3fb;color:#2266aa;} caption{font-size:1.3em;font-weight:bold;margin-bottom:15px;}</style>');
      win.document.write('</head><body>');
      win.document.write('<caption>Class Schedule</caption>');
      win.document.write(table.outerHTML);
      win.document.write('</body></html>');
      win.document.close();
      win.focus();
      setTimeout(function(){ win.print(); win.close(); }, 400);
    }

    // Note deletion functionality
    let noteRowToDelete = null;
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.btn-delete-note').forEach(function(btn) {
        btn.addEventListener('click', function() {
          noteRowToDelete = this.closest('tr');
          var modal = new bootstrap.Modal(document.getElementById('confirmDeleteNoteModal'));
          modal.show();
        });
      });
      document.getElementById('confirmDeleteNoteBtn').addEventListener('click', function() {
        if(noteRowToDelete) {
          noteRowToDelete.remove();
          noteRowToDelete = null;
        }
        var modal = bootstrap.Modal.getInstance(document.getElementById('confirmDeleteNoteModal'));
        modal.hide();
      });
    });

    // Course/package management
    const courses = {
      1: { teacher: 'أ. محمد', price: '1500 SYP', desc: 'دورة عربي مكثفة' },
      2: { teacher: 'أ. أحمد', price: '1200 SYP', desc: 'دورة رياضيات تأسيسية' },
      3: { teacher: 'أ. سامر', price: '2000 SYP', desc: 'دورة فيزياء متقدمة' }
    };
    const packages = {
      1: { courses: 'عربي، رياضيات، فيزياء', price: '4000 SYP', desc: 'بكيج التاسع لجميع المواد' },
      2: { courses: 'فيزياء، كيمياء', price: '3000 SYP', desc: 'بكيج الحادي عشر العلمي' }
    };

    function toggleEnrollTypeDetails() {
      var type = document.getElementById('enrollType').value;
      document.getElementById('courseBox').classList.toggle('d-none', type !== 'course');
      document.getElementById('packageBox').classList.toggle('d-none', type !== 'package');
    }

    function showCourseDetails() {
      var val = document.getElementById('courseSelect').value;
      var details = document.getElementById('courseDetails');
      if (courses[val]) {
        document.getElementById('courseTeacher').textContent = courses[val].teacher;
        document.getElementById('coursePrice').textContent = courses[val].price;
        document.getElementById('courseDesc').textContent = courses[val].desc;
        details.style.display = '';
      } else {
        details.style.display = 'none';
      }
    }

    function showPackageDetails() {
      var val = document.getElementById('packageSelect').value;
      var details = document.getElementById('packageDetails');
      if (packages[val]) {
        document.getElementById('packageCourses').textContent = packages[val].courses;
        document.getElementById('packagePrice').textContent = packages[val].price;
        document.getElementById('packageDesc').textContent = packages[val].desc;
        details.style.display = '';
      } else {
        details.style.display = 'none';
      }
    }

    function confirmAddCourse() {
      var modal = new bootstrap.Modal(document.getElementById('confirmAddModal'));
      modal.show();
    }

    // Dropdown year selection
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.year-option').forEach(function(item) {
        item.addEventListener('click', function(e) {
          e.preventDefault();
          var year = this.getAttribute('data-year');
          document.getElementById('selectedYear').textContent = (year === 'all') ? 'All Year' : year;
        });
      });
    });
  </script>

  <!-- Modal تأكيد حذف الكورس -->
  <div class="modal fade" id="confirmDeleteCourseModal" tabindex="-1" aria-labelledby="confirmDeleteCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteCourseModalLabel">تأكيد حذف الكورس</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>هل أنت متأكد من حذف هذا الكورس؟</p>
          <p class="text-warning"><strong>سيتم استرداد المبلغ المدفوع للطالب.</strong></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteCourseBtn">حذف الكورس</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal تأكيد حذف الباقة -->
  <div class="modal fade" id="confirmDeletePackageModal" tabindex="-1" aria-labelledby="confirmDeletePackageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeletePackageModalLabel">تأكيد حذف الباقة</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>هل أنت متأكد من حذف هذه الباقة؟</p>
          <p class="text-warning"><strong>سيتم استرداد المبلغ المدفوع للطالب.</strong></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
          <button type="button" class="btn btn-danger" id="confirmDeletePackageBtn">حذف الباقة</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>