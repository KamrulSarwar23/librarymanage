<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Borrow;
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

    public function allBook()
    {

        $books = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('preview', 'active')->paginate(8);

        $popularBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'popular')->where('preview', 'active')->paginate(6);

        $recentBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recent')->where('preview', 'active')->paginate(6);


        $featuredBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'featured')->where('preview', 'active')->paginate(6);


        $recommendedBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recommended')->where('preview', 'active')->paginate(6);

        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();


        return view('frontend.book', compact('books', 'category', 'author', 'publisher', 'popularBook', 'recentBook', 'featuredBook', 'recommendedBook'));
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


        $popularBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'popular')->where('preview', 'active')->paginate(6);

        $recentBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recent')->where('preview', 'active')->paginate(6);


        $featuredBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'featured')->where('preview', 'active')->paginate(6);


        $recommendedBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recommended')->where('preview', 'active')->paginate(6);

        if ($books->isEmpty()) {
            flash()->error('No data found');
        }

        return view('frontend.book', compact('books', 'category', 'author', 'publisher', 'categoryName', 'popularBook', 'recentBook', 'featuredBook', 'recommendedBook'));
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

        $popularBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'popular')->where('preview', 'active')->paginate(6);

        $recentBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recent')->where('preview', 'active')->paginate(6);


        $featuredBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'featured')->where('preview', 'active')->paginate(6);


        $recommendedBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recommended')->where('preview', 'active')->paginate(6);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }
        return view('frontend.book', compact('books', 'category', 'author', 'publisher', 'authorName', 'popularBook', 'recentBook', 'featuredBook', 'recommendedBook'));
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

        $popularBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'popular')->where('preview', 'active')->paginate(6);

        $recentBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recent')->where('preview', 'active')->paginate(6);


        $featuredBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'featured')->where('preview', 'active')->paginate(6);


        $recommendedBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recommended')->where('preview', 'active')->paginate(6);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('frontend.book', compact('books', 'category', 'author', 'publisher', 'publisherName', 'popularBook', 'recentBook', 'featuredBook', 'recommendedBook'));
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
        
        $popularBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'popular')->where('preview', 'active')->paginate(6);

        $recentBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recent')->where('preview', 'active')->paginate(6);


        $featuredBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'featured')->where('preview', 'active')->paginate(6);


        $recommendedBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recommended')->where('preview', 'active')->paginate(6);


        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('frontend.book', compact('books', 'category', 'author', 'publisher', 'searchQuery', 'popularBook', 'recentBook', 'featuredBook', 'recommendedBook'));
    }

    public function borrowBook(Request $request)
    {
        $bookId = $request->input('bookId');
        $userId = $request->input('userId');

        $existingRecord = Borrow::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->whereNull('returned_at')
            ->exists();

        if ($existingRecord) {
            flash()->error('You already send request for this book');
            return redirect()->back();
        }

        $borrow = new Borrow();
        $borrow->book_id = $bookId;
        $borrow->user_id = $userId;
        $borrow->save();

        flash()->success('Your borrow request is currently in pending');

        return redirect()->back();
    }
}
