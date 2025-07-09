<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  <title>
    تعديل الامتحان - {{ Auth::user()->name }}
  </title>
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
 
  @include('teacher.parts.sidebar-teacher')

  <main class="main-content position-relative border-radius-lg ">
    <!-- Header -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.dashboard') }}">الرئيسية</a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.exams.index') }}">الامتحانات</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">تعديل الامتحان</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">تعديل الامتحان</h6>
        </nav>
      </div>
    </nav>
    <!-- End Header -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0">تعديل الامتحان: {{ $exam->title }}</h6>
                <a href="{{ route('teacher.exams.index') }}" class="btn btn-secondary btn-sm">
                  <i class="fas fa-arrow-right"></i> رجوع
                </a>
              </div>
            </div>
            <div class="card-body">
              <form action="{{ route('teacher.exams.update', $exam) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="title" class="form-control-label">عنوان الامتحان</label>
                      <input type="text" class="form-control @error('title') is-invalid @enderror" 
                             id="title" name="title" value="{{ old('title', $exam->title) }}" required>
                      @error('title')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="course_id" class="form-control-label">الدورة</label>
                      <select class="form-control @error('course_id') is-invalid @enderror" 
                              id="course_id" name="course_id" required>
                        <option value="">اختر الدورة</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" 
                                    {{ old('course_id', $exam->course_id) == $course->id ? 'selected' : '' }}>
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
                  <label for="description" class="form-control-label">وصف الامتحان</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="description" name="description" rows="3">{{ old('description', $exam->description) }}</textarea>
                  @error('description')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="type" class="form-control-label">نوع الامتحان</label>
                      <select class="form-control @error('type') is-invalid @enderror" 
                              id="type" name="type" required>
                        <option value="">اختر النوع</option>
                        <option value="manual" {{ old('type', $exam->type) == 'manual' ? 'selected' : '' }}>يدوي (تصحيح المعلم)</option>
                        <option value="auto" {{ old('type', $exam->type) == 'auto' ? 'selected' : '' }}>آلي (تصحيح تلقائي)</option>
                      </select>
                      @error('type')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="duration" class="form-control-label">المدة (دقائق)</label>
                      <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                             id="duration" name="duration" 
                             value="{{ old('duration', $exam->duration) }}" required>
                      @error('duration')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="start_at" class="form-control-label">تاريخ البداية</label>
                      <input type="datetime-local" class="form-control @error('start_at') is-invalid @enderror" 
                             id="start_at" name="start_at" 
                             value="{{ old('start_at', $exam->start_at ? $exam->start_at->format('Y-m-d\TH:i') : '') }}">
                      @error('start_at')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="end_at" class="form-control-label">تاريخ الانتهاء</label>
                      <input type="datetime-local" class="form-control @error('end_at') is-invalid @enderror" 
                             id="end_at" name="end_at" 
                             value="{{ old('end_at', $exam->end_at ? $exam->end_at->format('Y-m-d\TH:i') : '') }}">
                      @error('end_at')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="total_grade" class="form-control-label">الدرجة الكلية</label>
                  <input type="number" step="0.01" class="form-control @error('total_grade') is-invalid @enderror" 
                         id="total_grade" name="total_grade" 
                         value="{{ old('total_grade', $exam->total_grade) }}" required>
                  @error('total_grade')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> حفظ التعديلات
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
</body>

</html> 