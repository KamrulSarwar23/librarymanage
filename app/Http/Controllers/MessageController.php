<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index(){

        $messages = Contact::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.message.index', compact('messages'));
    }

    public function destroy(string $id){

        $messages = Contact::findOrFail($id);
        $messages->delete();
        return response()->json(['status' => 'success', 'message' => 'Message deleted successfully.']);
    }

}
