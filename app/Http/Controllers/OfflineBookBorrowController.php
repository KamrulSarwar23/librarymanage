<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookQuantity;
use App\Models\Borrow;
use App\Models\OfflineBookBorrow;
use App\Models\User;
use Illuminate\Http\Request;

class OfflineBookBorrowController extends Controller
{

    public function getBooks()
    {
        $books = Book::with(['quantities' => function($query){
            $query->where('status', 'activate');
        }])->where('preview', 'active')->get();

        $books = $books->map(function ($book) {
            $totalQuantity = $book->quantities->sum('current_qty'); // Assuming 'quantity' is the column name
            return [
                'id' => $book->id,
                'title' => $book->title,
                'total_quantity' => $totalQuantity,
                'rating' => $book->rating,
                'quantities' => $book->quantities,
            ];
        });

        return response()->json($books);
    }



    public function getUsers()
    {
        $users = User::where('status', 'active')->get();
        return response()->json($users);
    }

    public function index()
    {

        $offlinebooks = Borrow::where('platform', 'offline')->orderBy('created_at', 'DESC')->get();

        return view('admin.borrow.offlinebook', compact('offlinebooks'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'book_id' => 'required',
            'user_id' => 'required',
            'issue_date' => 'nullable',
            'due_date' => 'nullable',
            'return_date' => 'nullable',
        ]);


        $bookQuantity = BookQuantity::where('book_id', $request->book_id)->where('current_qty', '>', 0)->first();

        $books = Book::with(['quantities' => function ($query) {
            $query->where('current_qty', '>', 0);
        }])->where('id', $request->book_id)->first();


        if (count($books->quantities) <= 0) {
            flash()->warning('This Book Not Available');
            return redirect()->back();
        }

        $borrowCount = Borrow::where('user_id', $request->user_id)->where('book_id', $request->book_id)->whereNull('returned_at')->count();

        if ($borrowCount) {
            flash()->error('This Book Already Added');
            return redirect()->back();
        }

        Borrow::create([
            'book_id' => $request->book_id,
            'qty_id' => $bookQuantity->id,
            'user_id' => $request->user_id,
            'issued_at' => now('UTC'),
            'due_at' => $request->due_date,
            'returned_at' => null,
            'status' => 'receive',
            'platform' => 'offline'
        ]);

        $bookQuantity->decrement('current_qty');

        flash()->success('Submit Successfully');

        return redirect()->back();
    }


    public function update(string $id, Request $request)
    {
        $borrow = Borrow::findOrFail($id);

        if (!is_null($borrow->returned_at)) {
            flash()->warning('This Book Already Returned');
            return redirect()->back();
        }

        $borrow->update([
            'status' => 'return',
            'returned_at' => now('UTC'),
        ]);

        $bookQuantity = BookQuantity::findOrFail($borrow->qty_id);
        $bookQuantity->increment('current_qty');

        flash()->success('This Book Return Successfully');
        return redirect()->back();
    }


    public function offlineBorrowBookSearch(Request $request)
        {
            $searchQuery = $request->input('search_query');

            $query = Borrow::query();

            if (!empty($searchQuery)) {
                $query->where(function ($query) use ($searchQuery) {

                    $query->where('status', 'like', '%' . $searchQuery . '%')

                        ->orWhereHas('user', function ($q) use ($searchQuery) {
                            $q->where('name', 'like', '%' . $searchQuery . '%');
                        })

                        ->orWhereHas('user', function ($q) use ($searchQuery) {
                            $q->where('email', 'like', '%' . $searchQuery . '%');
                        });
                });
            }

            $offlinebooks = $query->where('platform', 'offline')->orderBy('created_at', 'DESC')->paginate(10);

            return view('admin.borrow.offlinebook', compact('offlinebooks'));
        }
}
