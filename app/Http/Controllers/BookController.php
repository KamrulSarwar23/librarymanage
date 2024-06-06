<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Helper\QuantityManage;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{

    public function index()
    {
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();
        $books = Book::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.book.index', compact('books', 'category', 'author', 'publisher'));
    }

    public function filterByStatus(Request $request)
    {
        $status = $request->query('status');

        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        // Get all books
        $books = Book::orderBy('created_at', 'DESC');

        // Filter books based on their availability
        if ($status == "available") {
            $bookIds = $books->pluck('id')->filter(function ($id) {
                return QuantityManage::isQuantityAvailable($id);
            });
            $books = $books->whereIn('id', $bookIds);
        } else if ($status == "not_available") {
            $bookIds = $books->pluck('id')->filter(function ($id) {
                return !QuantityManage::isQuantityAvailable($id);
            });
            $books = $books->whereIn('id', $bookIds);
        }

        // Paginate the results
        $books = $books->paginate(10);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('admin.book.index', compact('books', 'category', 'author', 'publisher', 'status'));
    }

    public function filterByType(Request $request)
    {
        $type = $request->query('type');

        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $books = Book::where('type', $type)->orderBy('created_at', 'DESC')->paginate(10);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('admin.book.index', compact('books', 'category', 'author', 'publisher', 'type'));
    }

    public function activeBook()
    {

        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $books = Book::where('preview', 'active')->orderBy('created_at', 'DESC')->paginate(10);

        if (count($books) == null) {
            flash()->error('No Data Found');
        }

        return view('admin.book.index', compact('books', 'category', 'author', 'publisher'));
    }

    public function inactiveBook()
    {

        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $books = Book::where('preview', 'inactive')->paginate(10);

        if (count($books) == null) {
            flash()->error('No Data Found');
        }

        return view('admin.book.index', compact('books', 'category', 'author', 'publisher'));
    }


    public function filterByDate(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $dateRange = $request->all();

        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $query = Book::query();

        if ($startDate && $endDate) {
            $endDate = Carbon::parse($endDate)->addDay();

            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate('created_at', $startDate);
        } elseif ($endDate) {
            $query->whereDate('created_at', $endDate);
        }

        $books = $query->orderBy('created_at', 'DESC')->paginate(10);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('admin.book.index', compact('books', 'category', 'author', 'publisher', 'dateRange', 'startDate', 'endDate'));
    }



    public function bookSearch(Request $request)
    {
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $searchQuery = $request->input('search_query');


        if (empty($searchQuery)) {
            flash()->error('Need Value');
        }

        $query = Book::query();

        if (!empty($searchQuery)) {
            $query->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%')

                    ->orWhereHas('category', function ($q) use ($searchQuery) {
                        $q->where('name', 'like', '%' . $searchQuery . '%');
                    })

                    ->orWhereHas('author', function ($q) use ($searchQuery) {
                        $q->where('name', 'like', '%' . $searchQuery . '%');
                    })

                    ->orWhereHas('publisher', function ($q) use ($searchQuery) {
                        $q->where('name', 'like', '%' . $searchQuery . '%');
                    });
            });
        }

        $books = $query->paginate(12);


        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('admin.book.index', compact('books', 'category', 'author', 'publisher'));
    }

    public function filterByCategory($id)
    {

        $categoryName = Category::findOrFail($id);

        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $books = Book::where('category_id', $id)->paginate(12);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('admin.book.index', compact('books', 'category', 'author', 'publisher', 'categoryName'));
    }

    public function filterByAuthor($id)
    {

        $authorName = Author::findOrFail($id);
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $books = Book::Where('author_id', $id)->paginate(12);
        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }
        return view('admin.book.index', compact('books', 'category', 'author', 'publisher', 'authorName'));
    }

    public function filterByPublisher($id)
    {

        $publisherName = Publisher::findOrFail($id);
        $category = Category::where('status', 'active')->get();
        $author = Author::where('status', 'active')->get();
        $publisher = Publisher::where('status', 'active')->get();

        $books = Book::Where('publisher_id', $id)->paginate(12);

        if ($books->isEmpty()) {
            flash()->error('No data found.');
        }

        return view('admin.book.index', compact('books', 'category', 'author', 'publisher', 'publisherName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $authors = Author::where('status', 'active')->get();
        $publishers = Publisher::where('status', 'active')->get();
        return view('admin.book.create', compact('categories', 'authors', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'publisher' => 'required',
            'isbn' => 'required',
            'publication_date' => 'required',
            'number_of_pages' => 'required',
            'quantity' => 'required',
            'summary' => 'required',
            'cover_image' => 'required',
            'status' => 'required',
            'type' => 'required',
            'preview' => 'required',
        ]);

        $imageName = '';

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = uniqid() . "_" . time() . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/book', $imageName);
        }

        Book::create([
            'title' => $request->title,
            'author_id' => $request->author,
            'category_id' => $request->category,
            'publisher_id' => $request->publisher,
            'isbn' => $request->isbn,
            'publication_date' => $request->publication_date,
            'number_of_pages' => $request->number_of_pages,
            'quantity' => $request->quantity,
            'summary' => $request->summary,
            'status' => $request->status,
            'type' => $request->type,
            'preview' => $request->preview,
            'cover_image' => $imageName,
        ]);

        flash()->success('Book Created Successfully');
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::where('status', 'active')->get();
        $authors = Author::where('status', 'active')->get();
        $publishers = Publisher::where('status', 'active')->get();
        return view('admin.book.edit', compact('categories', 'authors', 'publishers', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'publisher' => 'required',
            'isbn' => 'required',
            'publication_date' => 'required',
            'number_of_pages' => 'required',
            'quantity' => 'required',
            'summary' => 'required',
            'cover_image' => 'nullable|image',
            'status' => 'required',
            'type' => 'required',
            'preview' => 'required',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image && Storage::exists('public/book/' . $book->cover_image)) {
                Storage::delete('public/book/' . $book->cover_image);
            }

            $image = $request->file('cover_image');
            $imageName = uniqid() . "_" . time() . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/book', $imageName);
            $book->cover_image = $imageName;
        }

        $book->update([
            'title' => $request->title,
            'author_id' => $request->author,
            'category_id' => $request->category,
            'publisher_id' => $request->publisher,
            'isbn' => $request->isbn,
            'publication_date' => $request->publication_date,
            'number_of_pages' => $request->number_of_pages,
            'quantity' => $request->quantity,
            'summary' => $request->summary,
            'status' => $request->status,
            'type' => $request->type,
            'preview' => $request->preview,
        ]);

        flash()->success('Book Updated Successfully');
        return redirect()->route('book.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return response()->json(['status' => 'success', 'message' => 'Book Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {
        $book = Book::findOrFail($request->id);
        $book->status = $request->status;
        $book->save();

        return response()->json(['message' => 'Status has been Updated!']);
    }

    public function changeType(Request $request)
    {
        $book = Book::findOrFail($request->id);
        $book->type = $request->type;
        $book->save();

        return response()->json(['message' => 'Status has been Updated!']);
    }

    public function changePreview(Request $request)
    {
        $book = Book::findOrFail($request->id);
        $book->preview = $request->preview == 'true' ? 'active' : 'inactive';
        $book->save();

        return response()->json(['message' => 'Status has been Updated!']);
    }
}
