@extends('layouts.admin')
@section('content')
@include('Teacher.parts.sidebar-teacher')

<div class="main-content position-relative bg-gray-100">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <div>
              <h6 class="mb-0">أسئلة الامتحان: {{ $exam->title }}</h6>
              <p class="text-sm mb-0">
                <i class="fa fa-clock text-info" aria-hidden="true"></i>
                <span class="font-weight-bold">عدد الأسئلة:</span> {{ $exam->questions->count() }}
              </p>
            </div>
            <a href="{{ route('teacher.exams.questions.bulk-create', $exam) }}" class="btn btn-primary btn-sm">
              <i class="fas fa-plus me-2"></i>إضافة أسئلة
            </a>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            @if($exam->questions->count())
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">رقم السؤال</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">نص السؤال</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">النوع</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الدرجة</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($exam->questions as $q)
                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{{ $loop->iteration }}</h6>
                            </div>
                          </div>
                        </td>
                        <td>
                          <p class="text-xs font-weight-bold mb-0">{{ Str::limit($q->question_text, 50) }}</p>
                          <p class="text-xs text-secondary mb-0">{{ Str::limit($q->question_text, 100) }}</p>
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
                          <span class="text-secondary text-xs font-weight-bold">{{ $q->grade }}</span>
                        </td>
                        <td class="align-middle text-center">
                          @if($q->type == 'mcq' && $q->choices->count())
                            <span class="text-secondary text-xs font-weight-bold">{{ $q->choices->count() }} خيارات</span>
                            <br>
                            <small class="text-success">
                              @foreach($q->choices as $choice)
                                @if($choice->is_correct)
                                  {{ Str::limit($choice->choice_text, 20) }}
                                @endif
                              @endforeach
                            </small>
                          @else
                            <span class="text-secondary text-xs font-weight-bold">-</span>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <div class="text-center py-5">
                <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                  <i class="fas fa-question text-white opacity-10"></i>
                </div>
                <h5 class="mt-4 mb-2">لا توجد أسئلة بعد</h5>
                <p class="text-muted">لم يتم إضافة أي أسئلة لهذا الامتحان بعد.</p>
                <a href="{{ route('teacher.exams.questions.bulk-create', $exam) }}" class="btn btn-primary">
                  <i class="fas fa-plus me-2"></i>إضافة أسئلة
                </a>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection 