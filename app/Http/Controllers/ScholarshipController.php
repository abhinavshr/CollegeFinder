<?php

namespace App\Http\Controllers;

use App\Models\Colleges;
use App\Models\Scholarships;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function scholarshipviewindex(){
        $scholarships = Scholarships::all();
        return view('CollegeAdmin.scholarship', compact('scholarships'));
    }

    public function addscholarshipindex(){
        $colleges = Colleges::all();
        return view('CollegeAdmin.addscholarship', compact('colleges'));
    }

    public function addscholarshipstore(Request $request){
        $validatedData = $request->validate([
            'college_id' => 'required|exists:colleges,id',
            'scholarship_name' => 'required|string|max:255',
            'eligibility' => 'required|string',
            'benefits' => 'required|string',
        ]);

        $scholarship = Scholarships::create([
            'college_id' => $request->college_id,
            'scholarship_name' => $request->scholarship_name,
            'eligibility' => $request->eligibility,
            'benefits' => $request->benefits,
        ]);

        return redirect()->route('collegeadmin.scholarshiplist')->with('success', 'Scholarship added successfully');
    }

    public function destroy($id)
    {
        $scholarship = Scholarships::find($id);

        if (!$scholarship) {
            return redirect()->back()->with('error', 'Scholarship not found.');
        }
        $scholarship->delete();

        return redirect()->back()->with('success', 'Scholarship deleted successfully.');
    }

    public function scholarshipdetails(){
        $scholarships = Scholarships::all();
        $colleges = Colleges::all();
        return view('collegeadmin.editscholarship', compact('scholarships', 'colleges'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'college_id' => 'required|exists:colleges,id',
        'scholarship_name' => 'required|string|max:255',
        'eligibility' => 'nullable|string',
        'benefits' => 'nullable|string',
    ]);

    $scholarship = Scholarships::findOrFail($id);
    $scholarship->update($request->only(['college_id', 'scholarship_name', 'eligibility', 'benefits']));

    return redirect()->route('collegeadmin.scholarshiplist')->with('success', 'Scholarship updated successfully.');
}

}
