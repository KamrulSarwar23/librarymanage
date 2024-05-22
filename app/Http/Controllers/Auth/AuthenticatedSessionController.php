<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if (Auth::attempt($request->only('email', 'password'))) {

            if (Auth::user()->role === 'user') {
             
                $request->session()->regenerate();
             
                flash()->success('Login Successfully');
          
                return redirect()->route('user.dashboard');
            } else {
         
                Auth::guard('web')->logout();
        
                return redirect()->route('login')->with(['status' => 'You cannot log in as an user! Please log in with your specific role.']);
            }
        } else {
     
            return redirect()->route('login')->with(['status' => 'Invalid email or password.']);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        flash()->success('Logout Successfully');
        return redirect()->route('login');
    }
}
