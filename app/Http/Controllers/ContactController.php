<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function contact()
    {
        return view('frontend.contact');
    }

    public function sendMessage(Request $request)
    {
        // Validate the request data
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|max:15',
            'message' => 'required|string|max:1000',
        ]);

        $message = Contact::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        return response()->json(['success' => 'Message sent successfully!']);
    }
}
