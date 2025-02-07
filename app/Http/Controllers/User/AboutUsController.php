<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Colleges;
use App\Models\User;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function AboutUsIndex(){
        $totalColleges = Colleges::count();
        $totalStudents = User::count();
        $totalAlumni = User::where('user_type', 'alumni')->count();
        return view('users.aboutus', compact('totalColleges', 'totalStudents', 'totalAlumni'));
    }
}
