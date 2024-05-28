<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;

class DashboardController extends Controller
{
    public function adminDashboard(){
        return view('admin.dashboard');
    }

    public function userDashboard(){
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();
        return view('user', compact('category', 'author', 'publisher'));
    }
}
