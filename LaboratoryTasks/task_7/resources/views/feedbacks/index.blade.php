@extends('layouts.app')

@section('content')
<div class="panel">
    <h1>Feedbacks ({{ ucfirst($status) }}) for {{ $course->title }}</h1>

    <ul class="list">
        @foreach($feedbacks as $feedback)
            <li>
                <strong>#{{ $feedback->id }}</strong>
                <a href="{{ route('feedbacks.show', $feedback) }}">{{ $feedback->author_name }}</a>
                - Score: {{ $feedback->score }}
                <p class="mt-2">{{ $feedback->comment }}</p>
            </li>
        @endforeach
    </ul>
</div>
@endsection
