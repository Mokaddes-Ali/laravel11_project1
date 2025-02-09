@extends('layouts.master')

@section('content')

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
                    <div class="panel-body">
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label>
                                <input class='form-control' size='4' type='text' required>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Card Number</label>
                                <input autocomplete='off' class='form-control card-number' size='20' type='text' required>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text' required>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label>
                                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text' required>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label>
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text' required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ($100)</button>
                            </div>
                        </div>
                    </div>
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

@endsection
