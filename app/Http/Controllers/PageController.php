<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $books = Book::paginate(12);
        return view('frontend.index', compact('books'));
    }

    public function contact(){
        return view('frontend.contact');
    }


}
