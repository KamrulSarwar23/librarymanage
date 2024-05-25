<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(10);
        return view('admin.book.index', compact('books'));
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
            'summary' => 'required',
            'cover_image' => 'required',
            'status' => 'required',
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
            'summary' => $request->summary,
            'status' => $request->status,
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
            'summary' => 'required',
            'cover_image' => 'nullable|image',
            'status' => 'required',
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
            'summary' => $request->summary,
            'status' => $request->status,
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
}
