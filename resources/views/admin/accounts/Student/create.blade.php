<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <title>Create New Student Account</title>

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
        <div class="col-12" style="max-width:900px;margin:auto;">
          
          <!-- Header Card -->
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="mb-0">Create New Student Account</h4>
                  <p class="text-muted mb-0">Register a new student with their personal and contact information</p>
                </div>
                <div>
                  <a href="{{ route('admin.accounts.students.list') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Students List
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

          @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i>
              <strong>Please correct the following errors:</strong>
              <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <!-- Student Registration Form -->
          <div class="card shadow-sm">
            <div class="card-header">
              <h5 class="mb-0">Student Information</h5>
            </div>
            <div class="card-body">
              <form action="{{ route('admin.accounts.students.store') }}" method="POST" class="text-start" autocomplete="off">
                @csrf

                <div class="row">
                  <!-- Full Name -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Student's Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required maxlength="255" placeholder="Enter student's complete name">
                  </div>

                  <!-- Mobile -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Primary Mobile Number <span class="text-danger">*</span></label>
                    <input type="tel" name="mobile" class="form-control" value="{{ old('mobile') }}" required pattern="[0-9]{9,15}" maxlength="15" placeholder="Enter mobile number">
                  </div>
                </div>

                <div class="row">
                  <!-- Username -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Username <span class="text-danger">*</span></label>
                    <input type="text" name="user_name" class="form-control" value="{{ old('user_name') }}" required maxlength="50" placeholder="Enter unique username for login">
                    <small class="form-text text-muted">This will be used for login. Must be unique.</small>
                  </div>

                  <!-- Father's Name -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Father's Full Name</label>
                    <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}" maxlength="255" placeholder="Enter father's name">
                  </div>
                </div>

                <div class="row">
                  <!-- Mother's Name -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Mother's Full Name</label>
                    <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name') }}" maxlength="255" placeholder="Enter mother's name">
                  </div>

                  <!-- Email -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" maxlength="255" placeholder="Enter email address (optional)">
                  </div>
                </div>

                <div class="row">
                  <!-- Address -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Home Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" maxlength="255" placeholder="Enter home address">
                  </div>

                  <!-- National ID -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">National ID Number</label>
                    <input type="text" name="national_id" class="form-control" value="{{ old('national_id') }}" maxlength="50" placeholder="Enter national ID or passport number">
                  </div>
                </div>

                <div class="row">
                  <!-- Birth Date -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}" max="{{ now()->toDateString() }}" lang="en" dir="ltr" placeholder="MM/DD/YYYY">
                  </div>

                  <!-- Alt Mobile -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Alternative Mobile Number</label>
                    <input type="tel" name="alt_mobile" class="form-control" value="{{ old('alt_mobile') }}" pattern="[0-9]{9,15}" maxlength="15" placeholder="Enter alternative contact number">
                  </div>
                </div>

                <div class="row">
                  <!-- Status -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Account Status <span class="text-danger">*</span></label>
                    <select name="is_active" class="form-select" required>
                      <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active - Student can access system</option>
                      <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive - Account temporarily disabled</option>
                    </select>
                  </div>
                </div>

                <!-- Notes -->
                <div class="mb-4">
                  <label class="form-label">Additional Notes <small class="text-muted">(Optional)</small></label>
                  <textarea name="notes" class="form-control" rows="3" maxlength="500" placeholder="Enter any additional information about the student (medical conditions, special requirements, etc.)">{{ old('notes') }}</textarea>
                </div>

                <!-- Information Note -->
                <div class="alert alert-info">
                  <i class="fas fa-info-circle me-2"></i>
                  <strong>Important:</strong> After creating the student account, a unique Student ID and temporary password will be automatically generated. Please share these credentials with the student for their first login.
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex justify-content-between">
                  <a href="{{ route('admin.accounts.students.list') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel Registration
                  </a>
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Create Student Account
                  </button>
                </div>
              </form>
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
</body>

</html>