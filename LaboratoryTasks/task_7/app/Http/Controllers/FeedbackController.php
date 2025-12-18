<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Course;
use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    public function store(StoreFeedbackRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $course = Course::findOrFail($data['course_id']);
        $course->feedbacks()->create($data);
        return back()->with('status', 'Feedback submitted');
    }

    public function show(Feedback $feedback): View
    {
        $feedback->load('course');
        return view('feedbacks.show', compact('feedback'));
    }

    public function changeStatus(Feedback $feedback, string $status): RedirectResponse
    {
        abort_unless(in_array($status, ['published', 'rejected'], true), 400);
        if ($feedback->status === 'new') {
            $feedback->update(['status' => $status]);
        }
        return back()->with('status', 'Feedback status updated');
    }

    public function filterByStatus(Course $course, string $status): View
    {
        abort_unless(in_array($status, ['published', 'rejected'], true), 404);
        $feedbacks = $course->feedbacks()->where('status', $status)->latest()->get();
        return view('feedbacks.index', compact('course', 'feedbacks', 'status'));
    }
}
