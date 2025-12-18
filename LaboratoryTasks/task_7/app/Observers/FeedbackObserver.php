<?php

namespace App\Observers;

use App\Models\Feedback;
use Illuminate\Support\Facades\Log;

class FeedbackObserver
{
    public function creating(Feedback $feedback): void
    {
        if (!$feedback->status) {
            $feedback->status = 'new';
        }
        Log::info('Feedback creating', [
            'course_id' => $feedback->course_id,
            'author_name' => $feedback->author_name,
            'status' => $feedback->status,
        ]);
    }

    public function created(Feedback $feedback): void
    {
        Log::info('Feedback created', [
            'id' => $feedback->id,
            'course_id' => $feedback->course_id,
            'status' => $feedback->status,
        ]);
    }

    public function updating(Feedback $feedback): bool
    {
        $dirty = array_keys($feedback->getDirty());
        $allowed = ['status'];
        foreach ($dirty as $key) {
            if (!in_array($key, $allowed, true)) {
                Log::warning('Attempted forbidden feedback update', [
                    'id' => $feedback->id,
                    'field' => $key,
                ]);
                throw new \RuntimeException('Updating feedback is not allowed.');
            }
        }
        if (in_array('status', $dirty, true)) {
            $from = $feedback->getOriginal('status');
            $to = $feedback->status;
            if ($from !== 'new' || !in_array($to, ['published', 'rejected'], true)) {
                Log::warning('Invalid feedback status transition', [
                    'id' => $feedback->id,
                    'from' => $from,
                    'to' => $to,
                ]);
                throw new \RuntimeException('Invalid feedback status transition.');
            }
            Log::info('Feedback status updating', [
                'id' => $feedback->id,
                'from' => $from,
                'to' => $to,
            ]);
        }
        return true;
    }

    public function updated(Feedback $feedback): void
    {
        Log::info('Feedback updated', [
            'id' => $feedback->id,
            'changes' => $feedback->getChanges(),
        ]);
    }

    public function deleting(Feedback $feedback): bool
    {
        Log::warning('Attempted manual feedback deletion', [
            'id' => $feedback->id,
        ]);
        throw new \RuntimeException('Manual feedback deletion is not allowed.');
    }

    public function saved(Feedback $feedback): void
    {
        if ($feedback->relationLoaded('course')) {
            $feedback->course->touch();
        } else {
            $feedback->course()->touch();
        }
        Log::info('Feedback saved and course touched', [
            'feedback_id' => $feedback->id,
            'course_id' => $feedback->course_id,
        ]);
    }
}
