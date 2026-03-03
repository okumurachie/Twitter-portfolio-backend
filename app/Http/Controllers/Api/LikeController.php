<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
    public function toggle(Request $request, Post $post)
    {
        $user = $request->user();
        $like = $post->likes()
            ->where('user_id', $user->id)
            ->first();

        if ($like) {
            $like->delete();
            return response()->json([
                'liked' => false,
                'likes' => $post->likes()->count(),
            ]);
        }

        $post->likes()->create([
            'user_id' => $user->id,
        ]);

        return response()->json([
            'liked' => true,
            'likes' => $post->likes()->count(),
        ]);
    }
}
