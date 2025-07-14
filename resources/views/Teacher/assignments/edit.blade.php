<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  <title>
    Edit Assignment - {{ Auth::user()->name }}
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
    body {
      background: #f8f9fa;
    }
    .page-header {
      background: linear-gradient(135deg, #f5f6fa 0%, #fff 100%);
      color: #7b69ac;
      border-radius: 15px;
      padding: 1.2rem;
      margin-bottom: 1.5rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    }
    .form-card {
      background: white;
      border-radius: 16px;
      box-shadow: 0 2px 16px rgba(123, 105, 172, 0.08);
      border: none;
      transition: box-shadow 0.3s;
    }
    .form-card:hover {
      box-shadow: 0 6px 32px rgba(123, 105, 172, 0.13);
    }
    .card-header {
      background: linear-gradient(135deg, #f5f7f9 0%, #fff 100%);
      color: #7b69ac;
      border-radius: 16px 16px 0 0;
      border: none;
    }
    .card-header h5, .card-header h6 {
      color: #7b69ac !important;
      font-weight: 700;
      letter-spacing: 0.5px;
    }
    .card-header i {
      color: #7b69ac !important;
    }
    .form-control {
      border-radius: 8px;
      border: 1px solid #e9ecef;
      font-size: 1rem;
      padding: 0.75rem 1rem;
      transition: border-color 0.2s;
    }
    .form-control:focus {
      border-color: #7b69ac;
      box-shadow: 0 0 0 2px rgba(123, 105, 172, 0.08);
    }
    .form-control-label {
      color: #7b69ac;
      font-weight: 600;
      font-size: 0.95rem;
    }
    .btn-primary {
      background: linear-gradient(135deg, #7b69ac 0%, #675598 100%);
      border: none;
      border-radius: 10px;
      font-weight: 600;
      color: #fff;
      transition: box-shadow 0.3s, transform 0.2s;
    }
    .btn-primary:hover {
      box-shadow: 0 4px 15px rgba(123, 105, 172, 0.18);
      transform: translateY(-2px);
    }
    .btn-secondary {
      background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
      border: none;
      border-radius: 10px;
      font-weight: 600;
      color: #fff;
      transition: box-shadow 0.3s, transform 0.2s;
    }
    .btn-secondary:hover {
      box-shadow: 0 4px 15px rgba(108, 117, 125, 0.18);
      transform: translateY(-2px);
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
    @media (max-width: 767px) {
      .card-header, .card-body {
        padding: 1rem;
      }
      .form-control-label {
        font-size: 0.92rem;
      }
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
 
  @include('teacher.parts.sidebar-teacher')

  <main class="main-content position-relative border-radius-lg ">
    <!-- Header -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.assignments.index') }}">Assignments</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Edit Assignment</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Edit Assignment</h6>
        </nav>
      </div>
    </nav>
    <!-- End Header -->

    <div class="container-fluid py-4">
      <!-- Page Header -->
      <div class="row mb-2">
        <div class="col-12">
          <div class="page-header">
            <div class="d-flex align-items-center">
              <div class="me-3">
                <i class="fas fa-edit fa-2x"></i>
              </div>
              <div>
                <h2 class="mb-1">Edit Assignment</h2>
                <p class="mb-0 opacity-75">Update assignment details and settings</p>
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
                  <h5 class="mb-0">Assignment Details</h5>
                </div>
                <a href="{{ route('teacher.assignments.index') }}" class="btn btn-secondary btn-sm">
                  <i class="fas fa-arrow-left"></i> Back to Assignments
                </a>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ route('teacher.assignments.update', $assignment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="title" class="form-control-label">Assignment Title</label>
                      <input type="text" class="form-control @error('title') is-invalid @enderror" 
                             id="title" name="title" value="{{ old('title', $assignment->title) }}" required>
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
                        <option value="">Choose Course</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" 
                                    {{ old('course_id', $assignment->course_id) == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
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
                  <label for="description" class="form-control-label">Assignment Description</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="description" name="description" rows="3">{{ old('description', $assignment->description) }}</textarea>
                  @error('description')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="type" class="form-control-label">Assignment Type</label>
                      <select class="form-control @error('type') is-invalid @enderror" 
                              id="type" name="type" required>
                        <option value="">Choose Type</option>
                        <option value="manual" {{ old('type', $assignment->type) == 'manual' ? 'selected' : '' }}>Manual (Teacher Grading)</option>
                        <option value="auto" {{ old('type', $assignment->type) == 'auto' ? 'selected' : '' }}>Auto (Automatic Grading)</option>
                      </select>
                      @error('type')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="delivery_type" class="form-control-label">Delivery Method</label>
                      <select class="form-control @error('delivery_type') is-invalid @enderror" 
                              id="delivery_type" name="delivery_type" required onchange="toggleDeliveryMethod()">
                        <option value="">Choose Method</option>
                        <option value="online" {{ old('delivery_type', $assignment->delivery_type ?? 'online') == 'online' ? 'selected' : '' }}>Online (Questions on website)</option>
                        <option value="file" {{ old('delivery_type', $assignment->delivery_type ?? 'online') == 'file' ? 'selected' : '' }}>File Upload (Student downloads file)</option>
                      </select>
                      @error('delivery_type')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="total_grade" class="form-control-label">Total Grade</label>
                      <input type="number" step="0.01" class="form-control @error('total_grade') is-invalid @enderror" 
                             id="total_grade" name="total_grade" 
                             value="{{ old('total_grade', $assignment->total_grade) }}" required>
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
                             id="start_at" name="start_at" 
                             value="{{ old('start_at', $assignment->start_at ? $assignment->start_at->format('Y-m-d\TH:i') : '') }}">
                      @error('start_at')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="end_at" class="form-control-label">End Date</label>
                      <input type="datetime-local" class="form-control @error('end_at') is-invalid @enderror" 
                             id="end_at" name="end_at" 
                             value="{{ old('end_at', $assignment->end_at ? $assignment->end_at->format('Y-m-d\TH:i') : '') }}">
                      @error('end_at')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <!-- File Upload Section -->
                <div id="fileUploadSection" class="form-group" style="display: {{ ($assignment->delivery_type ?? 'online') == 'file' ? 'block' : 'none' }};">
                  <label for="assignment_file" class="form-control-label">Assignment File</label>
                  @if($assignment->file_path)
                    <div class="mb-2">
                      <strong>Current File:</strong> 
                      <a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank" class="text-primary">
                        <i class="fas fa-download"></i> Download Current File
                      </a>
                    </div>
                  @endif
                  <input type="file" class="form-control @error('assignment_file') is-invalid @enderror" 
                         id="assignment_file" name="assignment_file" accept=".pdf,.doc,.docx,.txt">
                  <small class="form-text text-muted">Supported formats: PDF, DOC, DOCX, TXT (Max size: 10MB). Leave empty to keep current file.</small>
                  @error('assignment_file')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Changes
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.js?v=2.1.0') }}"></script>
  <script>
    function toggleDeliveryMethod() {
      const deliveryType = document.getElementById('delivery_type').value;
      const fileSection = document.getElementById('fileUploadSection');
      const fileInput = document.getElementById('assignment_file');
      
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
</body>

</html> 