<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Publisher;
use App\Models\Review;
use App\Models\User;

class DashboardController extends Controller
{
    public function adminDashboard(){
        $allCategory = Category::count();
        $activeCategory = Category::where('status', 'active')->count();
        $pendingCategory = Category::where('status', 'inactive')->count();

        $allAuthor = Author::count();
        $activeAuthor = Author::where('status', 'active')->count();
        $pendingAuthor = Author::where('status', 'inactive')->count();


        $allPublishers = Publisher::count();
        $activePublishers = Publisher::where('status', 'active')->count();
        $pendingPublishers = Publisher::where('status', 'inactive')->count();

        $allBook = Book::count();
        $availableBook = Book::where('status', 'available')->count();
        $notavailableBook = Book::where('status', 'not_available')->count();


        $allReview = Review::count();
        $activeReview = Review::where('status', 'active')->count();
        $pendingReview = Review::where('status', 'inactive')->count();

        $allUser = User::where('role', 'user')->count();
        $activeUser = User::where('role', 'user')->where('status', 'active')->count();
        $pendingUser = User::where('role', 'user')->where('status', 'inactive')->count();

        $allMessage = Contact::count();

        return view('admin.dashboard', compact(
            'activeCategory',
            'allCategory',
            'pendingCategory',
            'allAuthor',
            'activeAuthor',
            'pendingAuthor',
            'allPublishers',
            'activePublishers',
            'pendingPublishers',
            'availableBook',
            'notavailableBook',
            'allReview',
            'activeReview',
            'pendingReview',
            'allUser',
            'activeUser',
            'pendingUser',
            'allMessage',
            'allBook'

        ));
    }

    public function userDashboard(){
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();
        return view('user', compact('category', 'author', 'publisher'));
    }
}
