<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Topic $topic)
    {
        return $topic->posts()
            ->with('user')
            ->latest()
            ->paginate(30);
    }

    public function store(Request $request, Topic $topic)
    {
        $request->validate([
            'content' => 'required'
        ]);

        return $topic->posts()->create([
            'content' => $request->content,
            'user_id' => Auth::user()->id
        ]);
    }

   public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['success' => 'Post was deleted']);
    }
}
