@extends('layouts.admin')
@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="mb-4 fw-bold text-primary text-center">
                        <i class="fas fa-edit me-2"></i>
                        تعديل الدفعة المالية للأستاذ: {{ $teacher->name }}
                    </h4>
                    <form action="{{ route('admin.teachers.account.transaction.update', [$teacher->id, $payment->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">المبلغ</label>
                            <input type="number" name="amount" class="form-control" step="0.01" required value="{{ old('amount', $payment->amount) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ملاحظات</label>
                            <textarea name="notes" class="form-control" rows="3">{{ old('notes', $payment->notes) }}</textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.teachers.account', $teacher->id) }}" class="btn btn-secondary">إلغاء</a>
                            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 