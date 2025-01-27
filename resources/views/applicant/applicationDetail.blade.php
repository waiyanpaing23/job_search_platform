@extends('layouts.master')

@section('title', 'Application Overview')

@section('content')

<div class="container-fluid p-5">
    <div class="p-2">
        <h4 class="fw-bold mb-4">Application Overview</h4>
        <div class="border rounded px-5 py-4 shadow-sm bg-white">
            <div class="d-flex justify-content-between align-items-center md-block">
                <div class="d-flex align-items-center md-block">
                    <div>
                        <img src="{{ asset('images/' . $application->job->employer->company->company_logo) }}" class="logo-detail">
                    </div>
                    <div class="ms-5">
                        <h4><b>{{ $application->job->job_title }}</b></h4>
                        <span class="text-muted">{{ $application->job->employer->company->company_name }}</span>

                        <div class="mt-2">
                            <i class="fa-solid fa-location-dot me-2 text-muted"></i><span
                                class="text-muted me-3">{{ $application->job->location }}</span>
                            <i class="fa-solid fa-briefcase me-2 text-muted"></i><span
                                class="text-muted">{{ $application->job->job_type }}</span>
                        </div>
                        <div class="mt-2">
                            <span class="company-info me-1">{{ $application->job->category->category }}</span>
                        </div>

                    </div>
                </div>

                <div class="d-flex flex-column align-items-center pt-3">
                    @if ($application->status == 'Withdrawn')
                    <span class="bg-secondary text-white px-4 py-2 mb-3 h6 rounded-pill">
                        {{ $application->status }}
                    </span>
                    @else
                    <span class="bg-cyan px-4 py-2 mb-3 h6 rounded-pill">
                        {{ $application->status }}
                    </span>
                    @endif
                    <span class="d-block mt-3">Submitted on: {{ \Carbon\Carbon::parse($application->created_at)->format('d-m-Y') }}</span>
                </div>
            </div>

        </div>

        <div class="border rounded px-5 py-4 mt-4 shadow-sm bg-white">
            <h5 class="fw-bold mb-4"> Submitted Application</h5>
            <div class="row">
                <div class="col-md-4">
                    <span class="text-muted">Name</span>
                    <h6 class="mt-1 mb-3">{{ $application->first_name }} {{ $application->last_name }}</h6>

                    <span class="text-muted">Email Address</span>
                    <h6 class="mt-1 mb-3">{{ $application->email }}</h6>

                    <span class="text-muted">Contact Phone</span>
                    <h6 class="mt-1 mb-3">{{ $application->phone }}</h6>
                </div>

                <div class="col-md-4">
                    <span class="text-muted">Portfolio URL</span>
                    <a href="{{ $application->portfolio_link }}" class="mb-3 text-decoration-none text-black mt-1">
                        <h6>{{ $application->portfolio_link?$application->portfolio_link : "-" }}</h6>
                    </a>

                    <span class="text-muted d-block">Expected Salary</span>
                    <h6 class="mt-1 mb-3">{{ $application->currency }} {{ $application->expected_salary?$application->expected_salary:"-"}}</h6>
                </div>

                <div class="col-md-4 ">
                    <span class="text-muted d-block">Resume</span>
                    <p class="fw-bold">{{ $application->resume }}</p>
                    <a href="{{ Storage::url($application->resume) }}" class="text-decoration-none text-black" download>
                        <span class=" border border-secondary rounded px-3 py-2">Download Resume <i class="fa-solid fa-download"></i></span>
                    </a>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col">
                    <span class="text-muted">Cover Letter</span>
                    <textarea rows="5" class="form-control fw-semibold rounded w-100 px-3 mt-2 mb-3" disabled>{{ $application->coverletter }}</textarea>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col">
                    <span class="text-muted">Why are you interested in this position?</span>
                    <textarea rows="4" class="form-control fw-semibold rounded w-100 px-3 mt-2" disabled>{{ $application->interest }}</textarea>
                </div>
            </div>


        </div>
        @if ($application->status == 'Pending')
            <div class="d-flex justify-content-end">
                <a href="{{ route('application.withdraw', $application->id) }}" class="btn pink mt-3 px-5"
                    onclick="return confirm('Are you sure to withdraw this application?')">Withdraw Application</a>
            </div>
        @endif
    </div>

</div>

@endsection
