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
        $bookQuantity = BookQuantity::findOrFail($request->quantityId);
        $bookQuantity->status = $request->status;
        $bookQuantity->save();

        return response()->json(['message' => 'Status has been Updated!']);
    }

    public function destroy(string $quantityId)
    {

        $book = BookQuantity::findOrFail($quantityId);

        if (count($book->borrow) > 0) {
            return response()->json(['status' => 'error', 'message' => 'Cant Delete! It Has Borrow Request']);
        }
        
        $book->delete();
        return response()->json(['status' => 'success', 'message' => 'Book Deleted Successfully']);
    }


    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);
       
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
