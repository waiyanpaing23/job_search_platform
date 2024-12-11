<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Category;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Job;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    public function list() {
        $categories = Category::all();

        $jobs = Job::with('employer.company')
                ->when(request('searchData'), function($query) {
                    $query->whereAny(['job_title', 'job_type', 'category_id'],'like','%'.request('searchData').'%');
                })
                ->when(request('category'), function($query) {
                    $query->where('category_id', request('category'));
                })
                ->when(request('job_type'), function($query) {
                    $query->where('job_type', request('job_type'));
                })
                ->paginate(8);

        return view('user.list', compact('jobs', 'categories'));
    }

    public function profile() {
        $applicant = Auth::user()->applicant;
        $experiences = $applicant->experiences;
        $educations = $applicant->educations;

        return view('applicant.profile', compact('applicant', 'experiences', 'educations'));
    }

    public function editProfile() {
        $applicant = Auth::user()->applicant;
        $experiences = $applicant->experiences;
        $educations = $applicant->educations;
        $skills = Skill::all();

        return view('applicant.editProfile', compact('applicant', 'experiences', 'educations', 'skills'));
    }

    public function updateProfile(Request $request) {
        $this->validateProfile($request);

        $userData =  [
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email
        ];

        $applicantData = [
            'date_of_birth' => $request->dateofbirth,
            'phone' => $request->phone,
            'about' => $request->about,
            'linkedin' => $request->linkedin,
            'github' => $request->github,
            'twitter' => $request->twitter,
            'portfolio_link' => $request->portfolioLink
        ];

        $applicant = Auth::user()->applicant;


        User::find(Auth::user()->id)->update($userData);

        Applicant::find($applicant->id)->update($applicantData);

        return to_route('applicant.profile')->with([
            'title' => 'Updated Successfully',
            'message' => 'Your profile has updated successfully!.'
        ]);
    }

    private function validateProfile($request)
    {
        $request->validate([
            'firstname' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id
        ]);
    }
}
