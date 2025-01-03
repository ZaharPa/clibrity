<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory(300)->create();

        $users = User::all()->random(30);

        for ($i = 0; $i < 500; $i++ ) {
            Book::factory()->create([
                'user_id' => $users->random()->id
            ]);
        }

    }
}
