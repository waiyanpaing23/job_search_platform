@extends('employer.layouts.master')

@section('title', 'Application Review')

@section('content')
    <div class="container-fluid p-5">
        <h4 class="fw-bold mb-4">Application Review</h4>
        <div class="row">
            <div class="col">
                <div class="border rounded px-5 py-4 shadow-sm bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-4">Applicant Overview</h5>
                        @if ($application->status === 'Pending')
                            <form action="{{ route('applicant.status.update', $application->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="Reviewed">
                                <button type="submit" class="btn pink me-3 px-5">Move to Under Review</button>
                            </form>
                        @endif

                        @if ($application->status === 'Reviewed')
                            <div class="d-flex">
                                <form action="{{ route('applicant.status.update', $application->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="Rejected">
                                    <button type="submit" class="btn btn-danger me-3 px-5">Reject</button>
                                </form>
                                <form action="{{ route('applicant.status.update', $application->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="Interview">
                                    <button type="submit" class="btn pink">Move to Interview</button>
                                </form>
                            </div>
                        @endif

                        @if ($application->status === 'Interview')
                            <div class="d-flex">
                                <form action="{{ route('applicant.status.update', $application->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="Rejected">
                                    <button type="submit" class="btn btn-danger px-5 me-3">Reject</button>
                                </form>
                                <form action="{{ route('applicant.status.update', $application->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="Rejected">
                                    <button type="submit" class="btn pink px-5">Hire</button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="">
                            <img src="{{ $application->applicant->user->profile_image ? asset('images/' . $application->applicant->user->profile_image) : asset('images/profile.jpg') }}"
                                class="img-fluid rounded-circle profile my-4"><br>
                        </div>
                        <div class="ms-5">
                            <h5><b>{{ $application->applicant->user->first_name . ' ' . $application->applicant->user->last_name }}</b></h5>
                            <span class="text-muted d-block">{{ $application->email }}</span>
                            <span class="text-muted d-block">{{ $application->phone }}</span>
                            @if ($application->applicant->address)
                            <div class="mt-2">
                                <span class="company-info me-1">{{ $application->applicant->address }}</span>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-8">
                <div class="border rounded px-5 py-4 shadow-sm bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div>
                                <img src="{{ asset('images/' . $application->job->employer->company->company_logo) }}"
                                    class="logo-detail">
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
                    </div>

                </div>
            </div>
            <div class="col-4">
                <div class="border rounded px-5 py-4 shadow-sm bg-white d-flex flex-column align-items-center">
                    <h5 class="fw-bold">Application Status</h5>
                    <span class="bg-cyan px-4 py-2 mt-3 h5 rounded-pill">
                        {{ $application->status }}
                    </span>
                    <span class="d-block mt-2">Submitted on:
                        {{ \Carbon\Carbon::parse($application->created_at)->format('d-m-Y') }}</span>
                </div>
            </div>
        </div>

        <div class="border rounded px-5 py-4 mt-4 shadow-sm bg-white">
            <h5 class="fw-bold mb-4"> Submitted Application</h5>
            <div class="row">
                <div class="col-4">
                    <span class="text-muted">Name</span>
                    <h6 class="mt-1 mb-3">{{ $application->first_name }} {{ $application->last_name }}</h6>

                    <span class="text-muted">Email Address</span>
                    <h6 class="mt-1 mb-3">{{ $application->email }}</h6>

                    <span class="text-muted">Contact Phone</span>
                    <h6 class="mt-1 mb-3">{{ $application->phone }}</h6>
                </div>

                <div class="col-4">
                    <span class="text-muted">Portfolio URL</span>
                    <a href="{{ $application->portfolio_link }}" class="mb-3 text-decoration-none text-black mt-1">
                        <h6>{{ $application->portfolio_link ? $application->portfolio_link : '-' }}</h6>
                    </a>

                    <span class="text-muted d-block">Expected Salary</span>
                    <h6 class="mt-1 mb-3">{{ $application->currency }}
                        {{ $application->expected_salary ? $application->expected_salary : '-' }}</h6>
                </div>

                <div class="col-4 ">
                    <span class="text-muted d-block">Resume</span>
                    <p class="fw-bold">{{ $application->resume }}</p>
                    <a href="{{ Storage::url($application->resume) }}" class="text-decoration-none text-black" download>
                        <span class=" border border-secondary rounded px-3 py-2">Download Resume <i
                                class="fa-solid fa-download"></i></span>
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

    </div>
@endsection
