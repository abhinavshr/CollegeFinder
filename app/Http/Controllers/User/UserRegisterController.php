<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserRegisterController extends Controller
{
    public function userregisterindex()
    {
        return view('users.userregister');
    }

    public function userregisterstore(Request $request){
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'date_of_birth' => 'required|date|before:-18 years',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
            'profile_picture' => 'file|mimes:jpg,jpeg,png|max:2048',
            ]);

            if ($request->hasFile('profile_picture')) {
                $image = $request->file('profile_picture');
                $imageName = $request->input('firstname') . '.' . $image->getClientOriginalExtension();
                $request->file('profile_picture')->storeAs('public/images/user', $imageName);
            }

            $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'password' => bcrypt($request->password),
                'profile_picture' => $imageName,
                'user_type' => 'User',
            ]);
            Mail::to($request->email)->send(new WelcomeMail($user));
            return redirect()->route('user.userlogin');
    }
}
