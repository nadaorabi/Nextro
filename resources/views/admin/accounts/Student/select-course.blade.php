@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3>إضافة كورس أو بكج للطالب: {{ $student->name }}</h3>
    <div class="row">
        <div class="col-md-6">
            <h4>الكورسات المتاحة</h4>
            <div class="list-group">
                @foreach($courses as $course)
                    <div class="list-group-item mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $course->title }}</strong>
                                <div class="text-muted">{{ $course->category->name ?? '' }}</div>
                                <div>{{ $course->description }}</div>
                            </div>
                            <button class="btn btn-success" onclick="showDiscountForm('course', {{ $course->id }}, '{{ $course->title }}')">اختيار</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <h4>البكجات المتاحة</h4>
            <div class="list-group">
                @foreach($packages as $package)
                    <div class="list-group-item mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $package->title }}</strong>
                                <div class="text-muted">{{ $package->category->name ?? '' }}</div>
                                <div>{{ $package->description }}</div>
                                <div>
                                    <small>الدورات:
                                        @foreach($package->packageCourses as $pc)
                                            {{ $pc->course->title }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </small>
                                </div>
                            </div>
                            <button class="btn btn-success" onclick="showDiscountForm('package', {{ $package->id }}, '{{ $package->title }}')">اختيار</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- فورم الخصم يظهر عند اختيار كورس أو بكج -->
    <div id="discountForm" style="display:none;" class="mt-4">
        <form method="POST" action="{{ route('admin.accounts.students.courses.enroll', $student->id) }}">
            @csrf
            <input type="hidden" name="type" id="discountType">
            <input type="hidden" name="item_id" id="discountItemId">
            <div class="mb-2">
                <label>اسم الكورس/البكج:</label>
                <span id="discountItemName"></span>
            </div>
            <div class="mb-2">
                <label>نسبة الخصم (%)</label>
                <input type="number" name="discount" class="form-control" min="0" max="100" value="0">
            </div>
            <button type="submit" class="btn btn-primary">تأكيد الإضافة</button>
            <button type="button" class="btn btn-secondary" onclick="hideDiscountForm()">إلغاء</button>
        </form>
    </div>
</div>

<script>
function showDiscountForm(type, id, name) {
    document.getElementById('discountForm').style.display = 'block';
    document.getElementById('discountType').value = type;
    document.getElementById('discountItemId').value = id;
    document.getElementById('discountItemName').innerText = name;
    window.scrollTo(0, document.body.scrollHeight);
}
function hideDiscountForm() {
    document.getElementById('discountForm').style.display = 'none';
}
</script>
@endsection 