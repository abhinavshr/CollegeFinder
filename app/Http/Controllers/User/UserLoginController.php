<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserLoginController extends Controller
{
    public function userloginindex()
    {
        return view('users.userlogin');
    }

    public function userlogincheck(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('user.userregister');
        } else {
            return redirect()->back()->withErrors([
                'email' => 'Invalid email or password.',
                'password' => 'Invalid email or password.',
            ]);
        }
    }
}
