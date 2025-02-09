@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Create Loan Application</h1>
    <form action="{{ route('loan-applications.store') }}" method="POST">
        @csrf

        <!-- Client ID -->
        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select class="form-select" id="client_id" name="client_id" required>
                <option value="">Select Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                @endforeach
            </select>
            @error('client_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

       <!-- Loan Selection -->
<div class="mb-3">
    <label for="loan_id" class="form-label">Loan</label>
    <select class="form-select" id="loan_id" name="loan_id" required>
        <option value="">Select Loan</option>
        @foreach($loans as $loan)
            <option value="{{ $loan->id }}"
                data-name="{{ $loan->name }}"
                data-amount="{{ $loan->amount }}"
                data-interest="{{ $loan->interest_rate }}"
                data-duration="{{ $loan->duration }}"
                data-total="{{ $loan->total_pay_amount }}"
                data-monthly="{{ $loan->monthly_pay_amount }}">
                {{ $loan->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- Loan Details Table -->
<div id="loan_details" style="display: none;">
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Amount</th>
                <th>Interest Rate (%)</th>
                <th>Duration (Months)</th>
                <th>Total Payable</th>
                <th>Monthly Installment</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td id="loan_name"></td>
                <td id="loan_amount"></td>
                <td id="loan_interest"></td>
                <td id="loan_duration"></td>
                <td id="loan_total"></td>
                <td id="loan_monthly"></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Payable Amount Field -->
<div class="mb-3">
    <label for="payable_amount" class="form-label">Payable Amount</label>
    <input type="text" class="form-control" id="payable_amount" name="payable_amount" readonly>
</div>

<!-- monthly_installment Field -->
<div class="mb-3">
    <label for="monthly_installment" class="form-label">Payable Amount</label>
    <input type="text" class="form-control" id="monthly_installment" name="monthly_installment" readonly>
</div>



<!-- JavaScript Code -->
<script>
    document.getElementById('loan_id').addEventListener('change', function () {
        let selectedOption = this.options[this.selectedIndex];

        if (selectedOption.value) {
            // Populate Loan Details Table
            document.getElementById('loan_name').textContent = selectedOption.getAttribute('data-name');
            document.getElementById('loan_amount').textContent = selectedOption.getAttribute('data-amount');
            document.getElementById('loan_interest').textContent = selectedOption.getAttribute('data-interest');
            document.getElementById('loan_duration').textContent = selectedOption.getAttribute('data-duration');
            document.getElementById('loan_total').textContent = selectedOption.getAttribute('data-total');
            document.getElementById('loan_monthly').textContent = selectedOption.getAttribute('data-monthly');

            // Set Payable Amount Automatically
            document.getElementById('payable_amount').value = selectedOption.getAttribute('data-amount');
            document.getElementById('monthly_installment').value = selectedOption.getAttribute('data-monthly');

            document.getElementById('loan_details').style.display = 'block';
        } else {
            document.getElementById('loan_details').style.display = 'none';
            document.getElementById('payable_amount').value = ''; // Clear payable amount if no loan selected
            document.getElementById('monthly_installment').value = ''; // Clear payable amount if no loan selected
        }
    });
</script>


        <!-- Application ID -->
        <div class="mb-3">
            <label for="application_id" class="form-label">Application ID</label>
            <input type="text" class="form-control" id="application_id" name="application_id" value="{{ old('application_id') }}" required>
            @error('application_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Loan Purpose -->
        <div class="mb-3">
            <label for="loan_purpose" class="form-label">Loan Purpose</label>
            <select class="form-select" id="loan_purpose" name="loan_purpose" required>
                <option value="Business" {{ old('loan_purpose') == 'Business' ? 'selected' : '' }}>Business</option>
                <option value="Personal" {{ old('loan_purpose') == 'Personal' ? 'selected' : '' }}>Personal</option>
                <option value="Education" {{ old('loan_purpose') == 'Education' ? 'selected' : '' }}>Education</option>
                <option value="Medical" {{ old('loan_purpose') == 'Medical' ? 'selected' : '' }}>Medical</option>
                <option value="Other" {{ old('loan_purpose') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('loan_purpose')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Loan Purpose Details -->
        <div class="mb-3">
            <label for="loan_perporse" class="form-label">Loan Purpose Details</label>
            <textarea class="form-control" id="loan_perporse" name="loan_perporse" rows="3" required>{{ old('loan_perporse') }}</textarea>
            @error('loan_perporse')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Collateral Details -->
        <div class="mb-3">
            <label for="collateral_details" class="form-label">Collateral Details</label>
            <textarea class="form-control" id="collateral_details" name="collateral_details" rows="3">{{ old('collateral_details') }}</textarea>
            @error('collateral_details')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
