@extends('employer/layouts/master')

@section('content')
    <div class="container p-5">

        <div class="row">
            <div class="col">

                <div class="p-4 rounded border">
                    <h4><b>Personal Profile</b></h4>

                    <div class="row d-flex align-items-center">
                        <div class="col-4">
                            <img src="{{ asset('images/jobseeker.png') }}" class="img-fluid rounded-circle bg-primary my-4"><br>
                        </div>
                        <div class="col-8">
                            <h5><b>{{ Auth::user()->name }}</b></h5>
                        </div>
                    </div>

                    <div class="ms-2">
                        <p class="text-muted"><i class="fa-solid fa-envelope me-2" ></i> {{ Auth::user()->email }}</p>
                        <p class="text-muted"><i class="fa-solid fa-phone me-2" ></i> {{ Auth::user()->email }}</p>
                        <p class="text-muted"><i class="fa-solid fa-building me-2" ></i> {{ Auth::user()->email }}</p>
                    </div>

                </div>
            </div>
            <div class="col-8">
                <div class="p-4 border rounded">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('images/jobseeker.png') }}" class="img-fluid rounded-circle bg-primary my-4 employer-img"><br>
                    </div>

                    <label for="name" class="mb-1 fw-semibold">Name</label>
                    <input type="text" value="{{ Auth::user()->name }}" class="input-box rounded w-100 px-3 mb-3">

                    <label for="name" class="mb-1 fw-semibold">Email</label>
                    <input type="text" value="{{ Auth::user()->email }}" class="input-box rounded w-100 px-3 mb-3">

                    <label for="name" class="mb-1 fw-semibold">Phone</label>
                    <input type="text" value="{{ Auth::user()->email }}" class="input-box rounded w-100 px-3 mb-3">

                    <label for="name" class="mb-1 fw-semibold">Company</label>
                    <input type="text" value="{{ Auth::user()->email }}" class="input-box rounded w-100 px-3 mb-3">
                </div>
            </div>
        </div>
    </div>
@endsection
