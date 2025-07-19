<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">

<nav class="site-nav mb-5">
  <div class="pb-2 top-bar mb-3">
    <div class="container">
      <div class="row align-items-center">
        <!-- Left Section: Contact Info --> 
        <div class="col-6 col-lg-9">
          <a href="#" class="small mr-3">
            <span class="icon-question-circle-o mr-2"></span>
            <span class="d-none d-lg-inline-block">Have a question?</span>
          </a>
          <a href="#" class="small mr-3">
            <span class="icon-phone mr-2"></span>
            <span class="d-none d-lg-inline-block">0980948211</span>
          </a>
          <a href="#" class="small mr-3">
            <span class="icon-envelope mr-2"></span>
            <span class="d-none d-lg-inline-block">Nextro@gmail.com</span>
          </a>
        </div>

        <!-- Right Section: Auth Buttons -->
        <div class="col-6 col-lg-3 text-right d-flex justify-content-end align-items-center gap-2">
          @auth
            @if(Auth::user()->isUser())
              <a href="{{ route('profile_page') }}" class="auth-btn profile me-2">
                <i class="las la-user"></i> {{ Auth::user()->name }}
              </a>
            @endif

            @if(Auth::user()->isTeacher())
              <a href="{{ route('teacher.dashboard') }}" class="auth-btn profile me-2">
                <i class="las la-chalkboard-teacher"></i> لوحة تحكم الأستاذ
              </a>
            @endif

            <form action="{{ Auth::user()->isTeacher() ? route('teacher.logout') : route('logout') }}" method="POST" style="display:inline;">
              @csrf
              <button type="submit" class="auth-btn logout">
                <i class="las la-sign-out-alt"></i> Logout
              </button>
            </form>
          @else
            <a href="{{ route('login') }}" class="auth-btn login me-2">
              <i class="las la-sign-in-alt"></i> Log In
            </a>
            <a href="{{ route('register') }}" class="auth-btn register ms-2">
              <i class="las la-user-plus"></i> Register
            </a>
            <a href="{{ route('staff.login') }}" class="auth-btn register ms-2">
              <i class="las la-user-tie"></i> Staff
            </a>
          @endauth
        </div>
      </div>
    </div>
  </div>

  <!-- Sticky Navigation -->
  <div class="sticky-nav js-sticky-header">
    <div class="container position-relative">
      <div class="site-navigation text-center">
        <a href="{{ route('home_page') }}" class="logo menu-absolute m-0">Nextro<span class="text-primary">.</span></a>

        <ul class="js-clone-nav d-none d-lg-inline-block site-menu">
          <li class="{{ request()->routeIs('home_page') ? 'active' : '' }}"><a href="{{ route('home_page') }}">Home</a></li>
          <li class="{{ request()->routeIs('about_page') ? 'active' : '' }}"><a href="{{ route('about_page') }}">About</a></li>
          <li class="{{ request()->routeIs('Staff_page') ? 'active' : '' }}"><a href="{{ route('Staff_page') }}">Our Staff</a></li>
          <li class="{{ request()->routeIs('news_page') ? 'active' : '' }}"><a href="{{ route('news_page') }}">News</a></li>
          <li class="{{ request()->routeIs('courses_page') ? 'active' : '' }}"><a href="{{ route('courses_page') }}">Courses</a></li>
          <li class="{{ request()->routeIs('Contact_page') ? 'active' : '' }}"><a href="{{ route('Contact_page') }}">Contact</a></li>
        </ul>

        <!-- Mobile Nav Toggle -->
        <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
          <span></span>
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- External CSS placed properly -->
<style>
  .auth-btn {
    border-radius: 30px;
    padding: 4px 10px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border: 1px solid transparent;
    height: 36px;
    min-width: 90px;
  }

  .auth-btn i {
    margin-right: 4px;
    font-size: 14px;
  }

  @media (max-width: 575.98px) {
    .auth-btn {
      padding: 3px 8px;
      font-size: 11px;
      height: 34px;
      min-width: 80px;
    }
    .auth-btn i {
      margin-right: 3px;
      font-size: 13px;
    }
  }

  .auth-btn.login {
    background-color: white;
    color: #007bff;
    border-color: white;
  }

  .auth-btn.login:hover {
    background-color: #f0f0f0;
    transform: translateY(-2px);
  }

  .auth-btn.register {
    background-color: #ffffff;
    color: #000;
    border-color: #ddd;
  }

  .auth-btn.register:hover {
    background-color: #f8f9fa;
    transform: translateY(-2px);
    border-color: #ccc;
  }

  .auth-btn.profile {
    background-color: white;
    color: #28a745;
    border-color: white;
  }

  .auth-btn.profile:hover {
    background-color: #f0f0f0;
    transform: translateY(-2px);
  }

  .auth-btn.logout {
    background-color: transparent;
    color: white;
    border: 1px solid white;
  }

  .auth-btn.logout:hover {
    background-color: white;
    color: #dc3545;
    transform: translateY(-2px);
  }

  .auth-btn:not(:first-child) {
    margin-left: 6px;
  }
</style>
