<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class JobController extends Controller
{
    public function create() {

        $categories = Category::all();
        $employer = Auth::user()->employer;

        if($employer->company_id == null) {

            return to_route('employer.profile')->with([
                'title' => "Link Your Profile to a Company",
                'message' => 'Please link your profile to company before posting a job.'
            ]);
        }

        $employer->load('company');

        return view('employer.create', compact('categories', 'employer'));
    }

    public function store(Request $request) {
        $this->validateJobPost($request);

        $data = $this->requestJobData($request);

        Job::create($data);

        return to_route('employer')->with([
            'title' => 'Job Posted Successfully!',
            'message' => 'Your job post has been created successfully. You can view or manage your job posts in [ My Jobs ].'
        ]);
    }

    private function validateJobPost($request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'company' => 'required',
            'maxSalary' => 'gt:minSalary',
            'location' => 'required',
            'category' => 'required',
            'jobtype' => 'required',
            'contactEmail' => 'required',
            'requirement' => 'required'
        ]);
    }

    private function requestJobData($request) {

        $employerData = Employer::where('user_id', Auth::user()->id)->first();

        $companyData = Company::where('company_name', $request->company)->first();

        return [
            'job_title' => $request->title,
            'description' => $request->description,
            'company' => $companyData->id,
            'location' => $request->location,
            'job_type' => $request->jobtype,
            'category_id' => $request->category,
            'min_salary' => $request->minSalary,
            'max_salary' => $request->maxSalary,
            'expiry_date' => $request->expiryDate,
            'employer_id' => $employerData->id,
            'contact_email' => $request->contactEmail,
            'requirement' => $request->requirement,
            'benefit' => $request->benefit,
        ];
    }
}
