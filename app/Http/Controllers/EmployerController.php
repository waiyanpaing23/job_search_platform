<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\Company;
use App\Models\Employer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    public function index()
    {
        return view('employer.home');
    }

    public function profile()
    {
        $user = Auth::user();
        $employer = $user->employer;

        if ($employer) {
            $employer->load('company');
        }

        return view('employer.profile', compact('employer'));
    }

    public function editProfile()
    {
        $employer = Auth::user()->employer;

        return view('employer.editProfile', compact('employer'));
    }

    public function updateProfile(Request $request)
    {
        $this->validateProfile($request);

        $userData =  [
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'email' => $request->email
        ];

        $employerData = [
            'position' => $request->position,
            'phone' => $request->phone
        ];

        $employer = Auth::user()->employer;

        $oldImage = $request->oldImage;

        if ($request->hasFile('image')) {

            if ($oldImage && file_exists(public_path('images/' . $oldImage))) {
                unlink(public_path('images/' . $oldImage));
            }

            $file = $request->file('image');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);

            $userData['profile_image'] = $filename;

        } else {

            $oldImage ? $userData['profile_image'] = $oldImage : null;
        }


        User::find(Auth::user()->id)->update($userData);

        Employer::find($employer->id)->update($employerData);

        return to_route('employer.profile')->with([
            'title' => 'Updated Successfully',
            'message' => 'Your profile has updated successfully!.'
        ]);
    }

    public function applicantList() {
        $employer = Auth::user()->employer;
        $company = $employer->company;

        if (!$company) {
            return redirect()->back()->with([
                'title' => 'Error',
                'message' => 'You do not have a company associated with your profile.'
            ]);
        } elseif ($company->status == 'Pending') {
            return redirect()->back()->with([
                'title' => 'Company Profile Pending',
                'message' => 'Your company profile is pending approval. Please wait for the admin to approve your company profile.'
            ]);
        } elseif ($company->status == 'Rejected') {
            return redirect()->back()->with([
                'title' => "You do not have access to this page.",
                'message' => 'Your company profile has been rejected. Please resubmit your company for approval.'
            ]);
        }

        $searchData = request('searchData');

        $applications = Application::whereHas('job.employer.company', function($query) use ($company) {
            $query->where('id', $company->id);
            })
            ->when(request('status'), function($query) {
                $query->where('status', request('status'));
            })
            ->get();

        $statuses = $applications->pluck('status')->unique();
        $new = Application::where('status', 'Pending')
                            ->whereHas('job.employer.company', function($query) use ($company) {
                                $query->where('id', $company->id);
                            })
                            ->get();
        $interview = Application::where('status', 'Interview Scheduled')->get();

        return view('employer.applicants', compact('applications', 'statuses', 'new', 'interview'));
    }

    public function applicantDetail($id) {
        $application = Application::find($id);

        return view('employer.applicantDetail', compact('application'));
    }

    public function applicantProfile($id) {
        $applicant = Applicant::where('id', $id)->first();
        $experiences = $applicant->experiences;
        $educations = $applicant->educations;

        return view('employer.viewProfile', compact('applicant', 'experiences', 'educations'));
    }

    public function updateStatus(Request $request, $id) {
        $application = Application::find($id);

        $application->update([
            'status' => $request->status
        ]);

        $messages = [
            'Reviewed' => [
                'title' => 'Application Under Review',
                'message' => 'The application is now under review. Please ensure all necessary details are evaluated before making a decision.',
            ],
            'Interview' => [
                'title' => 'Interview Scheduled',
                'message' => 'The applicant has been moved to the Interview stage. You can contact the applicant via email to share the interview details.',
            ],
            'Hired' => [
                'title' => 'Applicant Hired Successfully',
                'message' => 'Congratulations! You have successfully hired '.$application->first_name.' '.$application->last_name
                                .' for '.$application->job->job_title.' position. Ensure that onboarding instructions and necessary documentation are sent promptly.'
            ],
            'Rejected' => [
                'title' => 'Application Rejected',
                'message' => 'The application has been rejected.',
            ],
        ];

        $response = $messages[$request->status] ?? [
            'title' => 'Status Updated',
            'message' => 'The application status has been updated successfully.',
        ];

        return back()->with($response);
    }

    private function validateProfile($request)
    {
        $request->validate([
            'firstname' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id
        ]);
    }
}
