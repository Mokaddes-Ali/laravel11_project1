@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Loans List</h2>
            <a href="{{ route('loans.create') }}" class="btn btn-primary btn-md">
                <i class="fas fa-plus"></i> Create Loan
            </a>
        </div>

        <!-- Success/Error Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Loans Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover table-striped text-center table-border">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Loan ID</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Duration (Months)</th>
                            <th scope="col">Interest Rate (%)</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Monthly Pay Amount</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loans as $loan)
                            <tr>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->loan_id }}</td>
                                <td>{{ $loan->amount }}</td>
                                <td>{{ $loan->duration }}</td>
                                <td>{{ $loan->interest_rate }}</td>
                                <td>{{ $loan->total_pay_amount}}</td>
                                <td>{{ $loan->monthly_pay_amount }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                    <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this loan?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
