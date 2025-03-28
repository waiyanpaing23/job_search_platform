@extends('layouts/master')

@section('title')
{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} | Edit Profile
@endsection

@section('content')
    <div class="container-fluid row d-flex justify-content-center p-5">
        <div class="col-12 col-md-10">
            <div class="row d-flex justify-content-center">

                <div class="col-12 col-lg-9">
                    <a href="{{ route('applicant.profile') }}" class="text-dark"><i class="fa-solid fa-arrow-left h3"></i></a>

                    <div class="border border-radius bg-white mt-3">

                        <h4 class="p-4 bg-dark text-white header"><b>Edit Profile</b></h4>
                        <div class="row">
                            <div class="row d-flex align-items-center">
                                <div class="col-md-2">
                                    <img src="{{ Auth::user()->profile_image ? asset('images/' . Auth::user()->profile_image) : asset('images/profile.jpg') }}"
                                        class="img-fluid rounded-circle profile my-4" id="profile"><br>
                                </div>
                                <div class="col-5 ms-1">
                                    <form action="{{ route('profile.image.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="oldImage" value="{{ Auth::user()->profile_image }}">
                                        <input type="file" class="input-file form-control" name="profile"
                                            onchange="loadFile(event)">
                                </div>
                                <div class="col d-flex">
                                    <button type="submit" class="btn pink px-4 me-1">
                                        <i class="fa-solid fa-floppy-disk"></i> Save
                                    </button>
                                    </form>
                                    <a href="{{ route('profile.image.remove') }}" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i> Remove
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-container mt-3">

                        <form action="{{ route('applicant.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="btn-group bg-white w-100" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"
                                    checked>
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
                                        <input type="text" value="{{ Auth::user()->first_name }}" name="firstname"
                                            class="form-control input-box rounded w-100 px-3 mb-4">
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label for="name" class="mb-2 fw-semibold">Last Name</label>
                                        <input type="text" value="{{ Auth::user()->last_name }}" name="lastname"
                                            class="form-control input-box rounded w-100 px-3 mb-4">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label for="name" class="mb-2 fw-semibold">Date of Birth</label>
                                        <input type="date" name="dateofbirth"
                                            value="{{ $applicant->date_of_birth ? $applicant->date_of_birth : '' }}"
                                            class="form-control input-box rounded w-100 px-3 mb-4">
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label for="name" class="mb-2 fw-semibold">Personal Email</label>
                                        <input type="text" value="{{ Auth::user()->email }}" name="email"
                                            class="form-control input-box rounded w-100 px-3 mb-4">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label for="name" class="mb-2 fw-semibold">Phone Number</label>
                                        <input type="text" value="{{ $applicant->phone }}" name="phone"
                                            class="form-control input-box rounded w-100 px-3 mb-4">
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <label for="name" class="mb-2 fw-semibold">Location</label>
                                        <input type="text" value="{{ $applicant->address }}" name="address"
                                            class="form-control input-box rounded w-100 px-3 mb-4">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="name" class="mb-2 fw-semibold">Bio</label>
                                        <input type="text"value="{{ $applicant->bio }}" name="bio"
                                            class="form-control input-box rounded w-100 px-3 mb-4">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="name" class="mb-2 fw-semibold">Portfolio Link</label>
                                        <input type="text"value="{{ $applicant->portfolio_link }}" name="portfolioLink"
                                            class="form-control input-box rounded w-100 px-3 mb-4">
                                    </div>
                                </div>

                                <div class="row">
                                    <label for="name" class="mb-2 fw-semibold">Social Media</label>
                                    <div class="col-12 col-sm-4">
                                        <input type="text" placeholder="Linkedin URL" name="linkedin"
                                            value="{{ $applicant->linkedin ? $applicant->linkedin : '' }}"
                                            class="form-control input-box rounded w-100 px-3 mb-4">
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <input type="text" placeholder="GitHub URL" name="github"
                                            value="{{ $applicant->github ? $applicant->github : '' }}"
                                            class="form-control input-box rounded w-100 px-3 mb-4">
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <input type="text" placeholder="Twitter/X URL" name="twitter"
                                            value="{{ $applicant->twitter ? $applicant->twitter : '' }}"
                                            class="form-control input-box rounded w-100 px-3 mb-4">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <label for="name" class="mb-2 fw-semibold">About</label>
                                        <textarea class="form-control rounded w-100 px-3 mb-4" name="about" rows="3">{{ $applicant->about }}</textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-4 me-3">
                                    <input type="submit" class="btn pink" value="Save Changes">
                                </div>
                            </div>
                        </form>

                        {{-- Experience Tab --}}
                        <div class="content p-4 border rounded bg-white mt-3" id="expContent">
                            <h4 class="fw-bold mb-4">Experience</h4>
                            <form action="{{ route('experience.update') }}" method="POST">
                                @csrf
                                @foreach ($experiences as $experience)
                                    <div class="profile-content px-3 mb-5">

                                        <input type="hidden" name="experiences[{{ $experience->id }}][id]"
                                            value="{{ $experience->id }}">

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <label for="job_title_{{ $experience->id }}" class="mb-2 fw-semibold">Job
                                                    Title</label>
                                                <input type="text" id="job_title_{{ $experience->id }}"
                                                    name="experiences[{{ $experience->id }}][jobtitle]"
                                                    value="{{ $experience->job_title }}"
                                                    class="form-control input-box rounded w-100 px-3 mb-4">
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <label for="company_{{ $experience->id }}"
                                                    class="mb-2 fw-semibold">Company</label>
                                                <input type="text" id="company_{{ $experience->id }}"
                                                    name="experiences[{{ $experience->id }}][company]"
                                                    value="{{ $experience->company }}"
                                                    class="form-control input-box rounded w-100 px-3 mb-4">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <label for="start_date_{{ $experience->id }}" class="mb-2 fw-semibold">Start
                                                    Date</label>
                                                <input type="date" id="start_date_{{ $experience->id }}"
                                                    name="experiences[{{ $experience->id }}][startDate]"
                                                    value="{{ $experience->start_date }}"
                                                    class="form-control input-box rounded w-100 px-3 mb-4">
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <label for="end_date_{{ $experience->id }}" class="mb-2 fw-semibold">End
                                                    Date</label>
                                                <input type="date" id="end_date_{{ $experience->id }}"
                                                    name="experiences[{{ $experience->id }}][endDate]"
                                                    value="{{ $experience->end_date }}"
                                                    class="form-control input-box rounded w-100 px-3 mb-4">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <label for="responsibilities_{{ $experience->id }}"
                                                    class="mb-2 fw-semibold">Description</label>
                                                <textarea id="responsibilities_{{ $experience->id }}" name="experiences[{{ $experience->id }}][responsibilities]"
                                                    class="form-control rounded w-100 px-3 mb-4" rows="3">{{ $experience->responsibilities }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <a href="{{ route('experience.delete', $experience->id) }}"
                                                    class="btn btn-sm btn-outline-danger w-100"><i
                                                        class="fa-solid fa-trash"></i> Delete Experience</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="d-flex justify-content-end mt-3">
                                    <span class="addexp py-2 px-4 me-4 border rounded shadow-sm" onclick="showExpForm(event)"
                                        id="addBtn">
                                        <i class="fa-solid fa-plus me-2"></i> Add Experience
                                    </span>
                                </div>

                                <div class="d-flex justify-content-end mt-3 me-4">
                                    <button type="submit" class="btn pink">Save Changes</button>
                                </div>
                            </form>
                        </div>

                        {{-- Education tab --}}
                        <div class="content p-4 border rounded bg-white mt-3" id="eduContent">
                            <h4 class="fw-bold mb-4">Education</h4>
                            <form action="{{ route('education.update') }}" method="POST">
                                @csrf
                                @foreach ($educations as $education)
                                    <div class="profile-content px-3 mb-5">
                                        <input type="hidden" name="educations[{{ $education->id }}][id]"
                                            value="{{ $education->id }}">

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <label for="degree_{{ $education->id }}"
                                                    class="mb-2 fw-semibold">Degree</label>
                                                <input type="text" id="degree_{{ $education->id }}"
                                                    name="educations[{{ $education->id }}][degree]"
                                                    value="{{ $education->degree }}"
                                                    class="form-control input-box rounded w-100 px-3 mb-4">
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <label for="fieldofstudy{{ $education->id }}" class="mb-2 fw-semibold">Field
                                                    of Study</label>
                                                <input type="text" id="fieldofstudy{{ $education->id }}"
                                                    name="educations[{{ $education->id }}][fieldofstudy]"
                                                    value="{{ $education->fieldofstudy }}"
                                                    class="form-control input-box rounded w-100 px-3 mb-4">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <label for="university_{{ $education->id }}"
                                                    class="mb-2 fw-semibold">University</label>
                                                <input type="text" id="university_{{ $education->id }}"
                                                    name="educations[{{ $education->id }}][university]"
                                                    class="form-control rounded w-100 px-3 mb-4" rows="3"
                                                    value="{{ $education->university }}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <label for="start_date_{{ $education->id }}" class="mb-2 fw-semibold">Start
                                                    Date</label>
                                                <input type="date" id="start_date_{{ $education->id }}"
                                                    name="educations[{{ $education->id }}][startDate]"
                                                    value="{{ $education->start_date }}"
                                                    class="form-control input-box rounded w-100 px-3 mb-4">
                                            </div>

                                            <div class="col-12 col-sm-6">
                                                <label for="end_date_{{ $education->id }}" class="mb-2 fw-semibold">End
                                                    Date</label>
                                                <input type="date" id="end_date_{{ $education->id }}"
                                                    name="educations[{{ $education->id }}][endDate]"
                                                    value="{{ $education->end_date }}"
                                                    class="form-control input-box rounded w-100 px-3 mb-4">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-end">
                                                <a href="{{ route('education.delete', $education->id) }}"
                                                    class="btn btn-sm btn-outline-danger w-100">
                                                    <i class="fa-solid fa-trash"></i> Delete Education
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

                                <div class="d-flex justify-content-end mt-3">
                                    <span class="addexp py-2 px-4 me-4 border rounded shadow-sm" onclick="showEduForm(event)"
                                        id="addBtn">
                                        <i class="fa-solid fa-plus me-2"></i> Add Education
                                    </span>
                                </div>

                                <div class="d-flex justify-content-end mt-3 me-4">
                                    <button type="submit" class="btn pink">Save Changes</button>
                                </div>
                            </form>
                        </div>

                        <div class="content p-4 border rounded bg-white mt-3" id="skillsContent">
                            <h4 class="fw-bold mb-4">Skills</h4>
                            <div class="skills mb-4 px-3" id="applicant_skills">
                                @foreach ($applicant->skills as $skill)
                                    <div class="py-1 px-3 me-2 mb-3 rounded-pill bg-cyan" data-id="{{ $skill->id }}">
                                        <span>{{ $skill->skill }}</span>
                                        <button type="button" id="deleteSkill"
                                            class="btn btn-link p-0 text-decoration-none">
                                            <i class="fa-solid fa-xmark text-dark"></i>
                                        </button>
                                    </div>
                                @endforeach

                            </div>
                            <div class="row">
                                <div class="col-7">
                                    <div>
                                        <select name="skills" id="skills" class="input-box px-2 rounded">
                                            <option value="0">Add Skills</option>
                                            @foreach ($skills as $skill)
                                                <option value="{{ $skill->id }}">{{ $skill->skill }}</option>
                                            @endforeach
                                        </select>
                                        <button type="button" id="add_skills" class="btn pink mb-2 py-1 pt-2"><i
                                                class="fa-solid fa-plus me-2"></i> Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Experience Modal Form --}}
    <div class="modal fade" id="expModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <form action="{{ route('experience.create') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-2 fw-semibold">Job Title</label>
                            <input type="text" name="jobtitle" placeholder="Enter your role"
                                value="{{ old('jobtitle') }}" class="form-control input-box rounded w-100 px-3 mb-4">
                            @error('jobtitle')
                                <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-2 fw-semibold">Company</label>
                            <input type="text" value="{{ old('company') }}" name="company"
                                placeholder="Enter your company" class="form-control input-box rounded w-100 px-3 mb-4">
                            @error('company')
                                <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-2 fw-semibold">Start Date</label>
                            <input type="date" value="{{ old('startDate') }}" name="startDate"
                                class="form-control input-box rounded w-100 px-3 mb-4">
                            @error('startDate')
                                <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-2 fw-semibold">End Date</label>
                            <input type="date" value="{{ old('endDate') }}" name="endDate"
                                class="form-control input-box rounded w-100 px-3 mb-4">
                            @error('endDate')
                                <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="name" class="mb-2 fw-semibold">Description</label>
                            <textarea class="form-control rounded w-100 px-3 mb-4" rows="3" name="responsibilities"
                                placeholder="Briefly describe your role and responsibilities">{{ old('responsibilities') }}</textarea>
                            @error('responsibilities')
                                <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3 me-2">
                        <button class="btn pink" type="submit">
                            <i class="fa-solid fa-plus me-2"></i> Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Education Modal Form --}}
    <div class="modal fade" id="eduModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-4">
                <form action="{{ route('education.create') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-2 fw-semibold">Degree</label>
                            <input type="text" name="degree" placeholder="Enter your degree"
                                value="{{ old('degree') }}" class="form-control input-box rounded w-100 px-3 mb-4">
                            @error('degree')
                                <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-2 fw-semibold">Field of Study</label>
                            <input type="text" value="{{ old('fieldofstudy') }}" name="fieldofstudy"
                                placeholder="Enter your specialization"
                                class="form-control input-box rounded w-100 px-3 mb-4">
                            @error('fieldofstudy')
                                <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label for="name" class="mb-2 fw-semibold">University</label>
                            <input type="text" class="form-control input-box rounded w-100 px-3 mb-4"
                                name="university" placeholder="Enter the name of the university or institution"
                                value="{{ old('university') }}"">
                            @error('university')
                                <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-2 fw-semibold">Start Date</label>
                            <input type="date" value="{{ old('startDate') }}" name="startDate"
                                class="form-control input-box rounded w-100 px-3 mb-4">
                            @error('startDate')
                                <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-12 col-sm-6">
                            <label for="name" class="mb-2 fw-semibold">End Date</label>
                            <input type="date" value="{{ old('endDate') }}" name="endDate"
                                class="form-control input-box rounded w-100 px-3 mb-4">
                            @error('endDate')
                                <small class="text-sm text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3 me-2">
                        <button class="btn pink" type="submit">
                            <i class="fa-solid fa-plus me-2"></i> Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).on('click', '#add_skills', function() {
            let selectedSkills = $('#skills').val();

            function ajaxSkills() {
                $.ajax({
                    type: 'POST',
                    url: "/applicant/skills/add",
                    data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token
                        skills: selectedSkills // Send the selected skills array
                    },
                    success: function(response) {
                        $('#skills').val([]); // Clear the selection
                        let skills_html = [];
                        let new_skills = response.skills;

                        new_skills.forEach(skill => {
                            skills_html += `
                            <div class="py-1 px-3 me-2 mb-3 rounded-pill bg-cyan" data-id="${skill.id}">
                                <span>${skill.skill}</span>
                                <button type="button" id="deleteSkill"
                                        class="btn btn-link p-0 text-decoration-none">
                                        <i class="fa-solid fa-xmark text-dark"></i>
                                    </button>
                            </div>
                        `;
                        });

                        $('#applicant_skills').html(skills_html);
                        console.log('successful');
                        // }

                    },
                });
            }

            ajaxSkills();

        });

        $(document).on('click', '#deleteSkill', function() {
            let skillElement = $(this).closest('div');
            let skillId = skillElement.data('id');

            $.ajax({
                type: 'DELETE',
                url: `/applicant/skills/delete/${skillId}`, // RESTful endpoint for deleting a skill
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Remove the skill element from the DOM
                        skillElement.remove();
                        console.log('Skill deleted successfully');
                    } else {
                        alert('Error: Unable to delete skill');
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while deleting the skill.');
                }
            });
        });

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

            function showContent(contentId) {
                const contents = document.querySelectorAll('.content');
                contents.forEach(function(content) {
                    content.style.display = 'none';
                });

                const selectedContent = document.getElementById(contentId);
                selectedContent.style.display = 'block';
            }
        });

        function showExpForm(event) {
            var modal = new bootstrap.Modal(document.getElementById('expModal'));
            modal.show();
        }

        function showEduForm(event) {
            var modal = new bootstrap.Modal(document.getElementById('eduModal'));
            modal.show();
        }
    </script>
@endsection
