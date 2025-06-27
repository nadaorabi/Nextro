@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3>إضافة كورسات أو بكجات للطالب: {{ $student->name }}</h3>
    <form method="POST" action="{{ route('admin.accounts.students.courses.enroll', $student->id) }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <h4>الكورسات المتاحة</h4>
                <div class="list-group">
                    @foreach($courses as $course)
                        @php
                            $isEnrolled = in_array($course->id, $enrolledCourseIds);
                        @endphp
                        <label class="list-group-item mb-2 d-flex align-items-center {{ $isEnrolled ? 'bg-light' : '' }}" style="cursor:{{ $isEnrolled ? 'not-allowed' : 'pointer' }};">
                            <input type="checkbox" name="courses[]" value="{{ $course->id }}" 
                                   class="form-check-input me-2 course-checkbox" 
                                   data-price="{{ $course->price }}" 
                                   data-title="{{ $course->title }}"
                                   {{ $isEnrolled ? 'disabled' : '' }}>
                            <div class="flex-grow-1">
                                <strong>{{ $course->title }}</strong>
                                @if($isEnrolled)
                                    <span class="badge bg-warning ms-2">مسجل مسبقاً</span>
                                @endif
                                <div class="text-muted">{{ $course->category->name ?? '' }}</div>
                                <div>{{ $course->description }}</div>
                                <div class="mt-1">
                                    <span class="badge bg-info">السعر: {{ $course->price }} {{ $course->currency ?? 'ر.س' }}</span>
                                    <span class="badge bg-success ms-2 course-discounted" data-id="{{ $course->id }}"></span>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <h4>البكجات المتاحة</h4>
                <div class="list-group">
                    @foreach($packages as $package)
                        @php
                            $isEnrolled = in_array($package->id, $enrolledPackageIds);
                        @endphp
                        <label class="list-group-item mb-2 d-flex align-items-center {{ $isEnrolled ? 'bg-light' : '' }}" style="cursor:{{ $isEnrolled ? 'not-allowed' : 'pointer' }};">
                            <input type="checkbox" name="packages[]" value="{{ $package->id }}" 
                                   class="form-check-input me-2 package-checkbox" 
                                   data-price="{{ $package->price }}" 
                                   data-title="{{ $package->name }}"
                                   {{ $isEnrolled ? 'disabled' : '' }}>
                            <div class="flex-grow-1">
                                <strong>{{ $package->name }}</strong>
                                @if($isEnrolled)
                                    <span class="badge bg-warning ms-2">مسجل مسبقاً</span>
                                @endif
                                <div class="text-muted">{{ $package->category->name ?? '' }}</div>
                                <div>{{ $package->description }}</div>
                                <div>
                                    <small>الدورات:
                                        @foreach($package->packageCourses as $pc)
                                            {{ $pc->course->title }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </small>
                                </div>
                                <div class="mt-1">
                                    <span class="badge bg-info">السعر: {{ $package->price }} {{ $package->currency ?? 'ر.س' }}</span>
                                    <span class="badge bg-success ms-2 package-discounted" data-id="{{ $package->id }}"></span>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- فورم الخصم الجماعي -->
        <div class="card mt-4">
            <div class="card-body">
                <h5>ملخص الاختيار</h5>
                <ul id="selectedItemsList"></ul>
                <div class="mb-2">
                    <label>نسبة الخصم (%)</label>
                    <input type="number" name="discount" id="discountInput" class="form-control" min="0" max="100" value="0">
                </div>
                <div class="mb-2">
                    <label>السعر الإجمالي بعد الخصم:</label>
                    <span id="totalAfterDiscount" class="fw-bold text-success">0</span>
                </div>
                <button type="submit" class="btn btn-primary">تأكيد الإضافة</button>
            </div>
        </div>
    </form>
</div>

<script>
function calculateTotal() {
    let total = 0;
    let selectedItems = [];
    document.querySelectorAll('.course-checkbox:checked:not(:disabled), .package-checkbox:checked:not(:disabled)').forEach(function(checkbox) {
        let price = parseFloat(checkbox.getAttribute('data-price')) || 0;
        let title = checkbox.getAttribute('data-title');
        total += price;
        selectedItems.push({title: title, price: price});
    });
    let discount = parseFloat(document.getElementById('discountInput').value) || 0;
    let afterDiscount = total - (total * discount / 100);
    document.getElementById('totalAfterDiscount').innerText = afterDiscount.toFixed(2);
    // ملخص العناصر
    let ul = document.getElementById('selectedItemsList');
    ul.innerHTML = '';
    selectedItems.forEach(function(item) {
        ul.innerHTML += `<li>${item.title} - ${item.price}</li>`;
    });
}

document.querySelectorAll('.course-checkbox, .package-checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', calculateTotal);
});
document.getElementById('discountInput').addEventListener('input', calculateTotal);
window.onload = calculateTotal;
</script>
@endsection 