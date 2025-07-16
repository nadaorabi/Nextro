@extends('layouts.admin')
@section('content')
<div class="container-fluid py-4">

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

    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table th {
        background: #f8f9fa;
        color: #495057;
        font-weight: 600;
        border: none;
        padding: 1rem;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-color: #f1f3f4;
    }

    .btn-group-actions {
        gap: 0.5rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    /* Delete Confirmation Modal Styles */
    .delete-modal .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .delete-modal .modal-header {
        background: linear-gradient(45deg, #dc3545, #c82333);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
        padding: 1.5rem;
    }

    .delete-modal .modal-header .btn-close {
        filter: invert(1);
        opacity: 0.8;
    }

    .delete-modal .modal-body {
        padding: 2rem;
        text-align: center;
    }

    .delete-modal .modal-footer {
        border: none;
        padding: 1.5rem 2rem 2rem;
        gap: 1rem;
    }

    .delete-icon {
        font-size: 4rem;
        color: #dc3545;
        margin-bottom: 1rem;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    .btn-danger {
        background: linear-gradient(45deg, #dc3545, #c82333);
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background: linear-gradient(45deg, #c82333, #bd2130);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
    }

    .btn-outline-secondary {
        border: 2px solid #6c757d;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #6c757d;
        background: transparent;
    }

    .btn-outline-secondary:hover {
        background: #6c757d;
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 600px) {
        .card-body {
            padding: 1rem;
        }
    }
</style>

    <!-- Header Card -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">Classroom Management</h4>
                    <p class="text-muted mb-0">Manage and organize educational classrooms and facilities</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Classroom Form -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-4"><i class="fas fa-plus-circle me-2 text-primary"></i>Add New Classroom</h5>
            <form method="POST" action="{{ route('admin.facilities.rooms.store') }}" class="row g-3">
                @csrf
                <div class="col-md-3">
                    <label for="room_number" class="form-label">Classroom Number <span class="text-danger">*</span></label>
                    <input type="number" name="room_number" id="room_number" class="form-control" required min="1" step="1" placeholder="e.g., 101">
                </div>
                <div class="col-md-3">
                    <label for="capacity" class="form-label">Student Capacity</label>
                    <input type="number" name="capacity" id="capacity" class="form-control" min="1" placeholder="e.g., 30">
                </div>
                <div class="col-md-3">
                    <label for="location" class="form-label">Building/Floor</label>
                    <input type="text" name="location" id="location" class="form-control" placeholder="e.g., Building A - Floor 2">
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-plus me-2"></i>Add Classroom
                    </button>
                </div>
            </form>

            @if(session('success'))
                <div class="alert alert-success mt-3 border-0">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger mt-3 border-0">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Please check the following errors:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    <!-- Classrooms List -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="mb-0"><i class="fas fa-list me-2 text-primary"></i>All Classrooms</h5>
                <span class="badge bg-primary">{{ $rooms->count() }} classrooms</span>
            </div>
            @if($rooms->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Classroom Number</th>
                                <th>Student Capacity</th>
                                <th>Building/Floor</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                                <tr>
                                    <td><span class="badge bg-light text-dark">#{{ $room->id }}</span></td>
                                    <td>
                                        <strong>Room {{ $room->room_number }}</strong>
                                    </td>
                                    <td>
                                        @if($room->capacity)
                                            <span class="badge bg-info">{{ $room->capacity }} students</span>
                                        @else
                                            <span class="text-muted">Not specified</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($room->location)
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ $room->location }}
                                        @else
                                            <span class="text-muted">Not specified</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex btn-group-actions">
                                            <a href="{{ route('admin.facilities.rooms.edit', $room->id) }}" 
                                               class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <button type="button" class="btn btn-outline-danger btn-sm" 
                                                    onclick="showDeleteConfirmation({{ $room->id }}, '{{ $room->room_number }}')">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-door-open"></i>
                    <h5>No Classrooms Found</h5>
                    <p>Start by adding your first classroom using the form above.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade delete-modal" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="delete-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h4 class="mb-3">Are you sure you want to delete this classroom?</h4>
                <p class="text-muted mb-0">
                    You are about to delete <strong id="roomNumberToDelete"></strong>. 
                    This action cannot be undone and will permanently remove the classroom from the system.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Delete Classroom
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function showDeleteConfirmation(roomId, roomNumber) {
    // Update modal content
    document.getElementById('roomNumberToDelete').textContent = 'Room ' + roomNumber;
    
    // Update form action
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.action = '{{ route("admin.facilities.rooms.destroy", ":id") }}'.replace(':id', roomId);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
    modal.show();
}

// Auto-hide success alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endsection 