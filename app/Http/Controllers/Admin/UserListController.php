<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    public function userListIndex()
    {
        $Users = User::paginate(10);
        return view('admin.userlist', compact('Users'));
    }

    public function convertUser(Request $request)
    {
        $user = User::find($request->user_id);
    if ($user) {
        $user->user_type = $request->new_type;
        $user->save();

        $message = ($user->user_type == 'Alumni')
            ? 'User successfully converted to Alumni!'
            : 'User successfully removed from Alumni!';

        return redirect()->back()->with('success', $message);
    }
    return redirect()->back()->with('error', 'Something went wrong!');
    }
}
