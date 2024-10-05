@extends('layouts.master')

@section('content')
<div class="card ">
    <div class="card-header w-36 h-11">
        Show All Project List
</div>
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif
<table class="table table-striped table-responsive table-dark">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Project Name</th>
        <th scope="col">Date</th>
        <th scope="col">Income/PaidAmount</th>
        <th scope="col">Note</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($all as $row)
      <tr>
        <th scope="row">{{ $row['id'] }}</th>
        <td>{{$row['income']['project_name']}}</td>
        <td>{{$row['date']}}</td>
        <td>{{$row['income_amount']}}</td>
        <td>{{$row['note']}}</td>

        <td>
            <a class="btn btn-primary btn-sm," href="{{ url('/income/edit' , $row -> id) }}">edit</a>
            <a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure Delete!')" href="{{ url('/delete', $row -> id)}}">delete</a>
            <a class="btn btn-primary btn-sm," href="{{ url('/invoice/create' , $row -> id) }}">invoice</a>
            <a class="btn btn-secondary btn-sm," href="{{ url(' /invoice/pdf' , $row -> id) }}">invoice</a>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection



