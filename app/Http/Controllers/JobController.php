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

        if($employer?->company_id == null) {

            return to_route('employer.profile')->with([
                'title' => "Link Your Profile to a Company",
                'message' => 'Please link your profile to company before posting a job.'
            ]);
        }

        $employer?->load('company');

        return view('job.create', compact('categories', 'employer'));
    }

    public function store(Request $request) {
        $this->validateJobPost($request);

        $data = $this->requestJobData($request);

        $job = Job::create($data);

        return to_route('job.detail', ['id' => $job->id])->with([
            'title' => 'Job Posted Successfully!',
            'message' => 'Your job post has been created successfully. You can view or manage your job posts in [ My Jobs ].'
        ]);
    }

    public function detail($id) {
        $job = Job::where('id', $id)->first();

        $related_jobs = Job::where('category_id', $job->category_id)
                   ->where('id', '!=', $job->id)
                   ->latest()
                   ->limit(3)
                   ->get();

        $requirements = array_filter(explode(';', $job->requirement ));
        $benefits = array_filter(explode(';', $job->benefit));

        return view('job.detail', compact('job', 'requirements', 'benefits', 'related_jobs'));
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
            'currency' => $request->currency,
            'salary_type' => $request->salaryType,
            'expiry_date' => $request->expiryDate,
            'employer_id' => $employerData->id,
            'contact_email' => $request->contactEmail,
            'requirement' => $request->requirement,
            'benefit' => $request->benefit,
        ];
    }
}
