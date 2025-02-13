<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function userProfileIndex()
    {
        $user = auth()->user();
        return view('users.user_profile', compact('user'));
    }

    public function userProfileUpdate(Request $request)
    {
        $request->validate([
            'profile_picture' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::find(auth()->id());

        if (!$user) {
            return redirect()->route('user.profile')->with('error', 'User not found.');
        }

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();

            $image->storeAs('public/images/user', $imageName);

            if ($user->profile_picture) {
                $request->file('profile_picture')->storeAs('public/images/user', $imageName);
            }

            $user->profile_picture = $imageName;
            $user->save();

            return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
        }

        return redirect()->route('user.profile')->with('error', 'No profile picture uploaded.');
    }

    public function profilePersonalUpdate(Request $request)
    {
        $request->validate([
            'firstname' => 'string|min:6',
            'lastname' => 'string|min:6',
            'date_of_birth' => 'date',
            'email' => 'string|email|unique:users,email,' . auth()->id(),
        ]);

        $user = User::find(auth()->id());

        if (!$user) {
            return redirect()->route('user.profile')->with('error', 'User not found.');
        }

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->email = $request->input('email');

        $updated = $user->save();

        if ($updated) {
            return redirect()->route('user.profile')->with('success', 'Personal information updated successfully!');
        } else {
            return redirect()->route('user.profile')->with('error', 'Failed to update personal information.');
        }
    }

    public function profilePasswordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(auth()->id());

        if (!$user) {
            return redirect()->route('user.profile')->with('error', 'User not found.');
        }

        $user->password = bcrypt($request->password);
        $updated = $user->save();

        if ($updated) {
            return redirect()->route('user.profile')->with('success', 'Password updated successfully!');
        } else {
            return redirect()->route('user.profile')->with('error', 'Failed to update password.');
        }
    }

    public function profileDelete(Request $request)
    {
        $user = User::find(auth()->id());
        if ($user->profile_picture) {
            $image_path = public_path('storage/images/user/' . $user->profile_picture);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $user->delete();
        return redirect()->route('user.login')->with('success', 'Profile deleted successfully!');
    }
}
