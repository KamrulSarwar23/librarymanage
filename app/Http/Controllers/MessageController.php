<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){

        $messages = Contact::all();
        return view('admin.message.index', compact('messages'));
    }

    public function destroy(string $id){

        $messages = Contact::findOrFail($id);
        $messages->delete();
        return response()->json(['status' => 'success', 'message' => 'Message deleted successfully.']);
    }
}
