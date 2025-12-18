@extends('layouts.app')

@section('content')
<div class="panel">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h1 style="margin:0;">{{ $course->title }}</h1>
        <a href="{{ route('courses.edit', $course) }}" class="btn">Edit</a>
    </div>
    <div class="grid mt-3" style="grid-template-columns: repeat(3, 1fr);">
        <div class="card">
            <div class="muted">Category</div>
            <div style="font-weight:600;">{{ $course->category }}</div>
        </div>
        <div class="card">
            <div class="muted">Level</div>
            <div style="font-weight:600;">{{ ucfirst($course->difficulty_level) }}</div>
        </div>
        <div class="card">
            <div class="muted">Price</div>
            <div style="font-weight:600;">${{ number_format($course->price, 2) }}</div>
        </div>
    </div>

    <h2 class="mt-4">Feedbacks</h2>
    <div class="actions mt-2">
        <a href="{{ route('courses.feedbacks.filter', [$course, 'published']) }}" class="btn btn-success">Published</a>
        <a href="{{ route('courses.feedbacks.filter', [$course, 'rejected']) }}" class="btn btn-danger">Rejected</a>
    </div>

    <ul class="list mt-3">
        @foreach($course->feedbacks as $feedback)
            <li>
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <a href="{{ route('feedbacks.show', $feedback) }}" style="font-weight:600;">{{ $feedback->author_name }}</a>
                        <span class="badge">Score: {{ $feedback->score }}</span>
                        <span class="status {{ $feedback->status }}">{{ ucfirst($feedback->status) }}</span>
                    </div>
                    @if($feedback->status === 'new')
                        <div class="actions">
                            <form method="post" action="{{ route('feedbacks.changeStatus', [$feedback, 'published']) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success">Publish</button>
                            </form>
                            <form method="post" action="{{ route('feedbacks.changeStatus', [$feedback, 'rejected']) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </div>
                    @endif
                </div>
                <p class="mt-2">{{ $feedback->comment }}</p>
            </li>
        @endforeach
    </ul>

    <h3 class="mt-4">Add Feedback</h3>
    <form method="post" action="{{ route('feedbacks.store') }}" class="card">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        <div class="field">
            <label>Your name</label>
            <input type="text" name="author_name" value="{{ old('author_name') }}">
            @error('author_name')<div class="muted">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Score (1-10)</label>
            <input type="number" name="score" min="1" max="10" value="{{ old('score', 10) }}">
            @error('score')<div class="muted">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Comment</label>
            <textarea name="comment">{{ old('comment') }}</textarea>
            @error('comment')<div class="muted">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit Feedback</button>
    </form>
</div>
@endsection
