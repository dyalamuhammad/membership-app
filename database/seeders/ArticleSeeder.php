<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 15 artikel dummy
        for ($i = 1; $i <= 15; $i++) {
            Article::create([
                'title' => 'Artikel Dummy #' . $i,
                'content' => 'Ini adalah konten dari Artikel Dummy #' . $i . '. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ]);
        }
    }
}