<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Recibo de Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .receipt-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        .receipt-number {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .info-row {
            margin-bottom: 10px;
        }
        .label {
            font-weight: bold;
            color: #666;
            width: 150px;
            display: inline-block;
        }
        .value {
            color: #333;
        }
        .amount {
            font-size: 20px;
            color: #000;
            margin: 20px 0;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .qr-code {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        <h1 class="receipt-title">Recibo de Pago</h1>
        <div class="receipt-number">No. {{ $receipt->receipt_number }}</div>
    </div>

    <div class="section">
        <h2 class="section-title">Información del Cliente</h2>
        <div class="info-row">
            <span class="label">Nombre:</span>
            <span class="value">{{ $user->name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Email:</span>
            <span class="value">{{ $user->email }}</span>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Detalles de la Transacción</h2>
        <div class="info-row">
            <span class="label">ID Transacción:</span>
            <span class="value">{{ $transaction->id }}</span>
        </div>
        <div class="info-row">
            <span class="label">Fecha:</span>
            <span class="value">{{ $transaction->created_at->format('d/m/Y H:i:s') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Método de Pago:</span>
            <span class="value">{{ ucfirst($transaction->payment_method) }}</span>
        </div>
        <div class="info-row">
            <span class="label">Estado:</span>
            <span class="value">{{ ucfirst($transaction->status) }}</span>
        </div>
        <div class="info-row">
            <span class="label">Descripción:</span>
            <span class="value">{{ $transaction->metadata['description'] ?? 'N/A' }}</span>
        </div>
    </div>

    <div class="amount">
        <span class="label">Monto Total:</span>
        <span class="value">{{ number_format($transaction->amount, 2) }} {{ $transaction->currency }}</span>
    </div>

    <div class="verification-code">
        <p class="text-center">Código de verificación:</p>
        <p class="text-center font-bold">{{ $receipt->receipt_number }}</p>
    </div>

    <div class="footer">
        <p>Este es un recibo electrónico válido.</p>
        <p>Para verificar la autenticidad de este recibo, visite: {{ config('app.url') }}/verify/{{ $receipt->receipt_number }}</p>
        <p>Generado el {{ now()->format('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>
