<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Book;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    public function dashboard()
    {
        $borrowedBooks = BorrowedBook::where('student_id', Auth::guard('student')->id())->get();
        return view('student.dashboard', compact('borrowedBooks'));
    }

    public function viewBooks()
    {
        $books = Book::all();
        return view('student.books', compact('books'));
    }

    public function borrowBook(Request $request)
    {
        $book = Book::find($request->book_id);

        if ($book && $book->copies > 0) {
            BorrowedBook::create([
                'book_id' => $book->id,
                'student_id' => Auth::id(),
                'borrowed_at' => now(),
            ]);

            $book->decrement('copies');
            return redirect()->route('student.dashboard');
        }

        return redirect()->route('student.books')->withErrors('Book is not available');
    }

    public function returnBook(Request $request)
    {
        $borrowedBook = BorrowedBook::find($request->borrowed_book_id);

        if ($borrowedBook) {
            $book = Book::find($borrowedBook->book_id);
            $borrowedBook->update(['return_at' => now()]);
            $book->increment('copies');

            return redirect()->route('student.dashboard');
        }

        return redirect()->route('student.dashboard')->withErrors('Invalid request');
    }





    public function editProfile($id)
    {
        $student = Student::findOrFail($id);

        return view('student.profile.edit', compact('student'));
    }


    public function updateProfile(Request $request, $id)
{
    $student = Student::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:students,email,' . $id, 
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $student->name = $request->name;
    $student->email = $request->email;

    if ($request->filled('password')) {
        $student->password = Hash::make($request->password);
    }

    $student->save();

    return redirect('student/dashboard')->with('success', 'Profile updated successfully.');
    
}
}
