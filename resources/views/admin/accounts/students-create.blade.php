<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>Add Student</title>
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
      <h1 class="welcome-animated">Add Student</h1>
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
              <p class="lead">This page is for adding a new student to the system.</p>
              <form action="{{ route('admin.accounts.students.create') }}" method="POST" class="text-start">
                  @csrf
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">Student Name</label>
                      <div class="col-md-9">
                        <input type="text" name="name" class="form-control" required>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">Email</label>
                      <div class="col-md-9">
                        <input type="email" name="email" class="form-control" required>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">Password</label>
                      <div class="col-md-9">
                        <input type="password" name="password" class="form-control" required>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">Confirm Password</label>
                      <div class="col-md-9">
                        <input type="password" name="password_confirmation" class="form-control" required>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">Grade</label>
                      <div class="col-md-9">
                        <select name="grade" class="form-select" required>
                            <option value="">Select grade</option>
                            <option value="8">8th</option>
                            <option value="9">9th</option>
                            <option value="10">10th</option>
                            <option value="11">11th</option>
                            <option value="12">12th</option>
                        </select>
                      </div>
                  </div>
                  <div class="mb-3 row align-items-center">
                      <label class="form-label col-md-3 col-form-label text-start">Status</label>
                      <div class="col-md-9">
                        <select name="status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                      </div>
                  </div>
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary">Add Student</button>
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