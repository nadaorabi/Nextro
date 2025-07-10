<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />      
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

  <title>
    الامتحانات - {{ Auth::user()->name }}
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
          <li class="breadcrumb-item text-sm text-dark active" aria-current="page">أسئلة الامتحان</li>
        </ol>
        <h6 class="font-weight-bolder mb-0">أسئلة الامتحان: {{ $exam->title }}</h6>
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
              <h6 class="mb-0">عدد الأسئلة: {{ $exam->questions->count() }}</h6>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ route('teacher.exams.questions.bulk-create', $exam) }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-2"></i>إضافة أسئلة
              </a>
              <a href="{{ route('teacher.exams.edit', $exam) }}" class="btn btn-info btn-sm">
                <i class="fas fa-edit me-2"></i>تعديل الامتحان
              </a>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            @if($exam->questions->count())
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">رقم السؤال</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">نص السؤال</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">النوع</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الدرجة</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الخيارات/الإجابة</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الإجراءات</th>
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
                              <small class="text-muted">اضغط للتوسيع</small>
                            @endif
                          </div>
                        </td>
                        <td class="align-middle text-center text-sm">
                          @if($q->type == 'mcq')
                            <span class="badge badge-sm bg-gradient-success">اختيار من متعدد</span>
                          @elseif($q->type == 'short_answer')
                            <span class="badge badge-sm bg-gradient-info">إجابة قصيرة</span>
                          @else
                            <span class="badge badge-sm bg-gradient-warning">إجابة طويلة</span>
                          @endif
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{ $q->grade }} درجة</span>
                        </td>
                        <td class="align-middle text-center">
                          @if($q->type == 'mcq' && $q->choices->count())
                            <div class="d-flex flex-column align-items-center">
                              <span class="text-secondary text-xs font-weight-bold mb-1">{{ $q->choices->count() }} خيارات</span>
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
                            <button type="button" class="btn btn-link text-secondary p-0" data-bs-toggle="modal" data-bs-target="#editQuestionModal{{ $q->id }}" title="تعديل السؤال">
                              <i class="fas fa-edit text-xs"></i>
                            </button>
                            <!-- Delete Button -->
                            <button type="button" class="btn btn-link text-danger p-0" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal{{ $q->id }}" title="حذف السؤال">
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
                        <h5 class="modal-title" id="editQuestionModalLabel{{ $q->id }}">تعديل السؤال</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <form action="{{ route('teacher.exams.questions.update', ['exam' => $exam, 'question' => $q]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">نص السؤال</label>
                            <textarea class="form-control" name="question_text" required>{{ $q->question_text }}</textarea>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">الدرجة</label>
                            <input type="number" class="form-control" name="grade" min="0" value="{{ $q->grade }}" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">نوع السؤال</label>
                            <select class="form-select question-type-select" name="type" data-question-id="{{ $q->id }}" required>
                              <option value="mcq" @if($q->type == 'mcq') selected @endif>اختيار من متعدد</option>
                              <option value="short_answer" @if($q->type == 'short_answer') selected @endif>إجابة قصيرة</option>
                              <option value="long_answer" @if($q->type == 'long_answer') selected @endif>إجابة طويلة</option>
                            </select>
                          </div>
                          <div class="mb-3 choices-section" id="choicesSection-{{ $q->id }}" style="display: {{ $q->type == 'mcq' ? 'block' : 'none' }};">
                            <label class="form-label">الخيارات (اختيار من متعدد)</label>
                            <div id="choicesContainer-{{ $q->id }}">
                              @foreach($q->choices as $index => $choice)
                                <div class="input-group mb-2">
                                  <input type="text" class="form-control" name="choices[{{ $index }}][text]" value="{{ $choice->choice_text }}" placeholder="الخيار" required>
                                  <div class="input-group-text">
                                    <input type="radio" name="correct_choice" value="{{ $index }}" @if($choice->is_correct) checked @endif> صحيح
                                  </div>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                          <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
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
                        <h5 class="modal-title" id="deleteQuestionModalLabel{{ $q->id }}">تأكيد الحذف</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>هل أنت متأكد من حذف هذا السؤال؟</p>
                        <p class="text-muted">{{ Str::limit($q->question_text, 100) }}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form action="{{ route('teacher.exams.questions.delete', ['exam' => $exam, 'question' => $q]) }}" method="POST" class="d-inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger">حذف</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <div class="text-center py-5">
                <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg mx-auto">
                  <i class="fas fa-question text-white opacity-10"></i>
                </div>
                <h5 class="mt-4 mb-2">لا توجد أسئلة بعد</h5>
                <p class="text-muted">لم يتم إضافة أي أسئلة لهذا الامتحان بعد.</p>
                <div class="d-flex justify-content-center gap-2">
                  <a href="{{ route('teacher.exams.questions.bulk-create', $exam) }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>إضافة أسئلة
                  </a>
                  <a href="{{ route('teacher.exams.edit', $exam) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-edit me-2"></i>تعديل الامتحان
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