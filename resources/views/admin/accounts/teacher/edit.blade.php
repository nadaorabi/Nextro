<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <title>Edit Teacher - {{ $teacher->name }}</title>

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
        <div class="col-12" style="max-width:800px;margin:auto;">
          
          <!-- Header Card -->
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="mb-0">Edit Teacher</h4>
                  <p class="text-muted mb-0">Update teacher information</p>
                </div>
                <div>
                  <a href="{{ route('admin.accounts.teachers.show', $teacher->id) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Details
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
              <ul class="mb-0">
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
              <form action="{{ route('admin.accounts.teachers.update', $teacher->id) }}" method="POST" class="text-start" autocomplete="off">
                @csrf
                @method('PUT')

                <div class="row">
                  <!-- Full Name -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $teacher->name) }}" required maxlength="255">
                  </div>

                  <!-- Mobile -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                    <input type="tel" name="mobile" class="form-control" value="{{ old('mobile', $teacher->mobile) }}" required pattern="[0-9]{9,15}" maxlength="15">
                  </div>
                </div>

                <div class="row">
                  <!-- Email -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->email) }}" maxlength="255">
                  </div>
                  <!-- Address -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $teacher->address) }}" maxlength="255">
                  </div>
                </div>

                <!-- Password & Status -->
                <div class="row">
                  <!-- Password -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Password <span class="text-muted" style="font-size:0.95em;">(Leave blank to keep current)</span></label>
                    <div class="position-relative">
                      <input id="edit-teacher-password" type="password" name="password" class="form-control font-weight-bold ps-4 pe-5" value="{{ old('password', $teacher->plain_password) }}" autocomplete="new-password" style="background:#f8fafc; border-radius:12px; border:1.5px solid #d1e7ff; box-shadow:0 2px 8px rgba(44,62,80,0.07); font-size:1.15rem; letter-spacing:2px;">
                      <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" id="toggleEditPassword">
                        <i class="fas fa-eye text-secondary"></i>
                      </span>
                    </div>
                  </div>
                  <!-- Status -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select name="is_active" class="form-select" required>
                      <option value="1" {{ old('is_active', $teacher->is_active) == 1 ? 'selected' : '' }}>Active</option>
                      <option value="2" {{ old('is_active', $teacher->is_active) == 2 ? 'selected' : '' }}>Experienced</option>
                      <option value="0" {{ old('is_active', $teacher->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                  </div>
                </div>

                <!-- Notes -->
                <div class="mb-3">
                  <label class="form-label">Notes (Optional)</label>
                  <textarea name="notes" class="form-control" rows="3" maxlength="500" placeholder="Any additional notes about the teacher...">{{ old('notes', $teacher->notes) }}</textarea>
                </div>

                <!-- Read-only Information -->
                <div class="card bg-light mb-3">
                  <div class="card-body">
                    <h6 class="text-muted mb-3">Account Information (Read-only)</h6>
                    <div class="row">
                      <div class="col-md-6">
                        <label class="form-label text-muted">Teacher ID</label>
                        <input type="text" class="form-control" value="{{ $teacher->login_id }}" readonly>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label text-muted">Registration Date</label>
                        <input type="text" class="form-control" value="{{ $teacher->created_at->format('F d, Y') }}" readonly>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Submit Buttons -->
                <div class="d-flex justify-content-between">
                  <a href="{{ route('admin.accounts.teachers.show', $teacher->id) }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                  </a>
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Teacher
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
      const toggleEditBtn = document.getElementById('toggleEditPassword');
      const pwdEditInput = document.getElementById('edit-teacher-password');
      if(toggleEditBtn && pwdEditInput) {
        // Set icon based on initial input type
        if (pwdEditInput.type === 'password') {
          toggleEditBtn.innerHTML = '<i class="fas fa-eye-slash text-secondary"></i>';
        } else {
          toggleEditBtn.innerHTML = '<i class="fas fa-eye text-secondary"></i>';
        }
        toggleEditBtn.addEventListener('click', function() {
          if (pwdEditInput.type === 'password') {
            pwdEditInput.type = 'text';
            this.innerHTML = '<i class="fas fa-eye text-secondary"></i>';
          } else {
            pwdEditInput.type = 'password';
            this.innerHTML = '<i class="fas fa-eye-slash text-secondary"></i>';
          }
        });
      }
    });
  </script>
</body>

</html>
