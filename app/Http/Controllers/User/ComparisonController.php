<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Colleges;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    public function ComparisonIndex(){
        if (!auth()->user()) {
            return redirect()->route('user.userlogin');
        }
        $colleges = Colleges::all();
        return view('users.comparison', compact('colleges'));
    }
}
