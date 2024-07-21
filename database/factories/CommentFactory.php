<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isReply = fake()->boolean(30);
        return [
            'content' => fake()->paragraph,
            'user_id' => User::where('is_admin', false)->inRandomOrder()->first()->id, // Random non-admin user
            'post_id' => Post::inRandomOrder()->first()->id, // Random post
            'parent_id' => null, // Random comment as parent if it's a reply, otherwise null

        ];
    }
}
