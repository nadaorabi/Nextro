@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h2 class="mb-4">إدارة القاعات</h2>
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.facilities.rooms.store') }}" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label for="room_number" class="form-label">رقم القاعة <span class="text-danger">*</span></label>
                    <input type="number" name="room_number" id="room_number" class="form-control" required min="1" step="1">
                </div>
                <div class="col-md-2">
                    <label for="capacity" class="form-label">السعة</label>
                    <input type="number" name="capacity" id="capacity" class="form-control" min="1">
                </div>
                <div class="col-md-3">
                    <label for="location" class="form-label">الموقع</label>
                    <input type="text" name="location" id="location" class="form-control">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success w-100">إضافة قاعة</button>
                </div>
            </form>
            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
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
    <div class="card">
        <div class="card-body">
            <h5>جميع القاعات</h5>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم القاعة</th>
                        <th>السعة</th>
                        <th>الموقع</th>
                        <th>إجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                            <td>{{ $room->id }}</td>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->capacity }}</td>
                            <td>{{ $room->location }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.facilities.rooms.destroy', $room->id) }}" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من حذف القاعة؟')">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">لا توجد قاعات بعد.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 