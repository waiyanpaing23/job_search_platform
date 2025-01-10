@extends('layouts.master')

@section('styles')
    <style>
        .nav-link,
        .nav-employer {
            color: white !important;
        }

        .navbar {
            background: transparent !important;
            border: none !important;
        }

        .heading {
            /* background: radial-gradient(circle, rgb(71, 71, 194), rgb(32, 32, 113)); */
            background-image: url('/images/earth_bg.jpg');
            background-color: rgb(30, 30, 30);
            background-blend-mode: multiply;
            /* background: radial-gradient(circle, rgb(41, 40, 40), rgb(18, 18, 18)); */
        }
    </style>
@endsection

@section('title')
    ProsPath
@endsection

@section('heading')
    <div class="slider-home row d-flex justify-content-center align-items-center px-3">
        <div class="col-12 col-md-5 p-5">
            <h1 class="text-white mx-5 mb-5">Find the most exciting jobs for your career</h1>
            <form action="{{ route('list') }}" method="GET">
                <div class="input-group ms-5">
                    <input list="keyword" class="form-control search" name="searchData"
                        placeholder="Search by keywords or location" aria-describedby="basic-addon2">
                    <datalist id="keyword">
                        @foreach ($jobs as $job)
                            <option value="{{ $job->job_title }}">
                        @endforeach
                    </datalist>
                    <input type="submit" class="btn pink" value="Search">
                </div>
            </form>
        </div>
        {{-- <div class="col-12 col-md-5 img-slider">
        <img src="{{ asset('images/person1.png') }}" class="img-fluid home-img">
    </div> --}}
    </div>
@endsection

@section('content')
    <div class="container-fluid">

        @if (Auth::check() && Auth::user()->applicant)
            <div class="container py-5">
                <h4 class="mb-4">Featured Jobs</h4>
                <div class="row">
                    @foreach ($recommendations as $job)
                        <div class="col-3">
                            <a href="{{ route('job.detail', $job->id) }}" class="text-decoration-none text-dark">
                                <div class=" p-4 my-4 border border-2 border-secondary-subtle rounded bg-white">
                                    <h5>{{ $job->job_title }}</h5>

                                    <p>{{ $job->company->company_name }}</p>

                                    <i class="fa-solid fa-location-dot me-2 text-muted"></i><span
                                        class="text-muted me-3">{{ $job->location }}</span>
                                    <i class="fa-solid fa-briefcase me-2 text-muted"></i><span
                                        class="text-muted">{{ $job->job_type }}</span>
                                    <span class="text-muted mt-3 d-block">Posted on
                                        {{ \Carbon\Carbon::parse($job->created_at)->format('d/m/Y') }}</span>

                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="employer-reg">
                    <img src="{{ asset('images/job-icon.png') }}" class="img-fluid employer-icon">
                    <h4>Post your jobs today and hire top talent ready to elevate your business!</h4>
                    <a href="" class="btn pink mt-3">Register as Employer</a>
                </div>
        @endif

        <div class="container py-5">
            <h4 class="mb-4">Popular Industries</h4>
            <div class="row d-flex justify-content-evenly my-2">
                @foreach ($industries as $industry)
                    <div class="col-6 col-md-3 mb-3">
                        <a href="{{ route('list', ['category' => $industry->id]) }}"
                            class="text-decoration-none text-black">
                            <div
                                class="d-flex flex-column bg-white align-items-center industries border border-2 rounded border-secondary-subtle p-3 pb-1">
                                <p class="fw-bold custom-font text-center">{{ $industry->category }}</p>
                                <p><span class="h5 text-primary">{{ $industry->job_count }}</span> Available Jobs</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container py-5">
            <h4>Find your future companies</h4>
            <div class="row d-flex justify-content-evenly my-2">
                @foreach ($companies as $company)
                    <div class="col-6 col-md-3 pe-1">
                        <a href="{{ route('company.detail', $company->id) }}" class="text-decoration-none text-black">
                            <div
                                class="m-2 d-flex flex-column bg-white align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                                <div class=" mb-3">
                                    <img src="{{ asset('images/' . $company->company_logo) }}"
                                        class="img-fluid company-logo">
                                </div>
                                <h5>{{ $company->company_name }}</h5>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
