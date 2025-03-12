<?php

namespace App\Http\Controllers\API\CollegeAdmin;

use App\Http\Controllers\Controller;
use App\Models\CollegeAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;

class CollegeAdminAuthController extends Controller
{

    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'college_name' => 'required|string|max:255',
                'college_email' => 'required|string|email|max:255|unique:college_admins',
                'password' => 'required|min:8',
                'admin_profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $image_path = $request->file('admin_profile')->store('public/admin_profiles');

        $collegeadmin = CollegeAdmin::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'college_name' => $validatedData['college_name'],
            'college_email' => $validatedData['college_email'],
            'password' => bcrypt($validatedData['password']),
            'admin_profile' => $image_path,
        ]);

        return response()->json([
            'message' => 'College Admin created successfully'
        ], 201);
    }

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
    public function updateProfile(Request $request)
    {
        $user = Auth::guard('collegeadmin')->user();

        if (!$user || !($user instanceof \App\Models\CollegeAdmin)) {
            return response()->json(['message' => 'Unauthorized or user not found'], 401);
        }

        try {
            $validatedData = $request->validate([
                'firstname' => 'sometimes|string|max:255',
                'lastname' => 'sometimes|string|max:255',
                'college_name' => 'sometimes|string|max:255',
                'college_email' => 'sometimes|string|email|max:255|unique:college_admins,college_email,' . $user->id,
                'password' => 'sometimes|min:8',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        if (isset($validatedData['firstname'])) {
            $user->firstname = $validatedData['firstname'];
        }
        if (isset($validatedData['lastname'])) {
            $user->lastname = $validatedData['lastname'];
        }
        if (isset($validatedData['college_name'])) {
            $user->college_name = $validatedData['college_name'];
        }
        if (isset($validatedData['college_email'])) {
            $user->college_email = $validatedData['college_email'];
        }
        if (isset($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }

        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user
        ], 200);
    }
}
