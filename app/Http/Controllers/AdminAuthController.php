<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function adminLogin(){
        return view('admin.auth.login');
    }

    public function adminLoginSubmit(LoginRequest $request){
    if (Auth::attempt($request->only('email', 'password'))) {

        if (Auth::user()->role === 'admin') {
         
            $request->session()->regenerate();
         
            toastr()->success('Login Successful');
      
            return redirect()->route('admin.dashboard');
        } else {
     
            Auth::guard('web')->logout();
    
            return redirect()->route('admin.login')->with(['status' => 'You cannot log in as an admin! Please log in with your specific role.']);
        }
    } else {
 
        return redirect()->route('admin.login')->with(['status' => 'Invalid email or password.']);
    }
}

}
