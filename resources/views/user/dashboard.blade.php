@extends('layouts.master')

@section('styles')
<style>
    .navbar {
        background-color: transparent;
    }

    .heading {
        background: radial-gradient(circle, rgb(71, 71, 194), rgb(32, 32, 113));
    }
</style>
@endsection

@section('heading')
<div class="slider-home row d-flex justify-content-evenly px-3">
    <div class="col-5 p-5 mt-5">
        <h1 class="text-white m-5">Find the most exciting jobs for your career</h1>
        <div class="input-group mb-3 mt-5 ms-5">
            <input type="text" class="form-control search" placeholder="Search by keywords or location" aria-describedby="basic-addon2">
            <span class="input-group-text px-4 bg-warning search pink" id="basic-addon2">Search</span>
        </div>
    </div>
    <div class="col-5 img-slider">
        <img src="{{ asset('images/jobseeker.png') }}" class="img-fluid home-img">
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">

<div class="container mt-5">
        <h4 class="mb-4">Popular Industries</h4>
        <div class="row d-flex justify-content-evenly my-2">
            <div class="col-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <h4>Technology</h4>
                    <p><span class="h5 text-primary">50</span> Available Jobs</p>
                </div>
            </div>
            <div class="col-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <h4>Healthcare</h4>
                    <p><span class="h5 text-primary">50</span> Available Jobs</p>
                </div>
            </div>
            <div class="col-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <h4>Insurance</h4>
                    <p><span class="h5 text-primary">50</span> Available Jobs</p>
                </div>
            </div>
            <div class="col-3 pe-1 mb-4">
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
            <div class="col-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <div class="company-logo mb-3">
                        <img src="{{asset('images/event.jpg')}}" class="img-fluid">
                    </div>
                    <h5>Facebook</h5>
                </div>
            </div>
            <div class="col-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <div class="company-logo mb-3">
                        <img src="{{asset('images/event.jpg')}}" class="img-fluid">
                    </div>
                    <h5>Facebook</h5>
                </div>
            </div>
            <div class="col-3 pe-1">
                <div class="m-2 d-flex flex-column align-items-center border border-2 rounded border-secondary-subtle p-4 pb-1">
                    <div class="company-logo mb-3">
                        <img src="{{asset('images/event.jpg')}}" class="img-fluid">
                    </div>
                    <h5>Facebook</h5>
                </div>
            </div>
            <div class="col-3 pe-1 mb-4">
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
