<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $users = User::where('role', '!=', 'admin')->get();
        $jobs = Job::all();
        $companies = Company::all();
        $applications = Application::all();
        $applicants = User::where('role', 'user')->get();
        $employers = User::where('role', 'employer')->get();
        $newUsers = User::where('role', '!=', 'admin')->where('created_at', '>=', now()->subDays(7))->get();

        return view('admin.dashboard', compact('users', 'jobs', 'companies', 'applications', 'applicants', 'employers', 'newUsers'));
    }

    public function users(Request $request) {
        $role = '';
        if($request->role == 'Applicants'){
            $role = 'user';
        }
        elseif($request->role == 'Employers'){
            $role = 'employer';
        }
        elseif($request->role == 'Admins'){
            $role = 'admin';
        }

        $users = User::where('role', '!=', 'admin')
                ->when(request('searchData'), function($query) {
                    $query->where('first_name', 'like', '%' . request('searchData') . '%')
                        ->orWhere('last_name', 'like', '%' . request('searchData') . '%')
                        ->orWhere('email', 'like', '%' . request('searchData') . '%');
                })
                ->when(request('role'), function($query) use ($role) {
                    $query->where('role', $role);
                })
                ->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function viewProfile($id) {
        $user = User::where('id', $id)->first();
        if($user->role == 'user'){
            $applicant = $user->applicant;
            $experiences = $applicant->experiences;
            $educations = $applicant->educations;

            return view('employer.viewProfile', compact('user', 'applicant', 'experiences', 'educations'));
        }
        elseif($user->role == 'employer'){
            $employer = $user->employer;

            return view('admin.employerProfile', compact('employer'));
        }
    }

    public function deleteUser($id) {
        User::where('id', $id)->delete();

        return back()->with([
            'title' => 'User Deleted Successfully!',
            'message' => 'User has been deleted successfully.'
        ]);
    }

    public function jobs() {
        $jobs = Job::when(request('searchData'), function($query) {
                    $query->whereAny(['job_title', 'location'],'like','%'.request('searchData').'%');
                })
                ->when(request('category'), function($query) {
                    $query->where('category_id', request('category'));
                })
                ->when(request('status'), function($query) {
                    $query->where('status', request('status'));
                })
                ->paginate(10);

        $categories = Category::all();

        return view('admin.jobs', compact('jobs', 'categories'));
    }

    public function companies() {
        $companies = Company::when(request('searchData'), function($query) {
                    $query->whereAny(['company_name', 'location'], 'like', '%' . request('searchData') . '%');
                })
                ->paginate(10);

        $industries = Company::select('industry')->distinct()->get();

        return view('admin.companies', compact('companies', 'industries'));
    }

    public function updateStatus($id, Request $request) {
        $company = Company::where('id', $id)->first();
        $company->update(['status' => $request->status]);

        $messages = [
            'Approved' => [
                'title' => 'Company Approved',
                'message' => 'The company, '.$company->company_name.', has been approved. The employer will now be able to post jobs and manage their company profile',
            ],
            'Rejected' => [
                'title' => 'Company Rejected',
                'message' => 'The company, '.$company->company_name.', has been rejected. The employer can edit and resubmit the company for approval if needed.',
            ]
        ];
        $response = $messages[$request->status] ?? [
            'title' => 'Status Updated',
            'message' => 'The company status has been updated successfully.',
        ];

        return back()->with($response);
    }

    public function applications() {
        $applications = Application::when(request('searchData'), function($query) {
                        $query->where(function($q) {
                            $q->whereAny(['first_name', 'last_name'],'like','%'.request('searchData').'%')
                                ->orWhereHas('job', function($q) {
                                    $q->where('job_title', 'like', '%'.request('searchData').'%');
                                })
                                ->orWhereHas('job.company', function($q) {
                                    $q->where('company_name', 'like', '%'.request('searchData').'%');
                                });
                        });
                    })
                    ->when(request('status'), function($query) {
                        $query->where('status', request('status'));
                    })
                    ->paginate(10);

        return view('admin.applications', compact('applications'));
    }

    public function applicationDelete($id) {
        Application::where('id', $id)->delete();

        return back()->with([
            'title' => 'Application Deleted Successfully!',
            'message' => 'Application has been deleted successfully.'
        ]);
    }
}
