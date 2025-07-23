<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <title>Edit Student Account - {{ $student->name }}</title>

  <!-- Fonts and CSS -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}">
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
  
  <style>
    /* Force English locale for date inputs only */
    input[type="date"] {
      direction: ltr !important;
      text-align: left !important;
    }
    
    /* Custom purple-blue color for buttons */
    .btn-purple-blue {
      background-color: #6c5ce7;
      border-color: #6c5ce7;
      color: white;
    }
    
    .btn-purple-blue:hover {
      background-color: #5a4fcf;
      border-color: #5a4fcf;
      color: white;
    }
    
    .btn-purple-blue:focus {
      background-color: #5a4fcf;
      border-color: #5a4fcf;
      color: white;
      box-shadow: 0 0 0 0.2rem rgba(108, 92, 231, 0.25);
    }
  </style>
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
                  <h4 class="mb-0">Edit Student Account</h4>
                  <p class="text-muted mb-0">Update and modify student information and account settings</p>
                </div>
                <div>
                  <a href="{{ route('admin.accounts.students.show', $student->id) }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left"></i> Back to Student Details
                  </a>
                  <a href="{{ route('admin.accounts.students.list') }}" class="btn btn-purple-blue">
                    <i class="fas fa-list"></i> Back to List
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

          <!-- Edit Form Card -->
          <div class="card shadow-sm">
            <div class="card-body">
              <form action="{{ route('admin.accounts.students.update', $student->id) }}" method="POST" class="text-start" autocomplete="off">
                @csrf
                @method('PUT')

                <!-- Full Name -->
                <div class="mb-3">
                  <label class="form-label">Student's Full Name <span class="text-danger">*</span></label>
                  <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required maxlength="255" placeholder="Enter student's complete name">
                </div>

                <!-- Username -->
                <div class="mb-3">
                  <label class="form-label">Username <span class="text-danger">*</span></label>
                  <input type="text" name="user_name" class="form-control" value="{{ old('user_name', $student->user_name) }}" required maxlength="50" placeholder="Enter unique username for login">
                  <small class="form-text text-muted">This will be used for login. Must be unique.</small>
                </div>

                <!-- Father's Name -->
                <div class="mb-3">
                  <label class="form-label">Father's Full Name</label>
                  <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $student->father_name) }}" maxlength="255" placeholder="Enter father's name">
                </div>

                <!-- Mother's Name -->
                <div class="mb-3">
                  <label class="form-label">Mother's Full Name</label>
                  <input type="text" name="mother_name" class="form-control" value="{{ old('mother_name', $student->mother_name) }}" maxlength="255" placeholder="Enter mother's name">
                </div>

                <!-- Mobile -->
                <div class="mb-3">
                  <label class="form-label">Primary Mobile Number <span class="text-danger">*</span></label>
                  <input type="tel" name="mobile" class="form-control" value="{{ old('mobile', $student->mobile) }}" required pattern="[0-9]{9,15}" maxlength="15" placeholder="Enter primary mobile number">
                </div>

                <!-- Alt Mobile -->
                <div class="mb-3">
                  <label class="form-label">Alternative Mobile Number</label>
                  <input type="tel" name="alt_mobile" class="form-control" value="{{ old('alt_mobile', $student->alt_mobile) }}" pattern="[0-9]{9,15}" maxlength="15" placeholder="Enter alternative contact number">
                </div>

                <!-- Email -->
                <div class="mb-3">
                  <label class="form-label">Email Address</label>
                  <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}" maxlength="255" placeholder="Enter email address (optional)">
                </div>

                <!-- National ID -->
                <div class="mb-3">
                  <label class="form-label">National ID Number</label>
                  <input type="text" name="national_id" class="form-control" value="{{ old('national_id', $student->national_id) }}" maxlength="50" placeholder="Enter national ID or passport number">
                </div>

                <!-- Address -->
                <div class="mb-3">
                  <label class="form-label">Home Address</label>
                  <input type="text" name="address" class="form-control" value="{{ old('address', $student->address) }}" maxlength="255" placeholder="Enter home address">
                </div>

                <!-- Birth Date -->
                <div class="mb-3">
                  <label class="form-label">Date of Birth</label>
                  <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $student->birth_date) }}" max="{{ now()->toDateString() }}" lang="en" dir="ltr">
                </div>

                <!-- Notes -->
                <div class="mb-3">
                  <label class="form-label">Additional Notes <small class="text-muted">(Optional)</small></label>
                  <textarea name="notes" class="form-control" rows="3" maxlength="1000" placeholder="Enter any additional information about the student">{{ old('notes', $student->notes) }}</textarea>
                </div>

                <!-- Status -->
                <div class="mb-3">
                  <label class="form-label">Account Status <span class="text-danger">*</span></label>
                  <select name="is_active" class="form-select" required>
                    <option value="1" {{ old('is_active', $student->is_active) == 1 ? 'selected' : '' }}>Active - Student can access system</option>
                    <option value="2" {{ old('is_active', $student->is_active) == 2 ? 'selected' : '' }}>Graduated - Completed studies</option>
                    <option value="0" {{ old('is_active', $student->is_active) == 0 ? 'selected' : '' }}>Inactive - Account temporarily disabled</option>
                  </select>
                </div>

                <!-- Password Edit -->
                <div class="mb-3">
                  <label class="form-label">Student Password <span class="text-danger">*</span></label>
                  <div class="position-relative">
                    <input id="edit-student-password" type="password" name="plain_password" class="form-control ps-4 pe-5" value="{{ old('plain_password', $student->plain_password) }}" autocomplete="new-password" maxlength="255" style="background:#f8fafc; border-radius:12px; border:1.5px solid #d1e7ff; box-shadow:0 2px 8px rgba(44,62,80,0.07); font-size:1.15rem; letter-spacing:2px;">
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" id="toggleEditPassword">
                      <i class="fas fa-eye-slash text-secondary"></i>
                    </span>
                  </div>
                  <small class="form-text text-muted">Leave empty to keep the current password unchanged.</small>
                </div>

                <!-- Read-only Information -->
                <div class="card bg-light mb-4">
                  <div class="card-body">
                    <h6 class="text-muted mb-3">Account Information <small>(Read-only)</small></h6>
                    <div class="row">
                      <div class="col-md-6">
                        <label class="form-label text-muted">Student ID Number</label>
                        <input type="text" class="form-control" value="{{ $student->login_id }}" readonly>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label text-muted">Account Registration Date</label>
                        <input type="text" class="form-control" value="{{ $student->created_at->format('F d, Y') }}" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex justify-content-between">
                  <a href="{{ route('admin.accounts.students.show', $student->id) }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel Changes
                  </a>
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Student Information
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Password show/hide for edit
      const toggleEditBtn = document.getElementById('toggleEditPassword');
      const editPwdInput = document.getElementById('edit-student-password');
      if(toggleEditBtn && editPwdInput) {
        toggleEditBtn.addEventListener('click', function() {
          if (editPwdInput.type === 'password') {
            editPwdInput.type = 'text';
            this.innerHTML = '<i class="fas fa-eye text-secondary"></i>';
          } else {
            editPwdInput.type = 'password';
            this.innerHTML = '<i class="fas fa-eye-slash text-secondary"></i>';
          }
        });
      }
    });
  </script>
</body>

</html> 