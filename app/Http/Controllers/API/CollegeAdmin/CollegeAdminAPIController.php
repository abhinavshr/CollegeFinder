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
    /**
     * Handle College Admin Login and return a JWT token if successful.
     */
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

    /**
     * Store a new College record with validation.
     */
    public function store(Request $request)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Validate the incoming request data
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

        // Create the college record
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

    /**
     * Get a list of all colleges.
     */
    public function collegeslists()
    {
        $colleges = Colleges::all();
        return response()->json([
            'status' => true,
            'data' => $colleges
        ], 200);
    }

    /**
     * Store a new Course under a specific College.
     */
    public function courseStore(Request $request)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Validate the course data
        $request->validate([
            'college_id' => 'required|exists:colleges,id',
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:50|unique:courses,course_code',
            'duration' => 'required|integer|min:1',
            'course_type' => 'required|string|max:255',
            'fees' => 'required|numeric|min:0',
            'eligibility' => 'required|string|max:255',
        ]);

        // Ensure the admin has permission to add courses to the selected college
        $college = Colleges::where('id', $request->college_id)
            ->where('college_admin_id', $collegeAdmin->id)
            ->first();

        if (!$college) {
            return response()->json([
                'status' => false,
                'message' => 'You do not have permission to add courses to this college.'
            ], 403);
        }

        // Create the course
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

    /**
     * Get a list of all courses.
     */
    public function courseList()
    {
        $courses = Courses::all();
        return response()->json([
            'status' => true,
            'data' => $courses
        ], 200);
    }
}
