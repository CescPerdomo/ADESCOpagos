<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .receipt-info {
            margin-bottom: 30px;
        }
        .receipt-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .receipt-info td {
            padding: 8px;
        }
        .receipt-info td:first-child {
            font-weight: bold;
            width: 200px;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            color: #000;
            margin: 20px 0;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-completed {
            background-color: #d1fae5;
            color: #065f46;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Payment Receipt</h1>
            <p>{{ config('app.name') }}</p>
        </div>

        <div class="receipt-info">
            <table>
                <tr>
                    <td>Receipt Number:</td>
                    <td>{{ $receipt->receipt_number }}</td>
                </tr>
                <tr>
                    <td>Transaction ID:</td>
                    <td>{{ $transaction->paypal_order_id }}</td>
                </tr>
                <tr>
                    <td>Date:</td>
                    <td>{{ $transaction->paid_at->format('F d, Y H:i:s') }}</td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td>{{ $receipt->user->name }}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{ $receipt->user->email }}</td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <span class="status status-{{ $transaction->status }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </td>
                </tr>
            </table>

            <div class="amount">
                Amount Paid: ${{ number_format($transaction->amount, 2) }}
            </div>
        </div>

        <div class="footer">
            <p>Thank you for your payment!</p>
            <p>This is a computer-generated document. No signature is required.</p>
            <p>{{ config('app.name') }} - {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>
