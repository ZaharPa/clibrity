<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class AddedByUserController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');

        $allowedSorts = ['title', 'author', 'category', 'size', 'created_at'];
        if(!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }
        return inertia('AddedByUser/Index', [
            'sort' => $sort,
            'order' => $order,
            'books' => Auth::user()->publishedBooks()->orderBy($sort, $order)->paginate(10)
        ]);
    }

    public function create()
    {
        return inertia('AddedByUser/Create');
    }

    public function store(BookRequest $request)
    {
            $validated = $request->validated();

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

    public function edit(Book $addedBook)
    {
        Gate::authorize('update', $addedBook);

        return inertia('AddedByUser/Edit', ['book' => $addedBook]);
    }

    public function update(BookRequest $request, Book $addedBook)
    {
        Gate::authorize('update', $addedBook);

        $validated = $request->validated();

        if ($request->hasFile('title_path')) {
            Storage::disk('public')->delete($addedBook->title_path);
            $validated['title_path'] = $request->file('title_path')->store('covers', 'public');
        }

        if ($request->hasFile('book_path')) {
            Storage::disk('public')->delete($addedBook->book_path);
            $validated['book_path'] = $request->file('book_path')->store('books', 'public');
        }

        $addedBook->update($validated);

        return redirect()->route('added-book.index')
            ->with('success', 'Book updated successfully');
    }

    public function destroy(Book $addedBook)
    {
        Gate::authorize('destroy', $addedBook);

        Storage::disk('public')->delete($addedBook->title_path);
        Storage::disk('public')->delete($addedBook->book_path);

        $addedBook->delete();

        return redirect()->route('added-book.index')->with('success', 'Book delete successfully');
    }
}
