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

                  <!-- Additional Information -->
                  @if($student->notes)
                  <div class="row mt-4">
                    <div class="col-12">
                      <h6 class="text-uppercase text-muted mb-3">Additional Notes</h6>
                      <div class="card bg-light">
                        <div class="card-body">
                          <p class="mb-0">{{ $student->notes }}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
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
                  <p class="font-weight-bold">
                    <span class="text-muted">••••••••</span>
                    <small class="text-info">(Hidden for security)</small>
                  </p>
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
  </script>
</body>

</html>