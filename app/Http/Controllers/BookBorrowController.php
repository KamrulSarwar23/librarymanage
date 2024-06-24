<?php


namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use App\Models\BookQuantity;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class BookBorrowController extends Controller
{

    public function index(Request $request)
    {
        // Retrieve the status query parameter
        $status = $request->query('status');

        // Query the Borrow model based on the status parameter
        $query = Borrow::where('platform', 'online')->orderBy('created_at', 'DESC');

        if ($status) {
            $query->where('status', $status);
        }

        $borrowedBooks = $query->paginate(10);

        return view('admin.borrow.index', compact('borrowedBooks'));
    }


    public function updateInfo(string $id, Request $request)
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
                    })

                    ->orWhereHas('book', function ($q) use ($searchQuery) {
                        $q->where('title', 'like', '%' . $searchQuery . '%');
                    });
            });
        }

        $borrowedBooks = $query->where('platform', 'online')->orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.borrow.index', compact('borrowedBooks', 'searchQuery'));
    }


    public function onLineborrowDetails(string $id){

        $borrowBook = Borrow::findOrFail($id);
        return view('admin.borrow.onlineBookDetails', compact('borrowBook'));
    }

}
