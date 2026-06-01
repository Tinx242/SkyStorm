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
        User::all()->each(function ($user) {
            Post::factory()
                ->count(5)
                ->create([
                    'user_id' => $user->id,
                ]);
        });
        //dd($user); // dd signifie équivalent de var dump
    }
}
