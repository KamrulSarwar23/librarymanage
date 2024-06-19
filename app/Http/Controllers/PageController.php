<?php

namespace App\Http\Controllers;

use App\Helper\AxistBookingRequestHelper;
use App\Models\Book;
use App\Models\Author;
use App\Models\Borrow;
use App\Models\Review;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\BookQuantity;
use Illuminate\Http\Request;
use App\Helper\QuantityManage;
use App\Models\Policy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        $policy = Policy::first();


        return view('frontend.book', compact('books', 'category', 'author', 'publisher', 'popularBook', 'recentBook', 'featuredBook', 'recommendedBook', 'policy'));
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

        $policy = Policy::firstOrFail();

        return view('frontend.book-details', compact('totalCurrentQty', 'booksdetails', 'enjoyedbook', 'category', 'author', 'publisher', 'booksReview', 'totalReviews', 'averageRating', 'policy'));
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

        $validator = Validator::make($request->all(), [
            'bookId' => 'required',
            'userId' => 'required',
            'returned_at' => 'required|date',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Extracting inputs from the validated request
        $bookId = $request->input('bookId');
        $userId = $request->input('userId');
        $returned_at = $request->input('returned_at');

        $MaxBorrow = Borrow::where('user_id', Auth::user()->id)->where('status', ['pending', 'receive'])->whereNull('returned_at')->count();


        if ($MaxBorrow >= 3) {
            flash()->warning('Already 3 Books Added');
            return redirect()->back();
        }


        // Check if the user has already requested this book
        if (AxistBookingRequestHelper::existsForBook($bookId, $userId)) {
            flash()->error('You have already sent a request for this book.');
            return redirect()->back();
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Check if the book quantity is available
            if (QuantityManage::isQuantityAvailable($bookId)) {
                // Fetch the book quantity record
                $quantityBooks = BookQuantity::where('book_id', $bookId)
                    ->where('current_qty', '>', 0)->where('status', 'activate')
                    ->first();

                // Decrement the current quantity by 1
                $quantityBooks->update([
                    'current_qty' => $quantityBooks->current_qty - 1
                ]);

                // Create a new borrow record
                Borrow::create([
                    "user_id" => $userId,
                    "book_id" => $bookId,
                    "qty_id" => $quantityBooks->id,
                    "due_at" => $returned_at,
                ]);

                DB::commit();

                // Inform the user about the successful borrow request
                flash()->success('Your borrow request is currently pending. Please receive this around 5 hours.');
                return redirect()->back();
            } else {
                DB::rollBack();

                // Inform the user that the book is not available
                flash()->error('Not Available.');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    public function policy()
    {
        $policy = Policy::first();
        return view('frontend.user-policy', compact('policy'));
    }
}
