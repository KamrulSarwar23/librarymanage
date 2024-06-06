<?php


namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;


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
        if ($request->status == 'active') {

            $request->validate([
                'issued_at' => 'required',
                'due_at' => 'required'
            ]);

            $borrowRecords = Borrow::findOrFail($id);
            $borrowRecords->update([
                'issued_at' => $request->issued_at,
                'due_at' => $request->due_at,
                'returned_at' => $request->returned_at,
                'status' => $request->status,
            ]);

            $book = Book::where('id', $borrowRecords->book_id)->first();
            $book->quantity = $book->quantity - 1;
            $book->save();

            flash()->success('Borrow Request Updated Successfully');
            return redirect()->route('book.borrowinfo');
        } elseif ($request->status == 'reject') {
            $borrowRecords = Borrow::findOrFail($id);

            $borrowRecords->update([
                'issued_at' => null,
                'due_at' => null,
                'returned_at' => null,
                'status' => $request->status,
            ]);

            flash()->success('Borrow Request Updated Successfully');
            return redirect()->route('book.borrowinfo');
        } else {
            $borrowRecords = Borrow::findOrFail($id);

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
            $query->where(function ($query) use ($searchQuery){

            $query->where('status', 'like', '%' . $searchQuery . '%')
            
            ->orWhereHas('user', function ($q) use ($searchQuery) {
                    $q->where('name', 'like', '%' . $searchQuery . '%');
                })

            ->orWhereHas('user', function ($q) use ($searchQuery) {
                    $q->where('email', 'like', '%' . $searchQuery . '%');
                });
            });
        }

        $borrowedBooks = $query->paginate(10);

        return view('admin.borrow.index', compact('borrowedBooks'));
    }
}
