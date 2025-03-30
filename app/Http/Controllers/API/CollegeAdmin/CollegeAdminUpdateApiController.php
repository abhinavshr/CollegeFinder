<?php

namespace App\Http\Controllers\API\CollegeAdmin;

use App\Http\Controllers\Controller;
use App\Models\CollegeAdmin;
use App\Models\CollegeGallery;
use App\Models\Colleges;
use App\Models\Courses;
use App\Models\Scholarships;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CollegeAdminUpdateApiController extends Controller
{
    /**
     * Update College Admin Profile.
     */
    public function update(Request $request)
    {
        $collegeAdmin = CollegeAdmin::find(Auth::guard('collegeadmin')->id());

        // Check if College Admin exists
        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'College Admin not found'
            ], 404);
        }

        // Validate input data
        $validator = Validator::make($request->all(), [
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            'college_name' => 'sometimes|string|max:255',
            'college_email' => 'sometimes|string|email|unique:college_admins,college_email,' . $collegeAdmin->id,
            'password' => 'nullable|string|min:8',
            'admin_profile' => 'nullable|string|max:255',
        ]);

        // Return validation errors if any
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Update College Admin details
        $collegeAdmin->update($request->only([
            'firstname',
            'lastname',
            'college_name',
            'college_email',
            'admin_profile'
        ]));

        // Hash password if provided
        if ($request->has('password')) {
            $collegeAdmin->update(['password' => Hash::make($request->password)]);
        }

        return response()->json([
            'status' => true,
            'message' => 'College Admin profile updated successfully!',
            'college_admin' => $collegeAdmin
        ], 200);
    }

    /**
     * Update College details by College Admin.
     */
    public function Collegeupdate(Request $request, $id)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        // Check if College Admin is authenticated
        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Fetch college details owned by the logged-in admin
        $college = Colleges::where('id', $id)
            ->where('college_admin_id', $collegeAdmin->id)
            ->first();

        // Check if College exists and belongs to admin
        if (!$college) {
            return response()->json([
                'status' => false,
                'message' => 'College not found or access denied'
            ], 404);
        }

        // Validate input data
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'location' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'contact_email' => 'sometimes|required|email|unique:colleges,contact_email,' . $id,
            'contact_phone' => 'sometimes|required|string|max:20',
            'website' => 'sometimes|required|url',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'affiliated_university' => 'nullable|string',
            'level_of_education' => 'nullable|string',
            'course_offered' => 'nullable|string',
            'alumni_network' => 'nullable|string',
            'placement_availability' => 'nullable|string',
            'entrance_exams_required' => 'nullable|string',
            'country' => 'sometimes|required|string|max:255',
        ]);

        // Update College details
        $college->update($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'College updated successfully',
            'data' => $college
        ], 200);
    }

    /**
     * Delete a College Gallery Image.
     */
    public function CollegegalleryDelete(Request $request, $id)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        // Check if College Admin is authenticated
        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        // Verify if the gallery exists and belongs to the College Admin's college
        $gallery = CollegeGallery::where('college_id', $id)->where('id', $request->id)->first();
        if ($gallery) {
            $gallery->delete();
            return response()->json([
                'status' => true,
                'message' => 'Gallery deleted successfully'
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Gallery not found'
        ], 404);
    }

    /**
     * Logout College Admin.
     */
    public function logout(Request $request)
    {
        Auth::guard('collegeadmin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'College Admin logged out successfully!',
        ], 200);
    }
}
