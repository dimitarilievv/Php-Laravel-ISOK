@extends('layouts.app')

@section('content')
<div class="panel">
    <h1 style="margin:0 0 .75rem 0;">Feedback by {{ $feedback->author_name }}</h1>
    <div class="grid" style="grid-template-columns: repeat(3, 1fr);">
        <div class="card">
            <div class="muted">Status</div>
            <div class="status {{ $feedback->status }}">{{ ucfirst($feedback->status) }}</div>
        </div>
        <div class="card">
            <div class="muted">Score</div>
            <div style="font-weight:600;">{{ $feedback->score }}</div>
        </div>
        <div class="card">
            <div class="muted">Course</div>
            <div><a href="{{ route('courses.show', $feedback->course) }}">{{ $feedback->course->title }}</a></div>
        </div>
    </div>
    <div class="card mt-3">
        <p style="margin:0;">{{ $feedback->comment }}</p>
    </div>
</div>
@endsection
