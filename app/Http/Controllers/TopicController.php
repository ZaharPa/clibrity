<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->only('search');

        return inertia(
            'Topic/Index',
            [
                'filter' => $filter,
                'topics' => Topic::with('user')
                    ->withCount('posts')
                    ->filter($filter)
                    ->orderBy('created_at', 'desc')
                    ->paginate(30)
            ]
        );
    }

    public function create()
    {
        return inertia('Topic/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'book_id' => 'nullable|exists:books,id'
        ]);

        Topic::create([
            'title' => $request->title,
            'description' => $request->description,
            'book_id' => $request->book_id,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('topics.index')
            ->with('success', 'Topic was created');
    }

    public function show(Topic $topic)
    {
        $topic->load('book');

        return inertia('Topic/Show', [
            'topic' => $topic,
            'canDelete' => Auth::check()
                ? Auth::user()->can('delete', $topic)
                : false
        ]);
    }

    public function destroy(Topic $topic)
    {
        Gate::authorize('delete', $topic);
        $topic->delete();

        return redirect()->route('topics.index')
            ->with('success', 'Topic was deleted');
    }
}
