@extends('layouts.master')

@section('content')

<form action="{{ route('loanApplication.pay', ['id' => $loanApplication->id]) }}" method="POST" id="payment-form">
    @csrf
    <div>
        <label for="amount">Amount to Pay:</label>
        <input type="number" name="amount" required>
    </div>

    <div id="card-element">
        <!-- A Stripe Element will be inserted here. -->
    </div>

    <!-- Used to display form errors. -->
    <div id="card-errors" role="alert"></div>

    <div>
        <label for="payment_method">Payment Method:</label>
        <select name="payment_method" required>
            <option value="stripe">Stripe</option>
            <option value="cash">Cash</option>
        </select>
    </div>

    <button type="submit" id="submit-button">Pay Now</button>
</form>

<!-- Add Stripe.js -->
<script src="https://js.stripe.com/v3/"></script>

<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}'); // Your Stripe publishable key
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    var form = document.getElementById('payment-form');
    var cardErrors = document.getElementById('card-errors');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                cardErrors.textContent = result.error.message;
            } else {
                var token = result.token;
                
                // Insert the token into the form before submitting
                var hiddenTokenInput = document.createElement('input');
                hiddenTokenInput.setAttribute('type', 'hidden');
                hiddenTokenInput.setAttribute('name', 'stripeToken');
                hiddenTokenInput.setAttribute('value', token.id);
                form.appendChild(hiddenTokenInput);

                form.submit(); // Now submit the form to your backend
            }
        });
    });
</script>

@endsection

