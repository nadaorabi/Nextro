@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">تعديل بيانات القاعة</h2>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.facilities.rooms.update', $room->id) }}" class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-md-4">
                    <label for="room_number" class="form-label">رقم القاعة <span class="text-danger">*</span></label>
                    <input type="number" name="room_number" id="room_number" class="form-control" required min="1" step="1" value="{{ old('room_number', $room->room_number) }}">
                </div>
                <div class="col-md-2">
                    <label for="capacity" class="form-label">السعة</label>
                    <input type="number" name="capacity" id="capacity" class="form-control" min="1" value="{{ old('capacity', $room->capacity) }}">
                </div>
                <div class="col-md-3">
                    <label for="location" class="form-label">الموقع</label>
                    <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $room->location) }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">حفظ التعديلات</button>
                </div>
                <div class="col-md-1 d-flex align-items-end">
                    <a href="{{ route('admin.facilities.rooms.index') }}" class="btn btn-secondary w-100">رجوع</a>
                </div>
            </form>
            @if($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection 