<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;


class LikesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $likes = [
            [
                'user_email' => 'test2@example.com',
                'post_content' => 'こんにちは!Test User1です。',
            ],
            [
                'user_email' => 'test1@example.com',
                'post_content' => 'いいね機能のテスト投稿です。',
            ],
        ];

        foreach ($likes as $like) {
            $user = User::where('email', $like['user_email'])->firstOrFail();

            $post = Post::where('content', $like['post_content'])->firstOrFail();

            $post->likes()->firstOrCreate([
                'user_id' => $user->id,
            ]);
        }
    }
}
