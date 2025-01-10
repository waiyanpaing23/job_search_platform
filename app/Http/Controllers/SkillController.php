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

        // $request->validate([
        //     'skills' => 'required|array',
        //     'skills.*' => 'exists:skills,id|unique:applicant_skill,skill_id',
        // ]);

        $applicant->skills()->attach($request->skills);
        // return redirect()->route('applicant.profile.edit');
        $skills = $applicant->skills;
        return response()->json([
            'skills'=>$skills
        ]);
    }

    public function delete($id)
    {
        $applicant = Auth::user()->applicant;

        // Check if the skill exists in the applicant's skills
        if ($applicant->skills()->detach($id)) {
            return response()->json(['success' => true, 'message' => 'Skill deleted successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Skill not found or not associated with the applicant'], 404);
    }

}
