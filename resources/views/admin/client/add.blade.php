@extends('layouts.master')

@section('content')
<div class="card shadow-lg border-0 rounded-lg mt-4">
    <div class="card-header bg-primary text-white text-center">
        <h4 class="mb-0">Client Management</h4>
    </div>

    @if(session()->has('success'))
    <div class="alert alert-success mt-3 mx-3">
        {{ session()->get('success') }}
    </div>
    @endif

    <form method="POST" action="{{ url('/client/submit') }}" enctype="multipart/form-data" class="p-4">
        @csrf

        <div class="form-group mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control border-0 shadow-sm @error('name') is-invalid @enderror"
                   id="name" placeholder="Enter Name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control border-0 shadow-sm @error('email') is-invalid @enderror"
                   id="email" placeholder="Enter Email" value="{{ old('email') }}">
            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="number" class="form-label">Mobile</label>
            <input type="number" name="number" class="form-control border-0 shadow-sm @error('number') is-invalid @enderror"
                   id="number" placeholder="Enter Mobile Number" value="{{ old('number') }}">
            @error('number')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" class="form-control border-0 shadow-sm @error('address') is-invalid @enderror"
                   id="address" placeholder="Enter Address" value="{{ old('address') }}">
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="pic" class="form-label">Image</label>
            <input type="file" name="pic" class="form-control border-0 shadow-sm @error('pic') is-invalid @enderror"
                   id="pic">
            @error('pic')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary shadow-sm px-4 py-2">Submit</button>
        </div>
    </form>
</div>
@endsection
