<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            Post::inRandomOrder()->take(10)->get()
                ->each(fn($post) => Like::firstOrCreate([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]));
        });
    }
}
