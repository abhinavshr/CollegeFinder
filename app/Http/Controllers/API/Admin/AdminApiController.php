<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use App\Models\CollegeAdmin;
use App\Models\Colleges;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;

class AdminApiController extends Controller
{
    /**
     * Register a new admin.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins',
                'password' => 'required|min:8',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        // Create new admin record
        $admin = Admins::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json([
            'message' => 'Admin created successfully'
        ], 201);
    }

    /**
     * Admin login and generate JWT token.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            // Authenticate admin
            if (!$token = Auth::guard('admin')->attempt($credentials)) {
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
            'message' => 'Admin logged in successfully',
            'token' => $token
        ]);
    }

    /**
     * Store a new college admin.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Check if the admin is authenticated
        if (!Auth::guard('admin')->check()) {
            return response()->json(['message' => 'Unauthorized access'], 403);
        }

        // Validate request data
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'college_name' => 'required|string|max:255',
            'college_email' => 'required|string|email|unique:college_admins',
            'password' => 'required|string|min:8',
            'admin_profile' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create college admin record
        $collegeAdmin = CollegeAdmin::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'college_name' => $request->college_name,
            'college_email' => $request->college_email,
            'password' => Hash::make($request->password),
            'admin_profile' => $request->admin_profile ?? 'default.jpg',
        ]);

        return response()->json([
            'message' => 'College Admin created successfully!',
            'college_admin' => $collegeAdmin,
        ], 201);
    }

    /**
     * Fetch list of college admins.
     */
    public function collegeadminlist()
    {
        $collegeadmins = CollegeAdmin::all();
        return response()->json([
            'message' => 'College Admins fetched successfully!',
            'college_admins' => $collegeadmins,
        ], 200);
    }

    /**
     * Fetch list of colleges.
     */
    public function collegelist()
    {
        $colleges = Colleges::all();
        return response()->json([
            'message' => 'Colleges fetched successfully!',
            'colleges' => $colleges,
        ], 200);
    }

    /**
     * Fetch list of scholarships.
     */
    public function scholarshiplist()
    {
        $scholarships = Colleges::with('scholarships')->get();
        return response()->json([
            'message' => 'Scholarships fetched successfully!',
            'scholarships' => $scholarships,
        ], 200);
    }

    /**
     * Fetch list of courses.
     */
    public function courselist()
    {
        $courses = Colleges::with('courses')->get();
        return response()->json([
            'message' => 'Courses fetched successfully!',
            'courses' => $courses,
        ], 200);
    }

    /**
     * Fetch list of users.
     */
    public function userlist()
    {
        $users = User::all();
        return response()->json([
            'message' => 'Users fetched successfully!',
            'users' => $users,
        ], 200);
    }

    /**
     * Logout the authenticated admin.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return response()->json([
            'message' => 'Admin logged out successfully!',
        ], 200);
    }
}
