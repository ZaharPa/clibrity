<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookshelfController extends Controller
{
    public function __invoke(Request $request)
    {
        $order = $request->get('order', 'desc');
        $status = $request->get('status', null);
        return inertia('Bookshelf/Index',
            [
                'order' => $order,
                'books' => Auth::user()->notes()
                    ->with('book')
                    ->filterByStatus($status)
                    ->orderBy('updated_at', $order)
                    ->paginate(10)
            ]
        );
    }
}
