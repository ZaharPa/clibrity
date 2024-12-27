<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return inertia('Book/Show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
