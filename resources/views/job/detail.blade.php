@php
    $layout = 'layouts.master';

    if (Auth::check() && Auth::user()->role) {
        switch (Auth::user()->role) {
            case 'employer':
                $layout = 'employer.layouts.master';
                break;
            case 'admin':
                $layout = 'admin.layouts.master';
                break;
        }
    }
@endphp

@extends($layout)

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-10 py-5">

            <div class="border rounded px-5 py-4 shadow-sm bg-white">

                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex">
                        <div>
                            <img src="{{ asset('images/' . $job->employer->company->company_logo) }}" class="logo-detail">
                        </div>
                        <div class="ms-5">
                            <h4><b>{{ $job->job_title }}</b></h4>
                            <span class="text-muted">{{ $job->employer->company->company_name }}</span>

                            <div class="mt-2">
                                <i class="fa-solid fa-location-dot me-2 text-muted"></i><span
                                    class="text-muted me-3">{{ $job->location }}</span>
                                <i class="fa-solid fa-briefcase me-2 text-muted"></i><span
                                    class="text-muted">{{ $job->job_type }}</span>
                            </div>

                        </div>
                    </div>

                    <a href="" class="btn pink">Apply Now</a>
                </div>

            </div>

            <div class="row">
                <div class="col-8 pe-5">
                    <h4 class="mt-5 mb-4"><b>Job Description</b></h4>

                    <span>{{ $job->description }}</span>

                    <hr class="my-5">

                    <div>
                        <h4 class="mb-4"><b>Requirements</b></h4>
                        @foreach ($requirements as $requirement)
                            <ul>
                                <li>{{ $requirement }}</li>
                            </ul>
                        @endforeach
                    </div>

                    <div class="mt-5">
                        <h4 class="mb-4"><b>Benefits</b></h4>
                        @foreach ($benefits as $benefit)
                            <ul>
                                <li>{{ $benefit }}</li>
                            </ul>
                        @endforeach
                    </div>
                </div>

                <div class="col-4">
                    <div class="mt-4 border bg-white shadow-sm rounded p-3">
                        <i class="fa-solid fa-building text-muted me-4"></i><span>{{ $job->category->category }}</span> <br>
                        <i class="fa-solid fa-calendar text-muted me-4 mt-4"></i><span>Application Deadline -
                            {{ \Carbon\Carbon::parse($job->expiry_date)->format('d/m/Y') }}
                        </span> <br>
                        <i class="fa-solid fa-coins text-muted me-4 mt-4"></i><span>{{ $job->currency }}
                            {{ $job->min_salary }}-{{ $job->max_salary }} {{ $job->salary_type }}</span>
                        <br>

                        <p class="text-muted mt-4">Posted on {{ \Carbon\Carbon::parse($job->created_at)->format('d/m/Y') }}
                        </p>
                    </div>

                    <div class="mt-4 border shadow-sm bg-white rounded p-4">
                        <h5><b>Company Overview</b></h5>
                        <img src="{{ asset('images/' . $job->employer->company->company_logo) }}" class="logo-detail my-2">
                        <h5>{{ $job->employer->company->company_name }}</h5>
                        <p class="text-muted">{{$job->employer->company->industry }}</p>
                        <a href="{{ route('company.detail', $job->employer->company->id) }}" class="btn pink w-100">View Company Profile</a>
                    </div>

                    <div class="mt-4 border shadow-sm bg-white rounded p-3">
                        <h5 class="mb-4"><b>Related Jobs</b></h5>
                        @foreach ($related_jobs as $index => $job)
                            <a href="{{ route('job.detail', $job->id) }}" class="text-decoration-none text-dark link">
                                <h5>{{ $job->job_title }}</h5>
                            </a>

                            <p class="text-muted">{{$job->employer->company->company_name}}</p>

                            <i class="fa-solid fa-location-dot me-2 text-muted"></i><span
                                class="text-muted me-3">{{ $job->location }}</span>
                            <i class="fa-solid fa-briefcase me-2 text-muted"></i><span
                                class="text-muted">{{ $job->job_type }}</span>

                            @if ($index !== $related_jobs->count() - 1)
                                <hr class="my-4">
                            @endif

                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
