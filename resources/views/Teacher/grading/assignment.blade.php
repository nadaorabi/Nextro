<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  <title>
    Grade Assignment - {{ Auth::user()->name }}
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
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.assignments.index') }}">Assignments</a></li>
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.assignments.show', $assignment) }}">{{ $assignment->title }}</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Grade Submission</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Grade Assignment Submission</h6>
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
                  <a href="{{ route('teacher.assignments.show', $assignment) }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to Assignment
                  </a>
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
                      @endif
                    </div>
                    <div class="col-4">
                      <h6 class="text-sm font-weight-bold mb-0">Score</h6>
                      @if($submission->score !== null)
                        <span class="text-sm font-weight-bold text-success">{{ $submission->score }}/{{ $assignment->total_grade }}</span>
                      @else
                        <span class="text-sm text-muted">Not graded</span>
                      @endif
                    </div>
                    <div class="col-4">
                      <h6 class="text-sm font-weight-bold mb-0">Submitted</h6>
                      <span class="text-sm">{{ $submission->submitted_at ? $submission->submitted_at->format('M d, Y H:i') : 'N/A' }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Submission Content -->
          <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header pb-0">
                  <h6 class="mb-0">
                    <i class="fas fa-file-alt me-2"></i>
                    Student Submission
                  </h6>
                </div>
                <div class="card-body">
                  @if($assignment->delivery_type === 'file')
                    <!-- File-based Assignment -->
                    @if($submission->submission_file)
                      <div class="mb-4">
                        <h6 class="text-uppercase text-secondary font-weight-bolder mb-3">Submitted File</h6>
                        <div class="d-flex align-items-center p-3 border rounded">
                          <i class="fas fa-file-pdf fa-2x text-danger me-3"></i>
                          <div class="flex-grow-1">
                            <h6 class="mb-1">{{ basename($submission->submission_file) }}</h6>
                            <small class="text-muted">Submitted on {{ $submission->submitted_at->format('M d, Y H:i') }}</small>
                          </div>
                          <div>
                            <a href="{{ route('teacher.grading.download-file', ['type' => 'assignment', 'id' => $assignment->id, 'submissionId' => $submission->id]) }}" 
                               class="btn btn-primary btn-sm">
                              <i class="fas fa-download"></i> Download
                            </a>
                          </div>
                        </div>
                      </div>
                    @else
                      <div class="text-center py-5">
                        <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">No file submitted</h6>
                        <p class="text-sm text-muted">The student hasn't uploaded a submission file yet.</p>
                      </div>
                    @endif
                  @else
                    <!-- Online Assignment -->
                    @if($submission->answers && count($submission->answers) > 0)
                      <div class="mb-4">
                        <h6 class="text-uppercase text-secondary font-weight-bolder mb-3">Student Answers</h6>
                        @foreach($assignment->questions as $index => $question)
                          <div class="mb-4 p-3 border rounded">
                            <h6 class="mb-2">
                              <span class="badge bg-gradient-primary me-2">{{ $index + 1 }}</span>
                              {{ $question->question_text }}
                            </h6>
                            <small class="text-muted mb-2 d-block">
                              Type: {{ ucfirst(str_replace('_', ' ', $question->type)) }} | 
                              Grade: {{ $question->grade }} points
                            </small>
                            
                            @if(isset($submission->answers[$question->id]))
                              <div class="mt-3">
                                <h6 class="text-sm font-weight-bold mb-2">Student's Answer:</h6>
                                <div class="p-3 bg-light rounded">
                                  @if($question->type === 'mcq')
                                    @php $answer = $submission->answers[$question->id]; @endphp
                                    @if(isset($answer['choice_id']))
                                      @php $selectedChoice = $question->choices->where('id', $answer['choice_id'])->first(); @endphp
                                      @if($selectedChoice)
                                        <div class="d-flex align-items-center">
                                          <i class="fas fa-check-circle text-success me-2"></i>
                                          <span>{{ $selectedChoice->choice_text }}</span>
                                        </div>
                                      @else
                                        <span class="text-muted">No answer selected</span>
                                      @endif
                                    @else
                                      <span class="text-muted">No answer provided</span>
                                    @endif
                                  @else
                                    <p class="mb-0">{{ $submission->answers[$question->id] ?? 'No answer provided' }}</p>
                                  @endif
                                </div>
                              </div>
                            @else
                              <div class="mt-3">
                                <span class="text-muted">No answer provided</span>
                              </div>
                            @endif
                          </div>
                        @endforeach
                      </div>
                    @else
                      <div class="text-center py-5">
                        <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">No answers submitted</h6>
                        <p class="text-sm text-muted">The student hasn't submitted any answers yet.</p>
                      </div>
                    @endif
                  @endif
                </div>
              </div>
            </div>

            <!-- Grading Panel -->
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header pb-0">
                  <h6 class="mb-0">
                    <i class="fas fa-star me-2"></i>
                    Grade Submission
                  </h6>
                </div>
                <div class="card-body">
                  <form action="{{ route('teacher.grading.update-assignment', [$assignment, $submission]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                      <label for="score" class="form-label">Score</label>
                      <div class="input-group">
                        <input type="number" step="0.01" class="form-control" id="score" name="score" 
                               value="{{ old('score', $submission->score) }}" 
                               min="0" max="{{ $assignment->total_grade }}" required>
                        <span class="input-group-text">/ {{ $assignment->total_grade }}</span>
                      </div>
                      <small class="text-muted">Enter score out of {{ $assignment->total_grade }}</small>
                    </div>

                    <div class="mb-3">
                      <label for="status" class="form-label">Status</label>
                      <select class="form-select" id="status" name="status" required>
                        <option value="submitted" {{ old('status', $submission->status) == 'submitted' ? 'selected' : '' }}>Submitted</option>
                        <option value="graded" {{ old('status', $submission->status) == 'graded' ? 'selected' : '' }}>Graded</option>
                        <option value="late" {{ old('status', $submission->status) == 'late' ? 'selected' : '' }}>Late</option>
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="feedback" class="form-label">Feedback</label>
                      <textarea class="form-control" id="feedback" name="feedback" rows="4" 
                                placeholder="Provide feedback to the student...">{{ old('feedback', $submission->feedback) }}</textarea>
                      <small class="text-muted">Optional feedback for the student</small>
                    </div>

                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Grade
                      </button>
                      <a href="{{ route('teacher.assignments.show', $assignment) }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                      </a>
                    </div>
                  </form>
                </div>
              </div>

              <!-- Assignment Information -->
              <div class="card mt-3">
                <div class="card-header pb-0">
                  <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    Assignment Info
                  </h6>
                </div>
                <div class="card-body">
                  <div class="mb-2">
                    <small class="text-muted">Title:</small>
                    <p class="mb-0">{{ $assignment->title }}</p>
                  </div>
                  <div class="mb-2">
                    <small class="text-muted">Type:</small>
                    <p class="mb-0">{{ ucfirst($assignment->type) }}</p>
                  </div>
                  <div class="mb-2">
                    <small class="text-muted">Delivery:</small>
                    <p class="mb-0">{{ ucfirst($assignment->delivery_type) }}</p>
                  </div>
                  <div class="mb-2">
                    <small class="text-muted">Questions:</small>
                    <p class="mb-0">{{ $assignment->questions->count() }}</p>
                  </div>
                  <div class="mb-0">
                    <small class="text-muted">Total Grade:</small>
                    <p class="mb-0">{{ $assignment->total_grade }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      {{-- قسم التعليقات --}}
      <div class="row mt-4">
        <div class="col-12">
          @include('Teacher.grading.comments-section', [
            'commentRoute' => route('teacher.grading.add-assignment-comment', [$assignment, $submission])
          ])
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