@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="text-center mb-2">
            <h2 class="fw-bold">Profile Information</h2>
        </div>
        @include('layouts.messages')

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                @include('profile.partials.update-password-form')
                            </div>
                        </div>
                        <div class="card shadow-sm mt-2">
                            <div class="card-body">

                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
