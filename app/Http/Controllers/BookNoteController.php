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
        $note = Auth::user()->notes()->updateOrCreate(
            ['book_id' => $request->book_id],
            ['status' => $request->status]
        );

        return response()->json(['success' => 'Status updated']);
    }

    public function updateNotes(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);
        $note = Auth::user()->notes()->updateOrCreate(
            ['book_id' => $request->book_id],
            ['notes' => $request->notes]
        );

        return response()->json(['success' => 'Notes updated']);
    }
}
