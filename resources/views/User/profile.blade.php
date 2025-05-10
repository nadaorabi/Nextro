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
            
            </nav>
            
            
          </div>
        </div>
      </div>

        <div class="col-md-8">
            <div class="card">
              <div class="card-header border-bottom mb-3 d-flex d-md-none">
                <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                  <li class="nav-item">
                    <a href="#profile" data-toggle="tab" class="nav-link has-icon active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#academic-Documents" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#Contact-Us" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#notification" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg></a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="#registered-Courses" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#attendance-Record" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#grade" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#Financial-Status" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#Academic-Status" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>
                  </li>
                </ul>
              </div>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection