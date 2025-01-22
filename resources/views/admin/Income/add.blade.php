{{-- @extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header w-36 h-11">
        Add Project Description
    </div>
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
     @endif
        <form method = "POST" action = "{{ url('/income/submit') }}"  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Client Name</label>
              <select class="form-select" name="project_id" aria-label="Default select example">
                <option selected>Select Project Name</option>
                @foreach ($all as $row )
                <option value="{{$row->id}}">{{$row['project_name']}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
                <label for="exampleInputAddress1">Date</label>
                <input type="date"  name = "date"  class="form-control" id="exampleInputAddress1" placeholder="Choose Date">
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                   const today = new Date().toISOString().split('T')[0];
                   document.querySelector('input[name="date"]').value = today;
                   });
                </script>
            </div>

            <div class="form-group">
                <label for="exampleInputproject_name">Income Amount</label>
                <input type="text"  name = "income_amount" class="form-control" id="exampleInputproject_name" aria-describedby="emailHelp" placeholder="Enter Income Amount">
              </div>
              <div class="form-group">
                <label for="exampleInputAddress1">Transition Acount</label>
                <input type="text"  name = "bank_account_id" value="CASH"  class="form-control" id="exampleInputAddress1" placeholder=" Enter Bank Account Id">
              </div>

            <div class="form-group">
                <label>Note</label>
                <textarea class="form-control" name="note" id="" cols="30" rows="6" required autocomplete="off">
                </textarea>
              </div>
            <button type="submit" class="btn btn-primary mt-3">Add</button>
          </form>
  </div>



@endsection --}}


@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header w-36 h-11">
        Add Project Description
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif


    <div class="card-body">
        <!-- Show Project Details -->
        @if(session()->has('project_value') && session()->has('total_paid') && session()->has('due_amount'))
            <div class="alert alert-info">
                <p><strong>Project Value:</strong> {{ session()->get('project_value') }} Taka</p>
                <p><strong>Total Paid:</strong> {{ session()->get('total_paid') }} Taka</p>
                <p><strong>Due Amount:</strong> {{ session()->get('due_amount') }} Taka</p>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ url('/income/submit') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="project_id">Client Name</label>
                <select class="form-select" name="project_id" required>
                    <option selected disabled>Select Project Name</option>
                    @foreach ($all as $row)
                        <option value="{{ $row->id }}">{{ $row->project_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="income_amount">Income Amount</label>
                <input type="number" name="income_amount" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="bank_account_id">Transaction Account</label>
                <input type="text" name="bank_account_id" class="form-control" value="CASH" required>
            </div>

            <div class="form-group">
                <label for="note">Note</label>
                <textarea name="note" class="form-control" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Add</button>
        </form>
    </div>
</div>
@endsection
