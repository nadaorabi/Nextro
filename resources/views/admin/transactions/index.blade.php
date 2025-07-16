@extends('layouts.admin')

@section('title', 'Financial Transactions Management')

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
        .stat-card .stat-description .danger { color: #f5365c; }

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
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')

    <!-- Welcome Card -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="text-gradient text-primary">Financial Transactions Management</h1>
                    <p class="mb-0">Monitor, manage, and track all financial transactions for students and instructors</p>
                </div>
                <div class="col-lg-6 text-end">
                    <button class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Transaction
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-arrow-up"></i>
                </div>
                <div class="stat-title">Total Revenue</div>
                <div class="stat-value" id="total-revenue">${{ number_format($totalRevenue ?? 0, 2) }}</div>
                <div class="stat-description">
                    <span class="highlight success" id="credit-count">{{ $payments->where('amount', '>', 0)->count() }}</span> credit transactions
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <div class="stat-title">Total Expenses</div>
                <div class="stat-value" id="total-expenses">${{ number_format(abs($totalExpenses ?? 0), 2) }}</div>
                <div class="stat-description">
                    <span class="highlight warning" id="debit-count">{{ $payments->where('amount', '<', 0)->count() }}</span> debit transactions
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card primary">
                <div class="stat-icon primary">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <div class="stat-title">Net Balance</div>
                <div class="stat-value" id="net-balance">${{ number_format($currentBalance ?? 0, 2) }}</div>
                <div class="stat-description">
                    <span class="highlight {{ ($currentBalance ?? 0) >= 0 ? 'success' : 'danger' }}" id="balance-indicator">
                        {{ ($currentBalance ?? 0) >= 0 ? '+' : '' }}{{ number_format(($currentBalance ?? 0), 2) }}
                    </span> current balance
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card stat-card info">
                <div class="stat-icon info">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="stat-title">Total Transactions</div>
                <div class="stat-value" id="visible-count">{{ $payments->count() }}</div>
                <div class="stat-description">
                    <span class="highlight info">{{ $payments->count() }}</span> on this page
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="text-primary fw-bold mb-0">
                    <i class="fas fa-filter me-2"></i>Filter Transactions
                </h6>
                <div class="d-flex align-items-center gap-2">
                    <small class="text-muted" id="active-filters-count">
                        <i class="fas fa-info-circle me-1"></i>
                        No active filters
                    </small>
                </div>
            </div>
            <form id="filterForm" method="get">
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Search Transactions</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fas fa-search text-muted"></i></span>
                            <input id="search-input" name="search" type="text" class="form-control" placeholder="Search by name or notes..." value="{{ request('search') }}">
                            <span class="input-group-text bg-light d-none" id="search-loading">
                                <i class="fas fa-spinner fa-spin text-primary"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">Account Type</label>
                        <select name="role" class="form-select" id="role-filter">
                            <option value="">All Types</option>
                            <option value="student" @if(request('role')=='student') selected @endif>Student</option>
                            <option value="teacher" @if(request('role')=='teacher') selected @endif>Instructor</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">User</label>
                        <select name="user_id" class="form-select" id="user-filter">
                            <option value="">All Users</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" @if(request('user_id')==$u->id) selected @endif>{{ $u->name }} ({{ ucfirst($u->role) }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold">Transaction Type</label>
                        <select name="type" class="form-select" id="type-filter">
                            <option value="">All Types</option>
                            <option value="student_fee" @if(request('type')=='student_fee') selected @endif>Student Fee</option>
                            <option value="package_fee" @if(request('type')=='package_fee') selected @endif>Package Fee</option>
                            <option value="instructor_payment" @if(request('type')=='instructor_payment') selected @endif>Instructor Payment</option>
                            <option value="instructor_share" @if(request('type')=='instructor_share') selected @endif>Instructor Share</option>
                            <option value="discount" @if(request('type')=='discount') selected @endif>Discount</option>
                            <option value="refund" @if(request('type')=='refund') selected @endif>Refund</option>
                        </select>
                    </div>
                </div>
                
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">From Date</label>
                        <input type="date" name="from" class="form-control" id="from-date" value="{{ request('from') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold">To Date</label>
                        <input type="date" name="to" class="form-control" id="to-date" value="{{ request('to') }}">
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-outline-secondary px-4" id="clear-filters-btn">
                                <i class="fas fa-times me-2"></i>Clear Filters
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="card">
        <div class="card-header pb-0">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="text-primary fw-bold">Financial Transactions</h6>
                <div class="d-flex align-items-center gap-2">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Showing {{ $payments->count() }} of {{ $payments->total() }} transactions
                    </small>
                </div>
            </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Transaction Details</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Transaction ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                User Type</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Transaction Type</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Amount</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Transaction Date</th>
                            <th class="text-secondary opacity-7">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $payment)
                            <tr data-user-id="{{ $payment->user_id }}">
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <div class="avatar avatar-sm me-3 bg-gradient-{{ $payment->amount >= 0 ? 'success' : 'danger' }} d-flex align-items-center justify-content-center rounded-circle">
                                                <i class="fas fa-{{ $payment->amount >= 0 ? 'plus' : 'minus' }} text-white"></i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $payment->user->name ?? 'Unknown User' }}</h6>
                                            <p class="text-xs text-secondary mb-0">
                                                {{ Str::limit($payment->notes ?: 'No description available', 50) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">
                                        TXN-{{ str_pad($payment->id, 6, '0', STR_PAD_LEFT) }}</p>
                                </td>
                                <td>
                                    @if($payment->user)
                                        @if($payment->user->role === 'student')
                                            <span class="badge badge-sm bg-gradient-primary">Student</span>
                                        @elseif($payment->user->role === 'teacher')
                                            <span class="badge badge-sm bg-gradient-success">Instructor</span>
                                        @else
                                            <span class="badge badge-sm bg-gradient-info">{{ ucfirst($payment->user->role) }}</span>
                                        @endif
                                    @else
                                        <span class="badge badge-sm bg-gradient-secondary">Unknown</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $typeMap = [
                                            'student_fee' => ['label' => 'Student Fee', 'color' => 'info'],
                                            'package_fee' => ['label' => 'Package Fee', 'color' => 'info'],
                                            'instructor_payment' => ['label' => 'Instructor Payment', 'color' => 'success'],
                                            'instructor_share' => ['label' => 'Instructor Share', 'color' => 'primary'],
                                            'discount' => ['label' => 'Discount', 'color' => 'warning'],
                                            'refund' => ['label' => 'Refund', 'color' => 'danger'],
                                            'salary' => ['label' => 'Salary', 'color' => 'dark'],
                                            'bonus' => ['label' => 'Bonus', 'color' => 'success'],
                                            'deduction' => ['label' => 'Deduction', 'color' => 'danger']
                                        ];
                                        $type = $typeMap[$payment->type] ?? ['label' => ucfirst(str_replace('_', ' ', $payment->type)), 'color' => 'secondary'];
                                    @endphp
                                    <span class="badge badge-sm bg-gradient-{{ $type['color'] }}">{{ $type['label'] }}</span>
                                </td>
                                <td>
                                    <p class="text-sm font-weight-bold mb-0 {{ $payment->amount >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $payment->amount >= 0 ? '+' : '' }}${{ number_format($payment->amount, 2) }}
                                    </p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') : '-' }}
                                    </p>
                                    <p class="text-xs text-secondary mb-0">
                                        {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('H:i A') : '-' }}
                                    </p>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center gap-2">
                                        @if(in_array($payment->type, ['instructor_payment', 'discount', 'refund', 'salary', 'bonus', 'deduction']))
                                            <button class="btn btn-link text-info p-2" data-bs-toggle="modal"
                                                data-bs-target="#editTransactionModal-{{ $payment->id }}"
                                                title="Edit Transaction">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif

                                        @if($payment->amount > 0)
                                            <button class="btn btn-link text-success p-2"
                                                onclick="generateReceipt({{ $payment->id }})"
                                                title="Generate Receipt">
                                                <i class="fas fa-receipt"></i>
                                            </button>
                                        @endif

                                        @if(in_array($payment->type, ['instructor_payment', 'discount', 'refund', 'salary', 'bonus', 'deduction']))
                                            <button class="btn btn-link text-danger p-2" data-bs-toggle="modal"
                                                data-bs-target="#deleteTransactionModal"
                                                onclick="confirmTransactionDelete({{ $payment->id }}, '{{ $payment->user->name ?? 'Unknown' }}', '{{ $type['label'] }}')"
                                                title="Delete Transaction">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-search fa-2x mb-3 text-muted"></i>
                                    <p class="mb-0">No transactions found matching your filters.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($payments->hasPages())
            <div class="d-flex justify-content-between align-items-center p-3">
                <p class="text-sm mb-0">Showing
                    {{ $payments->firstItem() }}-{{ $payments->lastItem() }} of
                    {{ $payments->total() }} transactions
                </p>
                {{ $payments->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>

    <!-- Add Transaction Modal -->
    <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('admin.transactions.store') }}" method="POST" class="modal-content border-0 shadow-lg">
                @csrf
                <div class="modal-header bg-white text-dark border-bottom">
                    <h5 class="modal-title fw-bold" id="addTransactionModalLabel">
                        <i class="fas fa-plus me-2 text-primary"></i>Add New Transaction
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-white">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold text-primary">
                                    <i class="fas fa-user me-2"></i>User
                                </label>
                                <select name="user_id" class="form-select form-select-lg border-2 border-light @error('user_id') is-invalid @enderror" required>
                                    <option value="">Select User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" data-role="{{ $user->role }}">
                                            {{ $user->name }} ({{ ucfirst($user->role) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold text-primary">
                                    <i class="fas fa-tags me-2"></i>Transaction Type
                                </label>
                                <select name="type" class="form-select form-select-lg border-2 border-light @error('type') is-invalid @enderror" required>
                                    <option value="">Select Type</option>
                                    <option value="student_fee">Student Fee</option>
                                    <option value="package_fee">Package Fee</option>
                                    <option value="instructor_payment">Instructor Payment</option>
                                    <option value="discount">Discount</option>
                                    <option value="refund">Refund</option>
                                    <option value="salary">Salary</option>
                                    <option value="bonus">Bonus</option>
                                    <option value="deduction">Deduction</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold text-primary">
                                    <i class="fas fa-dollar-sign me-2"></i>Amount
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text">$</span>
                                    <input type="number" name="amount" step="0.01" class="form-control border-2 border-light @error('amount') is-invalid @enderror" placeholder="0.00" required>
                                </div>
                                @error('amount')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-bold text-primary">
                                    <i class="fas fa-calendar me-2"></i>Transaction Date
                                </label>
                                <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" class="form-control form-control-lg border-2 border-light @error('payment_date') is-invalid @enderror" required>
                                @error('payment_date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-primary">
                            <i class="fas fa-sticky-note me-2"></i>Notes
                        </label>
                        <textarea name="notes" class="form-control border-2 border-light @error('notes') is-invalid @enderror" rows="4" placeholder="Enter transaction details, course name, package name, or reason for discount/refund..."></textarea>
                        @error('notes')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer bg-white border-top">
                    <button type="button" class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save me-2"></i>Add Transaction
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteTransactionModal" tabindex="-1" aria-labelledby="deleteTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form method="POST" id="deleteTransactionForm">
                @csrf
                @method('DELETE')
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-white text-dark border-bottom">
                        <h5 class="modal-title fw-bold" id="deleteTransactionModalLabel">
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
                            <p class="text-muted mb-2">You are about to delete this transaction:</p>
                            <div class="alert alert-warning border-0 bg-light-warning">
                                <strong class="text-warning" id="transactionDetailsPlaceholder"></strong>
                            </div>
                            <div class="alert alert-danger border-0 bg-light-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <strong>This action cannot be undone!</strong>
                                <br>
                                <small>The transaction will be permanently removed from the system.</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-white border-top justify-content-center">
                        <button type="button" class="btn btn-secondary btn-lg px-4 me-3" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-danger btn-lg px-4">
                            <i class="fas fa-trash-alt me-2"></i>Delete Transaction
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach ($payments as $payment)
        @if(in_array($payment->type, ['instructor_payment', 'discount', 'refund', 'salary', 'bonus', 'deduction']))
        <!-- Edit Transaction Modal -->
        <div class="modal fade" id="editTransactionModal-{{ $payment->id }}" tabindex="-1"
            aria-labelledby="editTransactionModalLabel-{{ $payment->id }}" aria-hidden="true"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('admin.transactions.update', $payment->id) }}" method="POST"
                    class="modal-content border-0 shadow-lg">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-white text-dark border-bottom">
                        <h5 class="modal-title fw-bold" id="editTransactionModalLabel-{{ $payment->id }}">
                            <i class="fas fa-edit me-2 text-primary"></i>Edit Transaction
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 bg-white">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-primary">
                                        <i class="fas fa-dollar-sign me-2"></i>Amount
                                    </label>
                                    <div class="input-group input-group-lg">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="amount" step="0.01" value="{{ old('amount', $payment->amount) }}"
                                            class="form-control border-2 border-light @error('amount') is-invalid @enderror" required>
                                    </div>
                                    @error('amount')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-primary">
                                        <i class="fas fa-calendar me-2"></i>Transaction Date
                                    </label>
                                    <input type="date" name="payment_date" value="{{ old('payment_date', $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') : '') }}"
                                        class="form-control form-control-lg border-2 border-light @error('payment_date') is-invalid @enderror" required>
                                    @error('payment_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold text-primary">
                                <i class="fas fa-sticky-note me-2"></i>Notes
                            </label>
                            <textarea name="notes" class="form-control border-2 border-light @error('notes') is-invalid @enderror"
                                rows="4" placeholder="Enter transaction details...">{{ old('notes', $payment->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer bg-white border-top">
                        <button type="button" class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    @endforeach
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function confirmTransactionDelete(transactionId, userName, transactionType) {
            const form = document.getElementById('deleteTransactionForm');
            const detailsPlaceholder = document.getElementById('transactionDetailsPlaceholder');
            detailsPlaceholder.textContent = `"${transactionType}" transaction for "${userName}"`;
            form.action = `/admin/transactions/${transactionId}`;
        }

        function generateReceipt(transactionId) {
            // You can implement receipt generation here
            alert('Receipt generation feature will be implemented soon.');
        }

        document.addEventListener('DOMContentLoaded', function () {
            // تحسين نظام الفلترة بالكامل من خلال JavaScript
            const filterForm = document.getElementById('filterForm');
            const searchInput = document.getElementById('search-input');
            const roleFilter = document.getElementById('role-filter');
            const typeFilter = document.getElementById('type-filter');
            const userFilter = document.getElementById('user-filter');
            const fromDateFilter = document.getElementById('from-date');
            const toDateFilter = document.getElementById('to-date');
            const clearFiltersBtn = document.getElementById('clear-filters-btn');
            const searchLoading = document.getElementById('search-loading');
            const activeFiltersCount = document.getElementById('active-filters-count');
            
            // جميع عناصر الفلترة
            const filterElements = [searchInput, roleFilter, typeFilter, userFilter, fromDateFilter, toDateFilter];
            
            // دالة تطبيق الفلترة
            function applyFilters() {
                const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
                const selectedRole = roleFilter ? roleFilter.value : '';
                const selectedType = typeFilter ? typeFilter.value : '';
                const selectedUser = userFilter ? userFilter.value : '';
                const fromDate = fromDateFilter ? fromDateFilter.value : '';
                const toDate = toDateFilter ? toDateFilter.value : '';

                const tableRows = document.querySelectorAll('table tbody tr:not(.no-results-row)');
                let visibleCount = 0;

                tableRows.forEach(row => {
                    const nameCell = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                    const roleCell = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                    const typeCell = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                    const dateCell = row.querySelector('td:nth-child(6) p:first-child').textContent.trim();
                    
                    // فلترة بالبحث
                    const matchesSearch = !searchTerm || nameCell.includes(searchTerm);
                    
                    // فلترة بنوع الحساب
                    let matchesRole = true;
                    if (selectedRole) {
                        if (selectedRole === 'teacher') {
                            // البحث عن "Instructor" أو "teacher" في النص
                            matchesRole = roleCell.includes('instructor') || roleCell.includes('teacher');
                        } else if (selectedRole === 'student') {
                            // البحث عن "Student" في النص
                            matchesRole = roleCell.includes('student');
                        } else {
                            // للأنواع الأخرى، البحث المباشر
                            matchesRole = roleCell.includes(selectedRole.toLowerCase());
                        }
                    }
                    
                    // فلترة بنوع المعاملة
                    const matchesType = !selectedType || typeCell.includes(selectedType.replace('_', ' ').toLowerCase());
                    
                    // فلترة بالمستخدم
                    const matchesUser = !selectedUser || row.getAttribute('data-user-id') === selectedUser;

                    // فلترة بالتاريخ
                    let matchesDate = true;
                    if (fromDate || toDate) {
                        const rowDate = new Date(dateCell);
                        if (fromDate) {
                            const fromDateObj = new Date(fromDate);
                            matchesDate = matchesDate && rowDate >= fromDateObj;
                        }
                        if (toDate) {
                            const toDateObj = new Date(toDate);
                            matchesDate = matchesDate && rowDate <= toDateObj;
                        }
                    }

                    if (matchesSearch && matchesRole && matchesType && matchesUser && matchesDate) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // إظهار/إخفاء رسالة "لا توجد نتائج"
                const tbody = document.querySelector('table tbody');
                let noResultsRow = tbody.querySelector('.no-results-row');
                
                if (visibleCount === 0 && !noResultsRow) {
                    noResultsRow = document.createElement('tr');
                    noResultsRow.className = 'no-results-row';
                    noResultsRow.innerHTML = `
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-search fa-2x mb-3 text-muted"></i>
                            <p class="mb-0">No transactions found matching your filters.</p>
                        </td>
                    `;
                    tbody.appendChild(noResultsRow);
                } else if (visibleCount > 0 && noResultsRow) {
                    noResultsRow.remove();
                }

                // تحديث عداد النتائج
                updateResultsCounter(visibleCount);
                updateActiveFiltersCount(); // تحديث عداد الفلاتر النشطة
                updateStatistics(); // تحديث الإحصائيات بناءً على النتائج المفلترة
            }

            // دالة تحديث عداد النتائج
            function updateResultsCounter(visibleCount) {
                const totalCount = document.querySelectorAll('table tbody tr:not(.no-results-row)').length;
                const counterElement = document.querySelector('.card-header small');
                if (counterElement) {
                    counterElement.innerHTML = `
                        <i class="fas fa-info-circle me-1"></i>
                        Showing ${visibleCount} of ${totalCount} transactions
                    `;
                }
            }

            // دالة تحديث عداد الفلاتر النشطة
            function updateActiveFiltersCount() {
                let activeCount = 0;
                const filterValues = {
                    search: searchInput ? searchInput.value : '',
                    role: roleFilter ? roleFilter.value : '',
                    user: userFilter ? userFilter.value : '',
                    type: typeFilter ? typeFilter.value : '',
                    fromDate: fromDateFilter ? fromDateFilter.value : '',
                    toDate: toDateFilter ? toDateFilter.value : ''
                };

                Object.values(filterValues).forEach(value => {
                    if (value && value.trim() !== '') {
                        activeCount++;
                    }
                });

                if (activeCount > 0) {
                    activeFiltersCount.innerHTML = `
                        <i class="fas fa-filter me-1 text-primary"></i>
                        ${activeCount} active filter${activeCount > 1 ? 's' : ''}
                    `;
                    activeFiltersCount.className = 'text-primary fw-semibold';
                } else {
                    activeFiltersCount.innerHTML = `
                        <i class="fas fa-info-circle me-1"></i>
                        No active filters
                    `;
                    activeFiltersCount.className = 'text-muted';
                }
            }

            // دالة تحديث الإحصائيات بناءً على النتائج المفلترة
            function updateStatistics() {
                const visibleRows = document.querySelectorAll('table tbody tr:not(.no-results-row):not([style*="display: none"])');
                
                let totalRevenue = 0;
                let totalExpenses = 0;
                let creditCount = 0;
                let debitCount = 0;

                visibleRows.forEach(row => {
                    const amountText = row.querySelector('td:nth-child(5) p').textContent;
                    const amount = parseFloat(amountText.replace(/[$,]/g, ''));
                    
                    if (amount > 0) {
                        totalRevenue += amount;
                        creditCount++;
                    } else {
                        totalExpenses += Math.abs(amount);
                        debitCount++;
                    }
                });

                const netBalance = totalRevenue - totalExpenses;

                // تحديث الإحصائيات
                document.getElementById('total-revenue').textContent = `$${totalRevenue.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                document.getElementById('total-expenses').textContent = `$${totalExpenses.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                document.getElementById('net-balance').textContent = `$${netBalance.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                document.getElementById('credit-count').textContent = creditCount;
                document.getElementById('debit-count').textContent = debitCount;
                document.getElementById('visible-count').textContent = visibleRows.length;
                
                // تحديث مؤشر الرصيد
                const balanceIndicator = document.getElementById('balance-indicator');
                balanceIndicator.textContent = `${netBalance >= 0 ? '+' : ''}$${netBalance.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2})}`;
                balanceIndicator.className = `highlight ${netBalance >= 0 ? 'success' : 'danger'}`;
            }

            // إضافة مستمعي الأحداث لجميع عناصر الفلترة
            filterElements.forEach(element => {
                if (element) {
                    if (element === searchInput) {
                        // فلترة فورية للبحث مع تأخير
                        let searchTimeout;
                        element.addEventListener('input', function() {
                            clearTimeout(searchTimeout);
                            searchLoading.classList.remove('d-none');
                            searchLoading.classList.add('d-flex');
                            
                            searchTimeout = setTimeout(() => {
                                applyFilters();
                                searchLoading.classList.remove('d-flex');
                                searchLoading.classList.add('d-none');
                            }, 300);
                        });
                    } else {
                        // فلترة فورية للفلاتر الأخرى
                        element.addEventListener('change', function() {
                            // إضافة تأثير بصري
                            this.style.borderColor = '#667eea';
                            setTimeout(() => {
                                this.style.borderColor = '';
                            }, 1000);
                            
                            // إضافة مؤشر تحميل سريع
                            this.style.opacity = '0.7';
                            
                            setTimeout(() => {
                                applyFilters();
                                this.style.opacity = '1';
                            }, 100);
                        });
                    }
                }
            });

            // دالة تفريغ الفلاتر
            function clearAllFilters() {
                // إضافة تأثير بصري
                filterElements.forEach(element => {
                    if (element) {
                        element.style.borderColor = '#28a745';
                        element.style.backgroundColor = 'rgba(40, 167, 69, 0.1)';
                        setTimeout(() => {
                            element.style.borderColor = '';
                            element.style.backgroundColor = '';
                        }, 1000);
                        element.value = '';
                    }
                });
                
                // إظهار رسالة نجاح
                showNotification('Filters cleared successfully!', 'success');
                
                applyFilters();
            }

            // دالة إظهار الإشعارات
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
                notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                notification.innerHTML = `
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                
                document.body.appendChild(notification);
                
                // إزالة الإشعار تلقائياً بعد 3 ثوان
                setTimeout(() => {
                    if (notification.parentNode) {
                        notification.remove();
                    }
                }, 3000);
            }

            // إضافة مستمع الحدث لزر تفريغ الفلاتر
            if (clearFiltersBtn) {
                clearFiltersBtn.addEventListener('click', clearAllFilters);
            }

            // تطبيق الفلترة الأولية عند تحميل الصفحة
            applyFilters();

            // إضافة debugging للفلترة (يمكن إزالته لاحقاً)
            console.log('Filter system initialized');
            console.log('Available filter elements:', filterElements.length);
        });
    </script>
@endpush 