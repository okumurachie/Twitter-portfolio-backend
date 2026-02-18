<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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

        return response()->json([
            'message' => '投稿しました',
            'post' => $post,
        ], 201);
    }

    public function index()
    {
        return Post::with('user')
            ->latest()
            ->get();
    }
}
