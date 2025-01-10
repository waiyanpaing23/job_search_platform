@extends('employer.layouts.master')

@section('title', 'Employer - ProsPath')

@section('styles')
<style>
    .pros{
        color: white
    }
    .nav-link, .nav-employer{
        color: white !important;
        font-weight: 500 !important;
    }
    .employer-slider {
        height: 550px;
        background-image: url('/images/employer.jpg');
        background-size: cover;
        background-color: #3b3b3b;
        background-blend-mode: multiply;
    }
    .navbar {
        background: transparent;
        border: none !important;
    }
</style>
@endsection

@section('text')
<div class="row text px-5">
    <div class="col-5 p-5">
        <h2>Find the Perfect Candidates for Your Next Big Project!</h2>
        <p class="mt-4 subtext">Connect with skilled professionals who match your company’s needs. Start posting jobs today!</p>
        @if(Auth::check())
            <a href="{{ route('job.new') }}" class="btn pink">Post Your Job</a>
        @else
            <a href="{{ route('employer.login') }}" class="btn pink">Sign in as Employer</a>
        @endif
    </div>
</div>
@endsection

@section('content')
<div">
    <h3 class="text-center mt-5 mb-4">Find the Right Talent, Quick and Easy</h3>
    <div class="row d-flex justify-content-center">
        <div class="col-3 p-5 userguide">
            <i class="fa-solid fa-1 px-3 py-2 mb-4 rounded-circle bg-dark text-white h3"></i>
            <h5 class="mb-4">List Available Roles</h5>
            <p class="text-muted text-center">Easily share your job openings to reach the talent you need.</p>
        </div>
        <div class="col-3 p-5 userguide">
            <i class="fa-solid fa-2 px-3 py-2 mb-4 rounded-circle bg-dark text-white h3"></i>
            <h5 class="mb-4">Seek Out Talent</h5>
            <p class="text-muted text-center">Explore skilled candidates ready to contribute to your goals.</p>
        </div>
        <div class="col-3 p-5 userguide">
            <i class="fa-solid fa-3 px-3 py-2 mb-4 rounded-circle bg-dark text-white h3"></i>
            <h5 class="mb-4">Strengthen Your Workforce</h5>
            <p class="text-muted text-center">Bring in the best people to push your organization to new heights.</p>
        </div>
    </div>
</div>
@endsection
