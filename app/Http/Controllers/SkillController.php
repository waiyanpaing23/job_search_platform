<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    public function create(Request $request)
    {
        $applicant = Auth::user()->applicant;

        // Validate the request
        $request->validate([
            'skills' => 'required|array',
            'skills.*' => 'exists:skills,id|unique:applicant_skill,skill_id',
        ]);

        // Attach the selected skills to the applicant
        $applicant->skills()->attach($request->skills);

        // Redirect back to the applicant's profile edit page
        return redirect()->route('applicant.profile.edit');
    }

    public function delete($id){
        $applicant = Auth::user()->applicant;

        $applicant->skills()->detach($id);

        return redirect()->route('applicant.profile.edit');
    }

}
