<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            'test1@example.com' => [
                'こんにちは!Test User1です。',
                'Laravel,Firebase 学習中です',
            ],
            'test2@example.com' => [
                'Test User2です!よろしくお願いします。',
                'いいね機能のテスト投稿です。',
            ],
        ];

        foreach ($users as $email => $posts) {
            $user = User::where('email', $email)->first();

            if (!$user) {
                throw new \Exception("User with email {$email} not found.");
            }

            foreach ($posts as $index => $content) {
                Post::create([
                    'user_id' => $user->id,
                    'content' => $content,
                    'created_at' => now()->subMinutes(10 - $index),
                ]);
            }
        }
    }
}
