<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about(){
        return view('frontend.about');
    }

    public function blog(){
        return view('frontend.blog');
    }

    public function contact(){
        return view('frontend.contact');
    }

    public function services(){
        return view('frontend.services');
    }

}
