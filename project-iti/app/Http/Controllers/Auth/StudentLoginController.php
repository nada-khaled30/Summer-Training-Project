<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\StudentDashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:student')->except('logout');
    }

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to log the student in
        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Redirect to student dashboard
            return redirect()->route('student.dashboard');
        }

        // If unsuccessful, redirect back to the login form with form data
        return redirect()->back()
        ->withErrors(['email' => 'The provided credentials do not match our records.'])
        ->withInput();    
    }

    // Logout the student
    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        return redirect('/');
    }
}
