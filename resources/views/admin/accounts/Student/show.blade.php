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

                  <!-- Additional Notes Title -->
                  <div class="row mt-4">
                    <div class="col-12">
                    
                    </div>
                  </div>
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

          <!-- Notes Section -->
          <div class="custom-card">
            <div class="custom-card-header">
              <span>Notes</span>
              <button type="button" class="btn btn-primary btn-sm px-3 py-1" data-bs-toggle="modal" data-bs-target="#addNoteModal" style="font-size:1rem; border-radius:20px;">
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
                      <td><span class="badge-custom badge-user">أ. محمد</span></td>
                      <td>كثير الغياب</td>
                      <td>2024-06-20</td>
                      <td><button class="btn btn-sm btn-outline-danger btn-delete-note"><i class="fas fa-trash"></i></button></td>
                    </tr>
                    <tr>
                      <td><span class="badge-custom badge-admin">الإدارة</span></td>
                      <td>دائما متأخر</td>
                      <td>2024-06-19</td>
                      <td><button class="btn btn-sm btn-outline-danger btn-delete-note"><i class="fas fa-trash"></i></button></td>
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

          <!-- Student Enrollments Section -->
          <div class="custom-card">
            <div class="custom-card-header">Student Enrollments</div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
                  <thead>
                    <tr>
                      <th>Category</th>
                      <th>Course</th>
                      <th>Track/Package</th>
                      <th>Teacher</th>
                      <th>Enrollment Date</th>
                      <th>Price</th>
                      <th>Paid</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>تاسع</td>
                      <td>عربي</td>
                      <td>تاسع صيفي 2025</td>
                      <td>أ. محمد</td>
                      <td>2024-06-20</td>
                      <td>1500 SYP</td>
                      <td><span class="badge-custom badge-paid">مدفوع</span></td>
                    </tr>
                    <tr>
                      <td>تاسع</td>
                      <td>رياضيات</td>
                      <td>تاسع صيفي 2025</td>
                      <td>أ. أحمد</td>
                      <td>2024-06-20</td>
                      <td>0 SYP</td>
                      <td><span class="badge-custom badge-paid">مدفوع</span></td>
                    </tr>
                    <tr>
                      <td>حادي عشر</td>
                      <td>فيزياء</td>
                      <td>حادي عشر شتوي 2024</td>
                      <td>أ. سامر</td>
                      <td>2024-05-10</td>
                      <td>2000 SYP</td>
                      <td><span class="badge-custom badge-unpaid">غير مدفوع</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Student Financial Status Section -->
          <div class="custom-card">
            <div class="custom-card-header"><i class="fas fa-wallet me-2"></i>Student Financial Status</div>
            <div class="custom-card-body">
              <ul class="list-unstyled mb-0" style="font-size:1.08rem;">
                <li class="mb-3 d-flex align-items-center">
                  <i class="fas fa-coins text-success me-2"></i>
                  <span class="fw-bold me-2">Total Payments:</span>
                  <span class="text-success">1500 SYP</span>
                </li>
                <li class="mb-3 d-flex align-items-center">
                  <i class="fas fa-money-bill-wave text-danger me-2"></i>
                  <span class="fw-bold me-2">Remaining:</span>
                  <span class="text-danger">2000 SYP</span>
                </li>
                <li class="mb-3 d-flex align-items-center">
                  <i class="fas fa-calendar-alt text-primary me-2"></i>
                  <span class="fw-bold me-2">Last Payment:</span>
                  <span class="text-dark">2024-06-20</span>
                </li>
                <li class="d-flex align-items-center">
                  <i class="fas fa-exclamation-circle text-warning me-2"></i>
                  <span class="fw-bold me-2">Payment Status:</span>
                  <span class="badge-custom badge-unpaid" style="font-size:0.97em;">Incomplete</span>
                </li>
              </ul>
            </div>
          </div>

          <!-- Academic Status Section -->
          <div class="custom-card">
            <div class="custom-card-header">Academic Status</div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
                  <thead>
                    <tr>
                      <th>Subject</th>
                      <th>Date</th>
                      <th>Time</th>
                      <th>Status</th>
                      <th>Course/Track Details</th>
                      <th>Absences Count</th>
                      <th>Notes</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>عربي</td>
                      <td>2024-06-20</td>
                      <td>09:00 - 10:30</td>
                      <td><span class="badge-custom badge-paid">حاضر</span></td>
                      <td>تاسع صيفي 2025</td>
                      <td>1</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td>رياضيات</td>
                      <td>2024-06-19</td>
                      <td>10:45 - 12:15</td>
                      <td><span class="badge-custom badge-unpaid">غائب</span></td>
                      <td><span class="badge bg-danger" style="font-size:0.97em;">لم يحضر: تاسع صيفي 2025</span></td>
                      <td>2</td>
                      <td>Medical excuse</td>
                    </tr>
                    <tr>
                      <td>فيزياء</td>
                      <td>2024-06-18</td>
                      <td>12:30 - 14:00</td>
                      <td><span class="badge-custom badge-paid">حاضر</span></td>
                      <td>حادي عشر شتوي 2024</td>
                      <td>0</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Class Schedule Section -->
          <div class="custom-card">
            <div class="custom-card-header">
              <span>Class Schedule</span>
              <button onclick="printScheduleTable()" class="btn btn-outline-primary btn-sm px-3 py-1" style="font-size:1rem; border-radius:20px;">
                <i class="fas fa-print"></i> Print
              </button>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table" id="schedule-table-print">
                  <thead>
                    <tr>
                      <th>Subject</th>
                      <th>Time</th>
                      <th>Room</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>عربي</td>
                      <td>09:00 - 10:30</td>
                      <td>قاعة 1</td>
                    </tr>
                    <tr>
                      <td>رياضيات</td>
                      <td>10:45 - 12:15</td>
                      <td>قاعة 2</td>
                    </tr>
                    <tr>
                      <td>فيزياء</td>
                      <td>12:30 - 14:00</td>
                      <td>قاعة 3</td>
                    </tr>
                  </tbody>
                </table>
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
                    <input id="student-password" type="password" class="form-control font-weight-bold ps-4 pe-5" value="{{ $student->plain_password ?? '' }}" readonly style="background:#f8fafc; border-radius:12px; border:1.5px solid #d1e7ff; box-shadow:0 2px 8px rgba(44,62,80,0.07); font-size:1.15rem; letter-spacing:2px;">
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" id="togglePassword">
                      <i class="fas fa-eye text-secondary"></i>
                    </span>
                  </div>
                </div>
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
                  <a href="{{ route('admin.accounts.students.list') }}" class="btn btn-secondary">
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
    });
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
</body>

</html>