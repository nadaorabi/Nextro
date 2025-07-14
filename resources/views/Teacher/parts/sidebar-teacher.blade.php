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
</style>
<div class="min-height-300 position-absolute w-100" style="background: rgb(156, 200, 247);"></div>
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
      data-scroll="false">
      <div class="container-fluid py-1 px-3 position-relative">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <form action="{{ route('teacher.logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="nav-link text-white font-weight-bold px-0 bg-transparent border-0" style="outline:none;">
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
              <div class="d-flex align-items-center flex-row flex-md-row flex-sm-row flex-wrap gap-2 gap-md-2 gap-lg-2 user-profile-navbar position-relative">
                <i class="fa fa-bell cursor-pointer me-2 d-none d-sm-inline"></i>
                <a href="{{ route('teacher.profile') }}" class="d-flex align-items-center text-decoration-none">
                  <i class="fa fa-bell cursor-pointer me-2 d-inline d-sm-none" style="font-size: 22px;"></i>
                  <img src="{{ asset('images/team-2.jpg') }}" class="avatar avatar-sm rounded-circle me-2 profile-img" style="width: 32px; height: 32px; object-fit: cover;">
                  <span class="text-white fw-bold d-none d-sm-inline user-name" style="white-space:nowrap;">{{ Auth::user()->name ?? 'Teacher' }}</span>
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
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
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
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard"
            data-icon="octicon-star" data-size="large" data-show-count="true"
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
<aside
    class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-8 position-absolute end-0 top-0 d-block d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
        target="_blank">
        <div style="width: 100%; text-align: center; margin-top: -40px;">
          <a href="{{ route('home_page') }}" class="logo menu-absolute m-0" style="font-size: 2rem; font-weight: bold; letter-spacing: 2px; display: inline-block;">
            Nextro<span class="text-primary">.</span>
          </a>
        </div>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}" href="{{ route('teacher.dashboard') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('teacher.tables') ? 'active' : '' }}" href="{{ route('teacher.tables') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Tables</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('teacher.students') ? 'active' : '' }}" href="{{ route('teacher.students') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Students</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('teacher.QR-scan') ? 'active' : '' }}" href="{{ route('teacher.QR-scan') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-qrcode text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">QR-scan </span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('teacher.materials.index') ? 'active' : '' }}" href="{{ route('teacher.materials.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-file-upload text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Study Materials</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('teacher.assignments.*') ? 'active' : '' }}" href="{{ route('teacher.assignments.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-tasks text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Assignments</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('teacher.exams.*') ? 'active' : '' }}" href="{{ route('teacher.exams.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-file-alt text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Exams</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('teacher.complaints') ? 'active' : '' }}" href="{{ route('teacher.complaints') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-comments text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Student Complaints</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('teacher.finance') ? 'active' : '' }}" href="{{ route('teacher.finance') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-money-bill-wave text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Finance Management</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('teacher.profile') ? 'active' : '' }}" href="{{ route('teacher.profile') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
<script>
// عند تحميل الصفحة، استرجع الخيارات وطبقها
  window.addEventListener('DOMContentLoaded', function() {
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
// عند تفعيل أو إلغاء الدارك مود
  var darkSwitch = document.getElementById('dark-version');
  if (darkSwitch) {
    darkSwitch.addEventListener('change', function() {
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
// تجاهل خيارات ألوان السايدبار من الكونفيجوراتور
  document.querySelectorAll('.badge.filter').forEach(function(badge) {
    badge.addEventListener('click', function(e) {
      e.preventDefault();
      return false;
    });
  });
// Sidebar close button for mobile
document.addEventListener('DOMContentLoaded', function() {
  var closeBtn = document.getElementById('iconSidenav');
  var body = document.body;
  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      body.classList.remove('g-sidenav-pinned');
      var sidenav = document.getElementById('sidenav-main');
      if (sidenav) {
        sidenav.style.transform = 'translateX(-290px)';
      }
    });
  }
});
document.addEventListener('DOMContentLoaded', function() {
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
    sidenavToggler.addEventListener('click', function() {
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
(function() {
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
    sidenavToggler.onclick = function(e) {
      e.preventDefault();
      if (body.classList.contains('g-sidenav-pinned')) {
        hideSidebar();
      } else {
        showSidebar();
      }
    };
  }
  if (closeBtn) {
    closeBtn.onclick = function(e) {
      e.preventDefault();
      hideSidebar();
    };
  }
  function handleSidebarOnResize() {
    if (!sidenav) return;
    if (isMobile()) {
      hideSidebar();
      if (sidenavToggler) sidenavToggler.style.display = 'block';
    } else {
      showSidebar();
      if (sidenavToggler) sidenavToggler.style.display = 'none';
    }
  }
  window.addEventListener('resize', handleSidebarOnResize);
  handleSidebarOnResize();
})();
</script>