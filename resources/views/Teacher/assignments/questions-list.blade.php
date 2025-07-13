<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
    Assignments - {{ Auth::user()->name }}
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Assignment Questions</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Assignment Questions: {{ $assignment->title }}</h6>
        </nav>
      </div>
    </nav>
    <!-- End Header -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
              <div>
                <h6 class="mb-0">Number of Questions: {{ $assignment->questions->count() }}</h6>
              </div>
              <div class="d-flex gap-2">
                <a href="{{ route('teacher.assignments.questions.bulk-create', $assignment) }}" class="btn btn-primary btn-sm">
                  <i class="fas fa-plus me-2"></i>Add Questions
                </a>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              @if($assignment->questions->count())
                <div class="table-responsive p-0">
                  <table class="table align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Question Number</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Question Text</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Grade</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Choices/Answer</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($assignment->questions as $q)
                        <tr>
                          <td>
                            <div class="d-flex px-3 py-1">
                              <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 text-sm font-weight-bold">{{ $loop->iteration }}</h6>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="d-flex flex-column">
                              <p class="text-xs font-weight-bold mb-0">{{ Str::limit($q->question_text, 80) }}</p>
                              @if(strlen($q->question_text) > 80)
                                <small class="text-muted">Click to expand</small>
                              @endif
                            </div>
                          </td>
                          <td class="align-middle text-center text-sm">
                            @if($q->type == 'mcq')
                              <span class="badge badge-sm bg-gradient-success">Multiple Choice</span>
                            @elseif($q->type == 'short_answer')
                              <span class="badge badge-sm bg-gradient-info">Short Answer</span>
                            @else
                              <span class="badge badge-sm bg-gradient-warning">Long Answer</span>
                            @endif
                          </td>
                          <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $q->grade }} points</span>
                          </td>
                          <td class="align-middle text-center">
                            @if($q->type == 'mcq' && $q->choices->count())
                              <div class="d-flex flex-column align-items-center">
                                <span class="text-secondary text-xs font-weight-bold mb-1">{{ $q->choices->count() }} choices</span>
                                @php
                                  $correctChoices = $q->choices->where('is_correct', true);
                                @endphp
                                @if($correctChoices->count() > 0)
                                  <small class="text-success">
                                    <i class="fas fa-check-circle me-1"></i>
                                    @foreach($correctChoices as $choice)
                                      {{ Str::limit($choice->choice_text, 25) }}
                                      @if(!$loop->last), @endif
                                    @endforeach
                                  </small>
                                @endif
                              </div>
                            @else
                              <span class="text-secondary text-xs font-weight-bold">-</span>
                            @endif
                          </td>
                          <td class="align-middle text-center">
                            <div class="btn-group" role="group">
                              <!-- Edit Button -->
                              <button type="button" class="btn btn-link text-secondary p-0" data-bs-toggle="modal" data-bs-target="#editQuestionModal{{ $q->id }}" title="Edit Question">
                                <i class="fas fa-edit text-xs"></i>
                              </button>
                              <!-- Delete Button -->
                              <button type="button" class="btn btn-link text-danger p-0" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal{{ $q->id }}" title="Delete Question">
                                <i class="fas fa-trash text-xs"></i>
                              </button>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="text-center py-5">
                  <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg mx-auto">
                    <i class="fas fa-question text-white opacity-10"></i>
                  </div>
                  <h5 class="mt-4 mb-2">No Questions Yet</h5>
                  <p class="text-muted">No questions have been added to this assignment yet.</p>
                  <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('teacher.assignments.questions.bulk-create', $assignment) }}" class="btn btn-primary">
                      <i class="fas fa-plus me-2"></i>Add Questions
                    </a>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- Edit Question Modals -->
  @foreach($assignment->questions as $q)
  <div class="modal fade" id="editQuestionModal{{ $q->id }}" tabindex="-1" aria-labelledby="editQuestionModalLabel{{ $q->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editQuestionModalLabel{{ $q->id }}">Edit Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('teacher.assignments.questions.update', ['assignment' => $assignment, 'question' => $q]) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Question Text</label>
              <textarea class="form-control" name="question_text" required>{{ $q->question_text }}</textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Grade</label>
              <input type="number" class="form-control" name="grade" min="0" value="{{ $q->grade }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Question Type</label>
              <select class="form-select question-type-select" name="type" data-question-id="{{ $q->id }}" required>
                <option value="mcq" @if($q->type == 'mcq') selected @endif>Multiple Choice</option>
                <option value="short_answer" @if($q->type == 'short_answer') selected @endif>Short Answer</option>
                <option value="long_answer" @if($q->type == 'long_answer') selected @endif>Long Answer</option>
              </select>
            </div>
            <div class="mb-3 choices-section" id="choicesSection-{{ $q->id }}" style="display: {{ $q->type == 'mcq' ? 'block' : 'none' }};">
              <label class="form-label">Choices (Multiple Choice)</label>
              <div id="choicesContainer-{{ $q->id }}">
                @foreach($q->choices as $index => $choice)
                  <div class="input-group mb-2">
                    <input type="text" class="form-control" name="choices[{{ $index }}][text]" value="{{ $choice->choice_text }}" placeholder="Choice" required>
                    <div class="input-group-text">
                      <input type="radio" name="correct_choice" value="{{ $index }}" @if($choice->is_correct) checked @endif> Correct
                    </div>
                  </div>
                @endforeach
              </div>
              <!-- Button to add new choice (optional: can be activated with JavaScript later) -->
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach
  <!-- Delete Question Modals -->
  @foreach($assignment->questions as $q)
  <div class="modal fade" id="deleteQuestionModal{{ $q->id }}" tabindex="-1" aria-labelledby="deleteQuestionModalLabel{{ $q->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteQuestionModalLabel{{ $q->id }}">Delete Question</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this question?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="{{ route('teacher.assignments.questions.delete', ['assignment' => $assignment, 'question' => $q]) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Show/hide choices section based on type
    document.querySelectorAll('.question-type-select').forEach(function(select) {
      select.addEventListener('change', function() {
        var qid = this.getAttribute('data-question-id');
        var section = document.getElementById('choicesSection-' + qid);
        if (this.value === 'mcq') {
          section.style.display = 'block';
        } else {
          section.style.display = 'none';
        }
      });
    });
  });
  </script>
  <script src="{{ asset('js/core/bootstrap.bundle.min.js') }}"></script>
</body>
</html> 