<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Recipe;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create base categories
        Category::factory()->count(5)->create();

        // Create enough recipes to exercise pagination (e.g., 12)
        Recipe::factory()->count(12)->create();
    }
}
