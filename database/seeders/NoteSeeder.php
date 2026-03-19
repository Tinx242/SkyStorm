<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::all() -> first();
        Note::factory()
            -> count(10)
            //->for($user)
            -> create([
                'user_id' => $user -> id,
            ]);
        //dd($user); // dd signifie équivalent de var dump
    }
}
