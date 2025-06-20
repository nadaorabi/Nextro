<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <title>Add Student</title>

  <!-- Fonts and CSS -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}">
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')

  <main class="main-content position-relative border-radius-lg ">
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12" style="max-width:900px;margin:auto;">
          <div class="card shadow-sm">
            <div class="card-body">
              @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif

              @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

                
              <h4 class="text-center mb-4">Add New Student</h4>
              <form action="{{ route('admin.accounts.students.store') }}" method="POST" class="text-start"
                autocomplete="off">
                @csrf

                <!-- Full Name -->
                <div class="mb-3">
                  <label class="form-label">Full Name <span class="text-danger">*</span></label>
                  <input type="text" name="name" class="form-control" required maxlength="255">
                </div>

                <!-- Father's Name -->
                <div class="mb-3">
                  <label class="form-label">Father's Name</label>
                  <input type="text" name="father_name" class="form-control" maxlength="255">
                </div>

                <!-- Mother's Name -->
                <div class="mb-3">
                  <label class="form-label">Mother's Name</label>
                  <input type="text" name="mother_name" class="form-control" maxlength="255">
                </div>

                <!-- Mobile -->
                <div class="mb-3">
                  <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                  <input type="tel" name="mobile" class="form-control" required pattern="[0-9]{9,15}" maxlength="15">
                </div>

                <!-- Alt Mobile -->
                <div class="mb-3">
                  <label class="form-label">Alternative Mobile</label>
                  <input type="tel" name="alt_mobile" class="form-control" pattern="[0-9]{9,15}" maxlength="15">
                </div>

                <!-- Email -->
                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control" maxlength="255">
                </div>

                <!-- National ID -->
                <div class="mb-3">
                  <label class="form-label">National ID</label>
                  <input type="text" name="national_id" class="form-control" maxlength="50">
                </div>

                <!-- Address -->
                <div class="mb-3">
                  <label class="form-label">Address</label>
                  <input type="text" name="address" class="form-control" maxlength="255">
                </div>

                <!-- Birth Date -->
                <div class="mb-3">
                  <label class="form-label">Birth Date</label>
                  <input type="date" name="birth_date" class="form-control" max="{{ now()->toDateString() }}">
                </div>

                <!-- Notes -->
                <div class="mb-3">
                  <label class="form-label">Notes</label>
                  <textarea name="notes" class="form-control" rows="3" maxlength="1000"></textarea>
                </div>

                <!-- Status -->
                <div class="mb-3">
                  <label class="form-label">Status <span class="text-danger">*</span></label>
                  <select name="is_active" class="form-select" required>
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>

                <!-- Submit -->
                <div class="text-center">
                  <button type="submit" class="btn btn-primary w-100">Add Student</button>
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