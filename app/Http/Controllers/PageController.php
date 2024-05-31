<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Review;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $books = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('preview', 'active')->paginate(12);

        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        return view('frontend.index', compact('books', 'category', 'author', 'publisher'));
    }

    public function filterByCategory($id)
    {

        $categoryName = Category::findOrFail($id);

        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $books = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('preview', 'active')->where('category_id', $id)->paginate(12);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('frontend.index', compact('books', 'category', 'author', 'publisher', 'categoryName'));
    }

    public function filterByAuthor($id)
    {

        $authorName = Author::findOrFail($id);
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $books = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('preview', 'active')->where('author_id', $id)->paginate(12);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }
        return view('frontend.index', compact('books', 'category', 'author', 'publisher', 'authorName'));
    }

    public function filterByPublisher($id)
    {

        $publisherName = Publisher::findOrFail($id);
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $books = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('preview', 'active')->where('publisher_id', $id)->paginate(12);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('frontend.index', compact('books', 'category', 'author', 'publisher', 'publisherName'));
    }


    public function contact()
    {
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();
        return view('frontend.contact', compact('category', 'author', 'publisher'));
    }

    public function bookDetails(string $id)
    {

        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $booksdetails = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->findOrFail($id);

        $booksReview = Review::where('status', 'active')->where('book_id', $id)->orderBy('created_at', 'DESC')->paginate(3);

        $allReview = Review::where('status', 'active')->where('book_id', $id)->orderBy('created_at', 'DESC')->get();

        $totalReviews = Review::where('status', 'active')->where('book_id', $id)->count();

        $averageRating = round($totalReviews > 0 ? $allReview->avg('rating') : 0, 1);

        $enjoyedbook = Book::where('id', '!=', $id)
            ->where(function ($query) use ($booksdetails) {
                $query->where('category_id', $booksdetails->category_id)
                    ->orWhere('author_id', $booksdetails->author_id)
                    ->orWhere('publisher_id', $booksdetails->publisher_id);
            })
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('frontend.book-details', compact('booksdetails', 'enjoyedbook', 'category', 'author', 'publisher', 'booksReview', 'totalReviews', 'averageRating'));
    }


    public function bookSearch(Request $request)
    {
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $searchQuery = $request->input('search_query');

        $query = Book::query();

        if (!empty($searchQuery)) {
            $query->where('preview', 'active')
                ->where(function ($query) use ($searchQuery) {
                    $query->where('title', 'like', '%' . $searchQuery . '%')
                        ->orWhereHas('category', function ($q) use ($searchQuery) {
                            $q->where('name', 'like', '%' . $searchQuery . '%');
                        })
                        ->orWhereHas('author', function ($q) use ($searchQuery) {
                            $q->where('name', 'like', '%' . $searchQuery . '%');
                        })
                        ->orWhereHas('publisher', function ($q) use ($searchQuery) {
                            $q->where('name', 'like', '%' . $searchQuery . '%');
                        });
                })
                ->with(['rating' => function ($query) {
                    $query->where('status', 'active');
                }]);
        }

        $books = $query->paginate(12);


        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('frontend.index', compact('books', 'category', 'author', 'publisher', 'searchQuery'));
    }
}
