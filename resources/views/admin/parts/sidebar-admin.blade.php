<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<style>
.sidenav {
  height: auto !important;
  min-height: 0 !important;
  overflow-y: visible !important;
  scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none; /* IE 10+ */
}
.sidenav .navbar-nav {
  height: auto !important;
  overflow: visible !important;
  display: block !important;
}
#sidenav-main {
  overflow-y: visible !important;
  height: auto !important;
  scrollbar-width: none; /* Firefox */
  -ms-overflow-style: none; /* IE 10+ */
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
  display: none; /* Chrome, Safari, Opera */
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
#sidebar-overlay { display: none !important; }

/* Active/selected menu item styling */
.nav-link.active {
  background-color: #e3f2fd !important;
  color: #1976d2 !important;
  border-radius: 8px !important;
  margin: 2px 8px !important;
}

/* Hover effect for menu items */
.nav-link:hover {
  background-color: #f5f9ff !important;
  border-radius: 8px !important;
  margin: 2px 8px !important;
}

/* Remove hover effects for logout button */
.nav-item form button.nav-link:hover {
  background-color: transparent !important;
  box-shadow: none !important;
  transform: none !important;
  border-radius: 0 !important;
  margin: 0 !important;
}

/* Remove hover effects for icon button */
.nav-item .nav-link[href="javascript:;"]:hover {
  background-color: transparent !important;
  box-shadow: none !important;
  transform: none !important;
  border-radius: 0 !important;
  margin: 0 !important;
}
</style>
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
              style="outline:none; box-shadow:none; transition:none;">
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
          <a href="javascript:;" class="nav-link text-white p-0" style="outline:none; box-shadow:none; transition:none;">
            <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
          </a>
        </li>
        <li class="nav-item dropdown pe-2 d-flex align-items-center">
          <div
            class="d-flex align-items-center flex-row flex-md-row flex-sm-row flex-wrap gap-2 gap-md-2 gap-lg-2 user-profile-navbar position-relative">
            <i class="fa fa-bell cursor-pointer me-2 d-none d-sm-inline"></i>
            <a href="{{ route('admin.profile') }}" class="d-flex align-items-center text-decoration-none">
              <i class="fa fa-bell cursor-pointer me-2 d-inline d-sm-none" style="font-size: 22px;"></i>
              <div class="avatar avatar-sm rounded-circle me-2 profile-img d-flex align-items-center justify-content-center"
                style="width: 32px; height: 32px; background-color: #6c757d; color: white; font-weight: bold; font-size: 14px;">
                {{ substr(Auth::user()->name ?? 'Admin', 0, 2) }}
              </div>
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
<aside class="sidenav bg-light-blue navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
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
  <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav" id="sidebarAccordion">
      <!-- Dashboard -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-home text-dark text-sm opacity-10"></i>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <!-- Accounts (User Management) -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#accountsSubmenu" aria-expanded="{{ request()->routeIs('admin.accounts.*') ? 'true' : 'false' }}">
          <i class="fas fa-users text-dark text-sm opacity-10"></i>
          <span class="nav-link-text ms-1">Accounts</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.accounts.*') ? 'show' : '' }}" id="accountsSubmenu" data-bs-parent="#sidebarAccordion">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.accounts.students.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#studentsSubmenu" aria-expanded="{{ request()->routeIs('admin.accounts.students.*') ? 'true' : 'false' }}">
              <i class="fas fa-user-graduate text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Students</span>
            </a>
            <ul class="nav flex-column collapse {{ request()->routeIs('admin.accounts.students.*') ? 'show' : '' }}" id="studentsSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.students.create') ? 'active' : '' }}" href="{{ route('admin.accounts.students.create') }}">
                  <i class="fas fa-user-plus text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">Add Student</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.students.list') ? 'active' : '' }}" href="{{ route('admin.accounts.students.list') }}">
                  <i class="fas fa-list text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">View Students</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.accounts.teachers.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#teachersSubmenu" aria-expanded="{{ request()->routeIs('admin.accounts.teachers.*') ? 'true' : 'false' }}">
              <i class="fas fa-chalkboard-teacher text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Teachers</span>
            </a>
            <ul class="nav flex-column collapse {{ request()->routeIs('admin.accounts.teachers.*') ? 'show' : '' }}" id="teachersSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.teachers.create') ? 'active' : '' }}" href="{{ route('admin.accounts.teachers.create') }}">
                  <i class="fas fa-user-plus text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">Add Teacher</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.teachers.list') ? 'active' : '' }}" href="{{ route('admin.accounts.teachers.list') }}">
                  <i class="fas fa-list text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">View Teachers</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.accounts.admins.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#adminsSubmenu" aria-expanded="{{ request()->routeIs('admin.accounts.admins.*') ? 'true' : 'false' }}">
              <i class="fas fa-user-shield text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Admins</span>
            </a>
            <ul class="nav flex-column collapse {{ request()->routeIs('admin.accounts.admins.*') ? 'show' : '' }}" id="adminsSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.admins.create') ? 'active' : '' }}" href="{{ route('admin.accounts.admins.create') }}">
                  <i class="fas fa-user-plus text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">Add Admin</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.accounts.admins.list') ? 'active' : '' }}" href="{{ route('admin.accounts.admins.list') }}">
                  <i class="fas fa-list text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">View Admins</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <!-- Materials (Education) -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.educational-categories.*') || request()->routeIs('admin.educational-courses.*') || request()->routeIs('admin.educational-packages.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#educationSubmenu" aria-expanded="{{ request()->routeIs('admin.educational-categories.*') || request()->routeIs('admin.educational-courses.*') || request()->routeIs('admin.educational-packages.*') ? 'true' : 'false' }}">
          <i class="fas fa-book text-dark text-sm opacity-10"></i>
          <span class="nav-link-text ms-1">Materials</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.educational-categories.*') || request()->routeIs('admin.educational-courses.*') || request()->routeIs('admin.educational-packages.*') ? 'show' : '' }}" id="educationSubmenu">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.educational-categories.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#categoriesSubmenu" aria-expanded="{{ request()->routeIs('admin.educational-categories.*') ? 'true' : 'false' }}">
              <i class="fas fa-sitemap text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Categories</span>
            </a>
            <ul class="nav flex-column collapse {{ request()->routeIs('admin.educational-categories.*') ? 'show' : '' }}" id="categoriesSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-categories.create') ? 'active' : '' }}" href="{{ route('admin.educational-categories.create') }}">
                  <i class="fas fa-plus text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">Create Category</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-categories.index') ? 'active' : '' }}" href="{{ route('admin.educational-categories.index') }}">
                  <i class="fas fa-list text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">View Categories</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.educational-courses.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#coursesSubmenu" aria-expanded="{{ request()->routeIs('admin.educational-courses.*') ? 'true' : 'false' }}">
              <i class="fas fa-graduation-cap text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Courses</span>
            </a>
            <ul class="nav flex-column collapse {{ request()->routeIs('admin.educational-courses.*') ? 'show' : '' }}" id="coursesSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-courses.create') ? 'active' : '' }}" href="{{ route('admin.educational-courses.create') }}">
                  <i class="fas fa-plus text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">Create Course</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-courses.index') ? 'active' : '' }}" href="{{ route('admin.educational-courses.index') }}">
                  <i class="fas fa-list text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">View Courses</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.educational-packages.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#packagesSubmenu" aria-expanded="{{ request()->routeIs('admin.educational-packages.*') ? 'true' : 'false' }}">
              <i class="fas fa-box text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Packages</span>
            </a>
            <ul class="nav flex-column collapse {{ request()->routeIs('admin.educational-packages.*') ? 'show' : '' }}" id="packagesSubmenu">
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-packages.create') ? 'active' : '' }}" href="{{ route('admin.educational-packages.create') }}">
                  <i class="fas fa-plus text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">Create Package</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.educational-packages.index') ? 'active' : '' }}" href="{{ route('admin.educational-packages.index') }}">
                  <i class="fas fa-list text-dark text-sm opacity-10"></i>
                  <span class="nav-link-text ms-1">View Packages</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </li>
      <!-- Facilities -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.facilities.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#facilitiesSubmenu" aria-expanded="{{ request()->routeIs('admin.facilities.*') ? 'true' : 'false' }}">
          <i class="fas fa-building text-dark text-sm opacity-10"></i>
          <span class="nav-link-text ms-1">Facilities</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.facilities.*') ? 'show' : '' }}" id="facilitiesSubmenu" data-bs-parent="#sidebarAccordion">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.facilities.rooms.*') ? 'active' : '' }}" href="{{ route('admin.facilities.rooms.index') }}">
              <i class="fas fa-door-open text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Rooms</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- Schedules -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.schedules.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#schedulesSubmenu" aria-expanded="{{ request()->routeIs('admin.schedules.*') ? 'true' : 'false' }}">
          <i class="fas fa-calendar-alt text-dark text-sm opacity-10"></i>
          <span class="nav-link-text ms-1">Schedules</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.schedules.*') ? 'show' : '' }}" id="schedulesSubmenu">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.schedules.index') ? 'active' : '' }}" href="{{ route('admin.schedules.index') }}">
              <i class="fas fa-calendar-day text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Course Scheduling</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.schedules.board') ? 'active' : '' }}" href="{{ route('admin.schedules.board') }}">
              <i class="fas fa-table text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Management Tables</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- Attendance -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.attendance.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#attendanceSubmenu" aria-expanded="{{ request()->routeIs('admin.attendance.*') ? 'true' : 'false' }}">
          <i class="fas fa-user-check text-dark text-sm opacity-10"></i>
          <span class="nav-link-text ms-1">Attendance</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.attendance.*') ? 'show' : '' }}" id="attendanceSubmenu">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.attendance.index') ? 'active' : '' }}" href="{{ route('admin.attendance.index') }}">
              <i class="fas fa-calendar-check text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Attendance & Absence</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- Finance -->
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.finance.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#financeSubmenu" aria-expanded="{{ request()->routeIs('admin.finance.*') ? 'true' : 'false' }}">
          <i class="fas fa-wallet text-dark text-sm opacity-10"></i>
          <span class="nav-link-text ms-1">Finance</span>
        </a>
        <ul class="nav flex-column collapse {{ request()->routeIs('admin.finance.*') ? 'show' : '' }}" id="financeSubmenu" data-bs-parent="#sidebarAccordion">
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.finance.payments') ? 'active' : '' }}" href="{{ route('admin.finance.payments') }}">
              <i class="fas fa-money-check-alt text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Payments</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}" href="/admin/transactions">
              <i class="fas fa-chart-line text-dark text-sm opacity-10"></i>
              <span class="nav-link-text ms-1">Transactions</span>
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