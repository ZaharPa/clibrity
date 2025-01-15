<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable'
        ]);

        return Topic::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ]);
    }

    public function show(Topic $topic)
    {
        return inertia('Topic/Show', [
            'topic' => $topic,
            'posts' => $topic->posts()
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(30)
        ]);
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return response()->json(['success' => 'Topic was deleted']);
    }
}
