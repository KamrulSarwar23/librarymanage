<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookQuantity;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Review;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function allBook()
    {

        $books = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->with(['quantities' => function ($query) {
            $query->where('status', 'activate');
        }])->where('preview', 'active')->paginate(8);


        $popularBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'popular')->where('preview', 'active')->get();

        $recentBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recent')->where('preview', 'active')->get();


        $featuredBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'featured')->where('preview', 'active')->get();


        $recommendedBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recommended')->where('preview', 'active')->get();

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
        }])->where('preview', 'active')->where('category_id', $id)->paginate(8);


        $popularBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'popular')->where('preview', 'active')->get();

        $recentBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recent')->where('preview', 'active')->get();


        $featuredBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'featured')->where('preview', 'active')->get();


        $recommendedBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recommended')->where('preview', 'active')->get();

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
        }])->where('preview', 'active')->where('author_id', $id)->paginate(8);

        $popularBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'popular')->where('preview', 'active')->get();

        $recentBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recent')->where('preview', 'active')->get();


        $featuredBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'featured')->where('preview', 'active')->get();


        $recommendedBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recommended')->where('preview', 'active')->get();

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
        }])->where('preview', 'active')->where('publisher_id', $id)->paginate(8);

        $popularBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'popular')->where('preview', 'active')->get();

        $recentBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recent')->where('preview', 'active')->get();


        $featuredBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'featured')->where('preview', 'active')->get();


        $recommendedBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recommended')->where('preview', 'active')->get();

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
        }])->with(['quantities' => function ($query) {
            $query->where('status', 'activate');
        }])->findOrFail($id);

        // Calculate the sum of current_qty for the active quantities
        $totalCurrentQty = $booksdetails->quantities->where('status', 'activate')->sum('current_qty');

        $booksReview = Review::where('status', 'active')->where('book_id', $id)->orderBy('created_at', 'DESC')->paginate(3);

        $allReview = Review::where('status', 'active')->where('book_id', $id)->orderBy('created_at', 'DESC')->get();

        $totalReviews = Review::where('status', 'active')->where('book_id', $id)->count();

        $averageRating = round($totalReviews > 0 ? $allReview->avg('rating') : 0, 1);

        $enjoyedbook = Book::where('id', '!=', $id)
            ->where(function ($query) use ($booksdetails) {
                $query->where('category_id', $booksdetails->category_id)
                    ->orWhere('author_id', $booksdetails->author_id)
                    ->orWhere('publisher_id', $booksdetails->publisher_id);
            })->take(4)->get();

        return view('frontend.book-details', compact('totalCurrentQty', 'booksdetails', 'enjoyedbook', 'category', 'author', 'publisher', 'booksReview', 'totalReviews', 'averageRating'));
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

        $books = $query->paginate(8);

        $popularBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'popular')->where('preview', 'active')->paginate(6);

        $recentBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recent')->where('preview', 'active')->get();


        $featuredBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'featured')->where('preview', 'active')->get();


        $recommendedBook = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('type', 'recommended')->where('preview', 'active')->get();


        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('frontend.book', compact('books', 'category', 'author', 'publisher', 'searchQuery', 'popularBook', 'recentBook', 'featuredBook', 'recommendedBook'));
    }


    public function borrowBook(Request $request)
    {
        $bookId = $request->input('bookId');
        $userId = $request->input('userId');

        // Check if the user has already borrowed this book and not returned it yet
        $existingRecord = Borrow::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->whereNull('returned_at')
            ->exists();

        // Get all book quantities
        $quantityBooks = BookQuantity::where('book_id', $bookId)->get();

        // Check if any book quantity or status meets the conditions for 'Stock Out'
        $isStockOut = true;
        $totalCurrentQty = 0;
        foreach ($quantityBooks as $quantityBook) {
            if ($quantityBook->status == 'activate' && $quantityBook->current_qty > 0) {
                $isStockOut = false;
            }
            $totalCurrentQty += $quantityBook->current_qty;
        }

        if ($isStockOut) {
            flash()->error('Stock Out');
            return redirect()->back();
        }

        // Check if the user has already borrowed 3 books
        $borrowedBooksCount = Borrow::where('user_id', $userId)
            ->whereNotNull('issued_at')
            ->whereNull('returned_at')
            ->count();

        $cantAddMoreThanfive = Borrow::where('user_id', $userId)
            ->whereNull('issued_at')
            ->whereNull('returned_at')
            ->count();

        if ($borrowedBooksCount == 3 ) {
            flash()->error('You Cant Borrow More Than 3 Books. After Return Those You Can Borrow More');
            return redirect()->back();
        }

        if ($cantAddMoreThanfive == 5) {
            flash()->error('You Cant Add More Than 5 Books');
            return redirect()->back();
        }

        // Check if the user has already requested this book
        if ($existingRecord) {
            flash()->error('You have already sent a request for this book.');
            return redirect()->back();
        }

        // Proceed to save the borrow request
        $borrow = new Borrow();
        $borrow->book_id = $bookId;
        $borrow->user_id = $userId;
        $borrow->save();

        flash()->success('Your borrow request is currently pending.');
        return redirect()->back();
    }
}
