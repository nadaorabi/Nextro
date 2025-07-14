<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
    Add New Exam - {{ Auth::user()->name }}
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
  <style>
    .page-header {
      background: linear-gradient(135deg,rgb(255, 255, 255) 0%,rgb(255, 255, 255) 100%);
      color: rgb(123, 105, 172);
      border-radius: 15px;
      padding: 1.2rem;
      margin-bottom: 1rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    
    .form-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 2px 15px rgba(0,0,0,0.08);
      border: none;
      transition: all 0.3s ease;
    }
    
    .form-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 25px rgba(0,0,0,0.12);
    }
    
    .card-header {
      background: linear-gradient(135deg,rgb(245, 247, 249) 0%,rgb(255, 255, 255) 100%);
      color: rgb(123, 105, 172);
      border-radius: 15px 15px 0 0;
      border: none;
    }
    
    .card-header h5, .card-header h6 {
      color: rgb(123, 105, 172) !important;
      font-weight: 600;
    }
    
    .card-header i {
      color: rgb(123, 105, 172) !important;
    }
    
    .form-control {
      border-radius: 10px;
      border: 1px solid #e9ecef;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: rgb(123, 105, 172);
      box-shadow: 0 0 0 0.2rem rgba(123, 105, 172, 0.25);
    }
    
    .form-control-label {
      color: rgb(123, 105, 172);
      font-weight: 600;
      font-size: 0.875rem;
    }
    
    .btn-primary {
      background: linear-gradient(135deg, rgb(123, 105, 172) 0%, rgb(103, 85, 152) 100%);
      border: none;
      border-radius: 10px;
      padding: 0.75rem 1.5rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 15px rgba(123, 105, 172, 0.4);
    }
    
    .btn-secondary {
      background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
      border: none;
      border-radius: 10px;
      padding: 0.75rem 1.5rem;
      font-weight: 600;
      transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 15px rgba(108, 117, 125, 0.4);
    }
    
    .form-group {
      margin-bottom: 1.5rem;
    }
    
    .invalid-feedback {
      color: #dc3545;
      font-size: 0.875rem;
    }
    
    .form-text {
      color: #6c757d;
      font-size: 0.875rem;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">

  @include('teacher.parts.sidebar-teacher')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
  
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      
      <!-- Page Header -->
      <div class="row mb-2">
        <div class="col-12">
          <div class="page-header">
            <div class="d-flex align-items-center">
              <div class="me-3">
                <i class="fas fa-file-alt fa-2x"></i>
              </div>
              <div>
                <h2 class="mb-1">Add New Exam</h2>
                <p class="mb-0 opacity-75">Create a new examination for your students</p>
              </div>
            </div>
          </div>
        </div>
      </div>
     
      <div class="row">
        <div class="col-12">
          <div class="form-card card">
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                  <i class="fas fa-edit text-muted me-2"></i>
                  <h5 class="mb-0">Exam Details</h5>
                </div>
                <a href="{{ route('teacher.exams.index') }}" class="btn btn-secondary btn-sm">
                  <i class="fas fa-arrow-left"></i> Back to Exams
                </a>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ route('teacher.exams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="title" class="form-control-label">Exam Title</label>
                      <input type="text" class="form-control @error('title') is-invalid @enderror" 
                             id="title" name="title" value="{{ old('title') }}" required>
                      @error('title')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="course_id" class="form-control-label">Course</label>
                      <select class="form-control @error('course_id') is-invalid @enderror" 
                              id="course_id" name="course_id" required>
                        <option value="">Select Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                {{ $course->title }}
                            </option>
                        @endforeach
                      </select>
                      @error('course_id')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="description" class="form-control-label">Exam Description</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="description" name="description" rows="3">{{ old('description') }}</textarea>
                  @error('description')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="type" class="form-control-label">Exam Type</label>
                      <select class="form-control @error('type') is-invalid @enderror" 
                              id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="manual" {{ old('type') == 'manual' ? 'selected' : '' }}>Manual (Teacher Graded)</option>
                        <option value="auto" {{ old('type') == 'auto' ? 'selected' : '' }}>Auto (Auto Graded)</option>
                      </select>
                      @error('type')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="delivery_type" class="form-control-label">Delivery Method</label>
                      <select class="form-control @error('delivery_type') is-invalid @enderror" 
                              id="delivery_type" name="delivery_type" required onchange="toggleDeliveryMethod()">
                        <option value="">Select Method</option>
                        <option value="online" {{ old('delivery_type') == 'online' ? 'selected' : '' }}>Online (Questions on website)</option>
                        <option value="file" {{ old('delivery_type') == 'file' ? 'selected' : '' }}>File Upload (Student downloads file)</option>
                      </select>
                      @error('delivery_type')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="duration" class="form-control-label">Duration (minutes)</label>
                      <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                             id="duration" name="duration" value="{{ old('duration', 60) }}" required>
                      @error('duration')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="total_grade" class="form-control-label">Total Grade</label>
                      <input type="number" step="0.01" class="form-control @error('total_grade') is-invalid @enderror" 
                             id="total_grade" name="total_grade" value="{{ old('total_grade', 100) }}" required>
                      @error('total_grade')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="start_at" class="form-control-label">Start Date</label>
                      <input type="datetime-local" class="form-control @error('start_at') is-invalid @enderror" 
                             id="start_at" name="start_at" value="{{ old('start_at') }}">
                      @error('start_at')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="end_at" class="form-control-label">End Date</label>
                      <input type="datetime-local" class="form-control @error('end_at') is-invalid @enderror" 
                             id="end_at" name="end_at" value="{{ old('end_at') }}">
                      @error('end_at')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <!-- File Upload Section (hidden by default) -->
                <div id="fileUploadSection" class="form-group" style="display: none;">
                  <label for="exam_file" class="form-control-label">Exam File</label>
                  <input type="file" class="form-control @error('exam_file') is-invalid @enderror" 
                         id="exam_file" name="exam_file" accept=".pdf,.doc,.docx,.txt">
                  <small class="form-text text-muted">Supported formats: PDF, DOC, DOCX, TXT (Max size: 10MB)</small>
                  @error('exam_file')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Exam
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
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
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark"></span>
            <span class="badge filter bg-gradient-info" data-color="info"></span>
            <span class="badge filter bg-gradient-success" data-color="success"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary px-3 mb-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0" target="_blank">
            <i class="fab fa-twitter me-1"></i>Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0" target="_blank">
            <i class="fab fa-facebook-square me-1"></i>Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    
    function toggleDeliveryMethod() {
      const deliveryType = document.getElementById('delivery_type').value;
      const fileSection = document.getElementById('fileUploadSection');
      const fileInput = document.getElementById('exam_file');
      
      if (deliveryType === 'file') {
        fileSection.style.display = 'block';
        fileInput.required = true;
      } else {
        fileSection.style.display = 'none';
        fileInput.required = false;
      }
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
      toggleDeliveryMethod();
    });
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/argon-dashboard.js') }}"></script>
</body>

</html> 