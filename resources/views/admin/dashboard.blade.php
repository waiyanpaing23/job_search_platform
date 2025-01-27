@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')

<div class="container py-5">
    <div class="row pt-1">
        <div class="col-6 col-md-3 mb-3">
            <div class="p-3 border-2 bg-white shadow-sm rounded">
                <span class="fw-bold">Total Users </span><i class="fa-solid fa-user text-custom ms-2"></i>
                <h4 class="mt-2 fw-bold text-custom">{{ $users->count() }}</h4>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="p-3 border-2 bg-white shadow-sm rounded">
                <span class="fw-bold">Total Jobs</span><i class="fa-solid fa-briefcase text-custom ms-2"></i>
                <h4 class="mt-2 fw-bold text-custom">{{ $jobs->count() }}</h4>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="p-3 border-2 bg-white shadow-sm rounded">
                <span class="fw-bold">Total Applications</span><i class="fa-solid fa-file text-custom ms-2"></i>
                <h4 class="mt-2 fw-bold text-custom">{{ $applications->count() }}</h4>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="p-3 border-2 bg-white shadow-sm rounded">
                <span class="fw-bold">Total Companies</span><i class="fa-solid fa-building text-custom ms-2"></i>
                <h4 class="mt-2 fw-bold text-custom">{{ $companies->count() }}</h4>
            </div>
        </div>
    </div>

    <div class="row pt-3">
        <div class="col-12">
            <div class="p-3 border-2 bg-white shadow-sm rounded">
                <h4 class="fw-bold">User Overview</h4>
                <div class="d-flex flex-wrap justify-content-between p-3">
                    <div class="text-center mt-4">
                        <h5 class="mb-2 fw-bold">Total Users</h5>
                        <h3 class="text-custom">{{ $users->count() }}</h4>
                    </div>
                    <div class="text-center mt-4">
                        <h5 class="mb-2 fw-bold">Applicants</h5>
                        <h3 class="text-custom">{{ $applicants->count() }}</h4>
                    </div>
                    <div class="text-center mt-4">
                        <h5 class="mb-2 fw-bold">Employers</h5>
                        <h3 class="text-custom">{{ $employers->count() }}</h4>
                    </div>
                    <div class="text-center mt-4">
                        <h5 class="mb-2 fw-bold">New Users (Last 7 Days)</h5>
                        <h3 class="text-custom">{{ $newUsers->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
