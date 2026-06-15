<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        $this->call([
            PostSeeder::class,
            LikeSeeder::class,
        ]);

        $this->seedFollows();
    }

    /**
     * Génère des relations d'abonnement aléatoires entre les utilisateurs.
     */
    private function seedFollows(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Chaque utilisateur suit entre 2 et 5 autres utilisateurs (pas lui-même).
            $toFollow = $users->where('id', '!=', $user->id)
                ->random(rand(2, min(5, $users->count() - 1)))
                ->pluck('id');

            // attach() évite les doublons car la sélection est sans répétition.
            $user->followings()->attach($toFollow);
        }
    }
}
