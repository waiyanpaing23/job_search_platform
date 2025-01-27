@extends('employer/layouts/master')

@section('title')
    {{ $company->company_name }} | Edit
@endsection

@section('content')
    <div class="container-fluid p-5">

        <div class="row d-flex justify-content-center">

            <div class="col-12 col-lg-8">

                <a href="{{ route('employer.profile') }}" class="text-dark"><i class="fa-solid fa-arrow-left h3"></i></a>
                <h3 class="my-4"><b>Edit Company Profile</b></h3>

                <div class="p-4 border rounded">
                    <h5><b>Manage Company Information</b></h5>
                    <form action="{{ route('company.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $company->id }}">
                        <input type="hidden" name="oldImage" value="{{ $company->company_logo }}">

                        <div class="row pt-3">
                            <div class="col-md-6 d-flex flex-column">
                                <img src="{{ $company->company_logo ? asset('images/' . $company->company_logo) : asset('images/default_image.png') }}"
                                    class="my-3" name="logo" id="image">
                                <input type="file" class="form-control input-file py-2 my-4" name="image"
                                    onchange="loadFile(event)" @error('image') is-invalid @enderror>
                                @error('image')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Name</label>
                                <input type="text" value="{{ old('company_name', $company->company_name) }}"
                                    class="input-box rounded w-100 px-3" name="company_name"
                                    @error('company_name') is-invalid @enderror>
                                @error('company_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Industry</label>
                                <select name="category"
                                    class="input-box rounded px-3 w-100 @error('category') is-invalid @enderror">
                                    <option value="">Select Industry</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category }}"
                                            {{ old('category', $company->industry ?? '') == $category->category ? 'selected' : '' }}>
                                            {{ $category->category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-12">
                                <label for="name" class="mb-1 fw-semibold">Company Description</label>
                                <textarea class="rounded w-100 px-3" name="description" rows="4" @error('description') is-invalid @enderror>{{ old('description', $company->company_description) }}</textarea>
                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Website</label>
                                <input type="text" value="{{ old('website_url', $company->website_url) }}"
                                    class="input-box rounded w-100 px-3" name="website_url"
                                    @error('website_url') is-invalid @enderror>
                                @error('website_url')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Location</label>
                                <input type="text" value="{{ old('location', $company->location) }}"
                                    class="input-box rounded w-100 px-3" name="location"
                                    @error('location') is-invalid @enderror>
                                @error('location')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Contact Email</label>
                                <input type="text" value="{{ old('email', $company->contact_email) }}"
                                    class="input-box rounded w-100 px-3" name="email"
                                    @error('email') is-invalid @enderror>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">Phone Number</label>
                                <input type="text" value="{{ old('phone', $company->phone) }}"
                                    class="input-box rounded w-100 px-3" name="phone"
                                    @error('phone') is-invalid @enderror>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="row pt-3">
                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-1 fw-semibold">No. of Employers</label>
                                <select name="company_size"
                                    class="input-box rounded px-3 mt-2 w-100 @error('company_size') is-invalid @enderror">
                                    <option value="">Select Range</option>
                                    <option value="1-10"
                                        {{ old('company_size', $company->company_size ?? '') == '1-10' ? 'selected' : '' }}>
                                        1-10
                                    </option>
                                    <option value="11-50"
                                        {{ old('company_size', $company->company_size ?? '') == '11-50' ? 'selected' : '' }}>
                                        11-50</option>
                                    <option value="51-100"
                                        {{ old('company_size', $company->company_size ?? '') == '51-100' ? 'selected' : '' }}>
                                        51-100</option>
                                    <option value="100-200"
                                        {{ old('company_size', $company->company_size ?? '') == '100-200' ? 'selected' : '' }}>
                                        100-200</option>
                                    <option value="200-500"
                                        {{ old('company_size', $company->company_size ?? '') == '200-500' ? 'selected' : '' }}>
                                        200-500</option>
                                    <option value="500-1000"
                                        {{ old('company_size', $company->company_size ?? '') == '500-1000' ? 'selected' : '' }}>
                                        500-1000</option>
                                    <option value="1000+"
                                        {{ old('company_size', $company->company_size ?? '') == '1000+' ? 'selected' : '' }}>
                                        1000+</option>
                                </select>

                                @error('company_size')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row pt-4">
                            @if ($company->status == 'Approved')
                                <div class="col d-flex justify-content-between align-items-center md-block">
                                    <a href="{{ route('company.remove', $company->id) }}" class="btn btn btn-danger mb-3"><i
                                            class="fa-solid fa-link-slash"></i> Remove Company Assocation</a>
                                    <input type="submit" class="btn pink" value="Save Changes">
                                </div>
                            @elseif ($company->status == 'Rejected')
                                <div class="col d-flex justify-content-end">
                                    <input type="submit" class="btn pink" value="Resubmit Company">
                                </div>
                            @else
                                <div class="col d-flex justify-content-end">
                                    <input type="submit" class="btn pink" value="Save Changes">
                                </div>
                            @endif
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </div>
@endsection
