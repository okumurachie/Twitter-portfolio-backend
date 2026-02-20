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
        $post = Post::create([
            'user_id' => $user->id,
            'content' => $validated['content'],
        ]);

        $post->load('user');
        $post->loadCount('likes');

        return response()->json($post, 201);
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
