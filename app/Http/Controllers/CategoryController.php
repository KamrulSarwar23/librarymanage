<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\FileExists;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . "_" . time() . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/category', $imageName);

            Category::create([
                'name' => $request->name,
                'status' => $request->status,
                'image' => $imageName
            ]);
        }

        flash()->success('Category Created Successfully');
        return redirect()->route('category.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, string $id)
    {

        $request->validate([
            'image' => 'nullable|image',
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {

            if ($category->image && Storage::exists('public/category/' . $category->image)) {
                Storage::delete('public/category/' . $category->image);
            }

            $image = $request->file('image');
            $imageName = uniqid() . "_" . time() . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/category', $imageName);

            $category->image = $imageName;
        }


        $category->name = $request->name;
        $category->status = $request->status;
        $category->save();

        flash()->success('Category Updated Successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if (count($category->books) > 0) {
            return response()->json(['status' => 'error', 'message' => 'You Cant delete this! It has Books']);
        }


        $category->delete();
        return response()->json(['status' => 'success', 'message' => 'Category Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);


        if ($category->status == 'active') {
            if (count($category->books) > 0) {
                return response()->json(['message' => 'It Has Book; Cant Deactivate That'], 400);
            }
        }


        $category->status = $request->status == 'true' ? 'active' : 'inactive';
        $category->save();

        return response()->json(['message' => 'Status has been Updated!']);
    }


    public function activeCategory()
    {
        $categories = Category::where('status', 'active')->orderBy('created_at', 'DESC')->paginate(10);

        if (count($categories) == null) {
            flash()->error('No Data Found');
        }

        return view('admin.category.index', compact('categories'));
    }

    public function pendingCategory()
    {
        $categories = Category::where('status', 'inactive')->orderBy('created_at', 'DESC')->paginate(10);

        if (count($categories) == null) {
            flash()->error('No Data Found');
        }

        return view('admin.category.index', compact('categories'));
    }
}
