@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">جدولة الكورسات والمسارات التعليمية</h2>
    
    <!-- إحصائيات سريعة -->
    <div class="row mb-4">
        <div class="col-12 col-md-3 mb-3 mb-md-0">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $courses->count() }}</h4>
                            <small>إجمالي الكورسات</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-book fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3 mb-md-0">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $packages->count() }}</h4>
                            <small>إجمالي البكجات</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-box fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3 mb-md-0">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            @php
                                $totalSchedules = 0;
                                foreach($courses as $course) {
                                    $totalSchedules += $course->schedules->count();
                                }
                            @endphp
                            <h4 class="mb-0">{{ $totalSchedules }}</h4>
                            <small>إجمالي الجدولات</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            @php
                                $totalPackageSchedules = 0;
                                foreach($packages as $package) {
                                    foreach($package->courses as $course) {
                                        $totalPackageSchedules += $course->schedules->count();
                                    }
                                }
                            @endphp
                            <h4 class="mb-0">{{ $totalPackageSchedules }}</h4>
                            <small>جدولات البكجات</small>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- فلترة -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="" class="row g-3">
                <div class="col-12 col-md-3">
                    <input type="text" name="search" class="form-control" placeholder="بحث باسم الكورس أو المسار أو البكج..." value="{{ request('search') }}">
                </div>
                <div class="col-12 col-md-2">
                    <select name="type" class="form-select">
                        <option value="">الكل</option>
                        <option value="course" {{ request('type') === 'course' ? 'selected' : '' }}>كورسات</option>
                        <option value="package" {{ request('type') === 'package' ? 'selected' : '' }}>بكجات</option>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <select name="status" class="form-select">
                        <option value="">جميع الحالات</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>نشط</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>غير نشط</option>
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>
                        فلترة
                    </button>
                </div>
                <div class="col-12 col-md-2">
                    <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-refresh me-2"></i>
                        إعادة تعيين
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- الكورسات -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-book me-2"></i>
                الكورسات والمسارات التعليمية
                @if(request('search') || request('type') || request('status'))
                    <small class="text-muted">(نتائج الفلترة)</small>
                @endif
            </h5>
        </div>
        <div class="card-body">
            @if($courses->count() > 0)
                <div class="table-responsive">
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
            @else
                <div class="text-center py-4">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">لا توجد كورسات</h5>
                    @if(request('search') || request('type') || request('status'))
                        <p class="text-muted">جرب تغيير معايير البحث أو <a href="{{ route('admin.schedules.index') }}">إعادة تعيين الفلاتر</a></p>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- البكجات -->
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-box me-2"></i>
                البكجات التعليمية
                @if(request('search') || request('type') || request('status'))
                    <small class="text-muted">(نتائج الفلترة)</small>
                @endif
            </h5>
        </div>
        <div class="card-body">
            @if($packages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم البكج</th>
                                <th>الفئة</th>
                                <th>عدد المواد</th>
                                <th>إجمالي الجدولات</th>
                                <th>إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                                <tr>
                                    <td>{{ $package->id }}</td>
                                    <td>{{ $package->name }}</td>
                                    <td>{{ $package->category ? $package->category->name : 'غير محدد' }}</td>
                                    <td>{{ $package->courses->count() }}</td>
                                    <td>
                                        @php
                                            $totalSchedules = 0;
                                            foreach($package->courses as $course) {
                                                $totalSchedules += $course->schedules->count();
                                            }
                                        @endphp
                                        {{ $totalSchedules }}
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#packageModal{{ $package->id }}">
                                            <i class="fas fa-eye me-1"></i>
                                            عرض المواد
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">لا توجد بكجات</h5>
                    @if(request('search') || request('type') || request('status'))
                        <p class="text-muted">جرب تغيير معايير البحث أو <a href="{{ route('admin.schedules.index') }}">إعادة تعيين الفلاتر</a></p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modals للبكجات -->
@foreach($packages as $package)
<div class="modal fade" id="packageModal{{ $package->id }}" tabindex="-1" aria-labelledby="packageModalLabel{{ $package->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="packageModalLabel{{ $package->id }}">
                    <i class="fas fa-box me-2"></i>
                    {{ $package->name }} - المواد التعليمية
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($package->courses->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم المادة</th>
                                    <th>الفئة</th>
                                    <th>عدد الجدولات</th>
                                    <th>إجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($package->courses as $course)
                                    <tr>
                                        <td>{{ $course->id }}</td>
                                        <td>{{ $course->name ?? $course->title }}</td>
                                        <td>{{ $course->category ? $course->category->name : 'غير محدد' }}</td>
                                        <td>{{ $course->schedules->count() }}</td>
                                        <td>
                                            <a href="{{ route('admin.schedules.show', $course->id) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-calendar me-1"></i>
                                                جدولة
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                        <p class="text-muted">لا توجد مواد في هذا البكج</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection 