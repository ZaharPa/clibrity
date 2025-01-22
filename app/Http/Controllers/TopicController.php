<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TopicController extends Controller
{
    public function index()
    {
        return inertia(
            'Topic/Index',
            [
                'topics' => Topic::with('user')
                    ->withCount('posts')
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
            'description' => 'nullable'
        ]);

        Topic::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('topics.index')
            ->with('success', 'Topic was created');
    }

    public function show(Topic $topic)
    {
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
