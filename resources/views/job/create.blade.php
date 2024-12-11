@extends('employer/layouts/master')

@section('content')
    <div class="container-fluid p-5">

        <div class="px-5">
            <h5><b>Post New Job</b></h5>
            <div class="shadow-sm rounded bg-white p-4 mt-3">
                <form action="{{ route('job.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label><b>Job Title</b></label>
                            <input type="text" name="title" class="form-control mt-2 input-box @error('title') is-invalid @enderror"
                            placeholder="e.g. Software Engineer">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="title"><b>Company</b></label>
                            <input type="text" name="company" class="form-control mt-2 input-box @error('company') is-invalid @enderror"
                            placeholder="Your company name" value="{{ $employer->company->company_name }}" readonly>
                            @error('company')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="mt-3"><b>Description</b></label>
                            <textarea name="description" class="form-control mt-2 @error('description') is-invalid @enderror" rows="3"
                            placeholder="Describe the role, responsibilities, and expectations for this position."></textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-6">
                            <label for="location"><b>Location</b></label>
                            <input type="text" name="location" class="form-control mt-2 input-box @error('location') is-invalid @enderror"
                            placeholder="City, State, Country, or Remote">
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="salary"><b>Salary</b></label>
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" name="minSalary" placeholder="Min:" class="form-control mt-2 input-box @error('salary') is-invalid @enderror">
                                    @error('minSalary')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <input type="text" name="maxSalary" placeholder="Max:" class="form-control mt-2 input-box @error('salary') is-invalid @enderror">
                                    @error('maxSalary')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <select name="currency" class="input-box rounded px-3 mt-2 w-100 @error('currency') is-invalid @enderror">
                                        <option value="$">$</option>
                                        <option value="€">€</option>
                                        <option value="GBP">GBP</option>
                                        <option value="THB">THB</option>
                                        <option value="S$">S$</option>
                                        <option value="KRW">KRW</option>
                                        <option value="MMK">MMK</option>
                                    </select>
                                    @error('currency')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <select name="salaryType" class="input-box rounded px-3 mt-2 w-100 @error('salaryType') is-invalid @enderror">
                                        <option value="">per</option>
                                        <option value="per hour">per hour</option>
                                        <option value="per day">per day</option>
                                        <option value="per month">per month</option>
                                        <option value="per year">per year</option>
                                    </select>
                                    @error('salaryType')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-6">
                            <label for="category"><b>Category</b></label>
                            <select name="category" class="input-box rounded px-3 mt-2 w-100 @error('category') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="jobtype"><b>Job Type</b></label>
                            <select name="jobtype" class="input-box rounded px-3 mt-2 w-100 @error('jobtype') is-invalid @enderror">
                                <option value="">Select Job Type</option>
                                <option value="Full-Time">Full-Time</option>
                                <option value="Part-Time">Part-Time</option>
                            </select>
                            @error('jobtype')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-6">
                            <label for="email"><b>Contact Email</b></label>
                            <input type="email" class="form-control mt-2 input-box @error('contactEmail') is-invalid @enderror"
                            name="contactEmail" placeholder="example@yourcompany.com" value="{{ $employer->company->contact_email }}">
                            @error('contactEmail')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="expiryDate"><b>Application Deadline</b></label>
                            <input type="date" name="expiryDate" class="form-control mt-2 input-box @error('deadline') is-invalid @enderror">
                            @error('deadline')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="mt-3"><b>Requirements</b></label>
                            <textarea name="requirement" class="form-control mt-2 @error('title') is-invalid @enderror" rows="3"
                            placeholder="Provide the key qualifications and skills required for this position."></textarea>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="mt-3"><b>Benefits</b></label>
                            <textarea name="benefit" class="form-control mt-2 @error('title') is-invalid @enderror" rows="3"
                            placeholder="Describe the benefits offered for this position."></textarea>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col">
                            <div class="d-flex justify-content-end">
                                {{-- <input type="submit" class="btn bg-blue me-3" value="Preview"> --}}
                                <input type="submit" class="btn pink" value="Post Job">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
