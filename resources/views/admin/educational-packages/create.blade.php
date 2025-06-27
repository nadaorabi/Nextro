@extends('layouts.admin')

@section('title', 'Create Package')

@push('styles')
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }
        .card-body {
            padding: 2rem 2.5rem;
        }
        .form-label {
            font-weight: 600;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        @media (max-width: 600px) {
            .card-body {
                padding: 1rem 0.5rem;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12" style="max-width:900px;margin:auto;">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4 fw-bold text-primary text-center">
                            <i class="fas fa-box me-2"></i>
                            Create New Package
                        </h4>

                        <form action="{{ route('admin.educational-packages.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Currency</label>
                                <select name="currency" class="form-select @error('currency') is-invalid @enderror">
                                    <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                    <option value="SAR" {{ old('currency') == 'SAR' ? 'selected' : '' }}>SAR</option>
                                    <option value="AED" {{ old('currency') == 'AED' ? 'selected' : '' }}>AED</option>
                                </select>
                                @error('currency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Courses</label>
                                <select name="courses[]" id="coursesSelect" class="form-select select2-multi @error('courses') is-invalid @enderror" multiple>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" 
                                                data-price="{{ $course->price }}" 
                                                data-category="{{ $course->category_id }}"
                                                {{ (collect(old('courses'))->contains($course->id)) ? 'selected' : '' }}>
                                            {{ $course->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('courses')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">يمكنك اختيار الكورسات بالنقر فقط دون الحاجة للضغط على Ctrl أو Command.</small>
                            </div>

                            <div class="mb-4 p-3 bg-light rounded border">
                                <h5 class="fw-bold mb-3 text-primary"><i class="fas fa-money-bill-wave me-2"></i>Package Pricing</h5>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Original Price (مجموع أسعار الكورسات)</label>
                                        <input type="text" id="originalPriceInput" class="form-control" value="0.00 USD" readonly>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label">Discount Type</label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="discount_type" id="discount_percent_radio" value="percent" 
                                                           {{ old('discount_type', 'none') == 'percent' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="discount_percent_radio">خصم نسبة مئوية</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="discount_type" id="discount_price_radio" value="price"
                                                           {{ old('discount_type', 'none') == 'price' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="discount_price_radio">سعر نهائي يدوي</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="discount_type" id="no_discount_radio" value="none"
                                                           {{ old('discount_type', 'none') == 'none' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="no_discount_radio">بدون خصم</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div id="percent_input_wrap" class="mb-3" style="display: none;">
                                            <label class="form-label">Discount Percentage</label>
                                            <div class="input-group">
                                                <input type="number" name="package_discount_percentage" class="form-control" min="0" max="100" step="0.01" 
                                                       placeholder="نسبة الخصم %" value="{{ old('package_discount_percentage', 0) }}">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <div id="percent_preview" class="mt-2 text-success fw-bold"></div>
                                        </div>
                                        
                                        <div id="price_input_wrap" class="mb-3" style="display: none;">
                                            <label class="form-label">Final Price</label>
                                            <div class="input-group">
                                                <input type="number" name="package_discounted_price" class="form-control" min="0" step="0.01" 
                                                       placeholder="السعر النهائي بعد الخصم" value="{{ old('package_discounted_price', 0) }}">
                                                <span class="input-group-text">USD</span>
                                            </div>
                                            <div id="price_preview" class="mt-2 text-info fw-bold"></div>
                                        </div>
                                        
                                        <div id="no_discount_preview" class="mb-3" style="display: none;">
                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle me-2"></i>
                                                سيتم عرض السعر الأصلي بدون خصم
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Final Price Display -->
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div id="finalPriceDisplay" class="p-3 bg-success text-white rounded" style="display: none;">
                                            <h6 class="mb-2"><i class="fas fa-tag me-2"></i>Final Package Price</h6>
                                            <div id="finalPriceValue" class="fs-4 fw-bold"></div>
                                            <div id="finalPriceDetails" class="small mt-1"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.educational-packages.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>
                                    Create Package
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // منطق إظهار/إخفاء حقول الخصم
        document.getElementById('discount_percent_radio').addEventListener('change', function() {
            showDiscountInput('percent');
            updateFinalPrice();
        });
        document.getElementById('discount_price_radio').addEventListener('change', function() {
            showDiscountInput('price');
            updateFinalPrice();
        });
        document.getElementById('no_discount_radio').addEventListener('change', function() {
            showDiscountInput('none');
            updateFinalPrice();
        });

        // دالة إظهار/إخفاء حقول الخصم
        function showDiscountInput(type) {
            document.getElementById('percent_input_wrap').style.display = 'none';
            document.getElementById('price_input_wrap').style.display = 'none';
            document.getElementById('no_discount_preview').style.display = 'none';
            
            if (type === 'percent') {
                document.getElementById('percent_input_wrap').style.display = 'block';
            } else if (type === 'price') {
                document.getElementById('price_input_wrap').style.display = 'block';
            } else if (type === 'none') {
                document.getElementById('no_discount_preview').style.display = 'block';
            }
        }

        // إظهار/إخفاء الحقول المناسبة عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', function() {
            const percentRadio = document.getElementById('discount_percent_radio');
            const priceRadio = document.getElementById('discount_price_radio');
            const noDiscountRadio = document.getElementById('no_discount_radio');
            
            if (!percentRadio.checked && !priceRadio.checked && !noDiscountRadio.checked) {
                noDiscountRadio.checked = true;
            }
            
            if (percentRadio.checked) {
                showDiscountInput('percent');
            } else if (priceRadio.checked) {
                showDiscountInput('price');
            } else if (noDiscountRadio.checked) {
                showDiscountInput('none');
            }
            
            updateFinalPrice();
        });

        function updateOriginalPrice() {
            let total = 0;
            $('#coursesSelect option:selected').each(function() {
                total += parseFloat($(this).data('price')) || 0;
            });
            document.getElementById('originalPriceInput').value = total.toFixed(2) + ' ' + (document.querySelector('select[name="currency"]').value || 'USD');
            updateFinalPrice();
        }

        // دالة تحديث السعر النهائي
        function updateFinalPrice() {
            const originalInput = document.getElementById('originalPriceInput');
            const finalPriceDisplay = document.getElementById('finalPriceDisplay');
            const finalPriceValue = document.getElementById('finalPriceValue');
            const finalPriceDetails = document.getElementById('finalPriceDetails');
            
            const originalPrice = parseFloat(originalInput.value) || 0;
            const currency = document.querySelector('select[name="currency"]').value || 'USD';
            
            let finalPrice = originalPrice;
            let discountPercentage = 0;
            let discountAmount = 0;
            let details = '';
            
            if (document.getElementById('discount_percent_radio').checked) {
                const percentInput = document.querySelector('input[name="package_discount_percentage"]');
                const percent = parseFloat(percentInput.value) || 0;
                
                if (percent > 0 && originalPrice > 0) {
                    discountPercentage = percent;
                    discountAmount = originalPrice * (percent / 100);
                    finalPrice = originalPrice - discountAmount;
                    
                    const percentPreview = document.getElementById('percent_preview');
                    percentPreview.innerHTML = `السعر بعد الخصم: <span class="text-success">${finalPrice.toFixed(2)} ${currency}</span>`;
                    
                    details = `خصم ${percent}% (${discountAmount.toFixed(2)} ${currency})`;
                } else {
                    const percentPreview = document.getElementById('percent_preview');
                    percentPreview.innerHTML = '';
                }
            } else if (document.getElementById('discount_price_radio').checked) {
                const priceInput = document.querySelector('input[name="package_discounted_price"]');
                const discountedPrice = parseFloat(priceInput.value) || 0;
                
                if (discountedPrice > 0 && originalPrice > 0) {
                    finalPrice = discountedPrice;
                    discountAmount = originalPrice - discountedPrice;
                    discountPercentage = (discountAmount / originalPrice) * 100;
                    
                    const pricePreview = document.getElementById('price_preview');
                    if (discountPercentage > 0) {
                        pricePreview.innerHTML = `نسبة الخصم: <span class="text-info">${discountPercentage.toFixed(2)}%</span>`;
                        details = `خصم ${discountPercentage.toFixed(2)}% (${discountAmount.toFixed(2)} ${currency})`;
                    } else {
                        pricePreview.innerHTML = '';
                        details = 'بدون خصم';
                    }
                } else {
                    const pricePreview = document.getElementById('price_preview');
                    pricePreview.innerHTML = '';
                }
            } else {
                details = 'بدون خصم';
            }
            
            if (originalPrice > 0) {
                finalPriceValue.innerHTML = `${finalPrice.toFixed(2)} ${currency}`;
                finalPriceDetails.innerHTML = details;
                finalPriceDisplay.style.display = 'block';
            } else {
                finalPriceDisplay.style.display = 'none';
            }
        }

        $(document).ready(function() {
            // حفظ جميع الكورسات في متغير جافاسكريبت
            var allCourses = [];
            $('#coursesSelect option').each(function() {
                allCourses.push({
                    id: $(this).val(),
                    text: $(this).text(),
                    category: $(this).data('category'),
                    price: $(this).data('price')
                });
            });

            function filterCoursesByCategory(categoryId) {
                var coursesSelect = $('#coursesSelect');
                // إزالة جميع الخيارات
                coursesSelect.empty();
                // إضافة فقط الكورسات من الفئة المختارة
                var filtered = allCourses.filter(function(course) {
                    return categoryId ? course.category == categoryId : true;
                });
                filtered.forEach(function(course) {
                    coursesSelect.append(
                        $('<option>', {
                            value: course.id,
                            text: course.text,
                            'data-category': course.category,
                            'data-price': course.price
                        })
                    );
                });
                // إعادة تهيئة Select2
                coursesSelect.val(null).trigger('change');
            }

            $('#coursesSelect').select2({
                placeholder: 'اختر الكورسات...',
                width: '100%',
                dir: 'rtl',
                closeOnSelect: false,
                allowClear: true,
                language: {
                    noResults: function() { return 'لا توجد نتائج'; },
                    searching: function() { return 'جاري البحث...'; }
                }
            });
            $('#coursesSelect').on('change', updateOriginalPrice);
            
            // تصفية الكورسات حسب الفئة المختارة
            $('select[name="category_id"]').on('change', function() {
                const selectedCategoryId = $(this).val();
                filterCoursesByCategory(selectedCategoryId);
                updateOriginalPrice();
            });
            
            // تطبيق التصفية عند تحميل الصفحة إذا كانت هناك فئة مختارة مسبقاً
            const initialCategory = $('select[name="category_id"]').val();
            if (initialCategory) {
                filterCoursesByCategory(initialCategory);
            }
        });

        // إضافة مستمعي الأحداث لتحديث السعر النهائي
        document.querySelector('input[name="package_discount_percentage"]').addEventListener('input', updateFinalPrice);
        document.querySelector('input[name="package_discounted_price"]').addEventListener('input', updateFinalPrice);
        document.querySelector('select[name="currency"]').addEventListener('change', updateFinalPrice);
    </script>
@endpush



