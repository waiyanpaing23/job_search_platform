<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

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
}
