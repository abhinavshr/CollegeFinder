<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Colleges;
use App\Models\Courses;
use App\Models\Favorite;
use Illuminate\Http\Request;

class SearchCollegeController extends Controller
{
    public function SearchCollegeIndex(Request $request)
    {
        $query = Colleges::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('location', 'LIKE', "%{$search}%")
                ->orWhere('city', 'LIKE', "%{$search}%");
        }

        if ($request->has('location') && !empty($request->input('location'))) {
            $query->where('location', $request->input('location'));
        }

        if ($request->has('city') && !empty($request->input('city'))) {
            $query->where('city', $request->input('city'));
        }

        if ($request->has('level_of_education') && !empty($request->input('level_of_education'))) {
            $query->where('level_of_education', $request->input('level_of_education'));
        }

        if ($request->has('course_offered') && !empty($request->input('course_offered'))) {
            $query->whereHas('courses', function ($q) use ($request) {
                $q->where('course_code', $request->input('course_offered'));
            });
        }

        $colleges = $query->paginate(10);

        $locations = Colleges::select('location')->distinct()->pluck('location');
        $cities = Colleges::select('city')->distinct()->pluck('city');
        $coureses = Courses::all();

        return view('users.searchcollege', compact('colleges', 'locations', 'cities', 'coureses'));
    }

    public function toggleFavorite(Request $request)
    {
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('college_id', $request->college_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        }

        Favorite::create([
            'user_id' => auth()->id(),
            'college_id' => $request->college_id,
        ]);

        return response()->json(['status' => 'added']);
    }
}
