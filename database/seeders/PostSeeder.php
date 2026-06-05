<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**n
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $users->each(function ($user) {
            Post::factory()->create([
                'user_id' => $user->id
            ]);
        });
        //dd($user); // dd signifie équivalent de var dump
    }
}
