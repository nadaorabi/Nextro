@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">جدولة: {{ $course->name ?? $course->title }}</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.schedules.store') }}" class="row g-3">
                @csrf
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <div class="col-md-2">
                    <label for="start_time" class="form-label">وقت البداية <span class="text-danger">*</span></label>
                    <input type="time" name="start_time" id="start_time" class="form-control" required placeholder="وقت البداية">
                </div>
                <div class="col-md-2">
                    <label for="end_time" class="form-label">وقت النهاية <span class="text-danger">*</span></label>
                    <input type="time" name="end_time" id="end_time" class="form-control" required placeholder="وقت النهاية">
                </div>
                <div class="col-md-2">
                    <label for="room_id" class="form-label">القاعة <span class="text-danger">*</span></label>
                    <select name="room_id" id="room_id" class="form-select" required>
                        <option value="">اختر القاعة</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="session_date" class="form-label">Session Date <span class="text-danger">*</span></label>
                    <input type="date" name="session_date" id="session_date" class="form-control" required onchange="showDayOfWeek()">
                    <div id="dayOfWeekDisplay" class="mt-2 text-primary fw-bold"></div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">إضافة الجدولة</button>
                </div>
            </form>
            <!-- Toast Messages -->
            <div aria-live="polite" aria-atomic="true" class="position-relative">
                <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
                    @if(session('error'))
                        <div class="toast align-items-center text-bg-danger border-0 show beautiful-toast" role="alert" aria-live="assertive" aria-atomic="true" id="errorToast">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <i class="fas fa-exclamation-circle me-2"></i>
                                    {!! session('error') !!}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="toast align-items-center text-bg-success border-0 show beautiful-toast" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="toast align-items-center text-bg-danger border-0 show beautiful-toast" role="alert" aria-live="assertive" aria-atomic="true" id="validationToast">
                            <div class="d-flex">
                                <div class="toast-body">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    {{ $errors->first() }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- نهاية التوست -->
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5>الجدولات الحالية</h5>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>اليوم</th>
                        <th>وقت البداية</th>
                        <th>وقت النهاية</th>
                        <th>القاعة</th>
                        <th>تاريخ الإضافة</th>
                        <th>Session Date</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($course->schedules as $schedule)
                        <tr>
                            <td>{{ __($schedule->day_of_week) }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->start_time)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $schedule->end_time)->format('h:i A') }}</td>
                            <td>{{ $schedule->room ? $schedule->room->room_number : $schedule->room_id }}</td>
                            <td>{{ $schedule->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $schedule->session_date ? \Carbon\Carbon::parse($schedule->session_date)->format('Y-m-d') : '' }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning me-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $schedule->id }}">تعديل</button>
                                <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('هل أنت متأكد من حذف الجدولة؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                                <!-- Modal تعديل -->
                                <div class="modal fade" id="editModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $schedule->id }}" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <form method="POST" action="{{ route('admin.schedules.update', $schedule->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="editModalLabel{{ $schedule->id }}">تعديل أوقات الجدولة</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="mb-3">
                                            <label class="form-label">وقت البداية</label>
                                            <input type="time" name="start_time" class="form-control" value="{{ $schedule->start_time }}" required>
                                          </div>
                                          <div class="mb-3">
                                            <label class="form-label">وقت النهاية</label>
                                            <input type="time" name="end_time" class="form-control" value="{{ $schedule->end_time }}" required>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                          <button type="submit" class="btn btn-primary">حفظ التعديل</button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">لا توجد جدولات بعد.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function showDayOfWeek() {
    const input = document.getElementById('session_date');
    const display = document.getElementById('dayOfWeekDisplay');
    if (!input.value) { display.textContent = ''; return; }
    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    const daysAr = ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
    const date = new Date(input.value);
    const dayIndex = date.getDay();
    // تنسيق التاريخ: YYYY-MM-DD
    const yyyy = date.getFullYear();
    const mm = String(date.getMonth() + 1).padStart(2, '0');
    const dd = String(date.getDate()).padStart(2, '0');
    const formatted = `${yyyy}-${mm}-${dd}`;
    display.textContent = `This date is: ${days[dayIndex]} - ${daysAr[dayIndex]} | ${formatted}`;
}

// إخفاء التوست بعد 3 ثواني تلقائياً
window.onload = function() {
    // تشغيل صوت عند ظهور التوست
    var errorToast = document.getElementById('errorToast');
    var successToast = document.getElementById('successToast');
    var validationToast = document.getElementById('validationToast');
    if (errorToast || successToast || validationToast) {
        var audio = new Audio('/sounds/notify.mp3');
        audio.play();
    }
    setTimeout(function() {
        if (errorToast) errorToast.classList.remove('show');
        if (successToast) successToast.classList.remove('show');
        if (validationToast) validationToast.classList.remove('show');
    }, 3000);
}
</script>
<style>
.beautiful-toast {
    font-size: 1.15em;
    box-shadow: 0 4px 24px 0 rgba(0,0,0,0.18), 0 1.5px 4px 0 rgba(0,0,0,0.12);
    border-radius: 12px;
    padding: 0.7em 1.2em;
    min-width: 320px;
    max-width: 420px;
    opacity: 0.97;
    direction: rtl;
}
.toast-body i {
    font-size: 1.3em;
    vertical-align: middle;
    color: #fff;
    margin-left: 0.5em;
}
.text-bg-danger {
    background: linear-gradient(90deg, #e53935 0%, #e35d5b 100%) !important;
}
.text-bg-success {
    background: linear-gradient(90deg, #43cea2 0%, #185a9d 100%) !important;
}
</style>
@endsection 