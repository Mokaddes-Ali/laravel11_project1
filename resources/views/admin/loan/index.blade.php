{{-- @extends('layouts.master')

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
@endsection --}}


@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Loans List</h2>
            <a href="{{ route('loans.create') }}" class="btn btn-primary btn-sm">
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

        <!-- Search and Export Buttons -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form action="{{ route('loans.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="Search by Loan ID" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                    <a href="{{ route('loans.index') }}" class="btn btn-outline-secondary ms-2">Reset</a>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('loans.export', ['type' => 'csv']) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-csv"></i> Export CSV
                </a>
                <a href="{{ route('loans.export', ['type' => 'excel']) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel"></i> Export Excel
                </a>
                <a href="{{ route('loans.export', ['type' => 'pdf']) }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
            </div>
        </div>

        <!-- Loans Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">
                                <a href="{{ route('loans.index', ['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                    ID <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('loans.index', ['sort' => 'loan_id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                    Loan ID <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('loans.index', ['sort' => 'name', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                    Loan Name <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('loans.index', ['sort' => 'amount', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                    Amount <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('loans.index', ['sort' => 'duration', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                    Duration (Months) <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('loans.index', ['sort' => 'interest_rate', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                    Interest Rate (%) <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('loans.index', ['sort' => 'total_pay_amount', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                    Total Amount <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('loans.index', ['sort' => 'monthly_pay_amount', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}">
                                    Monthly Pay Amount <i class="fas fa-sort"></i>
                                </a>
                            </th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($loans as $loan)
                            <tr>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->loan_id }}</td>
                                <td>{{ $loan->name }}</td>
                                <td>{{ $loan->amount }}</td>
                                <td>{{ $loan->duration }}</td>
                                <td>{{ $loan->interest_rate }}%</td>
                                <td>{{ $loan->total_pay_amount }}</td>
                                <td>{{ $loan->monthly_pay_amount }}</td>
                                <td>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        <form action="{{ route('loans.index') }}" method="GET" class="d-inline">
                            <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5 Per Page</option>
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 Per Page</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 Per Page</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 Per Page</option>
                                <option value="all" {{ request('per_page') == 'all' ? 'selected' : '' }}>All</option>
                            </select>
                        </form>
                    </div>
                    <div>
                        {{ $loans->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
