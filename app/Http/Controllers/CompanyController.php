<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function create() {
        $companies = Company::all();
        $categories = Category::all();

        return view('company.create', compact('categories', 'companies'));
    }

    public function store(Request $request) {
        $this->validateCompanyData($request, 'create');
        $data = $this->requestCompanyData($request);

        $file = $request->file('image');
        $filename = uniqid().$file->getClientOriginalName();
        $file->move(public_path().'/images/',$filename);

        $data['company_logo'] = $filename;

        $company = Company::create($data);

        Employer::find(Auth::user()->employer->id)->update([
            'company_id' => $company->id
        ]);

        return to_route('employer.profile')->with([
            'title' => 'Company Profile Created Successfully',
            'message' => 'Your company profile has been created. Please wait for admin approval to access job-related features.'
        ]);
    }

    public function search() {
        $companies = Company::where('status', 'Approved')
                    ->when(request('searchData'), function($query) {
                        $query->whereAny(['company_name', 'industry', 'location'],'like', '%'.request('searchData').'%');
                    })
                    ->get();

        return view('company.search', compact('companies'));
    }

    public function link($id) {
        $employer = Auth::user()->employer;

        Employer::find($employer->id)->update([
            'company_id' => $id
        ]);

        return to_route('employer.profile')->with([
            'title' => 'Company Linked Successfully',
            'message' => 'Your profile has been successfully linked to the company.'
        ]);
    }

    public function edit() {
        $categories = Category::all();

        $employer = Auth::user()->employer;
        $company = $employer->company;

        return view('company.edit', compact('company', 'categories'));
    }

    public function update(Request $request) {
        $this->validateCompanyData($request, 'update');

        $data = $this->requestCompanyData($request);

        $oldImage = $request->oldImage;

        if($request->hasFile('image')) {
            if(file_exists(public_path('images/'.$oldImage))) {
                unlink(public_path('images/'.$oldImage));
            }

            $file = $request->file('image');
            $filename = uniqid().$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $data['company_logo'] = $filename;

        } else {

            $data['company_logo'] = $oldImage;
        }

        $company = Company::where('id', $request->id)->first();

        if($company->status == 'Rejected') {
            $data['status'] = 'Pending';
        }

        Company::find($request->id)->update($data);

        $messages = [
            'Rejected' => [
                'title' => 'Resubmitted Successfully',
                'message' => 'Your company profile has been resubmitted for approval.',
            ]
        ];
        $response = $messages[$company->status] ?? [
            'title' => 'Company Updated Successfullly',
            'message' => 'Company profile has been updated successfully.',
        ];

        return to_route('employer.profile')->with($response);
    }

    public function remove() {
        $employer = Auth::user()->employer;

         Employer::find($employer->id)->update([
            'company_id' => null
        ]);

        return to_route('employer.profile')->with([
            'title' => 'Remove Company Association Successfully',
            'message' => 'You have successfully removed your association with the company!'
        ]);
    }

    public function detail($id) {
        $company = Company::where('id', $id)->first();
        $jobs = Job::where('status', 'Open')
                ->whereHas('employer', function ($query) use ($id) {
                    $query->where('id', $id);
        })->get();

        return view('company.detail', compact('company', 'jobs'));
    }

    public function list() {
        $companies = Company::withCount('jobs')
                    ->where('status', 'Approved')
                    ->when(request('searchData'), function($query) {
                        $query->whereAny(['company_name', 'location'],'like','%'.request('searchData').'%');
                    })
                    ->when(request('category'), function($query) {
                        $query->where('industry', request('category'));
                    })
                    ->get();
        $categories = Category::all();

        return view('user.companies', compact('companies', 'categories'));
    }

    private function validateCompanyData($request, $action) {
        $request->validate([
            'image' => $action == 'create'? 'required':'',
            'company_name' => 'required|unique:companies,company_name,'.$request->id,
            'description' => 'required',
            'website_url' => 'required|unique:companies,website_url,'.$request->id,
            'category' => 'required',
            'company_size' => 'required',
            'location' => 'required',
            'email' => 'required|unique:companies,contact_email,'.$request->id,
            'phone' => 'required'
        ], [
            'image.required' => 'Company logo is required.',
            'company_name.unique' => 'Company already exists.',
            'website_url.unique' => 'This URL already exists.',
            'email.unique' => 'This email already exists.'
        ]);
    }

    private function requestCompanyData($request) {
        return[
            'company_name' => $request->company_name,
            'company_description' => $request->description,
            'website_url' => $request->website_url,
            'industry' => $request->category,
            'company_size' => $request->company_size,
            'location' => $request->location,
            'contact_email' => $request->email,
            'phone' => $request->phone
        ];
    }
}
