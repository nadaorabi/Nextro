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
    #resultsGrid .card {
        overflow: hidden;
        position: relative;
    }
    #resultsGrid .card-body {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    #resultsGrid .card-body .d-flex.gap-2 {
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 6px;
        width: 100%;
    }
    #resultsGrid .card-body {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    #resultsGrid .card {
        padding-left: 8px;
        padding-right: 8px;
    }
    #resultsGrid .select-btn, #resultsGrid .info-btn {
        font-size: 0.95em !important;
        padding: 4px 12px !important;
        min-width: 70px;
        border-radius: 7px !important;
    }
    #infoModal .modal-content {
        border-radius: 0 !important;
    }
    #infoModal .btn-close {
        font-size: 1.5rem;
        outline: none;
        box-shadow: none;
    }
    #infoModal .modal-dialog {
        max-width: 450px;
    }
    #infoModal .btn-close {
        font-size: 1.5rem;
        outline: none;
        box-shadow: none;
        filter: grayscale(1) brightness(0.7);
        background-color: #ccc !important;
        border-radius: 50%;
        opacity: 1;
    }
    /* كارد الملخص */
    #summaryCard {
        display: block;
        background: linear-gradient(120deg,rgb(208, 236, 250) 0%, #e3eafe 100%);
        border-radius: 22px;
        box-shadow: 0 8px 32px rgba(59,130,246,0.13);
        padding: 32px 36px 28px 36px;
        margin-top: 36px;
        margin-bottom: 24px;
        max-width: 900px;
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        direction: rtl;
        border: 1.5px solid #e0e7ef;
        transition: box-shadow 0.2s, border 0.2s;
    }
    #summaryCard .summary-title {
        font-weight: 900;
        font-size: 1.35rem;
        color: #2563eb;
        margin-bottom: 18px;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 8px rgba(37,99,235,0.10);
    }
    #summaryCard ul {
        list-style: none;
        padding: 0;
        margin: 0 0 18px 0;
    }
    #summaryCard li {
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 10px;
        padding: 10px 18px;
        font-size: 1.08em;
        display: flex;
        align-items: center;
        gap: 12px;
        justify-content: space-between;
        box-shadow: 0 1px 6px rgba(59,130,246,0.07);
    }
    #summaryCard .total {
        font-size: 1.18em;
        font-weight: bold;
        color: #2563eb;
        margin-bottom: 16px;
        background: #e0f2fe;
        border-radius: 8px;
        padding: 8px 18px;
        display: inline-block;
    }
    #summaryCard .dynamic-btn {
        width: 100%;
        margin-top: 0;
        font-size: 1.15em;
        font-weight: 800;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(59,130,246,0.10);
        background: linear-gradient(90deg,#3b82f6 0%,#2563eb 100%);
        transition: background 0.2s, box-shadow 0.2s;
    }
    #summaryCard .dynamic-btn:hover {
        background: linear-gradient(90deg,#2563eb 0%,#3b82f6 100%);
    }
    #summaryCard .empty-msg {
        color: #64748b;
        font-size: 1.08em;
        text-align: center;
        margin: 18px 0 10px 0;
        background: #f1f5f9;
        border-radius: 8px;
        padding: 12px 0;
    }
    .back-details-btn {
        background: #8a9bb2 !important;
        color: #fff !important;
        border: none !important;
        border-radius: 14px !important;
        font-weight: bold;
        font-size: 1.15em;
        padding: 12px 28px !important;
        box-shadow: 0 2px 8px rgba(59,130,246,0.10);
        transition: background 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .back-details-btn:hover {
        background: #6c7a8a !important;
        color: #fff !important;
    }
</style>
<div class="container py-4">
    <!-- Student Info Card -->
    <div class="main-elegant-card mb-5" style="background:#fff;border-radius:22px;box-shadow:0 4px 24px rgba(37,99,235,0.13);padding:32px 32px 24px 32px;display:flex;align-items:center;gap:24px;position:relative;">
        <a href="{{ route('admin.accounts.students.show', $student->id) }}" class="back-details-btn" style="position:absolute;top:18px;right:24px;z-index:2;">
            <i class="fas fa-arrow-left"></i> Back to Details
        </a>
        <span class="main-icon" style="width:64px;height:64px;font-size:2.2em;background:rgba(59,130,246,0.10);color:#2563eb;"><i class="fas fa-user-graduate"></i></span>
        <div>
            <div class="main-title" style="color:#2563eb;font-size:2em;font-weight:800;margin-bottom:0.2em;letter-spacing:0.5px;">إضافة كورسات أو بكجات للطالب</div>
            <div class="main-student" style="color:#2563eb;font-size:1.1em;font-weight:600;background:rgba(59,130,246,0.07);border-radius:8px;padding:4px 18px;display:inline-block;margin-top:8px;box-shadow:0 1px 6px rgba(59,130,246,0.07);">{{ $student->name }}</div>
        </div>
    </div>
    <!-- Filter Bar -->
    <div class="card shadow-sm mb-4 p-3" style="border-radius:18px;background:linear-gradient(90deg,#f1f5fb 0%,#e3eafe 100%);box-shadow:0 2px 12px rgba(59,130,246,0.09);">
        <form id="filterForm" class="row g-2 align-items-center" onsubmit="return false;">
            <div class="col-md-4 col-12">
                <input type="text" id="searchInput" class="form-control" placeholder="ابحث باسم الكورس أو البكج..." style="border-radius:12px;">
            </div>
            <div class="col-md-3 col-6">
                <select id="categoryFilter" class="form-select" style="border-radius:12px;">
                    <option value="">كل الفئات</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 col-6">
                <select id="typeFilter" class="form-select" style="border-radius:12px;">
                    <option value="all">كورسات وبكجات</option>
                    <option value="course">كورسات فقط</option>
                    <option value="package">بكجات فقط</option>
                </select>
            </div>
        </form>
    </div>
    <!-- Grid Results -->
    <form method="POST" action="{{ route('admin.accounts.students.courses.enroll', $student->id) }}" id="enrollForm">
        @csrf
        <div id="resultsGrid" class="row g-4"></div>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="infoModalLabel">معلومات</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
          </div>
          <div class="modal-body" id="infoModalBody"></div>
        </div>
      </div>
    </div>
    <!-- كارد ملخص العناصر المختارة -->
    <div id="summaryCard">
        <div class="summary-title">ملخص العناصر المختارة</div>
        <ul id="summaryList"></ul>
        <div class="total" id="summaryTotalBox">الإجمالي: <span id="summaryTotal">0</span></div>
        <div class="empty-msg" id="summaryEmptyMsg" style="display:none;">لم يتم اختيار أي عنصر بعد.</div>
        <button type="submit" form="enrollForm" class="dynamic-btn px-5 py-2" id="confirmBtnSummary">
            <i class="fas fa-check-circle me-1"></i> تأكيد الإضافة
        </button>
    </div>
</div>
@php
    $coursesArray = $courses->map(function($c) use($enrolledCourseIds) {
        return [
            'id' => $c->id,
            'title' => $c->title,
            'category_id' => $c->category_id,
            'category' => $c->category ? $c->category->name : '',
            'description' => $c->description,
            'price' => $c->price,
            'currency' => $c->currency ?? 'ر.س',
            'type' => 'course',
            'enrolled' => in_array($c->id, $enrolledCourseIds),
        ];
    });
    $packagesArray = $packages->map(function($p) use($enrolledPackageIds) {
        return [
            'id' => $p->id,
            'title' => $p->name,
            'category_id' => $p->category_id,
            'category' => $p->category ? $p->category->name : '',
            'description' => $p->description,
            'price' => $p->discounted_price ?? $p->price,
            'currency' => $p->currency ?? 'ر.س',
            'type' => 'package',
            'courses' => $p->packageCourses->map(function($pc){
                $c = $pc->course;
                return $c ? [
                    'title' => $c->title,
                    'category' => $c->category->name ?? '',
                    'description' => $c->description,
                    'price' => $c->price,
                    'currency' => $c->currency ?? 'ر.س',
                ] : null;
            })->filter()->values(),
            'enrolled' => in_array($p->id, $enrolledPackageIds),
        ];
    });
@endphp

<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
const allCourses = @json($coursesArray);
const allPackages = @json($packagesArray);
let selectedCourses = [];
let selectedPackages = [];
// Build a set of enrolled course IDs for fast lookup
const enrolledCourseIds = new Set(allCourses.filter(c => c.enrolled).map(c => c.id));
function renderGrid() {
    const search = document.getElementById('searchInput').value.trim().toLowerCase();
    const cat = document.getElementById('categoryFilter').value;
    const type = document.getElementById('typeFilter').value;
    let items = [...allCourses, ...allPackages];
    if(type !== 'all') items = items.filter(i => i.type === type);
    if(cat) items = items.filter(i => i.category_id == cat);
    if(search) items = items.filter(i => i.title.toLowerCase().includes(search) || (i.description && i.description.toLowerCase().includes(search)));
    const grid = document.getElementById('resultsGrid');
    grid.innerHTML = '';
    if(items.length === 0) {
        grid.innerHTML = '<div class="text-center text-muted py-5">لا توجد نتائج مطابقة</div>';
        return;
    }
    items.forEach(item => {
        let icon = item.type === 'course' ? 'fa-book' : 'fa-box';
        let color = item.type === 'course' ? 'linear-gradient(135deg,#2563eb 0%,#60a5fa 100%)' : 'linear-gradient(135deg,#a21caf 0%,#f472b6 100%)';
        let enrolled = item.enrolled ? '<span class="badge bg-warning mb-2">مسجل مسبقاً</span>' : '';
        let extra = '';
        let conflictMsg = '';
        let canSelect = true;
        if(item.type === 'package') {
            // Check for conflicts: any course in the package is already enrolled?
            const conflicts = (item.courses || []).filter(c => {
                // Find course in allCourses by title (since we have only title here)
                let found = allCourses.find(cc => cc.title === c.title);
                return found && found.enrolled;
            });
            if(conflicts.length) {
                canSelect = false;
                conflictMsg = `<div class='alert alert-danger p-2 mb-2' style='font-size:0.98em;'>لا يمكن تسجيل البكج لأن الطالب مسجل في: <strong>${conflicts.map(c=>c.title).join('، ')}</strong></div>`;
            }
            extra = `<div class='small text-secondary mb-1'>الدورات: ${item.courses.map(c=>c.title).join(', ')}</div>`;
        }
        let isSelected = (item.type === 'course' ? selectedCourses.includes(item.id) : selectedPackages.includes(item.id));
        let selectClass = isSelected ? 'selected-card' : '';
        let disabled = item.enrolled || !canSelect ? 'pointer-events:none;opacity:0.6;' : '';
        let selectBtn = item.enrolled || !canSelect ? '' : `<button type='button' class='btn btn-sm btn-outline-primary select-btn' data-id='${item.id}' data-type='${item.type}' style='border-radius:8px;font-weight:700;'><i class='fas fa-check'></i> ${isSelected ? 'إلغاء' : 'تحديد'}</button>`;
        let infoBtn = `<button type='button' class='btn btn-sm btn-outline-info info-btn' data-id='${item.id}' data-type='${item.type}' style='border-radius:8px;font-weight:700;'><i class='fas fa-info-circle'></i> معلومات</button>`;
        grid.innerHTML += `
        <div class='col-lg-4 col-md-6 col-12'>
            <div class='card shadow-sm h-100 selectable-card ${selectClass}' style='border-radius:18px;cursor:pointer;${disabled};transition:box-shadow .2s,border .2s;' data-id='${item.id}' data-type='${item.type}'>
                <div class='card-body d-flex flex-column p-4'>
                    <div class='d-flex align-items-center mb-2'>
                        <span style='background:${color};color:#fff;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;font-size:1.5em;'><i class='fas ${icon}'></i></span>
                        <div class='ms-3'>
                            <strong style='font-size:1.15em;'>${item.title}</strong><br>
                            <span class='text-muted small'>${item.category}</span>
                        </div>
                    </div>
                    ${enrolled}
                    ${conflictMsg}
                    <div class='mb-1 text-secondary small'>${item.description || ''}</div>
                    ${extra}
                    <div class='mt-auto d-flex justify-content-between align-items-end gap-2'>
                        <span class='badge bg-info' style='font-size:1em;padding:7px 18px;border-radius:10px;'>${item.price} ${item.currency}</span>
                        <div class='d-flex gap-2'>${selectBtn}${infoBtn}</div>
                    </div>
                </div>
            </div>
        </div>`;
    });
    // تفعيل التحديد عبر الزر فقط
    document.querySelectorAll('.select-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const id = parseInt(this.getAttribute('data-id'));
            const type = this.getAttribute('data-type');
            if(type === 'course') {
                if(selectedCourses.includes(id)) {
                    selectedCourses = selectedCourses.filter(cid => cid !== id);
                } else {
                    selectedCourses.push(id);
                }
            } else {
                if(selectedPackages.includes(id)) {
                    selectedPackages = selectedPackages.filter(pid => pid !== id);
                } else {
                    selectedPackages.push(id);
                }
            }
            renderGrid();
            renderSummaryCard();
        });
    });
    // تفعيل زر المعلومات
    document.querySelectorAll('.info-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const id = parseInt(this.getAttribute('data-id'));
            const type = this.getAttribute('data-type');
            let item = (type === 'course' ? allCourses : allPackages).find(i => i.id === id);
            let html = '';
            if(type === 'course') {
                html = `<div class='mb-2'><strong style='font-size:1.2em;'>${item.title}</strong></div>
                        <div class='mb-2'><span class='badge bg-primary'>${item.category}</span></div>
                        <div class='mb-2 text-secondary'>${item.description || ''}</div>
                        <div class='mb-2'><span class='badge bg-info'>${item.price} ${item.currency}</span></div>`;
            } else {
                html = `<div class='mb-2'><strong style='font-size:1.2em;'>${item.title}</strong></div>
                        <div class='mb-2'><span class='badge bg-primary'>${item.category}</span></div>
                        <div class='mb-2 text-secondary'>${item.description || ''}</div>
                        <div class='mb-2'><span class='badge bg-info'>${item.price} ${item.currency}</span></div>`;
                if(item.courses && item.courses.length) {
                    html += `<div class='mt-3'><strong>الدورات المضمنة:</strong><table class='table table-bordered mt-2'><thead><tr><th>اسم الكورس</th><th>الفئة</th><th>الوصف</th><th>السعر</th></tr></thead><tbody>`;
                    item.courses.forEach(c => {
                        html += `<tr><td>${c.title}</td><td>${c.category}</td><td>${c.description || ''}</td><td>${c.price} ${c.currency}</td></tr>`;
                    });
                    html += `</tbody></table></div>`;
                }
            }
            document.getElementById('infoModalLabel').innerText = type === 'course' ? 'معلومات الكورس' : 'معلومات البكج';
            document.getElementById('infoModalBody').innerHTML = html;
            let modal = new bootstrap.Modal(document.getElementById('infoModal'));
            modal.show();
        });
    });
    // تحديث كارد الملخص
    renderSummaryCard();
}
document.getElementById('searchInput').addEventListener('input', renderGrid);
document.getElementById('categoryFilter').addEventListener('change', renderGrid);
document.getElementById('typeFilter').addEventListener('change', renderGrid);
document.addEventListener('DOMContentLoaded', function() {
    renderGrid();
    renderSummaryCard();
});
// عند إرسال النموذج أضف الحقول المخفية
const enrollForm = document.getElementById('enrollForm');
enrollForm.addEventListener('submit', function(e) {
    document.querySelectorAll('.hidden-enroll').forEach(el => el.remove());
    selectedCourses.forEach(id => {
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'courses[]';
        input.value = id;
        input.className = 'hidden-enroll';
        this.appendChild(input);
    });
    selectedPackages.forEach(id => {
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'packages[]';
        input.value = id;
        input.className = 'hidden-enroll';
        this.appendChild(input);
    });
});
function renderSummaryCard() {
    const card = document.getElementById('summaryCard');
    const list = document.getElementById('summaryList');
    const totalSpan = document.getElementById('summaryTotal');
    const totalBox = document.getElementById('summaryTotalBox');
    const emptyMsg = document.getElementById('summaryEmptyMsg');
    const confirmBtn = document.getElementById('confirmBtnSummary');
    let items = [
        ...allCourses.filter(c => selectedCourses.includes(c.id) || c.enrolled),
        ...allPackages.filter(p => selectedPackages.includes(p.id) || p.enrolled)
    ];
    list.innerHTML = '';
    let total = 0;
    let hasNew = false;
    if(items.length === 0) {
        totalBox.style.display = 'none';
        emptyMsg.style.display = 'block';
    } else {
        totalBox.style.display = 'inline-block';
        emptyMsg.style.display = 'none';
        items.forEach(item => {
            total += Number(item.price);
            let type = item.type === 'course' ? 'كورس' : 'بكج';
            let isNew = (item.type === 'course' ? selectedCourses.includes(item.id) : selectedPackages.includes(item.id));
            if(isNew) hasNew = true;
            let badge = item.enrolled && !isNew ? "<span class='badge bg-warning text-dark ms-2'>مسجل مسبقًا</span>" : "<span class='badge bg-success ms-2'>جديد</span>";
            list.innerHTML += `<li><span><strong>${item.title}</strong> <span class='badge bg-secondary'>${type}</span> ${item.enrolled && !isNew ? badge : (isNew ? badge : '')}</span><span class='badge bg-info'>${item.price} ${item.currency}</span></li>`;
        });
    }
    totalSpan.innerText = total.toFixed(2) + (items[0]?.currency ? ' ' + items[0].currency : '');
    // تفعيل/تعطيل زر التأكيد حسب وجود عناصر جديدة
    if(confirmBtn) confirmBtn.disabled = !hasNew;
}
</script>
<style>
#resultsGrid .card { min-height: 260px; transition: box-shadow .2s, border .2s; border: none; }
#resultsGrid .card:hover { box-shadow: 0 8px 32px rgba(59,130,246,0.18); }
.selectable-card.selected-card { border: 2.5px solid #2563eb !important; box-shadow: 0 8px 32px rgba(37,99,235,0.13); }
.selectable-card { transition: border .2s, box-shadow .2s; }
.main-elegant-card { box-shadow: 0 8px 32px rgba(59,130,246,0.13); }
.dynamic-btn { background: linear-gradient(90deg,#3b82f6 0%,#2563eb 100%); color: #fff; border: none; border-radius: 12px; padding: 14px 40px; font-size: 1.2em; font-weight: 700; transition: background 0.2s, box-shadow 0.2s; box-shadow: 0 2px 8px rgba(59,130,246,0.10); margin-top: 18px; }
.dynamic-btn:hover { background: linear-gradient(90deg,#2563eb 0%,#3b82f6 100%); }
.form-control:focus, .form-select:focus { box-shadow: 0 0 0 2px #3b82f6; border-color: #3b82f6; }
label, strong, .form-control, .dynamic-btn { font-family: 'Tajawal', Arial, sans-serif; }
</style>
@endsection 