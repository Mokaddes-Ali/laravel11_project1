@extends('layouts.master')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Create a Loan</h2>

        <!-- Loan Creation Form -->
        <form action="{{ route('loans.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="amount" class="block text-sm font-medium text-gray-700">Amount <span class="text-red-500">*</span></label>
                <input type="number" name="amount" id="amount" value="{{ old('amount') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                @error('amount')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="duration" class="block text-sm font-medium text-gray-700">Duration (Months) <span class="text-red-500">*</span></label>
                <input type="number" name="duration" id="duration" value="{{ old('duration') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                @error('duration')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="interest_rate" class="block text-sm font-medium text-gray-700">Interest Rate (%) <span class="text-red-500">*</span></label>
                <input type="number" name="interest_rate" id="interest_rate" value="{{ old('interest_rate') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                @error('interest_rate')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Create Loan</button>
        </form>
    </div>

    <!-- Toast Notifications -->
    @if(session('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                backgroundColor: "green",
                duration: 3000
            }).showToast();
        </script>
    @endif

    @if(session('error'))
        <script>
            Toastify({
                text: "{{ session('error') }}",
                backgroundColor: "red",
                duration: 3000
            }).showToast();
        </script>
    @endif
@endsection
