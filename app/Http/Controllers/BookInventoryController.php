<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\BookQuantity;
use Illuminate\Http\Request;

class BookInventoryController extends Controller
{
    public function index($bookId)
    {
        $readers = Borrow::where("book_id", $bookId)
            ->whereNotNull('issued_at')
            ->whereNull('returned_at')->get();
            
        $book = Book::find($bookId);

        return view('admin.inventory.readers', compact('readers', 'book'));
    }
}
