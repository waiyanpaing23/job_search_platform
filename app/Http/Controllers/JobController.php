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

    public function list(){
        $employer = Auth::user()->employer;
        $company = $employer->company;

        if (!$company) {
            return redirect()->back()->with([
                'title' => 'Error',
                'message' => 'You do not have a company associated with your profile.'
            ]);
        }

        $jobs = Job::where('company_id', $company->id)
                ->when(request('searchData'), function($query) {
                    $query->whereAny(['job_title', 'location'], 'like', '%'.request('searchData').'%');
                })
                ->when(request('category'), function($query) {
                    $query->where('category_id', request('category'));
                })
                ->when(request('status'), function($query) {
                    $query->where('status', request('status'));
                })
                ->paginate(8);

        return view('employer.myjobs', compact('jobs', 'employer', 'company'));
    }

    public function edit($id) {
        $job = Job::where('id', $id)->first();
        $categories = Category::all();

        return view('job.edit', compact('job', 'categories'));
    }

    public function update($id, Request $request) {
        $this->validateJobPost($request);

        $data = $this->requestJobData($request);

        $job = Job::where('id', $id)->update($data);

        return to_route('job.detail', ['id' => $id])->with([
            'title' => 'Job Updated Successfully!',
            'message' => 'Your job post has been updated successfully.'
        ]);
    }

    public function close($id) {
        Job::where('id', $id)->update(['status' => 'Closed']);

        return to_route('employer.job.list')->with([
            'title' => 'Job Closed Successfully!',
            'message' => 'Your job post has been closed successfully.'
        ]);
    }

    public function activate($id) {
        Job::where('id', $id)->update(['status' => 'Open']);

        return to_route('employer.job.list')->with([
            'title' => 'Job Activated Successfully!',
            'message' => 'Your job post has been activated successfully.'
        ]);
    }

    public function delete($id) {
        Job::where('id', $id)->delete();

        return to_route('employer.job.list')->with([
            'title' => 'Job Deleted Successfully!',
            'message' => 'Your job post has been deleted successfully.'
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
            'company_id' => $companyData->id,
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
