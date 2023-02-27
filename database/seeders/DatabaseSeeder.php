<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Create random newsletters and articles using the values from the .env file or the default values of 10 and 20
        \App\Models\Newsletter::factory(env('NEWSLETTER_NUM_MAX', 10))->create();
        \App\Models\Article::factory(env('ARTICLE_NUM_MAX', 20))->create();
    }
}
