@extends('layouts.admin')

@section('content')
<style>
    body { background: #f4f8fb; }
    .main-elegant-card {
        background: linear-gradient(90deg, #60a5fa 0%, #2563eb 100%);
        border-radius: 28px;
        box-shadow: 0 8px 32px rgba(59,130,246,0.13);
        padding: 38px 36px 32px 36px;
        margin-bottom: 38px;
        display: flex;
        align-items: center;
        gap: 32px;
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.8s cubic-bezier(.39,.575,.56,1.000);
    }
    .main-elegant-card .main-icon {
        width: 82px;
        height: 82px;
        border-radius: 50%;
        background: rgba(255,255,255,0.18);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 2.8em;
        box-shadow: 0 2px 16px rgba(37,99,235,0.10);
        transition: transform 0.2s;
    }
    .main-elegant-card:hover .main-icon {
        transform: scale(1.08) rotate(-6deg);
    }
    .main-elegant-card .main-title {
        color: #fff;
        font-size: 2.1em;
        font-weight: 800;
        margin-bottom: 0.2em;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 8px rgba(37,99,235,0.10);
    }
    .main-elegant-card .main-student {
        color: #fff;
        font-size: 1.3em;
        font-weight: 600;
        background: rgba(255,255,255,0.13);
        border-radius: 8px;
        padding: 4px 18px;
        display: inline-block;
        margin-top: 8px;
        box-shadow: 0 1px 6px rgba(59,130,246,0.07);
    }
    @keyframes fadeInDown {
        0% { opacity: 0; transform: translateY(-40px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .dynamic-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.09);
        border: none;
        margin-bottom: 20px;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        transition: box-shadow 0.2s, transform 0.2s;
        position: relative;
    }
    .dynamic-card:hover {
        box-shadow: 0 8px 32px rgba(59,130,246,0.18);
        transform: translateY(-2px) scale(1.02);
    }
    .dynamic-icon {
        width: 54px;
        height: 54px;
        border-radius: 50%;
        background: linear-gradient(135deg,#60a5fa 0%,#2563eb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 2em;
        margin-left: 18px;
        flex-shrink: 0;
    }
    .dynamic-card input[type="checkbox"]:not(:disabled) {
        accent-color: #2563eb;
        margin-left: 10px;
        transform: scale(1.2);
    }
    .dynamic-badge {
        font-size: 1rem;
        border-radius: 8px;
        padding: 4px 12px;
        margin-left: 8px;
        background: #e0f2fe;
        color: #0284c7;
    }
    .dynamic-badge.enrolled { background: #fef9c3; color: #b45309; }
    .dynamic-section-title {
        font-weight: 800;
        font-size: 1.35rem;
        margin-bottom: 16px;
        color: #2563eb;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .dynamic-summary {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        padding: 26px 32px;
        margin-top: 36px;
    }
    #selectedItemsList li {
        background: #f1f5f9;
        border-radius: 10px;
        margin-bottom: 8px;
        padding: 8px 14px;
        font-size: 1.08em;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .selected-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #2563eb;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2em;
    }
    .dynamic-btn {
        background: linear-gradient(90deg,#3b82f6 0%,#2563eb 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        padding: 14px 40px;
        font-size: 1.2em;
        font-weight: 700;
        transition: background 0.2s, box-shadow 0.2s;
        box-shadow: 0 2px 8px rgba(59,130,246,0.10);
        margin-top: 18px;
    }
    .dynamic-btn:hover { background: linear-gradient(90deg,#2563eb 0%,#3b82f6 100%); }
    .form-control:focus { box-shadow: 0 0 0 2px #3b82f6; border-color: #3b82f6; }
    label, strong, .form-control, .dynamic-btn { font-family: 'Tajawal', Arial, sans-serif; }
</style>
<div class="container py-4">
    <!-- الكارد الرئيسي الفاخر -->
    <div class="main-elegant-card mb-5">
        <span class="main-icon"><i class="fas fa-user-graduate"></i></span>
        <div>
            <div class="main-title">إضافة كورسات أو بكجات للطالب</div>
            <div class="main-student">{{ $student->name }}</div>
        </div>
    </div>
    <form method="POST" action="{{ route('admin.accounts.students.courses.enroll', $student->id) }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="dynamic-section-title"><i class="fas fa-book-open"></i> الكورسات المتاحة</div>
                <div>
                    @foreach($courses as $course)
                        @php $isEnrolled = in_array($course->id, $enrolledCourseIds); @endphp
                        <label class="dynamic-card {{ $isEnrolled ? 'bg-light' : '' }}" style="cursor:{{ $isEnrolled ? 'not-allowed' : 'pointer' }};">
                            <span class="dynamic-icon"><i class="fas fa-book"></i></span>
                            <input type="checkbox" name="courses[]" value="{{ $course->id }}" 
                                   class="form-check-input me-2 course-checkbox" 
                                   data-price="{{ $course->price }}" 
                                   data-title="{{ $course->title }}"
                                   data-type="course"
                                   {{ $isEnrolled ? 'disabled' : '' }}>
                            <div class="flex-grow-1">
                                <strong style="font-size:1.1em;">{{ $course->title }}</strong>
                                @if($isEnrolled)
                                    <span class="dynamic-badge enrolled">مسجل مسبقاً</span>
                                @endif
                                <div class="text-muted" style="font-size:0.97em;">{{ $course->category->name ?? '' }}</div>
                                <div style="font-size:0.97em;">{{ $course->description }}</div>
                                <div class="mt-1">
                                    <span class="dynamic-badge">السعر: {{ $course->price }} {{ $course->currency ?? 'ر.س' }}</span>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="dynamic-section-title"><i class="fas fa-box"></i> البكجات المتاحة</div>
                <div>
                    @foreach($packages as $package)
                        @php $isEnrolled = in_array($package->id, $enrolledPackageIds); @endphp
                        <label class="dynamic-card {{ $isEnrolled ? 'bg-light' : '' }}" style="cursor:{{ $isEnrolled ? 'not-allowed' : 'pointer' }};">
                            <span class="dynamic-icon"><i class="fas fa-cubes"></i></span>
                            <input type="checkbox" name="packages[]" value="{{ $package->id }}" 
                                   class="form-check-input me-2 package-checkbox" 
                                   data-price="{{ $package->price }}" 
                                   data-title="{{ $package->name }}"
                                   data-type="package"
                                   {{ $isEnrolled ? 'disabled' : '' }}>
                            <div class="flex-grow-1">
                                <strong style="font-size:1.1em;">{{ $package->name }}</strong>
                                @if($isEnrolled)
                                    <span class="dynamic-badge enrolled">مسجل مسبقاً</span>
                                @endif
                                <div class="text-muted" style="font-size:0.97em;">{{ $package->category->name ?? '' }}</div>
                                <div style="font-size:0.97em;">{{ $package->description }}</div>
                                <div>
                                    <small>الدورات:
                                        @foreach($package->packageCourses as $pc)
                                            {{ $pc->course->title }}{{ !$loop->last ? ',' : '' }}
                                        @endforeach
                                    </small>
                                </div>
                                <div class="mt-1">
                                    <span class="dynamic-badge">السعر: {{ $package->price }} {{ $package->currency ?? 'ر.س' }}</span>
                                </div>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- فورم الخصم الجماعي -->
        <div class="dynamic-summary">
            <h5 class="mb-3" style="font-weight:700;color:#2563eb;"><i class="fas fa-receipt"></i> ملخص الاختيار</h5>
            <ul id="selectedItemsList" class="mb-3"></ul>
            <div class="mb-2 row align-items-center">
                <div class="col-md-4 col-12 mb-2 mb-md-0">
                    <label class="mb-1">نسبة الخصم (%)</label>
                    <input type="number" name="discount" id="discountInput" class="form-control" min="0" max="100" value="0">
                </div>
                <div class="col-md-8 col-12">
                    <label class="mb-1">السعر الإجمالي بعد الخصم:</label>
                    <span id="totalAfterDiscount" class="fw-bold text-success" style="font-size:1.2em;">0</span>
                </div>
            </div>
            <button type="submit" class="dynamic-btn"><i class="fas fa-check-circle me-1"></i> تأكيد الإضافة</button>
        </div>
    </form>
</div>
<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script>
function calculateTotal() {
    let total = 0;
    let selectedItems = [];
    document.querySelectorAll('.course-checkbox:checked:not(:disabled), .package-checkbox:checked:not(:disabled)').forEach(function(checkbox) {
        let price = parseFloat(checkbox.getAttribute('data-price')) || 0;
        let title = checkbox.getAttribute('data-title');
        let type = checkbox.getAttribute('data-type');
        selectedItems.push({title: title, price: price, type: type});
        total += price;
    });
    let discount = parseFloat(document.getElementById('discountInput').value) || 0;
    let afterDiscount = total - (total * discount / 100);
    document.getElementById('totalAfterDiscount').innerText = afterDiscount.toFixed(2);
    // ملخص العناصر
    let ul = document.getElementById('selectedItemsList');
    ul.innerHTML = '';
    selectedItems.forEach(function(item) {
        let icon = item.type === 'course' ? '<span class="selected-icon"><i class="fas fa-book"></i></span>' : '<span class="selected-icon"><i class="fas fa-cubes"></i></span>';
        ul.innerHTML += `<li>${icon}<span>${item.title}</span> <span>${item.price}</span></li>`;
    });
}

document.querySelectorAll('.course-checkbox, .package-checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', calculateTotal);
});
document.getElementById('discountInput').addEventListener('input', calculateTotal);
window.onload = calculateTotal;
</script>
@endsection 