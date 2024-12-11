@extends('layouts.master')

@section('styles')
<style>
    .nav-link, .nav-employer{
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

@section('heading')
<div class="slider-home row d-flex justify-content-center align-items-center px-3">
    <div class="col-12 col-md-5 p-5">
        <h1 class="text-white mx-5 mb-5">Find the most exciting jobs for your career</h1>
        <form action="{{ route('list') }}" method="GET">
            <div class="input-group ms-5">
                <input list="keyword" class="form-control search" name="searchData" placeholder="Search by keywords or location" aria-describedby="basic-addon2">
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

<div class="container mt-5">
        <h4 class="mb-4">Popular Industries</h4>
        <div class="row d-flex justify-content-evenly my-2">
            <div class="col-6 col-md-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <h4>Technology</h4>
                    <p><span class="h5 text-primary">50</span> Available Jobs</p>
                </div>
            </div>
            <div class="col-6 col-md-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <h4>Healthcare</h4>
                    <p><span class="h5 text-primary">50</span> Available Jobs</p>
                </div>
            </div>
            <div class="col-6 col-md-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <h4>Insurance</h4>
                    <p><span class="h5 text-primary">50</span> Available Jobs</p>
                </div>
            </div>
            <div class="col-6 col-md-3 pe-1 mb-4">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <h4>Digital Marketing</h4>
                    <p><span class="h5 text-primary">50</span> Available Jobs</p>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="employer-reg">
        <img src="{{ asset('images/job-icon.png') }}" class="img-fluid employer-icon">
        <h4>Post your jobs today and hire top talent ready to elevate your business!</h4>
        <a href="" class="btn pink mt-3">Register as Employer</a>
    </div>

    <div class="container mt-4">
        <h4>Find your future companies</h4>
        <div class="row d-flex justify-content-evenly my-2">
            <div class="col-6 col-md-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <div class="company-logo mb-3">
                        <img src="{{asset('images/event.jpg')}}" class="img-fluid">
                    </div>
                    <h5>Facebook</h5>
                </div>
            </div>
            <div class="col-6 col-md-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <div class="company-logo mb-3">
                        <img src="{{asset('images/event.jpg')}}" class="img-fluid">
                    </div>
                    <h5>Facebook</h5>
                </div>
            </div>
            <div class="col-6 col-md-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <div class="company-logo mb-3">
                        <img src="{{asset('images/event.jpg')}}" class="img-fluid">
                    </div>
                    <h5>Facebook</h5>
                </div>
            </div>
            <div class="col-6 col-md-3 pe-1 mb-4">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <div class="company-logo mb-3">
                        <img src="{{asset('images/event.jpg')}}" class="img-fluid">
                    </div>
                    <h5>Facebook</h5>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
