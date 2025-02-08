{{-- @extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header w-36 h-11">
        Edit Client
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('fail'))
        <div class="alert alert-danger">
            {{ session()->get('fail') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/client/update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="{{ $record->id }}" name="id">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{ $record->name }}" name="name" class="form-control" id="name" placeholder="Enter Name">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="{{ $record->email }}" name="email" class="form-control" id="email" placeholder="Enter Email">
        </div>

        <div class="form-group">
            <label for="number">Mobile</label>
            <input type="number" value="{{ $record->number }}" name="number" class="form-control" id="number" placeholder="Enter Mobile Number">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" value="{{ $record->address }}" name="address" class="form-control" id="address" placeholder="address">
        </div>

        <div class="form-group">
            <label for="pic">Image</label>
            <input type="file" name="pic" class="form-control" id="pic" placeholder="Input an Image">
            <img src="{{ asset('images/' . $record->pic) }}" alt="img" width="50" height="50">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
</div>
@endsection --}}


@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
        {{ isset($record) ? 'Edit Client' : 'Create New Client' }}
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('fail'))
        <div class="alert alert-danger">
            {{ session()->get('fail') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ isset($record) ? url('/client/update') : url('/client/store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($record))
            <input type="hidden" value="{{ $record->id }}" name="id">
        @endif

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{ $record->name ?? '' }}" name="name" class="form-control" id="name" placeholder="Enter Name">
        </div>

        <div class="form-group">
            <label for="father_name">Father's Name</label>
            <input type="text" value="{{ $record->father_name ?? '' }}" name="father_name" class="form-control" id="father_name" placeholder="Enter Father's Name">
        </div>

        <div class="form-group">
            <label for="mother_name">Mother's Name</label>
            <input type="text" value="{{ $record->mother_name ?? '' }}" name="mother_name" class="form-control" id="mother_name" placeholder="Enter Mother's Name">
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" value="{{ $record->phone_number ?? '' }}" name="phone_number" class="form-control" id="phone_number" placeholder="Enter Phone Number">
        </div>

        <div class="form-group">
            <label for="date_of_birth">Date of Birth</label>
            <input type="date" value="{{ $record->date_of_birth ?? '' }}" name="date_of_birth" class="form-control" id="date_of_birth">
        </div>

        <div class="form-group">
            <label for="nid_number">NID Number</label>
            <input type="text" value="{{ $record->nid_number ?? '' }}" name="nid_number" class="form-control" id="nid_number" placeholder="Enter NID Number">
        </div>

        <div class="form-group">
            <label for="nid_pic_font">NID Front Picture</label>
            <input type="file" name="nid_pic_font" class="form-control" id="nid_pic_font">
            @if(isset($record) && $record->nid_pic_font)
                <img src="{{ asset($record->nid_pic_font) }}" alt="NID Front" width="50" height="50">
            @endif
        </div>

        <div class="form-group">
            <label for="nid_pic_back">NID Back Picture</label>
            <input type="file" name="nid_pic_back" class="form-control" id="nid_pic_back">
            @if(isset($record) && $record->nid_pic_back)
                <img src="{{ asset($record->nid_pic_back) }}" alt="NID Back" width="50" height="50">
            @endif
        </div>

        <div class="form-group">
            <label for="occupation">Occupation</label>
            <input type="text" value="{{ $record->occupation ?? '' }}" name="occupation" class="form-control" id="occupation" placeholder="Enter Occupation">
        </div>

        <div class="form-group">
            <label for="monthly_income">Monthly Income</label>
            <input type="number" value="{{ $record->monthly_income ?? '' }}" name="monthly_income" class="form-control" id="monthly_income" placeholder="Enter Monthly Income">
        </div>

        <div class="form-group">
            <label for="present_district">Present District</label>
            <input type="text" value="{{ $record->present_district ?? '' }}" name="present_district" class="form-control" id="present_district" placeholder="Enter Present District">
        </div>

        <div class="form-group">
            <label for="present_upazila">Present Upazila</label>
            <input type="text" value="{{ $record->present_upazila ?? '' }}" name="present_upazila" class="form-control" id="present_upazila" placeholder="Enter Present Upazila">
        </div>

        <div class="form-group">
            <label for="present_village">Present Village</label>
            <input type="text" value="{{ $record->present_village ?? '' }}" name="present_village" class="form-control" id="present_village" placeholder="Enter Present Village">
        </div>

        <div class="form-group">
            <label for="present_postcode">Present Postcode</label>
            <input type="text" value="{{ $record->present_postcode ?? '' }}" name="present_postcode" class="form-control" id="present_postcode" placeholder="Enter Present Postcode">
        </div>

        <div class="form-group">
            <label for="permanent_district">Permanent District</label>
            <input type="text" value="{{ $record->permanent_district ?? '' }}" name="permanent_district" class="form-control" id="permanent_district" placeholder="Enter Permanent District">
        </div>

        <div class="form-group">
            <label for="permanent_upazila">Permanent Upazila</label>
            <input type="text" value="{{ $record->permanent_upazila ?? '' }}" name="permanent_upazila" class="form-control" id="permanent_upazila" placeholder="Enter Permanent Upazila">
        </div>

        <div class="form-group">
            <label for="permanent_village">Permanent Village</label>
            <input type="text" value="{{ $record->permanent_village ?? '' }}" name="permanent_village" class="form-control" id="permanent_village" placeholder="Enter Permanent Village">
        </div>

        <div class="form-group">
            <label for="permanent_postcode">Permanent Postcode</label>
            <input type="text" value="{{ $record->permanent_postcode ?? '' }}" name="permanent_postcode" class="form-control" id="permanent_postcode" placeholder="Enter Permanent Postcode">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" value="{{ $record->email ?? '' }}" name="email" class="form-control" id="email" placeholder="Enter Email">
        </div>

        <div class="form-group">
            <label for="number">Mobile Number</label>
            <input type="text" value="{{ $record->number ?? '' }}" name="number" class="form-control" id="number" placeholder="Enter Mobile Number">
        </div>

        <div class="form-group">
            <label for="emergency_contact_name">Emergency Contact Name</label>
            <input type="text" value="{{ $record->emergency_contact_name ?? '' }}" name="emergency_contact_name" class="form-control" id="emergency_contact_name" placeholder="Enter Emergency Contact Name">
        </div>

        <div class="form-group">
            <label for="pic">Profile Picture</label>
            <input type="file" name="pic" class="form-control" id="pic">
            @if(isset($record) && $record->pic)
                <img src="{{ asset($record->pic) }}" alt="Profile Picture" width="50" height="50">
            @endif
        </div>

        <div class="form-group">
            <label for="guarantor_name">Guarantor Name</label>
            <input type="text" value="{{ $record->guarantor_name ?? '' }}" name="guarantor_name" class="form-control" id="guarantor_name" placeholder="Enter Guarantor Name">
        </div>

        <div class="form-group">
            <label for="guarantor_nid">Guarantor NID</label>
            <input type="text" value="{{ $record->guarantor_nid ?? '' }}" name="guarantor_nid" class="form-control" id="guarantor_nid" placeholder="Enter Guarantor NID">
        </div>

        <div class="form-group">
            <label for="guarantor_nid_pic_font">Guarantor NID Front Picture</label>
            <input type="file" name="guarantor_nid_pic_font" class="form-control" id="guarantor_nid_pic_font">
            @if(isset($record) && $record->guarantor_nid_pic_font)
                <img src="{{ asset($record->guarantor_nid_pic_font) }}" alt="Guarantor NID Front" width="50" height="50">
            @endif
        </div>

        <div class="form-group">
            <label for="guarantor_nid_pic_back">Guarantor NID Back Picture</label>
            <input type="file" name="guarantor_nid_pic_back" class="form-control" id="guarantor_nid_pic_back">
            @if(isset($record) && $record->guarantor_nid_pic_back)
                <img src="{{ asset($record->guarantor_nid_pic_back) }}" alt="Guarantor NID Back" width="50" height="50">
            @endif
        </div>

        <div class="form-group">
            <label for="guarantor_address">Guarantor Address</label>
            <input type="text" value="{{ $record->guarantor_address ?? '' }}" name="guarantor_address" class="form-control" id="guarantor_address" placeholder="Enter Guarantor Address">
        </div>

        <div class="form-group">
            <label for="guarantor_occupation">Guarantor Occupation</label>
            <input type="text" value="{{ $record->guarantor_occupation ?? '' }}" name="guarantor_occupation" class="form-control" id="guarantor_occupation" placeholder="Enter Guarantor Occupation">
        </div>

        <div class="form-group">
            <label for="guarantor_monthly_income">Guarantor Monthly Income</label>
            <input type="number" value="{{ $record->guarantor_monthly_income ?? '' }}" name="guarantor_monthly_income" class="form-control" id="guarantor_monthly_income" placeholder="Enter Guarantor Monthly Income">
        </div>

        <div class="form-group">
            <label for="guarantor_phone_number">Guarantor Phone Number</label>
            <input type="text" value="{{ $record->guarantor_phone_number ?? '' }}" name="guarantor_phone_number" class="form-control" id="guarantor_phone_number" placeholder="Enter Guarantor Phone Number">
        </div>

        <div class="form-group">
            <label for="guarantor_email">Guarantor Email</label>
            <input type="email" value="{{ $record->guarantor_email ?? '' }}" name="guarantor_email" class="form-control" id="guarantor_email" placeholder="Enter Guarantor Email">
        </div>

        <div class="form-group">
            <label for="guarantor_pic">Guarantor Picture</label>
            <input type="file" name="guarantor_pic" class="form-control" id="guarantor_pic">
            @if(isset($record) && $record->guarantor_pic)
                <img src="{{ asset($record->guarantor_pic) }}" alt="Guarantor Picture" width="50" height="50">
            @endif
        </div>

        <div class="form-group">
            <label for="guarantor_relation">Guarantor Relation</label>
            <input type="text" value="{{ $record->guarantor_relation ?? '' }}" name="guarantor_relation" class="form-control" id="guarantor_relation" placeholder="Enter Guarantor Relation">
        </div>

        <button type="submit" class="btn btn-primary mt-3">{{ isset($record) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
