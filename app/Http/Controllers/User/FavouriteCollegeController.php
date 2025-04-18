<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteCollegeController extends Controller
{
    public function favouriteCollegeIndex(){

        $favorites = Favorite::with('college')
            ->where('user_id', Auth::id())
            ->get();
        return view('Users.favourite', compact('favorites'));
    }
}
