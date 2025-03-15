<?php

namespace App\Http\Controllers\API\CollegeAdmin;

use App\Http\Controllers\Controller;
use App\Models\CollegeGallery;
use App\Models\Colleges;
use App\Models\Courses;
use App\Models\Scholarships;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CollegeAdminAPIController extends Controller
{
    public function login(Request $request)
{
    $credentials = $request->only('college_email', 'password');

    try {
        if (!$token = Auth::guard('collegeadmin')->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
    } catch (JWTException $e) {
        return response()->json([
            'status' => false,
            'message' => 'Could not create token',
            'error' => $e->getMessage(),
        ], 500);
    }

    return response()->json([
        "status" => true,
        'message' => 'College Admin logged in successfully',
        'token' => $token
    ]);
}

public function store(Request $request)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'contact_email' => 'required|email|unique:colleges,contact_email',
            'contact_phone' => 'required|string|max:20',
            'website' => 'required|url',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'affiliated_university' => 'nullable|string',
            'level_of_education' => 'nullable|string',
            'course_offered' => 'nullable|string',
            'alumni_network' => 'nullable|string',
            'placement_availability' => 'nullable|string',
            'entrance_exams_required' => 'nullable|string',
            'country' => 'required|string|max:255',
        ]);

        $college = Colleges::create([
            'college_admin_id' => $collegeAdmin->id,
            'name' => $request->name,
            'location' => $request->location,
            'city' => $request->city,
            'contact_email' => $request->contact_email,
            'contact_phone' => $request->contact_phone,
            'website' => $request->website,
            'description' => $request->description,
            'logo' => $request->logo,
            'affiliated_university' => $request->affiliated_university,
            'level_of_education' => $request->level_of_education,
            'course_offered' => $request->course_offered,
            'alumni_network' => $request->alumni_network,
            'placement_availability' => $request->placement_availability,
            'entrance_exams_required' => $request->entrance_exams_required,
            'country' => $request->country,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'College added successfully',
            'data' => $college
        ], 201);
    }

    public function collegeslists(){
        $colleges = Colleges::all();
        return response()->json([
            'status' => true,
            'data' => $colleges
        ], 200);
    }

    public function courseStore(Request $request)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $request->validate([
            'college_id' => 'required|exists:colleges,id',
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:courses,course_code',
            'duration' => 'required|integer|min:1',
            'course_type' => 'required|string|max:255',
            'fees' => 'required|numeric|min:0',
            'eligibility' => 'required|string|max:255',
        ]);

        $college = Colleges::where('id', $request->college_id)
            ->where('college_admin_id', $collegeAdmin->id)
            ->first();

        if (!$college) {
            return response()->json([
                'status' => false,
                'message' => 'You do not have permission to add courses to this college.'
            ], 403);
        }

        $course = Courses::create([
            'college_id' => $request->college_id,
            'course_name' => $request->course_name,
            'course_code' => $request->course_code,
            'duration' => $request->duration,
            'course_type' => $request->course_type,
            'fees' => $request->fees,
            'eligibility' => $request->eligibility,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Course added successfully',
            'data' => $course
        ], 201);
    }

    Public function courseList(){
        $courses = Courses::all();
        return response()->json([
            'status' => true,
            'data' => $courses
        ], 200);
    }

    public function ScholarshipStore(Request $request)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $request->validate([
            'college_id' => 'required|exists:colleges,id',
            'scholarship_name' => 'required|string|max:255',
            'eligibility' => 'required|string',
            'benefits' => 'required|string',
        ]);

        $college = Colleges::where('id', $request->college_id)
            ->where('college_admin_id', $collegeAdmin->id)
            ->first();

        if (!$college) {
            return response()->json([
                'status' => false,
                'message' => 'You do not have permission to add scholarships to this college.'
            ], 403);
        }

        $scholarship = Scholarships::create([
            'college_id' => $request->college_id,
            'scholarship_name' => $request->scholarship_name,
            'eligibility' => $request->eligibility,
            'benefits' => $request->benefits,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Scholarship added successfully',
            'data' => $scholarship
        ], 201);
    }

    public function scholarshipList(){
        $scholarships = Scholarships::all();
        return response()->json([
            'status' => true,
            'data' => $scholarships
        ], 200);
    }

    public function collegeGalleryStore(Request $request)
{
    $collegeAdmin = Auth::guard('collegeadmin')->user();

    if (!$collegeAdmin) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized'
        ], 401);
    }

    $request->validate([
        'college_id' => 'required|exists:colleges,id',
        'image' => 'required|string',
        'caption' => 'required|string|max:255',
    ]);

    $college = Colleges::where('id', $request->college_id)
        ->where('college_admin_id', $collegeAdmin->id)
        ->first();

    if (!$college) {
        return response()->json([
            'status' => false,
            'message' => 'You do not have permission to add images to this college.'
        ], 403);
    }


    $gallery = CollegeGallery::create([
        'college_id' => $request->college_id,
        'image' => $request->image,
        'caption' => $request->caption,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Image uploaded successfully',
        'data' => $gallery
    ], 201);
}

public function collegeGalleryList(){
    $galleries = CollegeGallery::all();
    return response()->json([
        'status' => true,
        'data' => $galleries
    ], 200);
}

}
