<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{

    public function index() {
        $jobs = Job::all();
        $industries = Category::leftJoin('jobs', function ($join) {
                    $join->on('categories.id', '=', 'jobs.category_id')
                        ->where('jobs.status', 'Open');
                    })
                    ->select('categories.category', DB::raw('COUNT(jobs.id) as job_count'))
                    ->groupBy('categories.id', 'categories.category')
                    ->orderByDesc('job_count')
                    ->limit(4)
                    ->get();

        $recommendations = $this->jobRecommendations();

        $companies = Company::where('status', 'Approved')
                    ->inRandomOrder()->limit(4)->get();

        return view('user.dashboard', compact('jobs', 'industries', 'recommendations', 'companies'));
    }

    public function jobList() {
        $categories = Category::all();

        $jobs = Job::where('status', 'Open')
                ->when(request('searchData'), function($query) {
                    $query->whereAny(['job_title', 'location'],'like','%'.request('searchData').'%');
                })
                ->when(request('category'), function($query) {
                    $query->where('category_id', request('category'));
                })
                ->when(request('job_type'), function($query) {
                    $query->where('job_type', request('job_type'));
                })
                ->paginate(8);

        return view('user.searchJob', compact('jobs', 'categories'));
    }

    public function profile() {
        $recommendations = $this->jobRecommendations();

        $applicant = Auth::user()->applicant;
        $experiences = $applicant->experiences;
        $educations = $applicant->educations;

        return view('applicant.profile', compact('applicant', 'experiences', 'educations', 'recommendations'));
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
            'address' => $request->address,
            'bio' => $request->bio,
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

    private function jobRecommendations() {

        if(Auth::check()) {
            $applicant = Auth::user()->applicant;

            $keywords = [];

            if ($applicant?->bio) {
                $keywords = array_merge($keywords, explode(' ', $applicant->bio));
            }

            if ($applicant?->about) {
                $keywords = array_merge($keywords, explode(' ', $applicant->about));
            }
            if($applicant?->skills) {
                $skills = $applicant->skills->pluck('name')->toArray();
                $keywords = array_merge($keywords, $skills);
            }

            $keywords = array_filter($keywords, function ($value) {
                return !empty($value);
            });

            $keywords = array_unique(array_filter($keywords));
            $keywordsString = implode(' ', $keywords);

            if (!empty($keywordsString)) {
                $recommendations = Job::where('status', 'Open')
                                    ->whereRaw("MATCH(job_title, requirement) AGAINST (? IN NATURAL LANGUAGE MODE)", [$keywordsString])
                                    ->limit(4)->get();

                if ($recommendations->count() < 1) {
                    $recommendations = Job::where('status', 'Open')->inRandomOrder()->limit(4)->get();
                }
            } else {
                $recommendations = Job::where('status', 'Open')->inRandomOrder()->limit(4)->get();
            }
        } else {
            $recommendations = '';
        }

        return $recommendations;
    }
}
