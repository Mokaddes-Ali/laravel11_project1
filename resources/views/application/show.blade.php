@extends('layouts.master')

@section('content')
    <h1>Application Details</h1>
    <p><strong>Status:</strong> {{ $application->status }}</p>
    <p><strong>Details:</strong> {{ $application->details }}</p>
@endsection
