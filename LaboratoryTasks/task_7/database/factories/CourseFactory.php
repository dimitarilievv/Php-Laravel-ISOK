<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'category' => $this->faker->randomElement(['Web', 'Mobile', 'Data', 'DevOps', 'Design']),
            'difficulty_level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'price' => $this->faker->randomFloat(2, 10, 300),
        ];
    }
}

