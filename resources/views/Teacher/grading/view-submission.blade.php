<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  <title>
    View Submission - {{ Auth::user()->name }}
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
            @if($type === 'assignment')
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.assignments.index') }}">Assignments</a></li>
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.assignments.show', $id) }}">Assignment Details</a></li>
            @else
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.exams.index') }}">Exams</a></li>
              <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.exams.show', $id) }}">Exam Details</a></li>
            @endif
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">View Submission</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">View Submission Details</h6>
        </nav>
      </div>
    </nav>
    <!-- End Header -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <!-- Student Information Card -->
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                  <i class="fas fa-user me-2"></i>
                  Student Information
                </h6>
                <div>
                  @if($type === 'assignment')
                    <a href="{{ route('teacher.assignments.show', $id) }}" class="btn btn-secondary btn-sm">
                      <i class="fas fa-arrow-left"></i> Back to Assignment
                    </a>
                  @else
                    <a href="{{ route('teacher.exams.show', $id) }}" class="btn btn-secondary btn-sm">
                      <i class="fas fa-arrow-left"></i> Back to Exam
                    </a>
                  @endif
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="d-flex align-items-center">
                    <div class="avatar avatar-lg me-3">
                      <img src="{{ asset('images/default-avatar.png') }}" class="avatar avatar-lg rounded-circle" alt="Avatar">
                    </div>
                    <div>
                      <h5 class="mb-1">{{ $submission->student->name }}</h5>
                      <p class="text-sm text-muted mb-1">{{ $submission->student->email }}</p>
                      <p class="text-sm text-muted mb-0">ID: {{ $submission->student->login_id ?? 'N/A' }}</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="row text-center">
                    <div class="col-4">
                      <h6 class="text-sm font-weight-bold mb-0">Status</h6>
                      @if($submission->status == 'submitted')
                        <span class="badge bg-gradient-warning">Submitted</span>
                      @elseif($submission->status == 'graded')
                        <span class="badge bg-gradient-success">Graded</span>
                      @elseif($submission->status == 'late')
                        <span class="badge bg-gradient-danger">Late</span>
                      @elseif($submission->status == 'started')
                        <span class="badge bg-gradient-info">Started</span>
                      @endif
                    </div>
                    <div class="col-4">
                      <h6 class="text-sm font-weight-bold mb-0">Score</h6>
                      @if($submission->score !== null)
                        <span class="text-sm font-weight-bold text-success">{{ $submission->score }}</span>
                      @else
                        <span class="text-sm text-muted">Not graded</span>
                      @endif
                    </div>
                    <div class="col-4">
                      <h6 class="text-sm font-weight-bold mb-0">Submitted</h6>
                      <span class="text-sm">{{ $submission->submitted_at ? $submission->submitted_at->format('M d, H:i') : 'N/A' }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Submission Content -->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header pb-0">
                  <h6 class="mb-0">
                    <i class="fas fa-file-alt me-2"></i>
                    Submission Details
                  </h6>
                </div>
                <div class="card-body">
                  @if($submission->submission_file)
                    <!-- File-based Submission -->
                    <div class="mb-4">
                      <h6 class="text-uppercase text-secondary font-weight-bolder mb-3">Submitted File</h6>
                      <div class="d-flex align-items-center p-3 border rounded">
                        <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                        <div class="flex-grow-1">
                          <h6 class="mb-1">{{ basename($submission->submission_file) }}</h6>
                          <small class="text-muted">Submitted on {{ $submission->submitted_at->format('M d, Y H:i') }}</small>
                        </div>
                        <div>
                          <a href="{{ route('teacher.grading.download-file', ['type' => $type, 'id' => $id, 'submissionId' => $submission->id]) }}" 
                             class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download
                          </a>
                        </div>
                      </div>
                    </div>
                  @endif

                  @if($submission->answers && count($submission->answers) > 0)
                    <!-- Online Submission -->
                    <div class="mb-4">
                      <h6 class="text-uppercase text-secondary font-weight-bolder mb-3">Student Answers</h6>
                      @foreach($submission->answers as $questionId => $answer)
                        <div class="mb-4 p-3 border rounded">
                          <h6 class="mb-2">
                            <span class="badge bg-gradient-primary me-2">Q{{ $loop->iteration }}</span>
                            Question ID: {{ $questionId }}
                          </h6>
                          
                          <div class="mt-3">
                            <h6 class="text-sm font-weight-bold mb-2">Student's Answer:</h6>
                            <div class="p-3 bg-light rounded">
                              @if(is_array($answer))
                                @if(isset($answer['choice_id']))
                                  <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    <span>Selected Choice ID: {{ $answer['choice_id'] }}</span>
                                  </div>
                                  @if(isset($answer['choice_text']))
                                    <div class="mt-2">
                                      <strong>Choice Text:</strong> {{ $answer['choice_text'] }}
                                    </div>
                                  @endif
                                @else
                                  <p class="mb-0">{{ json_encode($answer) }}</p>
                                @endif
                              @else
                                <p class="mb-0">{{ $answer }}</p>
                              @endif
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>
                  @endif

                  @if($submission->feedback)
                    <!-- Feedback -->
                    <div class="mb-4">
                      <h6 class="text-uppercase text-secondary font-weight-bolder mb-3">Teacher Feedback</h6>
                      <div class="p-3 bg-light rounded">
                        <p class="mb-0">{{ $submission->feedback }}</p>
                      </div>
                    </div>
                  @endif

                  @if(!$submission->submission_file && (!$submission->answers || count($submission->answers) == 0))
                    <div class="text-center py-5">
                      <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                      <h6 class="text-muted">No submission content</h6>
                      <p class="text-sm text-muted">No file or answers were submitted for this assignment/exam.</p>
                    </div>
                  @endif
                </div>
              </div>
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