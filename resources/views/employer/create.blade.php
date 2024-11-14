@extends('employer/layouts/master')

@section('content')
    <div class="container p-5">
        <div class="px-5">
            <h4><b>Post New Job</b></h4>
            <form action="{{ route('job.store') }}" method="POST" class="mt-4">
                @csrf
                <div class="row">
                    <div class="col">
                        <label class="mt-3"><b>Job Title</b></label>
                        <input type="text" name="title" class="form-control mt-2 input-box @error('title') is-invalid @enderror">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="mt-3"><b>Description</b></label>
                        <textarea name="description" class="form-control mt-2 @error('description') is-invalid @enderror" rows="3"></textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-6">
                        <label for="title"><b>Company</b></label>
                        <input list="company" name="company" class="form-control mt-2 input-box @error('company') is-invalid @enderror">
                        <datalist id="company">
                            @foreach ($companies as $company)
                                <option value="{{ $company->company_name }}">
                            @endforeach
                        </datalist>
                        @error('company')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="title"><b>Salary</b></label>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="minSalary" placeholder="Min:" class="form-control mt-2 input-box @error('salary') is-invalid @enderror">
                                @error('minSalary')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-6">
                                <input type="text" name="maxSalary" placeholder="Max:" class="form-control mt-2 input-box @error('salary') is-invalid @enderror">
                                @error('maxSalary')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-6">
                        <label for="title"><b>Category</b></label>
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
                        <label for="title"><b>Job Type</b></label>
                        <select name="jobtype" class="input-box rounded px-3 mt-2 w-100 @error('jobtype') is-invalid @enderror">
                            <option value="">Select Job Type</option>
                            <option value="Full-Time">Full-Time</option>
                            <option value="Part-Time">Part-Time</option>
                            <option value="Remote">Remote</option>
                        </select>
                        @error('jobtype')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-6">
                        <label for="title"><b>Contact Email</b></label>
                        <input type="email" name="contactEmail" class="form-control mt-2 input-box @error('contactEmail') is-invalid @enderror">
                        @error('contactEmail')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="title"><b>Application Deadline</b></label>
                        <input type="date" name="expiryDate" class="form-control mt-2 input-box @error('deadline') is-invalid @enderror">
                        @error('deadline')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label class="mt-3"><b>Requirements</b></label>
                        <textarea name="requirement" class="form-control mt-2 @error('title') is-invalid @enderror" rows="3"></textarea>
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="mt-3"><b>Benefits</b></label>
                        <textarea name="benefit" class="form-control mt-2 @error('title') is-invalid @enderror" rows="3"></textarea>
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
@endsection
