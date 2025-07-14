<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  <title>
    Exams - {{ Auth::user()->name }}
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
    .card {
      border-radius: 16px;
      box-shadow: 0 2px 16px rgba(123, 105, 172, 0.08);
      border: none;
      transition: box-shadow 0.3s;
    }
    .card:hover {
      box-shadow: 0 6px 32px rgba(123, 105, 172, 0.13);
    }
    .card-header {
      background: linear-gradient(135deg, #f5f7f9 0%, #fff 100%);
      color: #7b69ac;
      border-radius: 16px 16px 0 0;
      border: none;
    }
    .card-header h6 {
      color: #7b69ac;
      font-weight: 700;
      letter-spacing: 0.5px;
    }
    .btn-primary, .btn-success {
      background: linear-gradient(135deg, #7b69ac 0%, #675598 100%);
      border: none;
      border-radius: 10px;
      font-weight: 600;
      transition: box-shadow 0.3s, transform 0.2s;
      color: #fff;
    }
    .btn-primary:hover, .btn-success:hover {
      box-shadow: 0 4px 15px rgba(123, 105, 172, 0.18);
      transform: translateY(-2px);
    }
    .btn-info {
      background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
      border: none;
      border-radius: 10px;
      font-weight: 600;
      color: #fff;
      transition: box-shadow 0.3s, transform 0.2s;
    }
    .btn-info:hover {
      box-shadow: 0 4px 15px rgba(23, 162, 184, 0.18);
      transform: translateY(-2px);
    }
    .btn-outline-primary {
      background: #fff;
      color: #7b69ac;
      border: 1.5px solid #7b69ac;
      border-radius: 10px;
      font-weight: 600;
      transition: box-shadow 0.3s, color 0.2s, background 0.2s;
    }
    .btn-outline-primary:hover {
      background: #7b69ac;
      color: #fff;
      box-shadow: 0 4px 15px rgba(123, 105, 172, 0.18);
    }
    .btn-danger {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      border: none;
      border-radius: 10px;
      font-weight: 600;
      color: #fff;
      transition: box-shadow 0.3s, transform 0.2s;
    }
    .btn-danger:hover {
      box-shadow: 0 4px 15px rgba(220, 53, 69, 0.18);
      transform: translateY(-2px);
    }
    .form-control, .form-select {
      border-radius: 8px;
      border: 1px solid #e9ecef;
      box-shadow: none;
      font-size: 1rem;
      padding: 0.75rem 1rem;
      transition: border-color 0.2s;
    }
    .form-control:focus, .form-select:focus {
      border-color: #7b69ac;
      box-shadow: 0 0 0 2px rgba(123, 105, 172, 0.08);
    }
    .form-group label, .form-label {
      color: #7b69ac;
      font-weight: 600;
      margin-bottom: 0.3rem;
    }
    .input-group-text {
      background: #f5f6fa;
      color: #7b69ac;
      border: none;
      font-weight: 600;
      border-radius: 0 8px 8px 0;
    }
    .table {
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      margin-bottom: 0;
    }
    .table th {
      color: #7b69ac;
      font-weight: 700;
      background: #f5f6fa;
      border-top: none;
    }
    .table td {
      vertical-align: middle;
      padding: 0.75rem 0.5rem;
    }
    .badge {
      border-radius: 8px;
      font-size: 0.85rem;
      font-weight: 600;
      padding: 0.4em 0.8em;
    }
    .modal-content {
      border-radius: 16px;
    }
    .modal-header, .modal-footer {
      border: none;
    }
    .modal-title {
      color: #7b69ac;
      font-weight: 700;
    }
    .btn i {
      margin-left: 0.3rem;
    }
    @media (max-width: 767px) {
      .card-header, .card-body {
        padding: 1rem;
      }
      .form-group label, .form-label {
        font-size: 0.95rem;
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
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.exams.index') }}">Exams</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Exam Questions</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">Exam Questions: {{ $exam->title }}</h6>
      </nav>
    </div>
  </nav>
  <!-- End Header -->

  <div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-3">
      <div class="col-12">
        <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center align-items-start">
          <div>
            <h2 class="mb-1" style="font-weight: bold; letter-spacing: 0.5px;">Exam Questions: <span style="color:#675598">{{ $exam->title }}</span></h2>
          </div>
        </div>
      </div>
    </div>
    <!-- End Page Header -->
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <div>
              <h6 class="mb-0">Total Questions: {{ $exam->questions->count() }}</h6>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ route('teacher.exams.edit', $exam) }}" class="btn btn-info btn-sm">
                <i class="fas fa-edit me-2"></i>Edit Exam
              </a>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            @if($exam->questions->count())
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">#</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Question Text</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Grade</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Choices/Answer</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($exam->questions as $q)
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
                          <span class="text-secondary text-xs font-weight-bold">{{ $q->grade }}</span>
                        </td>
                        <td class="align-middle text-center">
                          @if($q->type == 'mcq' && $q->choices->count())
                            <div class="d-flex flex-column align-items-center">
                              <span class="text-secondary text-xs font-weight-bold mb-1">{{ $q->choices->count() }} Choices</span>
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
              <!-- Edit Question Modals -->
              @foreach($exam->questions as $q)
                <div class="modal fade" id="editQuestionModal{{ $q->id }}" tabindex="-1" aria-labelledby="editQuestionModalLabel{{ $q->id }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editQuestionModalLabel{{ $q->id }}">Edit Question</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('teacher.exams.questions.update', ['exam' => $exam, 'question' => $q]) }}" method="POST">
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
              @foreach($exam->questions as $q)
                <div class="modal fade" id="deleteQuestionModal{{ $q->id }}" tabindex="-1" aria-labelledby="deleteQuestionModalLabel{{ $q->id }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="deleteQuestionModalLabel{{ $q->id }}">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('teacher.exams.questions.delete', ['exam' => $exam, 'question' => $q]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                          <p>Are you sure you want to delete this question?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <div class="text-center py-4">
                <p class="text-sm text-secondary mb-0">No questions added yet.</p>
              </div>
            @endif
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
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('js/argon-dashboard.js?v=2.1.0') }}"></script>
</body>
</html>