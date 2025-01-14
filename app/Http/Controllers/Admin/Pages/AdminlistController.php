<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\CollegeAdmin;

class AdminlistController extends Controller
{
    public function adminlistindex()
    {
        $CollegeAdmins = CollegeAdmin::paginate(10);
        return view('admin.adminpages.adminlist', compact('CollegeAdmins'));
    }
}
