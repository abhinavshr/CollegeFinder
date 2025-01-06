<?php

namespace App\Http\Controllers\CollegeAdmin;

use App\Http\Controllers\Controller;
use App\Models\Colleges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CollegeController extends Controller
{
    // public function collegeviewindex()
    // {
    //     $colleges = Colleges::all();
    //     return view('collegeadmin.collegeview', compact('colleges'));
    // }
    public function collegeviewindex(Request $request)
{
    $search = $request->input('search');

    $colleges = Colleges::query()
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%");
        })
        ->get();

    return view('collegeadmin.collegeview', compact('colleges', 'search'));
}


    public function addcollegeindex()
    {
        return view('collegeadmin.createcollege');
    }

    public function addcollegestore(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'contact_email' => 'required|string|email|max:255',
            'contact_phone' => 'required|string|max:20',
            'website' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'affiliated_university' => 'required|string|max:255',
            'level_of_education' => 'required|string|max:255',
            'course_offered' => 'required|string|max:255',
            'alumni_network' => 'required|string|max:255',
            'placement_availability' => 'required|string|max:255',
            'entrance_exams_required' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = $validatedData['name'] . '.' . $image->getClientOriginalExtension();
            $request->file('logo')->storeAs('public/images/college/logo', $imageName);
            $validatedData['logo'] = $imageName;
        }

        $college = Colleges::create([
            'college_admin_id' => Auth::guard('collegeadmin')->user()->id,
            'name' => $request->name,
            'location' => $request->location,
            'city' => $request->city,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'website' => $request->website,
            'description' => $request->description,
            'logo' => $imageName,
            'affiliated_university' => $request->affiliated_university,
            'level_of_education' => $request->level_of_education,
            'course_offered' => $request->course_offered,
            'alumni_network' => $request->alumni_network,
            'placement_availability' => $request->placement_availability,
            'entrance_exams_required' => $request->entrance_exams_required,
            'country' => $request->country
        ]);


        return redirect()->route('collegeadmin.collegelist')->with('success', 'College added successfully!');
    }

    public function collegedelete()
    {
        $college = Colleges::where('college_admin_id', auth()->guard('collegeadmin')->user()->id)->first();

        if (!$college) {
            return redirect()->route('collegeadmin.collegelist')->with('error', 'College not found!');
        }

        if ($college->logo) {
            $image_path = public_path('storage/images/college/logo/' . $college->logo);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        if (!$college->delete()) {
            return redirect()->route('collegeadmin.collegelist')->with('error', 'College could not be deleted!');
        }

        return redirect()->route('collegeadmin.collegelist')->with('success', 'College deleted successfully!');
    }

    public function collegedetails($id)
    {
        $colleges = Colleges::find($id);
        return view('collegeadmin.editcollege', compact('colleges'));
    }

    public function collegedetailsupdate(Request $request, $id){
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'contact_email' => 'required|email|max:255',
        'contact_phone' => 'required|string|max:255',
        'website' => 'nullable|url|max:255',
        'description' => 'nullable|string',
        'affiliated_university' => 'nullable|string|max:255',
        'level_of_education' => 'nullable|string|max:255',
        'course_offered' => 'nullable|string|max:255',
        'alumni_network' => 'nullable|string|max:255',
        'placement_availability' => 'nullable|string|max:255',
        'entrance_exams_required' => 'nullable|string|max:255',
        'country' => 'required|string|max:255',
    ]);

    if ($request->hasFile('logo')) {
        $image = $request->file('logo');
        $imageName = $validatedData['name'] . '.' . $image->getClientOriginalExtension();
        $request->file('logo')->storeAs('public/images/college/logo', $imageName);
        $validatedData['logo'] = $imageName;
    }

    $college = Colleges::find($id);
    if (!$college) {
        return redirect()->route('collegeadmin.collegelist')->with('error', 'College not found!');
    }

    $college->update($validatedData);

    return redirect()->route('collegeadmin.collegelist')->with('success', 'College updated successfully!');

    }
}
