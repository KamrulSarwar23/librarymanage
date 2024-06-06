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
        $borrowedBooks = Borrow::all();
        
        $books = [];

        foreach ($borrowedBooks as $borrowedBook) {
            $book = Book::find($borrowedBook->book_id);
            $user = User::find($borrowedBook->user_id);


            $books[] = [
                'bookId' => $borrowedBook->book_id,
                'userId' => $borrowedBook->user_id,
                'userEmail' => $user->email,
                'username' => $user->name,
                'bookTitle' => $book->title,
                'issued_at' => $borrowedBook->issued_at,
                'due_at' => $borrowedBook->due_at,
                'status' => $borrowedBook->status
            ];
        }

        return view('admin.borrow.index', compact('books'));
    }


    public function updateInfo(Request $request)
    {
        $bookId = $request->book_id;
        $userId = $request->user_id;
        $issueDate = $request->issued_at;
        $dueDate = $request->due_at;
        $status = $request->status;

        $borrowRecords = Borrow::where('book_id', $bookId)->where('user_id', $userId)->first();

        if ($status === 'inactive') {
            $borrowRecords->update([
                'due_at' => null,
                'issued_at' => null,
                'status' => $status
            ]);
        } else {
            $borrowRecords->update([
                'due_at' => $dueDate ?? now()->addWeek(),
                'issued_at' => $issueDate ?? now(),
                'status' => $status
            ]);
        }
        return redirect()->route('book.borrowinfo');
    }
}
