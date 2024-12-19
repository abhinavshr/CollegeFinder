<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\CollegeAdmin;
use Illuminate\Http\Request;

class AdminlistController extends Controller
{
    public function adminlistindex(){
        $CollegeAdmins = CollegeAdmin::all();
        return view('admin.adminpages.adminlist', compact('CollegeAdmins'));
    }
}
