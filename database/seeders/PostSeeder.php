<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use App\Models\Post; 
use App\Models\User;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make sure at least one user exists
        $user = User::first() ?? User::factory()->create();

        Post::factory()
            ->count(10)
            ->create([
                'user_id' => $user->id, // Assign user_id to each post
            ]);
    }
}
