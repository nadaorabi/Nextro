<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
  /* --- Enhanced Sidebar UI/UX --- */

  /* General Link Styling & Spacing */
  .sidenav .nav-item .nav-link {
    transition: all 0.2s ease-in-out;
    border-radius: 0.375rem;
    margin: 3px 1rem; /* Added more consistent margin */
    padding: 0.7rem 1rem;
    color: #67748e; /* Softer default text color */
  }

  /* Hover Effect for Non-Active Links */
  .sidenav .nav-item .nav-link:not(.active):hover {
    background-color: rgba(58, 116, 254, 0.08);
    transform: translateX(4px);
    color: #3a74fe;
  }

  /* Active Link Styling */
  .sidenav .nav-item .nav-link.active {
    background: linear-gradient(90deg, rgba(58, 116, 254, 0.9), rgba(58, 116, 254, 0.8));
    color: #fff;
    font-weight: 600;
    box-shadow: 0 4px 8px -2px rgba(58, 116, 254, 0.4);
  }

  /* Dropdown Arrow Indicator */
  .sidenav .nav-link[data-bs-toggle="collapse"] {
    position: relative;
  }
  .sidenav .nav-link[data-bs-toggle="collapse"]::after {
    content: '\f104'; /* FontAwesome chevron-left */
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    position: absolute;
    right: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
    font-size: 0.9rem;
  }

  .sidenav .nav-link[data-bs-toggle="collapse"][aria-expanded="true"]::after {
    transform: translateY(-50%) rotate(-90deg);
  }

  /* Nested Menu Structure & Styling */
  .sidenav .navbar-nav .collapse {
    margin-top: 0.5rem;
    margin-left: 0;
    padding-left: 1rem;
    border-left: 2px solid #e9ecef;
  }
  
  .sidenav .navbar-nav .collapse .nav-link {
    font-size: 0.88em;
    font-weight: 500;
    margin: 1px 0;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
  }

  .sidenav .navbar-nav .collapse .nav-link.active {
      font-weight: 600;
      color: #3a74fe;
      background: transparent;
      box-shadow: none;
  }
  
  .sidenav .navbar-nav .collapse .nav-link:hover {
      color: #3a74fe;
  }

  /* Additional styling to prevent overflow */
  .sidenav .navbar-nav .collapse .nav-item {
    margin-left: 0;
    margin-right: 0;
  }

  .sidenav .navbar-nav .collapse .nav-item .nav-link {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* Ensure sidebar content doesn't overflow */
  .sidenav .navbar-nav {
    width: 100%;
    max-width: 100%;
  }

  .sidenav .navbar-nav .nav-item {
    width: 100%;
  }

  .sidenav .navbar-nav .nav-link {
    width: 100%;
    box-sizing: border-box;
  }

  /* Prevent nested menus from overflowing */
  .sidenav .navbar-nav .collapse {
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
  }

  .sidenav .navbar-nav .collapse .nav-link {
    width: 100%;
    box-sizing: border-box;
    word-wrap: break-word;
  }

  .sidenav {
    height: auto !important;
    min-height: 0 !important;
    overflow-y: visible !important;
    scrollbar-width: none;
    /* Firefox */
    -ms-overflow-style: none;
    /* IE 10+ */
  }

  .sidenav .navbar-nav {
    height: auto !important;
    overflow: visible !important;
    display: block !important;
  }

  #sidenav-main {
    overflow-y: visible !important;
    height: auto !important;
    scrollbar-width: none;
    /* Firefox */
    -ms-overflow-style: none;
    /* IE 10+ */
    z-index: 1050;
    background: #fff !important;
    box-shadow: 0 0 2rem 0 rgba(136, 152, 170, .15);
  }

  .sidenav .collapse.navbar-collapse {
    height: 100% !important;
    overflow: visible !important;
  }

  .sidenav::-webkit-scrollbar,
  #sidenav-main::-webkit-scrollbar {
    display: none;
    /* Chrome, Safari, Opera */
  }

  @media (max-width: 575.98px) {
    .navbar-main .nav-item .d-flex.align-items-center {
      flex-direction: column !important;
      align-items: flex-end !important;
      gap: 0.25rem !important;
    }

    .navbar-main .nav-item .d-flex.align-items-center a span {
      display: block !important;
      margin-top: 2px;
      font-size: 13px;
    }

    .navbar-main .nav-item .d-flex.align-items-center a img {
      margin-right: 0 !important;
    }

    .navbar-main .nav-item .user-profile-navbar {
      flex-direction: row !important;
      align-items: flex-start !important;
      gap: 0.5rem !important;
      position: relative;
    }

    .navbar-main .nav-item .user-profile-navbar .profile-img {
      margin-right: 0 !important;
    }

    .navbar-main .nav-item .user-profile-navbar .user-name {
      display: block !important;
      width: 100%;
      text-align: right;
      margin-top: 2px;
      font-size: 13px;
    }

    .navbar-main .nav-item .user-profile-navbar a {
      flex-direction: row !important;
      align-items: center !important;
    }

    .navbar-main .nav-item .user-profile-navbar .fa-bell.d-inline.d-sm-none {
      margin-right: 0.25rem !important;
      color: #fff;
      font-size: 22px;
      order: 1;
    }
  }

  .main-content {
    margin-left: 290px !important;
  }

  @media (max-width: 991.98px) {
    .main-content {
      margin-left: 0 !important;
    }
  }

  /* Remove sidebar overlay and keep sidebar solid */
  #sidebar-overlay {
    display: none !important;
  }
</style>
<div class="min-height-300 position-absolute w-100" style="background: rgb(156, 200, 247);"></div>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
  data-scroll="false">
  <div class="container-fluid py-1 px-3 position-relative">
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <div class="input-group">
          <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
          <input type="text" class="form-control" placeholder="Search...">
        </div>
      </div>
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item d-flex align-items-center">
          <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="nav-link text-white font-weight-bold px-0 bg-transparent border-0"
              style="outline:none;">
              <i class="fa fa-sign-out-alt me-sm-1"></i>
              <span class="d-sm-inline d-none">Logout</span>
            </button>
          </form>
        </li>
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
            </div>
          </a>
        </li>
        <li class="nav-item px-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white p-0">
            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
          </a>
        </li>
        <li class="nav-item dropdown pe-2 d-flex align-items-center">
          <div
            class="d-flex align-items-center flex-row flex-md-row flex-sm-row flex-wrap gap-2 gap-md-2 gap-lg-2 user-profile-navbar position-relative">
            <i class="fa fa-bell cursor-pointer me-2 d-none d-sm-inline"></i>
            <a href="{{ route('admin.profile') }}" class="d-flex align-items-center text-decoration-none">
              <i class="fa fa-bell cursor-pointer me-2 d-inline d-sm-none" style="font-size: 22px;"></i>
              <img src="{{ asset('images/team-2.jpg') }}" class="avatar avatar-sm rounded-circle me-2 profile-img"
                style="width: 32px; height: 32px; object-fit: cover;">
              <span class="text-white fw-bold d-none d-sm-inline user-name"
                style="white-space:nowrap;">{{ Auth::user()->name ?? 'Admin' }}</span>
            </a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="fixed-plugin">
  <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
    <i class="fa fa-cog py-2"> </i>
  </a>
  <div class="card shadow-lg">
    <div class="card-header pb-0 pt-3 ">
      <div class="float-start">
        <h5 class="mt-3 mb-0">Argon Configurator</h5>
        <p>See our dashboard options.</p>
      </div>
      <div class="float-end mt-4">
        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
          <i class="fa fa-close"></i>
        </button>
      </div>
      <!-- End Toggle Button -->
    </div>
    <hr class="horizontal dark my-1">
    <div class="card-body pt-sm-3 pt-0 overflow-auto">
      <!-- Sidebar Backgrounds -->
      <div>
        <h6 class="mb-0">Sidebar Colors</h6>
      </div>
      <a href="javascript:void(0)" class="switch-trigger background-color">
        <div class="badge-colors my-2 text-start">
          <span class="badge filter bg-gradient-primary active" data-color="primary"
            onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
          <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
        </div>
      </a>
      <!-- Navbar Fixed -->
      <div class="d-flex my-3">
        <h6 class="mb-0">Navbar Fixed</h6>
        <div class="form-check form-switch ps-0 ms-auto my-auto">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
      </div>
      <hr class="horizontal dark my-sm-4">
      <div class="mt-2 mb-5 d-flex">
        <h6 class="mb-0">Light / Dark</h6>
        <div class="form-check form-switch ps-0 ms-auto my-auto">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
        </div>
      </div>
      <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free
        Download</a>
      <a class="btn btn-outline-dark w-100"
        href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
      <div class="w-100 text-center">
        <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star"
          data-size="large" data-show-count="true"
          aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
        <h6 class="mt-3">Thank you for sharing!</h6>
        <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard"
          class="btn btn-dark mb-0 me-2" target="_blank">
          <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard"
          class="btn btn-dark mb-0 me-2" target="_blank">
          <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
        </a>
      </div>
    </div>
  </div>
</div>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
  id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-8 position-absolute end-0 top-0 d-block d-xl-none"
      aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
      target="_blank">

      <div style="width: 100%; text-align: center; margin-top: -40px;">
        <a href="{{ route('home_page') }}" class="logo menu-absolute m-0"
          style="font-size: 2rem; font-weight: bold; letter-spacing: 2px; display: inline-block;">
          Nextro<span class="text-primary">.</span>
        </a>
      </div>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav" id="sidebarAccordion">
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
          href="{{ route('admin.dashboard') }}">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-tachometer-alt text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>

      <!-- Account Management -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}" href="#" id="accountsDropdown"
          data-bs-toggle="collapse" data-bs-target="#accountsSubmenu"
          aria-expanded="{{ request()->routeIs('admin.accounts.*') ? 'true' : 'false' }}">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-users-cog text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Account Management</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.accounts.*') ? 'show' : '' }}"
          id="accountsSubmenu" data-bs-parent="#sidebarAccordion">
          <!-- Students -->
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.accounts.students.*') ? 'active' : '' }}" href="#"
              id="studentsDropdown" data-bs-toggle="collapse" data-bs-target="#studentsSubmenu"
              aria-expanded="{{ request()->routeIs('admin.accounts.students.*') ? 'true' : 'false' }}">
              <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-user-graduate text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Students</span>
            </a>
            <ul class="nav flex-column collapse {{ request()->routeIs('admin.accounts.students.*') ? 'show' : '' }}"
              id="studentsSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.students.create') ? 'active' : '' }}"
                  href="{{ route('admin.accounts.students.create') }}">
                  <i class="fas fa-user-plus me-2"></i>
                  Add Student
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.students.list') ? 'active' : '' }}"
                  href="{{ route('admin.accounts.students.list') }}">
                  <i class="fas fa-list me-2"></i>
                  View Students
                </a>
              </li>
            </ul>
          </li>
          <!-- Teachers -->
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.accounts.teachers.*') ? 'active' : '' }}" href="#"
              id="teachersDropdown" data-bs-toggle="collapse" data-bs-target="#teachersSubmenu"
              aria-expanded="{{ request()->routeIs('admin.accounts.teachers.*') ? 'true' : 'false' }}">
              <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-chalkboard-teacher text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Teachers</span>
            </a>
            <ul class="nav flex-column collapse {{ request()->routeIs('admin.accounts.teachers.*') ? 'show' : '' }}"
              id="teachersSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.teachers.create') ? 'active' : '' }}"
                  href="{{ route('admin.accounts.teachers.create') }}">
                  <i class="fas fa-user-plus me-2"></i>
                  Add Teacher
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.teachers.list') ? 'active' : '' }}"
                  href="{{ route('admin.accounts.teachers.list') }}">
                  <i class="fas fa-list me-2"></i>
                  View Teachers
                </a>
              </li>
            </ul>
          </li>
          <!-- Admins -->
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.accounts.admins.*') ? 'active' : '' }}" href="#"
              id="adminsDropdown" data-bs-toggle="collapse" data-bs-target="#adminsSubmenu"
              aria-expanded="{{ request()->routeIs('admin.accounts.admins.*') ? 'true' : 'false' }}">
              <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-user-shield text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Admins</span>
            </a>
            <ul class="nav flex-column collapse {{ request()->routeIs('admin.accounts.admins.*') ? 'show' : '' }}"
              id="adminsSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.admins.create') ? 'active' : '' }}"
                  href="{{ route('admin.accounts.admins.create') }}">
                  <i class="fas fa-user-plus me-2"></i>
                  Add Admin
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.admins.list') ? 'active' : '' }}"
                  href="{{ route('admin.accounts.admins.list') }}">
                  <i class="fas fa-list me-2"></i>
                  View Admins
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>

      <!-- Educational Materials Management-->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.educational-categories.*') || request()->routeIs('admin.educational-courses.*') || request()->routeIs('admin.educational-packages.*') ? 'active' : '' }}"
          href="#" id="materialsDropdown" data-bs-toggle="collapse" data-bs-target="#materialsSubmenu"
          aria-expanded="{{ request()->routeIs('admin.educational-categories.*') || request()->routeIs('admin.educational-courses.*') || request()->routeIs('admin.educational-packages.*') ? 'true' : 'false' }}">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-book-open text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Educational Materials</span>
        </a>

        <ul
          class="nav flex-column collapse {{ request()->routeIs('admin.educational-categories.*') || request()->routeIs('admin.educational-courses.*') || request()->routeIs('admin.educational-packages.*') ? 'show' : '' }}"
          id="materialsSubmenu">

          {{-- Category Management--}}
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.educational-categories.*') ? 'active' : '' }}"
              data-bs-toggle="collapse" href="#categoriesSubmenu"
              aria-expanded="{{ request()->routeIs('admin.educational-categories.*') ? 'true' : 'false' }}">
              <i class="fas fa-sitemap me-2 text-dark text-sm opacity-10"></i>
              Categories
            </a>
            <ul
              class="nav flex-column collapse {{ request()->routeIs('admin.educational-categories.*') ? 'show' : '' }}"
              id="categoriesSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-categories.create') ? 'active' : '' }}"
                  href="{{ route('admin.educational-categories.create') }}">
                  <i class="fas fa-plus me-2 text-dark text-sm opacity-10"></i>Create Category
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-categories.index') ? 'active' : '' }}"
                  href="{{ route('admin.educational-categories.index') }}">
                  <i class="fas fa-list me-2 text-dark text-sm opacity-10"></i>View Categories
                </a>
              </li>
            </ul>
          </li>

          {{-- Courses Management --}}
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.educational-courses.*') ? 'active' : '' }}"
              data-bs-toggle="collapse" href="#materialsInnerSubmenu"
              aria-expanded="{{ request()->routeIs('admin.educational-courses.*') ? 'true' : 'false' }}">
              <i class="fas fa-graduation-cap me-2 text-dark text-sm opacity-10"></i>
              Courses
            </a>
            <ul
              class="nav flex-column collapse {{ request()->routeIs('admin.educational-courses.*') ? 'show' : '' }}"
              id="materialsInnerSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-courses.create') ? 'active' : '' }}"
                  href="{{ route('admin.educational-courses.create') }}">
                  <i class="fas fa-plus me-2 text-dark text-sm opacity-10"></i>Create Course
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-courses.index') ? 'active' : '' }}"
                  href="{{ route('admin.educational-courses.index') }}">
                  <i class="fas fa-list me-2 text-dark text-sm opacity-10"></i>View Courses
                </a>
              </li>
            </ul>
          </li>

          {{-- Package management--}}
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.educational-packages.*') ? 'active' : '' }}"
              data-bs-toggle="collapse" href="#packagesSubmenu"
              aria-expanded="{{ request()->routeIs('admin.educational-packages.*') ? 'true' : 'false' }}">
              <i class="fas fa-box-archive me-2 text-dark text-sm opacity-10"></i>
              Packages
            </a>
            <ul class="nav flex-column collapse {{ request()->routeIs('admin.educational-packages.*') ? 'show' : '' }}"
              id="packagesSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-packages.create') ? 'active' : '' }}"
                  href="{{ route('admin.educational-packages.create') }}">
                  <i class="fas fa-plus me-2 text-dark text-sm opacity-10"></i>Create Package
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-packages.index') ? 'active' : '' }}"
                  href="{{ route('admin.educational-packages.index') }}">
                  <i class="fas fa-list me-2 text-dark text-sm opacity-10"></i>View Packages
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </li>


      <!-- Monitoring and Supervision -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.supervision.*') ? 'active' : '' }}" href="#"
          id="monitoringDropdown" data-bs-toggle="collapse" data-bs-target="#monitoringSubmenu"
          aria-expanded="{{ request()->routeIs('admin.supervision.*') ? 'true' : 'false' }}">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-desktop text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Monitoring & Supervision</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.supervision.*') ? 'show' : '' }}"
          id="monitoringSubmenu" data-bs-parent="#sidebarAccordion">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.supervision.attendance') ? 'active' : '' }}"
              href="{{ route('admin.supervision.attendance') }}">
              <i class="fas fa-user-check me-2"></i>
              <span class="nav-link-text">Attendance</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.supervision.complaints') ? 'active' : '' }}"
              href="{{ route('admin.supervision.complaints') }}">
              <i class="fas fa-comment-dots me-2"></i>
              <span class="nav-link-text">Complaints</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.supervision.qr') ? 'active' : '' }}"
              href="{{ route('admin.supervision.qr') }}">
              <i class="fas fa-qrcode me-2"></i>
              <span class="nav-link-text">QR by Course</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Schedules -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.tables.*') ? 'active' : '' }}" href="#" id="scheduleDropdown"
          data-bs-toggle="collapse" data-bs-target="#scheduleSubmenu"
          aria-expanded="{{ request()->routeIs('admin.tables.*') ? 'true' : 'false' }}">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-calendar-alt text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Schedules</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.tables.*') ? 'show' : '' }}"
          id="scheduleSubmenu" data-bs-parent="#sidebarAccordion">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.tables.create') ? 'active' : '' }}" href="{{ route('admin.tables.create') }}">
              <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-plus text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Create Schedule</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.tables.edit') ? 'active' : '' }}" href="{{ route('admin.tables.edit') }}">
              <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-edit text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Edit Schedule</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.tables.list') ? 'active' : '' }}" href="{{ route('admin.tables.list') }}">
              <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-list text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">View Schedules</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Financial -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.finance.*') ? 'active' : '' }}"
          href="{{ route('admin.finance.payments') }}">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-wallet text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Financial Management</span>
        </a>
      </li>

      <!-- Facilities Management -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.facilities.*') ? 'active' : '' }}" href="#"
          id="facilitiesDropdown" data-bs-toggle="collapse" data-bs-target="#facilitiesSubmenu"
          aria-expanded="{{ request()->routeIs('admin.facilities.*') ? 'true' : 'false' }}">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-building-user text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Facilities Management</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.facilities.*') ? 'show' : '' }}"
          id="facilitiesSubmenu" data-bs-parent="#sidebarAccordion">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-door-open text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Add/Edit Hall</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-calendar-week text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Schedule Halls</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fas fa-broom text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Manage Facility Availability</span>
            </a>
          </li>
        </ul>
      </li>

      <!-- Exams Management -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.exams.*') ? 'active' : '' }}" href="#" id="examsDropdown"
          data-bs-toggle="collapse" data-bs-target="#examsSubmenu"
          aria-expanded="{{ request()->routeIs('admin.exams.*') ? 'true' : 'false' }}">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-pencil-ruler text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Exams Management</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.exams.*') ? 'show' : '' }}"
          id="examsSubmenu" data-bs-parent="#sidebarAccordion">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.exams.questions') ? 'active' : '' }}" href="#">
              <i class="fas fa-question-circle me-2"></i> Question Bank
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.exams.list') ? 'active' : '' }}" href="#">
              <i class="fas fa-list-alt me-2"></i> Manage Exams
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.exams.results') ? 'active' : '' }}" href="#">
              <i class="fas fa-poll-h me-2"></i> View Results
            </a>
          </li>
        </ul>
      </li>

      <!-- Reports & Analytics -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="#"
          id="reportsDropdown" data-bs-toggle="collapse" data-bs-target="#reportsSubmenu"
          aria-expanded="{{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }}">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-chart-pie text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Reports & Analytics</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.reports.*') ? 'show' : '' }}"
          id="reportsSubmenu" data-bs-parent="#sidebarAccordion">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.reports.enrollment') ? 'active' : '' }}" href="#">
              <i class="fas fa-users me-2"></i> Enrollment Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.reports.financial') ? 'active' : '' }}" href="#">
              <i class="fas fa-file-invoice-dollar me-2"></i> Financial Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.reports.activity') ? 'active' : '' }}" href="#">
              <i class="fas fa-history me-2"></i> Activity Log
            </a>
          </li>
        </ul>
      </li>

      <!-- Website Management -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.site.*') ? 'active' : '' }}" href="#" id="siteDropdown"
          data-bs-toggle="collapse" data-bs-target="#siteSubmenu"
          aria-expanded="{{ request()->routeIs('admin.site.*') ? 'true' : 'false' }}">
          <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas fa-cogs text-dark text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Website Management</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.site.*') ? 'show' : '' }}"
          id="siteSubmenu" data-bs-parent="#sidebarAccordion">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.site.pages') ? 'active' : '' }}" href="#">
              <i class="fas fa-file-alt me-2"></i> Manage Pages
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.site.announcements') ? 'active' : '' }}" href="#">
              <i class="fas fa-bullhorn me-2"></i> Announcements
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.site.settings') ? 'active' : '' }}" href="#">
              <i class="fas fa-sliders-h me-2"></i> General Settings
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </div>

</aside>
<script>
  // When page loads, retrieve options and apply them
  window.addEventListener('DOMContentLoaded', function () {
    var sidenav = document.getElementById('sidenav-main');
    var darkMode = localStorage.getItem('darkMode');
    if (darkMode === 'on') {
      document.body.classList.add('dark-version');
      if (sidenav) {
        sidenav.classList.remove('bg-white');
        sidenav.classList.add('bg-gradient-dark');
      }
      var darkSwitch = document.getElementById('dark-version');
      if (darkSwitch && !darkSwitch.checked) darkSwitch.checked = true;
    } else {
      document.body.classList.remove('dark-version');
      if (sidenav) {
        sidenav.classList.remove('bg-gradient-dark');
        sidenav.classList.add('bg-white');
      }
      var darkSwitch = document.getElementById('dark-version');
      if (darkSwitch && darkSwitch.checked) darkSwitch.checked = false;
    }
  });
  // When enabling or disabling dark mode
  var darkSwitch = document.getElementById('dark-version');
  if (darkSwitch) {
    darkSwitch.addEventListener('change', function () {
      localStorage.setItem('darkMode', darkSwitch.checked ? 'on' : 'off');
      var sidenav = document.getElementById('sidenav-main');
      if (darkSwitch.checked) {
        document.body.classList.add('dark-version');
        if (sidenav) {
          sidenav.classList.remove('bg-white');
          sidenav.classList.add('bg-gradient-dark');
        }
      } else {
        document.body.classList.remove('dark-version');
        if (sidenav) {
          sidenav.classList.remove('bg-gradient-dark');
          sidenav.classList.add('bg-white');
        }
      }
    });
  }
  // Ignore sidebar color options from configurator
  document.querySelectorAll('.badge.filter').forEach(function (badge) {
    badge.addEventListener('click', function (e) {
      e.preventDefault();
      return false;
    });
  });
  // Sidebar close button for mobile
  document.addEventListener('DOMContentLoaded', function () {
    var closeBtn = document.getElementById('iconSidenav');
    var body = document.body;
    if (closeBtn) {
      closeBtn.addEventListener('click', function () {
        body.classList.remove('g-sidenav-pinned');
        var sidenav = document.getElementById('sidenav-main');
        if (sidenav) {
          sidenav.style.transform = 'translateX(-290px)';
        }
      });
    }
  });
  document.addEventListener('DOMContentLoaded', function () {
    var sidenavToggler = document.getElementById('iconNavbarSidenav');
    var closeBtn = document.getElementById('iconSidenav');
    var body = document.body;
    var sidenav = document.getElementById('sidenav-main');

    function showSidebar() {
      body.classList.add('g-sidenav-pinned');
      if (sidenav) sidenav.style.transform = 'translateX(0)';
    }
    function hideSidebar() {
      body.classList.remove('g-sidenav-pinned');
      if (sidenav) sidenav.style.transform = 'translateX(-290px)';
    }

    if (sidenavToggler) {
      sidenavToggler.addEventListener('click', function () {
        if (body.classList.contains('g-sidenav-pinned')) {
          hideSidebar();
        } else {
          showSidebar();
        }
      });
    }
    if (closeBtn) {
      closeBtn.addEventListener('click', hideSidebar);
    }
  });
  // --- Robust Sidebar Toggle for All Pages & Devices ---
  (function () {
    var sidenavToggler = document.getElementById('iconNavbarSidenav');
    var closeBtn = document.getElementById('iconSidenav');
    var body = document.body;
    var sidenav = document.getElementById('sidenav-main');
    function showSidebar() {
      body.classList.add('g-sidenav-pinned');
      if (sidenav) sidenav.style.transform = 'translateX(0)';
    }
    function hideSidebar() {
      body.classList.remove('g-sidenav-pinned');
      if (sidenav) sidenav.style.transform = 'translateX(-290px)';
    }
    function isMobile() {
      return window.innerWidth <= 991;
    }
    if (sidenavToggler) {
      sidenavToggler.onclick = function (e) {
        e.preventDefault();
        if (body.classList.contains('g-sidenav-pinned')) {
          hideSidebar();
        } else {
          showSidebar();
        }
      };
    }
    if (closeBtn) {
      closeBtn.onclick = function (e) {
        e.preventDefault();
        hideSidebar();
      };
    }
  })();
</script>