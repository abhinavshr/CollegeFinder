<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\contactus;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function ContactUsIndex(){
        return view('users.contactus');
    }

    public function ContactUsStore(Request $request){
        $request->validate([
            'fullname' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $contactus = contactus::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return redirect()->route('user.contactus')->with('success', 'Message sent successfully');
    }
}
