@extends('layouts.admin')
@section('head')
<style>
@media print {
    body * {
        visibility: hidden !important;
    }
    #print-schedule-table, #print-schedule-table * {
        visibility: visible !important;
    }
    #print-schedule-table {
        position: absolute;
        left: 0; top: 0;
        width: 100vw !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #fff !important;
    }
    .table th, .table td {
        background: #fff !important;
        color: #000 !important;
        border: 1px solid #000 !important;
    }
}
</style>
@endsection
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">جدول الحصص - الإدارة</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="" class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label class="form-label">المادة</label>
                    <select name="course_id" class="form-select">
                        <option value="">الكل</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">الأستاذ</label>
                    <select name="instructor_id" class="form-select">
                        <option value="">الكل</option>
                        @foreach($instructors as $instructor)
                            <option value="{{ $instructor->id }}" {{ request('instructor_id') == $instructor->id ? 'selected' : '' }}>{{ $instructor->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">القاعة</label>
                    <select name="room_id" class="form-select">
                        <option value="">الكل</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>{{ $room->room_number ?? $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">المسار</label>
                    <select name="category_id" class="form-select">
                        <option value="">الكل</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">اليوم</label>
                    <input type="date" name="session_date" class="form-control" value="{{ request('session_date') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">أسبوع يبدأ من</label>
                    <input type="date" name="week_start" class="form-control" value="{{ request('week_start') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">ينتهي في</label>
                    <input type="date" name="week_end" class="form-control" value="{{ request('week_end') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-filter me-2"></i>فلترة</button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('admin.schedules.board') }}" class="btn btn-secondary w-100"><i class="fas fa-refresh me-2"></i>إعادة تعيين</a>
                </div>
            </form>
        </div>
    </div>
    {{-- أزرار الطباعة والتصدير --}}
    <div class="d-flex justify-content-end mb-3 no-print">
        <button type="button" class="btn btn-outline-dark me-2" onclick="window.print()">
            <i class="fas fa-print me-1"></i> طباعة الجدول
        </button>
        <button type="button" class="btn btn-outline-success" onclick="exportTableToExcel('schedules-table')">
            <i class="fas fa-file-excel me-1"></i> تصدير Excel
        </button>
    </div>
    <div id="print-schedule-table">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="schedules-table">
                <thead class="table-light">
                    <tr>
                        <th>التاريخ</th>
                        <th>اليوم</th>
                        <th>الوقت</th>
                        <th>المادة</th>
                        <th>المسار</th>
                        <th>الأستاذ</th>
                        <th>القاعة</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schedules as $sch)
                        <tr>
                            <td>{{ $sch->session_date }}</td>
                            <td>{{ ucfirst($sch->day_of_week) }}</td>
                            <td>{{ substr($sch->start_time,0,5) }} - {{ substr($sch->end_time,0,5) }}</td>
                            <td>{{ $sch->course->title ?? '-' }}</td>
                            <td>{{ $sch->course->category->name ?? '-' }}</td>
                            <td>
                                @php $instructors = $sch->course->courseInstructors->map(function($ci){ return $ci->instructor->name ?? null; })->filter()->join(', '); @endphp
                                {{ $instructors ?: '-' }}
                            </td>
                            <td>{{ $sch->room ? ($sch->room->room_number ?? $sch->room->name ?? '-') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">لا توجد جداول مطابقة للبحث.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    filename = filename?filename+'.xls':'جدول-الحصص.xls';
    downloadLink = document.createElement("a");
    document.body.appendChild(downloadLink);
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], { type: dataType });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
</script>
@endsection 