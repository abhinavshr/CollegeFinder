<?php

namespace App\Http\Controllers\CollegeAdmin;

use App\Http\Controllers\Controller;
use App\Models\CollegeAdmin;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileindex()
    {
        return view('collegeadmin.profile');
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
}
