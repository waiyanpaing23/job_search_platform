@extends('admin.layouts.master')

@section('title', 'Companies')

@section('content')

    <div class="container p-4">
        <div class="row">
            <div>
                <h4 class="fw-bold">Company Management</h4>
            </div>
        </div>
        <div class="row pt-3 d-flex justify-content-between">
            <div class="col-12 col-md-4">
                <form action="#" method="GET">
                    <div class="input-group mt-1 mb-4">
                        <input type="text" class="form-control input-box bg-white" name="searchData"
                            placeholder="Search by name or location" aria-describedby="basic-addon2"
                            value="{{ old('searchData') }}">

                        <button type="submit" class="btn pink"><i class="fa-solid fa-magnifying-glass me-1"></i>
                            Search</button>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-3">
                <ul class="navbar-nav me-auto category-filter py-1 pt-2 px-3 rounded">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle text-muted" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ request('industry') && $companies->firstWhere('industry', request('industry'))
                                ? $companies->firstWhere('industry', request('industry'))->industry
                                : 'Filter by Industry' }}
                        </a>
                        <ul class="dropdown-menu scrollable">
                            <li>
                                <a class="dropdown-item mt-2" href="{{ route('admin.users') }}">
                                    All Companies
                                </a>
                            </li>
                            @foreach ($industries as $industry)
                                <li>
                                    <a class="dropdown-item mt-2"
                                        href="{{ route('admin.companies', ['industry' => $industry]) }}">
                                        {{ $industry->industry }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col table-container">
                <table class="table table-hover company-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Company</th>
                            <th scope="col">Website</th>
                            <th scope="col">Employees</th>
                            <th scope="col">Location</th>
                            <th scope="col">Company Email</th>
                            <th scope="col">Job Posts</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td class="fw-bold">{{ $loop->iteration }}</td>
                                <td>
                                    <div class="text-decoration-none text-dark">
                                        <div class="d-flex applicant-list align-items-center">
                                            <img src="{{ asset('images/' . $company->company_logo) }}"
                                                class="img-fluid logo-small me-3">
                                            <div>
                                                <span class="d-block">{{ $company->company_name }}</span>
                                                <small class="text-muted">{{ $company->industry }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $company->website_url }}</td>
                                <td class="text-center">{{ $company->company_size }}</td>
                                <td>{{ $company->location }}</td>
                                <td>
                                    <span>{{ $company->contact_email }}</span>
                                </td>
                                <td class="text-center">{{ $company->jobs->count() }}</td>
                                <td>
                                    <span class="bg-cyan fw-bold badge text-dark p-2">
                                        {{ $company->status }}
                                    </span>
                                <td>
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item dropdown">
                                            <a href="#" class="nav-link px-3" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical text-black"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('company.detail', $company->id) }}">View
                                                        Company Profile</a></li>
                                                <li>
                                                    @if ($company->status == 'Pending')
                                                <li>
                                                    <form action="{{ route('company.status.update', $company->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="Approved">
                                                        <button type="submit"
                                                            class="btn btn-link text-decoration-none text-dark">Approve
                                                            Company</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('company.status.update', $company->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="status" value="Rejected">
                                                        <button type="submit"
                                                            class="btn btn-link text-decoration-none text-dark">Reject
                                                            Company</button>
                                                    </form>
                                                </li>
                                            @endif
                                         </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
