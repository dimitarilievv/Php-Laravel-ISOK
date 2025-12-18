<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Feedback;
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
        $courses = Course::factory()
            ->count(50)
            ->create();

        $courses->each(function (Course $course) {
            Feedback::factory()
                ->count(fake()->numberBetween(2, 6))
                ->create(['course_id' => $course->id]);
        });

        Course::inRandomOrder()->take(20)->get()->each(function (Course $course) {
            Feedback::factory()->published()->count(fake()->numberBetween(1, 3))->create(['course_id' => $course->id]);
            Feedback::factory()->rejected()->count(fake()->numberBetween(0, 2))->create(['course_id' => $course->id]);
        });

        $heavy = Course::factory()->create(['title' => 'Mega Feedback Course']);
        Feedback::factory()->count(25)->create(['course_id' => $heavy->id]);
        Feedback::factory()->published()->count(10)->create(['course_id' => $heavy->id]);
        Feedback::factory()->rejected()->count(5)->create(['course_id' => $heavy->id]);
    }
}
