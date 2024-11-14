@extends('layouts.master')

@section('content')
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-3 p-4 custom-shadow filter">
                <form action="{{ route('list') }}" method="GET">

                    <h5 class="mb-3">Search by Keywords</h5>
                    <div class="input-group mb-4">
                        <input list="keyword" class="form-control input-box" name="searchData"
                            placeholder="Keywords or location" aria-describedby="basic-addon2">

                        <datalist id="keyword">
                            @foreach ($jobs as $job)
                                <option value="{{ $job->job_title }}">
                            @endforeach
                        </datalist>
                        <input type="submit" class="btn pink" value="Search">
                    </div>

                </form>

                <h5 class="mb-3">Category</h5>
                {{-- <select name="searchData" class="input-box rounded px-3 mb-4 w-100 text-muted">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select> --}}

                <ul class="navbar-nav me-auto mb-2 mb-lg-0 category-filter py-2 px-3 rounded">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle text-muted" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ request('category') ? $categories->firstWhere('id', request('category'))->category : 'Search by Category' }}
                        </a>
                        <ul class="dropdown-menu scrollable">
                            @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item mt-2" href="{{ route('list', ['category' => $category->id]) }}">
                                    {{ $category->category }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>

                <h5 class="my-3">Job Types</h5>
                <ul class="list-unstyled">
                    <li class="p-2 jobtype">
                        <a href="{{ route('list', ['job_type' => 'Full-Time']) }}" class="text-decoration-none text-muted">
                            Full Time
                        </a>
                    </li>
                    <li class="p-2 jobtype">
                        <a href="{{ route('list', ['job_type' => 'Part-Time']) }}" class="text-decoration-none text-muted">
                            Part Time
                        </a>
                    </li>
                    <li class="p-2 jobtype">
                        <a href="{{ route('list', ['job_type' => 'Remote']) }}" class="text-decoration-none text-muted">
                            Remote
                        </a>
                    </li>
                </ul>
                <a href="{{ route('list') }}" class="btn btn-sm pink">Clear Filter</a>
            </div>

            <div class="col-9">
                <div class="row">
                    @foreach ($jobs as $job)
                        <div class="col-6">

                            <div class="px-3 pb-3 mb-4 border rounded">

                                <img src="{{ asset('images/' . $job->employer->company->company_logo) }}"
                                    class="img-fluid jobpost-logo">
                                <h4><b>{{ $job->job_title }}</b></h4>
                                <p>{{ $job->employer->company->company_name }}</p>
                                <i class="fa-solid fa-location-dot me-2 text-muted"></i><span
                                    class="text-muted me-3">{{ $job->employer->company->location }}</span>
                                <i class="fa-solid fa-briefcase me-2 text-muted"></i><span
                                    class="text-muted">{{ $job->job_type }}</span>
                                <p class="text-muted my-3">{{ Str::words($job->description, 15, '...') }}</p>
                                <a href="" class="btn pink mt-3">View Details</a>

                            </div>

                        </div>
                    @endforeach

                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
