@extends('employer/layouts/master')

@section('title', 'Create Company Profile')

@section('content')
    <div class="container-fluid p-5">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-8">

                <a href="{{ route('employer.profile') }}" class="text-dark"><i class="fa-solid fa-arrow-left h3"></i></a>

                <h4 class="mt-3"><b>Create New Company Profile</b></h4>
                <div class="border rounded p-4 mt-3">
                    <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 d-flex flex-column">
                                <label class="mt-3"><b>Company Logo</b></label>
                                <img src="{{ asset('images/default_image.png') }}" class="mt-2 logo-create" name="logo"
                                    id="image">
                                <input type="file" class="form-control mt-2 input-file" name="image" onchange="loadFile(event)">
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="company_name" class="mt-4"><b>Company Name</b></label>
                                <input list="company_name"
                                    class="form-control mt-2 input-box @error('company_name') is-invalid @enderror"
                                    name="company_name" placeholder="Your company name" value="{{ old('company_name') }}">
                                <datalist id="company_name">
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->company_name }}">
                                    @endforeach
                                </datalist>
                                @error('company_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="description" class="mt-3"><b>Company Description</b></label>
                                <textarea name="description" class="form-control mt-2 @error('description') is-invalid @enderror"
                                    placeholder="Tell us about your company" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-6">
                                <label for="category"><b>Industry</b></label>
                                <select name="category"
                                    class="input-box rounded px-3 mt-2 w-100 @error('category') is-invalid @enderror">
                                    <option value="">Select Industry</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category }}">{{ $category->category }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="website_url"><b>Website</b></label>
                                <input type="text"
                                    class="form-control mt-2 input-box @error('website_url') is-invalid @enderror"
                                    name="website_url" placeholder="https://www.example.com"  value="{{ old('website_url') }}">
                                @error('website_url')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-6">
                                <label for="location"><b>Location</b></label>
                                <input type="text"
                                    class="form-control mt-2 input-box @error('location') is-invalid @enderror"
                                    name="location" placeholder="City, State, Country" value="{{ old('location') }}">
                                @error('location')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="company_size"><b>No. of Employers</b></label>
                                <select name="company_size"
                                    class="input-box rounded px-3 mt-2 w-100 @error('company_size') is-invalid @enderror">
                                    <option value="">Select Range</option>
                                    <option value="1-10">1-10</option>
                                    <option value="11-50">11-50</option>
                                    <option value="51-100">51-100</option>
                                    <option value="100-200">100-200</option>
                                    <option value="200-500">200-500</option>
                                    <option value="500-1000">500-1000</option>
                                    <option value="1000+">1000+</option>
                                </select>
                                @error('company_size')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-6">
                                <label for="email"><b>Company Email</b></label>
                                <input type="email"
                                    class="form-control mt-2 input-box @error('email') is-invalid @enderror"
                                    name="email" placeholder="example@yourcompany.com"  value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="phone"><b>Company Phone</b></label>
                                <input type="text"
                                    class="form-control mt-2 input-box @error('phone') is-invalid @enderror"
                                    name="phone" placeholder="+1 555-123-4567" value="{{ old('phone') }}">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col">
                                <div class="d-flex justify-content-end">
                                    <input type="submit" class="btn pink" value="Create Company">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
