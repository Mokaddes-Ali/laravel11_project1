{{-- @extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header w-36 h-11">
        Show All Project List
</div>

<form method="GET" action="/invoice/filter">



	<div class="row mb-3">
           	<div class="col-md-4">
           		<div class="form-group">
                    <label> Start Date</label>
                    <input type="date" name="start_date" class="form-control" required autocomplete="off"
                    value="{{ old('start_date', request('start_date')) }}">
                </div>
           	</div>
           	<div class="col-md-8">

           		<div class="row">
           			<div class="col-md-6">
           				<div class="form-group">
                    <label> End Date</label>
                    <input type="date" name="end_date" class="form-control" required autocomplete="off"
                     value="{{ old('end_date', request('end_date')) }}">
                </div>
           			</div>
           			<div class="col-md-6  mt-1">
           				<div class="row">
           					<div class="col-md-2">
           						<div class="form-group pt-2">

                    <button type="submit" class="btn btn-outline-primary ">Filter</button>
                </div>
           					</div>
                <div class="col-md-2">
                	<div class="form-group pt-2">


                    <a href="{{url('/show/income')}}" type="submit" class="btn btn-outline-primary ">Reset</a>
                </div>
                </div>
           				</div>
           			</div>
           		</div>
           	</div>

           </div>
</form>

@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>

@endif --}}

{{--
<table class="table table-striped table-responsive table-dark">
    <thead>
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Project Name</th>
                <th scope="col">Client Name</th>
                <th scope="col">Date</th>
                <th scope="col">Income/Paid Amount</th>
                <th scope="col">Note</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all as $row)
            <tr>
                <th scope="row">{{ $row->id }}</th>
                <td>{{$row['income']['project_name']}}</td>
                <td>{{ $row['income']['client']['name'] ?? 'No Client' }}</td> <!-- Client name -->
                <td>{{ $row->date }}</td>
                <td>{{ $row->income_amount }}</td>
                <td>{{ $row->note }}</td>
            <td>
                <a class="btn btn-primary btn-sm me-2 d-inline-block" href="{{ url('/income/edit', $row->id) }}">Edit</a>
                <a class="btn btn-primary btn-sm me-2 d-inline-block" href="{{ url('/invoice/create', $row->project_id) }}">Invoice</a>
                <form action="{{ route('income.delete', $row->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');" class="d-inline-block me-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
                <a class="btn btn-secondary btn-sm d-inline-block" href="{{ url('/invoice/pdf', $row->project_id) }}">PDF</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table> --}}


{{-- <table class="table table-striped table-responsive table-dark">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Project Name</th>
            <th scope="col">Client Name</th>
            <th scope="col">Date</th>
            <th scope="col">Income/Paid Amount</th>
            <th scope="col">Note</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all as $row)
            <tr>
                <th scope="row">{{ $row->id }}</th>
                <td>{{ $row->income->project_name }}</td>
                <td>{{ $row->income->client->name ?? 'No Client' }}</td>
                <td>{{ $row->date }}</td>
                <td>{{ $row->income_amount }}</td>
                <td>{{ $row->note }}</td>
                <td>
                    <a class="btn btn-primary btn-sm me-2" href="{{ url('/income/edit', $row->id) }}">Edit</a>
                    <a class="btn btn-primary btn-sm me-2" href="{{ url('/invoice/create', $row->project_id) }}">Invoice</a>
                    <form action="{{ route('income.delete', $row->id) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                    <a class="btn btn-secondary btn-sm" href="{{ url('/invoice/pdf', $row->project_id) }}">PDF</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table> --}}

{{--
@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="text-lg font-bold">Show All Project List</h3>
    </div>

    <div class="card-body">
        <form method="GET" action="/invoice/filter" class="mb-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required
                        value="{{ old('start_date', request('start_date')) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required
                        value="{{ old('end_date', request('end_date')) }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ url('/show/income') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Project Name</th>
                        <th>Client Name</th>
                        <th>Income Details</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all as $row)
                    <tr>
                        <td>{{ $row->project_name }}</td>
                        <td>{{ $row->client_name }}</td>
                        <td>
                            @php
                                $incomeAmounts = explode(',', $row->income_amounts);
                                $incomeDate = \Carbon\Carbon::parse($row->created_at)->format('Y-m-d');
                            @endphp
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Income Amount</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($incomeAmounts as $index => $amount)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $amount }}</td>
                                        <td>{{ $incomeDate }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                    <tr class="table-warning">
                        <td colspan="2" class="text-end fw-bold">Total</td>
                        <td colspan="2" class="fw-bold">{{ $totalAmount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection --}}

{{--
@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="text-lg font-bold">Show All Project List</h3>
    </div>

    <div class="card-body">
        <form method="GET" action="/invoice/filter" class="mb-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required
                        value="{{ old('start_date', request('start_date')) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required
                        value="{{ old('end_date', request('end_date')) }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ url('/show/income') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center align-middle">Project Name</th>
                        <th class="text-center align-middle">Client Name</th>
                        <th class="text-center align-middle">Income Details</th>
                        <th class="text-center align-middle">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all as $row)
                    <tr>
                        <td class="text-center align-middle">{{ $row->project_name }}</td>
                        <td class="text-center align-middle">{{ $row->client_name }}</td>
                        <td>
                            @php
                                $incomeAmounts = explode(',', $row->income_amounts);
                                $incomeDate = \Carbon\Carbon::parse($row->created_at)->format('Y-m-d');
                            @endphp
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Income Amount</th>
                                        <th class="text-center">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($incomeAmounts as $index => $amount)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td class="text-center">{{ $amount }}</td>
                                        <td class="text-center">{{ $incomeDate }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td class="text-center align-middle">{{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                    <tr class="table-warning">
                        <td colspan="2" class="text-end fw-bold">Total</td>
                        <td colspan="2" class="fw-bold">{{ $totalAmount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection --}}

{{--
@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="text-lg font-bold">Show All Project List</h3>
    </div>

    <div class="card-body">
        <form method="GET" action="/invoice/filter" class="mb-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required
                        value="{{ old('start_date', request('start_date')) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required
                        value="{{ old('end_date', request('end_date')) }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ url('/show/income') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center align-middle">Id</th>
                        <th class="text-center align-middle">Project Name</th>
                        <th class="text-center align-middle">Client Name</th>
                        <th class="text-center align-middle">Date</th>
                        <th class="text-center align-middle">Income/Paid Amount</th>
                        <th class="text-center align-middle">Note</th>
                        <th class="text-center align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all as $index => $row)
                    <tr>
                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                        <td class="text-center align-middle">{{ $row->project_name }}</td>
                        <td class="text-center align-middle">{{ $row->client_name }}</td>
                        <td class="text-center align-middle">{{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d') }}</td>
                        <td>
                            @php
                                $incomeAmounts = explode(',', $row->income_amounts);
                                $incomeDates = explode(',', $row->income_dates ?? '');
                            @endphp
                            <table class="table table-sm mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Income Amount</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($incomeAmounts as $i => $amount)
                                    <tr>
                                        <td class="text-center">{{ $i + 1 }}</td>
                                        <td class="text-center">{{ $amount }}</td>
                                        <td class="text-center">{{ $incomeDates[$i] ?? \Carbon\Carbon::parse($row->created_at)->format('Y-m-d') }}</td>
                                        <td class="text-center">
                                            <a href="/income/edit/{{ $row->id }}/{{ $i }}" class="btn btn-sm btn-primary">Edit</a>
                                            <a href="/income/delete/{{ $row->id }}/{{ $i }}" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                        <td class="text-center align-middle">{{ $row->note ?? '-' }}</td>
                        <td class="text-center align-middle">
                            <a href="/project/edit/{{ $row->id }}" class="btn btn-sm btn-primary">Edit</a>
                            <a href="/project/delete/{{ $row->id }}" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="table-warning">
                        <td colspan="4" class="text-end fw-bold">Total</td>
                        <td colspan="3" class="fw-bold">{{ $totalAmount }}</td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection --}}


@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="text-lg font-bold">Show All Project List</h3>
    </div>

    <div class="card-body">
        <form method="GET" action="/invoice/filter" class="mb-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required
                        value="{{ old('start_date', request('start_date')) }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required
                        value="{{ old('end_date', request('end_date')) }}">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ url('/show/income') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center align-middle">Id</th>
                        <th class="text-center align-middle">Project Name</th>
                        <th class="text-center align-middle">Client Name</th>
                        <th class="text-center align-middle">Income/Paid Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all as $index => $row)
                    <tr>
                        <td class="text-center align-middle">{{ $index + 1 }}</td>
                        <td class="text-center align-middle">{{ $row->project_name }}</td>
                        <td class="text-center align-middle">{{ $row->client_name }}</td>
                        <td>
                            @php
                                $incomeAmounts = explode(',', $row->income_amounts);
                                $incomeDate = \Carbon\Carbon::parse($row->created_at)->format('Y-m-d');
                            @endphp
                            <table class="table table-sm mb-0">
                                <thead class="table-secondary">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">Income Amount</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($incomeAmounts as $index => $amount)
                                    <tr>
                                        <td class="text-center">{{  }}</td>
                                        <td class="text-center">{{ $amount }}</td>
                                        <td class="text-center">{{ $incomeDate }}</td>
                                        <td class="text-center align-middle">
                                            @if (isset($row->project_id)) <!-- Check if project_id exists -->
                                                {{-- <a href="/income/edit/{{ $row->project_id }}/{{ $index }}" class="btn btn-sm btn-primary">Edit</a> --}}
                                                <a class="btn btn-primary btn-sm me-2 d-inline-block" href="{{ url('/income/edit', $row->project_id) }}">Edit</a>
                                                <form action="{{ route('income.delete', $row->project_id)}} " method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');" class="d-inline-block me-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            @else
                                                No ID Available
                                            @endif
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="table-warning">
                        <td colspan="4" class="text-end fw-bold">Total</td>
                        <td colspan="3" class="fw-bold">{{ $totalAmount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
