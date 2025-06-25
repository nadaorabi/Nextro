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
                  <h4 class="mb-0">Teacher Information</h4>
                  <p class="text-muted mb-0">View teacher details and information</p>
                </div>
                <div>
                  <a href="{{ route('admin.accounts.teachers.list') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
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
          <style>
            .custom-card {
              border-radius: 16px;
              box-shadow: 0 2px 12px rgba(44,62,80,0.09);
              background: #fff;
              margin-bottom: 24px;
              overflow: hidden;
            }
            .custom-card-header {
              background: linear-gradient(90deg,#eaf3fb 60%,#fafdff 100%);
              padding: 12px 24px;
              font-weight: bold;
              font-size: 1.15rem;
              color: #2266aa;
              border-bottom: 1px solid #e3eaf1;
              display: flex;
              align-items: center;
              justify-content: space-between;
            }
            .custom-card-body {
              padding: 20px 24px;
              background: linear-gradient(120deg,#fafdff 60%,#eaf6ff 100%);
            }
            .custom-table-responsive {
              width: 100%;
              overflow-x: auto;
              -webkit-overflow-scrolling: touch;
              margin-bottom: 1rem;
            }
            .custom-table {
              width: 100%;
              border-radius: 12px;
              overflow: hidden;
              background: #fafdff;
              min-width: 600px;
            }
            .custom-table th {
              background: linear-gradient(90deg,#eaf3fb 60%,#fafdff 100%);
              color: #2266aa;
              font-weight: bold;
              font-size: 1.05rem;
              border-bottom: 2px solid #e3eaf1;
              text-align: center;
            }
            .custom-table td {
              background: #fff;
              vertical-align: middle;
              font-size: 1.01rem;
              border-bottom: 1px solid #f0f4f8;
              text-align: center;
            }
            .custom-table tr:last-child td {
              border-bottom: none;
            }
            .badge-custom {
              border-radius: 999px;
              padding: 4px 18px;
              font-size: 1em;
              font-weight: 500;
              box-shadow: 0 1px 4px rgba(44,62,80,0.07);
              display: inline-block;
              min-width: 80px;
              text-align: center;
              letter-spacing: 0.5px;
              border: none;
            }
            .badge-paid {
              background: linear-gradient(90deg,#34d399 60%,#10b981 100%);
              color: #fff;
            }
            .badge-unpaid {
              background: linear-gradient(90deg,#f87171 60%,#ef4444 100%);
              color: #fff;
            }
            .badge-user {
              background: #60a5fa;
              color: #fff;
            }
            .badge-admin {
              background: #6ee7b7;
              color: #166534;
            }
            @media (max-width: 768px) {
              .custom-table-responsive {
                margin-bottom: 1rem;
              }
              .custom-table {
                min-width: 600px;
              }
            }
          </style>

          <!-- Account Information Card -->
          <div class="card shadow-sm mb-4">
            <div class="card-header">
              <h6 class="mb-0">Account Information</h6>
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
                    <input id="teacher-password" type="password" class="form-control font-weight-bold ps-4 pe-5" value="{{ $teacher->plain_password ?? '' }}" readonly style="background:#f8fafc; border-radius:12px; border:1.5px solid #d1e7ff; box-shadow:0 2px 8px rgba(44,62,80,0.07); font-size:1.15rem; letter-spacing:2px;">
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
              <span>Teacher Courses</span>
              <button type="button" class="btn btn-main d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                <i class="fas fa-plus"></i> إضافة كورس
              </button>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
                  <thead>
                    <tr>
                      <th>اسم المادة</th>
                      <th>المسار</th>
                      <th>عدد الطلاب</th>
                      <th>تاريخ البدء</th>
                      <th>الحضور</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>عربي</td>
                      <td>تاسع صيفي 2025</td>
                      <td>15 طالب</td>
                      <td>2024-06-20</td>
                      <td>
                        <button class="btn btn-attendance" data-bs-toggle="modal" data-bs-target="#attendanceModal" data-course="عربي">
                          <i class="fas fa-users"></i> حضور
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>رياضيات</td>
                      <td>حادي عشر شتوي 2024</td>
                      <td>12 طالب</td>
                      <td>2024-05-10</td>
                      <td>
                        <button class="btn btn-attendance" data-bs-toggle="modal" data-bs-target="#attendanceModal" data-course="رياضيات">
                          <i class="fas fa-users"></i> حضور
                        </button>
                      </td>
                    </tr>
                    <tr>
                      <td>فيزياء</td>
                      <td>ثاني عشر علمي</td>
                      <td>8 طلاب</td>
                      <td>2024-04-15</td>
                      <td>
                        <button class="btn btn-attendance" data-bs-toggle="modal" data-bs-target="#attendanceModal" data-course="فيزياء">
                          <i class="fas fa-users"></i> حضور
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Class Schedule Section -->
          <div class="custom-card mb-4">
            <div class="custom-card-header d-flex justify-content-between align-items-center">
              <span>جدول الحصص</span>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
                  <thead>
                    <tr>
                      <th>اليوم / الوقت</th>
                      <th>09:00 - 10:30</th>
                      <th>10:45 - 12:15</th>
                      <th>12:30 - 14:00</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>السبت</td>
                      <td>
                        عربي<br><span class="text-success">قاعة 1</span>
                      </td>
                      <td>
                        رياضيات<br><span class="text-success">قاعة 2</span>
                      </td>
                      <td>
                        فيزياء<br><span class="text-success">قاعة 3</span>
                      </td>
                    </tr>
                    <tr>
                      <td>الأحد</td>
                      <td>
                        رياضيات<br><span class="text-success">قاعة 2</span>
                      </td>
                      <td>
                        عربي<br><span class="text-success">قاعة 1</span>
                      </td>
                      <td>
                        فيزياء<br><span class="text-success">قاعة 3</span>
                      </td>
                    </tr>
                    <tr>
                      <td>الإثنين</td>
                      <td>
                        عربي<br><span class="text-success">قاعة 1</span>
                      </td>
                      <td>
                        رياضيات<br><span class="text-success">قاعة 2</span>
                      </td>
                      <td>
                        فيزياء<br><span class="text-success">قاعة 3</span>
                      </td>
                    </tr>
                    <tr>
                      <td>الثلاثاء</td>
                      <td>
                        فيزياء<br><span class="text-success">قاعة 3</span>
                      </td>
                      <td>
                        عربي<br><span class="text-success">قاعة 1</span>
                      </td>
                      <td>
                        رياضيات<br><span class="text-success">قاعة 2</span>
                      </td>
                    </tr>
                    <tr>
                      <td>الأربعاء</td>
                      <td>
                        رياضيات<br><span class="text-success">قاعة 2</span>
                      </td>
                      <td>
                        فيزياء<br><span class="text-success">قاعة 3</span>
                      </td>
                      <td>
                        عربي<br><span class="text-success">قاعة 1</span>
                      </td>
                    </tr>
                    <tr>
                      <td>الخميس</td>
                      <td>
                        عربي<br><span class="text-success">قاعة 1</span>
                      </td>
                      <td>
                        رياضيات<br><span class="text-success">قاعة 2</span>
                      </td>
                      <td>
                        فيزياء<br><span class="text-success">قاعة 3</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Statistics Cards Section -->
          <div class="row mb-4">
            <div class="col-md-4 mb-3">
              <div class="card shadow-sm text-center h-100">
                <div class="card-body">
                  <div class="mb-2">
                    <i class="fas fa-graduation-cap fa-2x text-primary"></i>
                  </div>
                  <div class="fw-bold text-muted">Total Courses</div>
                  <div class="fs-2 text-primary">3</div>
                  <div class="text-info">Enrolled Courses</div>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card shadow-sm text-center h-100">
                <div class="card-body">
                  <div class="mb-2">
                    <i class="fas fa-calendar-check fa-2x text-success"></i>
                  </div>
                  <div class="fw-bold text-muted">Attendance Rate</div>
                  <div class="fs-2 text-success">85%</div>
                  <div class="text-info">This Month</div>
                </div>
              </div>
            </div>
            <div class="col-md-4 mb-3">
              <div class="card shadow-sm text-center h-100">
                <div class="card-body">
                  <div class="mb-2">
                    <i class="fas fa-dollar-sign fa-2x text-warning"></i>
                  </div>
                  <div class="fw-bold text-muted">Total Paid</div>
                  <div class="fs-2" style="color:#ff7043;">$3,000</div>
                  <div class="text-info">All Time</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Transaction History Table Section -->
          <div class="custom-card mb-4">
            <div class="custom-card-header d-flex justify-content-between align-items-center">
              <span>Transaction History</span>
              <div>
                <button class="btn btn-light border me-2" style="border-radius: 18px; font-weight: 500;">All Year <i class="fas fa-chevron-down ms-1"></i></button>
                <button class="btn btn-light border" style="border-radius: 18px;"><i class="far fa-calendar-alt"></i></button>
              </div>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
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
                    <tr>
                      <td>23/04/2024</td>
                      <td>Student Registration - Ahmed Mohamed</td>
                      <td><span class="badge bg-success" style="font-size:1em;">INCOME</span></td>
                      <td class="text-success fw-bold">+$1,000</td>
                      <td><span class="badge bg-success" style="font-size:1em;">COMPLETED</span></td>
                    </tr>
                    <tr>
                      <td>22/04/2024</td>
                      <td>Withdrawal to Bank Account</td>
                      <td><span class="badge bg-danger" style="font-size:1em;">EXPENSE</span></td>
                      <td class="text-danger fw-bold">-$500</td>
                      <td><span class="badge bg-success" style="font-size:1em;">COMPLETED</span></td>
                    </tr>
                    <tr>
                      <td>21/04/2024</td>
                      <td>Student Registration - Sara Ahmed</td>
                      <td><span class="badge bg-success" style="font-size:1em;">INCOME</span></td>
                      <td class="text-success fw-bold">+$1,000</td>
                      <td><span class="badge bg-success" style="font-size:1em;">COMPLETED</span></td>
                    </tr>
                    <tr>
                      <td>20/04/2024</td>
                      <td>Student Registration - Mohamed Ali</td>
                      <td><span class="badge bg-success" style="font-size:1em;">INCOME</span></td>
                      <td class="text-success fw-bold">+$1,000</td>
                      <td><span class="badge bg-success" style="font-size:1em;">COMPLETED</span></td>
                    </tr>
                    <tr>
                      <td>19/04/2024</td>
                      <td>Student Registration - Fatima Hassan</td>
                      <td><span class="badge bg-success" style="font-size:1em;">INCOME</span></td>
                      <td class="text-success fw-bold">+$1,000</td>
                      <td><span class="badge bg-success" style="font-size:1em;">COMPLETED</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Modal لإضافة ملاحظة -->
          <div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addNoteModalLabel">Add Note</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="mb-3">
                      <label for="noteText" class="form-label">Note</label>
                      <textarea class="form-control" id="noteText" rows="3"></textarea>
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

          <!-- Actions Card -->
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <a href="{{ route('admin.accounts.teachers.list') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                  </a>
                  <a href="{{ route('admin.accounts.teachers.edit', $teacher->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Teacher
                  </a>
                </div>
                <form action="{{ route('admin.accounts.teachers.destroy', $teacher->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this teacher? This action cannot be undone.')">
                    <i class="fas fa-trash"></i> Delete Teacher
                  </button>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </main>

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

  <style>
    .table-responsive {
      overflow-x: auto !important;
      -webkit-overflow-scrolling: touch;
      border-radius: 0 !important;
    }
    .table-responsive table {
      min-width: 600px;
    }
  </style>

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

</body>

</html>
