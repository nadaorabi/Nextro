@extends('layouts.admin')

@section('title', 'Edit Educational Package')

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
            color: #344767;
        }

        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #5a67d8, #6b46c1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #6c757d;
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 10px;
            border: none;
        }

        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: #667eea;
            font-weight: 700;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .current-image {
            max-width: 150px;
            border-radius: 10px;
            margin-top: 10px;
        }

        @media (max-width: 600px) {
            .card-body {
                padding: 1rem;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12" style="max-width:900px;">
                
                <!-- Header Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">Edit Educational Package</h4>
                                <p class="text-muted mb-0">Update package information and settings</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.educational-packages.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Packages
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('admin.educational-packages.update', $package) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Basic Information Section -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="fas fa-info-circle me-2"></i>Basic Information
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-4">
                                            <label for="name" class="form-label">
                                                <i class="fas fa-box me-2"></i>Package Name *
                                            </label>
                                            <input type="text" name="name" id="name" 
                                                class="form-control @error('name') is-invalid @enderror" 
                                                value="{{ old('name', $package->name) }}" 
                                                placeholder="Enter package name (e.g., Complete Web Development, Data Science Bundle)"
                                                required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="description" class="form-label">
                                                <i class="fas fa-align-left me-2"></i>Description
                                            </label>
                                            <textarea name="description" id="description" 
                                                class="form-control @error('description') is-invalid @enderror" 
                                                rows="4" 
                                                placeholder="Provide a detailed description of this package...">{{ old('description', $package->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label for="category_id" class="form-label">
                                                        <i class="fas fa-tag me-2"></i>Category *
                                                    </label>
                                                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" {{ old('category_id', $package->category_id) == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label for="status" class="form-label">
                                                        <i class="fas fa-toggle-on me-2"></i>Package Status
                                                    </label>
                                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                                        <option value="active" {{ old('status', $package->status) === 'active' ? 'selected' : '' }}>
                                                            Active - Visible to users
                                                        </option>
                                                        <option value="inactive" {{ old('status', $package->status) === 'inactive' ? 'selected' : '' }}>
                                                            Inactive - Hidden from users
                                                        </option>
                                                    </select>
                                                    @error('status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="image" class="form-label">
                                                <i class="fas fa-image me-2"></i>Package Image
                                            </label>
                                            <div class="border-2 border-dashed rounded-3 p-4 text-center bg-light">
                                                <input type="file" name="image" id="image" 
                                                    class="form-control @error('image') is-invalid @enderror" 
                                                    accept="image/*"
                                                    onchange="previewImage(event)">
                                                <small class="text-muted d-block mt-2">
                                                    Upload a new image (optional)<br>
                                                    <span class="text-primary">Supported: JPG, PNG, GIF (Max: 2MB)</span>
                                                </small>
                                                
                                                <!-- Current Image Display -->
                                                @if($package->image)
                                                    <div class="mt-3">
                                                        <label class="form-label text-muted">Current Image:</label>
                                                        <img src="{{ asset('storage/' . $package->image) }}" 
                                                             alt="Current Package Image" class="current-image d-block mx-auto">
                                                    </div>
                                                @endif
                                                
                                                <!-- Image Preview -->
                                                <div id="imagePreview" class="mt-3" style="display: none;">
                                                    <img id="preview" src="" class="img-thumbnail" width="150" alt="Preview">
                                                    <div class="mt-2">
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                                                            <i class="fas fa-trash"></i> Remove
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('image')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Courses Section -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="fas fa-book me-2"></i>Course Selection
                                </h5>
                                
                                <div class="mb-4">
                                    <label for="coursesSelect" class="form-label">
                                        <i class="fas fa-list me-2"></i>Select Courses *
                                    </label>
                                    <select name="courses[]" id="coursesSelect" class="form-select select2-multi @error('courses') is-invalid @enderror" multiple>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}" 
                                                    data-price="{{ $course->price }}" 
                                                    data-category="{{ $course->category_id }}"
                                                    {{ in_array($course->id, old('courses', $package->courses->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                {{ $course->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('courses')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Select the courses to include in this package. Courses will be filtered based on selected category.</small>
                                </div>
                            </div>

                            <!-- Pricing Section -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="fas fa-dollar-sign me-2"></i>Package Pricing
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label class="form-label">
                                                <i class="fas fa-calculator me-2"></i>Original Price (From Courses)
                                            </label>
                                            <input type="text" id="originalPriceInput" class="form-control" value="{{ $package->original_price ?? '0.00' }} {{ $package->currency ?? 'USD' }}" readonly>
                                            <small class="text-muted">Calculated automatically from selected courses</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="currency" class="form-label">
                                                <i class="fas fa-coins me-2"></i>Currency
                                            </label>
                                            <select name="currency" id="currency" class="form-select @error('currency') is-invalid @enderror">
                                                <option value="USD" {{ old('currency', $package->currency) == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                                                <option value="SAR" {{ old('currency', $package->currency) == 'SAR' ? 'selected' : '' }}>SAR - Saudi Riyal</option>
                                                <option value="AED" {{ old('currency', $package->currency) == 'AED' ? 'selected' : '' }}>AED - UAE Dirham</option>
                                                <option value="EUR" {{ old('currency', $package->currency) == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                                            </select>
                                            @error('currency')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="discount_percentage" class="form-label">
                                                <i class="fas fa-percent me-2"></i>Discount Percentage
                                            </label>
                                            <div class="input-group">
                                                <input type="number" name="discount_percentage" id="discount_percentage" class="form-control @error('discount_percentage') is-invalid @enderror" step="0.01" min="0" max="100" value="{{ old('discount_percentage', $package->discount_percentage ?? 0) }}">
                                                <span class="input-group-text">%</span>
                                            </div>
                                            <small class="text-muted">Enter 0 for no discount</small>
                                            @error('discount_percentage')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-4">
                                            <label class="form-label">
                                                <i class="fas fa-money-bill-wave me-2"></i>Final Package Price
                                            </label>
                                            <div class="alert alert-info">
                                                <div class="form-control-plaintext fw-bold fs-4 text-success mb-0" id="finalPrice">
                                                    ${{ $package->discounted_price ?? $package->original_price ?? '0.00' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.educational-packages.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Package
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
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        function removeImage() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreview').style.display = 'none';
        }

        function updateOriginalPrice() {
            let total = 0;
            $('#coursesSelect option:selected').each(function() {
                total += parseFloat($(this).data('price')) || 0;
            });
            
            const currency = document.querySelector('select[name="currency"]').value || 'USD';
            document.getElementById('originalPriceInput').value = total.toFixed(2) + ' ' + currency;
            updateFinalPrice();
        }

        // Calculate final price
        function updateFinalPrice() {
            const originalInput = document.getElementById('originalPriceInput');
            const originalPrice = parseFloat(originalInput.value) || 0;
            const discount = parseFloat(document.querySelector('input[name="discount_percentage"]').value) || 0;
            const currency = document.querySelector('select[name="currency"]').value || 'USD';
            
            let finalPrice = originalPrice;
            
            if (discount > 0 && originalPrice > 0) {
                const discountAmount = (originalPrice * discount) / 100;
                finalPrice = originalPrice - discountAmount;
            }
                    
            const finalPriceElement = document.getElementById('finalPrice');
            let symbol = '$';
            
            switch(currency) {
                case 'SAR':
                    symbol = 'SAR';
                    break;
                case 'AED':
                    symbol = 'AED';
                    break;
                case 'EUR':
                    symbol = '€';
                    break;
                default:
                    symbol = '$';
            }
            
            finalPriceElement.textContent = `${symbol}${finalPrice.toFixed(2)}`;
            
            if (discount > 0) {
                finalPriceElement.innerHTML += ` <small class="text-muted">(<span class="text-danger">${discount}% off</span>)</small>`;
            }
        }

        $(document).ready(function() {
            // Store all courses in JavaScript variable
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
                var selectedCourses = coursesSelect.val() || [];
                
                // Remove all options
                coursesSelect.empty();
                // Add only courses from selected category
                var filtered = allCourses.filter(function(course) {
                    return categoryId ? course.category == categoryId : true;
                });
                filtered.forEach(function(course) {
                    coursesSelect.append(
                        $('<option>', {
                            value: course.id,
                            text: course.text,
                            'data-category': course.category,
                            'data-price': course.price,
                            selected: selectedCourses.includes(course.id)
                        })
                    );
                });
                // Reinitialize Select2
                coursesSelect.trigger('change');
            }

            $('#coursesSelect').select2({
                placeholder: 'Select courses for this package...',
                width: '100%',
                closeOnSelect: false,
                allowClear: true,
                language: {
                    noResults: function() { return 'No courses found'; },
                    searching: function() { return 'Searching...'; }
                }
            });
            
            $('#coursesSelect').on('change', updateOriginalPrice);
            
            // Filter courses by selected category
            $('select[name="category_id"]').on('change', function() {
                const selectedCategoryId = $(this).val();
                filterCoursesByCategory(selectedCategoryId);
                updateOriginalPrice();
            });
            
            // Apply filter on page load if there's a pre-selected category
            const initialCategory = $('select[name="category_id"]').val();
            if (initialCategory) {
                filterCoursesByCategory(initialCategory);
            }

            // Add event listeners to update final price
            document.querySelector('input[name="discount_percentage"]').addEventListener('input', updateFinalPrice);
            document.querySelector('select[name="currency"]').addEventListener('change', function() {
                updateOriginalPrice(); // This will call updateFinalPrice internally
            });
            
            // Initialize prices on page load
            updateOriginalPrice();

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
@endpush 