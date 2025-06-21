<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <title>Admin Details</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</head>

<body class="g-sidenav-show bg-gray-100">
    @include('admin.parts.sidebar-admin')

    <main class="main-content position-relative border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-12" style="max-width:800px;margin:auto;">
                    
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-0">Admin Details</h4>
                                    <p class="text-muted mb-0">Full information for {{ $admin->name }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('admin.accounts.admins.list') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to List
                                    </a>
                                    <a href="{{ route('admin.accounts.admins.edit', $admin->id) }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Full Name:</strong><br> {{ $admin->name }}</p>
                                    <p><strong>Mobile Number:</strong><br> {{ $admin->mobile }}</p>
                                    <p><strong>Email:</strong><br> {{ $admin->email ?? 'Not provided' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Admin ID:</strong><br> {{ $admin->login_id }}</p>
                                    <p><strong>Status:</strong><br> 
                                        @if($admin->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </p>
                                    <p><strong>Registered On:</strong><br> {{ $admin->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                            <hr>
                            <p><strong>Address:</strong><br> {{ $admin->address ?? 'Not provided' }}</p>
                            <hr>
                            <p><strong>Notes:</strong><br> {{ $admin->notes ?? 'No notes' }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $admin->id }}">
                                <i class="fas fa-trash"></i> Delete Admin
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this admin? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" action="{{ route('admin.accounts.admins.destroy', $admin->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>
</html> 