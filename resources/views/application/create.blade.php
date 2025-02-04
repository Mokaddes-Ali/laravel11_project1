@extends('layouts.master')

@section('content')
    <h1>Submit Application</h1>
    <form action="{{ route('application.store') }}" method="POST">
        @csrf
        <textarea name="details" rows="5" placeholder="Enter application details"></textarea>
        <button type="submit">Submit</button>
    </form>
@endsection
