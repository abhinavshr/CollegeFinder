<?php

namespace App\Http\Controllers\collegeAdmin;

use App\Http\Controllers\Controller;
use App\Models\CollegeGallery;
use App\Models\Colleges;
use Illuminate\Http\Request;

class CollegeGalleryController extends Controller
{

    // public function collegegalleryindex()
    // {
    //     $collegeGallerys = CollegeGallery::all();
    //     return view('collegeAdmin.collegegallery', compact('collegeGallerys'));
    // }
    public function collegegalleryindex(Request $request)
    {
        $query = CollegeGallery::query();

        if ($request->has('search') && $request->input('search') !== '') {
            $searchTerm = $request->input('search');

            // Join with the correct table and search by college name
            $query->join('colleges', 'collegegallerys.college_id', '=', 'colleges.id')
                ->where('colleges.name', 'like', '%' . $searchTerm . '%');
        }

        $collegeGallerys = $query->get();

        // Check if there are no gallery images found and pass a flag to the view
        $noImagesFound = $collegeGallerys->isEmpty();

        return view('collegeAdmin.collegegallery', compact('collegeGallerys', 'noImagesFound'));
    }




    public function addcolegegalleryindex()
    {
        $colleges = Colleges::all();
        return view('CollegeAdmin.addcollegegallery', compact('colleges'));
    }

    public function collegegallerystore(Request $request)
    {
        $request->validate([
            'college_id' => 'required|exists:colleges,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->storeAs('public/images/college/college_gallery', $imageName);

            CollegeGallery::create([
                'college_id' => $request->input('college_id'),
                'image' => $imageName,
                'caption' => $request->input('caption'),
            ]);

            return redirect()->route('collegeadmin.collegegallery')->with('success', 'Gallery entry added successfully.');
        }

        return redirect()->back()->with('error', 'Image upload failed. Please try again.');
    }

    public function collegegallerydelete($id)
    {
        $gallery = CollegeGallery::findOrFail($id);

        $imagePath = storage_path('app/public/images/college/college_gallery/' . $gallery->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $gallery->delete();

        return redirect()->route('collegeadmin.collegegallery')->with('success', 'Gallery entry deleted successfully.');
    }
}
