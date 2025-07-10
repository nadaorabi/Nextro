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
                    <h4 class="mb-0">Edit Classroom Information</h4>
                    <p class="text-muted mb-0">Update classroom details and specifications</p>
                </div>
                <div>
                    <a href="{{ route('admin.facilities.rooms.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Classrooms
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-4"><i class="fas fa-door-open me-2 text-primary"></i>Classroom #{{ $room->room_number }} Details</h5>
            <form method="POST" action="{{ route('admin.facilities.rooms.update', $room->id) }}" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-3">
                    <label for="room_number" class="form-label">Classroom Number <span class="text-danger">*</span></label>
                    <input type="number" name="room_number" id="room_number" class="form-control" 
                           required min="1" step="1" value="{{ old('room_number', $room->room_number) }}" 
                           placeholder="e.g., 101">
                </div>
                <div class="col-md-3">
                    <label for="capacity" class="form-label">Student Capacity</label>
                    <input type="number" name="capacity" id="capacity" class="form-control" 
                           min="1" value="{{ old('capacity', $room->capacity) }}" 
                           placeholder="e.g., 30">
                </div>
                <div class="col-md-4">
                    <label for="location" class="form-label">Building/Floor</label>
                    <input type="text" name="location" id="location" class="form-control" 
                           value="{{ old('location', $room->location) }}" 
                           placeholder="e.g., Building A - Floor 2">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </form>

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

    <!-- Current Information Display -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-4"><i class="fas fa-info-circle me-2 text-primary"></i>Current Information</h5>
            <div class="row">
                <div class="col-md-4">
                    <div class="border rounded p-3 text-center">
                        <i class="fas fa-door-open fa-2x text-primary mb-2"></i>
                        <h6>Classroom Number</h6>
                        <p class="mb-0"><strong>{{ $room->room_number }}</strong></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded p-3 text-center">
                        <i class="fas fa-users fa-2x text-info mb-2"></i>
                        <h6>Student Capacity</h6>
                        <p class="mb-0">
                            @if($room->capacity)
                                <strong>{{ $room->capacity }} students</strong>
                            @else
                                <span class="text-muted">Not specified</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="border rounded p-3 text-center">
                        <i class="fas fa-map-marker-alt fa-2x text-success mb-2"></i>
                        <h6>Building/Floor</h6>
                        <p class="mb-0">
                            @if($room->location)
                                <strong>{{ $room->location }}</strong>
                            @else
                                <span class="text-muted">Not specified</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection 