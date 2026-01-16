<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MembershipSeeder::class,
            ArticleSeeder::class,
            VideoSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // password default
            'role' => 'admin', // Set role sebagai admin
        ]);

        User::factory()->create([
             'name' => 'John Doe',
             'email' => 'john.doe@example.com',
             'password' => Hash::make('password'),
             'role' => 'member', // Set role sebagai member
         ]);
    }
}
