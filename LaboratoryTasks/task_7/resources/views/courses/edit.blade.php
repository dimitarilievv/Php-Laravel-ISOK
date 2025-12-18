@extends('layouts.app')

@section('content')
<div class="panel">
    <h1 style="margin:0 0 .75rem 0;">Edit Course</h1>
    <form method="post" action="{{ route('courses.update', $course) }}" class="card">
        @csrf
        @method('PUT')
        <div class="field">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $course->title) }}">
            @error('title')<div class="muted">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Category</label>
            <input type="text" name="category" value="{{ old('category', $course->category) }}">
            @error('category')<div class="muted">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Difficulty Level</label>
            <select name="difficulty_level">
                @foreach(['beginner','intermediate','advanced'] as $level)
                    <option value="{{ $level }}" @selected(old('difficulty_level', $course->difficulty_level)===$level)>{{ ucfirst($level) }}</option>
                @endforeach
            </select>
            @error('difficulty_level')<div class="muted">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Price</label>
            <input type="number" step="0.01" min="0.01" name="price" value="{{ old('price', $course->price) }}">
            @error('price')<div class="muted">{{ $message }}</div>@enderror
        </div>
        <div class="actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('courses.show', $course) }}" class="btn">Cancel</a>
        </div>
    </form>
    <form method="post" action="{{ route('courses.destroy', $course) }}" onsubmit="return confirm('Delete this course?')" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Course</button>
    </form>
</div>
@endsection
