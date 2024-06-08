<?php


namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\BookQuantity;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookBorrowController extends Controller
{
    public function index()
    {

        $borrowedBooks = Borrow::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.borrow.index', compact('borrowedBooks'));
    }

    public function edit(string $id)
    {
        $borrowRecords = Borrow::findOrFail($id);
        return view('admin.borrow.edit', compact('borrowRecords'));
    }


    public function updateInfo(String $id, Request $request)
    {

        $borrowRecords = Borrow::findOrFail($id);

        $borrowCount = Borrow::where('user_id', Auth::user()->id)->whereNotNull('issued_at')
        ->whereNull('returned_at')
        ->count();

        if ($borrowCount) {

        }

        if ($request->status == 'active') {

            $request->validate([
                'issued_at' => 'required',
                'due_at' => 'required'
            ]);

            if (!empty($borrowRecords->issued_at)) {
                flash()->error('Book Already Approved');
                return redirect()->back();
            }

            // Reduce the book quantity
            $quantityBooks = BookQuantity::where('book_id', $borrowRecords->book_id)->where('status', 'activate')->get();
            $isStockOut = true;

            foreach ($quantityBooks as $quantityBook) {
                if ($quantityBook->current_qty > 0) {
                    $quantityBook->current_qty -= 1;
                    $quantityBook->save();
                    $isStockOut = false;
                    break;
                }
            }

            if ($isStockOut) {
                flash()->error('Stock Out');
                return redirect()->back();
            }

            // Update borrow record
            $borrowRecords->update([
                'issued_at' => $request->issued_at,
                'due_at' => $request->due_at,
                'status' => $request->status,
            ]);

            flash()->success('Borrow Request Updated Successfully');
            return redirect()->route('book.borrowinfo');

        } elseif ($request->status == 'reject') {


            if ($borrowRecords->status == 'active') {
                $quantityBooks = BookQuantity::where('book_id', $borrowRecords->book_id)->where('status', 'activate')->get();

                foreach ($quantityBooks as $quantityBook) {
                    $quantityBook->current_qty += 1;
                    $quantityBook->save();
                    break;
                }
            }
            // Update borrow record to reject
            $borrowRecords->update([
                'issued_at' => null,
                'due_at' => null,
                'returned_at' => null,
                'status' => $request->status,
            ]);

            flash()->success('Borrow Request Updated Successfully');
            return redirect()->route('book.borrowinfo');
        }
    }


    public function returnBook(string $id, Request $request)
    {

        $request->validate([
            'returned_at' => 'required',
        ]);

        $borrowRecords = Borrow::findOrFail($id);

        if (!empty($borrowRecords->returned_at)) {
            flash()->error('Book already return');
            return redirect()->back();
        }

        $borrowRecords->update([
            'returned_at' => $request->returned_at,
            'status' =>  $request->status
        ]);

        $book = BookQuantity::where('book_id', $borrowRecords->book_id)->where('status', 'activate')->first();

        $book->current_qty += 1;
        $book->save();

        flash()->success('Book Return Successfully');
        return redirect()->route('book.borrowinfo');
    }

    public function borrowBookDelete(string $id)
    {
        $borrowbook = Borrow::findOrFail($id);
        $borrowbook->delete();
        return response()->json(['status' => 'success', 'message' => 'Borrow Request Deleted Successfully']);
    }

    public function borrowBookSearch(Request $request)
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

        $borrowedBooks = $query->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.borrow.index', compact('borrowedBooks'));
    }


    public function borrowBookFilterByStatus(Request $request)
    {

        $query  = $request->query('status');

        $borrowedBooks =  Borrow::where('status', $query)->paginate(10);

        return view('admin.borrow.index', compact('borrowedBooks'));
    }
}
