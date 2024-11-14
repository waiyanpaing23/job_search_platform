<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function create() {

        $categories = Category::all();
        $companies = Company::all();

        return view('employer.create', compact('categories', 'companies'));
    }

    public function store(Request $request) {
        $this->validateJobPost($request);

        $data = $this->requestJobData($request);

        Job::create($data);

        return to_route('employer');
    }

    private function validateJobPost($request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'company' => 'required',
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
