<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(ArticleCategorySeeder::class);
        $this->call(ArticleCategorySeeder::class);
        $this->call(DashboardBannerSeeder::class);
        $this->call(AboutUsSeeder::class);
        $this->call(DownloadFileSeeder::class);

        Article::factory(20)->recycle([
            ArticleCategory::all(),
            User::all()
        ])->create();
    }
}
