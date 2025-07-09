@extends('layouts.admin')
@section('content')
@include('Teacher.parts.sidebar-teacher')

<div class="main-content position-relative bg-gray-100">
  <div class="container-fluid py-4">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-11 col-xl-10">
        <div class="card shadow-lg border-0" style="margin-top: 40px;">
          <div class="card-header pb-0 d-flex flex-column flex-md-row justify-content-between align-items-center bg-white border-bottom-0" style="border-radius: 1rem 1rem 0 0;">
            <div class="w-100 text-center mb-3 mb-md-0">
              <h4 class="mb-1 fw-bold" style="letter-spacing:1px;">أسئلة الواجب: <span class="text-primary">{{ $assignment->title }}</span></h4>
              <span class="badge bg-gradient-info text-white mt-2" style="font-size: 1rem;">عدد الأسئلة: {{ $assignment->questions->count() }}</span>
            </div>
            <div class="text-md-end w-100" style="max-width:200px;">
              <a href="{{ route('teacher.assignments.questions.bulk-create', $assignment) }}" class="btn btn-lg btn-primary shadow-sm w-100">
                <i class="fas fa-plus me-2"></i> إضافة أسئلة
              </a>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            @if($assignment->questions->count())
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 text-center">
                  <thead class="bg-light">
                    <tr>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">رقم السؤال</th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">نص السؤال</th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">النوع</th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">الدرجة</th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($assignment->questions as $q)
                      <tr style="vertical-align: middle;">
                        <td class="fw-bold">{{ $loop->iteration }}</td>
                        <td>
                          <span class="fw-bold">{{ Str::limit($q->question_text, 50) }}</span>
                          <div class="text-muted small">{{ Str::limit($q->question_text, 100) }}</div>
                        </td>
                        <td>
                          @if($q->type == 'mcq')
                            <span class="badge bg-gradient-success">اختيار من متعدد</span>
                          @elseif($q->type == 'short_answer')
                            <span class="badge bg-gradient-info">إجابة قصيرة</span>
                          @else
                            <span class="badge bg-gradient-warning text-dark">إجابة طويلة</span>
                          @endif
                        </td>
                        <td><span class="fw-bold">{{ $q->grade }}</span></td>
                        <td>
                          @if($q->type == 'mcq' && $q->choices->count())
                            <span class="badge bg-gradient-secondary">{{ $q->choices->count() }} خيارات</span>
                            <br>
                            <span class="text-success small">
                              @foreach($q->choices as $choice)
                                @if($choice->is_correct)
                                  <span class="fw-bold">{{ Str::limit($choice->choice_text, 20) }}</span>
                                @endif
                              @endforeach
                            </span>
                          @else
                            <span class="text-muted">-</span>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @else
              <div class="text-center py-5">
                <div class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg mb-3">
                  <i class="fas fa-question text-white opacity-10"></i>
                </div>
                <h5 class="mt-4 mb-2">لا توجد أسئلة بعد</h5>
                <p class="text-muted">لم يتم إضافة أي أسئلة لهذا الواجب بعد.</p>
                <a href="{{ route('teacher.assignments.questions.bulk-create', $assignment) }}" class="btn btn-primary btn-lg">
                  <i class="fas fa-plus me-2"></i> إضافة أسئلة
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