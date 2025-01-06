<?php

namespace App\Http\Controllers\collegeAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function dashboardindex(){
        return view('collegeAdmin.dashboard');
    }

}
