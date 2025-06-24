@extends('layouts.admin')

@section('title', 'Educational Packages')

@push('styles')
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            border: none;
        }
        .card-body {
            padding: 2rem 2.5rem;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .status-badge {
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
        }
        .package-card {
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
        }
        .package-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        .package-card:hover::before {
            transform: scaleX(1);
        }
        .package-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-color: #667eea;
        }
        .search-box {
            border-radius: 0 25px 25px 0;
            border: 2px solid #e9ecef;
            border-left: none;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }
        .search-box:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .search-box:focus + .input-group-text {
            border-color: #667eea;
        }
        .filter-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        .form-select {
            border-radius: 25px;
            border: 2px solid #e9ecef;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-outline-secondary {
            border-radius: 25px;
            border: 2px solid #6c757d;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-outline-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
            transform: translateY(-2px);
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .stats-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.6s ease;
        }
        .stats-card:hover::before {
            transform: rotate(45deg) translate(50%, 50%);
        }
        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
        .package-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .package-image:hover {
            transform: scale(1.05);
        }
        .package-image-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 3rem;
            transition: all 0.3s ease;
        }
        .package-image-placeholder:hover {
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
            transform: scale(1.02);
        }
        .price-tag {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 2px 10px rgba(40, 167, 69, 0.3);
        }
        .price-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .original-price {
            color: #6c757d;
            text-decoration: line-through;
            font-size: 0.9rem;
            margin-top: 2px;
        }
        .discount-badge {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 600;
            margin-top: 4px;
        }
        .category-badge {
            background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(23, 162, 184, 0.3);
        }
        .action-buttons {
            display: flex;
            gap: 8px;
            margin-top: 1rem;
        }
        .action-btn {
            flex: 1;
            border-radius: 20px;
            padding: 8px 12px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }
        .action-btn:hover::before {
            left: 100%;
        }
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .loading-spinner {
            display: none;
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            margin: 2rem 0;
        }
        .no-results {
            text-align: center;
            padding: 3rem;
            color: #6c757d;
            background: #f8f9fa;
            border-radius: 15px;
            margin: 2rem 0;
        }
        .filter-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 1rem;
        }
        .filter-tag {
            background: #667eea;
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }
        .filter-tag:hover {
            background: #5a6fd8;
            transform: translateY(-1px);
        }
        .filter-tag .remove {
            cursor: pointer;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        .filter-tag .remove:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }
            .filter-section {
                padding: 1rem;
            }
            .action-buttons {
                flex-direction: column;
            }
            .stats-card {
                margin-bottom: 1rem;
            }
            .package-image, .package-image-placeholder {
                height: 150px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <!-- Header Section -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="mb-1 fw-bold text-primary">
                            <i class="fas fa-box me-2"></i>
                            Educational Packages
                        </h2>
                        <p class="text-muted mb-0">Manage and organize your educational packages</p>
                    </div>
                    <a href="{{ route('admin.educational-packages.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>
                        Create New Package
                    </a>
                </div>

                <!-- Statistics Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stats-card text-center">
                            <i class="fas fa-box fa-2x mb-2"></i>
                            <h4 class="mb-1">{{ $packages->total() }}</h4>
                            <p class="mb-0">Total Packages</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card text-center">
                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                            <h4 class="mb-1">{{ $packages->where('status', 'active')->count() }}</h4>
                            <p class="mb-0">Active Packages</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card text-center">
                            <i class="fas fa-book fa-2x mb-2"></i>
                            <h4 class="mb-1">{{ $packages->sum('courses_count') }}</h4>
                            <p class="mb-0">Total Courses</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card text-center">
                            <i class="fas fa-users fa-2x mb-2"></i>
                            <h4 class="mb-1">{{ $packages->sum('students_count') }}</h4>
                            <p class="mb-0">Total Students</p>
                        </div>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-3 fw-bold">
                            <i class="fas fa-filter me-2"></i>
                            Search & Filters
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control search-box border-start-0" 
                                           placeholder="Search packages..." id="searchInput">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select" id="categoryFilter">
                                    <option value="">All Categories</option>
                                    @if(isset($categories) && $categories->count() > 0)
                                        @foreach($categories as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" id="statusFilter">
                                    <option value="">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select class="form-select" id="priceFilter">
                                    <option value="">All Prices</option>
                                    <option value="0-100">$0 - $100</option>
                                    <option value="100-500">$100 - $500</option>
                                    <option value="500-1000">$500 - $1000</option>
                                    <option value="1000+">$1000+</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-secondary flex-fill" id="exportBtn">
                                        <i class="fas fa-download me-2"></i>
                                        Export
                                    </button>
                                    <button class="btn btn-outline-info" id="cleanupBtn" title="Cleanup discount percentages">
                                        <i class="fas fa-broom"></i>
                                    </button>
                                    <button class="btn btn-outline-danger" id="clearFiltersBtn">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Active Filters Tags -->
                        <div class="filter-tags" id="filterTags"></div>
                        
                        <!-- Results Count -->
                        <div class="mt-3 d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                Showing <span id="resultsCount">{{ $packages->count() }}</span> of {{ $packages->total() }} packages
                            </small>
                            <div class="d-flex align-items-center gap-2">
                                <small class="text-muted">Sort by:</small>
                                <select class="form-select form-select-sm" id="sortFilter" style="width: auto;">
                                    <option value="newest">Newest First</option>
                                    <option value="oldest">Oldest First</option>
                                    <option value="name-asc">Name A-Z</option>
                                    <option value="name-desc">Name Z-A</option>
                                    <option value="price-low">Price Low to High</option>
                                    <option value="price-high">Price High to Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loading Spinner -->
                <div class="loading-spinner" id="loadingSpinner">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2 text-muted">Filtering packages...</p>
                </div>

                <!-- Packages Grid -->
                <div class="row" id="packagesGrid">
                    @forelse($packages as $package)
                        <div class="col-lg-4 col-md-6 mb-4 package-item" 
                             data-name="{{ strtolower($package->name ?? '') }}"
                             data-description="{{ strtolower($package->description ?? '') }}"
                             data-category="{{ strtolower($package->category->name ?? 'no category') }}"
                             data-status="{{ strtolower($package->status ?? 'inactive') }}"
                             data-price="{{ $package->price ?? 0 }}"
                             data-date="{{ $package->created_at ? $package->created_at->format('Y-m-d') : '' }}">
                            <div class="card package-card h-100">
                                <div class="card-body">
                                    <!-- Package Image -->
                                    @if($package->image)
                                        <img src="{{ asset('storage/' . $package->image) }}" 
                                             alt="Package Image" class="package-image mb-3">
                                    @else
                                        <div class="package-image-placeholder mb-3">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif

                                    <!-- Package Header -->
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h6 class="card-title mb-0 fw-bold text-truncate" style="max-width: 70%;">
                                            {{ $package->name ?? 'Unnamed Package' }}
                                        </h6>
                                        <span class="badge {{ $package->status == 'active' ? 'bg-success' : 'bg-secondary' }} status-badge">
                                            {{ ucfirst($package->status ?? 'inactive') }}
                                        </span>
                                    </div>
                                    
                                    <!-- Description -->
                                    <p class="card-text text-muted small mb-3">
                                        {{ Str::limit($package->description ?? 'No description available', 80) }}
                                    </p>
                                    
                                    <!-- Category -->
                                    <div class="mb-3">
                                        <span class="category-badge">
                                            {{ $package->category && $package->category->name ? $package->category->name : 'No Category' }}
                                        </span>
                                    </div>
                                    
                                    <!-- Statistics -->
                                    <div class="row text-center mb-3">
                                        <div class="col-6">
                                            <div class="text-primary fw-bold fs-5">{{ $package->courses_count ?? 0 }}</div>
                                            <div class="text-muted small">Courses</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-success fw-bold fs-5">{{ $package->students_count ?? 0 }}</div>
                                            <div class="text-muted small">Students</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Price and Date -->
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="price-container">
                                            @if($package->discounted_price && $package->discounted_price < $package->original_price)
                                                <div class="price-tag">
                                                    {{ number_format($package->discounted_price, 2) }} {{ $package->currency ?? 'USD' }}
                                                </div>
                                                <small class="original-price">
                                                    {{ number_format($package->original_price, 2) }} {{ $package->currency ?? 'USD' }}
                                                </small>
                                                @if($package->discount_percentage > 0)
                                                    <span class="discount-badge">
                                                        {{ $package->discount_percentage }}% off
                                                    </span>
                                                @endif
                                            @else
                                                <div class="price-tag">
                                                    {{ number_format($package->original_price ?? 0, 2) }} {{ $package->currency ?? 'USD' }}
                                                </div>
                                            @endif
                                        </div>
                                        <small class="text-muted">
                                            {{ $package->created_at ? $package->created_at->format('M d, Y') : 'Unknown' }}
                                        </small>
                                    </div>
                                    
                                    <!-- Action Buttons -->
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.educational-packages.show', $package) }}" 
                                           class="btn btn-outline-primary action-btn" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.educational-packages.edit', $package) }}" 
                                           class="btn btn-outline-warning action-btn" title="Edit Package">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-outline-danger action-btn" 
                                                onclick="deletePackage({{ $package->id }})" title="Delete Package">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="no-results">
                                <i class="fas fa-box fa-4x text-muted mb-3"></i>
                                <h5 class="text-muted">No packages found</h5>
                                <p class="text-muted">Create your first educational package to get started.</p>
                                <a href="{{ route('admin.educational-packages.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>
                                    Create Package
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- No Results Message -->
                <div class="no-results" id="noResults" style="display: none;">
                    <i class="fas fa-search fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">No packages match your filters</h5>
                    <p class="text-muted">Try adjusting your search criteria or clear all filters.</p>
                    <button class="btn btn-outline-primary" onclick="clearAllFilters()">
                        <i class="fas fa-times me-2"></i>
                        Clear All Filters
                    </button>
                </div>

                <!-- Pagination -->
                @if($packages->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $packages->links() }}
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
@endsection

@push('scripts')
    <script>
        // Global variables for filters
        let activeFilters = {
            search: '',
            category: '',
            status: '',
            price: ''
        };

        // Debounce function for search
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Show loading spinner
        function showLoading() {
            document.getElementById('loadingSpinner').style.display = 'block';
            document.getElementById('packagesGrid').style.display = 'none';
        }

        // Hide loading spinner
        function hideLoading() {
            document.getElementById('loadingSpinner').style.display = 'none';
            document.getElementById('packagesGrid').style.display = 'block';
        }

        // Update filter tags
        function updateFilterTags() {
            const filterTags = document.getElementById('filterTags');
            filterTags.innerHTML = '';

            Object.entries(activeFilters).forEach(([key, value]) => {
                if (value && value.trim() !== '') {
                    const tag = document.createElement('div');
                    tag.className = 'filter-tag';
                    tag.innerHTML = `
                        <span>${key.charAt(0).toUpperCase() + key.slice(1)}: ${value}</span>
                        <span class="remove" onclick="removeFilter('${key}')">&times;</span>
                    `;
                    filterTags.appendChild(tag);
                }
            });
        }

        // Remove specific filter
        function removeFilter(filterType) {
            activeFilters[filterType] = '';
            
            switch(filterType) {
                case 'search':
                    document.getElementById('searchInput').value = '';
                    break;
                case 'category':
                    document.getElementById('categoryFilter').value = '';
                    break;
                case 'status':
                    document.getElementById('statusFilter').value = '';
                    break;
                case 'price':
                    document.getElementById('priceFilter').value = '';
                    break;
            }
            
            updateFilterTags();
            applyFilters();
        }

        // Clear all filters
        function clearAllFilters() {
            activeFilters = {
                search: '',
                category: '',
                status: '',
                price: ''
            };
            
            document.getElementById('searchInput').value = '';
            document.getElementById('categoryFilter').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('priceFilter').value = '';
            document.getElementById('filterTags').innerHTML = '';
            
            updateFilterTags();
            applyFilters();
        }

        // Apply all filters
        function applyFilters() {
            showLoading();
            
            setTimeout(() => {
                const packages = document.querySelectorAll('.package-item');
                let visibleCount = 0;
                
                packages.forEach(package => {
                    const name = package.dataset.name || '';
                    const description = package.dataset.description || '';
                    const category = package.dataset.category || '';
                    const status = package.dataset.status || '';
                    const price = parseFloat(package.dataset.price || 0);
                    
                    let isVisible = true;
                    
                    // Search filter
                    if (activeFilters.search) {
                        const searchTerm = activeFilters.search.toLowerCase();
                        const matchesSearch = name.includes(searchTerm) || 
                                            description.includes(searchTerm) || 
                                            category.includes(searchTerm);
                        if (!matchesSearch) isVisible = false;
                    }
                    
                    // Category filter
                    if (activeFilters.category && isVisible) {
                        const categoryTerm = activeFilters.category.toLowerCase();
                        if (category !== categoryTerm && category !== 'no category') {
                            isVisible = false;
                        }
                    }
                    
                    // Status filter
                    if (activeFilters.status && isVisible) {
                        const statusTerm = activeFilters.status.toLowerCase();
                        if (status !== statusTerm) {
                            isVisible = false;
                        }
                    }
                    
                    // Price filter
                    if (activeFilters.price && isVisible) {
                        const priceRange = activeFilters.price;
                        let isInRange = false;
                        
                        if (priceRange === '0-100') {
                            isInRange = price >= 0 && price <= 100;
                        } else if (priceRange === '100-500') {
                            isInRange = price >= 100 && price <= 500;
                        } else if (priceRange === '500-1000') {
                            isInRange = price >= 500 && price <= 1000;
                        } else if (priceRange === '1000+') {
                            isInRange = price >= 1000;
                        }
                        
                        if (!isInRange) {
                            isVisible = false;
                        }
                    }
                    
                    // Show/hide package
                    package.style.display = isVisible ? 'block' : 'none';
                    if (isVisible) visibleCount++;
                });
                
                // Show/hide no results message
                const noResults = document.getElementById('noResults');
                const packagesGrid = document.getElementById('packagesGrid');
                
                if (visibleCount === 0) {
                    noResults.style.display = 'block';
                    packagesGrid.style.display = 'none';
                } else {
                    noResults.style.display = 'none';
                    packagesGrid.style.display = 'block';
                }
                
                // Update results count
                document.getElementById('resultsCount').textContent = visibleCount;
                
                hideLoading();
                
                // Add animation to visible packages
                const visiblePackages = document.querySelectorAll('.package-item[style*="block"]');
                visiblePackages.forEach((package, index) => {
                    package.style.animation = `fadeInUp 0.5s ease ${index * 0.1}s both`;
                });
                
            }, 300);
        }

        // Search functionality with debounce
        const debouncedSearch = debounce(function() {
            activeFilters.search = this.value;
            updateFilterTags();
            applyFilters();
        }, 300);

        document.getElementById('searchInput').addEventListener('input', debouncedSearch);

        // Category filter
        document.getElementById('categoryFilter').addEventListener('change', function() {
            activeFilters.category = this.value;
            updateFilterTags();
            applyFilters();
        });

        // Status filter
        document.getElementById('statusFilter').addEventListener('change', function() {
            activeFilters.status = this.value;
            updateFilterTags();
            applyFilters();
        });

        // Price filter
        document.getElementById('priceFilter').addEventListener('change', function() {
            activeFilters.price = this.value;
            updateFilterTags();
            applyFilters();
        });

        // Sort filter
        document.getElementById('sortFilter').addEventListener('change', function() {
            sortPackages(this.value);
        });

        // Sort packages function
        function sortPackages(sortType) {
            const packagesGrid = document.getElementById('packagesGrid');
            const packages = Array.from(document.querySelectorAll('.package-item[style*="block"]'));
            
            packages.sort((a, b) => {
                const nameA = a.dataset.name || '';
                const nameB = b.dataset.name || '';
                const priceA = parseFloat(a.dataset.price || 0);
                const priceB = parseFloat(b.dataset.price || 0);
                const dateA = new Date(a.dataset.date || '');
                const dateB = new Date(b.dataset.date || '');
                
                switch(sortType) {
                    case 'newest':
                        return dateB - dateA;
                    case 'oldest':
                        return dateA - dateB;
                    case 'name-asc':
                        return nameA.localeCompare(nameB);
                    case 'name-desc':
                        return nameB.localeCompare(nameA);
                    case 'price-low':
                        return priceA - priceB;
                    case 'price-high':
                        return priceB - priceA;
                    default:
                        return 0;
                }
            });
            
            // Reorder packages in DOM
            packages.forEach(package => {
                packagesGrid.appendChild(package);
            });
            
            // Add animation to reordered packages
            packages.forEach((package, index) => {
                package.style.animation = `fadeInUp 0.3s ease ${index * 0.05}s both`;
            });
        }

        // Clear filters button
        document.getElementById('clearFiltersBtn').addEventListener('click', clearAllFilters);

        // Delete package
        function deletePackage(packageId) {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const form = document.getElementById('deleteForm');
            form.action = `/admin/educational-packages/${packageId}`;
            modal.show();
        }

        // Export functionality
        document.getElementById('exportBtn').addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Exporting...';
            this.disabled = true;
            
            setTimeout(() => {
                window.location.href = '{{ route("admin.educational-packages.export") }}';
                
                setTimeout(() => {
                    this.innerHTML = '<i class="fas fa-download me-2"></i>Export';
                    this.disabled = false;
                }, 2000);
            }, 500);
        });

        // Cleanup discount percentages functionality
        document.getElementById('cleanupBtn').addEventListener('click', function() {
            if (confirm('This will update discount percentages for all packages. Continue?')) {
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                this.disabled = true;
                
                fetch('{{ route("admin.educational-packages.cleanup-discount-percentages") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload(); // Reload page to show updated data
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while cleaning up discount percentages.');
                })
                .finally(() => {
                    this.innerHTML = '<i class="fas fa-broom"></i>';
                    this.disabled = false;
                });
            }
        });

        // Add CSS animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            .package-item {
                animation: fadeInUp 0.5s ease both;
            }
            
            .filter-tag {
                animation: fadeInUp 0.3s ease both;
            }
        `;
        document.head.appendChild(style);

        // Initialize filters
        document.addEventListener('DOMContentLoaded', function() {
            updateFilterTags();
        });
    </script>
@endpush
