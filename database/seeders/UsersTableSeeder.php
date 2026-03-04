<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Test User1',
                'email' => 'test1@example.com',
            ],
            [
                'name' => 'Test User2',
                'email' => 'test2@example.com',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'firebase_uid' => Str::uuid(), // ダミーUID
                    'name' => $user['name'],
                ]
            );
        }
    }
}
