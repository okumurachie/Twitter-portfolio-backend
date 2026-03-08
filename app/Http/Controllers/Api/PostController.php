<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'content' => 'required|string|max:120',
        ]);
        $post = $user->posts()->create([
            'content' => $validated['content'],
        ]);

        return response()->json(
            $post->load(['user'])->loadCount(['likes']),
            201
        );
    }

    public function index()
    {
        return response()->json(
            Post::with('user')
                ->withCount('likes')
                ->latest()
                ->get()
        );
    }

    public function show(Post $post)
    {
        return response()->json(
            $post->load(['user', 'comments.user'])->loadCount(['likes']),
            200
        );
    }
    public function destroy(Request $request, Post $post)
    {
        $user = $request->user();
        if ($post->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
