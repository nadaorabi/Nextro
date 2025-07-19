<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt - {{ $receiptData['receipt_number'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            .receipt-container {
                box-shadow: none !important;
                border: none !important;
            }
            body {
                background: white !important;
            }
        }
        
        .receipt-container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        
        .receipt-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .receipt-body {
            padding: 40px;
        }
        
        .receipt-footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }
        
        .receipt-number {
            font-size: 1.2rem;
            font-weight: bold;
            color: #007bff;
        }
        
        .amount-display {
            font-size: 2.5rem;
            font-weight: bold;
            color: #28a745;
            text-align: center;
            margin: 20px 0;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .info-label {
            font-weight: bold;
            color: #495057;
        }
        
        .info-value {
            color: #6c757d;
        }
        
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        .status-paid {
            background: #d4edda;
            color: #155724;
        }
        
        .institute-logo {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 4rem;
            color: rgba(0,0,0,0.05);
            pointer-events: none;
            z-index: -1;
        }
    </style>
</head>
<body class="bg-light">
    <div class="print-button no-print">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Print Receipt
        </button>
        <a href="{{ route('admin.transactions.index') }}" class="btn btn-secondary ms-2">
            <i class="fas fa-arrow-left"></i> Back to Transactions
        </a>
    </div>

    <div class="receipt-container">
        <div class="watermark">PAID</div>
        
        <!-- Header -->
        <div class="receipt-header">
            <div class="institute-logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h2>{{ $receiptData['institute_name'] }}</h2>
            <p class="mb-0">{{ $receiptData['institute_address'] }}</p>
            <p class="mb-0">Phone: {{ $receiptData['institute_phone'] }} | Email: {{ $receiptData['institute_email'] }}</p>
        </div>

        <!-- Body -->
        <div class="receipt-body">
            <div class="row">
                <div class="col-md-6">
                    <h4 class="text-primary mb-4">PAYMENT RECEIPT</h4>
                    <div class="receipt-number mb-3">
                        Receipt #: {{ $receiptData['receipt_number'] }}
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <div class="status-badge status-paid">
                        <i class="fas fa-check-circle"></i> PAID
                    </div>
                    <p class="text-muted mt-2">Generated: {{ $receiptData['generated_at']->format('M d, Y H:i') }}</p>
                </div>
            </div>

            <div class="amount-display">
                ${{ number_format($receiptData['amount'], 2) }}
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-primary">PAYER INFORMATION</h6>
                    <div class="info-row">
                        <span class="info-label">Name:</span>
                        <span class="info-value">{{ $receiptData['user']->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Email:</span>
                        <span class="info-value">{{ $receiptData['user']->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Phone:</span>
                        <span class="info-value">{{ $receiptData['user']->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Role:</span>
                        <span class="info-value">{{ ucfirst($receiptData['user']->role) }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary">PAYMENT DETAILS</h6>
                    <div class="info-row">
                        <span class="info-label">Payment Date:</span>
                        <span class="info-value">{{ $receiptData['date']->format('M d, Y') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Transaction Type:</span>
                        <span class="info-value">{{ $receiptData['type'] }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Payment Method:</span>
                        <span class="info-value">Cash/Transfer</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Transaction ID:</span>
                        <span class="info-value">#{{ $receiptData['payment']->id }}</span>
                    </div>
                </div>
            </div>

            @if($receiptData['notes'])
            <div class="mt-4">
                <h6 class="text-primary">NOTES</h6>
                <div class="alert alert-info">
                    {{ $receiptData['notes'] }}
                </div>
            </div>
            @endif

            <div class="mt-4">
                <h6 class="text-primary">BREAKDOWN</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Description</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $receiptData['type'] }} Payment</td>
                                <td class="text-end">${{ number_format($receiptData['amount'], 2) }}</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th>Total Amount</th>
                                <th class="text-end">${{ number_format($receiptData['amount'], 2) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="receipt-footer">
            <div class="row">
                <div class="col-md-4">
                    <h6>Authorized Signature</h6>
                    <div style="border-top: 1px solid #000; width: 80%; margin-top: 30px;"></div>
                </div>
                <div class="col-md-4">
                    <h6>Student/Parent Signature</h6>
                    <div style="border-top: 1px solid #000; width: 80%; margin-top: 30px;"></div>
                </div>
                <div class="col-md-4">
                    <h6>Date</h6>
                    <div style="border-top: 1px solid #000; width: 80%; margin-top: 30px;"></div>
                </div>
            </div>
            <div class="mt-4">
                <small class="text-muted">
                    This receipt serves as proof of payment. Please keep it for your records.<br>
                    For any questions, please contact us at {{ $receiptData['institute_phone'] }}
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-print functionality (optional)
        // window.onload = function() {
        //     window.print();
        // }
        
        // Add keyboard shortcut for printing
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'p') {
                e.preventDefault();
                window.print();
            }
        });
    </script>
</body>
</html> 