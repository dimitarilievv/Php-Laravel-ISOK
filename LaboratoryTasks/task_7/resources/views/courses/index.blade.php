@extends('layouts.app')

@section('content')
<div class="panel">
    <h1 style="margin:0 0 .75rem 0;">Courses</h1>
    <form method="get" action="{{ route('courses.index') }}" class="mb-3" style="display:flex; gap:.5rem;">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by title or category" />
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('courses.create') }}" class="btn">Create Course</a>
    </form>

    <div class="grid">
        @foreach($courses as $course)
            <div class="card">
                <div style="display:flex; justify-content:space-between; align-items:center;">
                    <a href="{{ route('courses.show', $course) }}" style="font-weight:600;">{{ $course->title }}</a>
                    <span class="badge">{{ ucfirst($course->difficulty_level) }}</span>
                </div>
                <div class="muted mt-2">Category: {{ $course->category }}</div>
                <div class="mt-2" style="font-weight:600;">${{ number_format($course->price, 2) }}</div>
                <div class="actions mt-3">
                    <a href="{{ route('courses.show', $course) }}" class="btn btn-muted">View</a>
                    <a href="{{ route('courses.edit', $course) }}" class="btn">Edit</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
