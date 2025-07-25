@extends('layouts.admin')

@section('title', 'Student Financial Account')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12" style="max-width:1200px;margin:auto;">
      
      <!-- Header Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0"><i class="fas fa-user-graduate me-2"></i>Student Financial Account</h4>
              <p class="text-muted mb-0">Manage financial transactions for: {{ $student->name }}</p>
            </div>
            <div class="d-flex gap-2">
              <a href="{{ route('admin.accounts.students.list') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Students List
              </a>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                <i class="fas fa-plus"></i> Add Transaction
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Student Info Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-header">
          <h5 class="mb-0">Student Information</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <h6 class="text-primary mb-3">{{ $student->name }}</h6>
              <div class="row">
                <div class="col-md-4 mb-2">
                  <small class="text-muted">National ID:</small><br>
                  <span>{{ $student->national_id ?? 'Not set' }}</span>
                </div>
                <div class="col-md-4 mb-2">
                  <small class="text-muted">Mobile:</small><br>
                  <span>{{ $student->mobile ?? 'Not set' }}</span>
                </div>
                <div class="col-md-4 mb-2">
                  <small class="text-muted">Email:</small><br>
                  <span>{{ $student->email ?? 'Not set' }}</span>
                </div>
              </div>
            </div>
            <div class="col-md-4 text-end">
              <small class="text-muted">Outstanding Balance:</small><br>
              <h4 class="{{ $outstanding > 0 ? 'text-danger' : 'text-success' }}">
                {{ number_format(abs($outstanding), 2) }} USD
              </h4>
              <small class="badge {{ $outstanding > 0 ? 'bg-danger' : 'bg-success' }}">
                {{ $outstanding > 0 ? 'Outstanding' : 'Paid in Full' }}
              </small>
            </div>
          </div>
        </div>
      </div>

      <!-- Financial Statistics -->
      <div class="row mb-4">
        <div class="col-md-3 mb-3">
          <div class="card text-center">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center mb-2">
                <div class="icon icon-shape bg-gradient-primary shadow text-center rounded-circle me-3">
                  <i class="fas fa-file-invoice-dollar text-white"></i>
                </div>
                <div>
                  <h6 class="text-sm mb-0 text-uppercase font-weight-bold">Total Fees Due</h6>
                  <h5 class="font-weight-bolder text-primary">{{ number_format($totalDue, 2) }} USD</h5>
                </div>
              </div>
              <p class="text-muted text-sm mb-0">
                <span class="font-weight-bolder">Total charges</span>
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="card text-center">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center mb-2">
                <div class="icon icon-shape bg-gradient-success shadow text-center rounded-circle me-3">
                  <i class="fas fa-arrow-up text-white"></i>
                </div>
                <div>
                  <h6 class="text-sm mb-0 text-uppercase font-weight-bold">Total Paid</h6>
                  <h5 class="font-weight-bolder text-success">{{ number_format($totalPaid, 2) }} USD</h5>
                </div>
              </div>
              <p class="text-success text-sm mb-0">
                <span class="font-weight-bolder">Payments received</span>
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="card text-center">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center mb-2">
                <div class="icon icon-shape bg-gradient-info shadow text-center rounded-circle me-3">
                  <i class="fas fa-percent text-white"></i>
                </div>
                <div>
                  <h6 class="text-sm mb-0 text-uppercase font-weight-bold">Total Discounts</h6>
                  <h5 class="font-weight-bolder text-info">{{ number_format($totalDiscount, 2) }} USD</h5>
                </div>
              </div>
              <p class="text-info text-sm mb-0">
                <span class="font-weight-bolder">Discounts applied</span>
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-md-3 mb-3">
          <div class="card text-center">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center mb-2">
                <div class="icon icon-shape bg-gradient-{{ $outstanding > 0 ? 'warning' : 'success' }} shadow text-center rounded-circle me-3">
                  <i class="fas fa-balance-scale text-white"></i>
                </div>
                <div>
                  <h6 class="text-sm mb-0 text-uppercase font-weight-bold">Outstanding Balance</h6>
                  <h5 class="font-weight-bolder {{ $outstanding > 0 ? 'text-warning' : 'text-success' }}">{{ number_format($outstanding, 2) }} USD</h5>
                </div>
              </div>
              <p class="{{ $outstanding > 0 ? 'text-warning' : 'text-success' }} text-sm mb-0">
                <span class="font-weight-bolder">{{ $outstanding > 0 ? 'Due' : 'Paid in Full' }}</span>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Success Message -->
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

      <!-- Transactions Table -->
      <div class="card shadow-sm">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Transaction History</h5>
            <span class="text-muted">Total Results: {{ $allPayments->total() }}</span>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Transaction Type</th>
                  <th>Amount</th>
                  <th>Balance After</th>
                  <th>Notes</th>
                </tr>
              </thead>
              <tbody>
                @php $runningBalance = 0; @endphp
                @forelse($allPayments as $payment)
                  @php $runningBalance += $payment->amount; @endphp
                  <tr>
                    <td>
                      <div>
                        <div class="fw-bold">{{ date('Y-m-d', strtotime($payment->payment_date)) }}</div>
                        <div class="text-muted small">{{ date('H:i', strtotime($payment->payment_date)) }}</div>
                      </div>
                    </td>
                    <td>
                      @if($payment->type == 'student_fee')
                        <span class="badge bg-primary">Student Fee</span>
                      @elseif($payment->type == 'instructor_payment')
                        <span class="badge bg-warning text-dark">Instructor Payment</span>
                      @elseif($payment->type == 'refund')
                        <span class="badge bg-success">Refund</span>
                      @elseif($payment->type == 'discount')
                        <span class="badge bg-info">Discount</span>
                      @elseif($payment->type == 'payment')
                        <span class="badge bg-success">Payment</span>
                      @else
                        <span class="badge bg-secondary">{{ ucfirst($payment->type) }}</span>
                      @endif
                    </td>
                    <td>
                      <span class="fw-bold {{ $payment->amount > 0 ? 'text-success' : 'text-danger' }}">
                        {{ $payment->amount > 0 ? '+' : '' }}{{ number_format($payment->amount, 2) }} USD
                      </span>
                    </td>
                    <td>
                      <span class="fw-bold">{{ number_format($runningBalance, 2) }} USD</span>
                    </td>
                    <td>
                      <span class="text-muted">{{ $payment->notes ?? 'No notes' }}</span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center text-muted">No transactions found</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
          
          <!-- Pagination -->
          @if($allPayments->hasPages())
            <div class="d-flex justify-content-center mt-4">
              {{ $allPayments->links() }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="addTransactionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTransactionModalLabel">Add New Transaction</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('admin.students.account.transaction.store', $student->id) }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="type" class="form-label">Transaction Type</label>
            <select class="form-select" id="type" name="type" required>
              <option value="">Select transaction type</option>
              <option value="student_fee">Student Fee</option>
              <option value="payment">Payment</option>
              <option value="refund">Refund</option>
              <option value="discount">Discount</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <div class="input-group">
              <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
              <span class="input-group-text">USD</span>
            </div>
          </div>
          
          <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add Transaction</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection 