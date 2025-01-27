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

@section('styles')
    <style>
        .slider-home {
            height: 300px;
        }
        .nav-link,
        .nav-employer {
            color: white !important;
        }

        .navbar {
            background: transparent !important;
            border: none !important;
        }

        .heading {
            /* background: radial-gradient(circle, rgb(71, 71, 194), rgb(32, 32, 113)); */
            background-image: url('/images/earth_bg.jpg');
            background-color: rgb(60, 60, 60);
            background-blend-mode: multiply;
            /* background: radial-gradient(circle, rgb(41, 40, 40), rgb(18, 18, 18)); */
        }
    </style>
@endsection

@section('title', 'Explore Companies')

@section('heading')
    <div class="slider-home row d-flex align-items-center px-3">
        <div class="col-12 col-md-8 p-5 companies">
            <h2 class="text-white mx-5 mb-5">Connect with companies that value your potential</h2>
            <div class="row px-5">
                <div class="col-12 col-md-6">
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
                <div class="col-12 col-md-5">
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
        </div>
    </div>
@endsection

@section('content')
    <div class="container py-4">
        <div class="row">
            <h3 class="fw-bold">Explore Companies</h3>
            @if ($companies->count())
                <div class="row">
                    @foreach ($companies as $company)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <a href="{{ route('company.detail', $company->id) }}" class="text-decoration-none text-dark">
                            <div class=" p-3 my-4 border-2 border-secondary-subtle border-radius bg-white">
                                <img src="{{ asset('images/' . $company->company_logo) }}" class="img-fluid company-logo my-3">
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
            @else
                <div class="col-12 my-3">
                    <i>No companies found</i>
                </div>
            @endif
        </div>
    </div>
@endsection
