@extends('layouts/master')

@section('content')
    <div class="container p-5">

        <div class="row d-flex justify-content-center">

            <div class="col-12 col-lg-8">

                <h4 class="mb-4"><b>Applicant Profile</b></h4>

                <div class="px-4 py-2 border border-radius bg-white">
                    <div class="row">


                        <div class="row d-flex align-items-center">
                            <div class="col-2">
                                <img src="{{ Auth::user()->profile_image ? asset('images/' . Auth::user()->profile_image) : asset('images/profile.jpg') }}"
                                    class="img-fluid rounded-circle profile my-4"><br>
                            </div>
                            <div class="col ms-1">
                                <h5><b>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</b></h5>
                                {{-- @if(Auth::id() == $applicant->user_id)
                                <a href="" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-circle-down"></i> Download Resume</a>
                                @endif --}}

                            </div>
                            <div class="col d-flex justify-content-end">
                                <a href="{{ route('applicant.profile.edit') }}" class="btn pink mb-4">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-container mt-3">

                    <div class="btn-group bg-white" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                        <label class="btn tab" for="btnradio1">About</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                        <label class="btn tab" for="btnradio2">Experience</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                        <label class="btn tab" for="btnradio3">Education</label>

                        <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                        <label class="btn tab" for="btnradio4">Skills</label>
                    </div>


                    <div class="content p-4 border rounded bg-white mt-3" id="aboutContent">
                        <h4 class="fw-bold mb-4">Personal Information</h4>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-2 fw-semibold">First Name</label>
                                <input type="text" value="{{ Auth::user()->first_name }}"
                                    class="form-control input-box rounded w-100 px-3 mb-4" disabled>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-2 fw-semibold">Last Name</label>
                                <input type="text" value="{{ Auth::user()->last_name }}"
                                    class="form-control input-box rounded w-100 px-3 mb-4" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-2 fw-semibold">Date of Birth</label>
                                <input type="text"
                                    value="{{ $applicant->date_of_birth ? \Carbon\Carbon::parse($applicant->date_of_birth)->format('d/m/Y') : '' }}"
                                    class="form-control input-box rounded w-100 px-3 mb-4" disabled>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label for="name" class="mb-2 fw-semibold">Personal Email</label>
                                <input type="text" value="{{ Auth::user()->email }}"
                                    class="form-control input-box rounded w-100 px-3 mb-4" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="name" class="mb-2 fw-semibold">Phone Number</label>
                                <input type="text" value="{{ $applicant->phone }}"
                                    class="form-control input-box rounded w-100 px-3 mb-4" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="name" class="mb-2 fw-semibold">Portfolio Link</label>
                                <input type="text"value="{{ $applicant->portfolio_link }}" name="portfolioLink"
                                    class="form-control input-box rounded w-100 px-3 mb-4" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <label for="name" class="mb-2 fw-semibold">About</label>
                                <textarea class="form-control rounded w-100 px-3 mb-4" rows="3" disabled>{{ $applicant->about }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="social-media">
                                <a href="{{ $applicant->linkedin }}" class="text-decoration-none text-dark">
                                    <i class="fa-brands fa-linkedin-in rounded border rounded-circle p-2 h3 me-3"></i>
                                </a>
                                <a href="{{ $applicant->github }}" class="text-decoration-none text-dark">
                                    <i class="fa-brands fa-github rounded border rounded-circle p-2 h3 me-3"></i>
                                </a>
                                <a href="{{ $applicant->twitter }}" class="text-decoration-none text-dark">
                                    <i class="fa-brands fa-x-twitter rounded border rounded-circle p-2 h3 me-3"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="content p-4 border rounded bg-white mt-3" id="expContent">
                        <h4 class="fw-bold mb-4">Experience</h4>
                        @if ($experiences->isEmpty())
                            <div class="profile-content px-3">
                                <p><i>Your work experience will appear here once you add it.</i></p>
                            </div>
                        @else
                            @foreach ($experiences as $experience)
                                <div class="profile-content px-3 mb-4">
                                    <h5 class="fw-bold">{{ $experience->job_title }}</h5>
                                    <span class="text-custom mb-1">{{ $experience->company }}</span>
                                    <div class="text-muted">
                                        {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} -
                                        {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                                    </div>
                                    <p class="text-muted">{{ $experience->responsibilities }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="content p-4 border rounded bg-white mt-3" id="eduContent">
                        <h4 class="fw-bold mb-4">Education</h4>
                        @if ($educations->isEmpty())
                            <div class="profile-content px-3">
                                <p><i>Your work experience will appear here once you add it.</i></p>
                            </div>
                        @else
                            @foreach ($educations as $education)
                                <div class="profile-content px-3 mb-4">
                                    <h5 class="fw-bold">{{ $education->degree }}</h5>
                                    <span class="text-muted mb-1">{{ $education->fieldofstudy }}</span>
                                    <span class="text-custom mb-1 d-block">{{ $education->university }}</span>
                                    <div class="text-muted">
                                        {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }} -
                                        {{ \Carbon\Carbon::parse($education->end_date)->format('M Y') }}
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>

                    <div class="content p-4 border rounded bg-white mt-3" id="skillsContent">
                        <h4 class="fw-bold mb-4">Skills</h4>
                        <div class="skills">
                            @if ($applicant->skills->isEmpty())
                                <span class="profile-content px-3"><i>Your skills will appear here once you add
                                        them.</i></span>
                            @else
                                @foreach ($applicant->skills as $skill)
                                    <div class="py-1 px-3 me-2 rounded-pill">{{ $skill->skill }}</div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all the buttons and content sections
            const aboutBtn = document.getElementById('btnradio1');
            const experienceBtn = document.getElementById('btnradio2');
            const educationBtn = document.getElementById('btnradio3');
            const skillsBtn = document.getElementById('btnradio4');

            const aboutContent = document.getElementById('aboutContent');
            const experienceContent = document.getElementById('expContent');
            const educationContent = document.getElementById('eduContent');
            const skillsContent = document.getElementById('skillsContent');

            aboutContent.style.display = 'block';
            expContent.style.display = 'none';
            eduContent.style.display = 'none';
            skillsContent.style.display = 'none';

            // Add click events to the buttons
            aboutBtn.addEventListener('click', function() {
                showContent('aboutContent');
            });

            experienceBtn.addEventListener('click', function() {
                showContent('expContent');
            });

            educationBtn.addEventListener('click', function() {
                showContent('eduContent');
            });

            skillsBtn.addEventListener('click', function() {
                showContent('skillsContent');
            });

            // Function to show the relevant content and hide others
            function showContent(contentId) {
                // Hide all content sections
                const contents = document.querySelectorAll('.content');
                contents.forEach(function(content) {
                    content.style.display = 'none';
                });

                // Show the selected content
                const selectedContent = document.getElementById(contentId);
                selectedContent.style.display = 'block';
            }
        });
    </script>
@endsection
