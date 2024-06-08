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

    private function getBooksByType($type = null, $paginate = 8)
    {
        $query = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->with(['quantities' => function ($query) {
            $query->where('status', 'activate');
        }])->where('preview', 'active');

        if ($type) {
            $query->where('type', $type);
        }

        return $paginate ? $query->paginate($paginate) : $query->get();
    }

    private function getCommonData()
    {
        return [
            'category' => Category::where('status', 'active')->get(),
            'author' => Author::where('status', 'active')->get(),
            'publisher' => Publisher::where('status', 'active')->get(),
        ];
    }

    public function allBook()
    {
        $books = $this->getBooksByType();
        $popularBook = $this->getBooksByType('popular', null);
        $recentBook = $this->getBooksByType('recent', null);
        $featuredBook = $this->getBooksByType('featured', null);
        $recommendedBook = $this->getBooksByType('recommended', null);

        return view('frontend.book', array_merge(
            compact('books', 'popularBook', 'recentBook', 'featuredBook', 'recommendedBook'),
            $this->getCommonData()
        ));
    }

    public function filterByCategory($id)
    {
        $categoryName = Category::findOrFail($id);
        $books = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('preview', 'active')->where('category_id', $id)->paginate(8);

        if ($books->isEmpty()) {
            flash()->error('No data found');
        }

        return view('frontend.book', array_merge(
            compact('books', 'categoryName'),
            $this->getCommonData(),
            [
                'popularBook' => $this->getBooksByType('popular', null),
                'recentBook' => $this->getBooksByType('recent', null),
                'featuredBook' => $this->getBooksByType('featured', null),
                'recommendedBook' => $this->getBooksByType('recommended', null),
            ]
        ));
    }

    public function filterByAuthor($id)
    {
        $authorName = Author::findOrFail($id);
        $books = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('preview', 'active')->where('author_id', $id)->paginate(8);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('frontend.book', array_merge(
            compact('books', 'authorName'),
            $this->getCommonData(),
            [
                'popularBook' => $this->getBooksByType('popular', null),
                'recentBook' => $this->getBooksByType('recent', null),
                'featuredBook' => $this->getBooksByType('featured', null),
                'recommendedBook' => $this->getBooksByType('recommended', null),
            ]
        ));
    }

    public function filterByPublisher($id)
    {
        $publisherName = Publisher::findOrFail($id);
        $books = Book::with(['rating' => function ($query) {
            $query->where('status', 'active');
        }])->where('preview', 'active')->where('publisher_id', $id)->paginate(8);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('frontend.book', array_merge(
            compact('books', 'publisherName'),
            $this->getCommonData(),
            [
                'popularBook' => $this->getBooksByType('popular', null),
                'recentBook' => $this->getBooksByType('recent', null),
                'featuredBook' => $this->getBooksByType('featured', null),
                'recommendedBook' => $this->getBooksByType('recommended', null),
            ]
        ));
    }

    public function bookDetails(string $id)
    {
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

        return view('frontend.book-details', array_merge(
            compact('totalCurrentQty', 'booksdetails', 'enjoyedbook', 'booksReview', 'totalReviews', 'averageRating'),
            $this->getCommonData()
        ));
    }

    public function bookSearch(Request $request)
    {
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

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('frontend.book', array_merge(
            compact('books', 'searchQuery'),
            $this->getCommonData(),
            [
                'popularBook' => $this->getBooksByType('popular', null),
                'recentBook' => $this->getBooksByType('recent', null),
                'featuredBook' => $this->getBooksByType('featured', null),
                'recommendedBook' => $this->getBooksByType('recommended', null),
            ]
        ));
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
            $totalCurrentQty += $quantityBook->current;
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
