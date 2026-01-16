<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Membership::create([
            'name' => 'Type A',
            'article_limit' => 3,
            'video_limit' => 3,
        ]);

        Membership::create([
            'name' => 'Type B',
            'article_limit' => 10,
            'video_limit' => 10,
        ]);

        Membership::create([
            'name' => 'Type C',
            'article_limit' => null, // null artinya unlimited
            'video_limit' => null,   // null artinya unlimited
        ]);
    }
}