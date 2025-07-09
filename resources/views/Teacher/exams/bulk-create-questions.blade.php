@extends('layouts.admin')
@section('content')
@include('Teacher.parts.sidebar-teacher')

<div class="main-content position-relative bg-gray-100">
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="mb-0">إضافة أسئلة جماعية للامتحان</h6>
                <p class="text-sm mb-0 text-secondary">{{ $exam->title }}</p>
              </div>
              <a href="{{ route('teacher.exams.questions.list', $exam) }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-right me-2"></i>العودة للأسئلة
              </a>
            </div>
          </div>
          <div class="card-body">
            <form id="setupForm" onsubmit="event.preventDefault(); generateQuestions();">
              <div class="row mb-4">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">عدد الأسئلة</label>
                    <input type="number" min="1" max="50" class="form-control" id="questionsCount" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label">عدد الخيارات لكل سؤال</label>
                    <input type="number" min="2" max="10" class="form-control" id="choicesCount" value="4" required>
                    <small class="text-muted">للأسئلة من نوع اختيار من متعدد</small>
                  </div>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                  <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-magic me-2"></i>توليد الخانات
                  </button>
                </div>
              </div>
            </form>
            
            <form id="questionsForm" method="POST" action="{{ route('teacher.exams.questions.bulk-store', $exam) }}">
              @csrf
              <div id="questionsContainer"></div>
              <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-success">
                  <i class="fas fa-save me-2"></i>حفظ جميع الأسئلة
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
            السؤال رقم ${i+1}
          </h6>
        </div>
        <div class='card-body'>
          <div class='row'>
            <div class='col-md-8'>
              <div class='form-group'>
                <label class='form-control-label'>نص السؤال</label>
                <input type='text' name='questions[${i}][question_text]' class='form-control' required>
              </div>
            </div>
            <div class='col-md-4'>
              <div class='form-group'>
                <label class='form-control-label'>نوع السؤال</label>
                <select name='questions[${i}][type]' class='form-control' onchange='toggleChoicesSection(this,${i})' required>
                  <option value=''>اختر النوع</option>
                  <option value='mcq'>اختيار من متعدد</option>
                  <option value='short_answer'>إجابة قصيرة</option>
                  <option value='long_answer'>إجابة طويلة</option>
                </select>
              </div>
            </div>
          </div>
          <div class='row mt-3'>
            <div class='col-md-4'>
              <div class='form-group'>
                <label class='form-control-label'>الدرجة</label>
                <input type='number' name='questions[${i}][grade]' class='form-control' min='0' required>
              </div>
            </div>
          </div>
          <div class='choices-section mt-3' id='choices-section-${i}' style='display:none;'>
            <div class='form-group'>
              <label class='form-control-label'>الخيارات</label>
              <div class='row'>`;
    
    for (let j = 0; j < choicesCount; j++) {
      qHtml += `
                <div class='col-md-6 mb-2'>
                  <div class='input-group'>
                    <input type='text' name='questions[${i}][choices][${j}][choice_text]' class='form-control' placeholder='الخيار رقم ${j+1}'>
                    <div class='input-group-text'>
                      <input type='radio' name='questions[${i}][correct_choice]' value='${j}'> صحيح
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
@endsection 