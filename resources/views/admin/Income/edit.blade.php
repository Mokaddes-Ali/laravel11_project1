@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header w-36 h-11">
        Edit Project Description
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif

    <form method="POST" action="{{ url('/income/update', $income->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Update করার জন্য PUT Method ব্যবহার করতে হবে -->
        <div class="form-group">
            <label for="exampleInputEmail1">Client Name</label>
            <select class="form-select" name="project_id" aria-label="Default select example">
                <option>Select Project Name</option>
                @foreach ($allProjects as $project)
                <option value="{{ $project->id }}" {{ $income->project_id == $project->id ? 'selected' : '' }}>
                    {{ $project->project_name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputAddress1">Date</label>
            <input type="date" name="date" class="form-control" id="exampleInputAddress1" value="{{ $income->date }}">
        </div>

        <div class="form-group">
            <label for="exampleInputproject_name">Income Amount</label>
            <input type="text" name="income_amount" class="form-control" id="exampleInputproject_name" value="{{ $income->income_amount }}" placeholder="Enter Income Amount">
        </div>

        <div class="form-group">
            <label for="exampleInputAddress1">Transition Account</label>
            <input type="text" name="bank_account_id" class="form-control" id="exampleInputAddress1" value="{{ $income->bank_account_id }}">
        </div>

        <div class="form-group">
            <label>Note</label>
            <textarea class="form-control" name="note" id="" cols="30" rows="6" required autocomplete="off">{{ $income->note }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection
