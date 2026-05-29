<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            $likedUsers = User::where('id', '!=', $user->id)->inRandomOrder()->take(3)->get();
            foreach ($likedUsers as $likedUser) {
                Like::factory()->create([
                    'user_id' => $user->id,
                    'liked_id' => $likedUser->id,
                    'liked_type' => 'user',
                ]);
            }
        }
    }
}
