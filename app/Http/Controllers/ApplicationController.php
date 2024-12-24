<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function application($id)
    {
        $job = Job::where('id', $id)->first();
        $applicant = Auth::user()->applicant;

        return view('applicant.applicationform', compact('job', 'applicant'));
    }

    public function submitApplication(Request $request, $id)
    {
        $this->validateApplication($request);

        $file = $request->file('resume');

        $originalName = $file->getClientOriginalName();

        $path = $file->storeAs('resumes', $originalName, 'public');

        Application::create([
            'job_id' => $id,
            'applicant_id' => Auth::user()->applicant->id,
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume' => $path,
            'portfolio_link' => $request->portfolio,
            'coverletter' => $request->coverLetter,
            'interest' => $request->interest,
            'expected_salary' => $request->salary,
            'currency' => $request->currency,
            'salary_type' => $request->salaryType
        ]);

        if ($request->has('sync')) {
            User::find(Auth::user()->id)->update([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
            ]);

            Applicant::find(Auth::user()->applicant->id)->update([
                'phone' => $request->phone,
                'portfolio_link' => $request->portfolio
            ]);
        };

        return to_route('job.detail', ['id' => $id])->with([
            'title' => 'Application Submitted Successfully!',
            'message' => "You've successfully submitted your application. The employer will review it and reach out to you soon."
        ]);
    }

    public function list()
    {
        $applicant = Auth::user()->applicant;

        $searchData = request('searchData');

        $applications = Application::where('applicant_id', $applicant->id)
            ->where(function ($query) use ($searchData) {
                $query->whereHas('job', function ($query) use ($searchData) {
                    $query->where('job_title', 'like', '%' . $searchData . '%');
                })
                    ->orWhereHas('job.employer.company', function ($query) use ($searchData) {
                        $query->where('company_name', 'like', '%' . $searchData . '%');
                    });
            })
            ->when(request('status'), function($query) {
                $query->where('status', request('status'));
            })
            ->get();
        $statuses = Application::select('status')->distinct()->pluck('status');
        $reviewed = Application::where('status', 'Reviewed')->get();
        $interview = Application::where('status', 'Interview Scheduled')->get();

        return view('applicant.applications', compact('applications', 'statuses', 'reviewed', 'interview'));
    }

    public function detail($id)
    {
        $application = Application::with('job.employer.company')->find($id);

        return view('applicant.applicationDetail', compact('application'));
    }

    public function withdraw($id) {
        $application = Application::with('job.employer.company')->find($id);
        Application::where('id', $id)->update([
            'status' => 'Withdrawn'
        ]);

        return to_route('application.list')->with([
            'title' => 'Application Withdrawn!',
            'message' => "Your application for ".$application->job->job_title." position has been withdrawn."
        ]);
    }

    private function validateApplication($request)
    {
        $request->validate([
            'firstname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'resume' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'coverLetter' => 'required',
            'interest' => 'required'
        ]);
    }
}
