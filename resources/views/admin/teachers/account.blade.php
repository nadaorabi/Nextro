@extends('layouts.admin')

@section('title', 'Teacher Financial Account')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12" style="max-width:1200px;margin:auto;">
      
      <!-- Header Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h4 class="mb-0"><i class="fas fa-chalkboard-teacher me-2"></i>Teacher Financial Account</h4>
              <p class="text-muted mb-0">Manage financial transactions for: {{ $teacher->name }}</p>
        </div>
            <div class="d-flex gap-2">
              <a href="{{ route('admin.accounts.teachers.list') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Teachers List
            </a>
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                <i class="fas fa-plus"></i> Add Transaction
            </button>
            </div>
          </div>
        </div>
    </div>

      <!-- Teacher Info Card -->
      <div class="card shadow-sm mb-4">
        <div class="card-header">
          <h5 class="mb-0">Teacher Information</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <h6 class="text-primary mb-3">{{ $teacher->name }}</h6>
              <div class="row">
                <div class="col-md-4 mb-2">
                  <small class="text-muted">National ID:</small><br>
                  <span>{{ $teacher->national_id ?? 'Not set' }}</span>
                </div>
                <div class="col-md-4 mb-2">
                  <small class="text-muted">Mobile:</small><br>
                  <span>{{ $teacher->mobile ?? 'Not set' }}</span>
                </div>
                <div class="col-md-4 mb-2">
                  <small class="text-muted">Email:</small><br>
                  <span>{{ $teacher->email ?? 'Not set' }}</span>
                </div>
              </div>
            </div>
            <div class="col-md-4 text-end">
              <small class="text-muted">Current Balance:</small><br>
              <h4 class="{{ $netBalance >= 0 ? 'text-success' : 'text-danger' }}">
                {{ number_format($netBalance, 2) }} KWD
              </h4>
              <small class="badge {{ $netBalance >= 0 ? 'bg-success' : 'bg-danger' }}">
                {{ $netBalance >= 0 ? 'Positive Balance' : 'Negative Balance' }}
              </small>
            </div>
            </div>
        </div>
      </div>

      <!-- Financial Statistics -->
      <div class="row mb-4">
        <div class="col-md-4 mb-3">
          <div class="card text-center">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center mb-2">
                <div class="icon icon-shape bg-gradient-success shadow text-center rounded-circle me-3">
                  <i class="fas fa-coins text-white"></i>
                </div>
                <div>
                  <h6 class="text-sm mb-0 text-uppercase font-weight-bold">Total Earnings</h6>
                  <h5 class="font-weight-bolder text-success">{{ number_format($totalEarnings, 2) }} KWD</h5>
                </div>
              </div>
              <p class="text-success text-sm mb-0">
                <span class="font-weight-bolder">+{{ number_format($totalEarnings, 2) }}</span> this month
              </p>
            </div>
          </div>
        </div>
        
        <div class="col-md-4 mb-3">
          <div class="card text-center">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center mb-2">
                <div class="icon icon-shape bg-gradient-danger shadow text-center rounded-circle me-3">
                  <i class="fas fa-credit-card text-white"></i>
                </div>
                <div>
                  <h6 class="text-sm mb-0 text-uppercase font-weight-bold">Total Payouts</h6>
                  <h5 class="font-weight-bolder text-danger">{{ number_format(abs($totalPayouts), 2) }} KWD</h5>
                </div>
              </div>
              <p class="text-danger text-sm mb-0">
                <span class="font-weight-bolder">-{{ number_format(abs($totalPayouts), 2) }}</span> this month
              </p>
        </div>
    </div>
</div>

        <div class="col-md-4 mb-3">
          <div class="card text-center">
            <div class="card-body">
              <div class="d-flex align-items-center justify-content-center mb-2">
                <div class="icon icon-shape bg-gradient-primary shadow text-center rounded-circle me-3">
                  <i class="fas fa-calculator text-white"></i>
                </div>
        <div>
                  <h6 class="text-sm mb-0 text-uppercase font-weight-bold">Net Balance</h6>
                  <h5 class="font-weight-bolder {{ $netBalance >= 0 ? 'text-success' : 'text-danger' }}">{{ number_format($netBalance, 2) }} KWD</h5>
        </div>
    </div>
              <p class="{{ $netBalance >= 0 ? 'text-success' : 'text-danger' }} text-sm mb-0">
                <span class="font-weight-bolder">{{ $netBalance >= 0 ? 'Positive Balance' : 'Negative Balance' }}</span>
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
            <span class="text-muted">Total Results: {{ $payments->total() }}</span>
            </div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
              <thead>
                    <tr>
                  <th>Date</th>
                  <th>Transaction Type</th>
                  <th>Student Name</th>
                  <th>Amount</th>
                  <th>Balance After</th>
                  <th>Notes</th>
                  <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                  // Calculate running balances for all payments
                        $allPayments = \App\Models\Payment::where('user_id', $teacher->id)->orderBy('payment_date')->orderBy('id')->get();
                        $balances = [];
                        $current = 0;
                        foreach ($allPayments as $p) {
                            $current += $p->amount;
                            $balances[$p->id] = $current;
                        }
                    @endphp
                    @forelse($payments as $payment)
                        <tr>
                            <td>
                                    <div>
                                        <div class="fw-bold">{{ date('Y-m-d', strtotime($payment->payment_date)) }}</div>
                                        <div class="text-muted small">{{ date('H:i', strtotime($payment->payment_date)) }}</div>
                                </div>
                            </td>
                            <td>
                                @if($payment->type == 'instructor_payment')
                        <span class="badge bg-warning text-dark">Instructor Payment</span>
                                @elseif($payment->type == 'salary')
                        <span class="badge bg-success">Salary</span>
                                @elseif($payment->type == 'bonus')
                        <span class="badge bg-info">Bonus</span>
                                @elseif($payment->type == 'deduction')
                        <span class="badge bg-danger">Deduction</span>
                                @elseif($payment->type == 'instructor_share')
                        <span class="badge bg-primary">Course Share</span>
                                @else
                        <span class="badge bg-secondary">{{ ucfirst($payment->type) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($payment->type == 'instructor_share')
                                    @php
                                        $studentName = null;
                                        if (preg_match('/تسجيل الطالب: (.*?) في الدورة:/u', $payment->notes, $matches)) {
                                            $studentName = $matches[1];
                                        }
                                    @endphp
                                    {{ $studentName ?? '-' }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold {{ $payment->amount > 0 ? 'text-success' : 'text-danger' }}">
                        {{ $payment->amount > 0 ? '+' : '' }}{{ number_format($payment->amount, 2) }} KWD
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold {{ ($balances[$payment->id] ?? 0) >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ number_format($balances[$payment->id] ?? 0, 2) }} KWD
                                </span>
                            </td>
                            <td>
                                @if($payment->type == 'instructor_share')
                                    @php
                                        $courseName = null;
                                        if (preg_match('/الدورة: (.*)$/u', $payment->notes, $matches)) {
                                            $courseName = $matches[1];
                                        }
                                    @endphp
                        Earnings: {{ $courseName ?? '-' }}
                                @else
                                    {{ $payment->notes ?? '-' }}
                                @endif
                            </td>
                            <td>
                                @if(in_array($payment->type, ['instructor_payment', 'salary', 'bonus', 'deduction']))
                        <div class="btn-group" role="group">
                          <a href="{{ route('admin.teachers.account.transaction.edit', [$teacher->id, $payment->id]) }}" class="btn btn-sm btn-primary" title="Edit">
                            <i class="fas fa-edit"></i>
                          </a>
                                    <form action="{{ route('admin.teachers.account.transaction.delete', [$teacher->id, $payment->id]) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this transaction?');">
                              <i class="fas fa-trash"></i>
                            </button>
                                    </form>
                        </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                                <i class="fas fa-inbox fa-3x mb-3"></i>
                      <br>No financial transactions found for this teacher
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
          @if($payments->hasPages())
            <div class="mt-3">
            {{ $payments->links() }}
            </div>
          @endif
        </div>
      </div>

        </div>
    </div>
</div>

<!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
          <i class="fas fa-plus me-2"></i>Add Financial Transaction for: {{ $teacher->name }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.teachers.account.transaction.store', $teacher) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
            <label class="form-label">Transaction Type <span class="text-danger">*</span></label>
                        <select name="type" class="form-select" required>
              <option value="">Select Type</option>
              <option value="salary">Salary</option>
              <option value="bonus">Bonus</option>
              <option value="instructor_payment">Instructor Payment</option>
              <option value="deduction">Deduction</option>
                        </select>
                    </div>
                    <div class="mb-3">
            <label class="form-label">Amount <span class="text-danger">*</span></label>
                        <div class="input-group">
              <input type="number" name="amount" class="form-control" step="0.01" required placeholder="0.00">
              <span class="input-group-text">KWD</span>
                        </div>
            <div class="form-text">Use negative value for deductions</div>
                    </div>
                    <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control" rows="3" placeholder="Reason for transaction..."></textarea>
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