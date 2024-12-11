<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function create(Request $request) {

        $request->validate([
            'jobtitle' => 'required',
            'company' => 'required',
        ]);

        Experience::create([
            'applicant_id' => Auth::user()->applicant->id,
            'job_title' => $request->jobtitle,
            'company' => $request->company,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate,
            'responsibilities' => $request->responsibilities
        ]);

        return redirect()->back()->with([
            'title' => 'Experience Added Successfully',
            'message' => 'Your experience details have been added successfully.'
        ]);
    }

    public function update(Request $request) {
        $experiences = $request->input('experiences');

        foreach($experiences as $experienceData) {
            $experience = Experience::find($experienceData['id']);
            if($experience){
                $experience->update([
                    'job_title' => $experienceData['jobtitle'],
                    'company' => $experienceData['company'],
                    'start_date' => $experienceData['startDate'],
                    'end_date' => $experienceData['endDate'],
                    'responsibilities' => $experienceData['responsibilities'],
                ]);
            }
        }

        return to_route('applicant.profile')->with([
            'title' => 'Update Successfully',
            'message' => 'Your experience details have been updated successfully.'
        ]);
    }

    public function delete($id){
        Experience::where('id', $id)->delete();

        return redirect()->back()->with([
            'title' => 'Experience Deleted Successfully',
            'message' => 'Your experience details have been deleted successfully.'
        ]);
    }
}
