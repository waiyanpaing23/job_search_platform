@extends('employer/layouts/master')

@section('title')
{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} | Edit Profile
@endsection

@section('content')
    <div class="container-fluid bg-custom p-5">

        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-8">

                <a href="{{ route('employer.profile') }}" class="text-dark"><i class="fa-solid fa-arrow-left h3"></i></a>
                <h4 class="my-4"><b>Edit Profile</b></h4>

                <div class="p-4 shadow-sm rounded bg-white">
                    <h5><b>Manage Your Personal Information</b></h5>
                    <form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="oldImage" value="{{ Auth::user()->profile_image }}">

                        <div class="row">
                            <div class="col-md-2 d-flex flex-column">
                                <img src="{{ Auth::user()->profile_image ? asset('images/' . Auth::user()->profile_image) : asset('images/profile.jpg') }}"
                                    class="my-3 profile-edit rounded-circle" name="profile" id="image">
                            </div>
                            <div class="col d-flex align-items-center md-block">
                                <div>
                                    <input type="file" class="form-control input-file py-2 my-4 mx-3 " name="image"
                                    onchange="loadFile(event)">
                                    @error('profile')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <a href="{{ route('profile.image.remove') }}" class="btn btn-danger ms-4">
                                    <i class="fa-solid fa-trash"></i> Remove
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="firstname" class="mb-1 fw-semibold">First Name</label>
                                <input type="text" value="{{ Auth::user()->first_name }}"
                                    class="input-box rounded w-100 px-3 mb-3" id="firstname" name="firstname">
                                @error('firstname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="lastname" class="mb-1 fw-semibold">Last Name</label>
                                <input type="text" value="{{ Auth::user()->last_name }}"
                                    class="input-box rounded w-100 px-3 mb-3" id="lastname" name="lastname">
                                @error('lastname')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="position" class="mb-1 fw-semibold">Job Position</label>
                                <input type="text" value="{{ $employer?->position?$employer->position : '' }}"
                                    class="input-box rounded w-100 px-3 mb-3" id="position" name="position">
                                @error('position')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="email" class="mb-1 fw-semibold">Personal Email</label>
                                <input type="text" value="{{ Auth::user()->email }}"
                                    class="input-box rounded w-100 px-3 mb-3" id="email" name="email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="phone" class="mb-1 fw-semibold">Phone Number</label>
                                <input type="text" value="{{ $employer?->phone ? $employer->phone : '' }}"
                                    class="input-box rounded w-100 px-3 mb-3" id="phone" name="phone">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col">
                                <div class="d-flex justify-content-end">
                                    <input type="submit" class="btn pink" value="Save Changes">
                                </div>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>
@endsection
