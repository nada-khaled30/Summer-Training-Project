<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Student;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $books = Book::count();
        $borrowedBooks = BorrowedBook::count();
        $users = Student::count();
        return view('admin.dashboard', compact('books', 'borrowedBooks', 'users'));
    }

    public function searchStudent(Request $request)
    {
        $student = Student::where('student_id', $request->student_id)->first();
        return view('admin.student.search', compact('student'));
    }

    public function viewStudent()
    {
         $students = Student::with('borrowedBooks.book')->get();
        return view('admin.student.view', compact('students'));
    }


    public function addBook()
    {
        return view('admin.books.create');
    }

    public function storeBook(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'copies' => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.books.index');
    }

    public function editBook(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function updateBook(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'copies' => 'required|integer',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index');
    }

    public function deleteBook(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index');
    }




    public function editProfile($id)
    {
        $admin = User::findOrFail($id);

        return view('admin.profile.edit', compact('admin'));
    }


    public function updateProfile(Request $request, $id)
{
    $admin = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id, 
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $admin->name = $request->name;
    $admin->email = $request->email;

    if ($request->filled('password')) {
        $admin->password = Hash::make($request->password);
    }

    $admin->save();

    return redirect('admin/dashboard')->with('success', 'Profile updated successfully.');
    
}

}
