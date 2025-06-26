<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <title>Admin Details - {{ $admin->name }}</title>

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
                  <h4 class="mb-0">Admin Information</h4>
                  <p class="text-muted mb-0">View admin details and information</p>
                </div>
                <div>
                  <a href="{{ route('admin.accounts.admins.list') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                  </a>
                  <a href="{{ route('admin.accounts.admins.edit', $admin->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Admin
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

          <!-- Admin Profile Card -->
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <div class="row">
                <!-- Admin Photo -->
                <div class="col-md-3 text-center">
                  <img src="{{ asset('images/default-avatar.png') }}" 
                       class="avatar avatar-xxl rounded-circle mb-3"
                       alt="{{ $admin->name }}">
                  
                  <!-- Status Badge -->
                  <div class="mb-3">
                    @if($admin->is_active == 1)
                      <span class="badge bg-success">Active</span>
                    @else
                      <span class="badge bg-danger">Inactive</span>
                    @endif
                  </div>

                  <!-- Admin ID -->
                  <div class="text-center">
                    <h6 class="text-muted mb-1">Admin ID</h6>
                    <h5 class="font-weight-bold text-primary">{{ $admin->login_id }}</h5>
                  </div>
                </div>

                <!-- Admin Information -->
                <div class="col-md-9">
                  <h4 class="mb-4">{{ $admin->name }}</h4>
                  
                  <div class="row">
                    <!-- Personal Information -->
                    <div class="col-md-6">
                      <h6 class="text-uppercase text-muted mb-3">Personal Information</h6>
                      
                      <div class="mb-3">
                        <label class="form-label text-muted">Full Name</label>
                        <p class="font-weight-bold">{{ $admin->name }}</p>
                      </div>

                      @if($admin->father_name)
                      <div class="mb-3">
                        <label class="form-label text-muted">Father's Name</label>
                        <p class="font-weight-bold">{{ $admin->father_name }}</p>
                      </div>
                      @endif

                      @if($admin->mother_name)
                      <div class="mb-3">
                        <label class="form-label text-muted">Mother's Name</label>
                        <p class="font-weight-bold">{{ $admin->mother_name }}</p>
                      </div>
                      @endif

                      @if($admin->birth_date)
                      <div class="mb-3">
                        <label class="form-label text-muted">Birth Date</label>
                        <p class="font-weight-bold">{{ \Carbon\Carbon::parse($admin->birth_date)->format('F d, Y') }}</p>
                      </div>
                      @endif

                      @if($admin->national_id)
                      <div class="mb-3">
                        <label class="form-label text-muted">National ID</label>
                        <p class="font-weight-bold">{{ $admin->national_id }}</p>
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
                          {{ $admin->mobile }}
                        </p>
                      </div>

                      @if($admin->alt_mobile)
                      <div class="mb-3">
                        <label class="form-label text-muted">Alternative Mobile</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-phone me-2 text-secondary"></i>
                          {{ $admin->alt_mobile }}
                        </p>
                      </div>
                      @endif

                      @if($admin->email)
                      <div class="mb-3">
                        <label class="form-label text-muted">Email Address</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-envelope me-2 text-primary"></i>
                          {{ $admin->email }}
                        </p>
                      </div>
                      @endif

                      @if($admin->address)
                      <div class="mb-3">
                        <label class="form-label text-muted">Address</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                          {{ $admin->address }}
                        </p>
                      </div>
                      @endif
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

          <!-- Account Information Card -->
          <div class="card shadow-sm mb-4">
            <div class="card-header">
              <h6 class="mb-0">Account Information</h6>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                  <label class="form-label text-muted">Registration Date</label>
                  <p class="font-weight-bold">{{ $admin->created_at->format('F d, Y') }}</p>
                </div>
                <div class="col-md-3">
                  <label class="form-label text-muted">Last Updated</label>
                  <p class="font-weight-bold">{{ $admin->updated_at->format('F d, Y') }}</p>
                </div>
                <div class="col-md-3">
                  <label class="form-label text-muted">Login ID</label>
                  <p class="font-weight-bold text-primary">{{ $admin->login_id }}</p>
                </div>
                <div class="col-md-3">
                  <label class="form-label text-muted">Password</label>
                  <div class="position-relative">
                    <input id="admin-password" type="password" class="form-control font-weight-bold ps-4 pe-5" value="{{ $admin->plain_password ?? '' }}" readonly style="background:#f8fafc; border-radius:12px; border:1.5px solid #d1e7ff; box-shadow:0 2px 8px rgba(44,62,80,0.07); font-size:1.15rem; letter-spacing:2px;">
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" id="togglePassword">
                      <i class="fas fa-eye text-secondary"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Actions Card -->
          <div class="card shadow-sm">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <a href="{{ route('admin.accounts.admins.list') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                  </a>
                  <a href="{{ route('admin.accounts.admins.edit', $admin->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit Admin
                  </a>
                </div>
                <form action="{{ route('admin.accounts.admins.destroy', $admin->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this admin? This action cannot be undone.')">
                    <i class="fas fa-trash"></i> Delete Admin
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
    function confirmDelete(adminName) {
      return confirm(`Are you sure you want to delete the admin "${adminName}"?\n\nThis action cannot be undone.`);
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
    document.addEventListener('DOMContentLoaded', function() {
      const toggleBtn = document.getElementById('togglePassword');
      const pwdInput = document.getElementById('admin-password');
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

</body>

</html> 