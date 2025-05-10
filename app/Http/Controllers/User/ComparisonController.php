<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Colleges;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    public function ComparisonIndex()
    {
        if (!auth()->user()) {
            return redirect()->route('user.userlogin');
        }
        $colleges = Colleges::all();
        return view('users.comparison', compact('colleges'));
    }

    public function getCollegeData($id)
    {
        $college = Colleges::with('scholarships')->find($id);
        $colleges = Colleges::with('courses')->find($id);

        if (!$college) {
            return response()->json(['message' => 'College not found'], 404);
        }

        return response()->json([
            'name' => $college->name,
            'location' => $college->location,
            'affiliated_university' => $college->affiliated_university,
            'level_of_education' => $college->level_of_education,
            'avaiable_ficilities' => $college->course_offered,
            'courses_offered' => $colleges->courses->pluck('course_code'),
            'alumni_network' => $college->alumni_network,
            'placement' => $college->placement_availability,
            'entrance_exam' => $college->entrance_exams_required,
            'scholarship_options' => $college->scholarships->pluck('scholarship_name'),
        ]);
    }
}
