<!DOCTYPE html>
<html lang="en" dir="LTR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>Financial Management</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
    <style>
        .custom-icon-style {
            display: inline-block;
            transform: translateY(-4px);
        }



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
        }

        .transaction-row {
            transition: all 0.3s ease;
        }
        .transaction-row:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }

        .amount-positive { color: #28a745; font-weight: 700; }
        .amount-negative { color: #dc3545; font-weight: 700; }

        .badge-student-fee { background: linear-gradient(45deg, #4facfe, #00f2fe); }
        .badge-instructor-share { background: linear-gradient(45deg, #43e97b, #38f9d7); }
        .badge-instructor-payment { background: linear-gradient(45deg, #fa709a, #fee140); }
        .badge-discount { background: linear-gradient(45deg, #a8edea, #fed6e3); color: #333; }
        .badge-refund { background: linear-gradient(45deg, #ff9a9e, #fecfef); color: #333; }
        .badge-package-fee { background: linear-gradient(45deg, #ffecd2, #fcb69f); color: #333; }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    @include('admin.parts.sidebar-admin')

    <main class="main-content position-relative border-radius-lg overflow-hidden">

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <!-- Success Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Welcome Card -->
                    <div class="card mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1 class="text-gradient text-primary">Financial Management</h1>
                                    <p class="mb-0">Monitor and manage all financial transactions in the educational system</p>
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
                            <div class="card stat-card primary">
                                <div class="stat-icon primary">
                                    <i class="fas fa-arrow-up"></i>
                                </div>
                                <div class="stat-title">Total Revenue</div>
                                <div class="stat-value">${{ number_format($totalRevenue, 2) }}</div>
                                <div class="stat-description">
                                    <span class="highlight success">{{ number_format(($totalRevenue > 0 ? ($totalRevenue / max($totalRevenue, 1)) * 100 : 0), 1) }}%</span> of total transactions
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card stat-card warning">
                                <div class="stat-icon warning">
                                    <i class="fas fa-arrow-down"></i>
                                </div>
                                <div class="stat-title">Total Expenses</div>
                                <div class="stat-value">${{ number_format(abs($totalExpenses), 2) }}</div>
                                <div class="stat-description">
                                    <span class="highlight warning">{{ number_format(($totalExpenses < 0 ? (abs($totalExpenses) / max(abs($totalExpenses), 1)) * 100 : 0), 1) }}%</span> of total transactions
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                            <div class="card stat-card info">
                                <div class="stat-icon info">
                                    <i class="fas fa-balance-scale"></i>
                                </div>
                                <div class="stat-title">Current Balance</div>
                                <div class="stat-value">${{ number_format($currentBalance, 2) }}</div>
                                <div class="stat-description">
                                    <span class="highlight {{ $currentBalance >= 0 ? 'success' : 'warning' }}">{{ $currentBalance >= 0 ? 'Positive' : 'Negative' }}</span> balance
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6">
                            <div class="card stat-card success">
                                <div class="stat-icon success">
                                    <i class="fas fa-list"></i>
                                </div>
                                <div class="stat-title">Total Transactions</div>
                                <div class="stat-value">{{ number_format($payments->total()) }}</div>
                                <div class="stat-description">
                                    <span class="highlight">{{ $payments->count() }}</span> on this page
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="card mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Transaction Type</label>
                                        <select id="type-filter" class="form-select">
                                            <option value="">All Types</option>
                                            <option>Student Fee</option>
                                            <option>Package Fee</option>
                                            <option>Instructor Share</option>
                                            <option>Instructor Payment</option>
                                            <option>Discount</option>
                                            <option>Refund</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Account Type</label>
                                        <select id="role-filter" class="form-select">
                                            <option value="">All Users</option>
                                            <option>Student</option>
                                            <option>Teacher</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Amount Range</label>
                                        <select id="amount-filter" class="form-select">
                                            <option value="">All Amounts</option>
                                            <option value="positive">Income (+)</option>
                                            <option value="negative">Expenses (-)</option>
                                            <option value="high">High Amount (>$500)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">Search Transactions</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                                            <input id="search-input" type="text" class="form-control"
                                                placeholder="Search by user, notes, or amount...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Transactions Table -->
                    <div class="card">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="transactions-table" class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th>Transaction Information</th>
                                            <th>User</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($payments as $payment)
                                            <tr class="transaction-row">
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <div class="icon icon-shape icon-sm shadow border-radius-md bg-gradient-{{ $payment->amount > 0 ? 'success' : 'danger' }} text-center me-2 d-flex align-items-center justify-content-center">
                                                                <i class="fas fa-{{ $payment->amount > 0 ? 'arrow-up' : 'arrow-down' }} text-white opacity-10"></i>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">Transaction #{{ $payment->id }}</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('H:i') : '-' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $payment->user->name ?? 'Not specified' }}</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $payment->user->email ?? 'No email' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @switch($payment->type)
                                                        @case('student_fee')
                                                            <span class="badge badge-sm badge-student-fee">
                                                                <i class="fas fa-graduation-cap me-1"></i>Student Fee
                                                            </span>
                                                            @break
                                                        @case('package_fee')
                                                            <span class="badge badge-sm badge-package-fee">
                                                                <i class="fas fa-box me-1"></i>Package Fee
                                                            </span>
                                                            @break
                                                        @case('instructor_share')
                                                            <span class="badge badge-sm badge-instructor-share">
                                                                <i class="fas fa-share-alt me-1"></i>Instructor Share
                                                            </span>
                                                            @break
                                                        @case('instructor_payment')
                                                            <span class="badge badge-sm badge-instructor-payment">
                                                                <i class="fas fa-money-bill-wave me-1"></i>Instructor Payment
                                                            </span>
                                                            @break
                                                        @case('discount')
                                                            <span class="badge badge-sm badge-discount">
                                                                <i class="fas fa-percentage me-1"></i>Discount
                                                            </span>
                                                            @break
                                                        @case('refund')
                                                            <span class="badge badge-sm badge-refund">
                                                                <i class="fas fa-undo me-1"></i>Refund
                                                            </span>
                                                            @break
                                                        @default
                                                            <span class="badge badge-sm bg-gradient-secondary">{{ $payment->type }}</span>
                                                    @endswitch
                                                </td>
                                                <td>
                                                    <span class="text-sm font-weight-bold {{ $payment->amount > 0 ? 'amount-positive' : 'amount-negative' }}">
                                                        {{ $payment->amount > 0 ? '+' : '' }}${{ number_format($payment->amount, 2) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') : '-' }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 text-dark">
                                                        {{ Str::limit($payment->notes ?? 'No notes', 30) }}
                                                    </p>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-5">
                                                    <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                                    <br>
                                                    <h6 class="text-muted">No financial transactions found</h6>
                                                    <p class="text-muted">No financial transactions match the search criteria</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-between align-items-center p-3">
                                <p class="text-sm mb-0">Showing {{ $payments->firstItem() ?? 0 }} -
                                    {{ $payments->lastItem() ?? 0 }} of {{ $payments->total() }} total transactions</p>
                                {{ $payments->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Add Transaction Modal -->
    <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTransactionModalLabel">Add New Financial Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.transactions.store') }}" method="POST" id="transactionForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Transaction Type</label>
                                    <select name="type" class="form-select" id="transactionType" required>
                                        <option value="">Choose transaction type</option>
                                        <option value="student_fee">Student Fee</option>
                                        <option value="package_fee">Package Fee</option>
                                        <option value="instructor_payment">Instructor Payment</option>
                                        <option value="discount">Discount</option>
                                        <option value="refund">Refund</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">User</label>
                                    <select name="user_id" class="form-select" id="userSelect" required>
                                        <option value="">Choose user</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" data-role="{{ $user->role }}">
                                                {{ $user->name }} ({{ $user->role == 'student' ? 'Student' : 'Teacher' }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="amount" class="form-control" step="0.01" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Transaction Date</label>
                                    <input type="date" name="payment_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea name="notes" class="form-control" rows="3" 
                                      placeholder="Enter transaction details, such as course name, package name, or reason for discount/refund..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Transaction</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search-input');
            const typeFilter = document.getElementById('type-filter');
            const roleFilter = document.getElementById('role-filter');
            const amountFilter = document.getElementById('amount-filter');
            const transactionsTable = document.getElementById('transactions-table');
            const tableRows = transactionsTable.querySelectorAll('tbody tr');

            function filterTransactions() {
                const searchText = searchInput.value.toLowerCase();
                const typeValue = typeFilter.value;
                const roleValue = roleFilter.value;
                const amountValue = amountFilter.value;

                tableRows.forEach(row => {
                    if (row.cells.length < 6) return; // Skip empty rows

                    const transactionId = row.cells[0].textContent.toLowerCase();
                    const userName = row.cells[1].textContent.toLowerCase();
                    const transactionType = row.cells[2].textContent.trim();
                    const amount = row.cells[3].textContent.trim();
                    const notes = row.cells[5].textContent.toLowerCase();

                    const searchMatch = transactionId.includes(searchText) || userName.includes(searchText) || notes.includes(searchText);
                    const typeMatch = typeValue === '' || transactionType.includes(typeValue);
                    const roleMatch = roleValue === '' || userName.includes(roleValue.toLowerCase());

                    let amountMatch = true;
                    if (amountValue) {
                        const numericAmount = parseFloat(amount.replace(/[$,+\-]/g, ''));
                        if (amountValue === 'positive') {
                            amountMatch = amount.includes('+');
                        } else if (amountValue === 'negative') {
                            amountMatch = amount.includes('-') || amount.startsWith('$-');
                        } else if (amountValue === 'high') {
                            amountMatch = Math.abs(numericAmount) > 500;
                        }
                    }

                    if (searchMatch && typeMatch && roleMatch && amountMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('keyup', filterTransactions);
            typeFilter.addEventListener('change', filterTransactions);
            roleFilter.addEventListener('change', filterTransactions);
            amountFilter.addEventListener('change', filterTransactions);
        });
        
        // Dynamic form behavior
        document.getElementById('transactionType').addEventListener('change', function() {
            const type = this.value;
            const userSelect = document.getElementById('userSelect');
            const options = userSelect.querySelectorAll('option');
            
            // Reset user selection
            userSelect.value = '';
            
            // Filter users based on transaction type
            options.forEach(option => {
                if (option.value === '') return; // Skip placeholder
                
                const userRole = option.dataset.role;
                let showOption = true;
                
                switch(type) {
                    case 'student_fee':
                    case 'package_fee':
                    case 'discount':
                    case 'refund':
                        showOption = userRole === 'student';
                        break;
                    case 'instructor_payment':
                        showOption = userRole === 'teacher';
                        break;
                    default:
                        showOption = true;
                }
                
                option.style.display = showOption ? '' : 'none';
            });
        });
        

    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html> 