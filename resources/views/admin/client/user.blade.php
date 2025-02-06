@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Client Full Information</h2>

    <!-- Status Highlight -->
    <div class="text-center mb-3">
        <h4>Status:</h4>
@if ($client->status == 'pending')
    <span class="badge bg-warning text-dark px-3 py-1 rounded">⏳ Pending</span>
    <p class="text-warning mt-2 fw-bold">⚠️ Waiting for approval by Admin</p>

@elseif ($client->status == 'approved')
    <span class="badge bg-success text-white px-3 py-1 rounded">✅ Approved</span>
    <p class="text-success mt-2 fw-bold">🎉 Successfully reviewed by Admin. Now you can apply for a loan.</p>

@elseif ($client->status == 'rejected')
    <span class="badge bg-danger text-white px-3 py-1 rounded">❌ Rejected</span>
    <p class="text-danger mt-2 fw-bold">🚫 Application denied. Please contact our company.</p>

@else
    <span class="badge bg-secondary text-white px-3 py-1 rounded">❓ Unknown Status</span>
    <p class="text-secondary mt-2 fw-bold">ℹ️ Status not recognized.</p>
@endif


    </div>

    <div class="accordion" id="clientAccordion">
        <!-- Personal Information -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#personalInfo">
                    Personal Information
                </button>
            </h2>
            <div id="personalInfo" class="accordion-collapse collapse show" data-bs-parent="#clientAccordion">
                <div class="accordion-body">
                    <p><strong>Name:</strong> {{ $client->name }}</p>
                    <p><strong>Father's Name:</strong> {{ $client->father_name }}</p>
                    <p><strong>Mother's Name:</strong> {{ $client->mother_name }}</p>
                    <p><strong>Phone Number:</strong> {{ $client->phone_number }}</p>
                    <p><strong>Date of Birth:</strong> {{ $client->date_of_birth }}</p>
                    <p><strong>NID Number:</strong> {{ $client->nid_number }}</p>
                    <p><strong>Occupation:</strong> {{ $client->occupation }}</p>
                    <p><strong>Monthly Income:</strong> {{ $client->monthly_income }}</p>
                    <p><strong>Email:</strong> {{ $client->email }}</p>
                </div>
            </div>
        </div>

        <!-- Address Information -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#addressInfo">
                    Address Information
                </button>
            </h2>
            <div id="addressInfo" class="accordion-collapse collapse" data-bs-parent="#clientAccordion">
                <div class="accordion-body">
                    <h5>Present Address</h5>
                    <p><strong>District:</strong> {{ $client->present_district }}</p>
                    <p><strong>Upazila:</strong> {{ $client->present_upazila }}</p>
                    <p><strong>Village:</strong> {{ $client->present_village }}</p>
                    <p><strong>Postcode:</strong> {{ $client->present_postcode }}</p>

                    <h5>Permanent Address</h5>
                    <p><strong>District:</strong> {{ $client->permanent_district }}</p>
                    <p><strong>Upazila:</strong> {{ $client->permanent_upazila }}</p>
                    <p><strong>Village:</strong> {{ $client->permanent_village }}</p>
                    <p><strong>Postcode:</strong> {{ $client->permanent_postcode }}</p>
                </div>
            </div>
        </div>

        <!-- Guarantor Information -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#guarantorInfo">
                    Guarantor Information
                </button>
            </h2>
            <div id="guarantorInfo" class="accordion-collapse collapse" data-bs-parent="#clientAccordion">
                <div class="accordion-body">
                    <p><strong>Guarantor Name:</strong> {{ $client->guarantor_name }}</p>
                    <p><strong>Guarantor NID:</strong> {{ $client->guarantor_nid }}</p>
                    <p><strong>Guarantor Address:</strong> {{ $client->guarantor_address }}</p>
                    <p><strong>Guarantor Occupation:</strong> {{ $client->guarantor_occupation }}</p>
                    <p><strong>Guarantor Monthly Income:</strong> {{ $client->guarantor_monthly_income }}</p>
                    <p><strong>Guarantor Phone:</strong> {{ $client->guarantor_phone_number }}</p>
                    <p><strong>Guarantor Email:</strong> {{ $client->guarantor_email }}</p>
                    <p><strong>Guarantor Relation:</strong> {{ $client->guarantor_relation }}</p>
                </div>
            </div>
        </div>

        <!-- Emergency Contact -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#emergencyContact">
                    Emergency Contact
                </button>
            </h2>
            <div id="emergencyContact" class="accordion-collapse collapse" data-bs-parent="#clientAccordion">
                <div class="accordion-body">
                    <p><strong>Emergency Contact Name:</strong> {{ $client->emergency_contact_name }}</p>
                    <p><strong>Phone Number:</strong> {{ $client->number }}</p>
                </div>
            </div>
        </div>

        <!-- Other Information -->
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#otherInfo">
                    Other Information
                </button>
            </h2>
            <div id="otherInfo" class="accordion-collapse collapse" data-bs-parent="#clientAccordion">
                <div class="accordion-body">
                    <p><strong>Created By (User ID):</strong> {{ $client->creator }}</p>
                    <p><strong>Last Edited By (User ID):</strong> {{ $client->editor }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
