<?php

namespace App\Http\Controllers\CollegeAdmin;

use App\Http\Controllers\Controller;
use App\Models\CollegeAdmin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileindex()
    {
        $collegeadmin = CollegeAdmin::find(auth()->guard('collegeadmin')->id());
        return view('collegeadmin.profile', compact('collegeadmin'));
    }

    public function profileupdate(Request $request)
    {
        $request->validate([
            'admin_profile' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $collegeadmin = CollegeAdmin::find(auth()->guard('collegeadmin')->id());

        if ($request->hasFile('admin_profile')) {
            $image = $request->file('admin_profile');
            $imageName = $request->input('college_name') . '.' . $image->getClientOriginalExtension();
            $request->file('admin_profile')->storeAs('public/images/collegeadmin', $imageName);

            $collegeadmin->admin_profile = $imageName;
            $collegeadmin->save();

            return redirect()->route('collegeadmin.profile')->with('success', 'Profile updated successfully!');
        }
    }

    public function profilePersonalUpdate(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|min:6',
            'lastname' => 'required|string|min:6',
            'college_name' => 'required|string|min:6',
            'college_email' => 'required|string|email|unique:college_admins,college_email,' . auth()->guard('collegeadmin')->id(),
        ]);

        $collegeadmin = CollegeAdmin::find(auth()->guard('collegeadmin')->id());

        if (!$collegeadmin) {
            return redirect()->route('collegeadmin.profile')->with('error', 'User not found.');
        }

        $collegeadmin->firstname = $request->input('firstname');
        $collegeadmin->lastname = $request->input('lastname');
        $collegeadmin->college_name = $request->input('college_name');
        $collegeadmin->college_email = $request->input('college_email');

        $updated = $collegeadmin->save();

        if ($updated) {
            return redirect()->route('collegeadmin.profile')->with('success', 'Personal information updated successfully!');
        } else {
            return redirect()->route('collegeadmin.profile')->with('error', 'Failed to update personal information.');
        }
    }

    public function profilePasswordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        $collegeadmin = CollegeAdmin::find(auth()->guard('collegeadmin')->id());
        $collegeadmin->password = bcrypt($request->password);
        $updated = $collegeadmin->save();
        if ($updated) {
            return redirect()->route('collegeadmin.profile')->with('success', 'Password updated successfully!');
        } else {
            return redirect()->route('collegeadmin.profile')->with('error', 'Failed to update password.');
        }
    }

    public function profileDelete(Request $request)
    {
        $collegeadmin = CollegeAdmin::find(auth()->guard('collegeadmin')->id());
        if ($collegeadmin->admin_profile) {
            $image_path = public_path('storage/images/collegeadmin/' . $collegeadmin->admin_profile);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $collegeadmin->delete();
        return redirect()->route('collegeadmin.collegeadminlogin')->with('success', 'Profile deleted successfully!');
    }
}
