<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();

        if ($admin) {
            // Create posts for the admin user
            Post::factory()->count(15)->create(['user_id' => $admin->id]); // Adjust count as needed
        } else {
            $this->command->error('No admin user found!');
        }
    }
}
