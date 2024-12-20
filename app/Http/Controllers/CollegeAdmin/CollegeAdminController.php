<?php

namespace App\Http\Controllers\CollegeAdmin;

use App\Http\Controllers\Controller;
use App\Models\CollegeAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CollegeAdminController extends Controller
{
    public function collegeadminregisterindex()
    {
        if (Auth::guard('collegeadmin')->check()) {
            return redirect()->route('collegeadmin.adminlist');
        }

        return view('collegeadmin.collegeadminregister');
    }

    public function collegeadminregister(Request $request)
    {
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
            $imageName = $request->input('college_name') . '.' . $image->getClientOriginalExtension();
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

    public function admincollegelogin()
    {
        return view('collegeadmin.collegeadminlogin');
    }


    public function admincollegelogincheck(Request $request)
    {
        $request->validate([
            'college_email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $credentials = $request->only('college_email', 'password');

        if (Auth::guard('collegeadmin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('collegeadmin.adminlist');
        }

        return back()->withErrors([
            'college_email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function collegeadminlogout(){
        Auth::guard('collegeadmin')->logout();
        return redirect()->route('collegeadmin.collegeadminlogin');
    }
}
