<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CollegeGallery;
use App\Models\Colleges;
use App\Models\Courses;
use App\Models\Reviews;
use App\Models\Scholarships;
use Illuminate\Http\Request;

class CollegeDetailsController extends Controller
{
    public function CollegeDetailsIndex($id){
        $college = Colleges::findOrFail($id);
        $courses = Courses::where('college_id', $id)->get();
        $scholarships = Scholarships::where('college_id', $id)->get();
        $galleries = CollegeGallery::where('college_id', $id)->get();
        $reviews = Reviews::where('college_id', $id)->get();
        return view('users.college-details', compact('college', 'courses', 'scholarships', 'galleries', 'reviews'));
    }
}
