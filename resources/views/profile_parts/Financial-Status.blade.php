<div class="container-fluid px-3 py-4">
  <div class="tab-pane">
    <!-- Header Section -->
    <div class="text-center mb-4">
      <h4 class="text-primary mb-2">
        <i class="fas fa-credit-card me-2"></i>
        Financial Transactions
      </h4>
      <p class="text-muted mb-0">Track your payment history and financial status</p>
    </div>

    <!-- Financial Summary Cards -->
    <div class="row g-3 mb-4">
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body text-center p-4">
            <div class="bg-primary bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-dollar-sign text-white fs-4"></i>
            </div>
            <h3 class="text-primary mb-2">${{ number_format($totalPaid ?? 0, 2) }}</h3>
            <p class="text-muted mb-0 fw-semibold">Total Paid</p>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body text-center p-4">
            <div class="bg-success bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-undo text-white fs-4"></i>
            </div>
            <h3 class="text-success mb-2">${{ number_format($totalRefunded ?? 0, 2) }}</h3>
            <p class="text-muted mb-0 fw-semibold">Total Refunded</p>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-body text-center p-4">
            <div class="bg-info bg-gradient rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
              <i class="fas fa-calculator text-white fs-4"></i>
            </div>
            <h3 class="text-info mb-2">${{ number_format($netPayment ?? 0, 2) }}</h3>
            <p class="text-muted mb-0 fw-semibold">Net Payment</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Payment History Section -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card-header bg-light border-0 py-3">
        <h5 class="mb-0">
          <i class="fas fa-history me-2 text-primary"></i>
          Payment History
        </h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th class="border-0 px-4 py-3">Date</th>
                <th class="border-0 px-4 py-3">Description</th>
                <th class="border-0 px-4 py-3 text-center">Amount</th>
                <th class="border-0 px-4 py-3 text-center">Type</th>
                <th class="border-0 px-4 py-3 text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($payments ?? [] as $payment)
                <tr class="border-bottom">
                  <td class="px-4 py-3">
                    <div class="d-flex align-items-center">
                      <i class="fas fa-calendar text-muted me-2"></i>
                      {{ \Carbon\Carbon::parse($payment->payment_date)->format('M d, Y') }}
                    </div>
                  </td>
                  <td class="px-4 py-3">
                    <div class="fw-medium">{{ $payment->notes ?? 'Payment' }}</div>
                  </td>
                  <td class="px-4 py-3 text-center">
                    <div class="d-flex align-items-center justify-content-center">
                      <span class="fw-bold {{ $payment->type == 'package_refund' ? 'text-success' : 'text-primary' }}">
                        ${{ number_format($payment->amount, 2) }}
                      </span>
                      @if($payment->type == 'package_refund')
                        <i class="fas fa-arrow-up text-success ms-2"></i>
                      @else
                        <i class="fas fa-arrow-down text-primary ms-2"></i>
                      @endif
                    </div>
                  </td>
                  <td class="px-4 py-3 text-center">
                    @if($payment->type == 'student_fee')
                      <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                        <i class="fas fa-graduation-cap me-1"></i>Tuition Fee
                      </span>
                    @elseif($payment->type == 'package_refund')
                      <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                        <i class="fas fa-undo me-1"></i>Refund
                      </span>
                    @elseif($payment->type == 'instructor_payment')
                      <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                        <i class="fas fa-chalkboard-teacher me-1"></i>Instructor Payment
                      </span>
                    @else
                      <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2">
                        {{ ucfirst($payment->type) }}
                      </span>
                    @endif
                  </td>
                  <td class="px-4 py-3 text-center">
                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                      <i class="fas fa-check-circle me-1"></i>Completed
                    </span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-5">
                    <div class="text-muted">
                      <i class="fas fa-credit-card mb-3" style="font-size: 3rem; opacity: 0.5;"></i>
                      <h6 class="mt-3">No Payment Records</h6>
                      <p class="mb-0">No payment transactions found in your account.</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Financial Summary Section -->
    <div class="card border-0 shadow-sm">
      <div class="card-header bg-light border-0 py-3">
        <h5 class="mb-0">
          <i class="fas fa-chart-pie me-2 text-primary"></i>
          Financial Summary
        </h5>
      </div>
      <div class="card-body p-4">
        <div class="row g-3">
          <div class="col-md-4">
            <div class="text-center p-3 bg-primary bg-opacity-10 rounded">
              <h6 class="text-primary mb-2">Total Paid</h6>
              <h4 class="text-primary mb-0">${{ number_format($totalPaid ?? 0, 2) }}</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="text-center p-3 bg-success bg-opacity-10 rounded">
              <h6 class="text-success mb-2">Total Refunded</h6>
              <h4 class="text-success mb-0">${{ number_format($totalRefunded ?? 0, 2) }}</h4>
            </div>
          </div>
          <div class="col-md-4">
            <div class="text-center p-3 bg-info bg-opacity-10 rounded">
              <h6 class="text-info mb-2">Net Payment</h6>
              <h4 class="text-info mb-0">${{ number_format($netPayment ?? 0, 2) }}</h4>
            </div>
          </div>
        </div>
        
        <hr class="my-4">
        
        <div class="text-center">
          <h6 class="mb-3">Overall Status</h6>
          @if($netPayment > 0)
            <span class="badge bg-warning bg-opacity-10 text-warning px-4 py-3 fs-6">
              <i class="fas fa-exclamation-triangle me-2"></i>Outstanding Balance
            </span>
          @elseif($netPayment < 0)
            <span class="badge bg-info bg-opacity-10 text-info px-4 py-3 fs-6">
              <i class="fas fa-plus-circle me-2"></i>Credit Balance
            </span>
          @else
            <span class="badge bg-success bg-opacity-10 text-success px-4 py-3 fs-6">
              <i class="fas fa-check-circle me-2"></i>In Good Standing
            </span>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .card {
    border-radius: 15px;
    transition: all 0.3s ease;
  }
  
  .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
  }
  
  .table {
    font-size: 0.9rem;
  }
  
  .badge {
    border-radius: 8px;
    font-weight: 500;
  }
  
  .bg-gradient {
    background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-primary) 100%);
  }
  
  .bg-success.bg-gradient {
    background: linear-gradient(135deg, var(--bs-success) 0%, var(--bs-success) 100%);
  }
  
  .bg-info.bg-gradient {
    background: linear-gradient(135deg, var(--bs-info) 0%, var(--bs-info) 100%);
  }
  
  @media (max-width: 768px) {
    .container-fluid {
      padding: 1rem !important;
    }
    
    .table-responsive {
      font-size: 0.8rem;
    }
    
    .card-body h3 {
      font-size: 1.5rem;
    }
    
    .badge {
      font-size: 0.75rem;
      padding: 0.5rem 1rem !important;
    }
  }
  
  @media (max-width: 576px) {
    .table th,
    .table td {
      padding: 0.75rem 0.5rem;
      white-space: nowrap;
    }
    
    .card-body {
      padding: 1rem !important;
    }
  }
</style>
