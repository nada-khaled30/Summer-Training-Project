<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BorrowedBook;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('welcomePage');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $borrowedBooks = BorrowedBook::where('student_id', Auth::id())->get();
        return view('student.dashboard', compact('borrowedBooks'));
    }

        public function welcomePage()
    {
        return view('welcome');
    }
}

