<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Publisher;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
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
        $activeBook = Book::where('preview', 'active')->count();
        $inactiveBook = Book::where('preview', 'inactive')->count();


        $allReview = Review::count();
        $activeReview = Review::where('status', 'active')->count();
        $pendingReview = Review::where('status', 'inactive')->count();

        $allUser = User::where('role', 'user')->count();
        $activeUser = User::where('role', 'user')->where('status', 'active')->count();

        $pendingUser = User::where('role', 'user')->where('status', 'inactive')->count();

        $newUsers = User::where('role', 'user')
            ->where('status', 'inactive')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

            
        $newBookRequest = Borrow::where('status', 'pending')
        ->orderBy('created_at', 'desc')
        ->take(8)
        ->get();

        $allMessage = Contact::count();

        $allBorrow = Borrow::count();
        $receiveBorrow = Borrow::where('status', 'receive')->count();
        $pendingBorrow = Borrow::where('status', 'pending')->count();
        $rejectBorrow = Borrow::where('status', 'reject')->count();
        $returnBorrow = Borrow::where('status', 'return')->count();

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
            'allReview',
            'activeReview',
            'pendingReview',
            'allUser',
            'activeUser',
            'pendingUser',
            'allMessage',
            'allBook',
            'activeBook',
            'allBorrow',
            'inactiveBook',
            'receiveBorrow',
            'pendingBorrow',
            'rejectBorrow',
            'returnBorrow',
            'newUsers',
            'newBookRequest'

        ));
    }

    public function userDashboard()
    {
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();
        $borrowBooks = Borrow::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5);


        return view('user', compact('category', 'author', 'publisher', 'borrowBooks'));
    }


  
}
