<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Feedback>
 */
class FeedbackFactory extends Factory
{
    protected $model = Feedback::class;

    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'author_name' => $this->faker->name(),
            'comment' => $this->faker->paragraph(),
            'score' => $this->faker->numberBetween(1, 10),
            'status' => 'new',
        ];
    }

    public function published(): self
    {
        return $this->state(fn () => ['status' => 'published']);
    }

    public function rejected(): self
    {
        return $this->state(fn () => ['status' => 'rejected']);
    }
}

