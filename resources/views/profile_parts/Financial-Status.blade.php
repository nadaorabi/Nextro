<div class="container-fluid px-2">
  <div class="tab-pane">
    <h6 class="text-center mb-3">💳 Financial Transactions</h6>
    <hr>

    <form>
      <!-- Payment Method -->
      <div class="form-group">
        <label class="d-block mb-0">Payment Method</label>
        <div class="small text-muted mb-3">Visa **** 1234 (Exp: 12/26)</div>
        <button class="btn btn-secondary btn-sm" type="button">Update Payment Method</button>
      </div>

      <!-- Payment History -->
      <div class="form-group">
        <label class="d-block">Payment History</label>
        <div class="table-responsive">
          <table class="table text-center table-bordered table-hover table-sm w-100">
            <thead class="thead-light">
              <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Transaction ID</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2025-01-15</td>
                <td>Tuition Fee - Spring 2025</td>
                <td>$1,200.00</td>
                <td><span class="badge bg-success text-white">Paid</span></td>
                <td>TXN789654</td>
              </tr>
              <tr>
                <td>2025-03-01</td>
                <td>Library Fine</td>
                <td>$25.00</td>
                <td><span class="badge bg-success text-white">Paid</span></td>
                <td>TXN789655</td>
              </tr>
              <tr>
                <td>2025-04-10</td>
                <td>Lab Materials</td>
                <td>$50.00</td>
                <td><span class="badge bg-warning text-white">Pending</span></td>
                <td>TXN789656</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Financial Summary -->
      <div class="form-group mt-4">
        <label class="d-block">Financial Summary</label>
        <div class="bg-light p-3 border rounded text-center">
          <p class="mb-1"><strong>Total Debit (Amount Due):</strong> $1,275.00</p>
          <p class="mb-1"><strong>Total Credit (Amount Paid):</strong> $1,225.00</p>
          <p class="mb-1"><strong>Remaining Balance:</strong> $50.00</p>
          <p class="mb-0"><strong>Overall Status:</strong> <span class="text-success">In Good Standing</span></p>
        </div>
      </div>
    </form>
  </div>
</div>

<style>
  @media (max-width: 576px) {
    .table-responsive {
      overflow-x: auto;
    }
    .table {
      font-size: 12px;
      width: 100%;
    }
    th, td {
      padding: 8px;
      white-space: nowrap;
    }
    .container-fluid {
      padding: 0;
    }
    .tab-pane {
      padding: 10px;
    }
  }
</style>
