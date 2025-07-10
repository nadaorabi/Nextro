@extends('layouts.admin')

@section('title', 'Create Educational Package')

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

        /* Select2 Styling */
        .select2-container--default .select2-selection--multiple {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            min-height: 46px;
            padding: 5px;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            color: white;
            border-radius: 6px;
            padding: 2px 8px;
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
                                <h4 class="mb-0">Add New Educational Package</h4>
                                <p class="text-muted mb-0">Create a new package to organize your educational courses</p>
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
                        <form action="{{ route('admin.educational-packages.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

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
                                                value="{{ old('name') }}" 
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
                                                placeholder="Provide a detailed description of this package...">{{ old('description') }}</textarea>
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
                                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                                        <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                                                            Active - Visible to users
                                                        </option>
                                                        <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
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
                                                    Upload an image (optional)<br>
                                                    <span class="text-primary">Supported: JPG, PNG, GIF (Max: 2MB)</span>
                                                </small>
                                                
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
                                        <i class="fas fa-graduation-cap me-2"></i>Select Courses *
                                    </label>
                                    <select name="courses[]" id="coursesSelect" class="form-control @error('courses') is-invalid @enderror" multiple required>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}" data-price="{{ $course->price }}" 
                                                {{ (is_array(old('courses')) && in_array($course->id, old('courses'))) ? 'selected' : '' }}>
                                                {{ $course->title }} - {{ $course->price }} {{ $course->currency ?? 'USD' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('courses')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Select multiple courses to include in this package</small>
                                </div>
                            </div>

                            <!-- Pricing Section -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="fas fa-dollar-sign me-2"></i>Pricing Configuration
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Original Price (Sum of Selected Courses)</label>
                                            <input type="text" id="originalPrice" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="currency" class="form-label">Currency</label>
                                            <select name="currency" id="currency" class="form-select">
                                                <option value="USD" {{ old('currency', 'USD') == 'USD' ? 'selected' : '' }}>USD</option>
                                                <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                                <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
                                                <option value="SAR" {{ old('currency') == 'SAR' ? 'selected' : '' }}>SAR</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Discount Type</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="discount_type" id="discount_percent" value="percent">
                                            <label class="form-check-label" for="discount_percent">Percentage Discount</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="discount_type" id="discount_price" value="price">
                                            <label class="form-check-label" for="discount_price">Set Final Price</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="discount_type" id="no_discount" value="none" checked>
                                            <label class="form-check-label" for="no_discount">No Discount</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="percentageInput" class="mb-3" style="display: none;">
                                    <label for="discount_percentage" class="form-label">Discount Percentage</label>
                                    <div class="input-group">
                                        <input type="number" name="discount_percentage" id="discount_percentage" class="form-control" min="0" max="100" step="0.01">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>

                                <div id="priceInput" class="mb-3" style="display: none;">
                                    <label for="discounted_price" class="form-label">Final Price</label>
                                    <input type="number" name="discounted_price" id="discounted_price" class="form-control" min="0" step="0.01">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Final Package Price</label>
                                    <div id="finalPrice" class="p-3 bg-success text-white rounded fs-5 fw-bold">0.00 USD</div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.educational-packages.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create Package
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
            const selectedOptions = $('#coursesSelect').select2('data');
            let totalPrice = 0;
            
            selectedOptions.forEach(option => {
                const price = parseFloat($(option.element).data('price')) || 0;
                totalPrice += price;
            });
            
            const currency = document.getElementById('currency').value || 'USD';
            document.getElementById('originalPrice').value = totalPrice.toFixed(2) + ' ' + currency;
            
            updateFinalPrice();
        }

        function updateFinalPrice() {
            const originalPriceText = document.getElementById('originalPrice').value;
            const originalPrice = parseFloat(originalPriceText.replace(/[^\d.]/g, '')) || 0;
            const currency = document.getElementById('currency').value || 'USD';
            
            let finalPrice = originalPrice;
            
            if (document.getElementById('discount_percent').checked) {
                const percentage = parseFloat(document.getElementById('discount_percentage').value) || 0;
                finalPrice = originalPrice - (originalPrice * percentage / 100);
            } else if (document.getElementById('discount_price').checked) {
                finalPrice = parseFloat(document.getElementById('discounted_price').value) || 0;
            }
            
            document.getElementById('finalPrice').innerHTML = finalPrice.toFixed(2) + ' ' + currency;
        }

        $(document).ready(function() {
            // Initialize Select2
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
            
            // Discount type handlers
            $('input[name="discount_type"]').on('change', function() {
                const value = this.value;
                
                $('#percentageInput').hide();
                $('#priceInput').hide();
                
                if (value === 'percent') {
                    $('#percentageInput').show();
                } else if (value === 'price') {
                    $('#priceInput').show();
                }
                
                updateFinalPrice();
            });
            
            $('#discount_percentage, #discounted_price, #currency').on('input change', updateFinalPrice);
            
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



