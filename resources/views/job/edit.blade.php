@extends('employer/layouts/master')

@section('title', 'Edit Job')

@section('content')
    <div class="container-fluid p-5">

        <div class="px-5">
            <h5><b>Edit Job</b></h5>
            <div class="shadow-sm rounded bg-white p-4 mt-3">
                <form action="{{ route('job.update', $job->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label><b>Job Title</b></label>
                            <input type="text" name="title" class="form-control mt-2 input-box @error('title') is-invalid @enderror"
                            placeholder="e.g. Software Engineer" value="{{ $job->job_title, old('title') }}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label for="title"><b>Company</b></label>
                            <input type="text" name="company" class="form-control mt-2 input-box @error('company') is-invalid @enderror"
                            placeholder="Your company name" value="{{ $job->company->company_name }}" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="mt-3"><b>Description</b></label>
                            <textarea name="description" class="form-control mt-2 @error('description') is-invalid @enderror" rows="3"
                            placeholder="Describe the role, responsibilities, and expectations for this position.">{{ $job->description, old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-6">
                            <label for="location"><b>Location</b></label>
                            <input type="text" name="location" class="form-control mt-2 input-box @error('location') is-invalid @enderror"
                            placeholder="City, State, Country, or Remote" value="{{ $job->location, old('location') }}">
                            @error('location')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="salary"><b>Salary</b></label>
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" name="minSalary" placeholder="Min:" class="form-control mt-2 input-box @error('salary') is-invalid @enderror"
                                    value="{{ $job->min_salary, old('minSalary') }}">
                                    @error('minSalary')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <input type="text" name="maxSalary" placeholder="Max:" class="form-control mt-2 input-box @error('salary') is-invalid @enderror"
                                    value="{{ $job->max_salary, old('maxSalary') }}">
                                    @error('maxSalary')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <select name="currency" class="input-box rounded px-3 mt-2 w-100 @error('currency') is-invalid @enderror">
                                        <option value="$" @if ($job->currency == '$') selected @endif>USD</option>
                                        <option value="€" @if ($job->currency == '€') selected @endif>EUR</option>
                                        <option value="GBP" @if ($job->currency == 'GBP') selected @endif>GBP</option>
                                        <option value="THB" @if ($job->currency == 'THB') selected @endif>THB</option>
                                        <option value="S$" @if ($job->currency == 'S$') selected @endif>SGD</option>
                                        <option value="KRW" @if ($job->currency == 'KRW') selected @endif>KRW</option>
                                        <option value="MMK" @if ($job->currency == 'MMK') selected @endif>MMK</option>
                                    </select>
                                    @error('currency')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-3">
                                    <select name="salaryType" class="input-box rounded px-3 mt-2 w-100 @error('salaryType') is-invalid @enderror">
                                        <option value="per hour" @if ($job->salary_type == 'per hour') selected @endif>per hour</option>
                                        <option value="per day" @if ($job->salary_type == 'per day') selected @endif>per day</option>
                                        <option value="per month" @if ($job->salary_type == 'per month') selected @endif>per month</option>
                                        <option value="per year" @if ($job->salary_type == 'per year') selected @endif>per year</option>
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
                                <option value="{{ $category->id }}" @if ($job->category_id == $category->id) selected @endif>{{ $category->category }}</option>
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
                                <option value="Full-Time" @if ($job->job_type == 'Full-Time') selected @endif>Full-Time</option>
                                <option value="Part-Time" @if ($job->job_type == 'Part-Time') selected @endif>Part-Time</option>
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
                            name="contactEmail" placeholder="example@yourcompany.com" value="{{ $job->company->contact_email }}">
                            @error('contactEmail')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="expiryDate"><b>Application Deadline</b></label>
                            <input type="date" name="expiryDate" class="form-control mt-2 input-box @error('deadline') is-invalid @enderror"
                            value="{{ $job->expiry_date }}">
                            @error('deadline')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <label class="mt-3"><b>Requirements</b></label>
                            <textarea name="requirement" class="form-control mt-2 @error('title') is-invalid @enderror" rows="3"
                            placeholder="Provide the key qualifications and skills required for this position.">{{ $job->requirement }}</textarea>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="mt-3"><b>Benefits</b></label>
                            <textarea name="benefit" class="form-control mt-2 @error('title') is-invalid @enderror" rows="3"
                            placeholder="Describe the benefits offered for this position.">{{ $job->benefit }}</textarea>
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col">
                            <div class="d-flex justify-content-end">
                                {{-- <input type="submit" class="btn bg-blue me-3" value="Preview"> --}}
                                <input type="submit" class="btn pink" value="Update">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
