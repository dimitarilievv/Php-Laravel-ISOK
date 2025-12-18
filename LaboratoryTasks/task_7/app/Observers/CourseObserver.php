<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Facades\Log;

class CourseObserver
{
    public function creating(Course $course): void
    {
        Log::info('Course creating', [
            'title' => $course->title,
            'category' => $course->category,
            'difficulty_level' => $course->difficulty_level,
            'price' => $course->price,
        ]);
    }

    public function created(Course $course): void
    {
        Log::info('Course created', [
            'id' => $course->id,
        ]);
    }

    public function updating(Course $course): void
    {
        Log::info('Course updating', [
            'id' => $course->id,
            'dirty' => array_keys($course->getDirty()),
        ]);
    }

    public function updated(Course $course): void
    {
        Log::info('Course updated', [
            'id' => $course->id,
            'changes' => $course->getChanges(),
        ]);
    }

    public function deleting(Course $course): void
    {
        Log::info('Course deleting', [
            'id' => $course->id,
            'feedbacks_count' => $course->feedbacks()->count(),
        ]);
    }

    public function deleted(Course $course): void
    {
        Log::info('Course deleted', [
            'id' => $course->id,
        ]);
    }
}

