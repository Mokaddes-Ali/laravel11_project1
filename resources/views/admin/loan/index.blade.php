@extends('layouts.master')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Loans List</h2>

        <!-- Success/Error Message -->
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

        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Loan ID</th>
                    <th class="px-4 py-2 border">Amount</th>
                    <th class="px-4 py-2 border">Duration</th>
                    <th class="px-4 py-2 border">Interest Rate</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                    <tr>
                        <td class="px-4 py-2 border">{{ $loan->loan_id }}</td>
                        <td class="px-4 py-2 border">{{ $loan->amount }}</td>
                        <td class="px-4 py-2 border">{{ $loan->duration }}</td>
                        <td class="px-4 py-2 border">{{ $loan->interest_rate }}%</td>
                        <td class="px-4 py-2 border">
                            <a href="{{ route('loans.edit', $loan->id) }}" class="text-blue-500">Edit</a> |
                            <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

