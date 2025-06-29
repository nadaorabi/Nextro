@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                <i class="fas fa-box me-2"></i>
                بكج: {{ $package->name }}
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.schedules.index') }}">الجداول</a></li>
                    <li class="breadcrumb-item active">{{ $package->name }}</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>
                العودة للجداول
            </a>
        </div>
    </div>

    <!-- معلومات البكج -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-info-circle me-2"></i>
                معلومات البكج
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>اسم البكج:</strong> {{ $package->name }}</p>
                    <p><strong>الوصف:</strong> {{ $package->description ?: 'لا يوجد وصف' }}</p>
                    <p><strong>الفئة:</strong> {{ $package->category ? $package->category->name : 'غير محدد' }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>عدد المواد:</strong> {{ $package->courses->count() }}</p>
                    <p><strong>الحالة:</strong> 
                        <span class="badge bg-{{ $package->status === 'active' ? 'success' : 'danger' }}">
                            {{ $package->status === 'active' ? 'نشط' : 'غير نشط' }}
                        </span>
                    </p>
                    <p><strong>تاريخ الإنشاء:</strong> {{ $package->created_at->format('Y-m-d') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- المواد في البكج -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-book me-2"></i>
                المواد التعليمية في البكج
            </h5>
        </div>
        <div class="card-body">
            @if($package->courses->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المادة</th>
                                <th>الفئة</th>
                                <th>عدد الجدولات</th>
                                <th>آخر جدولة</th>
                                <th>إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($package->courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>
                                        <strong>{{ $course->name ?? $course->title }}</strong>
                                        @if($course->description)
                                            <br><small class="text-muted">{{ Str::limit($course->description, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $course->category ? $course->category->name : 'غير محدد' }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $course->schedules->count() }}</span>
                                    </td>
                                    <td>
                                        @if($course->schedules->count() > 0)
                                            {{ $course->schedules->sortByDesc('session_date')->first()->session_date }}
                                        @else
                                            <span class="text-muted">لا توجد جدولات</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.schedules.show', $course->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-calendar me-1"></i>
                                                عرض الجدولة
                                            </a>
                                            @if($course->schedules->count() > 0)
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#courseSchedulesModal{{ $course->id }}">
                                                    <i class="fas fa-list me-1"></i>
                                                    الجدولات
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">لا توجد مواد في هذا البكج</h5>
                    <p class="text-muted">يمكنك إضافة مواد للبكج من صفحة إدارة البكجات</p>
                    <a href="{{ route('admin.educational-packages.edit', $package->id) }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        إضافة مواد
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modals لعرض جدولات كل مادة -->
@foreach($package->courses as $course)
    @if($course->schedules->count() > 0)
        <div class="modal fade" id="courseSchedulesModal{{ $course->id }}" tabindex="-1" aria-labelledby="courseSchedulesModalLabel{{ $course->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="courseSchedulesModalLabel{{ $course->id }}">
                            <i class="fas fa-calendar me-2"></i>
                            جدولات {{ $course->name ?? $course->title }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>اليوم</th>
                                        <th>التاريخ</th>
                                        <th>وقت البداية</th>
                                        <th>وقت النهاية</th>
                                        <th>القاعة</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($course->schedules->sortBy('session_date') as $schedule)
                                        <tr>
                                            <td>{{ __($schedule->day_of_week) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($schedule->session_date)->format('Y-m-d') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('h:i A') }}</td>
                                            <td>{{ $schedule->room ? $schedule->room->room_number : 'غير محدد' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('admin.schedules.show', $course->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-2"></i>
                            إدارة الجدولة
                        </a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach

<style>
.breadcrumb {
    background: none;
    padding: 0;
    margin: 0;
}
.breadcrumb-item a {
    color: #667eea;
    text-decoration: none;
}
.breadcrumb-item.active {
    color: #6c757d;
}
</style>
@endsection 