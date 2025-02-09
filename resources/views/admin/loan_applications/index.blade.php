@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Loan Applications</h1>
    <a href="{{ route('loan-applications.create') }}" class="btn btn-primary mb-3">Create New</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Loan ID</th>
                <th>Application ID</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loanApplications as $loanApplication)
            <tr>
                <td>{{ $loanApplication->id }}</td>
                <td>{{ $loanApplication->client->name }}</td>
                <td>{{ $loanApplication->loan_id }}</td>
                <td>{{ $loanApplication->application_id }}</td>
                <td>{{ ucfirst($loanApplication->status) }}</td>
                <td>
                    <a href="{{ route('loan-applications.show', $loanApplication->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('loan-applications.edit', $loanApplication->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('loan-applications.destroy', $loanApplication->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
