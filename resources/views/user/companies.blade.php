@php
    $layout = 'layouts.master';

    if (Auth::check() && Auth::user()->role) {
        switch (Auth::user()->role) {
            case 'employer':
                $layout = 'employer.layouts.master';
                break;
            case 'admin':
                $layout = 'admin.layouts.master';
                break;
        }
    }
@endphp

@extends($layout)

@section('title', 'Explore Companies')

@section('content')
    <div class="container-fluid px-5 py-4">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-4">
                <form action="#" method="GET">
                    <div class="input-group mt-1 mb-4">
                        <input list="keyword" class="form-control input-box bg-white" name="searchData"
                            placeholder="Search by keywords or location" aria-describedby="basic-addon2"
                            value="{{ old('searchData') }}">

                        <datalist id="keyword">
                            @foreach ($companies as $company)
                                <option value="{{ $company->company_name }}">
                            @endforeach
                        </datalist>

                        {{-- <input type="submit" class="btn pink" value="Search"> --}}
                        <button type="submit" class="btn pink"><i class="fa-solid fa-magnifying-glass me-1"></i>
                            Search</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-4">
                <ul class="navbar-nav me-auto category-filter py-1 pt-2 px-3 rounded">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle text-muted" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ request('category') && $companies->firstWhere('industry', request('category'))
                                ? $companies->firstWhere('industry', request('category'))->industry
                                : 'Search by Category' }}
                        </a>
                        <ul class="dropdown-menu scrollable">
                            @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item mt-2"
                                        href="{{ route('companies', ['category' => $category->category]) }}">
                                        {{ $category->category }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            @foreach ($companies as $company)
                <div class="col-12 col-sm-6 col-lg-3">
                    <a href="{{ route('company.detail', $company->id) }}" class="text-decoration-none text-dark">
                        <div class=" p-3 my-4 border border-2 border-secondary-subtle border-radius bg-white">
                            <img src="{{ asset('images/' . $company->company_logo) }}" class="img-fluid w-50 my-3">
                            <div class="company-container">
                                <h5>{{ $company->company_name }}</h5>
                                <span class="text-muted d-block mb-2">{{ $company->industry }}</span>

                                <i class="fa-solid fa-location-dot me-2 text-muted"></i><span
                                    class="text-muted me-3">{{ $company->location }}</span>
                                <i class="fa-solid fa-user-group me-2 text-muted"></i><span
                                    class="text-muted">{{ $company->company_size }} employees</span>
                            </div>

                            <span class="text-custom fw-bold d-block ms-3 mt-3">{{ $company->jobs_count }} Job Posts</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
