@extends('admin.layouts.master')

@section('title', 'Jobs')

@section('content')

    <div class="container p-4">
        <div class="row">
            <div>
                <h4 class="fw-bold">Application Management</h4>
            </div>
        </div>
        <div class="row pt-3 d-flex justify-content-between">
            <div class="col-12 col-md-4">
                <form action="#" method="GET">
                    <div class="input-group mt-1 mb-4">
                        <input type="text" class="form-control input-box bg-white" name="searchData"
                            placeholder="Search by keywords or company" aria-describedby="basic-addon2"
                            value="{{ old('searchData') }}">

                        <button type="submit" class="btn pink"><i class="fa-solid fa-magnifying-glass me-1"></i>
                            Search</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-lg-3 col-md-8 pb-3">
                <div class="row">
                    <div class="col">
                        <ul class="navbar-nav me-auto category-filter py-1 pt-2 px-3 rounded bg-white">
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle text-muted" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    {{ request('status') && $applications->firstWhere('status', request('status'))
                                        ? $applications->firstWhere('status', request('status'))->status
                                        : 'Filter by Status' }}
                                </a>
                                <ul class="dropdown-menu scrollable">
                                    <li>
                                        <a class="dropdown-item mt-2" href="{{ route('admin.jobs') }}">
                                            All Applications
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item mt-2" href="{{ route('admin.jobs', ['status' => 'Pending']) }}">
                                            Pending
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item mt-2" href="{{ route('admin.jobs', ['status' => 'Interview']) }}">
                                            Interview Scheduled
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Position</th>
                            <th scope="col">Applicant</th>
                            <th scope="col">Company</th>
                            <th scope="col">Location</th>
                            <th scope="col">Submitted on</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                            <tr>
                                <td class="fw-bold">{{ $loop->iteration }}</td>
                                <td>{{ $application->job->job_title }}</td>
                                <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                                <td>{{ $application->job->company->company_name }}</td>
                                <td>{{ $application->job->location }}</td>
                                <td>{{ \Carbon\Carbon::parse($application->created_at)->format('d-m-Y') }}</td>
                                <td>
                                    <span class="badge border border-secondary text-dark">{{ $application->status }}</span>
                                </td>
                                <td>
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item dropdown">
                                            <a href="#" class="nav-link px-3" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical text-black"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                </li>
                                                <li><a class="dropdown-item text-danger"
                                                        href="{{ route('application.delete', $application->id) }}"
                                                        onclick="return confirm('Are you sure to want to delete this application?')">Delete Application</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $applications->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection