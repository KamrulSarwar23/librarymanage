<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.publisher.index', compact('publishers'));
    }

    public function activePublisher()
    {
        $publishers = Publisher::where('status', 'active')->paginate(10);

        if (count($publishers) == null) {
            flash()->error('No Data Found');
        }

        return view('admin.publisher.index', compact('publishers'));
    }

    public function pendingPublisher()
    {
        $publishers = Publisher::where('status', 'inactive')->paginate(10);

        if (count($publishers) == null) {
            flash()->error('No Data Found');
        }

        return view('admin.publisher.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'status' => 'required'
        ]);

        $data = $request->only(['name', 'email', 'phone', 'address', 'status']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . "_" . time() . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/publisher', $imageName);
            $data['image'] = $imageName;
        }

        Publisher::create($data);

        flash()->success('Publisher Created Successfully');
        return redirect()->route('publisher.index');
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
        $publisher = Publisher::findOrFail($id);
        return view('admin.publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'status' => 'required|in:active,inactive',
        ]);

        $publisher = Publisher::findOrFail($id);


        if ($request->hasFile('image')) {

            if ($publisher->image && Storage::exists('public/publisher/' . $publisher->image)) {
                Storage::delete('public/publisher/' . $publisher->image);
            }

            $image = $request->file('image');
            $imageName = uniqid() . "_" . time() . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/publisher', $imageName);

            $publisher->image = $imageName;
        }

        $publisher->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
        ]);

        flash()->success('Publisher Created Successfully');
        return redirect()->route('publisher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $publishers = Publisher::findOrFail($id);

        if (count($publishers->books) > 0) {
            return response()->json(['status' => 'error', 'message' => 'You Cant delete this! It has Books']);
        }

        $publishers->delete();
        return response()->json(['status' => 'success', 'message' => 'Publisher Deleted Successfully']);
    }

    public function changeStatus(Request $request)
    {
        $publishers = Publisher::findOrFail($request->id);

        if ($publishers->status == 'active') {
            if (count($publishers->books) > 0) {
                return response()->json(['message' => 'It Has Book; Cant Deactivate That'], 400);
            }
        }

        $publishers->status = $request->status == 'true' ? 'active' : 'inactive';
        $publishers->save();

        return response()->json(['message' => 'Status has been Updated!']);
    }
}
