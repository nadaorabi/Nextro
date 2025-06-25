<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <title>Admin Accounts Management</title>
  
  <!-- Fonts and CSS -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}">
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  
  <style>
    .table-action-buttons .btn {
      margin-right: 5px;
    }
    .table-action-buttons {
      white-space: nowrap;
    }
    .action-icon-btn {
      border: none;
      border-radius: 12px;
      width: 38px;
      height: 38px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.15rem;
      color: #fff !important;
      box-shadow: 0 2px 8px rgba(44,62,80,0.10);
      transition: background 0.18s;
      padding: 0;
    }
    .action-icon-view { background: #17c1e8; }
    .action-icon-edit { background: #ff8c4b; }
    .action-icon-print { background: #5e72e4; }
    .action-icon-delete { background: #ea0606; }
    .action-icon-btn:hover, .action-icon-btn:focus { filter: brightness(0.93); }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')

  <main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
      
      <!-- Page Header -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
          <h4 class="mb-0">Admin Accounts Management</h4>
          <p class="text-muted mb-0">View, add, edit, and manage admin accounts</p>
        </div>
        <a href="{{ route('admin.accounts.admins.create') }}" class="btn btn-primary">
          <i class="fas fa-plus"></i>&nbsp; Add New Admin
        </a>
      </div>

      <!-- Statistics Cards -->
      <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Admins</p>
                  <h5 class="font-weight-bolder">{{ $totalAdmins }}</h5>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fas fa-users text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Active</p>
                  <h5 class="font-weight-bolder">{{ $activeAdmins }}</h5>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="fas fa-check-circle text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Inactive</p>
                  <h5 class="font-weight-bolder">{{ $blockedAdmins }}</h5>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="fas fa-times-circle text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Added This Month</p>
                  <h5 class="font-weight-bolder">{{ $adminsThisMonth }}</h5>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                    <i class="fas fa-calendar-plus text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Admins Table Card -->
      <div class="card">
        <div class="card-header pb-0">
          <h6>Admins List</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Admin</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created On</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($admins as $admin)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $admin->name }}</h6>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $admin->email }}</p>
                    <p class="text-xs text-secondary mb-0">{{ $admin->mobile }}</p>
                  </td>
                  <td class="align-middle text-center text-sm">
                    @if ($admin->is_active)
                    <span class="badge badge-sm bg-gradient-success">Active</span>
                    @else
                    <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
                    @endif
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $admin->login_id }}</span>
                  </td>
                  <td class="align-middle text-center">
                    <span class="text-secondary text-xs font-weight-bold">{{ $admin->created_at->format('d/m/Y') }}</span>
                  </td>
                  <td class="align-middle text-center table-action-buttons">
                    <a href="{{ route('admin.accounts.admins.show', $admin->id) }}" class="action-icon-btn action-icon-view me-1" title="View Details">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.accounts.admins.edit', $admin->id) }}" class="action-icon-btn action-icon-edit me-1" title="Edit Admin">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="{{ route('admin.accounts.admins.print-credentials', $admin->id) }}" target="_blank" class="action-icon-btn action-icon-print me-1" title="Print Credentials">
                        <i class="fas fa-print"></i>
                    </a>
                    <button type="button" class="action-icon-btn action-icon-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $admin->id }}" title="Delete Admin">
                        <i class="fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center py-4">
                    <p class="text-muted">No admins found.</p>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer py-4">
          {{ $admins->links() }}
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
          <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var adminId = button.data('id');
        var action = '{{ route("admin.accounts.admins.destroy", ":id") }}';
        action = action.replace(':id', adminId);
        var modal = $(this);
        modal.find('#deleteForm').attr('action', action);
    });
  </script>
</body>

</html> 