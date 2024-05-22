<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;
class AdminAuthController extends Controller
{
    public function adminLogin()
    {
        return view('admin.auth.login');
    }

    public function index()
    {
        return view('admin.profile.index');
    }

    public function adminLoginSubmit(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            if (Auth::user()->role === 'admin') {

                $request->session()->regenerate();

                flash()->success('Login Successfully');


                return redirect()->route('admin.dashboard');
            } else {

                Auth::guard('web')->logout();

                return redirect()->route('admin.login')->with(['status' => 'You cannot log in as an admin! Please log in with your specific role.']);
            }
        } else {

            return redirect()->route('admin.login')->with(['status' => 'Invalid email or password.']);
        }
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
        return redirect()->back();
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
        return redirect()->back();
    }
}
