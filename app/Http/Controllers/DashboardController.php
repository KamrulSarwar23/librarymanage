<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Review;
use App\Models\User;

class DashboardController extends Controller
{
    public function adminDashboard(){
        $allCategory = Category::count();
        $activeCategory = Category::where('status', 'active')->count();

        $allAuthor = Author::count();
        $activeAuthor = Author::where('status', 'active')->count();


        $allPublishers = Publisher::count();
        $activePublishers = Publisher::where('status', 'active')->count();

        $availableBook = Book::where('status', 'available')->count();
        $reservedBook = Book::where('status', 'reserved')->count();
        $lostBook = Book::where('status', 'lost')->count();
        $checkoutBook = Book::where('status', 'checked_out')->count();

        $allReview = Review::count();
        $activeReview = Review::where('status', 'active')->count();
        $pendingReview = Review::where('status', 'inactive')->count();

        $allUser = User::count();
        $activeUser = User::where('status', 'active')->count();
        $pendingUser = User::where('status', 'inactive')->count();
        
        return view('admin.dashboard', compact(
            'activeCategory', 
            'allCategory', 
            'allAuthor', 
            'activeAuthor', 
            'allPublishers', 
            'activePublishers',
            'availableBook',
            'reservedBook',
            'lostBook',
            'checkoutBook',
            'allReview',
            'activeReview',
            'pendingReview',
            'allUser',
            'activeUser',
            'pendingUser'
        ));
    }

    public function userDashboard(){
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();
        return view('user', compact('category', 'author', 'publisher'));
    }
}
