@extends('admin/layouts/master')

@section('title')
{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
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
                        </div>

                        <div class="row d-flex align-items-center">
                            <div class="col-2">
                                <img src="{{ $employer->user->profile_image ? asset('images/' . $employer->user->profile_image) : asset('images/profile.jpg') }}"
                                    class="img-fluid rounded-circle profile my-4"><br>
                            </div>
                            <div class="col">
                                <h5><b>{{ $employer->user->first_name.' '.$employer->user->last_name }}</b></h5>
                                <p class="text-muted">{{ $employer?->position ? $employer?->position : ''}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-1 fw-semibold">First Name</label>
                            <input type="text" value="{{ $employer->user->first_name }}" class="input-box rounded w-100 px-3 mb-4"
                                disabled>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-1 fw-semibold">Last Name</label>
                            <input type="text" value="{{ $employer->user->last_name }}" class="input-box rounded w-100 px-3 mb-4"
                                disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-1 fw-semibold">Job Position</label>
                            <input type="text" value="{{ $employer?->position ? $employer?->position : ''}}" class="input-box rounded w-100 px-3 mb-4"
                                disabled>
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-1 fw-semibold">Personal Email</label>
                            <input type="text" value="{{ $employer->user->email }}" class="input-box rounded w-100 px-3 mb-4"
                                disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-1 fw-semibold">Phone Number</label>
                            <input type="text" value="{{ $employer?->phone ? $employer->phone : '' }}" class="input-box rounded w-100 px-3 mb-4"
                                disabled>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
