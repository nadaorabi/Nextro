<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  <title>
    View Assignment - {{ Auth::user()->name }}
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">View Assignment</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">View Assignment</h6>
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
                <h6 class="mb-0">Assignment Details</h6>
                <div>
                  <a href="{{ route('teacher.assignments.edit', $assignment) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit"></i> Edit
                  </a>
                  <a href="{{ route('teacher.assignments.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-right"></i> Back
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <h4 class="mb-3">{{ $assignment->title }}</h4>
                  
                  <div class="mb-4">
                    <h6 class="text-uppercase text-secondary font-weight-bolder">Description</h6>
                    <p class="text-sm">{{ $assignment->description ?: 'No description available' }}</p>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <h6 class="text-uppercase text-secondary font-weight-bolder">Course</h6>
                        <p class="text-sm">{{ $assignment->course->title ?? 'Not specified' }}</p>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="mb-3">
                        <h6 class="text-uppercase text-secondary font-weight-bolder">Assignment Type</h6>
                        <span class="badge badge-sm bg-gradient-{{ $assignment->type == 'auto' ? 'success' : 'info' }}">
                          {{ $assignment->type == 'auto' ? 'Auto' : 'Manual' }}
                        </span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <h6 class="text-uppercase text-secondary font-weight-bolder">Delivery Method</h6>
                        <span class="badge badge-sm bg-gradient-{{ $assignment->delivery_type == 'online' ? 'primary' : 'warning' }}">
                          {{ $assignment->delivery_type == 'online' ? 'Online' : 'File' }}
                        </span>
                        @if($assignment->delivery_type == 'file' && $assignment->file_path)
                          <br><small class="text-muted mt-1">
                            <i class="fas fa-download"></i> 
                            <a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank" class="text-primary">
                              Download Assignment File
                            </a>
                          </small>
                        @endif
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="mb-3">
                        <h6 class="text-uppercase text-secondary font-weight-bolder">Total Grade</h6>
                        <p class="text-sm">{{ $assignment->total_grade }}</p>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <h6 class="text-uppercase text-secondary font-weight-bolder">Created Date</h6>
                        <p class="text-sm">{{ $assignment->created_at->format('Y-m-d H:i') }}</p>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="mb-3">
                        <h6 class="text-uppercase text-secondary font-weight-bolder">Last Updated</h6>
                        <p class="text-sm">{{ $assignment->updated_at->format('Y-m-d H:i') }}</p>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <h6 class="text-uppercase text-secondary font-weight-bolder">Start Date</h6>
                        <p class="text-sm">{{ $assignment->start_at ? $assignment->start_at->format('Y-m-d H:i') : 'Not specified' }}</p>
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="mb-3">
                        <h6 class="text-uppercase text-secondary font-weight-bolder">End Date</h6>
                        <p class="text-sm">{{ $assignment->end_at ? $assignment->end_at->format('Y-m-d H:i') : 'Not specified' }}</p>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="card bg-gradient-info">
                    <div class="card-body text-center">
                      <h5 class="text-white mb-3">Assignment Statistics</h5>
                      
                      <div class="row text-center">
                        <div class="col-6">
                          <h4 class="text-white mb-1">{{ $assignment->questions->count() }}</h4>
                          <small class="text-white">Questions</small>
                        </div>
                        <div class="col-6">
                          <h4 class="text-white mb-1">{{ $totalStudents }}</h4>
                          <small class="text-white">Students</small>
                        </div>
                      </div>
                      
                      <hr class="bg-white">
                      
                      <div class="row text-center">
                        <div class="col-6">
                          <h4 class="text-white mb-1">{{ $submittedCount }}</h4>
                          <small class="text-white">Submitted</small>
                        </div>
                        <div class="col-6">
                          <h4 class="text-white mb-1">{{ $gradedCount }}</h4>
                          <small class="text-white">Graded</small>
                        </div>
                      </div>
                      
                      @if($averageScore > 0)
                      <hr class="bg-white">
                      <div class="row text-center">
                        <div class="col-12">
                          <h4 class="text-white mb-1">{{ number_format($averageScore, 1) }}</h4>
                          <small class="text-white">Avg Score</small>
                        </div>
                      </div>
                      @endif
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Student Submissions Section - Main Section -->
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i>
                    Student Submissions
                  </h5>
                  <p class="text-sm text-muted mb-0">
                    {{ $assignment->submissions->count() }} out of {{ $totalStudents }} students have submitted
                  </p>
                </div>
                <div class="d-flex align-items-center">
                  <div class="me-3">
                    <span class="badge bg-gradient-success">{{ $submittedCount }} Submitted</span>
                  </div>
                  <div class="me-3">
                    <span class="badge bg-gradient-warning">{{ $gradedCount }} Graded</span>
                  </div>
                  <div>
                    <span class="badge bg-gradient-info">{{ $totalStudents - $assignment->submissions->count() }} Pending</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              @if($assignment->submissions->count() > 0)
                <div class="table-responsive">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Score</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Submitted At</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($assignment->submissions as $submission)
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="{{ asset('images/default-avatar.png') }}" class="avatar avatar-sm rounded-circle me-3" alt="Avatar">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $submission->student->name }}</h6>
                              <p class="text-xs text-secondary mb-0">{{ $submission->student->email }}</p>
                              <p class="text-xs text-secondary mb-0">ID: {{ $submission->student->login_id ?? 'N/A' }}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                          @if($submission->status == 'submitted')
                            <span class="badge badge-sm bg-gradient-warning">Submitted</span>
                          @elseif($submission->status == 'graded')
                            <span class="badge badge-sm bg-gradient-success">Graded</span>
                          @elseif($submission->status == 'late')
                            <span class="badge badge-sm bg-gradient-danger">Late</span>
                          @else
                            <span class="badge badge-sm bg-gradient-secondary">Pending</span>
                          @endif
                        </td>
                        <td>
                          @if($submission->score !== null)
                            <span class="text-sm font-weight-bold text-success">{{ $submission->score }}/{{ $assignment->total_grade }}</span>
                          @else
                            <span class="text-sm text-muted">Not graded yet</span>
                          @endif
                        </td>
                        <td>
                          @if($submission->submitted_at)
                            <span class="text-sm font-weight-bold">{{ $submission->submitted_at->format('M d, Y') }}</span>
                            <br>
                            <small class="text-muted">{{ $submission->submitted_at->format('H:i A') }}</small>
                          @else
                            <span class="text-sm text-muted">-</span>
                          @endif
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <a href="{{ route('teacher.grading.grade-assignment', [$assignment, $submission]) }}" 
                               class="btn btn-link text-secondary px-3 mb-0" title="View & Grade">
                              <i class="fas fa-eye text-xs"></i>
                            </a>
                            @if($submission->submission_file)
                            <a href="{{ route('teacher.grading.download-file', ['type' => 'assignment', 'id' => $assignment->id, 'submissionId' => $submission->id]) }}" 
                               class="btn btn-link text-danger px-3 mb-0" title="Download File">
                              <i class="fas fa-download text-xs"></i>
                            </a>
                            @endif
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="text-center py-5">
                  <div class="mb-3">
                    <i class="fas fa-users fa-3x text-muted"></i>
                  </div>
                  <h6 class="text-muted">No submissions yet</h6>
                  <p class="text-sm text-muted">Students haven't submitted their assignments yet.</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
                  
                  @if($assignment->delivery_type == 'online' && $assignment->questions->count() > 0)
                  <div class="card mt-3">
                    <div class="card-header pb-0">
                      <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0">Questions ({{ $assignment->questions->count() }})</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                            <i class="fas fa-plus"></i> Add Question
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      @foreach($assignment->questions as $question)
                      <div class="mb-3 p-3 border rounded">
                        <h6 class="mb-2">{{ $question->question_text }}</h6>
                        <small class="text-secondary">Type: {{ $question->type == 'mcq' ? 'Multiple Choice' : 'Short Answer' }}</small>
                        @if($question->type == 'mcq' && $question->choices->count() > 0)
                        <div class="mt-2">
                          <small class="text-secondary">Choices:</small>
                          <ul class="list-unstyled mt-1">
                            @foreach($question->choices as $choice)
                            <li class="text-sm">
                              <i class="fas fa-circle text-{{ $choice->is_correct ? 'success' : 'secondary' }} me-1"></i>
                              {{ $choice->choice_text }}
                            </li>
                            @endforeach
                          </ul>
                        </div>
                        @endif
                      </div>
                      @endforeach
                    </div>
                  </div>
                  @elseif($assignment->delivery_type == 'file')
                  <div class="card mt-3">
                    <div class="card-header pb-0">
                      <h6 class="mb-0">File-Based Assignment</h6>
                    </div>
                    <div class="card-body">
                      <p class="text-sm text-secondary">This is a file-based assignment. Students will download the assignment file to complete it offline.</p>
                      @if($assignment->file_path)
                        <a href="{{ asset('storage/' . $assignment->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                          <i class="fas fa-download"></i> Download Assignment File
                        </a>
                      @endif
                    </div>
                  </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      {{-- قسم التعليقات العامة --}}
      <div class="row mt-4">
        <div class="col-12">
          @include('Teacher.grading.general-comments-section', [
            'item' => $assignment,
            'commentRoute' => route('teacher.grading.add-assignment-general-comment', $assignment),
            'downloadRoute' => 'teacher.grading.download-assignment-general-comment-attachment',
            'deleteRoute' => 'teacher.grading.delete-assignment-general-comment',
          ])
        </div>
      </div>
    </div>
  </main>

  <!-- Add Question Modal -->
  <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addQuestionModalLabel">Add New Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="addQuestionForm" method="POST" action="{{ route('teacher.assignments.questions.add', $assignment) }}">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="question_text" class="form-label">Question Text</label>
              <textarea class="form-control" id="question_text" name="question_text" required></textarea>
            </div>
            <div class="mb-3">
              <label for="type" class="form-label">Question Type</label>
              <select class="form-select" id="type" name="type" required onchange="toggleChoicesSection()">
                <option value="">Select Type</option>
                <option value="mcq">Multiple Choice</option>
                <option value="short_answer">Short Answer</option>
                <option value="long_answer">Long Answer</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="grade" class="form-label">Grade</label>
              <input type="number" class="form-control" id="grade" name="grade" min="0" required>
            </div>
            <div class="mb-3" id="choicesSection" style="display:none;">
              <label class="form-label">Choices (Multiple Choice)</label>
              <div id="choicesContainer">
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="choices[]" placeholder="First Choice">
                  <div class="input-group-text">
                    <input type="radio" name="correct_choice" value="0"> Correct
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-sm btn-outline-primary" onclick="addChoice()">
                <i class="fas fa-plus"></i> Add Choice
              </button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Question</button>
          </div>
        </form>
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

    function toggleChoicesSection() {
      var type = document.getElementById('type').value;
      document.getElementById('choicesSection').style.display = (type === 'mcq') ? 'block' : 'none';
    }

    function addChoice() {
      var container = document.getElementById('choicesContainer');
      var index = container.children.length;
      var div = document.createElement('div');
      div.className = 'input-group mb-2';
      div.innerHTML = `<input type="text" class="form-control" name="choices[]" placeholder="New Choice">
        <div class="input-group-text">
          <input type="radio" name="correct_choice" value="${index}"> Correct
        </div>
        <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.parentNode.remove()"><i class="fas fa-trash"></i></button>`;
      container.appendChild(div);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/argon-dashboard.js?v=2.1.0') }}"></script>
</body>

</html> 