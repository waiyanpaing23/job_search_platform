@extends('employer/layouts/master')

@section('content')
    <div class="container-fluid p-5">

        <div class="row d-flex justify-content-center">

            <div class="col-12 col-lg-8">

                <a href="{{ route('employer.profile') }}" class="text-dark"><i class="fa-solid fa-arrow-left h3"></i></a>

                <form action="{{ route('employer.company.search') }}" method="GET">
                    <div class="input-group mb-3 mt-4">
                        <input type="text" class="form-control search" name="searchData"
                        placeholder="Search company, industry or location" aria-describedby="basic-addon2">
                        <input type="submit" class="btn pink" value="Search">
                    </div>
                </form>

                @foreach ($companies as $company)
                <div class="border rounded mb-3 company">
                    <div class="row d-flex justify-content-between align-items-center pt-2">
                        <div class="row d-flex align-items-center">
                            <div class="col-2">
                                <img src="{{ asset('images/'.$company->company_logo) }}"
                                    class="img-fluid rounded"><br>
                            </div>
                            <div class="col">
                                <a href="{{ route('company.detail', $company->id) }}" class="text-decoration-none text-black company-link">
                                    <h5><b>{{ $company->company_name }}</b></h5>
                                </a>
                                <p class="text-muted">{{ $company->industry }}</p>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <a href="{{ route('company.link', $company->id) }}" class="btn btn-sm btn-dark"><i class="fa-solid fa-link me-2"></i> Link</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </div>
@endsection
