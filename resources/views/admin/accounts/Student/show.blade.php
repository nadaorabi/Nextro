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
    .stats-card {
      min-height: 210px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      border-radius: 1.2rem;
      box-shadow: 0 2px 8px #e3eaf1;
      background: #fff;
      padding: 1.5rem;
    }
    .stats-icon {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 0.5rem auto;
      font-size: 1.8rem;
      color: white !important;
    }
    .stats-title {
      font-size: 1rem;
      color: #888;
      margin-bottom: 0.3rem;
    }
    .stats-value {
      font-size: 1.8rem;
      font-weight: bold;
      margin-bottom: 0.2rem;
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

          <div class="row mb-4 g-4">
            <div class="col-12 col-md-4">
              <div class="stats-card text-center">
                <div class="stats-icon" style="background-color:#6c63ff;"><i class="fas fa-graduation-cap"></i></div>
                <div class="stats-title">Total Courses</div>
                <div class="stats-value" style="color:#6c63ff;">{{ $enrollments->count() }}</div>
                <div class="small text-secondary">Enrolled Courses</div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="stats-card text-center">
                <div class="stats-icon" style="background-color:#3f51b5;"><i class="fas fa-box"></i></div>
                <div class="stats-title">Total Packages</div>
                <div class="stats-value" style="color:#3f51b5;">{{ $studentPackages->count() }}</div>
                <div class="small text-secondary">Enrolled Packages</div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="stats-card text-center">
                <div class="stats-icon" style="background-color:#2196f3;"><i class="fas fa-file-invoice-dollar"></i></div>
                <div class="stats-title">Total Fees Due</div>
                <div class="stats-value" style="color:#2196f3;">${{ number_format($totalDue, 2) }}</div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="stats-card text-center">
                <div class="stats-icon" style="background-color:#4caf50;"><i class="fas fa-arrow-up"></i></div>
                <div class="stats-title">Total Paid</div>
                <div class="stats-value" style="color:#4caf50;">${{ number_format($totalPaid, 2) }}</div>
              </div>
            </div>
            @if($totalDiscount > 0)
            <div class="col-12 col-md-4">
              <div class="stats-card text-center">
                <div class="stats-icon" style="background-color:#00bcd4;"><i class="fas fa-percent"></i></div>
                <div class="stats-title">Total Discounts</div>
                <div class="stats-value" style="color:#00bcd4;">${{ number_format($totalDiscount, 2) }}</div>
              </div>
            </div>
            @endif
            <div class="col-12 col-md-4">
              <div class="stats-card text-center">
                <div class="stats-icon" style="background-color:{{ $outstanding > 0 ? '#f44336' : '#4caf50' }};"><i class="fas fa-balance-scale"></i></div>
                <div class="stats-title">Outstanding Balance</div>
                <div class="stats-value" style="color:{{ $outstanding > 0 ? '#f44336' : '#4caf50' }};">
                  ${{ number_format($outstanding, 2) }}
                </div>
              </div>
            </div>
          </div>

          <!-- Recent Financial Transactions Table -->
          <div class="custom-card mb-4">
            <div class="custom-card-header d-flex justify-content-between align-items-center">
              <span>Recent Financial Transactions</span>
              <a href="{{ route('admin.students.account', $student->id) }}" class="btn btn-outline-primary btn-sm">
                View More <i class="fas fa-arrow-right ms-1"></i>
              </a>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Transaction Type</th>
                      <th>Amount</th>
                      <th>Notes</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($payments->take(5) as $payment)
                      <tr>
                        <td>{{ date('Y-m-d H:i', strtotime($payment->payment_date)) }}</td>
                        <td>
                          @if($payment->type == 'student_fee')
                            <span class="badge bg-info">Student Fee</span>
                          @elseif($payment->type == 'discount')
                            <span class="badge bg-primary">Discount</span>
                          @elseif($payment->type == 'refund')
                            <span class="badge bg-warning text-dark">Refund</span>
                          @else
                            <span class="badge bg-secondary">{{ $payment->type }}</span>
                          @endif
                        </td>
                        <td>
                          <span class="fw-bold {{ $payment->amount > 0 ? 'text-success' : 'text-danger' }}">
                            {{ $payment->amount > 0 ? '+' : '' }}${{ number_format($payment->amount, 2) }}
                          </span>
                        </td>
                        <td>{{ $payment->notes ?? '-' }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
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
                      <th>Note Content</th>
                      <th>Date Added</th>
                      <th>Actions</th>
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
                        <td colspan="4" class="text-center text-muted">No notes have been added yet.</td>
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
                <i class="fas fa-plus"></i> Add Course/Package
              </a>
            </div>
            <div class="custom-card-body p-0">
              <div class="custom-table-responsive">
                <table class="custom-table">
                  <thead>
                    <tr>
                      <th>Course/Package Name</th>
                      <th>Category</th>
                      <th>Instructor</th>
                      <th>Enrollment Date</th>
                      <th>Attendance Record</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- Courses --}}
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
                          <button class="btn btn-attendance" data-enrollment-id="{{ $enrollment->id }}" onclick="showAttendanceModal(this)">
                            <i class="fas fa-calendar-check"></i> View Attendance
                          </button>
                        </td>
                        <td>
                          <form action="{{ route('admin.accounts.students.courses.unenroll', ['studentId' => $student->id, 'enrollmentId' => $enrollment->id]) }}" 
                                method="POST" 
                                style="display: inline;"
                                onsubmit="return confirm('Are you sure you want to remove the course \'{{ $enrollment->course->title ?? 'Course' }}\'? The paid amount will be refunded.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fas fa-trash"></i> Remove
                            </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach

                    {{-- Packages --}}
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
                            <i class="fas fa-calendar-check"></i> View Attendance
                          </button>
                        </td>
                        <td>
                          <form action="{{ route('admin.accounts.students.packages.unenroll', ['studentId' => $student->id, 'packageId' => $sp->id]) }}" 
                                method="POST" 
                                style="display: inline;"
                                onsubmit="return confirm('Are you sure you want to remove the package \'{{ $sp->package->title ?? 'Package' }}\'? The paid amount will be refunded.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                              <i class="fas fa-trash"></i> Remove
                            </button>
                          </form>
                        </td>
                      </tr>
                    @endforeach

                    @if($enrollments->isEmpty() && $studentPackages->isEmpty())
                      <tr>
                        <td colspan="6" class="text-center text-muted">No course or package enrollments yet.</td>
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
                      <th>Session Date</th>
                      <th>Day of Week</th>
                      <th>Class Time</th>
                      <th>Course</th>
                      <th>Enrollment Type</th>
                      <th>Package Name</th>
                      <th>Classroom</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($allSchedules as $sch)
                      <tr>
                        <td>{{ $sch['session_date'] }}</td>
                        <td>{{ ucfirst($sch['day_of_week']) }}</td>
                        <td>{{ substr($sch['start_time'],0,5) }} - {{ substr($sch['end_time'],0,5) }}</td>
                        <td>{{ $sch['name'] }}</td>
                        <td>
                          @if($sch['type'] === 'package')
                            <span class="badge bg-info">Package</span>
                          @else
                            <span class="badge bg-primary">Course</span>
                          @endif
                        </td>
                        <td>{{ $sch['type'] === 'package' ? $sch['package_name'] : '-' }}</td>
                        <td>{{ $sch['room'] }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="7" class="text-center text-muted">No class schedule available for this student.</td>
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
  <!-- Modal for Adding Note -->
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
<!-- Modal for Confirming Note Deletion -->
<div class="modal fade" id="confirmDeleteNoteModal" tabindex="-1" aria-labelledby="confirmDeleteNoteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteNoteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this note? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteNoteBtn">Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- Attendance Modal -->
<div class="modal fade" id="attendanceModal" tabindex="-1" aria-labelledby="attendanceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attendanceModalLabel">Attendance Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="attendanceModalBody">
        <div class="text-center text-muted">Loading...</div>
      </div>
    </div>
  </div>
</div>
<!-- Modal for Adding Course or Package with Details -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCourseModalLabel">Add Course or Package</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form onsubmit="event.preventDefault(); confirmAddCourse();">
          <!-- Registration Type -->
          <div class="mb-3">
            <label class="form-label">Registration Type</label>
            <select class="form-select" id="enrollType" onchange="toggleEnrollTypeDetails()">
              <option value="course">Course</option>
              <option value="package">Package</option>
            </select>
          </div>
          <!-- Select Course -->
          <div class="mb-3" id="courseBox">
            <label class="form-label">Select Course</label>
            <select class="form-select" id="courseSelect" onchange="showCourseDetails()">
              <option value="">-- Select --</option>
              <option value="1">Arabic</option>
              <option value="2">Mathematics</option>
              <option value="3">Physics</option>
            </select>
            <div id="courseDetails" class="mt-2" style="display:none;">
              <div class="border rounded p-2 bg-light">
                <div><b>Instructor:</b> <span id="courseTeacher"></span></div>
                <div><b>Price:</b> <span id="coursePrice"></span></div>
                <div><b>Description:</b> <span id="courseDesc"></span></div>
              </div>
            </div>
          </div>
          <!-- Select Package -->
          <div class="mb-3 d-none" id="packageBox">
            <label class="form-label">Select Package</label>
            <select class="form-select" id="packageSelect" onchange="showPackageDetails()">
              <option value="">-- Select --</option>
              <option value="1">Grade 9 Package</option>
              <option value="2">Grade 11 Package</option>
            </select>
            <div id="packageDetails" class="mt-2" style="display:none;">
              <div class="border rounded p-2 bg-light">
                <div><b>Number of Courses:</b> <span id="packageCourses"></span></div>
                <div><b>Price:</b> <span id="packagePrice"></span></div>
                <div><b>Description:</b> <span id="packageDesc"></span></div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success w-100 mt-3">Confirm Addition</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal for Confirming Addition -->
<div class="modal fade" id="confirmAddModal" tabindex="-1" aria-labelledby="confirmAddModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmAddModalLabel">Successfully Added</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
        <div>Course/Package has been successfully added to the student (Demo - Frontend only)</div>
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
        'Arabic': [
          { date: '2024-06-20', day: 'Thursday', time: '09:00 - 10:30', status: 'Present', notes: '' },
          { date: '2024-06-19', day: 'Wednesday', time: '09:00 - 10:30', status: 'Absent', notes: 'Medical excuse' },
          { date: '2024-06-18', day: 'Tuesday', time: '09:00 - 10:30', status: 'Present', notes: '' },
          { date: '2024-06-17', day: 'Monday', time: '09:00 - 10:30', status: 'Present', notes: '' },
          { date: '2024-06-16', day: 'Sunday', time: '09:00 - 10:30', status: 'Absent', notes: 'Travel' },
          { date: '2024-06-15', day: 'Saturday', time: '09:00 - 10:30', status: 'Present', notes: '' }
        ],
        'Mathematics': [
          { date: '2024-06-20', day: 'Thursday', time: '10:45 - 12:15', status: 'Present', notes: '' },
          { date: '2024-06-19', day: 'Wednesday', time: '10:45 - 12:15', status: 'Present', notes: '' },
          { date: '2024-06-18', day: 'Tuesday', time: '10:45 - 12:15', status: 'Absent', notes: 'Illness' },
          { date: '2024-06-17', day: 'Monday', time: '10:45 - 12:15', status: 'Present', notes: '' },
          { date: '2024-06-16', day: 'Sunday', time: '10:45 - 12:15', status: 'Present', notes: '' },
          { date: '2024-06-15', day: 'Saturday', time: '10:45 - 12:15', status: 'Present', notes: '' }
        ],
        'Physics': [
          { date: '2024-06-20', day: 'Thursday', time: '12:30 - 14:00', status: 'Present', notes: '' },
          { date: '2024-06-19', day: 'Wednesday', time: '12:30 - 14:00', status: 'Present', notes: '' },
          { date: '2024-06-18', day: 'Tuesday', time: '12:30 - 14:00', status: 'Present', notes: '' },
          { date: '2024-06-17', day: 'Monday', time: '12:30 - 14:00', status: 'Absent', notes: 'Medical appointment' },
          { date: '2024-06-16', day: 'Sunday', time: '12:30 - 14:00', status: 'Present', notes: '' },
          { date: '2024-06-15', day: 'Saturday', time: '12:30 - 14:00', status: 'Present', notes: '' }
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
              <span class="badge ${record.status === 'Present' ? 'bg-success' : 'bg-danger'}">
                ${record.status}
              </span>
            </td>
            <td>${record.notes || '-'}</td>
          `;
          tableBody.appendChild(row);

          if (record.status === 'Present') {
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
      win.document.write('<html><head><title>Attendance Report</title>');
      win.document.write('<style>body{font-family:Tahoma,Arial,sans-serif; direction:ltr;} table{width:100%;border-collapse:collapse;} th,td{border:1px solid #ddd;padding:8px;text-align:center;} th{background:#f2f2f2;} .header{text-align:center;margin-bottom:20px;} .stats{display:flex;justify-content:space-around;margin:20px 0;}</style>');
      win.document.write('</head><body>');
      win.document.write('<div class="header">');
      win.document.write('<h2>Attendance Report</h2>');
      win.document.write(`<p><strong>Student:</strong> {{ $student->name }} | <strong>Course:</strong> ${course} | <strong>Instructor:</strong> ${teacher} | <strong>Track:</strong> ${track}</p>`);
      win.document.write('</div>');
      
      win.document.write('<div class="stats">');
      win.document.write(`<div><strong>Present Count:</strong> ${presentCount}</div>`);
      win.document.write(`<div><strong>Absent Count:</strong> ${absentCount}</div>`);
      win.document.write(`<div><strong>Attendance Rate:</strong> ${percentage}</div>`);
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
      1: { teacher: 'Prof. Mohammad', price: '$1500', desc: 'Intensive Arabic Course' },
      2: { teacher: 'Prof. Ahmad', price: '$1200', desc: 'Foundation Mathematics Course' },
      3: { teacher: 'Prof. Samer', price: '$2000', desc: 'Advanced Physics Course' }
    };
    const packages = {
      1: { courses: 'Arabic, Mathematics, Physics', price: '$4000', desc: 'Grade 9 Package for All Subjects' },
      2: { courses: 'Physics, Chemistry', price: '$3000', desc: 'Grade 11 Science Package' }
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
          document.getElementById('selectedYear').textContent = (year === 'all') ? 'All Years' : year;
        });
      });
    });

    function showAttendanceModal(btn) {
        var enrollmentId = btn.getAttribute('data-enrollment-id');
        var modal = new bootstrap.Modal(document.getElementById('attendanceModal'));
        var body = document.getElementById('attendanceModalBody');
        body.innerHTML = '<div class="text-center text-muted">Loading...</div>';
        modal.show();

        fetch('/admin/attendance/enrollment/' + enrollmentId)
            .then(res => res.json())
            .then(data => {
                let html = `<h5 class="mb-3">Student: <b>${data.student}</b> | Course: <b>${data.course}</b></h5>`;
                html += `<div class="table-responsive"><table class="table table-bordered"><thead>
                    <tr>
                        <th>Day</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Room</th>
                        <th>Status</th>
                        <th>Registration Method</th>
                    </tr>
                </thead><tbody>`;
                data.sessions.forEach(s => {
                    html += `<tr>
                        <td>${s.day}</td>
                        <td>${s.date}</td>
                        <td>${s.start_time} - ${s.end_time}</td>
                        <td>${s.room || '-'}</td>
                        <td>
                            ${
                              s.status === 'present'
                                ? '<span class="badge bg-success">Present</span>'
                                : s.status === 'pending'
                                ? '<span class="badge bg-warning text-dark">Pending</span>'
                                : s.status === 'late'
                                ? '<span class="badge bg-info text-dark">late</span>'
                                : '<span class="badge bg-danger">Absent</span>'
                            }
                            ${s.time && s.status === 'present' ? `<br><small>${s.time}</small>` : ''}
                        </td>
                        <td>${s.method === '-' ? '-' : (s.method === 'QR' ? 'QR' : 'Manual')}</td>
                    </tr>`;
                });
                html += '</tbody></table></div>';
                body.innerHTML = html;
            });
    }
  </script>

  <!-- Modal for Confirming Course Deletion -->
  <div class="modal fade" id="confirmDeleteCourseModal" tabindex="-1" aria-labelledby="confirmDeleteCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeleteCourseModalLabel">Confirm Course Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this course?</p>
          <p class="text-warning"><strong>The paid amount will be refunded to the student.</strong></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteCourseBtn">Delete Course</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Confirming Package Deletion -->
  <div class="modal fade" id="confirmDeletePackageModal" tabindex="-1" aria-labelledby="confirmDeletePackageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmDeletePackageModalLabel">Confirm Package Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete this package?</p>
          <p class="text-warning"><strong>The paid amount will be refunded to the student.</strong></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-danger" id="confirmDeletePackageBtn">Delete Package</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>