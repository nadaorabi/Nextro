<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>إضافة مسؤول</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>
<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container mt-4 text-center">
      <h1 class="welcome-animated">إضافة مسؤول</h1>
    </div>
    <style>
      .welcome-animated {
        display: inline-block;
        font-size: 2.5rem;
        font-weight: bold;
        color: #007bff;
        animation: bounce 1.5s infinite alternate, gradientMove 3s linear infinite;
        letter-spacing: 2px;
        margin-top: 20px;
        background: linear-gradient(90deg, #007bff, #00c6ff, #007bff);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      @keyframes bounce {
        0%   { transform: translateY(0); }
        100% { transform: translateY(-20px); }
      }
      @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
      }
    </style>
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12" style="max-width:900px;margin:auto;">
          <div class="card shadow-sm">
            <div class="card-body text-center">
              <p class="lead">This page is for adding a new admin to the system.</p>
              <form action="#" method="POST" class="text-start" enctype="multipart/form-data">
                  <div class="mb-3">
                      <label class="form-label">Full Name</label>
                      <input type="text" name="name" class="form-control w-100" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" name="email" class="form-control w-100" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Phone Number</label>
                      <input type="tel" name="phone" class="form-control w-100" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Role</label>
                      <select name="role" class="form-select w-100" required>
                          <option value="">Select Role</option>
                          <option value="superadmin">Super Admin</option>
                          <option value="admin">Admin</option>
                      </select>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" name="password" class="form-control w-100" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Confirm Password</label>
                      <input type="password" name="password_confirmation" class="form-control w-100" required>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Profile Photo</label>
                      <input type="file" name="photo" class="form-control w-100" accept="image/*">
                  </div>
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary w-100">Add Admin</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>
</html>  