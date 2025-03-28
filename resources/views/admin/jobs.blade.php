@extends('admin.layouts.master')

@section('title', 'Jobs')

@section('content')

    <div class="container p-4">
        <div class="row">
            <div>
                <h4 class="fw-bold">Job Post Management</h4>
            </div>
        </div>
        <div class="row pt-3 d-flex justify-content-between">
            <div class="col-12 col-md-4">
                <form action="#" method="GET">
                    <div class="input-group mt-1 mb-4">
                        <input type="text" class="form-control input-box bg-white" name="searchData"
                            placeholder="Search by keywords or location" aria-describedby="basic-addon2"
                            value="{{ old('searchData') }}">

                        <button type="submit" class="btn pink"><i class="fa-solid fa-magnifying-glass me-1"></i>
                            Search</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-6 col-md-8 pb-3">
                <div class="row">
                    <div class="col">
                        <ul class="navbar-nav me-auto category-filter py-1 pt-2 px-3 rounded bg-white">
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle text-muted" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ request('status') && $jobs->firstWhere('status', request('status'))
                                        ? $jobs->firstWhere('status', request('status'))->status
                                        : 'Filter by Status' }}
                                </a>
                                <ul class="dropdown-menu scrollable">
                                    <li>
                                        <a class="dropdown-item mt-2" href="{{ route('admin.jobs') }}">
                                            All Jobs
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item mt-2" href="{{ route('admin.jobs', ['status' => 'Open']) }}">
                                            Active Jobs
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item mt-2" href="{{ route('admin.jobs', ['status' => 'Closed']) }}">
                                            Closed Jobs
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <ul class="navbar-nav me-auto category-filter py-1 pt-2 px-3 rounded bg-white">
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle text-muted" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ request('category') && $jobs->firstWhere('category_id', request('category'))
                                        ? $jobs->firstWhere('category_id', request('category'))->category->category
                                        : 'Filter by Category' }}
                                </a>
                                <ul class="dropdown-menu scrollable">
                                    <li>
                                        <a class="dropdown-item mt-2" href="{{ route('admin.jobs') }}">
                                            All Jobs
                                        </a>
                                    </li>
                                    @foreach ($categories as $category)
                                        <li>
                                            <a class="dropdown-item mt-2"
                                                href="{{ route('admin.jobs', ['category' => $category->id]) }}">
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
        <div class="row">
            <div class="col table-container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Job Title</th>
                            <th scope="col">Company</th>
                            <th scope="col">Job Type</th>
                            <th scope="col">Location</th>
                            <th scope="col">Status</th>
                            <th scope="col">Applicants</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr>
                                <td class="fw-bold">{{ $loop->iteration }}</td>
                                <td>{{ $job->job_title }}</td>
                                <td>{{ $job->company->company_name }}</td>
                                <td>{{ $job->job_type }}</td>
                                <td>{{ $job->location }}</td>
                                <td>
                                    <span class="badge border border-secondary text-dark">{{ $job->status }}</span>
                                </td>
                                <td class="text-center">{{ $job->applications->count() }}</td>
                                <td>
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item dropdown">
                                            <a href="#" class="nav-link px-3" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical text-black"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('job.detail', $job->id) }}">View
                                                        Details</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $jobs->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
