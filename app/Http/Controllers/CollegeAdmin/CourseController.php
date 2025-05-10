<?php

namespace App\Http\Controllers\CollegeAdmin;

use App\Http\Controllers\Controller;
use App\Models\Colleges;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function courseviewindex()
    {
        $courses = Courses::all();
        return view('collegeadmin.courseview', compact('courses'));
    }


    public function addcourseindex()
    {
        $colleges = Colleges::all();
        return view('collegeadmin.addcourse', compact('colleges'));
    }

    public function coursedetails($id)
    {
        $course = Courses::findOrFail($id);
        $colleges = Colleges::all();
        return view('collegeadmin.editcourse', compact('colleges', 'course'));
    }

    public function coursestore(Request $request)
    {
        $validatedData = $request->validate([
            'college_id' => 'required|exists:colleges,id',
            'course_name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'course_type' => 'required|string|max:255',
            'course_code' => 'required|string|max:10',
            'fees' => 'required|numeric',
            'eligibility' => 'required|string',
        ]);

        $course = Courses::create([
            'college_id' => $request->college_id,
            'course_name' => $request->course_name,
            'duration' => $request->duration,
            'course_type' => $request->course_type,
            'course_code' => $request->course_code,
            'fees' => $request->fees,
            'eligibility' => $request->eligibility,
        ]);

        return redirect()->route('collegeadmin.courselist');
    }

    public function coursedelete($id)
    {
        $course = Courses::find($id);

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        $course->delete();

        return redirect()->back()->with('success', 'Course deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'course_name' => 'required|string|max:255',
            'duration' => 'required|integer',
            'course_type' => 'required|string|max:255',
            'course_code' => 'required|string|max:10',
            'fees' => 'required|numeric',
            'eligibility' => 'required|string',
        ]);

        $course = Courses::find($id);

        if (!$course) {
            return redirect()->back()->with('error', 'Course not found.');
        }

        $course->update($validatedData);

        return redirect()->route('collegeadmin.courselist', $id)->with('success', 'Course updated successfully.');
    }
}
