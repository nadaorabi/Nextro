@extends('layouts.admin')

@section('title', 'Category Details')

@push('styles')
    <style>
        .custom-icon-style { transform: translateY(-4px); display: inline-block; }
        .welcome-animated {
            font-size: 2.5rem; font-weight: bold; color: #007bff;
            animation: bounce 1.5s infinite alternate, gradientMove 3s linear infinite;
            letter-spacing: 2px; margin-top: 20px;
            background: linear-gradient(90deg, #007bff, #00c6ff, #007bff);
            background-size: 200% 200%;
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }
        @keyframes bounce { 0% { transform: translateY(0); } 100% { transform: translateY(-20px); } }
        @keyframes gradientMove { 0% { background-position: 0% 50%; } 100% { background-position: 100% 50%; } }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">

        {{-- معلومات الفئة --}}
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header pb-0">
                        <h4 class="text-primary">Category: {{ $category->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/theme/category-default.png') }}"
                                    class="avatar-lg" alt="Category Image">
                            </div>
                            <div class="col-md-8">
                                <p><strong>ID:</strong> CAT-{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</p>
                                <p><strong>Status:</strong>
                                    <span class="badge {{ $category->status === 'active' ? 'bg-success' : 'bg-warning' }}">
                                        {{ ucfirst($category->status) }}
                                    </span>
                                </p>
                                <p><strong>Description:</strong>
                                    {{ $category->description ?? 'No description available' }}</p>
                                <p><strong>Created At:</strong> {{ $category->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Courses & Packages --}}
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Courses</h5>
                    </div>
                    <div class="card-body">
                        @if ($category->courses->count())
                            <ul class="list-group">
                                @foreach ($category->courses as $course)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $course->title }}
                                        <span class="text-muted">Level: {{ $course->level ?? 'N/A' }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No courses assigned to this category.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h5 class="mb-0">Packages</h5>
                    </div>
                    <div class="card-body">
                        @if ($category->packages->count())
                            <ul class="list-group">
                                @foreach ($category->packages as $package)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $package->name }}
                                        <span class="text-muted">Price: {{ $package->price ?? '-' }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No packages assigned to this category.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    {{-- إذا كان هناك أي سكريبت إضافي --}}
@endpush
