<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.dashboard');
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

        $users = User::where('role', '!=', 'superadmin')
                ->when(request('searchData'), function($query) {
                    $query->where('first_name', 'like', '%' . request('searchData') . '%')
                        ->orWhere('last_name', 'like', '%' . request('searchData') . '%')
                        ->orWhere('email', 'like', '%' . request('searchData') . '%');
                })
                ->when(request('role'), function($query) use ($role) {
                    $query->where('role', $role);
                })
                ->get();

        return view('admin.users', compact('users'));
    }

    public function jobs() {
        return view('admin.jobs');
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
}
