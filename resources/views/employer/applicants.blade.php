@extends('employer.layouts.master')

@section('title', 'Applicants')

@section('content')
    <div class="container px-5 py-4">
        <h3 class="fw-bold mb-4">Applicants</h3>
        <div class="row pt-1">
            <div class="col-4">
                <div class="p-3 border border-2 bg-white shadow-sm rounded">
                    <span class="fw-bold">Total Applications</span>
                    <h4 class="mt-2 fw-bold text-custom">{{ $applications->count() }}</h4>
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 border border-2 bg-white shadow-sm rounded">
                    <span class="fw-bold">New Applications</span>
                    <h4 class="mt-2 fw-bold text-custom">{{ $new->count() }}</h4>
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 border border-2 bg-white shadow-sm rounded">
                    <span class="fw-bold">Interview Scheduled</span>
                    <h4 class="mt-2 fw-bold text-custom">{{ $interview->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-end pt-5">
            <div class="col-4">
                <form action="#" method="GET">
                    <div class="input-group mt-2 mb-3">
                        <input list="keyword" class="form-control search-box bg-white" name="searchData"
                            placeholder="Search by keyword" aria-describedby="basic-addon2"
                            value="{{ old('searchData') }}">

                        <datalist id="keyword">
                            @foreach ($applications as $application)
                                <option value="{{ $application->job->job_title }}">
                            @endforeach
                        </datalist>

                        {{-- <input type="submit" class="btn pink" value="Search"> --}}
                        <button type="submit" class="btn pink"><i
                                class="fa-solid fa-magnifying-glass me-1"></i> Search</button>
                    </div>
                </form>
            </div>
            <div class="col-3">
                {{-- py-1 pt-2 px-3 --}}
                <ul class="navbar-nav me-auto category-filter search-box rounded">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle text-muted" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ request('status') && $applications->firstWhere('status', request('status'))
                                ? $applications->firstWhere('status', request('status'))->status
                                : 'Filter by Status' }}
                        </a>
                        <ul class="dropdown-menu scrollable">
                            @foreach ($statuses as $status)
                                <li>
                                    <a class="dropdown-item mt-3"
                                        href="{{ route('application.list', ['status' => $status]) }}">
                                        {{ $status }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Submitted On</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                        <tr>
                            <td class="fw-bold">{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{route('applicant.profile.view', $application->applicant->id)}}" class="text-decoration-none text-dark">
                                    <div class="d-flex applicant-list">
                                        <img src="{{ $application->applicant->user->profile_image ? asset('images/' . $application->applicant->user->profile_image) : asset('images/profile.jpg') }}"
                                        class="img-fluid rounded-circle nav-profile me-3">
                                        <div>
                                            <span class="d-block applicant-name">{{ $application->first_name }} {{ $application->last_name }}</span>
                                            <span class="text-muted">{{ $application->email }}</span>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td>{{ $application->job->job_title }}</td>
                            <td>{{ \Carbon\Carbon::parse($application->created_at)->format('d-m-Y') }}</td>
                            @if ($application->status == 'Pending')
                                <td><span class="rounded-pill company-info">{{ $application->status }}</span></td>
                            @elseif ($application->status == 'Reviewed')
                                <td>
                                    <span class="rounded-pill company-info bg-dark text-white">{{ $application->status }}</span>
                                </td>
                            @elseif ($application->status == 'Interview')
                                <td>
                                    <span class="rounded-pill company-info bg-dark text-white">{{ $application->status }}</span>
                                </td>
                            @elseif ($application->status == 'Rejected')
                                <td>
                                    <span class="rounded-pill company-info bg-danger text-white">{{ $application->status }}</span>
                                </td>
                            @elseif ($application->status == 'Hired')
                                <td>
                                    <span class="rounded-pill company-info bg-success text-white">{{ $application->status }}</span>
                                </td>
                            @elseif ($application->status == 'Withdrawn')
                                <td>
                                    <span class="rounded-pill company-info bg-secondary text-white">{{ $application->status }}</span>
                                </td>
                            @endif
                            @if ($application->status != 'Withdrawn')
                                <td>
                                    <a href="{{ route('applicant.detail', $application->id) }}"
                                        class="btn btn-sm pink">View</a>
                                </td>

                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
