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
    .form-control {
      border-radius: 8px;
      border: 1px solid #e9ecef;
      box-shadow: none;
      font-size: 1rem;
      padding: 0.75rem 1rem;
      transition: border-color 0.2s;
    }
    .form-control:focus {
      border-color: #7b69ac;
      box-shadow: 0 0 0 2px rgba(123, 105, 172, 0.08);
    }
    .form-group label {
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
    .choices-section {
      background: #f8f9fa;
      border-radius: 10px;
      padding: 1rem 0.5rem 0.5rem 0.5rem;
      margin-top: 0.5rem;
      box-shadow: 0 1px 6px rgba(123, 105, 172, 0.05);
    }
    .card-body {
      background: #fff;
      border-radius: 0 0 16px 16px;
    }
    .btn i {
      margin-left: 0.3rem;
    }
    @media (max-width: 767px) {
      .card-header, .card-body {
        padding: 1rem;
      }
      .form-group label {
        font-size: 0.95rem;
      }
    }
  </style>
</head>
<body class="g-sidenav-show bg-gray-100">
  @include('teacher.parts.sidebar-teacher')<main class="main-content position-relative border-radius-lg ">
  <!-- Header -->
  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.assignments.index') }}">Assignments</a></li>
          <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('teacher.assignments.questions.list', $assignment) }}">Assignment Questions</a></li>
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Bulk Add Questions</li>
        </ol>
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
            <h2 class="mb-1" style="font-weight: bold; letter-spacing: 0.5px;">Bulk Add Questions for Assignment: <span style="color:#675598">{{ $assignment->title }}</span></h2>
          </div>
          <div class="d-flex gap-2 mt-3 mt-md-0">
            <a href="{{ route('teacher.assignments.questions.list', $assignment) }}" class="btn btn-secondary btn-sm">
              <i class="fas fa-arrow-right me-2"></i>Back to Questions
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- End Page Header -->
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10">
        <div class="card mb-4">
          <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <div>
              <h6 class="mb-0">Bulk Add Questions for Assignment</h6>
              <p class="text-sm mb-0 text-secondary">{{ $assignment->title }}</p>
            </div>
          </div>
          <div class="card-body">
            <form id="setupForm" onsubmit="event.preventDefault(); generateQuestions();">
              <div class="row mb-4">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Number of Questions</label>
                    <input type="number" min="1" max="50" class="form-control" id="questionsCount" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">Number of Choices per Question</label>
                    <input type="number" min="2" max="10" class="form-control" id="choicesCount" value="4" required>
                    <small class="text-muted">For multiple choice questions</small>
                  </div>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                  <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-magic me-2"></i>Generate Fields
                  </button>
                </div>
              </div>
            </form>
            <form id="questionsForm" method="POST" action="{{ route('teacher.assignments.questions.bulk-store', $assignment) }}">
              @csrf
              <div id="questionsContainer"></div>
              <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-success">
                  <i class="fas fa-save me-2"></i>Save All Questions
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script>
function generateQuestions() {
  const questionsCount = parseInt(document.getElementById('questionsCount').value);
  const choicesCount = parseInt(document.getElementById('choicesCount').value);
  const container = document.getElementById('questionsContainer');
  container.innerHTML = '';
  for (let i = 0; i < questionsCount; i++) {
    let qHtml = `
      <div class='card mb-4'>
        <div class='card-header pb-0'>
          <h6 class='mb-0'>
            <i class="fas fa-question-circle text-primary me-2"></i>
            Question ${i+1}
          </h6>
        </div>
        <div class='card-body'>
          <div class='row'>
            <div class='col-md-8'>
              <div class='form-group'>
                <label class='form-control-label'>Question Text</label>
                <input type='text' name='questions[${i}][question_text]' class='form-control' required>
              </div>
            </div>
            <div class='col-md-4'>
              <div class='form-group'>
                <label class='form-control-label'>Question Type</label>
                <select name='questions[${i}][type]' class='form-control' onchange='toggleChoicesSection(this,${i})' required>
                  <option value=''>Choose Type</option>
                  <option value='mcq'>Multiple Choice</option>
                  <option value='short_answer'>Short Answer</option>
                  <option value='long_answer'>Long Answer</option>
                </select>
              </div>
            </div>
          </div>
          <div class='row mt-3'>
            <div class='col-md-4'>
              <div class='form-group'>
                <label class='form-control-label'>Grade</label>
                <input type='number' name='questions[${i}][grade]' class='form-control' min='0' required>
              </div>
            </div>
          </div>
          <div class='choices-section mt-3' id='choices-section-${i}' style='display:none;'>
            <div class='form-group'>
              <label class='form-control-label'>Choices</label>
              <div class='row'>`;
    for (let j = 0; j < choicesCount; j++) {
      qHtml += `
                <div class='col-md-6 mb-2'>
                  <div class='input-group'>
                    <input type='text' name='questions[${i}][choices][${j}][choice_text]' class='form-control' placeholder='Choice ${j+1}'>
                    <div class='input-group-text'>
                      <input type='radio' name='questions[${i}][correct_choice]' value='${j}'> Correct
                    </div>
                  </div>
                </div>`;
    }
    qHtml += `
              </div>
            </div>
          </div>
        </div>
      </div>`;
    container.innerHTML += qHtml;
  }
}
function toggleChoicesSection(select, idx) {
  const val = select.value;
  const choicesSection = document.getElementById('choices-section-' + idx);
  if (val === 'mcq') {
    choicesSection.style.display = 'block';
    choicesSection.querySelectorAll('input[type="text"]').forEach(input => {
      input.required = true;
    });
  } else {
    choicesSection.style.display = 'none';
    choicesSection.querySelectorAll('input[type="text"]').forEach(input => {
      input.required = false;
    });
  }
}
</script>
</html> 