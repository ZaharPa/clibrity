<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index()
    {
        return Topic::all()->with('user')->get();
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
        return $topic->load('posts.user');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return response()->json(['success' => 'Topic was deleted']);
    }
}
