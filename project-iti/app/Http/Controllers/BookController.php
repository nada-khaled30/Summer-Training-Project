<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'copies' => 'required|integer',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.books.index');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'copies' => 'required|integer',
        ]);

        $book->update($request->all());

        return redirect()->route('admin.books.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index');
    }
}

