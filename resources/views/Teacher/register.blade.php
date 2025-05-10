<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>Teacher Register</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>
<body class="g-sidenav-show bg-gray-100">
  <main class="main-content mt-0 ps">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Register as Teacher</h3>
                  <p class="mb-0">Create your teacher account</p>
                </div>
                <div class="card-body">
                  <form role="form" method="POST" action="{{ route('teacher.register.post') }}">
                    @csrf
                    <label>Name</label>
                    <div class="mb-3">
                      <input type="text" class="form-control" placeholder="Full Name" name="name" required>
                    </div>
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <label>Confirm Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                      <label class="form-check-label" for="terms">I agree to the <a href="#">terms and conditions</a></label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-info w-100 mt-4 mb-0">Register</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('teacher.login') }}" class="text-info text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-none d-lg-flex h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=800&q=80'); background-size: cover;">
                <span class="mask bg-gradient-info opacity-6"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"The future belongs to those who prepare for it today."</h4>
                <p class="text-white position-relative">- Malcolm X</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
</body>
</html> 