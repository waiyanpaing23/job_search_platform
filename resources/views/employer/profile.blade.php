@extends('employer/layouts/master')

@section('title')
    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} - Employer Profile
@endsection

@section('content')
    <div class="container-fluid p-5">

        <div class="row d-flex justify-content-center">

            <div class="col-12 col-lg-8">

                <h4 class="mb-4"><b>Employer Profile</b></h4>

                <div class="p-4 shadow-sm rounded bg-white">
                    <div class="row">

                        <div class="row">
                            <div class="col">
                                <h5><b>Personal Information</b></h5>
                            </div>

                            @if (Auth::user())
                                <div class="col d-flex justify-content-end">
                                    <a href="{{ route('employer.profile.edit') }}" class="btn pink mb-4">Edit Profile</a>
                                </div>
                            @endif
                        </div>

                        <div class="row d-flex align-items-center">
                            <div class="col-md-2">
                                <img src="{{ Auth::user()->profile_image ? asset('images/' . Auth::user()->profile_image) : asset('images/profile.jpg') }}"
                                    class="img-fluid rounded-circle profile my-4"><br>
                            </div>
                            <div class="col">
                                <h5><b>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</b></h5>
                                <p class="text-muted">{{ $employer?->position ? $employer?->position : '' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-1 fw-semibold">First Name</label>
                            <input type="text" value="{{ Auth::user()->first_name }}"
                                class="input-box rounded w-100 px-3 mb-4" disabled>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-1 fw-semibold">Last Name</label>
                            <input type="text" value="{{ Auth::user()->last_name }}"
                                class="input-box rounded w-100 px-3 mb-4" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-1 fw-semibold">Job Position</label>
                            <input type="text" value="{{ $employer?->position ? $employer?->position : '' }}"
                                class="input-box rounded w-100 px-3 mb-4" disabled>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-1 fw-semibold">Personal Email</label>
                            <input type="text" value="{{ Auth::user()->email }}"
                                class="input-box rounded w-100 px-3 mb-4" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-1 fw-semibold">Phone Number</label>
                            <input type="text" value="{{ $employer?->phone ? $employer->phone : '' }}"
                                class="input-box rounded w-100 px-3 mb-4" disabled>
                        </div>
                    </div>

                </div>

                @if ($employer?->company_id === null)
                    <div class="p-4 shadow-sm rounded mt-4 bg-white">
                        <div class="row">
                            <div class="col">
                                <h5 class="mb-4"><b>Company Profile</b></h5>

                                <p class="text-muted">You have not link to any company profile yet.</p>

                                <div class="row">
                                    <div class="col-12 col-sm-6 p-2">
                                        <a href="{{ route('company.create') }}" class="text-decoration-none text-dark">
                                            <div class="d-flex justify-content-center rounded border p-3">
                                                <h4 class="me-2"><i class="fa-solid fa-plus"></i></h4>
                                                <h6 class="mt-2"><b>Create New Company Profile</b></h6>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-12 col-sm-6 p-2">
                                        <a href="{{ route('employer.company.search') }}"
                                            class="text-decoration-none text-dark">
                                            <div class="d-flex justify-content-center rounded border p-3">
                                                <h4 class="me-2"><i class="fa-solid fa-magnifying-glass"></i></h4>
                                                <h6 class="mt-2"><b>Search for an Existing Company</b></h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="p-4 shadow-sm rounded mt-4 bg-white">
                        <div class="row d-flex justify-content-center">
                            @if ($employer?->company->status === 'Pending')
                                <div class="px-4 alert alert-warning">
                                    <h6 class="alert-heading">Your Company is Under Review.</h6>
                                    <p>Your company, {{ $employer->company->company_name }}, is currently under review by
                                        our
                                        administrators. Once approved, you will be able to post jobs and access all
                                        features.
                                    </p>
                                </div>
                            @elseif($employer?->company->status === 'Rejected')
                                <div class="px-4 alert alert-light border border-danger">
                                    <h6 class="alert-heading text-danger">Your Company has been Rejected.</h6>
                                    <p class="text-danger">Your company profile, {{ $employer->company->company_name }},
                                        has been rejected. Please update your information, then resubmit your profile.
                                    </p>
                                </div>
                            @endif
                            <div class="row pt-4">
                                <div class="col">
                                    <h4><b>Company Profile</b></h4>
                                </div>

                                @if ($employer?->company->status !== 'Rejected')
                                    <div class="col d-flex justify-content-end">
                                        <a href="{{ route('company.edit') }}" class="btn pink mb-4">Edit Company</a>
                                    </div>
                                @endif
                            </div>

                            <div class="row d-flex align-items-center">
                                <div class="col-12 col-sm-2">
                                    <img src="{{ asset('images/' . $employer->company->company_logo) }}"
                                        class="img-fluid rounded bg-primary my-4"><br>
                                </div>
                                <div class="col">
                                    <a href="{{ route('company.detail', $employer->company->id) }}"
                                        class="text-decoration-none link text-black">
                                        <h5><b>{{ $employer->company->company_name }}</b></h5>
                                    </a>
                                    <p class="text-muted">{{ $employer->company->industry }} Company</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Name</label>
                                <input type="text" value="{{ $employer->company->company_name }}"
                                    class="input-box rounded w-100 px-3 mb-3" disabled>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Industry</label>
                                <input type="text" value="{{ $employer->company->industry }}"
                                    class="input-box rounded w-100 px-3 mb-3" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="name" class="mb-1 fw-semibold">Company Description</label>
                                <textarea class="rounded w-100 px-3 mb-3" rows="4" disabled>{{ $employer->company->company_description }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Website</label>
                                <input type="text" value="{{ $employer->company->website_url }}"
                                    class="input-box rounded w-100 px-3 mb-3" disabled>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Location</label>
                                <input type="text" value="{{ $employer->company->location }}"
                                    class="input-box rounded w-100 px-3 mb-3" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Contact Email</label>
                                <input type="text" value="{{ $employer->company->contact_email }}"
                                    class="input-box rounded w-100 px-3 mb-3" disabled>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Phone Number</label>
                                <input type="text" value="{{ $employer->company->phone }}"
                                    class="input-box rounded w-100 px-3 mb-3" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">No. of Employers</label>
                                <input type="text" value="{{ $employer->company->company_size }}"
                                    class="input-box rounded w-100 px-3 mb-3" disabled>
                            </div>
                        </div>

                        @if ($employer?->company->status === 'Rejected')
                            <div class="row">
                                <div class="col d-flex justify-content-end">
                                    <a href="{{ route('company.edit') }}" class="btn pink mb-4">Edit and Resubmit</a>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
