@extends('layouts.app')

@section('content')
<div class="panel">
    <h1 style="margin:0 0 .75rem 0;">Create Course</h1>
    <form method="post" action="{{ route('courses.store') }}" class="card">
        @csrf
        <div class="field">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title')<div class="muted">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Category</label>
            <input type="text" name="category" value="{{ old('category') }}">
            @error('category')<div class="muted">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Difficulty Level</label>
            <select name="difficulty_level">
                @foreach(['beginner','intermediate','advanced'] as $level)
                    <option value="{{ $level }}" @selected(old('difficulty_level')===$level)>{{ ucfirst($level) }}</option>
                @endforeach
            </select>
            @error('difficulty_level')<div class="muted">{{ $message }}</div>@enderror
        </div>
        <div class="field">
            <label>Price</label>
            <input type="number" step="0.01" min="0.01" name="price" value="{{ old('price') }}">
            @error('price')<div class="muted">{{ $message }}</div>@enderror
        </div>
        <div class="actions">
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('courses.index') }}" class="btn">Cancel</a>
        </div>
    </form>
</div>
@endsection
