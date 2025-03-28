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

@section('title')
    {{ $company?->company_name }} - Company Detail
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-11 col-md-8 py-5">

            <div class="border rounded px-5 py-4 bg-white shadow-sm job-header-container">

                <div class="row d-flex">
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <img src="{{ asset('images/' . $company?->company_logo) }}" class="logo-detail mb-3">
                    </div>
                    <div class="col-md-8 ms-5 job-info">
                        <h4><b>{{ $company?->company_name }}</b></h4>
                        <span class="text-muted">{{ $company?->industry }}</span>

                        <div class="mt-2">
                            <i class="fa-solid fa-location-dot me-2 text-muted"></i><span
                                class="text-muted me-3">{{ $company?->location }}</span>
                            <i class="fa-solid fa-user-group me-2 text-muted"></i><span
                                class="text-muted">{{ $company?->company_size }}
                                employees</span>
                        </div>

                        <div class="mt-2">
                            <span class="company-info md-block me-1">{{ $company?->contact_email }}</span>

                            <a href="{{ $company?->website_Url }}" class="text-decoration-none text-dark company-info"><i
                                    class="fa-solid fa-globe"></i> Website</a>
                        </div>
                    </div>
                </div>

            </div>

            <h4 class="my-4"><b>About {{ $company?->company_name }}</b></h4>

            <p>{{ $company?->company_description }}</p>

            <hr class="my-5">

            <span class="h4 me-2"><b>Job Openings</b></span>
            <span class="job-count rounded-circle">{{$jobs->count()}}</span>

            <div class="d-flex">

                @if ($jobs->count())
                    @foreach ($jobs as $job)
                    <div class="job-opening-section pe-2 py-4">
                        <div class="py-3 px-4 mb-4 border rounded shadow-sm bg-white job-opening">

                            <div>
                                <a href="{{ route('job.detail', $job->id) }}" class="text-decoration-none text-dark link">
                                <h4><b>{{ $job->job_title }}</b></h4>
                            </a>

                            <i class="fa-solid fa-location-dot me-2 text-muted"></i><span
                                class="text-muted me-3">{{ $job->location }}</span>
                            <i class="fa-solid fa-briefcase me-2 text-muted"></i><span
                                class="text-muted">{{ $job->job_type }}</span>
                            </div>

                            <p class="text-muted my-3">{{ Str::words($job->description, 15, '...') }}</p>

                        </div>
                    </div>
                    @endforeach
                @else
                    <i class="mt-4">No job opening available.</i>
                @endif

            </div>

        </div>
    </div>
@endsection
