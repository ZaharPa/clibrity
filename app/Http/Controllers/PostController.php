<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Events\PostDeleted;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(Topic $topic)
    {
        $posts = $topic->posts()
            ->with('user')
            ->latest()
            ->paginate(30);

        $posts->getCollection()->transform(function ($post) {
            $post->canDelete = Auth::check() ? Auth::user()->can('delete', $post) : false;
            return $post;
        });

        return $posts;
    }

    public function store(Request $request, Topic $topic)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $post = $topic->posts()->create([
            'content' => $request->content,
            'user_id' => Auth::user()->id
        ]);

        broadcast(new PostCreated($post));

        return response()->json([
            'post' => $post
        ], 201);
    }

   public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        broadcast(new PostDeleted($post))->toOthers();

        return response()->json(['success' => 'Post was deleted']);
    }
}
