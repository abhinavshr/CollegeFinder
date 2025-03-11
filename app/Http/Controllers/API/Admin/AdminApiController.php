<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AdminApiController extends Controller
{

    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins',
                'password' => 'required|min:8',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $admin = Admins::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        return response()->json([
            'message' => 'Admin created successfully'
        ], 201);
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    try {
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

}
