@extends('layouts.admin')

@section('title', 'Package Details')

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
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
        .info-row {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .course-card {
            transition: transform 0.2s;
        }
        .course-card:hover {
            transform: translateY(-2px);
        }
        .package-image {
            max-width: 200px;
            border-radius: 10px;
        }
        @media (max-width: 600px) {
            .card-body {
                padding: 1rem 0.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-1 fw-bold text-primary">
                            <i class="fas fa-box me-2"></i>
                            Package Details
                        </h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.educational-packages.index') }}">Packages</a></li>
                                <li class="breadcrumb-item active">{{ $package->name }}</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('admin.educational-packages.edit', $package) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Edit
                        </a>
                        <button type="button" class="btn btn-danger" onclick="deletePackage({{ $package->id }})">
                            <i class="fas fa-trash me-2"></i>
                            Delete
                        </button>
                    </div>
                </div>

                <!-- Package Information -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Package Information</h5>
                                
                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Name:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            {{ $package->name }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Description:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            {{ $package->description ?: 'No description available' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Category:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            <span class="badge bg-info">{{ $package->category->name ?? 'No Category' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Original Price (Sum of Courses):</strong>
                                        </div>
                                        <div class="col-md-9">
                                            <span class="text-primary fw-bold">
                                                {{ $package->original_price }} {{ $package->currency ?? 'USD' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Discounted Price (Final):</strong>
                                        </div>
                                        <div class="col-md-9">
                                            <span class="text-success fw-bold">
                                                {{ $package->discounted_price ?? '-' }} {{ $package->currency ?? 'USD' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Status:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            <span class="badge {{ $package->status == 'active' ? 'bg-success' : 'bg-secondary' }} status-badge">
                                                {{ ucfirst($package->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Created:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            {{ $package->created_at->format('F d, Y \a\t g:i A') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-row">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <strong>Last Updated:</strong>
                                        </div>
                                        <div class="col-md-9">
                                            {{ $package->updated_at->format('F d, Y \a\t g:i A') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Package Image</h5>
                                
                                @if($package->image)
                                    <img src="{{ asset('storage/' . $package->image) }}" 
                                         alt="Package Image" class="img-fluid package-image">
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No image available</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Statistics -->
                        <div class="card shadow-sm mt-4">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Statistics</h5>
                                
                                <div class="row text-center">
                                    <div class="col-6">
                                        <div class="text-primary fw-bold fs-4">{{ $package->courses->count() }}</div>
                                        <div class="text-muted small">Courses</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-success fw-bold fs-4">{{ $package->students->count() }}</div>
                                        <div class="text-muted small">Students</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Courses Section -->
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="card-title mb-0">Included Courses</h5>
                            <span class="badge bg-primary">{{ $package->courses->count() }} courses</span>
                            <button class="btn btn-success btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#addCoursesModal">
                                <i class="fas fa-plus"></i> Add Courses
                            </button>
                        </div>

                        @if($package->courses->count() > 0)
                            <div class="row">
                                @foreach($package->courses as $course)
                                    <div class="col-lg-4 col-md-6 mb-4">
                                        <div class="card course-card h-100">
                                            <div class="card-body">
                                                <h6 class="card-title fw-bold">{{ $course->title }}</h6>
                                                <p class="card-text text-muted small">
                                                    {{ Str::limit($course->description, 100) }}
                                                </p>
                                                
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="badge bg-info">{{ $course->credit_hours }} credits</span>
                                                    <span class="badge {{ $course->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ ucfirst($course->status) }}
                                                    </span>
                                                </div>
                                                
                                                <div class="mt-3 d-flex gap-2">
                                                    <a href="{{ route('admin.educational-courses.show', $course) }}" 
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-eye me-1"></i>
                                                        View Course
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeCourseModal" data-course-id="{{ $course->id }}" data-course-title="{{ $course->title }}">
                                                        <i class="fas fa-trash"></i> Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-book fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">No courses assigned to this package</h6>
                                <p class="text-muted">Edit the package to add courses.</p>
                                <a href="{{ route('admin.educational-packages.edit', $package) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>
                                    Edit Package
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Students Section -->
                @if($package->students->count() > 0)
                    <div class="card shadow-sm mt-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Enrolled Students</h5>
                                <span class="badge bg-success">{{ $package->students->count() }} students</span>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Enrollment Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($package->students as $studentPackage)
                                            <tr>
                                                <td>{{ $studentPackage->student->name ?? 'N/A' }}</td>
                                                <td>{{ $studentPackage->student->email ?? 'N/A' }}</td>
                                                <td>{{ $studentPackage->created_at->format('M d, Y') }}</td>
                                                <td>
                                                    <span class="badge bg-success">Enrolled</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this package? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Courses Modal -->
    <div class="modal fade" id="addCoursesModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.educational-packages.add-courses', $package) }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Courses to Package</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control mb-3" id="searchCourseInput" placeholder="Search courses...">
                        <div style="max-height: 350px; overflow-y: auto;">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Course</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody id="coursesListBody">
                                    @foreach($allCourses as $course)
                                        @if(!$package->courses->contains($course->id))
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="courses[{{ $course->id }}][selected]" value="1" class="course-checkbox">
                                            </td>
                                            <td>{{ $course->title }}</td>
                                            <td>{{ $course->price }} {{ $package->currency ?? 'USD' }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="noResultsMsg" class="text-center text-muted d-none">No results found.</div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h6 class="fw-bold mb-3"><i class="fas fa-money-bill-wave me-2"></i>Update Package Pricing</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Current Original Price</label>
                                <input type="text" id="currentOriginalPrice" class="form-control" value="{{ $package->original_price }} {{ $package->currency ?? 'USD' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">New Original Price (After Adding)</label>
                                <input type="text" id="newOriginalPriceAfterAdd" class="form-control" readonly>
                            </div>
                        </div>
                        
                        <div class="mb-3 mt-4">
                            <label class="form-label">Discount Type</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discount_type" id="add_discount_percent_radio" value="percent">
                                    <label class="form-check-label" for="add_discount_percent_radio">خصم نسبة مئوية</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discount_type" id="add_discount_price_radio" value="price">
                                    <label class="form-check-label" for="add_discount_price_radio">سعر نهائي يدوي</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discount_type" id="add_no_discount_radio" value="none" checked>
                                    <label class="form-check-label" for="add_no_discount_radio">بدون خصم</label>
                                </div>
                            </div>
                        </div>
                        
                        <div id="add_percent_input_wrap" class="mb-3" style="display: none;">
                            <label class="form-label">Discount Percentage</label>
                            <div class="input-group">
                                <input type="number" id="addDiscountPercentage" class="form-control" min="0" max="100" step="0.01" 
                                       placeholder="نسبة الخصم %">
                                <span class="input-group-text">%</span>
                            </div>
                            <div id="add_percent_preview" class="mt-2 text-success fw-bold"></div>
                        </div>
                        
                        <div id="add_price_input_wrap" class="mb-3" style="display: none;">
                            <label class="form-label">Final Price</label>
                            <div class="input-group">
                                <input type="number" id="addDiscountedPrice" class="form-control" min="0" step="0.01" 
                                       placeholder="السعر النهائي بعد الخصم">
                                <span class="input-group-text">{{ $package->currency ?? 'USD' }}</span>
                            </div>
                            <div id="add_price_preview" class="mt-2 text-info fw-bold"></div>
                        </div>
                        
                        <div id="add_no_discount_preview" class="mb-3" style="display: none;">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                سيتم عرض السعر الأصلي بدون خصم
                            </div>
                        </div>
                        
                        <!-- Final Price Display -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div id="addFinalPriceDisplay" class="p-3 bg-success text-white rounded" style="display: none;">
                                    <h6 class="mb-2"><i class="fas fa-tag me-2"></i>Final Package Price</h6>
                                    <div id="addFinalPriceValue" class="fs-4 fw-bold"></div>
                                    <div id="addFinalPriceDetails" class="small mt-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Selected Courses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Remove Course Modal -->
    <div class="modal fade" id="removeCourseModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" id="removeCourseForm" action="">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Remove Course from Package</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Are you sure you want to remove <span id="modalCourseTitle" class="fw-bold text-danger"></span> from this package?
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Original Price after removal</label>
                                <input type="text" id="newOriginalPrice" class="form-control" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Current Currency</label>
                                <input type="text" id="currentCurrency" class="form-control" value="{{ $package->currency ?? 'USD' }}" readonly>
                            </div>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h6 class="fw-bold mb-3"><i class="fas fa-money-bill-wave me-2"></i>Update Package Pricing</h6>
                        
                        <div class="mb-3">
                            <label class="form-label">Discount Type</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discount_type" id="remove_discount_percent_radio" value="percent">
                                    <label class="form-check-label" for="remove_discount_percent_radio">خصم نسبة مئوية</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discount_type" id="remove_discount_price_radio" value="price">
                                    <label class="form-check-label" for="remove_discount_price_radio">سعر نهائي يدوي</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="discount_type" id="remove_no_discount_radio" value="none" checked>
                                    <label class="form-check-label" for="remove_no_discount_radio">بدون خصم</label>
                                </div>
                            </div>
                        </div>
                        
                        <div id="remove_percent_input_wrap" class="mb-3" style="display: none;">
                            <label class="form-label">Discount Percentage</label>
                            <div class="input-group">
                                <input type="number" id="removeDiscountPercentage" class="form-control" min="0" max="100" step="0.01" 
                                       placeholder="نسبة الخصم %">
                                <span class="input-group-text">%</span>
                            </div>
                            <div id="remove_percent_preview" class="mt-2 text-success fw-bold"></div>
                        </div>
                        
                        <div id="remove_price_input_wrap" class="mb-3" style="display: none;">
                            <label class="form-label">Final Price</label>
                            <div class="input-group">
                                <input type="number" id="removeDiscountedPrice" class="form-control" min="0" step="0.01" 
                                       placeholder="السعر النهائي بعد الخصم">
                                <span class="input-group-text">{{ $package->currency ?? 'USD' }}</span>
                            </div>
                            <div id="remove_price_preview" class="mt-2 text-info fw-bold"></div>
                        </div>
                        
                        <div id="remove_no_discount_preview" class="mb-3" style="display: none;">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                سيتم عرض السعر الأصلي بدون خصم
                            </div>
                        </div>
                        
                        <!-- Final Price Display -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div id="removeFinalPriceDisplay" class="p-3 bg-success text-white rounded" style="display: none;">
                                    <h6 class="mb-2"><i class="fas fa-tag me-2"></i>Final Package Price</h6>
                                    <div id="removeFinalPriceValue" class="fs-4 fw-bold"></div>
                                    <div id="removeFinalPriceDetails" class="small mt-1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-2"></i>
                            Confirm Remove
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function deletePackage(packageId) {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const form = document.getElementById('deleteForm');
            form.action = `/admin/educational-packages/${packageId}`;
            modal.show();
        }

        // بحث ديناميكي
        document.getElementById('searchCourseInput').addEventListener('input', function() {
            let val = this.value.toLowerCase();
            let rows = document.querySelectorAll('#coursesListBody tr');
            let found = false;
            rows.forEach(row => {
                let text = row.children[1].innerText.toLowerCase();
                if(text.includes(val)) {
                    row.style.display = '';
                    found = true;
                } else {
                    row.style.display = 'none';
                }
            });
            document.getElementById('noResultsMsg').classList.toggle('d-none', found);
        });

        // تفعيل حقل الخصم عند اختيار الكورس
        document.querySelectorAll('.course-checkbox').forEach(cb => {
            cb.addEventListener('change', function() {
                updateAddCoursesPricing();
            });
        });

        // منطق إظهار/إخفاء حقول الخصم في مودال الإضافة
        document.getElementById('add_discount_percent_radio').addEventListener('change', function() {
            showAddDiscountInput('percent');
            updateAddFinalPrice();
        });
        document.getElementById('add_discount_price_radio').addEventListener('change', function() {
            showAddDiscountInput('price');
            updateAddFinalPrice();
        });
        document.getElementById('add_no_discount_radio').addEventListener('change', function() {
            showAddDiscountInput('none');
            updateAddFinalPrice();
        });

        // دالة إظهار/إخفاء حقول الخصم في مودال الإضافة
        function showAddDiscountInput(type) {
            document.getElementById('add_percent_input_wrap').style.display = 'none';
            document.getElementById('add_price_input_wrap').style.display = 'none';
            document.getElementById('add_no_discount_preview').style.display = 'none';
            
            // إزالة خاصية required و name من جميع الحقول
            document.getElementById('addDiscountPercentage').removeAttribute('required');
            document.getElementById('addDiscountedPrice').removeAttribute('required');
            document.getElementById('addDiscountPercentage').removeAttribute('name');
            document.getElementById('addDiscountedPrice').removeAttribute('name');
            
            if (type === 'percent') {
                document.getElementById('add_percent_input_wrap').style.display = 'block';
                document.getElementById('addDiscountPercentage').setAttribute('required', 'required');
                document.getElementById('addDiscountPercentage').setAttribute('name', 'package_discount_percentage');
            } else if (type === 'price') {
                document.getElementById('add_price_input_wrap').style.display = 'block';
                document.getElementById('addDiscountedPrice').setAttribute('required', 'required');
                document.getElementById('addDiscountedPrice').setAttribute('name', 'package_discounted_price');
            } else if (type === 'none') {
                document.getElementById('add_no_discount_preview').style.display = 'block';
                // لا نحتاج لحقول مطلوبة عند اختيار "بدون خصم"
            }
        }

        // دالة تحديث أسعار الباقة عند إضافة كورسات
        function updateAddCoursesPricing() {
            const currentOriginalPrice = parseFloat(document.getElementById('currentOriginalPrice').value) || 0;
            let additionalPrice = 0;
            
            // حساب السعر الإضافي من الكورسات المختارة
            document.querySelectorAll('.course-checkbox:checked').forEach(checkbox => {
                const row = checkbox.closest('tr');
                const priceText = row.querySelector('td:last-child').textContent;
                const price = parseFloat(priceText.replace(/[^\d.]/g, '')) || 0;
                additionalPrice += price;
            });
            
            const newOriginalPrice = currentOriginalPrice + additionalPrice;
            document.getElementById('newOriginalPriceAfterAdd').value = newOriginalPrice.toFixed(2) + ' {{ $package->currency ?? "USD" }}';
            
            // تحديث السعر النهائي
            updateAddFinalPrice();
        }

        // دالة تحديث السعر النهائي في مودال الإضافة
        function updateAddFinalPrice() {
            const newOriginalPriceText = document.getElementById('newOriginalPriceAfterAdd').value;
            const originalPrice = parseFloat(newOriginalPriceText.replace(/[^\d.]/g, '')) || 0;
            const currency = '{{ $package->currency ?? "USD" }}';
            
            let finalPrice = originalPrice;
            let discountPercentage = 0;
            let discountAmount = 0;
            let details = '';
            
            if (document.getElementById('add_discount_percent_radio').checked) {
                const percentInput = document.getElementById('addDiscountPercentage');
                const percent = parseFloat(percentInput.value) || 0;
                
                if (percent > 0 && originalPrice > 0) {
                    discountPercentage = percent;
                    discountAmount = originalPrice * (percent / 100);
                    finalPrice = originalPrice - discountAmount;
                    
                    const percentPreview = document.getElementById('add_percent_preview');
                    percentPreview.innerHTML = `السعر بعد الخصم: <span class="text-success">${finalPrice.toFixed(2)} ${currency}</span>`;
                    
                    details = `خصم ${percent}% (${discountAmount.toFixed(2)} ${currency})`;
                } else {
                    const percentPreview = document.getElementById('add_percent_preview');
                    percentPreview.innerHTML = '';
                }
            } else if (document.getElementById('add_discount_price_radio').checked) {
                const priceInput = document.getElementById('addDiscountedPrice');
                const discountedPrice = parseFloat(priceInput.value) || 0;
                
                if (discountedPrice > 0 && originalPrice > 0) {
                    finalPrice = discountedPrice;
                    discountAmount = originalPrice - discountedPrice;
                    discountPercentage = (discountAmount / originalPrice) * 100;
                    
                    const pricePreview = document.getElementById('add_price_preview');
                    if (discountPercentage > 0) {
                        pricePreview.innerHTML = `نسبة الخصم: <span class="text-info">${discountPercentage.toFixed(2)}%</span>`;
                        details = `خصم ${discountPercentage.toFixed(2)}% (${discountAmount.toFixed(2)} ${currency})`;
                    } else {
                        pricePreview.innerHTML = '';
                        details = 'بدون خصم';
                    }
                } else {
                    const pricePreview = document.getElementById('add_price_preview');
                    pricePreview.innerHTML = '';
                }
            } else {
                details = 'بدون خصم';
            }
            
            if (originalPrice > 0) {
                document.getElementById('addFinalPriceValue').innerHTML = `${finalPrice.toFixed(2)} ${currency}`;
                document.getElementById('addFinalPriceDetails').innerHTML = details;
                document.getElementById('addFinalPriceDisplay').style.display = 'block';
            } else {
                document.getElementById('addFinalPriceDisplay').style.display = 'none';
            }
        }

        // إضافة مستمعي الأحداث لتحديث السعر النهائي في مودال الإضافة
        document.getElementById('addDiscountPercentage').addEventListener('input', updateAddFinalPrice);
        document.getElementById('addDiscountedPrice').addEventListener('input', updateAddFinalPrice);
        
        // إضافة validation على جانب العميل لمودال الإضافة
        document.querySelector('#addCoursesModal form').addEventListener('submit', function(e) {
            const discountType = document.querySelector('#addCoursesModal input[name="discount_type"]:checked').value;
            let isValid = true;
            
            // إزالة رسائل الخطأ السابقة
            document.querySelectorAll('#addCoursesModal .invalid-feedback').forEach(el => el.remove());
            document.querySelectorAll('#addCoursesModal .is-invalid').forEach(el => el.classList.remove('is-invalid'));
            
            if (discountType === 'percent') {
                const percentInput = document.getElementById('addDiscountPercentage');
                const percent = parseFloat(percentInput.value) || 0;
                
                if (percent < 0 || percent > 100) {
                    percentInput.classList.add('is-invalid');
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = 'نسبة الخصم يجب أن تكون بين 0 و 100';
                    percentInput.parentNode.appendChild(errorDiv);
                    isValid = false;
                }
            } else if (discountType === 'price') {
                const priceInput = document.getElementById('addDiscountedPrice');
                const price = parseFloat(priceInput.value) || 0;
                
                if (price < 0) {
                    priceInput.classList.add('is-invalid');
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = 'السعر يجب أن يكون أكبر من أو يساوي 0';
                    priceInput.parentNode.appendChild(errorDiv);
                    isValid = false;
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });

        // مودال الحذف
        let removeModal = document.getElementById('removeCourseModal');
        removeModal.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget;
            let courseId = button.getAttribute('data-course-id');
            let courseTitle = button.getAttribute('data-course-title');
            document.getElementById('modalCourseTitle').innerText = courseTitle;
            
            // تنظيف الحقول أولاً
            document.getElementById('removeDiscountPercentage').value = '';
            document.getElementById('removeDiscountedPrice').value = '';
            
            // إزالة أي خصائص مطلوبة من الحقول
            document.getElementById('removeDiscountPercentage').removeAttribute('required');
            document.getElementById('removeDiscountedPrice').removeAttribute('required');
            document.getElementById('removeDiscountPercentage').removeAttribute('name');
            document.getElementById('removeDiscountedPrice').removeAttribute('name');
            
            // احسب السعر الجديد بعد الحذف (AJAX)
            fetch(`/admin/educational-packages/{{ $package->id }}/course-price-after-remove/${courseId}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('newOriginalPrice').value = data.original_price + ' {{ $package->currency ?? "USD" }}';
                    
                    // تحديث السعر النهائي
                    updateRemoveFinalPrice();
                });
            
            // حدث الفورم
            document.getElementById('removeCourseForm').action = `/admin/educational-packages/{{ $package->id }}/remove-course/${courseId}`;
            
            // تعيين الخيار الافتراضي إلى "بدون خصم" وتحديث الحقول
            document.getElementById('remove_no_discount_radio').checked = true;
            showRemoveDiscountInput('none');
        });

        // منطق إظهار/إخفاء حقول الخصم في مودال الحذف
        document.getElementById('remove_discount_percent_radio').addEventListener('change', function() {
            showRemoveDiscountInput('percent');
            updateRemoveFinalPrice();
        });
        document.getElementById('remove_discount_price_radio').addEventListener('change', function() {
            showRemoveDiscountInput('price');
            updateRemoveFinalPrice();
        });
        document.getElementById('remove_no_discount_radio').addEventListener('change', function() {
            showRemoveDiscountInput('none');
            updateRemoveFinalPrice();
        });

        // دالة إظهار/إخفاء حقول الخصم في مودال الحذف
        function showRemoveDiscountInput(type) {
            document.getElementById('remove_percent_input_wrap').style.display = 'none';
            document.getElementById('remove_price_input_wrap').style.display = 'none';
            document.getElementById('remove_no_discount_preview').style.display = 'none';
            
            // إزالة خاصية required و name من جميع الحقول
            document.getElementById('removeDiscountPercentage').removeAttribute('required');
            document.getElementById('removeDiscountedPrice').removeAttribute('required');
            document.getElementById('removeDiscountPercentage').removeAttribute('name');
            document.getElementById('removeDiscountedPrice').removeAttribute('name');
            
            if (type === 'percent') {
                document.getElementById('remove_percent_input_wrap').style.display = 'block';
                document.getElementById('removeDiscountPercentage').setAttribute('required', 'required');
                document.getElementById('removeDiscountPercentage').setAttribute('name', 'package_discount_percentage');
            } else if (type === 'price') {
                document.getElementById('remove_price_input_wrap').style.display = 'block';
                document.getElementById('removeDiscountedPrice').setAttribute('required', 'required');
                document.getElementById('removeDiscountedPrice').setAttribute('name', 'package_discounted_price');
            } else if (type === 'none') {
                document.getElementById('remove_no_discount_preview').style.display = 'block';
                // لا نحتاج لحقول مطلوبة عند اختيار "بدون خصم"
            }
        }

        // دالة تحديث السعر النهائي في مودال الحذف
        function updateRemoveFinalPrice() {
            const originalInput = document.getElementById('newOriginalPrice');
            const finalPriceDisplay = document.getElementById('removeFinalPriceDisplay');
            const finalPriceValue = document.getElementById('removeFinalPriceValue');
            const finalPriceDetails = document.getElementById('removeFinalPriceDetails');
            
            const originalPriceText = originalInput.value;
            const originalPrice = parseFloat(originalPriceText.replace(/[^\d.]/g, '')) || 0;
            const currency = document.getElementById('currentCurrency').value || 'USD';
            
            let finalPrice = originalPrice;
            let discountPercentage = 0;
            let discountAmount = 0;
            let details = '';
            
            if (document.getElementById('remove_discount_percent_radio').checked) {
                const percentInput = document.getElementById('removeDiscountPercentage');
                const percent = parseFloat(percentInput.value) || 0;
                
                if (percent > 0 && originalPrice > 0) {
                    discountPercentage = percent;
                    discountAmount = originalPrice * (percent / 100);
                    finalPrice = originalPrice - discountAmount;
                    
                    const percentPreview = document.getElementById('remove_percent_preview');
                    percentPreview.innerHTML = `السعر بعد الخصم: <span class="text-success">${finalPrice.toFixed(2)} ${currency}</span>`;
                    
                    details = `خصم ${percent}% (${discountAmount.toFixed(2)} ${currency})`;
                } else {
                    const percentPreview = document.getElementById('remove_percent_preview');
                    percentPreview.innerHTML = '';
                }
            } else if (document.getElementById('remove_discount_price_radio').checked) {
                const priceInput = document.getElementById('removeDiscountedPrice');
                const discountedPrice = parseFloat(priceInput.value) || 0;
                
                if (discountedPrice > 0 && originalPrice > 0) {
                    finalPrice = discountedPrice;
                    discountAmount = originalPrice - discountedPrice;
                    discountPercentage = (discountAmount / originalPrice) * 100;
                    
                    const pricePreview = document.getElementById('remove_price_preview');
                    if (discountPercentage > 0) {
                        pricePreview.innerHTML = `نسبة الخصم: <span class="text-info">${discountPercentage.toFixed(2)}%</span>`;
                        details = `خصم ${discountPercentage.toFixed(2)}% (${discountAmount.toFixed(2)} ${currency})`;
                    } else {
                        pricePreview.innerHTML = '';
                        details = 'بدون خصم';
                    }
                } else {
                    const pricePreview = document.getElementById('remove_price_preview');
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

        // إضافة مستمعي الأحداث لتحديث السعر النهائي في مودال الحذف
        document.getElementById('removeDiscountPercentage').addEventListener('input', updateRemoveFinalPrice);
        document.getElementById('removeDiscountedPrice').addEventListener('input', updateRemoveFinalPrice);
        
        // إضافة validation على جانب العميل لمودال الحذف
        document.getElementById('removeCourseForm').addEventListener('submit', function(e) {
            const discountType = document.querySelector('input[name="discount_type"]:checked').value;
            let isValid = true;
            
            // إزالة رسائل الخطأ السابقة
            document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
            document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
            
            if (discountType === 'percent') {
                const percentInput = document.getElementById('removeDiscountPercentage');
                const percent = parseFloat(percentInput.value) || 0;
                
                if (percent < 0 || percent > 100) {
                    percentInput.classList.add('is-invalid');
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = 'نسبة الخصم يجب أن تكون بين 0 و 100';
                    percentInput.parentNode.appendChild(errorDiv);
                    isValid = false;
                }
            } else if (discountType === 'price') {
                const priceInput = document.getElementById('removeDiscountedPrice');
                const price = parseFloat(priceInput.value) || 0;
                
                if (price < 0) {
                    priceInput.classList.add('is-invalid');
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'invalid-feedback';
                    errorDiv.textContent = 'السعر يجب أن يكون أكبر من أو يساوي 0';
                    priceInput.parentNode.appendChild(errorDiv);
                    isValid = false;
                }
            }
            
            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });
    </script>
@endpush
