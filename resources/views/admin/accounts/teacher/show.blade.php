<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <title>Teacher Details - {{ $teacher->name }}</title>

  <!-- Fonts and CSS -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}">
  <link rel="stylesheet" href="{{ asset('css/admin-show-pages.css') }}">
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
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
                  <h4 class="mb-0">Teacher Profile Details</h4>
                  <p class="text-muted mb-0">View comprehensive teacher information and account details</p>
                </div>
                <div>
                  <a href="{{ route('admin.accounts.teachers.list') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Teachers List
                  </a>
                  <a href="{{ route('admin.accounts.teachers.edit', $teacher->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Teacher
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

          <!-- Teacher Profile Card -->
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <div class="row">
                <!-- Teacher Photo -->
                <div class="col-md-3 text-center">
                  <img src="{{ asset($teacher->avatar ?? 'images/default-avatar.png') }}" 
                       class="avatar avatar-xxl rounded-circle mb-3"
                       onerror="this.src='{{ asset('images/default-avatar.png') }}'"
                       alt="{{ $teacher->name }}">
                  
                  <!-- Status Badge -->
                  <div class="mb-3">
                    @if($teacher->is_active == 1)
                      <span class="badge bg-success">Active</span>
                    @elseif($teacher->is_active == 2)
                      <span class="badge bg-info">Experienced</span>
                    @else
                      <span class="badge bg-danger">Inactive</span>
                    @endif
                  </div>

                  <!-- Teacher ID -->
                  <div class="text-center">
                    <h6 class="text-muted mb-1">Teacher ID</h6>
                    <h5 class="font-weight-bold text-primary">{{ $teacher->login_id }}</h5>
                  </div>
                </div>

                <!-- Teacher Information -->
                <div class="col-md-9">
                  <h4 class="mb-4">{{ $teacher->name }}</h4>
                  
                  <div class="row">
                    <!-- Personal Information -->
                    <div class="col-md-6">
                      <h6 class="text-uppercase text-muted mb-3">Personal Information</h6>
                      
                      <div class="mb-3">
                        <label class="form-label text-muted">Full Name</label>
                        <p class="font-weight-bold">{{ $teacher->name }}</p>
                      </div>

                      @if($teacher->father_name)
                      <div class="mb-3">
                        <label class="form-label text-muted">Father's Name</label>
                        <p class="font-weight-bold">{{ $teacher->father_name }}</p>
                      </div>
                      @endif

                      @if($teacher->mother_name)
                      <div class="mb-3">
                        <label class="form-label text-muted">Mother's Name</label>
                        <p class="font-weight-bold">{{ $teacher->mother_name }}</p>
                      </div>
                      @endif

                      @if($teacher->birth_date)
                      <div class="mb-3">
                        <label class="form-label text-muted">Birth Date</label>
                        <p class="font-weight-bold">{{ \Carbon\Carbon::parse($teacher->birth_date)->format('F d, Y') }}</p>
                      </div>
                      @endif

                      @if($teacher->national_id)
                      <div class="mb-3">
                        <label class="form-label text-muted">National ID</label>
                        <p class="font-weight-bold">{{ $teacher->national_id }}</p>
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
                          {{ $teacher->mobile }}
                        </p>
                      </div>

                      @if($teacher->alt_mobile)
                      <div class="mb-3">
                        <label class="form-label text-muted">Alternative Mobile</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-phone me-2 text-secondary"></i>
                          {{ $teacher->alt_mobile }}
                        </p>
                      </div>
                      @endif

                      @if($teacher->email)
                      <div class="mb-3">
                        <label class="form-label text-muted">Email Address</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-envelope me-2 text-primary"></i>
                          {{ $teacher->email }}
                        </p>
                      </div>
                      @endif

                      @if($teacher->address)
                      <div class="mb-3">
                        <label class="form-label text-muted">Address</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                          {{ $teacher->address }}
                        </p>
                      </div>
                      @endif
                    </div>
                  </div>

                  <!-- Professional Information -->
                  @if($teacher->qualification || $teacher->experience_years)
                  <div class="row mt-4">
                    <div class="col-12">
                      <h6 class="text-uppercase text-muted mb-3">Professional Information</h6>
                      <div class="row">
                        @if($teacher->qualification)
                        <div class="col-md-4">
                          <label class="form-label text-muted">Qualification</label>
                          <p class="font-weight-bold">
                            <i class="fas fa-certificate me-2 text-warning"></i>
                            {{ $teacher->qualification }}
                          </p>
                        </div>
                        @endif

                        @if($teacher->experience_years)
                        <div class="col-md-4">
                          <label class="form-label text-muted">Experience</label>
                          <p class="font-weight-bold">
                            <i class="fas fa-clock me-2 text-success"></i>
                            {{ $teacher->experience_years }} years
                          </p>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                  @endif

                  <!-- Additional Information -->
                  @if($teacher->notes)
                  <div class="row mt-4">
                  
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <!-- تحسين ستايل البادجات والجداول والتحريك في الموبايل -->
          <!-- CSS styles moved to external file: admin-show-pages.css -->

          <!-- Account Information Card -->
          <div class="card shadow-sm mb-4">
            <div class="card-header">
              <h6 class="mb-0">Account Details</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label text-muted">Registration Date</label>
                  <p class="font-weight-bold">{{ $teacher->created_at->format('F d, Y') }}</p>
                </div>
                <div class="col-md-3">
                  <label class="form-label text-muted">Last Updated</label>
                  <p class="font-weight-bold">{{ $teacher->updated_at->format('F d, Y') }}</p>
                </div>
                <div class="col-md-3">
                  <label class="form-label text-muted">Login ID</label>
                  <p class="font-weight-bold text-primary">{{ $teacher->login_id }}</p>
                </div>
                <div class="col-md-3">
                  <label class="form-label text-muted">Password</label>
                  <div class="position-relative">
                    <input id="teacher-password" type="password" class="form-control font-weight-bold ps-4 pe-5 password-field" value="{{ $teacher->plain_password ?? '' }}" readonly>
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
              <span>Teacher Notes</span>
              <button type="button" class="btn btn-main d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                <i class="fas fa-plus"></i> Add Note
              </button>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
                  <thead>
                    <tr>
                      <th>Added By</th>
                      <th>Note Content</th>
                      <th>Date Added</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><span class="badge-custom badge-admin">الإدارة</span></td>
                      <td>مدرس ممتاز ومتفاني في عمله</td>
                      <td>2024-06-20</td>
                      <td><button class="btn btn-sm btn-outline-danger btn-delete-note"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                      <td><span class="badge-custom badge-user">أ. أحمد</span></td>
                      <td>يحتاج إلى تحسين في إدارة الوقت</td>
                      <td>2024-06-19</td>
                      <td><button class="btn btn-sm btn-outline-danger btn-delete-note"><i class="fas fa-trash"></i></button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Teacher Courses Section -->
          <div class="custom-card mb-4">
            <div class="custom-card-header d-flex justify-content-between align-items-center">
              <span>Assigned Courses</span>
              <button type="button" class="btn btn-main d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                <i class="fas fa-plus"></i> Add Course
              </button>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
                  <thead>
                    <tr>
                      <th>Course Name</th>
                      <th>Category</th>
                      <th>Students Count</th>
                      <th>Start Date</th>
                      <th>Attendance</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($coursesTaught as $courseInstructor)
                      @php $course = $courseInstructor->course; @endphp
                      <tr>
                        <td>{{ $course->title ?? '-' }}</td>
                        <td>{{ $course->category->name ?? '-' }}</td>
                        <td>{{ $course->enrollments->count() }} students</td>
                        <td>{{ $course->schedules->min('session_date') ?? '-' }}</td>
                        <td>
                          <button class="btn btn-attendance" data-bs-toggle="modal" data-bs-target="#attendanceModal" data-course="{{ $course->title }}">
                          <i class="fas fa-users"></i> View Attendance
                        </button>
                      </td>
                    </tr>
                    @empty
                      <tr>
                        <td colspan="5" class="text-center text-muted">No courses assigned to this teacher.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- جدول حصص الأستاذ -->
          <div class="custom-card mb-4">
            <div class="custom-card-header d-flex justify-content-between align-items-center">
              <span><i class="fas fa-calendar-alt me-2"></i>Class Schedule</span>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Day</th>
                      <th>Time</th>
                      <th>Course</th>
                      <th>Room</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($allSchedules as $sch)
                      <tr>
                        <td>{{ $sch['session_date'] }}</td>
                        <td>{{ ucfirst($sch['day_of_week']) }}</td>
                        <td>{{ substr($sch['start_time'],0,5) }} - {{ substr($sch['end_time'],0,5) }}</td>
                        <td>{{ $sch['course'] }}</td>
                        <td>{{ $sch['room'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No schedule found for this teacher.</td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Three Simple Boxes Section -->
          <div class="row mb-4 stats-boxes-row">
            <div class="col-12 col-md-4 mb-3 mb-md-0">
              <div class="stats-box text-center">
                <div class="stats-icon mb-1">
                  <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stats-title">Total Courses</div>
                <div class="stats-value text-primary">3</div>
                <div class="stats-desc">Assigned Courses</div>
              </div>
            </div>
            <div class="col-12 col-md-4 mb-3 mb-md-0">
              <div class="stats-box text-center">
                <div class="stats-icon mb-1">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stats-title">Attendance Rate</div>
                <div class="stats-value text-success">85%</div>
                <div class="stats-desc">This Month</div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="stats-box text-center">
                <div class="stats-icon mb-1">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stats-title">Total Paid</div>
                <div class="stats-value text-warning">$3,000</div>
                <div class="stats-desc">All Time</div>
              </div>
            </div>
          </div>

          <!-- Transaction History Section -->
          <div class="custom-card mb-4">
            <div class="custom-card-header d-flex justify-content-between align-items-center">
              <span>Financial Transaction History</span>
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
                    @forelse($latestPayments as $payment)
                      <tr>
                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</td>
                        <td>{{ $payment->description ?? $payment->notes ?? '-' }}</td>
                        <td>
                          @if($payment->type == 'income' || $payment->type == 'instructor_payment' || $payment->type == 'salary' || $payment->type == 'bonus' || $payment->type == 'instructor_share')
                            <span style="background:#10b981; color:#fff; border-radius:8px; font-weight:600; padding:4px 18px; font-size:1em;">INCOME</span>
                          @else
                            <span style="background:#ef4444; color:#fff; border-radius:8px; font-weight:600; padding:4px 18px; font-size:1em;">EXPENSE</span>
                          @endif
                        </td>
                        <td style="font-weight:600; color:{{ ($payment->type == 'income' || $payment->type == 'instructor_payment' || $payment->type == 'salary' || $payment->type == 'bonus' || $payment->type == 'instructor_share') ? '#10b981' : '#ef4444' }};">
                          {{ ($payment->type == 'income' || $payment->type == 'instructor_payment' || $payment->type == 'salary' || $payment->type == 'bonus' || $payment->type == 'instructor_share') ? '+' : '-' }}${{ number_format(abs($payment->amount), 0) }}
                        </td>
                      <td><span style="background:#14b8a6; color:#fff; border-radius:8px; font-weight:600; padding:4px 18px; font-size:1em;">COMPLETED</span></td>
                    </tr>
                    @empty
                      <tr>
                        <td colspan="5" class="text-center text-muted">No financial transactions found.</td>
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
                  <form action="{{ route('admin.accounts.teachers.destroy', $teacher->id) }}" 
                        method="POST" 
                        onsubmit="return confirmDelete('{{ $teacher->name }}')"
                        style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                      <i class="fas fa-trash"></i> Delete Teacher Account
                    </button>
                  </form>
                </div>
                <div>
                  <a href="{{ route('admin.accounts.teachers.list') }}" class="btn btn-secondary">
                    <i class="fas fa-list"></i> Back to Teachers List
                  </a>
                  <a href="{{ route('admin.accounts.teachers.edit', $teacher->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Teacher Profile
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
          <h5 class="modal-title" id="addNoteModalLabel">Add Teacher Note</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="noteText" class="form-label">Note Content</label>
              <textarea class="form-control" id="noteText" rows="3" placeholder="Enter note about this teacher..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Note</button>
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
  <!-- مودال إضافة كورس -->
  <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCourseModalLabel">إضافة كورس للمدرس</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <div class="modal-body">
          <form onsubmit="event.preventDefault(); confirmAddCourse();">
            <div class="mb-3">
              <label class="form-label">اختر المادة</label>
              <select class="form-select" id="courseSelect" onchange="showCourseDetails()">
                <option value="">-- اختر --</option>
                <option value="1">عربي</option>
                <option value="2">رياضيات</option>
                <option value="3">فيزياء</option>
                <option value="4">كيمياء</option>
                <option value="5">أحياء</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">المسار</label>
              <select class="form-select" id="trackSelect">
                <option value="">-- اختر --</option>
                <option value="تاسع صيفي 2025">تاسع صيفي 2025</option>
                <option value="حادي عشر شتوي 2024">حادي عشر شتوي 2024</option>
                <option value="ثاني عشر علمي">ثاني عشر علمي</option>
                <option value="ثاني عشر أدبي">ثاني عشر أدبي</option>
              </select>
            </div>
            <div id="courseDetails" class="mt-2" style="display:none;">
              <div class="border rounded p-2 bg-light">
                <div><b>الوصف:</b> <span id="courseDesc"></span></div>
                <div><b>المدة:</b> <span id="courseDuration"></span></div>
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
          <div>تمت إضافة الكورس للمدرس بنجاح</div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal: حضور الطلاب -->
  <div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="attendanceModalLabel">حضور الطلاب</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <strong>المادة:</strong> <span id="modalCourseName"></span>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>اسم الطالب</th>
                  <th>تاريخ الحضور</th>
                  <th>الحالة</th>
                </tr>
              </thead>
              <tbody id="studentsAttendanceBody">
                <!-- سيتم تعبئتها بالجافاسكريبت -->
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
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
    function confirmDelete(teacherName) {
      return confirm(`Are you sure you want to delete the teacher "${teacherName}"?\n\nThis action cannot be undone.`);
    }
  </script>

  <script>
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
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const toggleBtn = document.getElementById('togglePassword');
      const pwdInput = document.getElementById('teacher-password');
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
    });
  </script>

  <script>
    const courses = {
      1: { desc: 'دورة عربي مكثفة', duration: '3 أشهر' },
      2: { desc: 'دورة رياضيات تأسيسية', duration: '4 أشهر' },
      3: { desc: 'دورة فيزياء متقدمة', duration: '5 أشهر' },
      4: { desc: 'دورة كيمياء شاملة', duration: '4 أشهر' },
      5: { desc: 'دورة أحياء تفاعلية', duration: '3 أشهر' }
    };

    function showCourseDetails() {
      var val = document.getElementById('courseSelect').value;
      var details = document.getElementById('courseDetails');
      if (courses[val]) {
        document.getElementById('courseDesc').textContent = courses[val].desc;
        document.getElementById('courseDuration').textContent = courses[val].duration;
        details.style.display = '';
      } else {
        details.style.display = 'none';
      }
    }

    function confirmAddCourse() {
      // فقط عرض رسالة تأكيد وهمية
      var modal = new bootstrap.Modal(document.getElementById('confirmAddModal'));
      modal.show();
    }
  </script>

  <script>
    // بيانات حضور الطلاب لكل كورس (تجريبية)
    const courseAttendances = {
      'عربي': [
        { name: 'أحمد محمد', date: '2024-06-20', status: 'حاضر' },
        { name: 'سارة علي', date: '2024-06-20', status: 'حاضر' },
        { name: 'محمد سامي', date: '2024-06-20', status: 'غائب' }
      ],
      'رياضيات': [
        { name: 'أحمد محمد', date: '2024-05-10', status: 'حاضر' },
        { name: 'سارة علي', date: '2024-05-10', status: 'حاضر' },
        { name: 'محمد سامي', date: '2024-05-10', status: 'حاضر' }
      ],
      'فيزياء': [
        { name: 'أحمد محمد', date: '2024-04-15', status: 'غائب' },
        { name: 'سارة علي', date: '2024-04-15', status: 'حاضر' },
        { name: 'محمد سامي', date: '2024-04-15', status: 'حاضر' }
      ]
    };

    document.addEventListener('DOMContentLoaded', function() {
      var attendanceModal = document.getElementById('attendanceModal');
      if (attendanceModal) {
        attendanceModal.addEventListener('show.bs.modal', function (event) {
          var button = event.relatedTarget;
          var course = button.getAttribute('data-course');
          document.getElementById('modalCourseName').textContent = course;
          var tbody = document.getElementById('studentsAttendanceBody');
          tbody.innerHTML = '';
          var data = courseAttendances[course] || [];
          data.forEach(function(row) {
            var tr = document.createElement('tr');
            tr.innerHTML = `<td>${row.name}</td><td>${row.date}</td><td><span class="badge ${row.status === 'حاضر' ? 'bg-success' : 'bg-danger'}">${row.status}</span></td>`;
            tbody.appendChild(tr);
          });
        });
      }
    });
  </script>

  <script>
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
  </script>

  <script>
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

</body>

</html>
