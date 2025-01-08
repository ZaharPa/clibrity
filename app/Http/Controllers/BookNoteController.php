<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookNoteController extends Controller
{
    public function updateStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:unread,reading,read',
            'book_id' => 'required|exists:books,id'
        ]);
        Auth::user()->notes()->updateOrCreate(
            ['book_id' => $request->book_id],
            ['status' => $request->status]
        );

        return response()->json(['success' => 'Status updated']);
    }

    public function deleteStatus(Request $request)
    {
        $note = Auth::user()->notes()->where('book_id', $request->book_id)->first();

        if ($note) {
            $note->delete();
            return response()->json(['success' => 'Status deleted']);
        }

        return response()->json(['success' => 'Status wasn`t deleted', 'note' => $note, 'request' => $request->book_id]);
    }

    public function updateNotes(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);
       Auth::user()->notes()->updateOrCreate(
            ['book_id' => $request->book_id],
            ['notes' => $request->notes]
        );

        return response()->json(['success' => 'Notes updated']);
    }

    public function updateFavorite(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'favorite' => 'required|boolean'
        ]);

        Auth::user()->notes()->updateOrCreate(
            ['book_id' => $request->book_id],
            ['favorite' => $request->favorite]
        );

        return response()->json(['success' => 'Favorite updated']);
    }
}
