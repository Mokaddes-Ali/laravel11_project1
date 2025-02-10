<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body>
    <h2>Dear Customer,</h2>
    <p>Thank you for your payment of <strong>${{ $payment->amount_paid }}</strong>.</p>
    <p>Payment Method: {{ ucfirst($payment->payment_method) }}</p>

    @if($payment->payment_method == 'stripe')
        <p>Card Holder: {{ $payment->card_holder_name }}</p>
    @endif

    <p>We appreciate your business!</p>
    <p>Best Regards,<br>Loan Payment Team</p>
</body>
</html>
