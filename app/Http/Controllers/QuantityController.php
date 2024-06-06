<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Book;
use App\Models\BookQuantity;
use Illuminate\Http\Request;
use App\Helper\QuantityManage;

class QuantityController extends Controller
{
    public function index($bookId)
    {

        // dd($bookId);
        $book = Book::find($bookId);
        $quantitys = BookQuantity::where('book_id', $bookId)->get();
        return view('admin.Book-quantity.index', compact(['quantitys', 'book']));
    }

    public function changeStatus(Request $request)
    {
        // dd($request->status);
        $bookQuantity = BookQuantity::findOrFail($request->quantityId);
        $bookQuantity->status = $request->status;
        $bookQuantity->save();

        return response()->json(['message' => 'Status has been Updated!']);
    }

    public function destroy(string $quantityId)
    {
        // dd($quantityId);
        $book = BookQuantity::findOrFail($quantityId);
        $book->delete();
        return response()->json(['status' => 'success', 'message' => 'Book Deleted Successfully']);
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);
        // dd($request->book_id);
        try {
            // Create a new BookQuantity record
            BookQuantity::create([
                'book_id' => $request->book_id,
                'quantity' => $request->quantity,
                'current_qty' => $request->quantity,
            ]);

            // Flash success message
            flash()->success('Successfully Added Similar Book');
        } catch (\Exception $e) {
            // Log the error
            // \Log::error('Error creating book quantity: ' . $e->getMessage());

            // Flash error message
            flash()->error('An error occurred while adding the book quantity. Please try again.');
        }

        // Redirect back
        return redirect()->back();
    }
}
