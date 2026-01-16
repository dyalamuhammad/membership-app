<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 15 video dummy (URL YouTube dummy)
        for ($i = 1; $i <= 15; $i++) {
            Video::create([
                'title' => 'Video Dummy #' . $i,
                'url' => 'https://www.youtube.com/watch?v=dummy_video_id_' . $i, // Ganti dengan ID video dummy
            ]);
        }
    }
}