@extends('layouts.master')

@section('content')
    <div class="container mt-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Create a Loan</h2>
            <a href="{{ route('loans.index') }}" class="btn btn-outline-warning btn-md">
                See Loan List
            </a>
        </div>
        <!-- Loan Creation Form -->
        <form action="{{ route('loans.store') }}" method="POST" class="card p-4 shadow-sm">
            @csrf

            <!-- Amount Field -->
            <div class="mb-3">
                <label for="amount" class="form-label">
                    Amount <span class="text-danger">*</span>
                </label>
                <input type="number" name="amount" id="amount" value="{{ old('amount') }}" class="form-control"
                    placeholder="Enter loan amount" required>
                @error('amount')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Duration Field -->
            <div class="mb-3">
                <label for="duration" class="form-label">
                    Duration (Months) <span class="text-danger">*</span>
                </label>
                <input type="number" name="duration" id="duration" value="{{ old('duration') }}" class="form-control"
                    placeholder="Enter loan duration in months" required>
                @error('duration')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Interest Rate Field -->
            <div class="mb-4">
                <label for="interest_rate" class="form-label">
                    Interest Rate (%) <span class="text-danger">*</span>
                </label>
                <input type="number" name="interest_rate" id="interest_rate" value="{{ old('interest_rate') }}"
                    class="form-control" placeholder="Enter interest rate" required>
                @error('interest_rate')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary btn-md">
                    Create Loan
                </button>
            </div>
        </form>
    </div>

    <!-- Toast Notifications -->
    @if (session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                backgroundColor: "green",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
            }).showToast();
        </script>
    @endif

    @if (session('error'))
        <script>
            Toastify({
                text: "{{ session('error') }}",
                backgroundColor: "red",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
            }).showToast();
        </script>
    @endif
@endsection
