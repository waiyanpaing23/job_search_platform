@extends('admin.layouts.master')

@section('title', 'Users')

@section('content')

    <div class="container p-4">
        <div class="row">
            <div>
                <h4 class="fw-bold">User Management</h4>
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
            <div class="col-12 col-md-4">
                <ul class="navbar-nav me-auto category-filter py-1 pt-2 px-3 rounded">
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle text-muted" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ request('role') && $users->firstWhere('role', request('role'))
                                ? $users->firstWhere('role', request('role'))->role
                                : 'Filter by Role' }}
                        </a>
                        <ul class="dropdown-menu scrollable">
                            <li>
                                <a class="dropdown-item mt-2" href="{{ route('admin.users') }}">
                                    All Users
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item mt-2" href="{{ route('admin.users', ['role' => 'Applicants']) }}">
                                    Applicants
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item mt-2" href="{{ route('admin.users', ['role' => 'Employers']) }}">
                                    Employers
                                </a>
                            </li>
                            @if (Auth::user()->role == 'superadmin')
                            <li>
                                <a class="dropdown-item mt-2" href="{{ route('admin.users', ['role' => 'Admins']) }}">
                                    Admins
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="fw-bold">{{ $loop->iteration }}</td>
                                <td>
                                    <a href="" class="text-decoration-none text-dark">
                                        <div class="d-flex applicant-list align-items-center">
                                            <img src="{{ $user->profile_image ? asset('images/' . $user->profile_image) : asset('images/profile.jpg') }}"
                                                class="img-fluid rounded-circle nav-profile me-3">
                                            <div>
                                                <span class="d-block applicant-name">{{ $user->first_name }}
                                                    {{ $user->last_name }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == 'user')
                                        <span class="badge bg-cyan text-black p-2">Applicant</span>
                                    @elseif ($user->role == 'employer')
                                        <span class="badge bg-cyan text-black p-2">Employer</span>
                                    @elseif ($user->role == 'admin')
                                        <span class="badge bg-cyan text-black p-2">Admin</span>
                                    @endif
                                </td>
                                <td>
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item dropdown">
                                            <a href="#" class="nav-link px-3" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical text-black"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('applicant.profile') }}">View
                                                        Profile</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger"
                                                        href="{{ route('application.list') }}">Delete User</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
