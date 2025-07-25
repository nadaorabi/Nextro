@extends('layouts.admin')

@section('title', 'Educational Packages List')

@push('styles')
    <style>
        .stat-card {
            min-height: 140px;
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 24px;
            background: #fff;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.04);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--card-color, #5e72e4);
        }
        
        .stat-card.primary::before { background: #5e72e4; }
        .stat-card.success::before { background: #2dce89; }
        .stat-card.info::before { background: #11cdef; }
        .stat-card.warning::before { background: #fb6340; }
        
        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px auto;
            font-size: 24px;
            color: white;
        }
        
        .stat-card .stat-icon.primary { background: linear-gradient(45deg, #5e72e4, #825ee4); }
        .stat-card .stat-icon.success { background: linear-gradient(45deg, #2dce89, #2dcecc); }
        .stat-card .stat-icon.info { background: linear-gradient(45deg, #11cdef, #1171ef); }
        .stat-card .stat-icon.warning { background: linear-gradient(45deg, #fb6340, #fbb140); }
        
        .stat-card .stat-title {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #8898aa;
            margin-bottom: 8px;
            line-height: 1.2;
        }
        
        .stat-card .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #32325d;
            margin-bottom: 4px;
            line-height: 1;
        }
        
        .stat-card .stat-description {
            font-size: 0.875rem;
            color: #8898aa;
            margin: 0;
            line-height: 1.3;
        }
        
        .stat-card .stat-description .highlight {
            font-weight: 600;
        }
        
        .stat-card .stat-description .success { color: #2dce89; }
        .stat-card .stat-description .info { color: #11cdef; }
        .stat-card .stat-description .warning { color: #fb6340; }

        .welcome-animated {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            animation: bounce 1.5s infinite alternate, gradientMove 3s linear infinite;
            letter-spacing: 2px;
            margin-top: 20px;
            background: linear-gradient(90deg, #007bff, #00c6ff, #007bff);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-20px); }
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .modal-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .border-dashed {
            border-style: dashed !important;
        }

        .bg-light-warning {
            background-color: rgba(255, 193, 7, 0.1) !important;
        }

        .bg-light-danger {
            background-color: rgba(220, 53, 69, 0.1) !important;
        }

        .btn-lg {
            border-radius: 10px;
            font-weight: 600;
        }

        .alert {
            border-radius: 10px;
        }

        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translate(0, -50px);
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        .icon-shape {
            transition: all 0.3s ease;
        }

        .icon-shape:hover {
            transform: scale(1.1);
        }

        .border-dashed:hover {
            border-color: #667eea !important;
            background-color: rgba(102, 126, 234, 0.05) !important;
        }

        /* Custom file input styling for English */
        input[type="file"] {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            color: #495057 !important;
        }

        input[type="file"]::-webkit-file-upload-button {
            background: #007bff;
            color: white;
            border: none;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            cursor: pointer;
            margin-right: 10px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            font-size: 0.875rem;
        }

        input[type="file"]::-webkit-file-upload-button:hover {
            background: #0056b3;
        }

        /* For Firefox */
        input[type="file"]::file-selector-button {
            background: #007bff;
            color: white;
            border: none;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            cursor: pointer;
            margin-right: 10px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            font-size: 0.875rem;
        }

        input[type="file"]::file-selector-button:hover {
            background: #0056b3;
        }
        
        @media (max-width: 991px) {
            .stat-card {
                min-height: 120px;
                padding: 20px;
            }
            
            .stat-card .stat-icon {
                width: 48px;
                height: 48px;
                font-size: 20px;
                margin-bottom: 12px;
            }
            
            .stat-card .stat-value {
            font-size: 2rem;
            }

            .modal-dialog.modal-lg {
                max-width: 95%;
                margin: 0.5rem auto;
            }

            .modal-body .row {
                flex-direction: column;
            }

            .modal-body .col-md-8,
            .modal-body .col-md-4 {
                max-width: 100%;
                flex: 0 0 100%;
            }
        }

        @media (max-width: 576px) {
            .modal-dialog.modal-lg {
                max-width: 98%;
                margin: 0.25rem auto;
            }

            .modal-body {
                padding: 1rem !important;
            }

            .form-control-lg,
            .form-select-lg {
                font-size: 1rem;
                padding: 0.5rem 0.75rem;
            }

            .btn-lg {
                padding: 0.5rem 1rem;
                font-size: 1rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
        }

        /* تحسين الأيقونات */
        .avatar .fas {
            font-size: 1.2rem;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')

    <!-- Welcome Card -->
    <div class="card mb-4">
        <div class="card-body p-3">
        <div class="row">
                <div class="col-lg-6">
                    <h1 class="text-gradient text-primary">Educational Packages Management</h1>
                    <p class="mb-0">Manage, add, and edit educational packages and course bundles</p>
                            </div>
                <div class="col-lg-6 text-end">
                    <a href="{{ route('admin.educational-packages.create') }}" class="btn btn-primary mb-0">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Package
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

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card primary">
                <div class="stat-icon primary">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-title">Total Packages</div>
                        <div class="stat-value">{{ $packages->total() }}</div>
                <div class="stat-description">
                    <span class="highlight success">+{{ $packages->count() }}</span> on this page
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-check-circle"></i>
                    </div>
                <div class="stat-title">Active Packages</div>
                        <div class="stat-value">{{ $packages->where('status', 'active')->count() }}</div>
                <div class="stat-description">
                    <span class="highlight success">{{ $packages->count() > 0 ? round(($packages->where('status', 'active')->count() / $packages->count()) * 100) : 0 }}%</span> are active
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card info">
                <div class="stat-icon info">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-title">Total Courses</div>
                <div class="stat-value">{{ $packages->sum('courses_count') }}</div>
                <div class="stat-description">
                    <span class="highlight info">{{ $packages->where('courses_count', '>', 0)->count() }}</span> packages with courses
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-title">Average Price</div>
                <div class="stat-value">${{ $packages->count() > 0 ? number_format($packages->avg('original_price'), 0) : 0 }}</div>
                <div class="stat-description">
                    <span class="highlight warning">{{ $packages->whereNotNull('discounted_price')->where('discounted_price', '!=', 'original_price')->count() }}</span> with discounts
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Status Filter</label>
                        <select id="status-filter" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Search Packages</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input id="search-input" type="text" class="form-control" placeholder="Search by package name...">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Price Range</label>
                        <select id="price-filter" class="form-select">
                            <option value="">All Prices</option>
                            <option value="low">$0 - $50</option>
                            <option value="medium">$50 - $200</option>
                            <option value="high">$200+</option>
                        </select>
                    </div>
                </div>
            </div>
                    </div>
                </div>

                <!-- Packages Table -->
    <div class="card">
        <div class="card-header pb-0">
            <h6 class="text-primary fw-bold">Educational Packages</h6>
                        </div>
        <div class="card-body px-0 pt-0 pb-2">
                        @if($packages->count() > 0)
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Package Details</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Package ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Category</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Courses</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Price</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    Created Date</th>
                                <th class="text-secondary opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            @foreach ($packages as $package)
                                            <tr>
                                                <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                @if($package->hasImage())
                                                    <img src="{{ $package->getImageUrl() }}" 
                                                        class="avatar avatar-sm me-3" alt="package">
                                                @else
                                                    <div class="avatar avatar-sm me-3 bg-light d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $package->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">
                                                    {{ $package->description ? \Illuminate\Support\Str::limit($package->description, 50) : 'No description available' }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            PKG-{{ str_pad($package->id, 3, '0', STR_PAD_LEFT) }}</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-info">{{ $package->category->name ?? 'No Category' }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-primary">{{ $package->courses->count() }} courses</span>
                                                </td>
                                                <td>
                                        <div class="d-flex flex-column">
                                            <div class="fw-bold">${{ $package->discounted_price ?? $package->original_price }}</div>
                                            @if($package->discounted_price && $package->discounted_price != $package->original_price)
                                                <small class="text-muted text-decoration-line-through">${{ $package->original_price }}</small>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                        @if($package->status === 'active')
                                            <span class="badge badge-sm bg-gradient-success">Active</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-warning">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{ $package->created_at->format('Y-m-d') }}
                                        </p>
                                                </td>
                                                                        <td class="align-middle">
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="{{ route('admin.educational-packages.edit', $package->id) }}"
                                                class="btn btn-link text-info p-2"
                                                title="Edit Package">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="{{ route('admin.educational-packages.show', $package->id) }}"
                                                class="btn btn-link text-primary p-2"
                                                title="View Package Details">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <button class="btn btn-link text-danger p-2" data-bs-toggle="modal"
                                                data-bs-target="#deletePackageModal"
                                                onclick="confirmPackageDelete({{ $package->id }}, '{{ $package->name }}')"
                                                title="Delete Package">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center p-3">
                    <p class="text-sm mb-0">Showing
                        {{ $packages->firstItem() }}-{{ $packages->lastItem() }} of
                        {{ $packages->total() }} packages
                    </p>
                    {{ $packages->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-box fa-3x text-muted mb-3"></i>
                                <h6 class="text-muted">No packages found</h6>
                                <p class="text-muted">Start by creating your first educational package.</p>
                                <a href="{{ route('admin.educational-packages.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>
                                    Create First Package
                                </a>
                            </div>
                        @endif
                    </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deletePackageModal" tabindex="-1" aria-labelledby="deletePackageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" id="deletePackageForm">
                @csrf
                @method('DELETE')
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-white text-dark border-bottom">
                        <h5 class="modal-title fw-bold" id="deletePackageModalLabel">
                            <i class="fas fa-exclamation-triangle me-2 text-danger"></i>Confirm Deletion
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 text-center bg-white">
                        <div class="mb-4">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                                <i class="fas fa-trash-alt text-white text-lg opacity-10" style="font-size: 2rem; line-height: 80px;"></i>
                            </div>
                            <h4 class="text-danger fw-bold mb-3">Are you sure?</h4>
                            <p class="text-muted mb-2">You are about to delete the package:</p>
                            <div class="alert alert-warning border-0 bg-light-warning">
                                <strong class="text-warning" id="packageNamePlaceholder"></strong>
                            </div>
                            <div class="alert alert-danger border-0 bg-light-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <strong>This action cannot be undone!</strong>
                                <br>
                                <small>All associated data will be permanently removed.</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-white border-top justify-content-center">
                        <button type="button" class="btn btn-secondary btn-lg px-4 me-3" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-danger btn-lg px-4">
                            <i class="fas fa-trash-alt me-2"></i>Delete Package
                        </button>
                </div>
            </div>
            </form>
        </div>
    </div>

    
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Set page language to English to ensure file input displays English text
        document.documentElement.lang = 'en';
        
        function confirmPackageDelete(packageId, packageName) {
            const form = document.getElementById('deletePackageForm');
            const namePlaceholder = document.getElementById('packageNamePlaceholder');
            namePlaceholder.textContent = `"${packageName}"`;
            form.action = `/admin/educational-packages/${packageId}`;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Force English for all file inputs
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.setAttribute('lang', 'en');
                input.style.fontFamily = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
            });

            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('status-filter');
            const priceFilter = document.getElementById('price-filter');
            const tableRows = document.querySelectorAll('table tbody tr');

            function filterPackages() {
                const searchText = searchInput.value.toLowerCase();
                const selectedStatus = statusFilter.value;
                const selectedPriceRange = priceFilter.value;

                tableRows.forEach(row => {
                    const name = row.querySelector('h6').textContent.toLowerCase();
                    const description = row.querySelector('p.text-secondary').textContent.toLowerCase();
                    const statusCell = row.cells[5];
                    const priceCell = row.cells[4];
                    
                    if (!statusCell || !priceCell) return;
                    
                    const status = statusCell.textContent.trim();
                    const priceText = priceCell.querySelector('.fw-bold').textContent.replace('$', '');
                    const price = parseFloat(priceText) || 0;

                    const matchesSearch = name.includes(searchText) || description.includes(searchText);
                    const matchesStatus = selectedStatus === '' || status === selectedStatus;
                    
                    let matchesPrice = true;
                    if (selectedPriceRange === 'low') {
                        matchesPrice = price >= 0 && price <= 50;
                    } else if (selectedPriceRange === 'medium') {
                        matchesPrice = price > 50 && price <= 200;
                    } else if (selectedPriceRange === 'high') {
                        matchesPrice = price > 200;
                    }

                    row.style.display = (matchesSearch && matchesStatus && matchesPrice) ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterPackages);
            statusFilter.addEventListener('change', filterPackages);
            priceFilter.addEventListener('change', filterPackages);

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
