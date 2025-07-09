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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">الامتحانات</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">الامتحانات</h6>
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
                <h6 class="mb-0">الامتحانات</h6>
                <a href="{{ route('teacher.exams.create') }}" class="btn btn-primary btn-sm">
                  <i class="fas fa-plus"></i> إضافة امتحان جديد
                </a>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الامتحان</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الدورة</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">النوع</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الدرجة الكلية</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">المدة (دقائق)</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تاريخ البداية</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">تاريخ الانتهاء</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الإجراءات</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($exams as $exam)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $exam->title }}</h6>
                            <p class="text-xs text-secondary mb-0">{{ Str::limit($exam->description, 50) }}</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $exam->course->title ?? 'غير محدد' }}</p>
                      </td>
                      <td>
                        <span class="badge badge-sm bg-gradient-{{ $exam->type == 'auto' ? 'success' : 'info' }}">
                          {{ $exam->type == 'auto' ? 'آلي' : 'يدوي' }}
                        </span>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $exam->total_grade }}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $exam->duration }}</p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">
                          {{ $exam->start_at ? $exam->start_at->format('Y-m-d H:i') : 'غير محدد' }}
                        </p>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">
                          {{ $exam->end_at ? $exam->end_at->format('Y-m-d H:i') : 'غير محدد' }}
                        </p>
                      </td>
                      <td>
                        <div class="btn-group" role="group">
                          <a href="{{ route('teacher.exams.show', $exam) }}" 
                             class="btn btn-link text-secondary px-3 mb-0">
                            <i class="fas fa-eye text-primary me-1"></i>عرض
                          </a>
                          <a href="{{ route('teacher.exams.edit', $exam) }}" 
                             class="btn btn-link text-secondary px-3 mb-0">
                            <i class="fas fa-edit text-warning me-1"></i>تعديل
                          </a>
                          <form action="{{ route('teacher.exams.destroy', $exam) }}" 
                                method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-secondary px-3 mb-0"
                                    onclick="return confirm('هل أنت متأكد من حذف هذا الامتحان؟')">
                              <i class="fas fa-trash text-danger me-1"></i>حذف
                            </button>
                          </form>
                          <a href="{{ route('teacher.exams.questions.list', $exam) }}" class="btn btn-link text-info px-3 mb-0">
                            <i class="fas fa-question-circle me-1"></i>الأسئلة
                          </a>
                        </div>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="8" class="text-center py-4">
                        <p class="text-sm text-secondary mb-0">لا توجد امتحانات حتى الآن</p>
                      </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
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
  @foreach($exams as $exam)
  <!-- Modal for adding question -->
  <div class="modal fade" id="addQuestionModal-{{ $exam->id }}" tabindex="-1" aria-labelledby="addQuestionModalLabel-{{ $exam->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addQuestionModalLabel-{{ $exam->id }}">إضافة سؤال جديد للامتحان: {{ $exam->title }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <form method="POST" action="{{ route('teacher.exams.questions.add', $exam) }}">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label for="question_text-{{ $exam->id }}" class="form-label">نص السؤال</label>
              <textarea class="form-control" id="question_text-{{ $exam->id }}" name="question_text" required></textarea>
            </div>
            <div class="mb-3">
              <label for="type-{{ $exam->id }}" class="form-label">نوع السؤال</label>
              <select class="form-select" id="type-{{ $exam->id }}" name="type" required onchange="toggleChoicesSection{{ $exam->id }}()">
                <option value="">اختر النوع</option>
                <option value="mcq">اختيار من متعدد</option>
                <option value="short_answer">إجابة قصيرة</option>
                <option value="long_answer">إجابة طويلة</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="grade-{{ $exam->id }}" class="form-label">الدرجة</label>
              <input type="number" class="form-control" id="grade-{{ $exam->id }}" name="grade" min="0" required>
            </div>
            <div class="mb-3" id="choicesSection-{{ $exam->id }}" style="display:none;">
              <label class="form-label">الخيارات (اختيار من متعدد)</label>
              <div id="choicesContainer-{{ $exam->id }}">
                <div class="input-group mb-2">
                  <input type="text" class="form-control" name="choices[]" placeholder="الخيار الأول">
                  <div class="input-group-text">
                    <input type="radio" name="correct_choice" value="0"> صحيح
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-sm btn-outline-primary" onclick="addChoice{{ $exam->id }}()">
                <i class="fas fa-plus"></i> إضافة خيار
              </button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
            <button type="submit" class="btn btn-primary">حفظ السؤال</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    function toggleChoicesSection{{ $exam->id }}() {
      var type = document.getElementById('type-{{ $exam->id }}').value;
      document.getElementById('choicesSection-{{ $exam->id }}').style.display = (type === 'mcq') ? 'block' : 'none';
    }
    function addChoice{{ $exam->id }}() {
      var container = document.getElementById('choicesContainer-{{ $exam->id }}');
      var index = container.children.length;
      var div = document.createElement('div');
      div.className = 'input-group mb-2';
      div.innerHTML = `<input type=\"text\" class=\"form-control\" name=\"choices[]\" placeholder=\"الخيار الجديد\">
        <div class=\"input-group-text\">
          <input type=\"radio\" name=\"correct_choice\" value=\"${index}\"> صحيح
        </div>
        <button type=\"button\" class=\"btn btn-outline-danger btn-sm\" onclick=\"this.parentNode.remove()\"><i class=\"fas fa-trash\"></i></button>`;
      container.appendChild(div);
    }
  </script>
  @endforeach
</body>

</html> 