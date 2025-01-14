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

}
