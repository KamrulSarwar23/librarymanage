<?php

namespace App\Http\Controllers;

use App\Mail\AccountBanned;
use App\Mail\LoginMail;
use App\Mail\UserAccountInfo;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'user')->orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.user.index', compact('users'));
    }


    public function userborrowDetails(string $id){

        $borrowBook = Borrow::findOrFail($id);
        return view('frontend.borrowDetails', compact('borrowBook'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

  
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
        ]);

        $name = $request->name;
        $password = Str::random(10);
        $Hashpassword = Hash::make($password);
        $email = $request->email;
       

        User::create([
            'name' => $request->name,
            'email' =>  $email,
            'phone' => $request->phone,
            'status' => 'active',
            'role' => 'user',
            'password' => $Hashpassword
        ]);

        Mail::to($email)->send(new UserAccountInfo($name, $email, $password));
     
        flash()->success('User Created Successfully & Info Mail Sent');
        return redirect()->route('user-manage.index');

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
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user = User::findOrFail($id)->update([
            'status' =>$request->status
        ]);

        flash()->success('Status Updated Succesfully');
        return redirect()->route('user-manage.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        flash()->success('User Deleted Succesfully');
        return response()->json(['status' => 'success', 'message' => 'User deleted successfully.']);
    }

    public function updateProfile(Request $request)
    {

        $request->validate([

            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . Auth::user()->id],
            'image' => ['image', 'max:2048'],

        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }

            $image = $request->image;
            $imageName = rand() . '-' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);

            $path = "uploads/" . $imageName;
            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        flash()->success('Profile Updated Succesfully');
        return redirect()->back()->with('profile', 'Profile Updated Successfully');
    }

    /** Update Password **/

    public function updatePassword(Request $request)
    {

        $request->validate([

            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);


        $request->user()->update([

            'password' => bcrypt($request->password)

        ]);

        flash()->success('Password Updated Succesfully');
        return redirect()->back()->with('success', 'Password Updated Successfully');
    }


    public function changeStatus(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $request->status == 'true' ? 'active' : 'inactive';
        $user->save();

        if ($user->status === 'active') {
            $email = $user->email;
            Mail::to($email)->send(new LoginMail($user));
            return response()->json(['message' => 'Account Activation Email Sent To User']);
        }else{
            $email = $user->email;

            Mail::to($email)->send(new AccountBanned($user));

            DB::table('sessions')->where('user_id', $user->id)->delete();

            return response()->json(['message' => 'Account Banned Email Sent To User, User Logged Out']);
        }

    }


 
}
