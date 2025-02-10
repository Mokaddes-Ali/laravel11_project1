{{-- @extends('layouts.master')

@section('content')

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<!-- Payment Method Selection Form -->
<form id="paymentMethodForm" method="POST">
    @csrf
    <div>
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" id="paymentMethod" required>
            <option value="stripe">Stripe</option>
            <option value="cash">Cash</option>
        </select>
    </div>
</form>

<!-- Stripe Payment Form -->
<form id="stripeForm" action="{{ route('loanApplication.pay', ['id' => $loanApplication->id]) }}" method="POST" style="display:none;">
    @csrf
    <div class="container">
        <h1>Stripe Payment</h1>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <h3 class="panel-title">Payment Details</h3>
                    </div>
                    <div class="container mt-5">
                        <h2>Loan Payment</h2>
                        <p>Pay Amount: <strong>${{ $loanApplication->payable_amount }}</strong></p>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                            <input type="hidden" name="amount" value="{{ $loanApplication->monthly_installment }}">
                            <script
                                src="https://checkout.stripe.com/checkout.js"
                                class="stripe-button"
                                data-key="{{ env('STRIPE_KEY') }}"
                                data-amount="{{ $loanApplication->monthly_installment * 100 }}"
                                data-name="Loan Payment"
                                data-description="Secure payment via Stripe"
                                data-currency="usd">
                            </script>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Cash Payment Form -->
<form id="cashForm" action="{{ route('loanApplication.pay', ['id' => $loanApplication->id]) }}" method="POST" style="display:none;">
    @csrf
    <div>
        <label for="amount">Amount to Pay:</label>
        <input type="number" name="amount" required>
    </div>
    <button type="submit">Pay with Cash</button>
</form>

<!-- JavaScript for payment method selection -->
<script>
    document.getElementById('paymentMethod').addEventListener('change', function () {
        var paymentMethod = this.value;

        document.getElementById('stripeForm').style.display = 'none';
        document.getElementById('cashForm').style.display = 'none';

        if (paymentMethod === 'stripe') {
            document.getElementById('stripeForm').style.display = 'block';
        } else if (paymentMethod === 'cash') {
            document.getElementById('cashForm').style.display = 'block';
        }
    });
</script>

</body>
</html>

@endsection --}}
{{--
@extends('layouts.master')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<div class="container mt-5">
    <h2>Loan Payment</h2>
    <p>Pay Amount: <strong>${{ $loanApplication->payable_amount }}</strong></p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Payment Method Selection -->
    <form id="paymentMethodForm">
        @csrf
        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method:</label>
            <select class="form-control" name="payment_method" id="paymentMethod" required>
                <option value="">Select Payment Method</option>
                <option value="stripe">Stripe</option>
                <option value="cash">Cash</option>
            </select>
        </div>
    </form>

    <!-- Stripe Payment Form -->
    <div id="stripeSection" style="display:none;">
        <h3>Stripe Payment</h3>
        <form id="payment-form">
            @csrf
            <div id="card-element" class="form-control"></div>
            <button class="btn btn-primary mt-3" id="submit-button">Pay Now</button>
        </form>
    </div>

    <!-- Cash Payment Form -->
    <div id="cashSection" style="display:none;">
        <h3>Cash Payment</h3>
        <form id="cashForm" action="{{ route('loanApplication.pay', ['id' => $loanApplication->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="payment_method" value="cash">
            <div class="mb-3">
                <label for="amount" class="form-label">Amount to Pay:</label>
                <input type="number" name="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Pay with Cash</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        @endif
    });
</script>


<script>
    document.getElementById('paymentMethod').addEventListener('change', function () {
        let method = this.value;
        document.getElementById('stripeSection').style.display = method === 'stripe' ? 'block' : 'none';
        document.getElementById('cashSection').style.display = method === 'cash' ? 'block' : 'none';
    });

    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    document.getElementById('payment-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    let amount = parseFloat("{{ $loanApplication->monthly_installment }}");

    const response = await fetch("{{ route('loanApplication.pay', ['id' => $loanApplication->id]) }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            payment_method: "stripe",
            amount: amount
        })
    });

    if (!response.ok) {
        alert("Server error. Please try again.");
        return;
    }

    const { clientSecret } = await response.json();

    const result = await stripe.confirmCardPayment(clientSecret, {
        payment_method: {
            card: cardElement,
            billing_details: { name: "Mokaddes Ali" }
        }
    });

    if (result.error) {
        alert(result.error.message);
    } else {
        alert("Payment Successful!");
        window.location.reload();
    }
});

</script>

@endsection --}}



@extends('layouts.master')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<div class="container mt-5">
    <h2>Loan Payment</h2>
    <p>Pay Amount: <strong>${{ $loanApplication->payable_amount }}</strong></p>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Payment Successful',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Payment Failed',
                text: "{{ session('error') }}",
                confirmButtonColor: '#d33',
                confirmButtonText: 'Try Again'
            });
        </script>
    @endif

    <!-- Payment Method Selection -->
    <form id="paymentMethodForm">
        @csrf
        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method:</label>
            <select class="form-control" name="payment_method" id="paymentMethod" required>
                <option value="">Select Payment Method</option>
                <option value="stripe">Stripe</option>
                <option value="cash">Cash</option>
            </select>
        </div>
    </form>

    <!-- Stripe Payment Form -->
    <div id="stripeSection" style="display:none;">
        <h3>Stripe Payment</h3>
        <form id="payment-form">
            @csrf
            <div class="mb-3">
                <label class="form-label">Cardholder Name:</label>
                <input type="text" id="card-name" class="form-control" placeholder="Enter Name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Card Number:</label>
                <div id="card-number" class="form-control"></div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label class="form-label">Expiration Date:</label>
                    <div id="card-expiry" class="form-control"></div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">CVC:</label>
                    <div id="card-cvc" class="form-control"></div>
                </div>
                <div class="col-md-4">
                    <label class="form-label">ZIP Code:</label>
                    <input type="text" id="zip-code" class="form-control" placeholder="ZIP Code" required>
                </div>
            </div>
            <button class="btn btn-primary mt-3" id="submit-button">Pay Now</button>
        </form>
    </div>

    <!-- Cash Payment Form -->
    <div id="cashSection" style="display:none;">
        <h3>Cash Payment</h3>
        <form id="cashForm" action="{{ route('loanApplication.pay', ['id' => $loanApplication->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="payment_method" value="cash">
            <div class="mb-3">
                <label for="amount" class="form-label">Amount to Pay:</label>
                <input type="number" name="amount" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Pay with Cash</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('paymentMethod').addEventListener('change', function () {
        let method = this.value;
        document.getElementById('stripeSection').style.display = method === 'stripe' ? 'block' : 'none';
        document.getElementById('cashSection').style.display = method === 'cash' ? 'block' : 'none';
    });

    // Initialize Stripe
    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();

    // Create individual Stripe Elements
    const cardNumber = elements.create('cardNumber');
    cardNumber.mount('#card-number');

    const cardExpiry = elements.create('cardExpiry');
    cardExpiry.mount('#card-expiry');

    const cardCvc = elements.create('cardCvc');
    cardCvc.mount('#card-cvc');

    document.getElementById('payment-form').addEventListener('submit', async (e) => {
    e.preventDefault();

    let cardName = document.getElementById('card-name').value;
    let zipCode = document.getElementById('zip-code').value;
    let amount = parseFloat("{{ $loanApplication->monthly_installment }}");
    let email = document.getElementById('email').value;

    const response = await fetch("{{ route('loanApplication.pay', ['id' => $loanApplication->id]) }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            payment_method: "stripe",
            amount: amount,
            email: email,
            card_holder_name: cardName
        })
    });

    if (!response.ok) {
        Swal.fire({
            icon: 'error',
            title: 'Server Error',
            text: 'Payment failed. Please try again later.',
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
        return;
    }

    const { clientSecret } = await response.json();

    const result = await stripe.confirmCardPayment(clientSecret, {
        payment_method: {
            card: cardNumber,
            billing_details: {
                name: cardName,
                address: { postal_code: zipCode }
            }
        }
    });

    if (result.error) {
        Swal.fire({
            icon: 'error',
            title: 'Payment Failed',
            text: result.error.message,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Try Again'
        });
    } else {
        Swal.fire({
            icon: 'success',
            title: 'Payment Successful',
            text: 'Thank you for your payment!',
            confirmButtonColor: '#28a745',
            confirmButtonText: 'OK'
        }).then(() => {
            window.location.reload();
        });
    }
});

</script>

@endsection
