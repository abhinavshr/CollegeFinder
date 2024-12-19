<?php

namespace App\Http\Controllers\CollegeAdmin;

use App\Http\Controllers\Controller;
use App\Models\CollegeAdmin;
use Illuminate\Http\Request;

class CollegeAdminController extends Controller
{
    public function collegeadminregisterindex(){
        return view('collegeadmin.collegeadminregister');
    }

    public function collegeadminregister(Request $request){
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'college_name' => 'required|string|max:255',
        'college_email' => 'required|string|email|max:255|unique:college_admins',
        'password' => 'required|confirmed|min:8',
        'admin_profile' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('admin_profile')) {
        $image = $request->file('admin_profile');
        $imageName = $request->input('firstname') . '.' . $image->getClientOriginalExtension();
        $request->file('admin_profile')->storeAs('public/images/collegeadmin', $imageName);
    }

    $collegeadmin = CollegeAdmin::create([
       'firstname' => $request->firstname,
       'lastname' => $request->lastname,
       'college_name' => $request->college_name,
       'college_email' => $request->college_email,
       'password' => bcrypt($request->password),
       'admin_profile' => $imageName,
    ]);


    return redirect()->route('admin.adminlist')->with('success', 'Registration successful.');

    }
}
