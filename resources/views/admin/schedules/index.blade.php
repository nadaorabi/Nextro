@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">جدولة الكورسات والمسارات التعليمية</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="بحث باسم الكورس أو المسار...">
                </div>
                <div class="col-md-3">
                    <select name="type" class="form-select">
                        <option value="">الكل</option>
                        <option value="course">كورسات</option>
                        <option value="track">مسارات</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">فلترة</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>النوع</th>
                        <th>عدد الجدولات</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->name ?? $course->title }}</td>
                            <td>{{ $course->is_track ? 'مسار تعليمي' : 'كورس' }}</td>
                            <td>{{ $course->schedules->count() }}</td>
                            <td>
                                <a href="{{ route('admin.schedules.show', $course->id) }}" class="btn btn-info btn-sm">عرض الجدولة</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 