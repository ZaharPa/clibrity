<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'created_at');
        $order = $request->get('order', 'desc');

        $allowedSorts = ['title', 'author', 'category', 'size', 'created_at'];
        if(!in_array($sort, $allowedSorts)) {
            $sort = 'created_at';
        }

        $filters = $request->only([
            'title', 'author', 'category', 'size'
        ]);

        return inertia(
            'Book/Index',
            [
                'sort' => $sort,
                'order' => $order,
                'filters' => $filters,
                'books' => Book::orderBy($sort, $order)
                    ->filter($filters)
                    ->paginate(20)
                    ->withQueryString(),

            ]
        );
    }

    public function show(Book $book)
    {
        $book->load('publisher');

        return inertia('Book/Show', [
            'book' => $book,
            'reviews' => $book->reviews()->with('user')->paginate(20),
            'user_notes' => Auth::check()
                ? Auth::user()->notes()->where('book_id', $book->id)->with('user')->get()
                : null
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query', '');
        $books = Book::where('title', 'like', "%$query%")
            ->select('id', 'title')
            ->limit(10)
            ->get();

        return response()->json($books);
    }
}
