<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.author.index', compact('authors'));
    }

    public function activeAuthor(){
        $authors = Author::where('status', 'active')->paginate(10);

        if (count($authors) == null) {
            flash()->error('No Data Found');
        }

        return view('admin.author.index', compact('authors'));
    }

    public function pendingAuthor(){
        $authors = Author::where('status', 'inactive')->paginate(10);

        if (count($authors) == null) {
            flash()->error('No Data Found');
        }
        
        return view('admin.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'date_of_death' => 'nullable|date',
            'biography' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);
    
        $data = $request->only(['name', 'address', 'date_of_birth', 'date_of_death', 'biography', 'status']);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . "_" . time() . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/author', $imageName);
            $data['image'] = $imageName;
        }
    
        Author::create($data);
    
        flash()->success('Author Created Successfully');
        return redirect()->route('author.index');
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
        $author = Author::findOrFail( $id);
        return view('admin.author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'date_of_death' => 'nullable|date',
            'biography' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);
    
        $author = Author::findOrFail($id);
    
        if ($request->hasFile('image')) {
    
            if ($author->image && Storage::exists('public/author/' . $author->image)) {
                Storage::delete('public/author/' . $author->image);
            }
    
            $image = $request->file('image');
            $imageName = uniqid() . "_" . time() . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/author', $imageName);
    
            $author->image = $imageName;
        }
        
        $author->update([
            'name' => $request->name,
            'address' => $request->address,
            'date_of_birth' => $request->date_of_birth,
            'date_of_death' => $request->date_of_death,
            'biography' => $request->biography,
            'status' => $request->status,
        ]);
    
        flash()->success('Author Updated Successfully');
        return redirect()->route('author.index');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::findOrFail( $id);

        if (count($author->books) > 0) {
            return response()->json(['status' => 'error', 'message' => 'You Cant delete this! It has Books']);
        }

        $author->delete();
        return response()->json(['status' => 'success', 'message' => 'Author Deleted Successfully']);
    }


    public function changeStatus(Request $request){
        
        $author = Author::findOrFail($request->id);

        if ($author->status == 'active') {
            if (count($author->books) > 0) {
                return response()->json(['message' => 'It Has Book; Cant Deactivate That'], 400);
            }
        }

        $author->status = $request->status == 'true' ? 'active' : 'inactive';
        $author->save();

        return response()->json(['message' => 'Status has been Updated!']);
    }
}
