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
    public function update(Request $request)
    {
        $collegeAdmin = CollegeAdmin::find(Auth::guard('collegeadmin')->id());

        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'College Admin not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            'college_name' => 'sometimes|string|max:255',
            'college_email' => 'sometimes|string|email|unique:college_admins,college_email,' . $collegeAdmin->id,
            'password' => 'nullable|string|min:8',
            'admin_profile' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $collegeAdmin->update($request->only([
            'firstname',
            'lastname',
            'college_name',
            'college_email',
            'admin_profile'
        ]));

        if ($request->has('password')) {
            $collegeAdmin->update(['password' => Hash::make($request->password)]);
        }

        return response()->json([
            'status' => true,
            'message' => 'College Admin profile updated successfully!',
            'college_admin' => $collegeAdmin
        ], 200);
    }

    public function Collegeupdate(Request $request, $id)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $college = Colleges::where('id', $id)
            ->where('college_admin_id', $collegeAdmin->id)
            ->first();

        if (!$college) {
            return response()->json([
                'status' => false,
                'message' => 'College not found or access denied'
            ], 404);
        }

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

        $college->update($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'College updated successfully',
            'data' => $college
        ], 200);
    }

    public function CollegegalleryDelete(Request $request, $id)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $college = Colleges::where('id', $id)
            ->where('college_admin_id', $collegeAdmin->id)
            ->first();

        if (!$college) {
            return response()->json([
                'status' => false,
                'message' => 'College not found or access denied'
            ], 404);
        }

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
        ]);
    }

    public function ScholarshipDelete(Request $request, $id)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $scholarship = Scholarships::where('id', $id)->first();

        if (!$scholarship) {
            return response()->json([
                'status' => false,
                'message' => 'Scholarship not found'
            ], 404);
        }

        $college = Colleges::where('id', $scholarship->college_id)
            ->where('college_admin_id', $collegeAdmin->id)
            ->first();

        if (!$college) {
            return response()->json([
                'status' => false,
                'message' => 'College not found or access denied'
            ], 404);
        }

        $scholarship->delete();

        return response()->json([
            'status' => true,
            'message' => 'Scholarship deleted successfully'
        ], 200);
    }

    public function CourseDelete(Request $request, $id)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $course = Courses::where('id', $id)->first();

        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => 'Course not found'
            ], 404);
        }

        $college = Colleges::where('id', $course->college_id)
            ->where('college_admin_id', $collegeAdmin->id)
            ->first();

        if (!$college) {
            return response()->json([
                'status' => false,
                'message' => 'College not found or access denied'
            ], 404);
        }

        $course->delete();

        return response()->json([
            'status' => true,
            'message' => 'Course deleted successfully'
        ], 200);
    }

    public function CollegeDelete(Request $request, $id)
    {
        $collegeAdmin = Auth::guard('collegeadmin')->user();

        if (!$collegeAdmin) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401);
        }

        $college = Colleges::where('id', $id)
            ->where('college_admin_id', $collegeAdmin->id)
            ->first();

        if (!$college) {
            return response()->json([
                'status' => false,
                'message' => 'College not found or access denied'
            ], 404);
        }

        $college->delete();

        return response()->json([
            'status' => true,
            'message' => 'College deleted successfully'
        ], 200);
    }

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
