<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function create(Request $request) {

        $request->validate([
            'degree' => 'required',
            'university' => 'required',
            'fieldofstudy' => 'required'
        ]);

        Education::create([
            'applicant_id' => Auth::user()->applicant->id,
            'degree' => $request->degree,
            'university' => $request->university,
            'fieldofstudy' => $request->fieldofstudy,
            'start_date' => $request->startDate,
            'end_date' => $request->endDate
        ]);

        return redirect()->back()->with([
            'title' => 'Education Added Successfully',
            'message' => 'Your education details have been added successfully.'
        ]);
    }

    public function update(Request $request) {
        $educations = $request->input('educations');

        foreach($educations as $educationData) {
            Education::find($educationData['id'])->update([
                'degree' => $educationData['degree'],
                'fieldofstudy' => $educationData['fieldofstudy'],
                'university' => $educationData['university'],
                'start_date' => $educationData['startDate'],
                'end_date' => $educationData['endDate'],
            ]);
        }

        return to_route('applicant.profile')->with([
            'title' => 'Education Updated Successfully',
            'message' => 'Your education details have been updated successfully.'
        ]);
    }

    public function delete($id){
        Education::where('id', $id)->delete();

        return redirect()->back()->with([
            'title' => 'Education Deleted Successfully',
            'message' => 'Your education details have been deleted successfully.'
        ]);
    }
}
