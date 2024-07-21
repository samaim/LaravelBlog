<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('is_admin', false)->get();

        if ($users->isEmpty()) {
            $this->command->error('No non-admin users found!');
            return;
        }

        // Ensure there are posts available to comment on
        $posts = Post::all();

        if ($posts->isEmpty()) {
            $this->command->error('No posts found to comment on!');
            return;
        }

        // Create comments for the non-admin users
        Comment::factory()
            ->count(30) // Adjust the number of comments as needed
            ->create();
    }
}
