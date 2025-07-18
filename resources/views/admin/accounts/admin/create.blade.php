<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <title>Add New Admin</title>

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
                  <h4 class="mb-0">Add New Admin</h4>
                  <p class="text-muted mb-0">Create a new admin account with essential information</p>
                </div>
                <div>
                  <a href="{{ route('admin.accounts.admins.list') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Admins List
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

          <!-- Admin Registration Form -->
          <div class="card shadow-sm">
            <div class="card-body">
              <form action="{{ route('admin.accounts.admins.store') }}" method="POST" class="text-start" autocomplete="off">
                @csrf

                <div class="row">
                  <!-- Full Name -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required maxlength="255" placeholder="Enter admin's full name">
                  </div>

                  <!-- Mobile Number -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
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

                  <!-- Email Address -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" maxlength="255" placeholder="Enter email address">
                  </div>
                </div>

                <div class="row">
                  <!-- Address -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}" maxlength="255" placeholder="Enter address">
                  </div>
                </div>

                <div class="row">
                  <!-- Admin Status -->
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Admin Status <span class="text-danger">*</span></label>
                    <select name="is_active" class="form-select" required>
                      <option value="">Select Status</option>
                      <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Active</option>
                      <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                  </div>
                </div>

                <!-- Additional Notes -->
                <div class="mb-3">
                  <label class="form-label">Additional Notes</label>
                  <textarea name="notes" class="form-control" rows="3" maxlength="500" placeholder="Any additional notes about the admin (optional)">{{ old('notes') }}</textarea>
                </div>

                <!-- Information Notice -->
                <div class="alert alert-info">
                  <i class="fas fa-info-circle me-2"></i>
                  <strong>Note:</strong> A unique Admin ID and password will be automatically generated when the admin account is created.
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between">
                  <a href="{{ route('admin.accounts.admins.list') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancel
                  </a>
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create Admin Account
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