@extends('layouts.master')

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
        <form method = "POST" action = "{{ url('/project/submit') }}"  enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Client Name</label>
              <select class="form-select" aria-label="Default select example">
                <option selected>Select Client</option>
                @foreach ($all as $row )
                <option value="{{ $row->id }}">{{ $row['name'] }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
                <label for="exampleInputproject_name">Project Name</label>
                <input type="text"  name = "project_name" class="form-control" id="exampleInputproject_name" aria-describedby="emailHelp" placeholder="Enter Project Name">
              </div>
              <div class="form-group">
                <label for="exampleInputAddress1">Project Value</label>
                <input type="number"  name = "project_value"  class="form-control" id="exampleInputAddress1" placeholder="Project Value">
              </div>

             <div class="form-group">
              <label for="exampleInputAddress1">Date</label>
              <input type="date"  name = "date"  class="form-control" id="exampleInputAddress1" placeholder="Choose Date">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <input type="text"  name = "description" class="form-control p-4" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Description">
              </div>
            <button type="submit" class="btn btn-primary mt-3">Add</button>
          </form>
  </div>

@endsection
