@extends('layouts.master')

@section('content')
    <div class="container-fluid">
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

                    </div>
                    <hr class="pt-3">
                    <h5 class="fw-bold">Application Form</h5>
                    <p class="text-muted mb-3"><i>Complete the form below to apply this position at
                            {{ $job->employer->company->company_name }}.</i></p>

                    <form action="{{ route('application.submit', $job->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row pb-4">
                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-2 fw-semibold">First Name</label>
                                <input type="text" value="{{ Auth::user()->first_name, old('firstname') }}" name="firstname"
                                    class="form-control input-box rounded w-100 px-3">
                                @error('firstname')
                                    <small class="text-sm text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-2 fw-semibold">Last Name (Optional)</label>
                                <input type="text" value="{{ Auth::user()->last_name, old('lastname') }}" name="lastname"
                                    class="form-control input-box rounded w-100 px-3" value="{{old('lastname')}}">
                            </div>
                        </div>

                        <div class="row pb-4">
                            <div class="col-12 col-sm-6">
                                <label for="email" class="mb-2 fw-semibold">Personal Email</label>
                                <input type="email" value="{{ Auth::user()->email }}" name="email"
                                    class="form-control input-box rounded w-100 px-3" value="{{old('email')}}">
                                @error('email')
                                    <small class="text-sm text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="phone" class="mb-2 fw-semibold">Phone Number</label>
                                <input type="text" name="phone"
                                    value="{{ $applicant->phone ? $applicant->phone : '' }}"
                                    class="form-control input-box rounded w-100 px-3" value="{{old('phone')}}">
                                @error('phone')
                                    <small class="text-sm text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="portfolio" class="mb-2 fw-semibold">Portfolio URL (Optional)</label>
                                <input type="text" name="portfolio"
                                    value="{{ $applicant->portfolio_link ? $applicant->portfolio_link : '' }}"
                                    class="form-control input-box rounded w-100 px-3 mb-4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="salary" class="fw-semibold">Expected Salary</label>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <input type="number" name="salary" class="form-control mt-2 me-5 input-box" value="{{old('salary')}}">
                                    </div>
                                    <div class="me-3">
                                        <select name="currency" class="input-box rounded px-3 mt-2 me-4 w-100">
                                            <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                            <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                            <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
                                            <option value="THB" {{ old('currency') == 'THB' ? 'selected' : '' }}>THB</option>
                                            <option value="SGD" {{ old('currency') == 'SGD' ? 'selected' : '' }}>SGD</option>
                                            <option value="KRW" {{ old('currency') == 'KRW' ? 'selected' : '' }}>KRW</option>
                                            <option value="MMK" {{ old('currency') == 'MMK' ? 'selected' : '' }}>MMK</option>
                                        </select>
                                    </div>
                                    <div class="">
                                        <select name="salaryType" class="input-box rounded mt-2 px-4 w-100">
                                            <option value="per hour" {{ old('salaryType') == 'per hour' ? 'selected' : '' }}>per hour</option>
                                            <option value="per day" {{ old('salaryType') == 'per day' ? 'selected' : '' }}>per day</option>
                                            <option value="per month" {{ old('salaryType') == 'per month' ? 'selected' : '' }}>per month</option>
                                            <option value="per year" {{ old('salaryType') == 'per year' ? 'selected' : '' }}>per year</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 mb-4">
                                <label for="resume" class="mb-2 fw-semibold">Resume</label>
                                <input type="file" name="resume" accept=".pdf, .png, .jpg, .jpeg"
                                    class="form-control input-file rounded w-100 px-3">
                                @error('resume')
                                    <small class="text-sm text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pb-4">
                            <div class="col-12">
                                <label for="coverletter" class="mb-2 fw-semibold">Cover Letter</label>
                                <textarea name="coverLetter" rows="4" class="form-control rounded w-100 px-3">{{old('coverLetter')}}</textarea>
                                @error('coverletter')
                                    <small class="text-sm text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pb-3">
                            <div class="col-12">
                                <label for="interest" class="mb-2 fw-semibold">Why are you interested in this
                                    position?</label>
                                <textarea name="interest" rows="2" class="form-control rounded w-100 px-3">{{old('interest')}}</textarea>
                                @error('interest')
                                    <small class="text-sm text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check mb-2">
                            <input type="checkbox" name="sync" value="1" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Sync changes to your profile
                            </label>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn pink">Submit Application</button>
                            </div>
                        </div>

                </div>
                </form>

            </div>
        </div>

    </div>
    </div>
@endsection
