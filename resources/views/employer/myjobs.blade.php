@extends('employer.layouts.master')

@section('title', 'My Jobs')

@section('content')
    <div class="container p-5">
        <div class="row">
            <div>
                <h4 class="fw-bold">Job Posts for {{ $company->company_name }}</h4>
            </div>
        </div>
        <div class="row pt-3 d-flex justify-content-between">
            <div class="col-12 col-md-4">
                <form action="#" method="GET">
                    <div class="input-group mt-1 mb-4">
                        <input list="keyword" class="form-control input-box bg-white" name="searchData"
                                    placeholder="Keywords or location" aria-describedby="basic-addon2"
                                    value="{{ old('searchData') }}">

                                <datalist id="keyword">
                                    @foreach ($jobs as $job)
                                        <option class="w-100" value="{{ $job->job_title }}">
                                    @endforeach
                                </datalist>

                                {{-- <input type="submit" class="btn pink" value="Search"> --}}
                                <button type="submit" class="btn pink"><i
                                        class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-4 col-lg-3">
                <ul class="navbar-nav me-auto category-filter py-1 pt-2 px-3 rounded">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle text-muted" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ request('status') && $jobs->firstWhere('status', request('status'))
                            ? $jobs->firstWhere('status', request('status'))->status
                            : 'Filter by Status' }}
                        </a>
                        <ul class="dropdown-menu scrollable">
                            <li>
                                <a class="dropdown-item mt-2" href="{{ route('employer.job.list') }}">
                                    All Statuses
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item mt-2" href="{{ route('employer.job.list', ['status' => 'Open']) }}">
                                    Open
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item mt-2" href="{{ route('employer.job.list', ['status' => 'Closed']) }}">
                                    Closed
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            @foreach ($jobs as $job)
                <div class="col-12 col-lg-4">

                    <div
                        class="d-flex flex-column justify-content-between px-3 pb-3 mb-4 border border-2 p-3 rounded bg-white shadow-sm">

                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('job.detail', $job->id) }}" class="text-decoration-none text-dark link">
                                        <h5><b>{{ $job->job_title }}</b></h5>
                                    </a>
                                    <span class="badge border border-secondary-subtle text-dark ms-2">{{ $job->status }}</span>
                                </div>
                                <div>
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item dropdown">
                                            <a href="#" class="nav-link px-3" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical text-black"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('job.detail', $job->id) }}">View
                                                    Details</a></li>
                                                <li>
                                                <li><a class="dropdown-item" href="{{ route('job.edit', $job->id) }}">Edit
                                                    Job</a></li>
                                                @if ($job->status == 'Open')
                                                <li>
                                                    <form action="{{ route('job.close', $job->id) }}" method="POST">
                                                        @csrf
                                                        <button class="btn btn-link p-0 ms-3 align-baseline text-black text-decoration-none">
                                                            Close Job
                                                        </button>
                                                </li>
                                                @elseif($job->status == 'Closed')
                                                    <li>
                                                        <form action="{{ route('job.activate', $job->id) }}" method="POST">
                                                            @csrf
                                                            <button class="btn btn-link p-0 ms-3 align-baseline text-black text-decoration-none">
                                                                Reactivate Job
                                                            </button>
                                                    </li>
                                                @endif
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger"
                                                        href="{{ route('job.delete', $job->id) }}">Delete Job</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </div>
                            </div>

                            <i class="fa-solid fa-location-dot me-2 text-muted"></i><span
                                class="text-muted me-3">{{ $job->location }}</span>
                            <i class="fa-solid fa-briefcase me-2 text-muted"></i><span
                                class="text-muted">{{ $job->job_type }}</span>

                            {{-- <p class="text-muted my-3">{{ Str::words($job->description, 15, '...') }}</p> --}}
                        </div>
                        <div class="postdate mt-4">
                            <p class=""><i class="fa-regular fa-calendar me-2"></i>Posted on
                                {{ \Carbon\Carbon::parse($job->created_at)->format('d/m/Y') }}</p>
                            <p><i class="fa-solid fa-user-large me-2"></i>{{ $job->applications->count() }} Applicants</p>
                        </div>
                        <div class="postdate mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-muted">Posted by</span>
                                    <span class="text-muted">{{ Auth::user()->first_name }}</span>
                                </div>
                                <a href="">
                                    <img src="{{ Auth::user()->profile_image ? asset('images/' . Auth::user()->profile_image) : asset('images/profile.jpg') }}"
                                    class="img-fluid rounded-circle nav-profile me-3">
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            @endforeach

            {{ $jobs->links() }}
        </div>
    </div>
@endsection
