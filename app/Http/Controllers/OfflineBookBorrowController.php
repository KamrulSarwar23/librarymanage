<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookQuantity;
use App\Models\OfflineBookBorrow;
use Illuminate\Http\Request;

class OfflineBookBorrowController extends Controller
{
    public function index()
    {

        $books = Book::where('preview', 'active')->get();
        $offlinebooks = OfflineBookBorrow::orderBy('created_at', 'DESC')->get();
        return view('admin.borrow.offlinebook', compact('books', 'offlinebooks'));
    }

    public function store(Request $request)
    {


        $bookQuantity = BookQuantity::where('book_id', $request->book_id)->where('current_qty', '>', 0)->first();


        $request->validate([
            'book_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
            'issue_date' => 'nullable',
            'due_date' => 'nullable',
            'return_date' => 'nullable',
            'student_id' => 'required',
        ]);

        OfflineBookBorrow::create([
            'book_id' => $request->book_id,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'issue_date' => null,
            'due_date' => null,
            'return_date' => null,
            'student_id' => $request->student_id,
            'status' => 'pending',
            'BookQuantity_id' => $bookQuantity->id
        ]);


        flash()->success('Submit Successfully');
        return redirect()->back();
    }


    public function edit(string $id)
    {

        $books = Book::where('preview', 'active')->get();
        $offlinebooks = OfflineBookBorrow::findOrFail($id);
        return view('admin.borrow.updateOfflinebook', compact('books', 'offlinebooks'));
    }


    public function update(string $id, Request $request)
    {

        if ($request->status == 'return') {

            $request->validate([
                'book_id' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'phone' => 'required',
                'issue_date' => 'required',
                'due_date' => 'required',
                'return_date' => 'required',
                'student_id' => 'required',
                'status' => 'nullable'
            ]);

            $offlineborrow = OfflineBookBorrow::findOrFail($id);


            if ($offlineborrow->return_date !== null) {
                flash()->error('Already Return');
                return redirect()->back();
            }


            if ($offlineborrow->issue_date == null && $offlineborrow->due_date == null) {
                flash()->error('Not Activated Yet');
                return redirect()->back();
            }

            OfflineBookBorrow::findOrFail($id)->update(
                [
                    'return_date' => $request->return_date,
                    'status' => $request->status,
                ]
            );

            $bookQuantity = BookQuantity::where('book_id', $request->book_id)->where('current_qty', '>', 0)->first();

            $bookQuantity->increment('current_qty');

            flash()->success('Submit Successfully');
            return redirect()->route('offline-book-borrow');
        } else {
            $request->validate([
                'book_id' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'phone' => 'required',
                'issue_date' => 'required',
                'due_date' => 'required',
                'return_date' => 'nullable',
                'student_id' => 'required',
                'status' => 'nullable'
            ]);

            $offlineborrow = OfflineBookBorrow::findOrFail($id);

            if ($offlineborrow->issue_date !== null && $offlineborrow->due_date !== null) {
                flash()->error('Already Activated');
                return redirect()->back();
            }

            OfflineBookBorrow::findOrFail($id)->update(
                [
                    'book_id' => $request->book_id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'issue_date' => $request->issue_date,
                    'due_date' => $request->due_date,
                    'return_date' => null,
                    'student_id' => $request->student_id,
                    'status' => $request->status,
                ]
            );

            $bookQuantity = BookQuantity::where('book_id', $request->book_id)->where('current_qty', '>', 0)->first();

            $bookQuantity->decrement('current_qty');

            flash()->success('Submit Successfully');
            return redirect()->route('offline-book-borrow');
        }
    }
}
