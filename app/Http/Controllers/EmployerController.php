<?php

namespace App\Http\Controllers;

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

    private function validateProfile($request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users,email,'.Auth::user()->id
        ]);
    }
}
