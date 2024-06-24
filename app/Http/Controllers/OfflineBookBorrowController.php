<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookQuantity;
use App\Models\Borrow;
use App\Models\OfflineBookBorrow;
use App\Models\Policy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfflineBookBorrowController extends Controller
{

    public function getBooks()
    {
        $books = Book::with(['quantities' => function ($query) {
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

    public function index(Request $request)
    {

        $status = $request->query('status');

        $query = Borrow::where('platform', 'offline')->orderBy('created_at', 'DESC');

        if ($status) {
            $query->where('status', $status);
        }

        $offlinebooks = $query->paginate(10);

        $policy = Policy::first();

        return view('admin.borrow.offlinebook', compact('offlinebooks', 'policy'));
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

        $MaxBorrow = Borrow::where('user_id', $request->user_id)->whereNotNull('due_at')->where('status', 'receive')->whereNull('returned_at')->count();

        if ($borrowCount) {
            flash()->error('This Book Already Added');
            return redirect()->back();
        }

        if ($MaxBorrow >= 3) {
            flash()->warning('Already 3 Books Borrowed');
            return redirect()->back();
        }

        Borrow::create([
            'book_id' => $request->book_id,
            'qty_id' => $bookQuantity->id,
            'user_id' => $request->user_id,
            'issued_at' => Carbon::now('Asia/Dhaka'),
            'due_at' => $request->due_date,
            'returned_at' => null,
            'status' => 'receive',
            'platform' => 'offline'
        ]);

        $bookQuantity->decrement('current_qty');

        flash()->success('Submit Successfully');

        return redirect()->back();
    }


    public function updateOfflineInfo(string $id, Request $request)
    {
        try {
            DB::beginTransaction();

            $borrowRecord = Borrow::findOrFail($id);
            $status = $request->status;
            $bookQuantity = BookQuantity::find($borrowRecord->qty_id);
            $MaxBorrow = Borrow::where('user_id', $borrowRecord->user_id)->whereNotNull('issued_at')->whereNull('returned_at')->count();


            // Check if the current status is "return" and prevent updating to "reject", "pending", or "receive"
            if ($borrowRecord->status === "return" && in_array($status, ["reject", "pending", "receive"])) {
                flash()->warning('This Book Already Return');
                return redirect()->back();
            }

            if (in_array($status, ["receive"]) && $MaxBorrow >= 3) {
                flash()->warning('Already 3 Books Borrowed');
                return redirect()->back();
            }

            if ($borrowRecord->issued_at === null && in_array($status, ["return"])) {

                flash()->warning('Book Not Issued Yet');

                return redirect()->back();
            }

            if (in_array($borrowRecord->status, ["reject", "return"]) && in_array($status, ["receive", "pending"])) {
                $bookQuantity->decrement('current_qty');
            }

            $updateData = ['status' => $status];

            if ($status === "receive") {
                $updateData['issued_at'] = Carbon::now('Asia/Dhaka');
            } elseif ($status === "return") {
                $updateData['returned_at'] = Carbon::now('Asia/Dhaka');
                $updateData['fine'] = $borrowRecord->calculateFine();
            } elseif ($status === "reject") {
                $updateData['issued_at'] = null;
            }

            $borrowRecord->update($updateData);

            if (in_array($status, ["return", "reject"]) && $bookQuantity) {
                $bookQuantity->increment('current_qty');
            }

            flash()->success('This Borrow Request Updated Successfully');
            DB::commit();

            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('An error occurred while updating the borrow request.');
            return redirect()->back();
        }
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
                    })

                    ->orWhereHas('book', function ($q) use ($searchQuery) {
                        $q->where('title', 'like', '%' . $searchQuery . '%');
                    });
            });
        }

        $offlinebooks = $query->where('platform', 'offline')->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.borrow.offlinebook', compact('offlinebooks', 'searchQuery'));
    }

    public function borrowDetails(string $id)
    {

        $borrowBook = Borrow::findOrFail($id);
        return view('admin.borrow.show', compact('borrowBook'));
    }
}
