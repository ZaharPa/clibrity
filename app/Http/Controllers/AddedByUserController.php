<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddedByUserController extends Controller
{
    public function index()
    {
        return inertia('AddedByUser/Index');
    }

    public function create()
    {
        return inertia('AddedByUser/Create');
    }

    public function store(Request $request)
    {

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'description' => 'required|string',
                'category' => 'required|in:' . implode(',', Book::$category),
                'size' => 'numeric|min:1',
                'title_path' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'book_path' => 'required|file|mimes:pdf|max:10240'
            ], [
                'title_path' => 'The file should be in one of the formats: jpg, jpeg, png',
                'book_path' => 'The file should be in one of the formats: pdf',
            ]);

            $titlePath = $request->file('title_path')->store('covers', 'public');
            $bookPath = $request->file('book_path')->store('books', 'public');

            $book = new Book([
                'title' => $validated['title'],
                'author' => $validated['author'],
                'description' => $validated['description'],
                'category' => $validated['category'],
                'size' => $validated['size'],
                'title_path' => $titlePath,
                'book_path' => $bookPath,
            ]);

            Auth::user()->publishedBooks()->save($book);

            return redirect()->route('book.show', $book)->with('success', 'Book added successfully');
    }

    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
