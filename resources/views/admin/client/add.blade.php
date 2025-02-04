@extends('layouts.master')
{{--
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

{{--
<!--Image-->
<div>
    <div class="mb-4 d-flex justify-content-center">
        <img id="selectedImage" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg"
        alt="example placeholder" style="width: 300px;" />
    </div>
    <div class="d-flex justify-content-center">
        <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
            <label class="form-label text-white m-1" for="customFile1">Choose file</label>
            <input type="file" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage')" />
        </div>
    </div>
</div>

<!--Avatar-->
<div>
    <div class="d-flex justify-content-center mb-4">
        <img id="selectedAvatar" src="https://mdbootstrap.com/img/Photos/Others/placeholder-avatar.jpg"
        class="rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="example placeholder" />
    </div>
    <div class="d-flex justify-content-center">
        <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
            <label class="form-label text-white m-1" for="customFile2">Choose file</label>
            <input type="file" class="form-control d-none" id="customFile2" onchange="displaySelectedImage(event, 'selectedAvatar')" />
        </div>
    </div>
</div> --}}




@section('content')
<div class="container" style="margin-top: 5px; height: 5000px;">
    <h1 class="mb-4">Add New Client</h1>
    <form action="{{ route('create') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Personal Information -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">Personal Information</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="father_name" class="form-label">Father's Name</label>
                            <input type="text" class="form-control" id="father_name" name="father_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="mother_name" class="form-label">Mother's Name</label>
                            <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        </div>
                        <div class="mb-3">
                            <label for="nid_number" class="form-label">NID Number</label>
                            <input type="text" class="form-control" id="nid_number" name="nid_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="nid_pic_font" class="form-label">NID Front Image</label>
                            <input type="file" class="form-control" id="nid_pic_font" name="nid_pic_font">
                        </div>
                        <div class="mb-3">
                            <label for="nid_pic_back" class="form-label">NID Back Image</label>
                            <input type="file" class="form-control" id="nid_pic_back" name="nid_pic_back">
                        </div>
                        <div class="mb-3">
                            <label for="pic" class="form-label">Client Photo</label>
                            <input type="file" class="form-control" id="pic" name="pic">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Information -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">Address Information</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="present_district" class="form-label">Present District</label>
                            <input type="text" class="form-control" id="present_district" name="present_district" required>
                        </div>
                        <div class="mb-3">
                            <label for="present_upazila" class="form-label">Present Upazila</label>
                            <input type="text" class="form-control" id="present_upazila" name="present_upazila" required>
                        </div>
                        <div class="mb-3">
                            <label for="present_village" class="form-label">Present Village</label>
                            <input type="text" class="form-control" id="present_village" name="present_village">
                        </div>
                        <div class="mb-3">
                            <label for="present_postcode" class="form-label">Present Postcode</label>
                            <input type="text" class="form-control" id="present_postcode" name="present_postcode">
                        </div>
                        <div class="mb-3">
                            <label for="permanent_district" class="form-label">Permanent District</label>
                            <input type="text" class="form-control" id="permanent_district" name="permanent_district" required>
                        </div>
                        <div class="mb-3">
                            <label for="permanent_upazila" class="form-label">Permanent Upazila</label>
                            <input type="text" class="form-control" id="permanent_upazila" name="permanent_upazila" required>
                        </div>
                        <div class="mb-3">
                            <label for="permanent_village" class="form-label">Permanent Village</label>
                            <input type="text" class="form-control" id="permanent_village" name="permanent_village">
                        </div>
                        <div class="mb-3">
                            <label for="permanent_postcode" class="form-label">Permanent Postcode</label>
                            <input type="text" class="form-control" id="permanent_postcode" name="permanent_postcode">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loan Information -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Loan Information</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="loan_amount" class="form-label">Loan Amount</label>
                    <input type="number" class="form-control" id="loan_amount" name="loan_amount" required>
                </div>
                <div class="mb-3">
                    <label for="loan_type" class="form-label">Loan Type</label>
                    <select class="form-control" id="loan_type" name="loan_type" required>
                        <option value="personal">Personal</option>
                        <option value="business">Business</option>
                        <option value="home">Home</option>
                        <option value="education">Education</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="purpose" class="form-label">Purpose</label>
                    <textarea class="form-control" id="purpose" name="purpose"></textarea>
                </div>
                <div class="mb-3">
                    <label for="loan_start_date" class="form-label">Loan Start Date</label>
                    <input type="date" class="form-control" id="loan_start_date" name="loan_start_date" required>
                </div>
                <div class="mb-3">
                    <label for="loan_status" class="form-label">Loan Status</label>
                    <select class="form-control" id="loan_status" name="loan_status">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="loan_applied_date" class="form-label">Loan Applied Date</label>
                    <input type="date" class="form-control" id="loan_applied_date" name="loan_applied_date" required>
                </div>
                <div class="mb-3">
                    <label for="loan_approved_date" class="form-label">Loan Approved Date</label>
                    <input type="date" class="form-control" id="loan_approved_date" name="loan_approved_date">
                </div>
            </div>
        </div>

        <!-- Guarantor Information -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Guarantor Information</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="guarantor_name" class="form-label">Guarantor Name</label>
                    <input type="text" class="form-control" id="guarantor_name" name="guarantor_name" required>
                </div>
                <div class="mb-3">
                    <label for="guarantor_nid" class="form-label">Guarantor NID</label>
                    <input type="text" class="form-control" id="guarantor_nid" name="guarantor_nid" required>
                </div>
                <div class="mb-3">
                    <label for="guarantor_nid_pic_font" class="form-label">Guarantor NID Front Image</label>
                    <input type="file" class="form-control" id="guarantor_nid_pic_font" name="guarantor_nid_pic_font">
                </div>
                <div class="mb-3">
                    <label for="guarantor_nid_pic_back" class="form-label">Guarantor NID Back Image</label>
                    <input type="file" class="form-control" id="guarantor_nid_pic_back" name="guarantor_nid_pic_back">
                </div>
                <div class="mb-3">
                    <label for="guarantor_address" class="form-label">Guarantor Address</label>
                    <textarea class="form-control" id="guarantor_address" name="guarantor_address" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="guarantor_occupation" class="form-label">Guarantor Occupation</label>
                    <input type="text" class="form-control" id="guarantor_occupation" name="guarantor_occupation" required>
                </div>
                <div class="mb-3">
                    <label for="guarantor_monthly_income" class="form-label">Guarantor Monthly Income</label>
                    <input type="number" class="form-control" id="guarantor_monthly_income" name="guarantor_monthly_income">
                </div>
                <div class="mb-3">
                    <label for="guarantor_phone_number" class="form-label">Guarantor Phone Number</label>
                    <input type="text" class="form-control" id="guarantor_phone_number" name="guarantor_phone_number" required>
                </div>
                <div class="mb-3">
                    <label for="guarantor_email" class="form-label">Guarantor Email</label>
                    <input type="email" class="form-control" id="guarantor_email" name="guarantor_email">
                </div>
                <div class="mb-3">
                    <label for="guarantor_pic" class="form-label">Guarantor Photo</label>
                    <input type="file" class="form-control" id="guarantor_pic" name="guarantor_pic">
                </div>
                <div class="mb-3">
                    <label for="guarantor_relation" class="form-label">Guarantor Relation</label>
                    <input type="text" class="form-control" id="guarantor_relation" name="guarantor_relation" required>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Additional Information</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="has_previous_loan" class="form-label">Has Previous Loan?</label>
                    <select class="form-control" id="has_previous_loan" name="has_previous_loan">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="insurance_taken" class="form-label">Insurance Taken?</label>
                    <select class="form-control" id="insurance_taken" name="insurance_taken">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <input type="number" class="form-control" id="status" name="status">
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
