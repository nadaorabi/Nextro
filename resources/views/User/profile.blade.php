@extends('layouts.app')

@section('title', 'Profile Settings')

@section('hero')
<link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-3-min.jpg') }}');">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Profile Settings</h1>
                <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
                    <p>Manage your profile information, security, notifications, and more.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
        </ol>
    </nav>

    <div class="row gutters-sm">
      <div class="col-md-4 d-none d-md-block">
        <div class="card">
          <div class="card-body">
            <nav class="nav flex-column nav-pills nav-gap-y-1" id="studentProfileTabs">

              <!-- Profile -->
              <a href="#profile" data-toggle="tab" class="nav-item nav-link active">
                <i class="fas fa-user-circle mr-2"></i> Profile Information
              </a>
            
              <!-- Academic Documents -->
              <a href="#academic-Documents" data-toggle="tab" class="nav-item nav-link">
                <i class="fas fa-file-alt mr-2"></i> Academic Documents
              </a>
            
              <!-- Contact Us -->
              <a href="#Contact-Us" data-toggle="tab" class="nav-item nav-link">
                <i class="fas fa-envelope mr-2"></i> Contact Us
              </a>
            
              <!-- Notifications -->
              <a href="#notification" data-toggle="tab" class="nav-item nav-link">
                <i class="fas fa-bell mr-2"></i> Notification
              </a>
            
              <!-- Registered Courses -->
              <a href="#registered-Courses" data-toggle="tab" class="nav-item nav-link">
                <i class="fas fa-list mr-2"></i> Registered Courses
              </a>
            
              <!-- Attendance Record -->
              <a href="#attendance-Record" data-toggle="tab" class="nav-item nav-link">
                <i class="fas fa-calendar-check mr-2"></i> Attendance Record
              </a>
            
              <!-- Grades -->
              <a href="#grade" data-toggle="tab" class="nav-item nav-link">
                <i class="fas fa-chart-line mr-2"></i> Grades
              </a>
            
              <!-- Financial Status -->
              <a href="#Financial-Status" data-toggle="tab" class="nav-item nav-link">
                <i class="fas fa-wallet mr-2"></i> Financial Status
              </a>
            
              <!-- Academic Status -->
              <a href="#Academic-Status" data-toggle="tab" class="nav-item nav-link">
                <i class="fas fa-graduation-cap mr-2"></i> Academic Status
              </a>
                <!--  Scan QR -->
                <a href="#QR" data-toggle="tab" class="nav-item nav-link">
                  <i class="fas fa-qrcode mr-2"></i> Scan QR
                </a>
                
            
            </nav>
            
            
          </div>
        </div>
      </div>

        <div class="col-md-8">
            <div class="card">
            <!-- قائمة منسدلة بديلة عن <select> تظهر فقط في الموبايل -->
              <div class="card-header d-block d-md-none">
                <div class="dropdown">
                  <button class="btn btn-outline-primary btn-block dropdown-toggle text-left" type="button" id="mobileDropdownBtn"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle mr-2"></i>
                    <span id="mobileDropdownLabel">Profile Information</span>
                  </button>
                  <div class="dropdown-menu w-100" aria-labelledby="mobileDropdownBtn">
                    <a class="dropdown-item" href="#profile"><i class="fas fa-user-circle mr-2"></i> Profile Information</a>
                    <a class="dropdown-item" href="#academic-Documents"><i class="fas fa-file-alt mr-2"></i> Academic Documents</a>
                    <a class="dropdown-item" href="#Contact-Us"><i class="fas fa-envelope mr-2"></i> Contact Us</a>
                    <a class="dropdown-item" href="#notification"><i class="fas fa-bell mr-2"></i> Notification</a>
                    <a class="dropdown-item" href="#registered-Courses"><i class="fas fa-list mr-2"></i> Registered Courses</a>
                    <a class="dropdown-item" href="#attendance-Record"><i class="fas fa-calendar-check mr-2"></i> Attendance Record</a>
                    <a class="dropdown-item" href="#grade"><i class="fas fa-chart-line mr-2"></i> Grades</a>
                    <a class="dropdown-item" href="#Financial-Status"><i class="fas fa-wallet mr-2"></i> Financial Status</a>
                    <a class="dropdown-item" href="#Academic-Status"><i class="fas fa-graduation-cap mr-2"></i> Academic Status</a>
                    <a class="dropdown-item" href="#QR"><i class="fas fa-qrcode mr-2"></i> Scan QR</a>
                  </div>
                </div>
              </div>
              
              <script>
                document.addEventListener('DOMContentLoaded', function () {
                  const links = document.querySelectorAll('.dropdown-menu .dropdown-item');
                  const label = document.getElementById('mobileDropdownLabel');
              
                  links.forEach(link => {
                    link.addEventListener('click', function (e) {
                      e.preventDefault();
              
                      const targetHref = this.getAttribute('href');
                      const text = this.textContent.trim();
              
                      // Update active tab in sidebar
                      document.querySelectorAll('#studentProfileTabs a').forEach(el => el.classList.remove('active'));
                      const sidebarLink = document.querySelector(`#studentProfileTabs a[href="${targetHref}"]`);
                      if (sidebarLink) sidebarLink.classList.add('active');
              
                      // Update tab pane
                      document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
                      const targetPane = document.querySelector(targetHref);
                      if (targetPane) targetPane.classList.add('show', 'active');
              
                      // Update dropdown button label
                      label.innerHTML = text;
              
                      // Scroll to tab
                      targetPane?.scrollIntoView({ behavior: 'smooth' });
                    });
                  });
              
                  // On page load: set dropdown label to active tab
                  const activeTab = document.querySelector('.tab-pane.show.active');
                  if (activeTab) {
                    const activeLink = document.querySelector(`.dropdown-menu a[href="#${activeTab.id}"]`);
                    if (activeLink) label.innerHTML = activeLink.textContent.trim();
                  }
                });
              </script>
              
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const links = document.querySelectorAll('.dropdown-menu .dropdown-item');
    links.forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();

        // Remove active class from all tab buttons
        document.querySelectorAll('#studentProfileTabs a').forEach(el => el.classList.remove('active'));

        // Activate the clicked tab in sidebar (desktop version hidden on mobile)
        const targetHref = this.getAttribute('href');
        const sidebarLink = document.querySelector(`#studentProfileTabs a[href="${targetHref}"]`);
        if (sidebarLink) sidebarLink.classList.add('active');

        // Activate the target tab pane
        document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show', 'active'));
        const targetPane = document.querySelector(targetHref);
        if (targetPane) targetPane.classList.add('show', 'active');

        // Optional: Scroll to the tab content (helpful on mobile)
        targetPane?.scrollIntoView({ behavior: 'smooth' });
      });
    });
  });
</script>

            
            <script>
              document.addEventListener('DOMContentLoaded', function() {
                const select = document.getElementById('mobileNavTabs');
                select.addEventListener('change', function() {
                  const target = document.querySelector(`a[href="${this.value}"]`);
                  if (target) target.click();
                });
              });
            </script>
            
                <div class="card-body tab-content">
                    {{-- Profile Information Tab --}}
                    <div class="tab-pane fade show active" id="profile">
                      @include('profile_parts/profile-info')
                    </div>

                    {{-- Academic Documents  Tab --}}
                    <div class="tab-pane fade" id="academic-Documents">
                      @include('profile_parts/academic-Documents')

                    </div>

                    {{-- Contact UsTab --}}
                    <div class="tab-pane fade" id="Contact-Us">
                       @include('profile_parts.Contact-Us') 
                    </div>

                    {{-- Notification Settings Tab --}}
                    <div class="tab-pane fade" id="notification">
                         @include('profile_parts.notification')
                    </div>

                     {{-- Registered Courses Tab --}}
                     <div class="tab-pane fade" id="registered-Courses">
                      @include('profile_parts.registered-Courses') 
                  </div>
                   {{-- Attendance Record Tab --}}
                   <div class="tab-pane fade" id="attendance-Record">
                    @include('profile_parts.attendance-Record') 
                </div>
                  {{--  Grades Tab --}}
                  <div class="tab-pane fade" id="grade">
                    @include('profile_parts.grade') 
                </div>
                 {{--  Financial Status Tab --}}
                 <div class="tab-pane fade" id="Financial-Status">
                  @include('profile_parts.Financial-Status') 
              </div>
               {{-- Academic Status Tab --}}
               <div class="tab-pane fade" id="Academic-Status">
                @include('profile_parts.Academic-Status') 
            </div>
              {{-- Scan QR Tab --}}
              <div class="tab-pane fade" id="QR">
                @include('profile_parts.QR') 
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection